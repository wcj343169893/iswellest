<?php
class ProductBookmarkController extends AppController {
    var $name       = "ProductBookmark";
    var $uses       = array('ProductBookmark', 'Product');
    var $components = array('PageSetting');
    var $helpers    = array('AppSession', 'Number', 'Paginator');

    function beforeFilter() {
        $this->AppAuth->allowedActions = array(
                                                'ajax_add',
        );
        parent::beforeFilter();
    }

    /**
     * 一覧画面
     */
    function index() {
        $this->layout = "front";

        $customerId = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $this->paginate = $this->ProductBookmark->getListConditionsByCustomerId($customerId, FRONT_PAGE_LIMIT_COMM, 2);
        $recs = $this->paginate();

        //販売できることをチェック
        $this->Product->loadEnableSaleByProductList($recs, array());
        foreach($recs as $key => $value) {
            $productInfo = array();
            $value['ProductPhoto'] = $value['Product']['ProductPhoto'];
            unset($value['Product']['ProductPhoto']);
            $this->PageSetting->loadProductInfoByObj($productInfo, $value);
            $dataList[] = $productInfo;
        }

        $this->set('dataList', $dataList);

        $this->render('list');
    }

    /**
     * お気商品情報を追加
     */
    function ajax_add() {
        $this->layout = 'ajax';

        if (!$this->Session->check($this->AppAuth->sessionKey)) {
            $this->Session->write('Auth.redirect', HTTP_HOME_PAGE_URL.'/product/detail/product_cd:'.$this->params['url']['product_cd']);
            $this->render('/elements/member/login');
            return;
        }

        if(empty($this->params['url']['product_cd'])) {
            exit();
        }

        $productCd = $this->params['url']['product_cd'];
        $rec = $this->Product->getSimpleInfo($productCd);
        if (empty($rec)) {
            exit();
        }

        $customerId = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $rec = $this->ProductBookmark->getInfoByCustomerId($customerId, $productCd);
        if (empty($rec)) {
            $updateData = array();
            $updateData['customer_id']     = $customerId;
            $updateData['product_cd']      = $productCd;
            $updateData['create_user']     = $customerId;
            $updateData['create_datetime'] = 'NOW()';
            $updateData['update_user']     = $customerId;
            $updateData['update_datetime'] = 'NOW()';

            $this->ProductBookmark->save($updateData);
        }
        $recs = $this->ProductBookmark->getInfoByCustomerId($customerId);
        $this->set('count', count($recs));

        $this->render('/elements/product/bookmark');
    }

    /**
     * お気に入り商品を削除
     */
    function ajax_delete() {
        if(empty($this->params['url']['product_cd'])) {
            exit();
        }

        $fields['del_flg']          = ACTIVE_FLG_TRUE;
        $fields['delete_datetime']  = 'NOW()';
        $fields['delete_user']      = '\''.$this->Session->read($this->AppAuth->sessionKey.'.nickname').'\'';
        $conditions['customer_id']  = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $conditions['product_cd']   = $this->params['url']['product_cd'];
        $ret = $this->ProductBookmark->updateAll($fields, $conditions);
        if ($ret) {
            echo __('info.deleteBookmarkSuccess', true);
            exit();
        } else {
            $this->log("会员ID：{$conditions['customer_id']} 删除收藏【商品编号：{$conditions['product_cd']}】失败！", LOG_ERROR);
            exit();
        }
    }
}
?>