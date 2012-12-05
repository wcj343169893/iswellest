<?php
/**
 * ファイル名：sale_rule.php
 * 概要：セール情報のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/02/17
 */
class SaleRule extends AppModel {
    var $name       = 'SaleRule';
    var $primaryKey = 'id';
    var $useTable   = 'sale_rule';

    /**
     * セール情報をOMSから取得
     */
    function getListFromOMS($baseTime) {
        $methodPath = 'getsalerule';
        $params = array(
                        'base_datetime' => $baseTime,
        );
        return $this->requestOmsData($methodPath, $params);
    }

    /**
     * セールIDよりセール情報を取得
     * @param unknown_type $saleIds
     * @return Ambigous <multitype:, NULL, boolean, mixed>
     */
    function getList($saleIds) {
        $conditions = array(
                            'conditions' => array(
                                                'id' => $saleIds,
                                                'sale_end_datetime >= NOW()',
                                                'sale_start_datetime <= NOW()',
                                                'delete_datetime IS NULL',
                            ),
                            'order'      => array(
                                                'update_datetime' => 'DESC',
                            ),
                            'recursive' => '0',
        );
        $recs = $this->find('all', $conditions);
        return $recs;
    }

    /**
     * 注文情報よりセール情報を取得
     * @param unknown_type $orderInfo
     * @param unknown_type $saleRulelist
     */
    function getListByOrder(&$orderInfo, &$saleRulelist = array()) {
        $saleruleIds = array();
        $saleRulelist = array();
        foreach($orderInfo['orders'] as $k => $v) {
            foreach(explode(',', $v['salerule_ids']) as $k1 => $v1) {
                if (!empty($v1) && !in_array($v1, $saleruleIds)) {
                    $saleruleIds[] = $v1;
                }
            }
            foreach($v['product_info_list'] as $k1 => $v1) {
                foreach(explode(',', $v1['salerule_ids']) as $k2 => $v2) {
                    if (!empty($v2) && !in_array($v2, $saleruleIds))
                    $saleruleIds[] = $v2;
                }
            }
        }
        if (!empty($saleruleIds)) {
            $saleRulelist = $this->getList($saleruleIds);
        }
    }

    function getListByProduct($productCds = array(), &$saleRulelist = array()) {
        $saleProductModel = ClassRegistry::init('SaleProduct');
        $recs = $saleProductModel->getListByProduct($productCds);
        if (empty($recs)) {
            return array();
        }
        foreach($recs as $value) {
            $saleruleIds[] = $value['SaleProduct']['salerule_id'];
        }
        $saleRulelist = $this->getList($saleruleIds);
    }
}
?>