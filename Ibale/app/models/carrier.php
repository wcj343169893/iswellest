<?php
/**
 * ファイル名：carrier.php
 * 概要：配送キャリのモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/03/27
 */
class Carrier extends AppModel {
    var $name       = 'Carrier';
    var $primaryKey = 'id';
    var $useTable   = 'carrier';

    /**
     * カテゴリ関連商品情報をOMSから取得
     */
    function getListFromOMS($baseTime) {
        $methodPath = 'getcarrier';
        $params = array(
                        'base_datetime' => $baseTime,
        );
        return $this->requestOmsData($methodPath, $params);
    }
}
?>