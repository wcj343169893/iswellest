<?php
class GroupBuyController extends AppController {
    var $name       = 'GroupBuy';
    var $uses       = array('GroupBuy', 'Product', 'StockInfo', 'ProductPhoto');
    var $components = array('Query', 'ConfigIni');
    var $helpers    = array('AppSession', 'Paginator', 'Number');

    function beforeFilter() {
        $this->AppAuth->allowedActions = array(
                                            'index',
                                            'detail',
        );
        parent::beforeFilter();
    }

    /**
     * 一覧画面
     */
    function index() {
        $this->layout = 'front';

        $this->__loadFrontSearchConditions($conditions);

        if (!empty($this->params['named']['sort_key']) && $this->params['named']['sort_key'] == '2') {
            $conditions['order'] = array("GroupBuy.purchase_person_count+GroupBuy.base_purchase_person_count"   => 'DESC',);
        } elseif (!empty($this->params['named']['sort_key']) && $this->params['named']['sort_key'] == '3') {
            $conditions['order'] = array("Product.price_for_normal"   => 'ASC',);
        } elseif (!empty($this->params['named']['sort_key']) && $this->params['named']['sort_key'] == '4') {
            $conditions['order'] = array("Product__discount"   => 'DESC',);
        } else {
            $this->params['named']['sort_key'] = '1';
        }

        $this->paginate = $conditions;
        $dataList = $this->paginate();

        //写真を取得
        $this->__loadProductDetail($dataList);
        $this->set('dataList', $dataList);

        $this->render('index');
    }

    /**
     * 詳細画面
     */
    function detail() {
        $this->layout = 'front';

        if (empty($this->params['named']['id'])) {
            $this->redirect(HTTP_HOME_PAGE_URL.'/group_buy/');
            return;
        }

        $id = $this->params['named']['id'];
        $rec = $this->GroupBuy->getInfo($id, '2');
        if (empty($rec) || (!empty($rec) && $rec['GroupBuy']['start_time'] >= date('Y-m-d H:i:s'))) {
            $this->redirect(HTTP_HOME_PAGE_URL.'/group_buy/');
            return;
        }
        $this->set('groupBuyInfo', $rec);

        //在庫数
        $stockInfo= $this->StockInfo->getInfo($rec['Product']['product_cd']);
        //予約商品の販売可否
        if ($rec['Product']['product_type'] == PRODUCT_TYPE_RESERVATION) {
            $subScriptStatus = $this->Product->getSubScriptionStatus($rec['Product']['product_cd']);
            $subStatus = $subScriptStatus[$rec['Product']['product_cd']]['subscription_status'];
        } else {
            $subStatus = false;
        }
        $customerRank = $this->Session->check($this->AppAuth->sessionKey)?$this->Session->read($this->AppAuth->sessionKey.'.customer_rank'):CUSTOMER_RANK_NORMAL;
        $enableSale = $this->Product->enableSale($rec, $stockInfo[$rec['Product']['product_cd']], true, $customerRank, $subStatus);
        $this->set('enableSale', $enableSale);

        //最新の共同購入を取得
        $this->__loadFrontSearchConditions($conditions);
        $conditions['conditions'][] = array(
                                            'GroupBuy.id <>' => $id,
                                            'GroupBuy.end_time >= \'NOW()\'',
        );
        $conditions['order']        = array('GroupBuy.start_time' => 'DESC');
        $conditions['limit']        = $this->ConfigIni->getConfigValue('group_buy', 'other_list_limit');
        $recs = $this->GroupBuy->find('all', $conditions);

        //写真を取得
        $this->__loadProductDetail($recs);
        $this->set('dataList', $recs);

        $this->render('detail');
    }

    /**
     * 情報一覧
     */
    function admin_index() {
        $this->layout = "admin";

        $this->__loadDefaultSearchConditions($conditions);
        $this->paginate = $conditions;
        $dataList = $this->paginate();
        $this->set('dataList', $dataList);

        $this->render('admin_index');
    }

    /**
     * 情報追加・編集画面を初期化
     */
    
    function admin_edit() {
        $this->layout = "admin";
        if (!empty($this->params['named']['id']) && empty($this->data['GroupBuy']['mode'])) {
            $groupBuyInfo = $this->GroupBuy->getInfo($this->params['named']['id']);
            $start_time   = $groupBuyInfo['GroupBuy']['start_time'];
            $end_time     = $groupBuyInfo['GroupBuy']['end_time'];
            unset($groupBuyInfo['GroupBuy']['start_time']);
            unset($groupBuyInfo['GroupBuy']['end_time']);
            $groupBuyInfo['GroupBuy']['start_date']         = substr($start_time, 0, 10);
            $groupBuyInfo['GroupBuy']['start_time']['hour'] = substr($start_time, 11, 2);
            $groupBuyInfo['GroupBuy']['start_time']['min']  = substr($start_time, 14, 2);
            $groupBuyInfo['GroupBuy']['end_date']           = substr($end_time, 0, 10);
            $groupBuyInfo['GroupBuy']['end_time']['hour']   = substr($end_time, 11, 2);
            $groupBuyInfo['GroupBuy']['end_time']['min']    = substr($end_time, 14, 2);
            $this->data = $groupBuyInfo;
        }

        if (isset($this->data['GroupBuy']['product_cd']) && !empty($this->data['GroupBuy']['product_cd'])) {
            $rec = $this->Product->getBaseInfo($this->data['GroupBuy']['product_cd']);
            $this->set('productInfo', $rec);
        }

        $this->loadBackListReferer();
        $this->render('admin_edit');
    }

    /**
     * 情報を更新
     */
    function admin_edit_comp() {
        $this->layout = "admin";

        $start_time = $this->data['GroupBuy']['start_time'];
        $end_time   = $this->data['GroupBuy']['end_time'];
        $this->data['GroupBuy']['start_time_str'] = sprintf("%s %s:%s", $this->data['GroupBuy']['start_date'],$start_time['hour'], $start_time['min']);
        $this->data['GroupBuy']['end_time_str']   = sprintf("%s %s:%s", $this->data['GroupBuy']['end_date'],$end_time['hour'], $end_time['min']);
        $errMsg = $this->GroupBuy->invalidFields(array(), $this->data);
        $valid = true;

        //名前をチェック
        if (empty($errMsg['product_cd'])) {
            $valid &= $this->__checkProduct($this->data['GroupBuy']['product_cd']);
        }
        if (!empty($errMsg) || !$valid) {
            $this->admin_edit();
            return;
        }

        $userId = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData = $this->data['GroupBuy'];
        $updateData['start_time']      = $this->data['GroupBuy']['start_time_str'];
        $updateData['end_time']        = $this->data['GroupBuy']['end_time_str'];
        if (empty($this->data['GroupBuy']['manual_purchase_person_count_flg'])) {
            $updateData['base_purchase_person_count_min'] = null;
            $updateData['base_purchase_person_count_max'] = null;
            $updateData['increase_purchase_person_count_min'] = null;
            $updateData['increase_purchase_person_count_max'] = null;
        }
        $updateData['comment']         = $this->data['GroupBuy']['comment'];
        $updateData['create_user']     = $userId;
        $updateData['create_datetime'] = 'NOW()';
        $updateData['update_user']     = $userId;
        $updateData['update_datetime'] = 'NOW()';
        //無効時間
        if (!empty($this->data['GroupBuy']['inactive_flg']) && empty($this->data['GroupBuy']['inactive_flg_old'])) {
            $updateData['inactive_datetime'] = 'NOW()';
        }
        $this->GroupBuy->save($updateData, false);

        $this->redirect($this->getBackListReferer());
    }

    /**
     * 情報IDより情報を削除
     */
    function admin_delete() {
        if (empty($this->params['named']['id'])) {
            $this->redirect('/admin/group_buy/');
            return;
        }

        $updateUserId  = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData['id']              = $this->params['named']['id'];
        $updateData['del_flg']         = ACTIVE_FLG_TRUE;
        $updateData['update_user']     = $updateUserId;
        $updateData['update_datetime'] = 'NOW()';
        $updateData['delete_user']     = $updateUserId;
        $updateData['delete_datetime'] = 'NOW()';
        $this->GroupBuy->save($updateData, false);

        $this->redirect($this->referer());
    }

    function __loadDefaultSearchConditions(&$conditions = array()) {
        $conditions = array(
                        'conditions'    => array(
                                                'GroupBuy.del_flg ='     => ACTIVE_FLG_FALSE,
                        ),
                        'order'         => array(
                                            "GroupBuy.update_datetime"   => 'DESC',
                        ),
                        'recursive'     => 1,
                        'limit'         => ADMIN_PAGE_LIMIT_COMM,
        );
    }

    function __loadFrontSearchConditions(&$conditions = array()) {
        $conditions = array(
                        'fields'        => array(
                                                'GroupBuy.*',
                                                '"Product"."product_cd"',
                                                '"Product"."retail_price"',
                                                '"Product"."price_for_normal"',
                                                '"Product"."pub_flg"',
                                                '"Product"."pub_start_date"',
                                                '"Product"."pub_end_date"',
                                                '"Product"."sales_status"',
                                                '"Product"."product_type"',
                                                '"Product"."require_customer_rank"',
                                                'CASE WHEN "GroupBuy"."purchase_product_count" < "GroupBuy"."max_purchase_number" AND "GroupBuy"."end_time" >= \'NOW()\' THEN \'1\' ELSE \'0\' END AS active_flg',
                                                'CASE WHEN "Product"."retail_price" IS NOT NULL THEN "Product"."price_for_normal"/"Product"."retail_price" ELSE \'0\' END AS "Product__discount"',
                        ),
                        'conditions'    => array(
                                                'GroupBuy.start_time <= \'NOW()\'',
                                                'GroupBuy.del_flg ='     => ACTIVE_FLG_FALSE,
                        ),
                        'joins'         => array(
                                                array(
                                                    'table'     => 'product',
                                                    'alias'     => 'Product',
                                                    'type'      => 'Left',
                                                    'conditions'=>array(
                                                                    'GroupBuy.product_cd=Product.product_cd',
                                                                    'Product.delete_datetime IS NULL',
                                                    ),
                                                ),
                        ),
                        'order'         => array(
                                            "active_flg"                 => 'DESC',
                                            "GroupBuy.update_datetime"   => 'DESC',
                        ),
                        'recursive'     => -1,
                        'limit'         => FRONT_PAGE_LIMIT_COMM,
        );
    }
    /**
     * 商品番号をチェック
     * @param unknown_type $productCd
     */
    function __checkProduct($productCd) {
        //商品ＩＤに対して存在Check
        $rec = $this->Product->getBaseInfo($productCd);
        if (empty($rec)) {
            $this->Session->setFlash(str_replace('{0}', '对应商品ID', __('error.notExists', true)), 'default', null, 'productCdIsWrong');
            return false;
        }
        //在庫Ｃｈｅｃｋ、販売ステータスＣｈｅｃｋ、エラーの場合
        $stockInfo = $this->StockInfo->getInfo($productCd);
        $stockInfo[$productCd] = !empty($stockInfo[$productCd])?$stockInfo[$productCd]:0;
        $ret = true;//$this->Product->enableSale($rec, $stockInfo[$productCd], false);
        if (!$ret) {
            $this->Session->setFlash(sprintf(__('error.productSaleDisabled', true),$productCd), 'default', null, 'productCdIsWrong');
            return false;
        }
        return true;
        /**
        if ($rec['Product']['sales_status'] != PRODUCT_SALES_STATUS_NORMAL && empty($stockInfo[$productCd])) {
            $this->Session->setFlash(sprintf(__('error.productSaleDisabled', true),$productCd), 'default', null, 'productCdIsWrong');
            return false;
        }
        return true;
        */
    }

    function __loadProductDetail(&$dataList) {
        //写真を取得
        $productCds = array();
        $productCdsForSubStatus = array();
        foreach($dataList as $key => $value) {
            $productCds[] = $value['GroupBuy']['product_cd'];
            if ($value['Product']['product_type'] == PRODUCT_TYPE_RESERVATION) {
                $productCdsForSubStatus[] = $value['GroupBuy']['product_cd'];
            }
        }
        $photoList = $this->ProductPhoto->getList($productCds);
        $this->set('photoList', $photoList);

        //在庫数
        $stockInfo= $this->StockInfo->getInfo($productCds);
        //予約商品の販売可否
        if (!empty($productCdsForSubStatus)) {
            $subScriptStatus = $this->Product->getSubScriptionStatus($productCdsForSubStatus);
        }
        $customerRank = $this->Session->check($this->AppAuth->sessionKey)?$this->Session->read($this->AppAuth->sessionKey.'.customer_rank'):CUSTOMER_RANK_NORMAL;
        foreach($dataList as $key => $value) {
            $product_cd = $value['GroupBuy']['product_cd'];
            $subStatus = isset($subScriptStatus[$product_cd]['subscription_status'])?$subScriptStatus[$product_cd]['subscription_status']:false;
            $dataList[$key]['GroupBuy']['enable_sale'] = $this->Product->enableSale($value, $stockInfo[$product_cd], true, $customerRank, $subStatus);
        }
    }
}
?>