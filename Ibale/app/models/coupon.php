<?php
/**
 * ファイル名：coupon.php
 * 概要：クーポン用のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/03/15
 */
class Coupon extends AppModel {
    var $name       = 'Coupon';
    var $useTable   = false;

    /**
     * クーポン状態をOMSから取得
     */
    function getCouponStatus($couponCode) {
        $methodPath = 'getcouponstatus';
        $params = array(
                        'couponcode' => $couponCode,
        );
        $ret = $this->requestOmsData($methodPath, $params);
        return $ret['results'];
    }

}
?>
