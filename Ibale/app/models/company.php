<?php
/**
 * ファイル名：company.php
 * 概要：会社用のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/03/27
 */
class Company extends AppModel {
    var $name       = 'Company';
    var $primaryKey = 'id';
    var $useTable   = 'company';

    /**
     * カテゴリ関連商品情報をOMSから取得
     */
    function getListFromOMS($baseTime) {
        $methodPath = 'getcompany';
        $params = array(
                        'base_datetime' => $baseTime,
        );
        return $this->requestOmsData($methodPath, $params);
    }
}
?>