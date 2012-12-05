<?php
/*
    *功能：设置帐户有关信息及返回路径
    *版本：2.0
    *日期：2008-08-01
    '说明：
*/
require_once(WWW_ROOT .'../config/constants.php');
$partner         = "";        //合作伙伴ID
$security_code   = "";        //安全检验码
$seller_email    = "";        //卖家支付宝帐户
$_input_charset  = "UTF-8";   //字符编码格式 目前支持 GBK 或 utf-8
$sign_type       = "MD5";     //加密方式 系统默认(不要修改)
$transport       = "https";   //访问模式,你可以根据自己的服务器是否支持ssl访问而选择http以及https访问模式(系统默认,不要修改)
$notify_url      = ALIPAY_NOTIFY_URL; //交易过程中服务器通知的页面 要用 http://格式的完整路径
//$return_url      = "https://localhost/return_url.php";//付完款后跳转的页面 要用 http://格式的完整路径
$show_url        = "http://localhost";         //你网站商品的展示地址
$paymethod       = "directPay";//bankPay(网银);cartoon(卡通); directPay(余额)。
//$it_b_pay        ="1h";

/** 
提示：如何获取安全校验码和合作ID
1.访问 www.alipay.com，然后登陆您的帐户($seller_email).
2.点商家服务.导航栏的下面可以看到
*/
?>
