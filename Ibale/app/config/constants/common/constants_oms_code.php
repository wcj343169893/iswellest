<?php
/**
 * 更新種類：新規
 */
define('OMS_SAVE_TYPE_INSERT', 'INSERT');
/**
 * 更新種類：更新
 */
define('OMS_SAVE_TYPE_UPDATE', 'UPDATE');
/**
 * メール種類：PC
 */
define('OMS_MAIL_TYPE_PC', 'PC');
/**
 * メール種類：モバイル
 */
define('OMS_MAIL_TYPE_MOBILE', 'MOBILE');
/**
 * 会員ランク：一般
 */
define('CUSTOMER_RANK_NORMAL', 'NORMAL');
/**
 * 会員ランク：ゴールド
 */
define('CUSTOMER_RANK_GOLD', 'GOLD');
/**
 * 会員ランク：プラチナ
 */
define('CUSTOMER_RANK_PLATINUM', 'PLATINUM');
/**
 * 会員ランク：顧客ランク制限なし
 */
define('CUSTOMER_RANK_NONE', 'NONE');

/**
 * 医薬品タイプ：非薬品
 */
define('MEDICINE_TYPE_NOT_MEDICINE', 'NOT_MEDICINE');
/**
 * 医薬品タイプ：薬品
 */
define('MEDICINE_TYPE_MEDICINE_A', 'MEDICINE_A');

/**
 * 商品写真タイプ：記述
 */
define('PRODUCT_PHOTO_TYPE_DESC', 'DESCRIPTION');
/**
 * 商品写真タイプ：package
 */
define('PRODUCT_PHOTO_TYPE_PACKAGE', 'PACKAGE');

/**
 * 売買状態タイプ：通常
 */
define('PRODUCT_SALES_STATUS_NORMAL', 'NORMAL');
/**
 * 売買状態タイプ：売切
 */
define('PRODUCT_SALES_STATUS_STOCK_ONLY', 'STOCK_ONLY');
/**
 * 売買状態タイプ：売切終売
 */
define('PRODUCT_SALES_STATUS_WILL_END_SELLING', 'WILL_END_SELLING');
/**
 * 売買状態タイプ：終売
 */
define('PRODUCT_SALES_STATUS_END_SELLING', 'END_SELLING');
/**
 * 売買状態タイプ：入荷待ち
 */
define('PRODUCT_SALES_STATUS_WAIT_ARRIVAL', 'WAIT_ARRIVAL');
/**
 * 売買状態タイプ：販売禁止
 */
define('PRODUCT_SALES_STATUS_STOP_SELLING', 'STOP_SELLING');

/**
 * 商品タイプ：在庫限り
 */
define('PRODUCT_TYPE_STOCK_ONLY', 'STOCK_ONLY');
/**
 * 商品タイプ：未引当OK
 */
define('PRODUCT_TYPE_NO_LIMIT', 'NO_LIMIT');
/**
 * 商品タイプ：JIT
 */
define('PRODUCT_TYPE_JIT', 'JIT');
/**
 * 商品タイプ：予約販売
 */
define('PRODUCT_TYPE_RESERVATION', 'RESERVATION');
/**
 * 今日から
 */
define('CUSTOMER_RANK_START_POINT_TODAY', 'TODAY');
/**
 *先月末から
 */
define('CUSTOMER_RANK_START_POINT_LATE_LAST_MONTH', 'TODAY');

/**
 *日単位
 */
define('CUSTOMER_RANK_TERM_DAY', 'DAY');
/**
 *月単位
 */
define('CUSTOMER_RANK_TERM_MONTH', 'MONTH');
//入庫
define('STOCK_CHANGED_REASON_STORING', 'STORING');
//出庫
define('STOCK_CHANGED_REASON_TAKEN', 'TAKEN');
//破損
define('STOCK_CHANGED_REASON_BROKEN', 'BROKEN');

//ロゴ画像
define('IMAGE_TYPE_LOGO', 'LOGO');

//固定額引き
define('DISCOUNT_TYPE_FIXED', 'FIXED');
//％割引
define('DISCOUNT_TYPE_PERCENT', 'PERCENT');
//一部無料
define('DISCOUNT_TYPE_SOME_FREE', 'SOME_FREE');

//送料無料ライン
define('PRICE_TYPE_FREE', 'SHIPPING_FREE_LINE');
//ギフト手数料（A）
define('PRICE_TYPE_GIFT_WRAPPING_A', 'GIFT_WRAPPING_A');
//ギフト手数料（B）
define('PRICE_TYPE_GIFT_WRAPPING_B', 'GIFT_WRAPPING_B');
//ギフト手数料（C）
define('PRICE_TYPE_GIFT_WRAPPING_C', 'GIFT_WRAPPING_C');
//代引き手数料 料率
define('PRICE_TYPE_COD_CHARGE_RATIO', 'COD_CHARGE_RATIO');
//代引き手数料 基底額
define('PRICE_TYPE_COD_CHARGE_BASE', 'COD_CHARGE_BASE');
//おまけ付与金額（A）
define('PRICE_TYPE_BONUS_LINE_A', 'BONUS_LINE_A');
//おまけ付与金額（B）
define('PRICE_TYPE_BONUS_LINE_B', 'BONUS_LINE_B');
//おまけ付与金額（C）
define('PRICE_TYPE_BONUS_LINE_C', 'BONUS_LINE_C');

//固定額引き
define('COUPON_TYPE_FIXED', 'FIXED');
//％割引
define('COUPON_TYPE_PERCENT', 'PERCENT');

//未確認
define('CHARGE_STATUS_NOTYET', 'NOTYET');
//確認済
define('CHARGE_STATUS_CONFIRMED', 'CONFIRMED');

//未決済
define('APPROVAL_STATUS_NOTYET', 'NOTYET');
//承認済
define('APPROVAL_STATUS_APPROVED', 'APPROVED');
//却下
define('APPROVAL_STATUS_REJECTED', 'REJECTED');

//ギフトなし
define('GIFT_TYPE_NONE', 'NONE');
//ギフト（A）
define('GIFT_TYPE_TYPE_A', 'TYPE_A');
//ギフト（B）
define('GIFT_TYPE_TYPE_B', 'TYPE_B');
//ギフト（C）
define('GIFT_TYPE_TYPE_C', 'TYPE_C');

//おまけではない
define('BONUS_TYPE_NOT_BONUS', 'NOT_BONUS');
//おまけ商品（A）
define('BONUS_TYPE_BONUS_A', 'BONUS_A');
//おまけ商品（B）
define('BONUS_TYPE_BONUS_B', 'BONUS_B');
//おまけ商品（C）
define('BONUS_TYPE_BONUS_C', 'BONUS_C');

//医薬品サイト
define('CHANNEL_MEDICINE', 'MEDICINE');
//日用品サイト
define('CHANNEL_GOODS', 'GOODS');

//販売
define('ORDER_TYPE_SALE', 'SALE');
//返金
define('ORDER_TYPE_REPAYMENT', 'REPAYMENT');
//ちゃんふー
define('ORDER_TYPE_PREPAID', 'PREPAID');

//キャッチコピー
define('PRODUCT_DESC_TYPE_CATCHCOPY', 'CATCHCOPY');
//商品紹介
define('PRODUCT_DESC_TYPE_INTRODUCTION', 'INTRODUCTION');
//使用方法
define('PRODUCT_DESC_TYPE_HOW_TO_USE', 'HOW_TO_USE');
//注意書き
define('PRODUCT_DESC_TYPE_DISCLAIMER', 'DISCLAIMER');
//原産国
define('PRODUCT_DESC_TYPE_COUNTRY', 'COUNTRY');
//成分
define('PRODUCT_DESC_TYPE_INGREDIENT', 'INGREDIENT');

//廃棄
define('RETURNED_OPERATION_DISPOSE', 'DISPOSE');
//再使用
define('RETURNED_OPERATION_REUSE', 'REUSE');
//メーカー返品
define('RETURNED_OPERATION_SENDBACK', 'SENDBACK');


//倉庫事由
define('RETURNED_REASON_WAREHOUSE_ISSUE', 'WAREHOUSE_ISSUE');
//CS事由
define('RETURNED_REASON_CS_ISSUE', 'CS_ISSUE');
//メーカー事由
define('RETURNED_REASON_MANUFACTURER_ISSUE', 'MANUFACTURER_ISSUE');
//配送事由
define('RETURNED_REASON_CARRIER_ISSUE', 'CARRIER_ISSUE');
//顧客都合
define('RETURNED_REASON_CUSTOMER_ISSUE', 'CUSTOMER_ISSUE');

//ラッピング済
define('WRAPPING_TYPE_ALREADY_WRAPPED', 'ALREADY_WRAPPED');
//ラッピング可能
define('WRAPPING_TYPE_ENABLE', 'ENABLE');
//ラッピング不可
define('WRAPPING_TYPE_DISABLE', 'DISABLE');

//対象商品１つ毎に値引き
define('SALERULE_TYPE_DISCOUNT_PER_ONE', 'DISCOUNT_PER_ONE');
//対象商品を対象個数以上購入時に値引き
define('SALERULE_TYPE_DISCOUNT_PER_AMOUNT', 'DISCOUNT_PER_AMOUNT');
//対象商品をすべて購入すると値引き
define('SALERULE_TYPE_DISCOUNT_PER_SET', 'DISCOUNT_PER_SET');
//対象商品すべてを合計し、対象個数以上購入時に値引き
define('SALERULE_TYPE_DISCOUNT_PER_ASSORT', 'DISCOUNT_PER_ASSORT');
//対象商品を対象個数以上購入時に値引き
define('SALERULE_TYPE_DISCOUNT_BY_SUBTOTAL', 'DISCOUNT_BY_SUBTOTAL');
//SALERULETYPE.NEEDS_SUBTOTAL
define('SALERULE_TYPE_NEEDS_SUBTOTAL', 'NEEDS_SUBTOTAL');
//SALERULETYPE.NEEDS_AMOUNT
define('SALERULE_TYPE_NEEDS_AMOUNT', 'NEEDS_AMOUNT');

//OMS
define('SYSTEM_TYPE_OMS', 'OMS');

//入金待ち
define('SHIPPING_STATUS_NOTCREDITED', 'NOTCREDITED');
//未出荷
define('SHIPPING_STATUS_NOTYET', 'NOTYET');
//入庫待ち
define('SHIPPING_STATUS_WAIT_ARRIVAL', 'WAIT_ARRIVAL');
//出荷中
define('SHIPPING_STATUS_SHIPPING', 'SHIPPING');
//出荷済
define('SHIPPING_STATUS_SHIPPED', 'SHIPPED');
//TODO:配送済
define('SHIPPING_STATUS_DELIVERED', 'DELIVERED');
//注文キャンセル
define('SHIPPING_STATUS_CANCELLED', 'CANCELLED');
//未入金返送
define('SHIPPING_STATUS_REJECTED', 'REJECTED');
//返金待ち
define('SHIPPING_STATUS_WAIT_REPAYMENT', 'WAIT_REPAYMENT');
//返金済
define('SHIPPING_STATUS_FINISH_REPAYMENT', 'FINISH_REPAYMENT');
//SHIPPINGSTATUS.EDITABLES
define('SHIPPING_STATUS_EDITABLES', 'EDITABLES');

//男性
define('SEX_MALE', 'MALE');
//女性
define('SEX_FEMALE', 'FEMALE');

//代引
define('CHARGE_TYPE_COD', 'COD');
//アリペイ
define('CHARGE_TYPE_ALIPAY', 'ALIPAY');
//CHARGETYPE.PREPAIDS
define('CHARGE_TYPE_PREPAIDS', 'PREPAIDS');
//支払い不要
define('CHARGE_TYPE_NONE', 'NONE');

//サイズ（小）
define('SIZE_TYPE_SMALL', 'SMALL');
//サイズ（中）
define('SIZE_TYPE_MIDDLE', 'MIDDLE');
//サイズ（大）
define('SIZE_TYPE_LARGE', 'LARGE');
//サイズ（巨大）
define('SIZE_TYPE_XLARGE', 'XLARGE');

//通常
define('ORDER_PRIORITY_NORMAL', 'NORMAL');
//優先
define('ORDER_PRIORITY_HIGH', 'HIGH');
//最優先
define('ORDER_PRIORITY_TOP', 'TOP');

?>