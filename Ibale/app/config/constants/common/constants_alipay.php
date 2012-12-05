<?php
/**
 * ファイル名：constants_alipay.php
 * 概要：ECサイトのALIPAY用の定数の定義
 *
 * 作成者：shilei  
 * 作成日：2011/12/30
 * 変更履歴：
 */

/**
 * 字符编码格式 目前支持 GBK 或 utf-8
 */
define('ALIPAY_INPUT_CHARSET', 'UTF-8');
/**
 * 加密方式 系统默认(不要修改)
 */
define('ALIPAY_SIGN_TYPE', 'MD5');
/**
 * 访问模式,你可以根据自己的服务器是否支持ssl访问而选择http以及https访问模式(系统默认,不要修改)
 */
define('ALIPAY_TRANSPORT', 'https');
/**
 *bankPay(网银);cartoon(卡通); directPay(余额)。
 */
define('ALIPAY_PAYMETHOD', 'directPay');
/**
 *支付宝类型.1代表商品购买 
 */
define('ALIPAY_PAYMENT_TYPE', '1');
/**
 * 支付宝に関すDB更新用のID
 */
define('UPDATE_ID_ALIPAY', 'ALIPAY');
?>
