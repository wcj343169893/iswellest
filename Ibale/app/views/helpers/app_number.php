<?php
/**
 * ファイル名：app_number.php
 * 概要：ECサイト用のNumberヘルプ
 * 
 * 作成者：shilei
 * 作成日：2012/02/01
 * 変更履歴：
 */
App::import('Helper', 'Number'); 
class AppNumberHelper extends NumberHelper {
    
    function alphToChinese($alphNumber) {
        array("零","一","二","三","四","五","六","七","八","九","十","百","千","万");
        return $alphNumber;
    }
    
}
?>