<?php
/**
 * ファイル名：constants.php
 * 概要：ECサイト用の定数の定義
 *
 * 作成者：shilei
 * 作成日：2011/12/30
 * 変更履歴：
 */

/**
 * サーバの種類(Localhost) 
 */
define('SERVER_TYPE_LOCALHOST', '1');
/**
 * サーバの種類(テストサーバ) 
 */
define('SERVER_TYPE_TEST', '2');
/**
 * サーバの種類(検証環境) 
 */
define('SERVER_TYPE_KENSHU', '3');
/**
 * サーバの種類(本番環境) 
 */
define('SERVER_TYPE_HONBAN', '4');

//サーバ種類を指定
define('SERVER_TYPE', SERVER_TYPE_HONBAN);

//サーバ種類より定数ファイルを利用する
if (SERVER_TYPE == SERVER_TYPE_LOCALHOST) {
	require_once 'constants/constants_localhost.php';
}else if (SERVER_TYPE == SERVER_TYPE_TEST) {
	require_once 'constants/constants_test.php';
}else if (SERVER_TYPE == SERVER_TYPE_KENSHU) {
	require_once 'constants/constants_kenshu.php';
}else if (SERVER_TYPE == SERVER_TYPE_HONBAN) {
	require_once 'constants/constants_honban.php';
}
?>
