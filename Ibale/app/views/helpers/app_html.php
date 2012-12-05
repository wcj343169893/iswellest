<?php
/**
 * ファイル名：app_html.php
 * 概要：ECサイト用のHTMLヘルプ
 * 
 * 作成者：shilei
 * 作成日：2012/01/16
 * 変更履歴：
 */
App::import('Helper', 'Html'); 
App::import('Core', 'Sanitize'); 
class AppHtmlHelper extends HtmlHelper {

    function html($str) {
    	return Sanitize::html($str);
    }
}
?>