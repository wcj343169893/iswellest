<?php
/**
 * ファイル名：postage.php
 * 概要：配送キャリのモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/03/27
 */
class Postage extends AppModel {
    var $name       = 'Postage';
    var $primaryKey = 'id';
    var $useTable   = 'postage';

    /**
     * カテゴリ関連商品情報をOMSから取得
     */
    function getListFromOMS($baseTime) {
        $methodPath = 'getdeliveryleadtime';
        $params = array(
                        'base_datetime' => $baseTime,
        );
        return $this->requestOmsData($methodPath, $params);
    }
}
?>