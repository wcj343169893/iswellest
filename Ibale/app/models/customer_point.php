<?php
/**
 * ファイル名：customer_point.php
 * 概要：ポイント用のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/02/29
 */
class CustomerPoint extends AppModel {
    var $name       = 'CustomerPoint';
    var $useTable   = false;

    /**
     * ポイント情報をOMSから取得
     */
    function getInfo($customerId) {
        $ret = array();
        $methodPath = 'getcustomerpoints';
        $params = array(
                        'customer_id' => intval($customerId),
        );
        $recs = $this->requestOmsData($methodPath, $params);
        if (!empty($recs['results'])) {
            $ret = $recs['results'];
        }
        return $ret;
    }
}

?>
