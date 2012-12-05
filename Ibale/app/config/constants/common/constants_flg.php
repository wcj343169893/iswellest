<?php
/**
 * ファイル名：constants_flg.php
 * 概要：ECサイトの区分用の定数の定義
 *
 * 作成者：shilei  
 * 作成日：2011/12/30
 * 変更履歴：
 */

/**
 * 有効フラグ：FALSE
 */
define('ACTIVE_FLG_FALSE', '0');
/**
 * 有効フラグ：TRUE
 */
define('ACTIVE_FLG_TRUE', '1');
/**
 * ユーザ種類：管理者
 */
define('USER_TYPE_ADMIN', '1');
/**
 * ユーザ種類：会員
 */
define('USER_TYPE_MEMBER', '2');
/**
 * ページプロパティ：ヘッダー
 */
define('PAGE_PROPERTY_HEADER', '1');
/**
 * ページプロパティ：ヘッダー
 */
define('PAGE_PROPERTY_FOOTER', '2');

/**
 * 問い合わせ状態：未回复
 */
define('ENQUIRY_STATUS_WAIT_ANSWER', '1');
/**
 * 問い合わせ状態：已回复
 */
define('ENQUIRY_STATUS_ANSWERED', '2');
/**
 * 問い合わせ状態：屏蔽
 */
define('ENQUIRY_STATUS_BLOCKED', '3');

/**
 * 商品評価状態：未审核
 */
define('ESTIMATION_STATUS_WAIT_PASS', '1');
/**
 * 商品評価状態：通过
 */
define('ESTIMATION_STATUS_PASSED', '2');
/**
 * 商品評価状態：屏蔽
 */
define('ESTIMATION_STATUS_BLOCKED', '3');
/**
 * ページ設定の種類：トップページ
 */
define('PAGE_SETTING_TYPE_TOP', '1');
/**
 * ページ設定の種類：カテゴリトップ
 */
define('PAGE_SETTING_TYPE_CATEGORY_TOP', '2');
/**
 * ページ設定の種類：ギフトトップ
 */
define('PAGE_SETTING_TYPE_GIFT_TOP', '3');
/**
 * ページ設定の種類：商品一覧用のバナー
 */
define('PAGE_SETTING_TYPE_PRODUCT_LIST_BANNER', '4');
/**
 * ページ設定の種類：ブランドトップ用のバナー
 */
define('PAGE_SETTING_TYPE_BRAND_TOP_BANNER', '5');

/**
 * ギフトの種類：送礼对象
 */
define('GIFT_TYPE_SEND_TO', '1');
/**
 * ギフトの種類：送礼场合
 */
define('GIFT_TYPE_SEND_DATE', '2');

/**
 * 購入種類：普通
 */
define('SALE_METHOD_NORMAL', 'normal');
/**
 * 購入種類：共同購入
 */
define('SALE_METHOD_GROUP_BUY', 'group_buying');
/**
 * 購入種類：KAOYANTA
 */
define('SALE_METHOD_PAID_BY_OTHER', 'paid_by_other');
/**
 * 購入種類：ギフト
 */
define('SALE_METHOD_GIFT', 'gift');
/**
 * 購入種類：KAOYANTA
 */
define('PAY_METHOD_PAID_BY_OTHER', 'paid_by_other');
?>
