<?php
/**
 * ファイル名：stock_info.php
 * 概要：商品在庫情報のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/12
 */
class StockInfo extends AppModel {
    var $name       = "StockInfo";
    var $useTable   = false;

    /**
     * 商品の在庫情報をOMSから取得
     * @param $productCds 商品番号の配列
     */
    function getInfo($productCds) {
        $ret = array();
        $methodPath = 'getstockinfo';
        if (!is_array($productCds)) {
            $productCds = array($productCds);
        }
        foreach($productCds as $key => $value) {
            $productCds[$key] = intval($value);
        }
        $params = array(
                        'product_cd' => $productCds,
        );
        $rec = $this->requestOmsData($methodPath, $params);
        if (empty($rec['results'])) {
            return array();
        }
        $rec = objectToArray($rec);
        foreach($rec['results']['products'] as $key => $value) {
            $ret[$value['product_cd']] = $value['count'];
        }
        return $ret;
    }
    
    function updateStockInfo($updateDatas) {
        $methodPath = 'addstock';
        $defultUpdateData = array('reason'=>'');
        $params['products'] = array();
        if (empty($updateDatas)) {
            return;
        }
        foreach($updateDatas as $key => $value) {
            $value = array_merge($defultUpdateData, $value);
            $params['products'][$key]['product_cd']    = $value['product_cd'];
            $params['products'][$key]['changed_count'] = $value['changed_count'];
            $params['products'][$key]['reason']        = $value['reason'];
        }
        return $this->requestOmsData($methodPath, $params);
    }

    function setStock($updateDatas) {
        $methodPath = 'setstock';
        $params['products'] = array();
        if (empty($updateDatas)) {
            return;
        }
        foreach($updateDatas as $key => $value) {
            $params['products'][$key]['product_cd'] = $value['product_cd'];
            $params['products'][$key]['count']      = $value['count'];
        }
        return $this->requestOmsData($methodPath, $params);
    }
}
?>