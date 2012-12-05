<?php
class OrderController extends AppController {
    var $name       = 'Order';
    var $uses       = array('Member', 'Order', 'Product', 'SaleRule', 'Estimation', 'ProductReturn', 'OrderPay', 'PriceType');
    var $components = array('Email', 'Alipay');
    var $helpers    = array('AppSession', 'Number', 'Paginator');

    function beforeFilter() {
        $this->AppAuth->allowedActions = array(
                                                'notify_from_alipay',
        );
        parent::beforeFilter();
    }

    /**
     * 注文一覧画面
     */
    function index() {
        $this->layout = 'front';

        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);
        $this->CommFuncs->loadMemberOrderList($memberInfo['id'], $orderListAll);

        $this->__filterOrderList($orderListAll);
        $this->CommFuncs->loadPaging($orderListAll, $orderList);
        $this->set('orderList', $orderList);

        $this->render('list');
    }

    /**
     * 注文詳細画面
     */
    function detail() {
        $this->layout = 'front';
        if (empty($this->params['named']['order_no'])) {
            $this->redirect(HTTPS_HOME_PAGE_URL.'/order/list');
            return;
        }

        $memberId = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $orderInfo = $this->Order->getInfo($memberId, $this->params['named']['order_no']);
        if (empty($orderInfo)) {
            $this->redirect(HTTPS_HOME_PAGE_URL.'/order/list');
            return;
        }
        $this->set('orderInfo', $orderInfo);

        //セール情報を取得
        $this->SaleRule->getListByOrder($orderInfo, $saleRuleList);
        $this->set('saleRuleList', $saleRuleList);

        //送料無料ライン
        $priceTypeFreeInfo = $this->PriceType->getInfoByType(PRICE_TYPE_FREE);
        $this->set('priceTypeFreeInfo', $priceTypeFreeInfo);

        //商品情報を取得
        $this->Product->getSimpleInfoByOrder($orderInfo, $productInfoList);
        $this->set('productInfoList', $productInfoList);

        //評価したものを取得
        $ret = $this->Estimation->isExists($memberId, $orderInfo['order_no']);
        $this->set('existsEstimation', $ret);

        //支払情報を取得
        $rec = $this->OrderPay->getInfo($memberId, $orderInfo['order_no']);
        $this->set('orderPayInfo', $rec);

        $this->render('detail');
    }

    /**
     * ポイント一覧
     */
    function point_list() {
        $this->layout = 'front';

        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);

        //会員の利用できるポイント情報
        $this->loadModel('CustomerPoint');
        $pointInfo = $this->CustomerPoint->getInfo($memberInfo['id']);
        $this->set('pointInfo', $pointInfo);

        $this->CommFuncs->loadMemberOrderList($memberInfo['id'], $orderListAll);
        //$this->__filterOrderList($orderListAll);
        $dataListAll = array();
        $orderNos = array();
        $index = 0;
        foreach($orderListAll as $key => $value) {
            //注文状態が"出荷済み"
            if ($value['shipping_status'] != SHIPPING_STATUS_SHIPPED) {
                continue;
            }
            $orderInfo = $this->Order->getInfo($memberInfo['id'], $value['order_no']);
            $dataListAll[$index]['order_no'] = $value['order_no'];
            $dataListAll[$index]['point_used'] = 0;
            $dataListAll[$index]['point_got'] = 0;
            $dataListAll[$index]['order_datetime'] = $orderInfo['order_datetime'];
            foreach($orderInfo['orders'] as $key => $value) {
                $dataListAll[$index]['point_used'] += $value['point_used'];
                foreach($value['product_info_list'] as $productInfo) {
                    $dataListAll[$index]['point_got']  += $productInfo['point']*$productInfo['order_amount'];
                }
                $dataListAll[$index]['point_got']  += $value['point_adjustment'];
            }
            $index++;
        }

        $this->CommFuncs->loadPaging($dataListAll, $dataList);
        $this->set('dataList', $dataList);

        $this->render('point_list');
    }

    /**
     * 返品申請
     */
    function return_edit() {
        $this->layout = 'front';

        if ((empty($this->params['named']['order_no'])) && empty($this->data['Order'])) {
            $this->redirect(HTTPS_HOME_PAGE_URL.'/member/mypage');
            return;
        }
        if (!empty($this->params['named'])) {
            $this->data['Order'] = $this->params['named'];
        }

        //返品できる件数を計算
        $memberId = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $orderInfo = $this->Order->getInfo($memberId, $this->data['Order']['order_no']);
        $this->__enableReturn($orderInfo, $ret);
        if (empty($ret)) {
            $this->redirect(HTTPS_HOME_PAGE_URL.'/order/detail/order_cd:'.$this->data['Order']['order_no']);
            return;
        }
        $this->Session->write('Order.return.enableReturnList', $ret);
        $this->set('enableReturnList', $ret);

        //商品情報を取得
        $productList = $this->Product->getSimpleInfo(array_keys($ret));
        $this->Session->write('Order.return.enableReturnProductInfoList', $productList);
        $this->set('productList', $productList);

        $this->render('return_edit');
    }

    /**
     * 返品申請完了
     */
    function return_edit_comp() {
        $this->handleInputEmpty(HTTPS_HOME_PAGE_URL.'/order/list');

        //入力データを検証
        $this->Order->invalidFields(array(), $this->data);
        $valid = true;
        $totalReturnNum = 0;
        $enableReturnList = $this->Session->read('Order.return.enableReturnList');
        foreach($enableReturnList as $key => $value) {
            $returnNum  = $this->data['Order'][$key]['return_number'];
            $returnNum += $this->data['Order'][$key]['exchange_number'];
            $totalReturnNum += $returnNum;
            if ($returnNum > $enableReturnList[$key]) {
                $this->Session->setFlash(__('error.returnNumLargeThanEnabled', true), 'default', null, 'returnNumLargeThanEnabled'.$key);
                $valid = false;
            }
        }
        //返品件数合計は”０”の場合
        if ($totalReturnNum == 0) {
            $this->Session->setFlash(__('error.returnNumIsEmpty', true), 'default', null, 'returnNumIsEmpty');
            $valid = false;
        }

        if (!empty($this->Order->validationErrors) || !$valid) {
            $this->return_edit();
            return;
        }

        //返品データを保存
        $updateDatas = array();
        foreach($enableReturnList as $key => $value) {
            if (!empty($this->data['Order'][$key]['return_number']) || !empty($this->data['Order'][$key]['exchange_number'])) {
                $updateData = array();
                $updateData['order_no']        = $this->data['Order']['order_no'];
                $updateData['member_id']       = $this->Session->read($this->AppAuth->sessionKey.'.id');
                $updateData['product_cd']      = $key;
                $updateData['return_number']   = $this->data['Order'][$key]['return_number'];
                $updateData['exchange_number'] = $this->data['Order'][$key]['exchange_number'];
                $updateData['return_reason']   = $this->data['Order']['return_reason'];
                $updateData['comment']         = $this->data['Order']['comment'];
                $updateDatas[] = $updateData;
            }
        }
        $this->ProductReturn->saveAll($updateDatas);

        //返品・交換情報をユーザにメール送信
        $this->__sendMailForRreturnProduct();
        //返品・交換情報を管理者にメール送信
        $this->__sendMailForRreturnProduct(true);

        $this->Session->delete('Order.return');

        $this->Session->setFlash(__('info.returnMailSendSuccess', true), 'default', null, 'returnMailSendSuccess');
        $this->redirect(HTTPS_HOME_PAGE_URL.'/order/detail/order_cd:'.$this->data['Order']['order_no']);
    }

    /**
     * 注文合計情報
     */
    function order_summary() {
//Configure::write('debug', '0');
//return;
        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);
        $this->set('memberInfo', $memberInfo);

        //ポイントリスト
        $this->loadModel('CustomerPoint');
        $pointInfo = $this->CustomerPoint->getInfo($memberInfo['id']);
        $point = !empty($pointInfo['points'])?$pointInfo['points']:0;
        $this->set('point', $point);

        //注文リスト
        $this->CommFuncs->loadMemberOrderList($memberInfo['id'], $orderList);

        //注文完了の注文数
        $orderTotal['count']       = 0;
        $orderTotal['amount']      = 0;
        $orderTotal['notCredited'] = 0;
        foreach($orderList as $key => $value) {
            if ($value['shipping_status'] == SHIPPING_STATUS_NOTCREDITED) {
                $orderTotal['notCredited']++;
            }
            if ($value['shipping_status'] == SHIPPING_STATUS_SHIPPED) {
                $orderTotal['count']++;
                $orderTotal['amount'] += $value['claim_subtotal'];
            }
        }
        $this->set('orderTotal', $orderTotal);

        $this->render('/elements/order/order_summary');
    }

    /**
     * 注文をキャンセル
     */
    function cancel_order() {
        $this->layout = 'empty';
        if (empty($this->params['named']['order_no'])) {
            $this->redirect(HTTPS_HOME_PAGE_URL.'/member/mypage');
            return;
        }

        $orderInfo = $this->Order->getInfo($this->Session->read($this->AppAuth->sessionKey.'.id'), $this->params['named']['order_no']);
        $this->Order->cancelOrder($orderInfo);

        //会員へメールを送信
        $this->__sendMailForOrderCancel($orderInfo);
        //管理者へメールを送信
        $this->__sendMailForOrderCancel($orderInfo, true);

        $this->redirect(HTTPS_HOME_PAGE_URL.'/order/detail/order_no:'.$this->params['named']['order_no']);
        return;
    }

    /**
     * ALIPAYからのデータより処理を行う
     */
    function notify_from_alipay() {
        $this->layout = 'empty';
        $this->Alipay->notify_from_alipay();
        exit();
    }

    function __filterOrderList(&$orderListAll) {
        $tmpList = $orderListAll;
        //注文種類
        /**
        if (!empty($this->params['named']['order_type'])) {
            $orderListAll = array();
            foreach($tmpList as $key => $value) {
                if ($this->params['named']['order_type'] == $value['order_type']) {
                    $orderListAll[] = $value;
                }
            }
        }
        */
        //注文状態
        if (!empty($this->params['named']['shipping_status'])) {
            $orderListAll = array();
            foreach($tmpList as $key => $value) {
                if ($this->params['named']['shipping_status'] == $value['shipping_status']) {
                    $orderListAll[] = $value;
                }
            }
        }
        //販売種類
        elseif (!empty($this->params['named']['sale_method'])) {
            $orderListAll = array();
            $saleMethod = $this->params['named']['sale_method'];
            foreach($tmpList as $key => $value) {
                $memberInfo = $this->Session->read($this->AppAuth->sessionKey);
                $orderInfo = $this->Order->getInfo($memberInfo['id'], $value['order_no']);
                //ギフト または共同購入、ギフトの場合
                if (stripos($orderInfo['orders'][0]['product_info_list'][0]['extradata'], 'sale_method='.$saleMethod) !== false) {
                    $orderListAll[] = $value;
                }
            }
        }
    }

    function __enableReturn(&$orderInfo, &$dataList = array()) {
        $dataList = array();
        foreach($orderInfo['orders'] as $key => $value) {
            if ($value['order_type'] == ORDER_TYPE_REPAYMENT) {
                foreach($value['product_info_list'] as $k => $v) {
                    $dataList[$v['product_cd']] = !empty($dataList[$v['product_cd']])?$dataList[$v['product_cd']]-$v['order_amount']:$v['order_amount']*-1;
                }
            } else {
                foreach($value['product_info_list'] as $k => $v) {
                    $dataList[$v['product_cd']] = !empty($dataList[$v['product_cd']])?$dataList[$v['product_cd']]+$v['order_amount']:$v['order_amount'];
                }
            }
        }
    }

    /**
     * 返品申請のメールを会員へ送信
     */
    function __sendMailForRreturnProduct($toAdmin = false) {
        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);
        if ($toAdmin) {
            $mailTo = 'customer@ibale.com';//SITE_ADMIN_EMAIL;
        } else {
            $mailTo = $memberInfo['email'];
        }

        $this->Email->layout   = 'email';
        $this->Email->sendAs   = 'html';
        $this->Email->from     = SITE_ADMIN_EMAIL;
        $this->Email->to       = $mailTo;
        $this->Email->subject  = sprintf(__('mail.subjectForReturnProductToPayer', true), __('info.siteNameCN', true), $this->data['Order']['order_no']);
        $this->Email->template = 'return_product_to_payer';

        $this->set('memberInfo', $memberInfo);
        $enableReturnList = $this->Session->read('Order.return.enableReturnList');
        $this->set('enableReturnList', $enableReturnList);
        $enableReturnProductInfoList = $this->Session->read('Order.return.enableReturnProductInfoList');
        $this->set('enableReturnProductInfoList', $enableReturnProductInfoList);
        $this->Email->send();
    }
    /**
     * 注文キャンセルのメールを会員へ送信
     */
    function __sendMailForOrderCancel(&$orderInfo, $toAdmin = false) {
        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);
        if ($toAdmin) {
            $mailTo = 'customer@ibale.com';
        } else {
            $mailTo = $memberInfo['email'];
        }

        $this->Email->layout   = 'email';
        $this->Email->sendAs   = 'html';
        $this->Email->from     = SITE_ADMIN_EMAIL;
        $this->Email->to       = $mailTo;
        $this->Email->subject  = sprintf(__('mail.subjectForOrderCancel', true), __('info.siteNameCN', true), $orderInfo['order_no']);
        $this->Email->template = 'order_cancel_to_member';

        $this->set('memberInfo', $memberInfo);
        $this->set('orderInfo', $orderInfo);

        $this->Email->send();
    }
}
?>