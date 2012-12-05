<?php
class EnquiryController extends AppController {
    var $name       = 'Enquiry';
    var $uses       = array('Enquiry');
    var $components = array('Query');
    var $helpers    = array('appForm', 'appSession', 'Paginator');

    function beforeFilter() {
        $this->AppAuth->allowedActions = array(
                                                'add',
                                                'ajax_list',
        );
        parent::beforeFilter();
    }

    /**
     * 商品詳細画面で問い合わせ一覧
     */
    function ajax_list() {
        $this->layout = 'ajax';

        if (empty($this->params['named']['product_cd'])) {
            return array();
        }

        $productCd = $this->params['named']['product_cd'];
        $conditions = array(
                            'conditions' => array(
                                                'Enquiry.product_cd ='=> $productCd,
                                                'Enquiry.status' => ENQUIRY_STATUS_ANSWERED,
                                                'Enquiry.del_flg' => ACTIVE_FLG_FALSE,
                            ),
                            'order'      => array(
                                                "Enquiry.create_datetime" => 'DESC',
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

        $this->render('/elements/enquiry/ajax_list');
    }


    /**
     * 商品詳細画面で問い合わせを追加
     */
    function add() {
        $this->layout = 'ajax';
        /**
        if (!$this->Session->check($this->AppAuth->sessionKey)) {
            $this->Session->write('Auth.redirect', HTTPS_HOME_PAGE_URL.'/product/detail/product_cd:'.$this->data['Enquiry']['product_cd'].'/selected:enquiry/#productEnquiryForm');
            $this->Session->write('Front.Product.Enquiry.data', $this->data);
            $this->set('dispLogin', ACTIVE_FLG_TRUE);
            $this->render('/elements/product/add_enquiry');
            return;
        }
        */
        if (empty($this->data) && $this->Session->check('Front.Product.Enquiry.data')) {
            $this->data = $this->Session->read('Front.Product.Enquiry.data');
            $this->Session->delete('Front.Product.Enquiry.data');
        }
        if (empty($this->data) || empty($this->data['Enquiry']['product_cd'])) {
            //$this->set('redirectUrl', HTTPS_HOME_PAGE_URL);
            //$this->render('/elements/product/add_enquiry');
            //return;
        }


        $productCd = $this->data['Enquiry']['product_cd'];
        $errMsg = $this->Enquiry->invalidFields(array(), $this->data);
        if (!empty($errMsg)) {
            foreach($errMsg as $key => $value) {
                $this->Session->setFlash($value, 'default', null, 'enquiryCreateFailure'.$key);
            }
            $this->render('/elements/product/add_enquiry');
            return;
        }

        $updateData   = $this->data['Enquiry'];
        $createUserId = $this->Session->check($this->AppAuth->sessionKey.'.id')?$this->Session->read($this->AppAuth->sessionKey.'.id'):null;
        $createUser   = $this->Session->check($this->AppAuth->sessionKey.'.nickname')?$this->Session->read($this->AppAuth->sessionKey.'.nickname'):CUSTOMER_NO_BODY;
        $this->Enquiry->create();
        $updateData['member_id']         = $createUserId;
        $updateData['status']            = ENQUIRY_STATUS_WAIT_ANSWER;
        $updateData['remote_ip_address'] = getenv('REMOTE_ADDR');
        $updateData['create_user']       = $createUser;
        $updateData['create_datetime']   = 'NOW()';
        $updateData['update_user']       = $createUser;
        $updateData['update_datetime']   = 'NOW()';
        $this->Enquiry->save($updateData);

        unset($this->data['Enquiry']['type']);
        unset($this->data['Enquiry']['content']);
        $this->Session->setFlash(__('info.enquiryAddSuccess', true), 'default', null, 'enquiryAddSuccess');
        $this->render('/elements/product/add_enquiry');
        return;
        //$this->redirect(HTTP_HOME_PAGE_URL.'/product/detail/product_cd:'.$productCd);
    }

    /**
     * 一覧画面初期化
     */
    function admin_index() {
        $this->layout = 'admin';

        $this->Session->delete('Admin.Enquiry.Search');

        $this->paginate = $this->__loadDefaultSearchCondition();
        $this->Session->write('Admin.Enquiry.Search.Conditions', $this->paginate);
        $dataList = $this->paginate();
        $this->set('dataList', $dataList);

        $this->data['Search']['create_datetime_order']   = 'DESC';
        $this->data['Search']['create_user_order']       = 'ASC';
        $this->data['Search']['product_name_order']      = 'ASC';
        $this->data['Search']['remote_ip_address_order'] = 'ASC';

        $this->loadBackListReferer(false);
        if ($this->Session->check('Admin.Enquiry.data')) {
            $this->data['Enquiry'] = $this->Session->read('Admin.Enquiry.data');
            $this->Session->delete('Admin.Enquiry.data');
        }
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
                                            'Enquiry.content like \'%###data.Search.content###%\'',
                                            'Enquiry.product_cd like \'%###data.Search.product_cd###%\'',
                                            'Enquiry.create_user like \'%###data.Search.create_user###%\'',
                                            'Enquiry.create_datetime >='   => '###data.Search.create_datetime_start###',
                                            'Enquiry.create_datetime <='   => '###data.Search.create_datetime_end### 23:59:59',
                                            'Enquiry.status ='            => '###data.Search.status###',
                                            'Enquiry.type ='              => '###data.Search.type###',
            
            );

            //ソート順を再作成
            if (!empty($this->data['Search']['top_order'])) {
                $sConditionsOrder = $this->Session->read('Admin.Enquiry.Search.Conditions.order');
                $topOrderKey = substr($this->data['Search']['top_order'], 0, -6);
                $sortKey = 'Enquiry.'.$topOrderKey;
                if ($topOrderKey == 'product_name') {
                    $sortKey = 'Product.'.$topOrderKey;
                }
                unset($sConditionsOrder[$sortKey]);
                $conditions['order'] = array($sortKey => $this->data['Search'][$topOrderKey.'_order']);
                addArray($conditions['order'], $sConditionsOrder, false);
            }

            $this->Query->renderSearchConditions($conditions);
            $this->Session->write('Admin.Enquiry.Search.Conditions', $conditions);
            $this->Session->write('Admin.Enquiry.Search.Data', $this->data);
        } else {
            $conditions = $this->Session->read('Admin.Enquiry.Search.Conditions');
            $this->data = $this->Session->read('Admin.Enquiry.Search.Data');
        }
        $this->paginate = $conditions;
        $dataList = $this->paginate();
        $this->set('dataList', $dataList);

        $this->loadBackListReferer(false);
        if ($this->Session->check('Admin.Enquiry.data')) {
            $this->data['Enquiry'] = $this->Session->read('Admin.Enquiry.data');
            $this->Session->delete('Admin.Enquiry.data');
        }
        $this->render('admin_index');
    }

    /**
     * 問い合わせを回答
     */
    function admin_commit_reply() {
        $errMsg = $this->Enquiry->invalidFields(array(), $this->data);
        //エラーがある場合
        if (!empty($errMsg)) {
            $errMsg['reply_content'] = str_replace('{0}', '回复', $errMsg['reply_content']);
            $this->Session->setFlash($errMsg['reply_content'], 'default', null, 'replyConentErrMsg'.$this->data['Enquiry']['id']);
            $this->Session->write('Admin.Enquiry.data', $this->data['Enquiry']);
            $this->redirect($this->getBackListReferer());
            return;
        }
        $updateData    = array();
        $updateUserId  = $this->Session->read($this->AppAuth->sessionKey.'.login_id');
        $updateData['id']              = $this->data['Enquiry']['id'];
        $updateData['reply_content']   = $this->data['Enquiry']['reply_content'];
        $updateData['status']          = ENQUIRY_STATUS_ANSWERED;
        $updateData['update_user']     = $updateUserId;
        $updateData['update_datetime'] = 'NOW()';
        $this->Enquiry->save($updateData);
        $this->redirect($this->getBackListReferer());
    }

    /**
     * 状態を変更
     */
    function admin_change_status() {
        if (empty($this->data['Enquiry']['id'])) {
            $this->redirect('/admin/enquiry/search/');
            return;
        }
        $updateData    = array();
        $updateUserId  = $this->Session->read($this->AppAuth->sessionKey.'.login_id');
        $updateData['id']              = $this->data['Enquiry']['id'];
        $updateData['status']          = $this->data['Enquiry']['update_status'];
        $updateData['update_user']     = $updateUserId;
        $updateData['update_datetime'] = 'NOW()';
        $this->Enquiry->save($updateData);

        $this->redirect($this->getBackListReferer());
    }

    /**
     * 選択した問い合わせ状態を"保留"に変更
     */
    function admin_change_selected_status() {
        if (empty($this->data['Enquiry']['selected_id'])) {
            $this->redirect('/admin/enquiry/search/');
            return;
        }
        $conditions['id'] = array();
        foreach($this->data['Enquiry']['selected_id'] as $key => $value) {
            if (!empty($value)) {
                $conditions['id'][] = $key;
            }
        }
        if (empty($conditions['id'])) {
            $this->redirect('/admin/enquiry/search/');
            return;
        }

        $updateData    = array();
        $updateUserId  = $this->Session->read($this->AppAuth->sessionKey.'.login_id');
        $updateData['status']          = ENQUIRY_STATUS_BLOCKED;
        $updateData['update_user']     = "'".$updateUserId."'";
        $updateData['update_datetime'] = 'NOW()';
        $this->Enquiry->updateAll($updateData, $conditions);

        $this->redirect($this->referer());
    }

    /**
     * 検索条件を作成
     * @return 検索条件
     */
    function __loadDefaultSearchCondition() {
        $conditions = array(
                        'fields'        => array(
                                                'Enquiry.*',
                                                'Product.product_cd',
                                                'Product.product_name',
                        ),
                        'conditions'    => array(),
                        'joins'         => array(
                                                array(
                                                    'table'       =>'product',
                                                    'alias'       =>'Product',
                                                    'type'        =>'Left',
                                                    'conditions'=>array(
                                                                    'Product.product_cd=Enquiry.product_cd',
                                                    ),
                                                )
                        ),
                        'order'         => array(
                                            "Enquiry.create_datetime"   => 'DESC',
                                            "Enquiry.create_user"       => 'ASC',
                                            "Product.product_name"      => 'ASC',
                                            "Enquiry.remote_ip_address" => 'ASC',
                        ),
                        'limit'         => ADMIN_PAGE_LIMIT_COMM,
        );
        return $conditions;
    }
}
?>
