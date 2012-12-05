<?php
/**
 * ファイル名：manufacturer.php
 * 概要：セール情報のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/02/17
 */
class Manufacturer extends AppModel {
    var $name       = 'Manufacturer';
    var $primaryKey = 'id';
    var $useTable   = 'manufacturer';

    /**
     * セール情報をOMSから取得
     */
    function getListFromOMS($baseTime) {
        $methodPath = 'getmanufacturer';
        $params = array(
                        'base_datetime' => $baseTime,
        );
        return $this->requestOmsData($methodPath, $params);
    }
}
?>