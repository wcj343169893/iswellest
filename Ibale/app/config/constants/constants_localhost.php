<?php
/**
 * ファイル名：constants_localhost.php
 * 概要：ECサイト用の定数の定義（開発用）
 *
 * 作成者：TD shilei
 * 作成日：2011/12/30
 * 変更履歴：   
 */

/**
 * 管理者のメール
 */
define('SITE_ADMIN_EMAIL', 'shilei@natec.cn');

/**
 * ALIPAY:合作伙伴ID
 */
define('ALIPAY_PARTNER', '2088201564704294');
/**
 * ALIPAY:安全检验码
 */
define('ALIPAY_SECURITY_CODE', 'kh2i8hnd4euxubf80zp64vld4807i5b3');
/**
 * ALIPAY:卖家支付宝帐户
 */
define('ALIPAY_SELLER_EMAIL', 'alipay-test11@alipay.com');
/**
 * OMSのHOST
 */
define ('OMS_HOST', 'http://sandbox.darctech.co.jp');
/**
 * 画像APIのルート
 */
define ('OMS_API_PHOTO_ROOT_URL', OMS_HOST.'/Pimage');
require_once 'constants_comm.php';
/**
 * ALIPAY:ALIPAYからECサイトへURL
 */
define('ALIPAY_RETURN_URL', HTTPS_HOME_PAGE_URL.'/shopping/complete');
/**
 * ALIPAY:ALIPAYからの通信を受信するURL
 */
define('ALIPAY_NOTIFY_URL', HTTPS_HOME_PAGE_URL.'/order/notify_from_alipay/');
?>
