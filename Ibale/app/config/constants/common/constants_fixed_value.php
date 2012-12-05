<?php
/**
 * ファイル名：constants_fixed_value.php
 * 概要：ECサイトの固定値用の定数の定義
 *
 * 作成者：shilei  
 * 作成日：2011/12/30
 * 変更履歴：
 */

/**
 * 静的HTMLのキャッチの保留時間
 */
define('STATIC_PAGE_CACHED_DURATION', '+365 day');
/**
 * ショッピングカートの保留時間
 */
define('SHOPPING_BAG_CACHED_DURATION', 60*24*3600);
/**
 * 商品詳細画面で表示な関連商品の件数
 */
define('PRODUCT_DETAIL_RELATION_PRODUCT_LIMIT', 8);
/**
 * 会員IDがないカスタムの名前
 */
define('CUSTOMER_NO_BODY', '匿名');
/**
 * フロント側セッションのキー
 */
define('FRONT_AUTH_SESSION_KEY', 'Auth.Member');
?>
