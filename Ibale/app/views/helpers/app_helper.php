<?php
App::import('Component', 'ConfigIni');

class AppHelper extends Helper {

    function getOrderTypeDesc(&$value) {
        $orderType = '普通订单';
        if (isset($value['orders']) && stripos($value['orders'][0]['product_info_list'][0]['extradata'], 'sale_method='.SALE_METHOD_NORMAL) !== false):
            $orderType='普通订单';
        elseif (isset($value['orders']) && stripos($value['orders'][0]['product_info_list'][0]['extradata'], 'sale_method='.SALE_METHOD_GIFT) !== false):
            $orderType='礼品订单';
        elseif (isset($value['orders']) && stripos($value['orders'][0]['product_info_list'][0]['extradata'], 'sale_method='.SALE_METHOD_PAID_BY_OTHER) !== false):
            $orderType='考验TA订单';
        elseif (isset($value['orders']) && stripos($value['orders'][0]['product_info_list'][0]['extradata'], 'sale_method='.SALE_METHOD_GROUP_BUY) !== false):
            $orderType='团购订单';
        endif;
        return $orderType;
    }

    function getExtradata(&$value, &$ret) {
        if (isset($value['orders'])) {
            preg_match("/(sale_method)(=)([\w\_]*)/i", $value['orders'][0]['product_info_list'][0]['extradata'], $matches1);
            preg_match("/(pay_method)(=)([\w\_]*)/i", $value['orders'][0]['product_info_list'][0]['extradata'], $matches2);
        }

        $ret['sale_method']=(!empty($matches1[3])?$matches1[3]:'');
        $ret['pay_method']=(!empty($matches2[3])?$matches2[3]:'');
    }

    function getConfigValue($group_key = null , $key = null) {
        $configIni = new ConfigIniComponent();
        return $configIni->getConfigValue($group_key , $key);
    }
}
?>