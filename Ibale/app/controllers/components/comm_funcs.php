<?php 
/**
 * ファイル名：comm_funcs.php
 * 概要：APP用の共通関数のコンポーネント
 * 
 * 作成者：shilei
 * 作成日時：2012/01/06
 */
class CommFuncsComponent extends Object{
    var $_controller = null;

    /**
     * Initialize component
     *
     * @param object $controller Instantiating controller
     * @access public
     */
    function initialize(&$controller, $settings = array()) {
        $this->_controller =& $controller;
    }

    /**
     * 注文情報を取得
     * @param unknown_type $memberId
     * @param unknown_type $orderList
     */
    function loadMemberOrderList($memberId, &$orderListAll = array()) {
        //if (!$this->_controller->Session->check('Front.Order.List')) {
            $modelOrder = ClassRegistry::init('Order');
            $orderListAll = $modelOrder->getListByCustomerId($memberId);
            //$this->_controller->Session->write('Front.Order.List', $orderListAll);
        //} else {
        //    $orderListAll = $this->_controller->Session->read('Front.Order.List');
        //}
        usort($orderListAll, 'cmpOrderRecordNum');

        $orderNos = array();
        $orderType = null;
        foreach($orderListAll as $key => $value) {
            if ($value['record_num'] == 1) {
                $rec = $modelOrder->getInfo($memberId, $value['order_no']);
                $orderListAll[$key]['orders'] = $rec['orders'];
                $orderType = $this->getOrderTypeDesc($rec);
            }
            $orderListAll[$key]['order_type'] = $orderType;
            if (!in_array($value['order_no'], $orderNos)) {
                $orderNos[$key] = $value['order_no'];
            } else {
                $firstIndex = array_search($value['order_no'], $orderNos);
                $orderListAll[$firstIndex]['has_divided'] = true;
            }
        }
    }

    /**
     * お気に入る情報を取得
     * @param unknown_type $memberId
     * @param unknown_type $bookmarks
     */
    function loadMemberProductBookmarkList($memberId, &$bookmarks = array()) {
        if (!$this->_controller->Session->check('Front.ProductBookmark.list')) {
            $modelProductBookmark = ClassRegistry::init('ProductBookmark');
            $bookmarks = $modelProductBookmark->getInfoByCustomerId($memberId);
            $this->_controller->Session->write('Front.ProductBookmark.list', $bookmarks);
        } else {
            $bookmarks = $this->_controller->Session->read('Front.ProductBookmark.list');
        }
    }

    /**
     * 配列よりページ送りものを作成
     * @param unknown_type $dataList
     * @param unknown_type $ret
     */
    function loadPaging(&$dataList, &$ret = array()) {
        $count = count($dataList);
        $pageCount = intval(ceil($count / FRONT_PAGE_LIMIT_COMM));

        $page = 1;
        if (!empty($this->_controller->params['named']['page'])) {
            $page = $this->_controller->params['named']['page'];
        }
        if ($page === 'last' || $page >= $pageCount) {
            $page = $pageCount;
        } elseif (intval($page) < 1) {
            $page = 1;
        }
        $ret = array_slice($dataList, ($page-1)*FRONT_PAGE_LIMIT_COMM, FRONT_PAGE_LIMIT_COMM);

        $paging = array(
            'page'       => $page,
            'current'    => count($ret),
            'count'      => $count,
            'prevPage'   => ($page > 1),
            'nextPage'   => ($count > ($page * FRONT_PAGE_LIMIT_COMM)),
            'pageCount'  => $pageCount,
            'defaults'   => array('limit' => FRONT_PAGE_LIMIT_COMM, 'step' => 1),
            'options'    => array('limit' => FRONT_PAGE_LIMIT_COMM),
        );
        $this->_controller->params['paging']['Product'] = $paging;
    }

    /**
     * エリアリストを初期化
     */
    function initAreaList($controllerName = '') {
        $areaModel = ClassRegistry::init('Area');
        $controllerName = !empty($controllerName)?$controllerName:$this->_controller->name;

        //アドレス１
        $areaModel->getAreaListByParentId('0', $addressList1);
        $this->_controller->set('addressList1', $addressList1);

        //アドレス２
        $addressList2 = array();
        if (!empty($this->_controller->data[$controllerName]['address1'])) {
            $areaModel->getAreaListByParentId($this->_controller->data[$controllerName]['address1'], $addressList2);
            //$addressList2['other'] = __('label.other', true);
        }
        $this->_controller->set('addressList2', $addressList2);

        //アドレス３
        $addressList3 = array();
        if (!empty($this->_controller->data[$controllerName]['address2'])) {
            $areaModel->getAreaListByParentId($this->_controller->data[$controllerName]['address2'], $addressList3);
            //$addressList3['other'] = __('label.other', true);
        }
        $this->_controller->set('addressList3', $addressList3);

        if (empty($this->_controller->data[$controllerName])
                || !isset($this->_controller->data[$controllerName]['address1'])
                || !isset($this->_controller->data[$controllerName]['address2'])
                || !isset($this->_controller->data[$controllerName]['address3'])) {
            return;
        }

        //アドレス２その他
        if (!isset($this->_controller->data[$controllerName]['address2_other'])) {
            $this->_controller->data[$controllerName]['address2_other'] = ($this->_controller->data[$controllerName]['address2'] != 'other')?$this->_controller->data[$controllerName]['address2']:'';
        }
        if (!empty($this->_controller->data[$controllerName]['address2']) 
                && !is_numeric($this->_controller->data[$controllerName]['address2'])) {
            $this->_controller->data[$controllerName]['address2'] = 'other';
        }
        //アドレス３その他
        if (!isset($this->_controller->data[$controllerName]['address3_other'])) {
            $this->_controller->data[$controllerName]['address3_other'] = ($this->_controller->data[$controllerName]['address3'] != 'other')?$this->_controller->data[$controllerName]['address3']:'';
        }
        if (!empty($this->_controller->data[$controllerName]['address3']) 
                && !is_numeric($this->_controller->data[$controllerName]['address3'])) {
            $this->_controller->data[$controllerName]['address3'] = 'other';
        }
    }

    /**
     * アドレスを検証
     * @param unknown_type $modelName
     * @return boolean
     */
    function validAddress($modelName, $controllerName = null) {
        $valid = true;
        $controllerName = !empty($controllerName)?$controllerName:$this->_controller->name;
        if (empty($this->_controller->data[$controllerName])) {
            return $valid;
        }
        if ($this->_controller->data[$controllerName]['address2'] == 'other' && empty($this->_controller->data[$controllerName]['address2_other'])) {
            $this->_controller->{$modelName}->validationErrors['address2_other'] = __('error.required', true);
            $valid = false;
        }
        if ($this->_controller->data[$controllerName]['address3'] == 'other' && empty($this->_controller->data[$controllerName]['address3_other'])) {
            $this->_controller->{$modelName}->validationErrors['address3_other'] = __('error.required', true);
            $valid = false;
        }
        return $valid;
    }
    function getOrderTypeDesc(&$value) {
        $orderType = '普通订单';
        if (isset($value['orders']) && stripos($value['orders'][0]['product_info_list'][0]['extradata'], 'sale_method='.SALE_METHOD_NORMAL) !== false):
            $orderType='普通订单';
        elseif (isset($value['orders']) && stripos($value['orders'][0]['product_info_list'][0]['extradata'], 'sale_method='.SALE_METHOD_GIFT) !== false):
            $orderType='礼品订单';
        elseif (isset($value['orders']) && stripos($value['orders'][0]['product_info_list'][0]['extradata'], 'sale_method='.SALE_METHOD_PAID_BY_OTHER) !== false):
            $orderType='考验TA订单';
        elseif (isset($value['orders']) && stripos($value['orders'][0]['product_info_list'][0]['extradata'], 'sale_method='.SALE_METHOD_GROUP_BUY) !== false):
            $orderType='团购订单';
        endif;
        return $orderType;
    }

    function getExtradata(&$value, &$ret) {
        if (isset($value['orders'])) {
            preg_match("/(sale_method)(=)([\w\_]*)/i", $value['orders'][0]['product_info_list'][0]['extradata'], $matches1);
            preg_match("/(pay_method)(=)([\w\_]*)/i", $value['orders'][0]['product_info_list'][0]['extradata'], $matches2);
        }

        $ret['sale_method']=(!empty($matches1[3])?$matches1[3]:'');
        $ret['pay_method']=(!empty($matches2[3])?$matches2[3]:'');
    }

    function loadProductBlock($productCds, &$ret = array()) {
        if (empty($productCds)) {
            return;
        }
        $productModel = ClassRegistry::init('Product');
        $recs = $productModel->getBaseInfo($productCds);
        $productModel->loadEnableSaleByProductList($recs, $productCds);
        foreach($productCds as $key => $value) {
            $productInfo = array();
            $this->_controller->PageSetting->loadProductInfoByObj($productInfo, $recs[$value]);
            $ret[] = $productInfo;
        }
    }
}
?>
