<?php
/**
 * ファイル名：constants_honban.php
 * 概要：ECサイト用の定数の定義（本番環境）
 *
 * 作成者：TD shilei  
 * 作成日：2010/02/02
 * 変更履歴：   
 */
/**
 * 管理者のメール
 */
define('SITE_ADMIN_EMAIL', '爱芭乐<customer@ibale.com>');
//define('SITE_ADMIN_EMAIL', 'service@ibale.com');
/**
 * ALIPAY:合作伙伴ID
 */
define('ALIPAY_PARTNER', '2088801377188876');
/**
 * ALIPAY:安全检验码
 */
define('ALIPAY_SECURITY_CODE', 'v5jhnzhquzo8jy7vkxpou3jbc1tw8dqf');
/**
 * ALIPAY:卖家支付宝帐户
 */
define('ALIPAY_SELLER_EMAIL', 'ibaleucom@126.com');
/**
 * OMSのHOST
 * 
 */
define ('OMS_HOST', 'http://sandbox.darctech.co.jp');
/**
 * 画像APIのルート
 */
define ('OMS_API_PHOTO_ROOT_URL', '');

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
