<?php
class EstimationController extends AppController {
    var $name       = 'Estimation';
    var $uses       = array('Estimation', 'Product', 'Order');
    var $components = array('Query', 'CommFuncs');
    var $helpers    = array('appForm', 'appSession', 'Paginator');

    function beforeFilter() {
        $this->AppAuth->allowedActions = array(
                                                'ajax_list',
                                                'ajax_add',
        );
        parent::beforeFilter();
    }

    /**
     * 評価を登録
     */
    function add() {
        $this->layout = 'front';

        if ((empty($this->params['named']['order_no']) || empty($this->params['named']['record_num']) || empty($this->params['named']['product_cd'])) && empty($this->data['Estimation'])) {
            $this->redirect(HTTPS_HOME_PAGE_URL.'/member/mypage');
            return;
        }
        if (!empty($this->params['named'])) {
            $this->data['Estimation'] = $this->params['named'];
        }

        $memberId = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $valid = false;
        //注文情報を取得
        $orderInfo = $this->Order->getInfo($memberId, $this->data['Estimation']['order_no']);
        //注文が存在しない
        if (empty($orderInfo)) {
            $this->redirect(HTTPS_HOME_PAGE_URL.'/member/mypage');
            return;
        }
        foreach($orderInfo['orders'] as $v1) {
            //注文状態は”出荷済み”の場合
            if ($v1['record_num'] == $this->data['Estimation']['record_num'] && $v1['shipping_status'] == SHIPPING_STATUS_SHIPPED) {
            //if ($v1['record_num'] == $this->data['Estimation']['record_num'] && $v1['shipping_status'] != SHIPPING_STATUS_SHIPPED) {
                foreach($orderInfo['orders'][$this->data['Estimation']['record_num']-1]['product_info_list'] as $v) {
                    if ($v['product_cd'] == $this->data['Estimation']['product_cd']) {
                        $valid = true;
                        break;
                    }
                }
            }
        }
        //商品番号が不存在の場合
        if (!$valid) {
            $this->redirect(HTTPS_HOME_PAGE_URL.'/member/mypage');
            return;
        }

        $ret = $this->Estimation->isExists($memberId, $this->data['Estimation']['order_no'], $this->data['Estimation']['record_num'], $this->data['Estimation']['product_cd']);
        //評価済み場合
        if (!empty($ret)) {
            $msg = "这个订单（订单编号:{$this->data['Estimation']['order_no']} 支编号：{$this->data['Estimation']['record_num']}）商品(编号：{$this->data['Estimation']['product_cd']})已经评价过了";
            $this->CakeError('error', array('message' => $msg));
            exit();
        }

        //商品情報を取得
        $productInfo = $this->Product->getSimpleInfo($this->data['Estimation']['product_cd']);
        $this->set('productInfo', $productInfo);
        $this->set('orderDatetime', $orderInfo['order_datetime']);

        $this->render('add');
    }

    /**
     * 商品詳細画面で評価を追加
     * @return multitype:|unknown
     */
    function ajax_add() {
        if (((empty($this->params['named']['product_cd'])) && empty($this->data['Estimation'])) || !$this->Session->check($this->AppAuth->sessionKey)) {
            return array();
        }
        $memberId = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $ret = $this->Estimation->isEnabledProductCd($memberId, $this->params['named']['product_cd']);
        return $ret;
    }

    /**
     * 商品詳細画面で評価一覧
     */
    function ajax_list() {
        $this->layout = 'ajax';

        if (empty($this->params['named']['product_cd'])) {
            return array();
        }
        $productCd = $this->params['named']['product_cd'];
        $conditions = array(
                            'conditions' => array(
                                                'Estimation.product_cd ='=> $productCd,
                                                'Estimation.status' => ESTIMATION_STATUS_PASSED,
                                                'Estimation.del_flg' => ACTIVE_FLG_FALSE,
                            ),
                            'order'      => array(
                                                "Estimation.create_datetime" => 'DESC',
                            ),
                            'limit'      => FRONT_PAGE_LIMIT_COMM,
        );
        $this->paginate = $conditions;
        $dataList = $this->paginate();
        $this->set('dataList', $dataList);

        $this->data['Search']['page'] = '';
        if (isset($this->params['named']['page'])) {
            $this->data['Search']['page'] = $this->params['named']['page'];
        }

        $this->render('/elements/estimation/ajax_list');
    }

    /**
     * 商品詳細画面で評価を追加
     */
    function add_comp() {
        if (empty($this->data) || empty($this->data['Estimation']['product_cd'])) {
            $this->redirect(HTTP_HOME_PAGE_URL);
            return;
        }
        $productCd = $this->data['Estimation']['product_cd'];
        $errMsg = $this->Estimation->invalidFields(array(), $this->data);
        if (!empty($errMsg)) {
            foreach($errMsg as $key => $value) {
                $this->Session->setFlash($value, 'default', null, 'estimationCreateFailure'.$key);
            }
            if (!empty($this->data['Estimation']['referer'])) {
                $this->redirect($this->data['Estimation']['referer']);
            } else {
                $this->redirect(HTTP_HOME_PAGE_URL.'/product/detail/product_cd:'.$productCd.'/selected:estimation');
            }
            return;
        }

        $updateData = $this->data['Estimation'];
        $createUserId = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $createUser   = $this->Session->read($this->AppAuth->sessionKey.'.nickname');
        $this->Estimation->create();
        $updateData['member_id']         = $createUserId;
        $updateData['status']            = ESTIMATION_STATUS_WAIT_PASS;
        $updateData['remote_ip_address'] = getenv('REMOTE_ADDR');
        $updateData['create_user']       = $createUser;
        $updateData['create_datetime']   = 'NOW()';
        $updateData['update_user']       = $createUser;
        $updateData['update_datetime']   = 'NOW()';
        $this->Estimation->save($updateData);

        if (!empty($this->data['Estimation']['comp_url'])) {
            $this->redirect($this->data['Estimation']['comp_url']);
        } else {
            $this->redirect(HTTP_HOME_PAGE_URL.'/product/detail/product_cd:'.$productCd);
        }
    }

    /**
     * 一覧画面初期化
     */
    function admin_index() {
        $this->layout = 'admin';
        $this->Session->delete('Admin.Estimation.Search');

        $this->paginate = $this->__loadDefaultSearchCondition();
        $this->Session->write('Admin.Estimation.Search.Conditions', $this->paginate);
        $dataList = $this->paginate();
        $this->set('dataList', $dataList);

        $this->data['Search']['create_datetime_order']   = 'DESC';
        $this->data['Search']['create_user_order']       = 'ASC';
        $this->data['Search']['product_name_order']      = 'ASC';
        $this->data['Search']['remote_ip_address_order'] = 'ASC';

        $this->render('admin_index');
    }

    /**
     * 問い合わせを検索
     */
    function admin_search() {
        $this->layout = 'admin';

        if (!empty($this->data)) {
            $conditions = $this->__loadDefaultSearchCondition();
            $conditions['conditions'] = array(
                                            'Estimation.content like \'%###data.Search.content###%\'',
                                            'Estimation.product_cd like \'%###data.Search.product_cd###%\'',
                                            'Estimation.create_user like \'%###data.Search.create_user###%\'',
                                            'Estimation.create_datetime >='  => '###data.Search.create_datetime_start###',
                                            'Estimation.create_datetime <='  => '###data.Search.create_datetime_end### 23:59:59',
                                            'Estimation.status ='            => '###data.Search.status###',
                                            'Estimation.type ='              => '###data.Search.type###',
                                            'Estimation.del_flg'             => ACTIVE_FLG_FALSE,
            );

            //ソート順を再作成
            if (!empty($this->data['Search']['top_order'])) {
                $sConditionsOrder = $this->Session->read('Admin.Estimation.Search.Conditions.order');
                $topOrderKey = substr($this->data['Search']['top_order'], 0, -6);
                $sortKey = 'Estimation.'.$topOrderKey;
                if ($topOrderKey == 'product_name') {
                    $sortKey = 'Product.'.$topOrderKey;
                }
                unset($sConditionsOrder[$sortKey]);
                $conditions['order'] = array($sortKey => $this->data['Search'][$topOrderKey.'_order']);
                addArray($conditions['order'], $sConditionsOrder, false);
            }

            $this->Query->renderSearchConditions($conditions);
            $this->Session->write('Admin.Estimation.Search.Conditions', $conditions);
            $this->Session->write('Admin.Estimation.Search.Data', $this->data);
        } else {
            $conditions = $this->Session->read('Admin.Estimation.Search.Conditions');
            $this->data = $this->Session->read('Admin.Estimation.Search.Data');
        }
        $this->paginate = $conditions;
        $dataList = $this->paginate();
        $this->set('dataList', $dataList);
        $this->render('admin_index');
    }

    /**
     * 状態を変更
     */
    function admin_change_status() {
        if (empty($this->data['Estimation']['id'])) {
            $this->redirect('/admin/estimation/search/');
            return;
        }
        $updateData    = array();
        $updateUserId  = $this->Session->read($this->AppAuth->sessionKey.'.login_id');
        $updateData['id']              = $this->data['Estimation']['id'];
        $updateData['status']          = $this->data['Estimation']['update_status'];
        $updateData['update_user']     = $updateUserId;
        $updateData['update_datetime'] = 'NOW()';
        $this->Estimation->save($updateData);

        $this->redirect($this->referer());
    }

    /**
     * 情報を削除
     */
    function admin_del() {
        if (empty($this->data['Estimation']['id'])) {
            $this->redirect('/admin/estimation/search/');
            return;
        }
        $updateData    = array();
        $updateUserId  = $this->Session->read($this->AppAuth->sessionKey.'.login_id');
        $updateData['id']              = $this->data['Estimation']['id'];
        $updateData['del_flg']         = ACTIVE_FLG_TRUE;
        $updateData['update_user']     = $updateUserId;
        $updateData['update_datetime'] = 'NOW()';
        $this->Estimation->save($updateData);

        $this->redirect($this->referer());
    }

    /**
     * 選択した問い合わせ状態を"保留"に変更
     */
    function admin_change_selected_status() {
        if (empty($this->data['Estimation']['selected_id'])) {
            $this->redirect('/admin/estimation/search/');
            return;
        }
        $conditions['id'] = array();
        foreach($this->data['Estimation']['selected_id'] as $key => $value) {
            if (!empty($value)) {
                $conditions['id'][] = $key;
            }
        }
        if (empty($conditions['id'])) {
            $this->redirect('/admin/estimation/search/');
            return;
        }

        $updateData    = array();
        $updateUserId  = $this->Session->read($this->AppAuth->sessionKey.'.login_id');
        $updateData['status']          = ENQUIRY_STATUS_BLOCKED;
        $updateData['update_user']     = "'".$updateUserId."'";
        $updateData['update_datetime'] = 'NOW()';
        $this->Estimation->updateAll($updateData, $conditions);

        $this->redirect($this->referer());
    }

    /**
     * 検索条件を作成
     * @return multitype:multitype: string multitype:string  multitype:multitype:string multitype:string    
     */
    function __loadDefaultSearchCondition() {
        $conditions = array(
                        'fields'        => array(
                                                'Estimation.*',
                                                'Product.product_cd',
                                                'Product.product_name',
                        ),
                        'conditions'    => array(
                                                'Estimation.del_flg' => ACTIVE_FLG_FALSE,
                        ),
                        'joins'         => array(
                                                array(
                                                    'table'=>'product',
                                                    'alias'=>'Product',
                                                    'type'=>'Left',
                                                    'tablePrefix'=>'oms',
                                                    'conditions'=>array(
                                                                    'Product.product_cd=Estimation.product_cd',
                                                    ),
                                                )
                        ),
                        'order'         => array(
                                            "Estimation.create_datetime"   => 'DESC',
                                            "Estimation.create_user"       => 'ASC',
                                            "Product.product_name"         => 'ASC',
                                            "Estimation.remote_ip_address" => 'ASC',
                        ),
                        'limit'         => ADMIN_PAGE_LIMIT_COMM,
        );
        return $conditions;
    }
}
?>
