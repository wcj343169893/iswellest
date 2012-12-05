<?php
/**
 * ファイル名：brand_photo.php
 * 概要：ブランド写真用のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/17
 */
class BrandPhoto extends AppModel {
    var $name       = 'BrandPhoto';
    var $primaryKey = 'id';
    var $useTable   = 'brand_photo';

    /**
     * ブランド情報をOMSから取得
     */
    function getListFromOMS($baseTime) {
        $methodPath = 'getbrandimage';
        $params = array(
                        'base_datetime' => $baseTime,
        );
        return $this->requestOmsData($methodPath, $params);
    }
}
?>