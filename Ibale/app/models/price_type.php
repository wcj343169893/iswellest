<?php
/**
 * ファイル名：price_type.php
 * 概要：価格のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/12
 */
class PriceType extends AppModel {
    var $name       = "PriceType";
    var $useTable   = 'price_type';
    var $primaryKey = 'id';

    /**
     * 価格情報をOMSから取得
     */
    function getListFromOMS($baseTime) {
        $methodPath = 'getprice';
        $params = array(
                        'base_datetime' => $baseTime,
        );
        return $this->requestOmsData($methodPath, $params);
    }

    /**
     * おまけ種類を取得
     */
    function getBonusTypeList() {
        $conditions = array(
                            'conditions' => array(
                                                "price_type " => array(PRICE_TYPE_BONUS_LINE_A, PRICE_TYPE_BONUS_LINE_B,PRICE_TYPE_BONUS_LINE_C),
                                                "delete_datetime IS NULL",
                            ),
                            'order'      => array(
                                                "price" => 'ASC',
                            ),
        );
        return $this->find('all', $conditions);
    }

    function getInfoByType($type) {
        $conditions = array(
                            'conditions' => array(
                                                "price_type " => $type,
                                                "apply_start_date <= 'NOW()'",
                                                "delete_datetime IS NULL",
                            ),
                            'order'      => array(
                                                "update_datetime" => 'DESC',
                            ),
        );
        return $this->find('first', $conditions);
    }
}
?>