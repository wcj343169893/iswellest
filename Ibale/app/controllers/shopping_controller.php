<?php
class ShoppingController extends AppController {
    var $name       = "Shopping";
    var $uses       = array('Product', 'StockInfo', 'Order', 'CustomerPoint', 'Address', 'GroupBuy', 'Coupon', 'ProductSold', 'SaleRule', 'OrderPay', 'Member', 'Postage', 'PriceType');
    var $components = array('Cookie', 'PageSetting', 'ConfigIni', 'Alipay', 'Email');
    var $helpers    = array('AppSession', 'Number');

    function beforeFilter() {
        $this->AppAuth->allowedActions = array(
                                                'product_info_list',
                                                'ajax_add_to_bag',
                                                'bag',
                                                'delete_cart',
                                                'payment',
                                                'post_to_alipay',
                                                'ajax_check_stock',
                                                'ajax_add_to_payment',
                                                'ajax_to_payment',
                                                'cached_recommend_product',
                                                'confirm',
                                                'create_order',
                                                'complete',
                                                'get_shopping_product_count',
        );
        parent::beforeFilter();
    }

    /**
     * ショッピングカート画面
     */
    function bag() {
        $this->layout = 'front';

        //送料無料ライン
        $priceTypeFreeInfo = $this->PriceType->getInfoByType(PRICE_TYPE_FREE);
        $this->set('priceTypeFreeInfo', $priceTypeFreeInfo);

        //前回で選択したおまけ商品
        $sBonusProductInfoList = $this->Session->check('Shopping.data.bonus_product_info_list')?$this->Session->read('Shopping.data.bonus_product_info_list'):array();
        $sBonusByPrice         = $this->Session->check('Shopping.data.bonus_product_info_by_price')?$this->Session->read('Shopping.data.bonus_product_info_by_price'):array();
        $this->Session->delete('Shopping.omsOrder');
        $this->Session->delete('Shopping.data');
        $giftInfo = $this->Cookie->read('GiftInfo');
        if (empty($giftInfo) && !empty($this->params['named']['sale_method']) && $this->params['named']['sale_method'] == SALE_METHOD_GIFT) {
            //$this->redirect(HTTPS_HOME_PAGE_URL.'/shopping/bag');
            $this->set('giftInfo', true);
            $this->render('bag');
            return;
        }
        elseif (!empty($giftInfo) && !empty($this->params['named']['sale_method']) && $this->params['named']['sale_method'] == SALE_METHOD_GIFT) {
            $this->data['Shopping']['sale_method'] = SALE_METHOD_GIFT;
            //$this->data['Shopping']['charge_type'] = CHARGE_TYPE_ALIPAY;
            //$this->Session->write('Shopping.data.sale_method', SALE_METHOD_GIFT);
            $this->set('giftInfo', $giftInfo);
            $this->Session->write('Shopping.giftInfo', $giftInfo);
            $bag = $this->Cookie->read(removeUnderLineFromWords(SALE_METHOD_GIFT).'ShoppingBag');
            $this->data['Shopping']['bag_referer'] = HTTPS_HOME_PAGE_URL.'/shopping/bag/sale_method:'.SALE_METHOD_GIFT;
        }
        //共同購入の場合
        elseif (!empty($this->params['named']['sale_method']) && $this->params['named']['sale_method'] == SALE_METHOD_GROUP_BUY) {
            //$this->Session->write('Shopping.data.sale_method', SALE_METHOD_GROUP_BUY);
            $this->data['Shopping']['bag_referer'] = HTTPS_HOME_PAGE_URL.'/shopping/bag/sale_method:'.SALE_METHOD_GROUP_BUY;
            $this->data['Shopping']['sale_method'] = SALE_METHOD_GROUP_BUY;
            $bag = $this->Cookie->read(removeUnderLineFromWords(SALE_METHOD_GROUP_BUY).'ShoppingBag');
        }
        //第三者支払い場合
        elseif (!empty($this->params['named']['sale_method']) && $this->params['named']['sale_method'] == PAY_METHOD_PAID_BY_OTHER) {
            //$this->Session->write('Shopping.data.sale_method', SALE_METHOD_NORMAL);
            $this->data['Shopping']['sale_method'] = SALE_METHOD_PAID_BY_OTHER;
            $this->data['Shopping']['payself'] = ACTIVE_FLG_FALSE;
            $this->data['Shopping']['bag_referer'] = HTTPS_HOME_PAGE_URL.'/shopping/bag/sale_method:'.SALE_METHOD_PAID_BY_OTHER;
            $bag = $this->Cookie->read(removeUnderLineFromWords(SALE_METHOD_PAID_BY_OTHER).'ShoppingBag');
        }
        //普通商品の場合
        else {
            //$this->Session->write('Shopping.data.sale_method', SALE_METHOD_NORMAL);
            $this->data['Shopping']['sale_method'] = SALE_METHOD_NORMAL;
            $bag = $this->Cookie->read(removeUnderLineFromWords(SALE_METHOD_NORMAL).'ShoppingBag');
        }

        //$bag = json_decode($bag);
        if (empty($this->data['Shopping']['product_info_list'])) {
            $this->data['Shopping']['product_info_list'] = $bag;
        }
        //カートに商品情報がない場合
        if (empty($bag) || $bag == '[]') {
            $this->data['Shopping']['product_info_list'] = array();
            $this->render('bag');
            return;
        }

        //商品番号を取得
        $productCds = array();
        foreach($bag as $key => $value) {
            $productCds[] = $value['product_cd'];
        }
        //商品情報を取得
        $productInfos = $this->Product->getSimpleInfo($productCds);
        $totalPrice = 0;
        foreach($bag as $key => $value) {
            $this->PageSetting->loadSalePrice($this->data['Shopping']['product_info_list'][$key], $productInfos[$value['product_cd']]['Product']);
            $totalPrice += $this->data['Shopping']['product_info_list'][$key]['sale_price']*$this->data['Shopping']['product_info_list'][$key]['order_amount']; 
        }

        $this->set('productInfos', $productInfos);

        //おまけ商品を取得
        $this->Product->getOmakeProductInfo($productInfos, $bonusProductInfos);
        $this->set('bonusProductList', $bonusProductInfos);
        if (!empty($sBonusProductInfoList)) {
            $keys = array_keys($bonusProductInfos);
            $this->data['Shopping']['bonus_product_info_list'] = array();
            foreach($sBonusProductInfoList as $key => $value) {
                if (isset($bonusProductInfos[$value['product_cd_bonus']][$value['product_cd']])) {
                    //$index = array_search($value['product_cd_bonus'], $keys);
                    $this->data['Shopping']['bonus_product_info_list'][$key] = $value;
                }
            }
            $this->Session->write('Shopping.data.bonus_product_info_list' , $this->data['Shopping']['bonus_product_info_list']);
        }

        //価格合計よりおまけ商品情報を取得
        $priceTypeList  = $this->PriceType->getBonusTypeList();
        $this->set('priceTypeList', $priceTypeList);
        $bonusByPrice = array();
        if ($this->Session->check($this->AppAuth->sessionKey)) {
            $bonusType = null;
            foreach($priceTypeList as $key => $value) {
                if ($value['PriceType']['price'] < $totalPrice) {
                    $bonusType = $value['PriceType']['price_type'];
                    $bonusPrice = $value['PriceType']['price'];
                }
            }
            $this->set('bonusType', $bonusType);
            $this->set('bonusPrice', $bonusPrice);
            $this->Product->getOmakeProductByTotalPrice($bonusType, $bonusByPrice);
            $this->set('bonusByPrice', $bonusByPrice);
            if (isset($sBonusByPrice['product_cd']) && !empty($bonusByPrice[$sBonusByPrice['product_cd']])) {
                $this->data['Shopping']['bonus_product_info_by_price'] = $sBonusByPrice;
                $this->Session->write('Shopping.data.bonus_product_info_by_price' , $sBonusByPrice);
            } else {
                $this->Session->delete('Shopping.data.bonus_product_info_by_price');
            }
        }

        //在庫数チェック
        $ret = $this->__checkStockInfo($productCds, $bag, $productInfos);
        $this->set('stockIsNotEnough', !$ret);

        $this->Session->write('Shopping.data.product_cds'       , $productCds);
        $this->Session->write('Shopping.data.product_info_list' , $this->data['Shopping']['product_info_list']);
        $this->Session->write('Shopping.productInfos'           , $productInfos);
        $this->Session->write('Shopping.bonusProductInfos'      , $bonusProductInfos);
        $this->Session->write('Shopping.bonusProductInfoByPrice' , $bonusByPrice);

        //セール情報を取得
        $this->SaleRule->getListByProduct($productCds, $saleRuleList);
        $this->set('saleRuleList', $saleRuleList);

        $this->render('bag');
    }

    /**
     * 支払画面へ遷移するときの処理を行う
     */
    function ajax_to_payment() {
        $this->layout = 'ajax';
        $this->handleInputEmpty(HTTPS_HOME_PAGE_URL.'/shopping/bag');

        //分割フラグ
        $this->data['Shopping']['wish_to_divide'] = isset($this->data['Shopping']['wish_to_divide'])?$this->data['Shopping']['wish_to_divide']:ACTIVE_FLG_FALSE;
        $this->__loadSessionData();

        //購入件数が"０"件の場合
        $totalCount = 0;
        $totalPrice = 0;
        $productInfos = $this->Session->read('Shopping.productInfos');
        foreach($this->data['Shopping']['product_info_list'] as $key => $value) {
            if ($value['order_amount'] == '0') {
                unset($this->data['Shopping']['product_info_list'][$key]);
                unset($this->data['Shopping']['product_cds'][$key]);
                unset($productInfos[$value['product_cd']]);
                continue;
            }
            $totalPrice += $value['sale_price']*$value['order_amount'];
            $totalCount += $value['order_amount'];
        }
        relocateArrKey($this->data['Shopping']['product_info_list']);
        relocateArrKey($this->data['Shopping']['bonus_product_info_list']);
        relocateArrKey($this->data['Shopping']['product_cds']);

        //COOKIEにカート商品を保存
        $this->Cookie->write(removeUnderLineFromWords($this->data['Shopping']['sale_method']).'ShoppingBag', json_encode($this->data['Shopping']['product_info_list']), true, SHOPPING_BAG_CACHED_DURATION);
        $this->Session->write('Shopping.data', $this->data['Shopping']);
        $this->Session->write('Shopping.productInfos', $productInfos);

        //商品情報を取得
        $this->set('productInfos', $productInfos);

        //在庫数チェック
        $ret = $this->__checkStockInfo($this->data['Shopping']['product_cds'], $this->data['Shopping']['product_info_list'], $productInfos);

        //おまけ商品のチェック
        if (!empty($this->data['Shopping']['bonus_product_info_list'])) {
            $sBonusProductInfos = $this->Session->read('Shopping.bonusProductInfos');
            $bonusProductCds = array();
            $bonusProductInfos = array();
            foreach($this->data['Shopping']['bonus_product_info_list'] as $key => $value) {
                $bonusProductCds[$key] = $value['product_cd'];
                $bonusProductInfos[$value['product_cd']] = $sBonusProductInfos[$value['product_cd_bonus']][$value['product_cd']];
            }
            $ret &= $this->__checkStockInfo($bonusProductCds, $this->data['Shopping']['bonus_product_info_list'], $bonusProductInfos, true);

            $this->set('bonusProductList', $sBonusProductInfos);
        }

        //価格合計よりのおまけ商品のチェック
        if (!empty($this->data['Shopping']['bonus_product_info_by_price'])) {
            $sBonusByPrice = $this->Session->read('Shopping.bonusProductInfoByPrice');
            $bonusProductCds = array();
            $bonusProductInfos = array();
            $productCd = $this->data['Shopping']['bonus_product_info_by_price']['product_cd'];
            $bonusProductCds[] = $productCd;
            $bonusProductInfos[$productCd] = $sBonusByPrice[$productCd];
            $ret &= $this->__checkStockInfo($bonusProductCds, $this->data['Shopping']['bonus_product_info_by_price'], $bonusProductInfos, true, true);
            $this->set('bonusProductList', $sBonusProductInfos);

            $priceTypeList  = $this->PriceType->getBonusTypeList();
            $this->set('priceTypeList', $priceTypeList);
            if ($this->Session->check($this->AppAuth->sessionKey)) {
                $bonusType = null;
                foreach($priceTypeList as $key => $value) {
                    if ($value['PriceType']['price'] < $totalPrice) {
                        $bonusType = $value['PriceType']['price_type'];
                        $bonusPrice = $value['PriceType']['price'];
                    }
                }
                $this->set('bonusType', $bonusType);
                $this->set('bonusPrice', $bonusPrice);
            }
        }
        
        $this->set('stockIsNotEnough', !$ret);
        if (!$ret) {
            $this->render('/elements/shopping/cart_list');
            return;
        }

        //購入件数合計が"０"の場合
        if (empty($totalCount)) {
            $this->render('/elements/shopping/cart_list');
            return;
        }

        //購入商品が普通商品の場合
        if (!$this->Session->check($this->AppAuth->sessionKey) && $this->Session->read('Shopping.data.sale_method') != SALE_METHOD_GIFT) {
            //$this->Session->write('Auth.redirect', HTTPS_HOME_PAGE_URL.'/shopping/bag/');
            //$this->Session->write('Auth.redirect', HTTPS_HOME_PAGE_URL.'/shopping/payment/');
            $this->Session->write('Auth.redirect', HTTPS_HOME_PAGE_URL.'/shopping/confirm/');
            $this->set('dispLogin', ACTIVE_FLG_TRUE);
        } elseif (!empty($this->data['Shopping']['mode']) && $this->data['Shopping']['mode'] == 'reload') {
            //$this->set('redirectUrl', HTTPS_HOME_PAGE_URL.'/shopping/bag/');
            //$this->Session->write('Auth.redirect', HTTPS_HOME_PAGE_URL.'/shopping/payment/');
            $this->Session->write('Auth.redirect', HTTPS_HOME_PAGE_URL.'/shopping/confirm/');
        } else {//購入商品がギフトの場合
            //$this->set('redirectUrl', HTTPS_HOME_PAGE_URL.'/shopping/payment/');
            $this->set('redirectUrl', HTTPS_HOME_PAGE_URL.'/shopping/confirm/');
        }

        $this->render('/elements/shopping/cart_list');
        return;
    }

    /**
     * 決済画面
     */
    function payment() {
        $this->layout = 'front';
outputLog($this->data);
        if (!empty($this->data['Shopping']['back_to_payment'])) {
            $this->__loadConfirmData();
        }
        $this->__handleSessionData();
        $this->__renderPayment();
    }

    function ajax_reload_payment() {
        $this->layout = 'ajax';

        $this->__handleSessionData();
        $this->__renderPayment();
    }

    /**
     * 確認画面
     */
    function confirm() {
        $this->layout = 'front';
        if (!empty($this->params['named'])) {
            //URLをチェック
            $this->__loadConfirmDataByUrl();
            $this->render('confirm');
            return;
        } elseif (!empty($this->data['Shopping'])) {
            $this->__handleSessionData();
            //$this->handleInputEmpty(HTTPS_HOME_PAGE_URL.'/shopping/bag');
            if (!$this->Session->check('Shopping.data')) {
                $this->redirect(HTTPS_HOME_PAGE_URL.'/shopping/bag');
                return;
            }
            $this->__loadSessionData();
        } else {
            $this->__loadConfirmDataByLastOrder();
        }

        $ret = $this->__loadOrderInfo();
        if (!$ret) {
            $this->action = 'payment';
            $this->render('payment');
            return;
        }

        //ギフト情報を取得
        $productInfoList = $this->viewVars['productInfoList'];
        $giftProductCds = array();
        foreach($productInfoList as $key => $value) {
            if (empty($value['Product']['give_bonus_type'])) {
                continue;
            }
            $productCds = objectToArray(json_decode($value['Product']['give_bonus_type']));
            foreach($productCds as $value) {
                if (!in_array($value, $giftProductCds)) {
                    $giftProductCds[] = $value;
                }
            }
        }
        $giftProductList = $this->Product->getSimpleInfo($giftProductCds);
        $this->Session->write('Shopping.giftProductInfos', $giftProductList);
        $this->set('giftProductList', $giftProductList);

        $this->render('confirm');
    }

    /**
     * 注文を更新
     */
    function create_order() {
        $this->layout = 'front';
        $orderInfo = $this->Session->read('Shopping.omsOrder');
        if (empty($orderInfo)) {
            $this->redirect(HTTPS_HOME_PAGE_URL.'/shopping/bag');
            return;
        }

        $this->__loadSessionData();

        $this->__saveOrder($orderInfo);
        $this->data['Shopping']['order_no']  = $orderInfo['order_no'];
        $this->data['Shopping']['member_id'] = $orderInfo['customer_id'];

        //共同購入の場合
        if ($this->Session->read('Shopping.data.sale_method') == SALE_METHOD_GROUP_BUY) {
            $bag = $this->Cookie->read(removeUnderLineFromWords(SALE_METHOD_GROUP_BUY).'ShoppingBag');
            $id = $bag[0]['id'];
            $this->GroupBuy->updateSoldNumber($id, $orderInfo['orders'][0]['product_info_list'][0]['order_amount']);
            $this->Order->setShipStop($orderInfo);
        }

        //購入商品はCOOKIEから削除
        $giftInfo = $this->Session->read('Shopping.giftInfo');
        $saleMethod = removeUnderLineFromWords($this->data['Shopping']['sale_method']);
        $this->Cookie->delete($saleMethod.'ShoppingBag');
        $this->Session->delete('Shopping'); 
        $this->Session->delete('Front.Order.List');

        //メールに表示なURL
        $hashCode = md5($orderInfo['order_no'].$orderInfo['customer_id'].$this->Session->read($this->AppAuth->sessionKey.'.email')); 
        $url      = HTTPS_HOME_PAGE_URL."/shopping/confirm/order_no:{$orderInfo['order_no']}/customer_id:{$orderInfo['customer_id']}/hash:{$hashCode}";

        $this->Session->write('Shopping.view.order_info', $orderInfo);

        $orderInfo['ordered_subtotal'] = floatval($orderInfo['ordered_subtotal']);

        if (!empty($giftInfo) && $this->data['Shopping']['sale_method'] == SALE_METHOD_GIFT) { //ギフトの場合
            //ギフト情報はCOOKIEから削除
            $this->Cookie->delete('GiftInfo');
            $this->Session->delete('Shopping.giftInfo');

            $this->Session->write('Shopping.view.pay_person_email', $giftInfo['email']);
            $this->Session->write('Shopping.view.receive_person_email', $this->data['Shopping']['receive_person_email']);

            //届け情報を保存
            //$this->data['Shopping']['name'] = $this->data['Shopping']['receive_person_name'];
            //$this->data['Shopping']['email'] = $this->data['Shopping']['receive_person_email'];
            $this->OrderPay->save($this->data['Shopping']);

            //メールに表示なURL
            $hashCode = md5($orderInfo['order_no'].$orderInfo['customer_id'].$giftInfo['email']); 
            $url      = HTTPS_HOME_PAGE_URL."/shopping/confirm/order_no:{$orderInfo['order_no']}/customer_id:{$orderInfo['customer_id']}/hash:{$hashCode}";

            //ギフト選択者のメールへ送信
            $this->__sendMailForChoosedGiftToReceiver($giftInfo);
            //ギフト支払者のメールへ送信
            $this->__sendMailForChoosedGiftToPayer($giftInfo, $url);
        }
        //自分で支払い場合
        elseif ($this->data['Shopping']['charge_type'] == CHARGE_TYPE_ALIPAY && $this->data['Shopping']['payself'] == ACTIVE_FLG_TRUE && $orderInfo['ordered_subtotal'] > 0) {
            //会員へ注文受付メールを送信
            $this->__sendMailForCreateOrderToPayerAlipay($orderInfo);
            //ALIPAY支払画面へ遷移
            $this->Alipay->post_to_alipay($orderInfo);
            return;
        }
        //考验TAの場合
        elseif ($this->data['Shopping']['sale_method'] == SALE_METHOD_PAID_BY_OTHER) {
            //第三者支払情報を保存
            $this->OrderPay->save($this->data['Shopping']);

            //第三者支払人メールアドレスに注文情報を送付
            $this->__sendMailForCreateOrderToPayerKao($orderInfo, $url);
        }
        //第三者支払の場合
        elseif ($this->data['Shopping']['charge_type'] == CHARGE_TYPE_ALIPAY && $this->data['Shopping']['payself'] == ACTIVE_FLG_FALSE) {
            //第三者支払情報を保存
            $this->OrderPay->save($this->data['Shopping']);

            //第三者支払人メールアドレスに注文情報を送付
            $this->__sendMailForCreateOrderToPayerOther($orderInfo, $url);
        }
        //支払方法が代引きの場合
        elseif ($this->data['Shopping']['charge_type'] == CHARGE_TYPE_COD || empty($orderInfo['ordered_subtotal'])) {
            //対象会員へ注文受付完了メールを送信
            $this->__sendMailForCreateOrderToPayerCod($orderInfo);
        }

        $orderNos = array();
        foreach($orderInfo['orders'] as $key => $value) {
            $orderNos[] = mergeOrderNo($orderInfo['order_no'], $value['record_num']);
        }
        $this->Session->write('Shopping.view.order_info', $orderInfo);

        $this->redirect(HTTPS_HOME_PAGE_URL.'/shopping/complete');
    }

    /**
     * ALIPAY画面へ遷移
     */
    function post_to_alipay() {
        if (!empty($this->params['named']['order_no'])) {
            $orderInfo = $this->Order->getInfo($this->Session->read($this->AppAuth->sessionKey.'.id'), $this->params['named']['order_no']);
        } else {
            $orderInfo = $this->Session->read('Shopping.omsOrder');
        }
        $this->Session->write('Shopping.view.order_info', $orderInfo);
        $this->Alipay->post_to_alipay($orderInfo);
    }

    /**
     * 注文作成完了
     */
    function complete() {
        $this->layout = 'front';

        if (!$this->Session->check('Shopping.view.order_info')) {
            $this->redirect(HTTP_HOME_PAGE_URL);
            return;
        }

        $orderInfo = $this->Session->read('Shopping.view.order_info');
        $shippingChargeTotal = 0;
        foreach($orderInfo['orders'] as $key => $order) {
            $shippingChargeTotal += $order['shipping_charge'];
            foreach($order['product_info_list'] as $k => $product) {
                $productCds[] = $product['product_cd'];
            }
        }
        $orderInfo['shipping_charge'] = $shippingChargeTotal;

        //商品に対するカテゴリIDを取得
        $categoryProductRelModel = ClassRegistry::init('CategoryProductRel');
        $categoryProductRels = $categoryProductRelModel->getCategoryByProductCd($productCds);
        foreach($orderInfo['orders'] as $key => $order) {
            foreach($order['product_info_list'] as $k => $product) {
                if (!isset($categoryProductRels[$product['product_cd']])) {
                    $orderInfo['orders'][$key]['product_info_list'][$k]['category_id'] = '';
                    continue;
                }
                $categoryId = $categoryProductRels[$product['product_cd']][0]['Category']['id'];
                foreach($categoryProductRels[$product['product_cd']] as $value) {
                    if (empty($value['Category']['parent_id'])) {
                        $categoryId = $value['Category']['id'];
                        break;
                    }
                }
                $orderInfo['orders'][$key]['product_info_list'][$k]['category_id'] = $categoryId;
            }
        }

        $orderInfo['shippingCharge'] = $shippingChargeTotal;
        $this->set('orderInfo', $orderInfo);
        $this->Session->delete('Shopping.view.order_info');

        $this->render('complete');
    }

    /**
     * カート情報を削除
     */
    function delete_cart() {
        $this->handleInputEmpty(HTTPS_HOME_PAGE_URL.'/shopping/bag');

        if (!isset($this->data['Shopping']['id'])) {
            $this->redirect(HTTPS_HOME_PAGE_URL.'/shopping/bag');
            return;
        }
        $key = $this->data['Shopping']['id'];
        $saleMethod = removeUnderLineFromWords($this->data['Shopping']['sale_method']);
        $bag = $this->Cookie->read($saleMethod.'ShoppingBag');
        unset($bag[$key]);
        relocateArrKey($bag);

        //カート情報をCOOKIEに保存
        $this->Cookie->write($saleMethod.'ShoppingBag', json_encode($bag), true, SHOPPING_BAG_CACHED_DURATION);
        $this->Session->delete('Shopping.data.bonus_product_info_list.'.$key);

        $this->redirect(HTTPS_HOME_PAGE_URL.'/shopping/bag/sale_method:'.$this->data['Shopping']['sale_method']);
    }

    /**
     * 商品詳細画面でカート情報を更新
     */
    function ajax_add_to_bag() {
        $this->layout = 'ajax';
        $ret = $this->__addToBag();

        $giftInfo = $this->Cookie->read('GiftInfo');
        if (!empty($giftInfo) && !empty($this->params['url']['sale_method']) && $this->params['url']['sale_method'] == SALE_METHOD_GIFT) {
            //$this->set('redirectUrl', HTTPS_HOME_PAGE_URL.'/shopping/bag/sale_method:'.SALE_METHOD_GIFT);
            //$this->set('giftFlg', true);
            $this->render('/elements/product/shopping_bag');
        } elseif ($ret && !empty($this->params['url']['sale_method']) && $this->params['url']['sale_method'] == SALE_METHOD_GROUP_BUY) {
            $this->set('redirectUrl', HTTPS_HOME_PAGE_URL.'/shopping/bag/sale_method:'.SALE_METHOD_GROUP_BUY);
            $this->render('/elements/product/shopping_bag');
        } elseif ($ret && !empty($this->params['url']['sale_method']) && $this->params['url']['sale_method'] == SALE_METHOD_PAID_BY_OTHER) {
            $this->set('redirectUrl', HTTPS_HOME_PAGE_URL.'/shopping/bag/sale_method:paid_by_other');
            $this->render('/elements/product/shopping_bag');
        } else if ($ret){
            $referer = !empty($this->params['url']['referer'])?$this->params['url']['referer']:'product';
            $this->render("/elements/{$referer}/shopping_bag");
        }
    }

    /**
     * 詳細画面でカート情報を更新し、カート画面へ遷移
     */
    function ajax_add_to_payment() {
        $this->layout = 'ajax';

        $ret = $this->__addToBag();
        if (!$ret) {
            //$this->render("/elements/product/shopping_bag");
            return;
        }

        /**
        if (!$this->Session->check($this->AppAuth->sessionKey)) {
            $this->Session->write('Auth.redirect', HTTPS_HOME_PAGE_URL.'/shopping/bag/');
            $this->render('/elements/member/login');
            return;
        } else {
            $this->set('redirectUrl', HTTPS_HOME_PAGE_URL.'/shopping/bag/');
            $this->render('/elements/product/shopping_bag');
            return;
        }
        */
        $giftInfo = $this->Cookie->read('GiftInfo');
        if (!empty($giftInfo) && !empty($this->params['url']['sale_method']) && $this->params['url']['sale_method'] == SALE_METHOD_GIFT) {
            $this->set('redirectUrl', HTTPS_HOME_PAGE_URL.'/shopping/bag/sale_method:'.SALE_METHOD_GIFT);
        } elseif (!empty($this->params['url']['sale_method']) && $this->params['url']['sale_method'] == SALE_METHOD_GROUP_BUY) {
            $this->set('redirectUrl', HTTPS_HOME_PAGE_URL.'/shopping/bag/sale_method:'.SALE_METHOD_GROUP_BUY);
        } elseif (!empty($this->params['url']['sale_method']) && $this->params['url']['sale_method'] == SALE_METHOD_PAID_BY_OTHER) {
            $this->set('redirectUrl', HTTPS_HOME_PAGE_URL.'/shopping/bag/sale_method:paid_by_other');
        } else {
            $this->set('redirectUrl', HTTPS_HOME_PAGE_URL.'/shopping/bag/');
        }
        $this->render('/elements/product/shopping_bag');
        return;
    }

    /**
     * 在庫数をチェック
     */
    function ajax_check_stock() {
        $this->layout = 'ajax';

        if (empty($this->params['url']['product_cd']) || empty($this->params['url']['order_amount'])) {
            exit();
        }

        $productCd = $this->params['url']['product_cd'];
        $productCds   = array($productCd);
        $bags  = array(array('order_amount' => $this->params['url']['order_amount']));
        $productInfos = array($productCd => $this->Product->getInfo($productCd));
        $ret = $this->__checkStockInfo($productCds, $bags, $productInfos);
        if (!$ret) {
            echo $this->Session->read('Message.productStockNotEnough0.message');
            $this->Session->delete('Message.productStockNotEnough0.message');
        }
        exit();
    }

    /**
     * レコメンド商品情報を取得
     * @return multitype:
     */
    function cached_recommend_product() {
        $ret = array();
        if (!$this->Session->check('Shopping.data.product_info_list')) {
            return $ret;
        }

        $params = $this->Session->read('Shopping.data.product_info_list');
        $productCds = $this->Product->getRelationProduct($params);
        $this->CommFuncs->loadProductBlock($productCds, $ret);
        return $ret;
    }

    function get_shopping_product_count() {
        $bag = $this->Cookie->read(removeUnderLineFromWords(SALE_METHOD_NORMAL).'ShoppingBag');
        $totalCount = 0;
        if (empty($bag) || $bag == '[]') {
            echo $totalCount;
            return;
        }

        foreach($bag as $product) {
            $totalCount += $product['order_amount'];
        }
        echo $totalCount;
    }

    function __addToBag() {
        if (empty($this->params['url']['product_cd']) || empty($this->params['url']['order_amount'])) {
            exit();
        }
        $productCd   = $this->params['url']['product_cd'];
        $orderCount  = $this->params['url']['order_amount'];
        $giftFlg     = (!empty($this->params['url']['sale_method']) && $this->params['url']['sale_method'] == SALE_METHOD_GIFT)?true:false;
        $productInfo = $this->Product->getInfo($productCd);
        if (empty($productInfo)) {
            exit();
        }

        $giftInfo = $this->Cookie->read('GiftInfo');
        //ギフトの場合
        if ($giftFlg && is_array($giftInfo) && in_array($productCd, $giftInfo['product_cd'])) {
            $ret = $this->__addToBagNormal($productInfo, removeUnderLineFromWords(SALE_METHOD_GIFT));
            $this->set('giftFlg', true);
        } elseif (!empty($this->params['url']['sale_method']) && $this->params['url']['sale_method'] == SALE_METHOD_GROUP_BUY) {//共同購入の場合
            $ret = $this->__addToBagByMode(removeUnderLineFromWords(SALE_METHOD_GROUP_BUY), $productInfo);
        } elseif (!empty($this->params['url']['sale_method']) && $this->params['url']['sale_method'] == PAY_METHOD_PAID_BY_OTHER) {//第三者支払い場合
            $ret = $this->__addToBagByMode(removeUnderLineFromWords(SALE_METHOD_PAID_BY_OTHER), $productInfo);
        } else { //普通商品の場合
            $ret = $this->__addToBagNormal($productInfo);
        }
        if (!$ret) {
            return false;
        }

        return true;
    }

    function __addToBagByMode($mode, &$productInfo) {
        $productCd  = $this->params['url']['product_cd'];
        $orderCount = $this->params['url']['order_amount'];
        //共同購入の場合
        if ($mode == 'GroupBuying') {
            $id = $this->params['url']['id'];

            //共同購入情報を取得
            $rec = $this->GroupBuy->getInfo($id, '-1');
            //販売できない場合
            if (empty($rec) 
                    || $rec['GroupBuy']['end_time'] < date('Y-m-d H:i:s') 
                    || $rec['GroupBuy']['start_time'] > date('Y-m-d H:i:s')
                    || $rec['GroupBuy']['max_purchase_number'] == $rec['GroupBuy']['purchase_product_count']) {
                $this->Session->setFlash(__('error.productSaleStatusStop', true), 'default', null, 'productSaleStatusStop0');
                $this->render("/elements/product_bookmark/shopping_bag");
                return false;
            }
            $orderedProductInfo = array('id' => $id, 'product_cd' => $productCd, 'order_amount' => $orderCount);
        } else {
            $orderedProductInfo = array('product_cd' => $productCd, 'order_amount' => $orderCount);
        }

        //価格情報を取得
        $this->PageSetting->loadProductInfoByObj($orderedProductInfo, $productInfo);
        $bag = array();
        $bag[0] = $orderedProductInfo;
        $productCds   = array($productCd);
        $productInfos = array($productCd => $productInfo);
        $ret = $this->__checkStockInfo($productCds, $bag, $productInfos);
        if (!$ret) {
            $this->render("/elements/product_bookmark/shopping_bag");
            return false;
        }
        //カート情報をCOOKIEに保存
        $this->Cookie->write($mode.'ShoppingBag', json_encode($bag), true, SHOPPING_BAG_CACHED_DURATION);
        return true;
    }

    function __addToBagNormal(&$productInfo, $cookiePrefix = 'Normal') {
        $productCd   = $this->params['url']['product_cd'];
        $orderCount  = $this->params['url']['order_amount'];

        //COOKIEにカート情報を取得
        $bag = $this->Cookie->read($cookiePrefix.'ShoppingBag');
        $bag = ($bag == '[]')?array():$bag;
        $orderedFlg = false;
        $orderTotalCount = 0;
        $index = 0;
        if (!empty($bag)) {
            foreach($bag as $key => $value) {
                if ($value['product_cd'] == $productCd) {
                    $bag[$key]['order_amount'] += $orderCount;
                    $orderTotalCount            = $bag[$key]['order_amount'];
                    $orderedFlg                 = true;
                    $index = $key;
                    continue;
                }
            }
        }
        //カートに該当商品が存在しない場合
        if (!$orderedFlg) {
            $orderedProductInfo = array('product_cd' => $productCd, 'order_amount' => $orderCount);
            //価格情報を取得
            $this->PageSetting->loadProductInfoByObj($orderedProductInfo, $productInfo);
            $bag[] = $orderedProductInfo;
            $index = count($bag) -1;
        }
        $productCds   = array($productCd);
        $bags         = array($bag[$index]);
        $productInfos = array($productCd => $productInfo);
        $ret = $this->__checkStockInfo($productCds, $bags, $productInfos);
        if (!$ret) {
            $referer = !empty($this->params['url']['referer'])?$this->params['url']['referer']:'product';
            $this->render("/elements/{$referer}/shopping_bag");
            return false;
        }
        //カート情報をCOOKIEに保存
        $this->Cookie->write($cookiePrefix.'ShoppingBag', json_encode($bag), true, SHOPPING_BAG_CACHED_DURATION);
        //カートに商品件数と金額を計算
        $totalCount = 0;
        $totalPrice = 0;
        foreach($bag as $key => $value) {
            $price       = $value['order_amount'] * $value['sale_price'];
            $totalPrice += $price;
            $totalCount += $value['order_amount'];
        }
        $this->set('totalCount', $totalCount);
        $this->set('totalPrice', $totalPrice);

        return true;
    }

    /**
     * 在庫数をチェック
     * @param unknown_type $productCds
     * @param unknown_type $bags
     * @param unknown_type $productInfos
     * @return boolean
     */
    function __checkStockInfo(&$productCds, &$bags, &$productInfos, $bonusFlg = false, $bonusByPrice = false) {
        $valid    = true;
        $pubFlg   = ($bonusFlg)?false:true;
        $bonusSuf = '';
        if ($bonusFlg && $bonusByPrice) {
            $bonusSuf = 'BonusByPrice';
        } elseif ($bonusFlg) {
            $bonusSuf = 'Bonus';
        }

        //購入できるセール状態
        $allowedSalesStatus = array(
                                    PRODUCT_SALES_STATUS_NORMAL,           //通常
                                    PRODUCT_SALES_STATUS_STOCK_ONLY,       //売切
                                    PRODUCT_SALES_STATUS_WILL_END_SELLING, //売切終売
                                    //PRODUCT_SALES_STATUS_WAIT_ARRIVAL,     //入荷待ち
                                    //PRODUCT_SALES_STATUS_END_SELLING,      //終売
        );
        //在庫数情報を取得
        $stockInfos = $this->StockInfo->getInfo($productCds);
        //最大購入金額
        $maxTotalPrice = $this->ConfigIni->getConfigValue('shopping', 'max_order_price');
        //ギフト購入金額上限
        $giftInfo = $this->Cookie->read('GiftInfo');
        $maxTotalPrice = ($maxTotalPrice < $giftInfo['max_price'] || empty($giftInfo['max_price']))?$maxTotalPrice:$giftInfo['max_price'];

        $totalPrice = 0;
        foreach($productCds as $key => $value) {
            if (isset($bags[$key]['sale_price'])) {
                //購入金額を計算
                $totalPrice += $bags[$key]['order_amount']*$bags[$key]['sale_price'];
            }
            //販売できない場合
            if (!in_array($productInfos[$value]['Product']['sales_status'], $allowedSalesStatus)) {
                $this->Session->setFlash(__('error.productSaleStatusStop', true), 'default', null, 'productStockNotEnough'.$bonusSuf.$key);
                $valid = false;
                continue;
            }

            //購入件数＞購入上限の場合
            if ($productInfos[$value]['Product']['order_limit_count'] != 0 
                    && $bags[$key]['order_amount'] > $productInfos[$value]['Product']['order_limit_count']) {
                $this->Session->setFlash(sprintf(__('error.orderCountOverflow', true), $productInfos[$value]['Product']['order_limit_count']), 'default', null, 'productStockNotEnough'.$bonusSuf.$key);
                $valid = false;
                continue;
            }
            //販売状態＝”通常” かつ 注文分割＝”許可” かつ 購入数量 > 在庫数 かつ 商品状態=NO_LIMIT
            if ($bags[$key]['order_amount'] > $stockInfos[$value] 
                    && $productInfos[$value]['Product']['sales_status'] == PRODUCT_SALES_STATUS_NORMAL
                    && in_array($productInfos[$value]['Product']['product_type'], array(PRODUCT_TYPE_NO_LIMIT, PRODUCT_TYPE_JIT))) {
                $this->set('enableDivide', true);
            }
            if ($bags[$key]['order_amount'] > $stockInfos[$value] 
                    && $productInfos[$value]['Product']['sales_status'] == PRODUCT_SALES_STATUS_NORMAL
                    && $productInfos[$value]['Product']['product_type'] == PRODUCT_TYPE_NO_LIMIT
                    && ((isset($this->data['Shopping']['wish_to_divide']) && $this->data['Shopping']['wish_to_divide'] == ACTIVE_FLG_TRUE) || !isset($this->data['Shopping']['wish_to_divide']))) {
                if ($this->action == 'ajax_to_payment' && !$bonusFlg) {
                    //$this->Session->setFlash(sprintf(__('error.productStockNotEnoughEnableBuy', true), ($bags[$key]['order_amount'] - $stockInfos[$value])), 'default', null, 'productStockNotEnough'.$bonusSuf.$key);
                } elseif (!$bonusFlg && !in_array($this->action, array('ajax_add_to_bag', 'ajax_add_to_payment', 'ajax_to_payment'))) {
                    $valid = false;
                    //$this->Session->setFlash(sprintf(__('error.productStockNotEnoughEnableBuy', true), ($bags[$key]['order_amount'] - $stockInfos[$value])), 'default', null, 'productStockNotEnough'.$bonusSuf.$key);
                }
                continue;
            }
            //購入数量 > 在庫数
            elseif ($bags[$key]['order_amount'] > $stockInfos[$value] 
                    && !($productInfos[$value]['Product']['sales_status'] == PRODUCT_SALES_STATUS_NORMAL
                            && in_array($productInfos[$value]['Product']['product_type'], array(PRODUCT_TYPE_NO_LIMIT, PRODUCT_TYPE_JIT)))) { 
                //$this->Session->setFlash(__('error.productSaleStatusStop', true), 'default', null, 'productSaleStatusStop'.$key);
                $this->Session->setFlash(sprintf(__('error.productStockNotEnoughDisableBuy'.$bonusSuf, true), ($bags[$key]['order_amount'] - $stockInfos[$value])), 'default', null, 'productStockNotEnough'.$bonusSuf.$key);
                $valid = false;
                continue;
            }
            //販売できることをチェック
            $subScriptStatus = $this->Product->getSubScriptionStatus($productInfos[$value]['Product']['product_cd']);
            $subStatus = isset($subScriptStatus[$productInfos[$value]['Product']['product_cd']])?$subScriptStatus[$productInfos[$value]['Product']['product_cd']]['subscription_status']:false;
            $ret = $this->Product->enableSale($productInfos[$value], $stockInfos[$value], $pubFlg, false, $subStatus);
            if (!$ret) {
                $this->Session->setFlash(sprintf(__('error.productStopSale', true), ($bags[$key]['order_amount'] - $stockInfos[$value])), 'default', null, 'productStockNotEnough'.$bonusSuf.$key);
                $valid = false;
            }
        }
        //注文金額合計
        $this->Session->write('Shopping.data.totalPrice', $totalPrice);
        //購入限度額を超過している場合
        if ($totalPrice > $maxTotalPrice) {
            $this->Session->setFlash(sprintf(__('error.maxOrderPriceOverflow', true), number_format($maxTotalPrice, 0, '.', ',')), 'default', null, 'maxOrderPriceOverflow');
            $valid = false;
        }
        return $valid;
    }

    function __loadDefaultAddress() {
        //if (isset($this->data['Shopping']['shipto_zip']) && $this->data['Shopping']['sale_method'] == SALE_METHOD_GIFT) {
        if (isset($this->data['Shopping']['shipto_zip'])) {
            //郵便番号が不存在の場合
            $rec = $this->Postage->findByZipCode($this->data['Shopping']['shipto_zip']);
            if (empty($rec)) {
                $this->data['Shopping']['shipto_zip'] = null;
                $this->__loadSessionData();
            }

            return;
        }

        $addressList = $this->Session->read($this->AppAuth->sessionKey.'.sendto_addresses');
        if (empty($addressList)) {
            return;
        }
        //郵便番号が不存在の場合
        $rec = $this->Postage->findByZipCode($addressList[0]['zip']);
        if (empty($rec)) {
            return;
        }
        $this->data['Address'] = $addressList[0];
        $this->__loadShiptoAddress();
    }

    function __loadShiptoAddress() {
        $this->data['Shopping']['shipto_address1'] = isset($this->viewVars['areaList'][$this->data['Address']['address1']])?$this->viewVars['areaList'][$this->data['Address']['address1']]:'';
        $this->data['Shopping']['shipto_address2'] = isset($this->viewVars['areaList'][$this->data['Address']['address2']])?$this->viewVars['areaList'][$this->data['Address']['address2']]:$this->data['Address']['address2_other'];
        $this->data['Shopping']['shipto_address3'] = isset($this->viewVars['areaList'][$this->data['Address']['address3']])?$this->viewVars['areaList'][$this->data['Address']['address3']]:$this->data['Address']['address3_other'];
        $this->data['Shopping']['shipto_address4'] = $this->data['Address']['address4'];
        $this->data['Shopping']['shipto_zip'] = $this->data['Address']['zip'];

        $this->__loadSessionData();
    }

    function __loadOrderInfo() {
        //購入商品がギフトの場合
        if ($this->data['Shopping']['sale_method'] == SALE_METHOD_GIFT) {
            $this->set('giftInfo', $this->Session->read('Shopping.giftInfo'));
        }

        //if ($this->data['Shopping']['sale_method'] != SALE_METHOD_GIFT && !isset($this->data['Shopping']['address']))

        if ($this->data['Shopping']['sale_method'] == SALE_METHOD_GIFT && isset($this->data['Address'])) {
            //エリアリスト
            $this->CommFuncs->initAreaList('Address');
/**
            $this->data['Shopping']['shipto_address1'] = isset($this->viewVars['areaList'][$this->data['Address']['address1']])?$this->viewVars['areaList'][$this->data['Address']['address1']]:'';
            $this->data['Shopping']['shipto_address2'] = isset($this->viewVars['areaList'][$this->data['Address']['address2']])?$this->viewVars['areaList'][$this->data['Address']['address2']]:$this->data['Address']['address2_other'];
            $this->data['Shopping']['shipto_address3'] = isset($this->viewVars['areaList'][$this->data['Address']['address3']])?$this->viewVars['areaList'][$this->data['Address']['address3']]:$this->data['Address']['address3_other'];
 */
            $this->data['Shopping']['shipto_address1'] = $this->data['Address']['address1'];
            $this->data['Shopping']['shipto_address2'] = $this->data['Address']['address2'];
            $this->data['Shopping']['shipto_address3'] = $this->data['Address']['address3'];
            $this->data['Shopping']['shipto_address4'] = $this->data['Address']['address4'];
            $this->data['Shopping']['shipto_zip'] = $this->data['Address']['zip'];
            $this->Session->write('Shopping.data', $this->data['Shopping']);
        }

        //フォームデータを検証
        $valid = true;
        if ($this->data['Shopping']['sale_method'] == SALE_METHOD_GIFT) {
            $this->Address->invalidFields(array(), $this->data);
            $valid &= !empty($this->Address->validationErrors)?false:true;
        }
        if (!empty($this->data)) {
            $this->Order->invalidFields(array(), $this->data['Shopping']);
            $this->CommFuncs->validAddress('Address', 'Address');
            if (!empty($this->Order->validationErrors) || !empty($this->Address->validationErrors)) {
                $valid = false;
            }
        }
        //支払い方法が”代引き”の場合、代引き購入限度額を越していないか
        if ($this->Session->check('Shopping.data.totalPrice')) {
            $totalPrice = $this->Session->read('Shopping.data.totalPrice');
            $maxTotalPriceCod = $this->ConfigIni->getConfigValue('shopping', 'max_order_price_cod');
            if (isset($this->data['Shopping']['charge_type']) && $this->data['Shopping']['charge_type'] == CHARGE_TYPE_COD && $totalPrice > $maxTotalPriceCod) {
                $this->Session->setFlash(sprintf(__('error.maxOrderPriceOverflowCod', true), number_format($maxTotalPriceCod, 0, '.', ',')), 'default', null, 'maxOrderPriceOverflow');
                $valid = false;
            }
        }
        //クーポン情報に値が入力されている場合、対象クーポンが利用可能か。
        if (!empty($this->data['Shopping']['coupon_code']) && empty($this->Order->validationErrors['coupon_code'])) {
            $ret = $this->Coupon->getCouponStatus($this->data['Shopping']['coupon_code']);
            if (empty($ret) 
                    || !empty($ret['available_start_date']) && $ret['available_start_date'] > date('Y/m/d') 
                    || !empty($ret['available_end_date']) && $ret['available_end_date'] < date('Y/m/d')
                    || $ret['discount'] == 0
                    || $ret['remain'] == 0) {
                $this->Session->setFlash(__('error.couponInvalid', true), 'default', null, 'couponInvalid');
                $valid = false;
            }
        }

        //注文金額を取得
        $this->__calcOrder($orderInfo);
        if (!empty($orderInfo['orders'])) {
            $this->Session->write('Shopping.omsOrder', $orderInfo);
        } elseif ($this->Session->check('Shopping.omsOrder')) {
            $orderInfo = $this->Session->read('Shopping.omsOrder');
        } else {
            //$this->CakeError('error');
            //exit();
        }
        $this->set('orderInfo', $orderInfo);
        //商品情報を取得
        $this->set('productInfoList', $this->Session->read('Shopping.productInfos'));
        //セール情報を取得
        $this->SaleRule->getListByOrder($orderInfo, $saleRuleList);
        $this->set('saleRuleList', $saleRuleList);
        //送料無料ライン
        $priceTypeFreeInfo = $this->PriceType->getInfoByType(PRICE_TYPE_FREE);
        $this->set('priceTypeFreeInfo', $priceTypeFreeInfo);

        //ポイント
        $pointInfo = $this->CustomerPoint->getInfo($this->Session->read($this->AppAuth->sessionKey.'.id'));
        $this->set('pointInfo', $pointInfo);

        return $valid;
    }

    /**
     * 注文金額を計算
     * @return unknown
     */
    function __calcOrder(&$orderInfo = array()) {
        $order    = $this->Session->read('Shopping.data');
        $giftInfo = $this->Session->read('Shopping.giftInfo');

        $order['channel']           = CHANNEL_GOODS;
        $order['customer_id']       = $this->Session->check($this->AppAuth->sessionKey.'.id')?$this->Session->read($this->AppAuth->sessionKey.'.id'):$giftInfo['id'];
        $order['customer_rank']     = $this->Session->check($this->AppAuth->sessionKey.'.customer_rank')?$this->Session->read($this->AppAuth->sessionKey.'.customer_rank'):$giftInfo['customer_rank'];
        $order['order_type']        = ORDER_TYPE_SALE;
        $order['charge_type']       = !empty($order['charge_type'])?$order['charge_type']:CHARGE_TYPE_ALIPAY;
        $order['gift_type']         = !empty($order['gift_type'])?$order['gift_type']:GIFT_TYPE_NONE;
        $order['wish_to_divide']    = !empty($order['wish_to_divide'])?true:false;
        $order['fapiao_flg']        = !empty($order['fapiao_flg'])?true:false;
        //$order['shipping_charge']   = 0;
        //$order['gift_charge']       = 0;
        $order['point_used']        = !empty($order['point_used'])?intval($order['point_used']):0;
        $order['wish_to_use_point'] = !empty($order['point_used'])?true:false;

        $order['auto_fill_customer_rank']   = true;
        $order['auto_fill_price_and_point'] = true;
        $order['auto_fill_shipping_charge'] = true;
        $order['auto_fill_gift_charge']     = true;

        foreach($order['product_info_list'] as $key => $value) {
            if (!empty($value['bonus_flg'])) {
                unset($order['product_info_list'][$key]);
                continue;
            }
            $order['product_info_list'][$key]['product_cd']   = intval($value['product_cd']);
            $order['product_info_list'][$key]['order_amount'] = intval($value['order_amount']);
            $order['product_info_list'][$key]['bonus_flg']    = false;
            //$order['product_info_list'][$key]['price']        = floatval($value['sale_price']);
            //$order['product_info_list'][$key]['point']        = intval($value['point']);
            unset($order['product_info_list'][$key]['point']);

            //extradata
            $order['product_info_list'][$key]['extradata'] = '';
            if ($this->Session->check('Shopping.data.sale_method')) {
                $order['product_info_list'][$key]['extradata'] .= ';sale_method='.$this->Session->read('Shopping.data.sale_method');
            }
            if (isset($order['payself']) && $order['payself'] == ACTIVE_FLG_FALSE) {
                $order['product_info_list'][$key]['extradata'] .= ';pay_method='.PAY_METHOD_PAID_BY_OTHER;
            }
        }

        $index = $key;
        foreach($order['bonus_product_info_list'] as $key => $value) {
            $index++;
            $order['product_info_list'][$index]['product_cd']   = intval($value['product_cd']);
            $order['product_info_list'][$index]['order_amount'] = intval($value['order_amount']);
            $order['product_info_list'][$index]['bonus_flg']    = true;
            $order['product_info_list'][$index]['sale_price']   = 0;
            $order['product_info_list'][$index]['point']        = 0;
        }
        $index++;
        if (!empty($order['bonus_product_info_by_price'])) {
            $value = $order['bonus_product_info_by_price'];
            $order['product_info_list'][$index]['product_cd']   = intval($value['product_cd']);
            $order['product_info_list'][$index]['order_amount'] = intval($value['order_amount']);
            $order['product_info_list'][$index]['bonus_flg']    = true;
            $order['product_info_list'][$index]['sale_price']   = 0;
            $order['product_info_list'][$index]['point']        = 0;
        }
        relocateArrKey($order['product_info_list']);
outputLog($order);
        $ret = $this->Order->calcOrder($order);
outputLog($ret);
        if ($ret['error']['code'] == '100') {
            $this->Session->setFlash(__('error.couponInvalid', true), 'default', null, 'couponIsWrong');
        }
        if ($ret['error']['code'] == '114') {
            $this->Session->setFlash(__('error.pointInvalid', true), 'default', null, 'pointIsWrong');
        }

        $orderInfo = $ret['results'];
    }

    /**
     * 注文を保存
     * @param unknown_type $orderInfo
     */
    function __saveOrder(&$orderInfo) {
        $ret = array();

        $order = $this->Session->read('Shopping.data');
        $giftInfo = $this->Session->read('Shopping.giftInfo');
        $this->Order->convertRepToReqData($order, $orderInfo);

        $order['channel']           = CHANNEL_GOODS;
        $order['order_type']        = ORDER_TYPE_SALE;
        $order['shipto_zip'] = $this->data['Shopping']['shipto_zip'];
        //TODO:一時設定
        $order['priority'] = ORDER_PRIORITY_NORMAL;

        //ギフトが必要の場合
        if (!empty($this->data['Shopping']['need_gift_flg'])) {
            $giftProductList = $this->Session->read('Shopping.giftProductInfos');
            foreach($giftProductList as $key => $value) {
                $productInfo = array();
                $productInfo['product_cd']    = intval($value['Product']['product_cd']);
                $productInfo['product_name']  = $value['Product']['product_name'];
                $productInfo['point']         = 0;
                $productInfo['price']         = 0;
                $productInfo['order_amount']  = 0;
                $productInfo['bonus_flg']     = true;
                $order['product_info_list'][] = $productInfo;
            }
        }

        foreach($order['product_info_list'] as $key => $value) {
            //extradata
            $order['product_info_list'][$key]['extradata'] = '';
            if ($this->Session->check('Shopping.data.sale_method')) {
                $order['product_info_list'][$key]['extradata'] .= ';sale_method='.$this->Session->read('Shopping.data.sale_method');
            }
            if ($this->Session->read('Shopping.data.payself') == ACTIVE_FLG_FALSE) {
                $order['product_info_list'][$key]['extradata'] .= ';pay_method='.PAY_METHOD_PAID_BY_OTHER;
            }

            //販売実績登録処理
            $updateData['product_cd']  = $value['product_cd'];
            $updateData['sold_number'] = $value['order_amount'];
            $this->ProductSold->save($updateData);
        }
        //注文番号
        $order['order_no'] = $this->Order->generateOrderNo();
        $rec = $this->Order->save($order);
        if (!empty($rec)) {
            $orderInfo = $rec;
        } else {
            $this->CakeError('error');
            exit();
        }
    }

    function __loadSessionData() {
        $sessionData            = $this->Session->check('Shopping.data')?$this->Session->read('Shopping.data'):array();
        $this->data['Shopping'] = !empty($this->data['Shopping'])?$this->data['Shopping']:array();

        if (empty($sessionData) && empty($this->data['Shopping'])) {
            return;
        }

        mergeArray($sessionData, $this->data['Shopping']);

        $this->data['Shopping'] = $sessionData;
        if (isset($this->data['Shopping']['sale_method']) && ($this->data['Shopping']['sale_method'] == SALE_METHOD_GIFT || $this->data['Shopping']['sale_method'] == SALE_METHOD_PAID_BY_OTHER)) {
            $this->data['Shopping']['payself'] = ACTIVE_FLG_FALSE;
        }
        if (isset($this->data['Shopping']['charge_type']) && $this->data['Shopping']['charge_type'] == CHARGE_TYPE_COD) {
        }
        if (isset($this->data['Shopping']['charge_type']) && $this->data['Shopping']['charge_type'] == CHARGE_TYPE_COD) {
            unset($this->data['Shopping']['payself']);
            unset($this->data['Shopping']['pay_person_email']);
            unset($this->data['Shopping']['message_to_pay_person']);
        }
        if (isset($this->data['Shopping']['fapiao_flg']) && $this->data['Shopping']['fapiao_flg'] == ACTIVE_FLG_FALSE) {
            unset($this->data['Shopping']['fapiao_name']);
        }
        if (empty($this->data['Shopping']['gift_type_flg']) || isset($this->data['Shopping']['gift_type_flg']) && $this->data['Shopping']['gift_type_flg'] == ACTIVE_FLG_FALSE) {
            unset($this->data['Shopping']['gift_type']);
            unset($this->data['Shopping']['gift_charge']);
        }

        $this->Session->write('Shopping.data', $this->data['Shopping']);
    }

    function __renderPayment() {
        $this->__loadSessionData();

        //配送アドレスを初期化
        $this->__loadDefaultAddress();
/**
        //商品情報を再度取得
        $productCds = $this->Session->read('Shopping.data.product_cds');
        $this->data['Shopping']['product_info_list'] = $this->Session->read('Shopping.data.product_info_list');
        $productInfos = $this->Product->getSimpleInfo($productCds);
        foreach($this->data['Shopping']['product_info_list'] as $key => $value) {
            $this->PageSetting->loadSalePrice($this->data['Shopping']['product_info_list'][$key], $productInfos[$value['product_cd']]['Product']);
        }
        $this->Session->write('Shopping.data.product_info_list' , $this->data['Shopping']['product_info_list']);
*/
        //OMSから注文情報を取得
        $this->__loadOrderInfo();

        //購入商品がギフトの場合
        if ($this->Session->read('Shopping.data.sale_method') == SALE_METHOD_GIFT) {
            //エリアリスト
            $this->CommFuncs->initAreaList();
            $this->set('giftInfo', $this->Session->read('Shopping.giftInfo'));
        }
        $this->action = 'payment';
        $this->render('payment');
    }

    function __handleSessionData() {
        if (!$this->Session->check('Shopping.data')) {
            $this->redirect(HTTPS_HOME_PAGE_URL.'/shopping/bag');
            return;
        }
    }

    function __loadConfirmDataByUrl() {
        if (empty($this->params['named']['order_no']) 
                || empty($this->params['named']['customer_id'])
                || empty($this->params['named']['hash'])) {
            //$this->redirect(HTTP_HOME_PAGE_URL.'/member/mypage');
            $msg = "第三方支付的确认订单URL不正确（{$this->params['url']['url']}）";
            $this->log($msg, LOG_ERROR);
            exit();
        }

        /**
        if (!$this->Session->check($this->AppAuth->sessionKey)) {
            $this->Session->write('Auth.redirect', '/'.$this->params['url']['url']);
            $this->redirect(HTTPS_HOME_PAGE_URL.'/member/login');
            return;
        }
        */

        //$memberInfo = $this->Session->read($this->AppAuth->sessionKey);
        $memberInfo = $this->Member->getCustomerInfo($this->params['named']['customer_id']);
        $hashCode = md5($this->params['named']['order_no'].$this->params['named']['customer_id'].$memberInfo['email']);
        if ($hashCode != $this->params['named']['hash']) {
            //$this->redirect(HTTPS_HOME_PAGE_URL.'/member/mypage');
            $msg = "第三方支付的确认订单URL不正确（{$this->params['url']['url']}）";
            $this->log($msg, LOG_ERROR);
            $this->cakeError('error');
            exit();
        }

        $orderInfo = $this->Order->getInfo($memberInfo['id'], $this->params['named']['order_no']);
        //注文状態が"注文申請"ではない場合
        if ($orderInfo['orders'][0]['shipping_status'] != SHIPPING_STATUS_NOTCREDITED) {
            //$this->redirect(HTTPS_HOME_PAGE_URL.'/order/detail/order_no:'.$orderInfo['order_no']);
            $msg = "订单（{$orderInfo['order_no']}）的订单状态不是【订单申请】";
            $this->Session->setFlash(__('error.orderStatusIsNotNotCredited', true), 'default', null, 'orderPayDateExpired');
            $this->log($msg, LOG_ERROR);
            //$this->cakeError('error');
            //exit();
        }
        $this->Session->write('Shopping.omsOrder', $orderInfo);
        $this->set('orderInfo', $orderInfo);

        //届け情報を取得
        $orderPayInfo = $this->OrderPay->getInfo($orderInfo['customer_id'], $orderInfo['order_no']);
        if (empty($orderPayInfo)){
            //$this->redirect(HTTPS_HOME_PAGE_URL.'/member/mypage');
            $msg = "订单（{$orderInfo['order_no']}）的收件人信息不存在";
            $this->log($msg, LOG_ERROR);
            $this->cakeError('error');
            exit();
        }

        $this->data['Address']  = $orderPayInfo['OrderPay'];
        $this->data['Shopping'] = array_merge($orderInfo, $orderPayInfo['OrderPay']);
        $this->data['Shopping']['payself'] = ACTIVE_FLG_FALSE;

        //ギフトの場合
        if (stripos($orderInfo['orders'][0]['product_info_list'][0]['extradata'], 'sale_method='.SALE_METHOD_GIFT) !== false && !$this->Session->check($this->AppAuth->sessionKey)) {
            $this->Session->write('Auth.redirect', HTTPS_HOME_PAGE_URL.DS.$this->params['url']['url']);
            $this->redirect(HTTPS_HOME_PAGE_URL.'/member/login');
            return;
        } else if (stripos($orderInfo['orders'][0]['product_info_list'][0]['extradata'], 'sale_method='.SALE_METHOD_GIFT) !== false && $this->Session->check($this->AppAuth->sessionKey)) {
            $this->set('giftInfo', true);
            $this->data['Address']['pay_person_email'] = $this->Session->read($this->AppAuth->sessionKey.'.email');
            $this->data['Address']['pay_person_name'] = $this->Session->read($this->AppAuth->sessionKey.'.name');
        } else {
            $this->set('giftInfo', false);
            $this->data['Shopping']['gift_type_flg'] = ($orderInfo['gift_type'] != GIFT_TYPE_NONE)?true:false;
        }

        if ($this->viewVars['giftInfo'] && $memberInfo['id'] != $this->Session->read($this->AppAuth->sessionKey.'.id')) {
            $msg = "会员(ID：{$this->Session->read($this->AppAuth->sessionKey.'.id')})不能访问订单：{$this->params['named']['order_no']}";
            $this->log($msg, LOG_ERROR);
            $this->cakeError('error', array('message' => sprintf(__('error.orderNotExists', true), $this->params['named']['order_no'])));
            exit();
        }

        $this->__loadSessionData();

        //商品情報を取得
        $this->Product->getSimpleInfoByOrder($orderInfo, $productInfoList);
        $this->set('productInfoList', $productInfoList);

        //セール情報を取得
        $this->SaleRule->getListByOrder($orderInfo, $saleRuleList);
        $this->set('saleRuleList', $saleRuleList);

        //有効期間のチェック
        $payDayExpired = $this->ConfigIni->getConfigValue('paid_by_other', 'expired_day');
        if (strtotime($orderInfo['order_datetime']) + 3600*24*$payDayExpired < time()) {
            $this->Session->setFlash(__('error.orderPayDateExpired', true), 'default', null, 'orderPayDateExpired');
            //注文状態は注文キャンセルになる
            $this->Order->cancelOrder($orderInfo);
        }
        $this->set('loadFromUrl', true);
    }

    function __loadConfirmDataByLastOrder() {
        //注文した場合
        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);
        $this->CommFuncs->loadMemberOrderList($memberInfo['id'], $orderList);
        if (empty($orderList)) {
            //注文したことがない場合
            $this->redirect(HTTPS_HOME_PAGE_URL.'/shopping/payment');
            return;
        }
        $orderLast = array_slice($orderList, 0, 1);
        $orderInfo = $this->Order->getInfo($memberInfo['id'], $orderLast[0]['order_no']);
        //$orderInfo = $orderLast[0];
        //アドレス情報
        $this->data['Shopping'] = array(
                                    'shipto_address1' => $orderInfo['shipto_address1'],
                                    'shipto_address2' => $orderInfo['shipto_address2'],
                                    'shipto_address3' => $orderInfo['shipto_address3'],
                                    'shipto_address4' => $orderInfo['shipto_address4'],
                                    'shipto_zip'      => $orderInfo['shipto_zip'],
                                    'shipto_name'     => $orderInfo['shipto_name'],
                                    'shipto_phone'    => $orderInfo['shipto_phone'],
                                    'payself'        => ACTIVE_FLG_TRUE,
        );
        foreach($this->data['Shopping'] as $key => $value) {
            $this->data['Address'][str_replace('shipto_', '', $key)] = $value;
        }
        $this->data['Shopping'] = array_merge($this->data['Shopping'], $this->data['Address']);

        //支払い種別
        $this->data['Shopping']['charge_type'] = in_array($orderInfo['charge_type'], array(CHARGE_TYPE_ALIPAY,CHARGE_TYPE_COD))?$orderInfo['charge_type']:CHARGE_TYPE_ALIPAY;
        //発票情報
        $this->data['Shopping']['fapiao_flg']  = $orderInfo['fapiao_flg'];
        if (!empty($orderInfo['fapiao_flg'])) {
            $this->data['Shopping']['fapiao_name'] = $orderInfo['fapiao_name'];
        }
        $this->__loadSessionData();
    }

    function __loadConfirmData() {
        //アドレス
        $this->data['Shopping']['address'] = 0;
        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);
        foreach($memberInfo['sendto_addresses'] as $k => $v) {
                if ($v['address1'] == $this->data['Shopping']['address1']
                    && $v['address2'] == $this->data['Shopping']['address2']
                    && $v['address3'] == $this->data['Shopping']['address3']
                    && $v['address4'] == $this->data['Shopping']['address4']
                    && $v['zip'] == $this->data['Shopping']['zip']
                    && $v['phone'] == $this->data['Shopping']['phone']
                    && $v['name'] == $this->data['Shopping']['name']) {
                $this->data['Shopping']['address'] = $k;
                break;
            }
        }
    }

    /**
     * ギフトを選択した場合、注文申請のメールをギフト選択者へ送信
     * @param unknown_type $giftInfo
     */
    function __sendMailForChoosedGiftToReceiver(&$giftInfo) {
        $mailTo = $this->data['Shopping']['receive_person_email'];

        $this->Email->layout   = 'email';
        $this->Email->sendAs   = 'html';
        $this->Email->from     = SITE_ADMIN_EMAIL;
        $this->Email->to       = $mailTo;
        $this->Email->subject  = sprintf(__('mail.subjectForChoosedGiftToReceiver', true), __('info.siteNameCN', true), $giftInfo['name']);
        $this->Email->template = 'choosed_gift_to_receiver';

        $this->set('giftInfo', $giftInfo);
        $this->set('orderInfo', $this->data['Shopping']['product_info_list']);
        $this->set('mailTo', $mailTo);

        $this->Email->send();
    }

    /**
     * ギフトを選択した場合、注文申請のメールを会員へ送信
     * @param unknown_type $giftInfo
     */
    function __sendMailForChoosedGiftToPayer(&$giftInfo, $url) {
        $mailTo = $giftInfo['email'];

        $this->Email->layout   = 'email';
        $this->Email->sendAs   = 'html';
        $this->Email->from     = SITE_ADMIN_EMAIL;
        $this->Email->to       = $mailTo;
        $this->Email->subject  = sprintf(__('mail.subjectForChoosedGiftToPayer', true), __('info.siteNameCN', true), $this->data['Shopping']['receive_person_name']);
        $this->Email->template = 'choosed_gift_to_payer';

        $this->set('giftInfo', $giftInfo);
        $this->set('orderInfo', $this->data['Shopping']['product_info_list']);
        $this->set('url', $url);

        $this->Email->send();
    }

    /**
     * 注文申請のメールを会員へ送信
     * @param unknown_type $orderInfo
     */
    function __sendMailForCreateOrderToPayerAlipay(&$orderInfo) {
        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);

        $this->Email->layout   = 'email';
        $this->Email->sendAs   = 'html';
        $this->Email->from     = SITE_ADMIN_EMAIL;
        $this->Email->to       = $memberInfo['email'];
        $this->Email->subject  = sprintf(__('mail.subjectForCreateOrderToPayerAlipay', true), __('info.siteNameCN', true), $orderInfo['order_no']);
        $this->Email->template = 'create_order_to_payer_alipay';

        $this->set('memberInfo', $memberInfo);
        $this->set('orderInfo', $orderInfo);

        $this->Email->send();
    }

    /**
     * 注文申請完了のメールを会員へ送信
     * @param unknown_type $orderInfo
     */
    function __sendMailForCreateOrderToPayerCod(&$orderInfo) {
        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);

        $this->Email->layout   = 'email';
        $this->Email->sendAs   = 'html';
        $this->Email->from     = SITE_ADMIN_EMAIL;
        $this->Email->to       = $memberInfo['email'];
        $this->Email->subject  = sprintf(__('mail.subjectForCreateOrderToPayerCod', true), __('info.siteNameCN', true), $orderInfo['order_no']);
        $this->Email->template = 'create_order_to_payer_cod';

        $this->set('memberInfo', $memberInfo);
        $this->set('orderInfo', $orderInfo);

        $this->Email->send();
    }

    /**
     * 注文申請のメールを支払者へ送信(考验TA)
     * @param unknown_type $orderInfo
     * @param unknown_type $url
     */
    function __sendMailForCreateOrderToPayerKao(&$orderInfo, &$url) {
        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);
        $mailTo     = $this->data['Shopping']['pay_person_email'];

        $this->Email->layout   = 'email';
        $this->Email->sendAs   = 'html';
        $this->Email->from     = SITE_ADMIN_EMAIL;
        $this->Email->to       = $mailTo;
        $this->Email->subject  = sprintf(__('mail.subjectForCreateOrderToPayerKao', true), __('info.siteNameCN', true), $memberInfo['name'],$this->data['Shopping']['product_info_list'][0]['product_name']);
        $this->Email->template = 'create_order_to_payer_kao';

        $this->set('memberInfo', $memberInfo);
        $this->set('productInfos', $this->data['Shopping']['product_info_list']);
        $this->set('url', $url);
        $this->set('mailTo', $mailTo);

        $payDayExpired = $this->ConfigIni->getConfigValue('paid_by_other', 'expired_day');
        $this->set('payDayExpired', $payDayExpired);

        $this->loadModel('CommonCode');
        $this->CommonCode->getList();

        $this->Email->send();
    }
    /**
     * 注文申請のメールを支払者へ送信（第三者支払）
     * @param unknown_type $orderInfo
     * @param unknown_type $url
     */
    function __sendMailForCreateOrderToPayerOther(&$orderInfo, &$url) {
        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);
        $mailTo     = $this->data['Shopping']['pay_person_email'];

        $this->Email->layout   = 'email';
        $this->Email->sendAs   = 'html';
        $this->Email->from     = SITE_ADMIN_EMAIL;
        $this->Email->to       = $mailTo;
        $this->Email->subject  = sprintf(__('mail.subjectForCreateOrderToPayerOther', true), __('info.siteNameCN', true), $memberInfo['name']);
        $this->Email->template = 'create_order_to_payer_other';

        $this->set('memberInfo', $memberInfo);
        $this->set('productInfos', $this->data['Shopping']['product_info_list']);
        $this->set('url', $url);
        $this->set('mailTo', $mailTo);

        $payDayExpired = $this->ConfigIni->getConfigValue('paid_by_other', 'expired_day');
        $this->set('payDayExpired', $payDayExpired);

        $this->loadModel('CommonCode');
        $this->CommonCode->getList();

        $this->Email->send();
    }
}
?>