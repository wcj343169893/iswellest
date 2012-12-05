<?php
/**
 * ファイル名：app_basics.php
 * 概要：共通関数の定義
 * 
 * 作成者：shilei
 * 作成日時：2012/01/12
 */

    /**
     * Returns a translated string if one is found; Otherwise, the submitted message.
     *
     * @param string $singular Text to translate
     * @param boolean $return Set to true to return translated string, or false to echo
     * @return mixed translated string if $return is false string will be echoed
     * @link http://book.cakephp.org/view/1121/__
     */
    function __($singular, $return = false) {
        if (!$singular) {
            return;
        }
        if (!class_exists('I18n')) {
            App::import('Core', 'i18n');
        }

        $domain = 'default';
        $dotPos = strpos($singular, '.');
        if ($dotPos !== false) {
            $domain = substr($singular, 0,$dotPos);
        }
        if ($return === false) {
            echo I18n::translate($singular, null, $domain);
        } else {
            return I18n::translate($singular, null, $domain);
        }
    }

    /**
     * デバッグログを出力
     * @param $message
     * @return なし
     */
    function outputLog($message) {
        $filename   = LOGS . 'debug.'.date('Ymd').'.log';
        $log        = new File($filename, true);
        $calledFrom     = debug_backtrace();
        $calledFromStr  = "FILE:".substr(str_replace(ROOT, '', $calledFrom[0]['file']), 1). " ";
        $calledFromStr .= "LINE:".$calledFrom[0]['line'];
        $output     = date('Y-m-d H:i:s') . ' Debug: ' . $calledFromStr. "\n ". print_r($message, true) . "\n";
        if ($log->writable()) {
            return $log->append($output);
        }
    }

    function writeLog($msg) {
        $log_file_path   = $_SERVER['DOCUMENT_ROOT'] . '../tmp/logs/debug.'.date('Ymd').'.log';
        if (!is_writable($log_file_path)) {
            return false;
        }
        
        if (!$handle = @fopen($log_file_path, 'a')) {
             return false;
        }

        if (!empty($msg)) {
            $tmp_msg = '';
            $tmp_msg .= print_r($msg, true);
            $msg = $tmp_msg;
        }
        
      	// ログのレベルの配列
    	$log_levels = array('DEBUG', 'INFO', 'WARNING', 'ERROR');
    	$u_second = __getUsecond();
	    $msg_header_format = '%s [%s] ';
	    $msg_header = sprintf($msg_header_format, date('Y-m-d H:i:s').".".$u_second, 'DEBUG');

        @fwrite($handle, $msg_header. $msg . "\n");
        fclose($handle);
    }
    /**
     * 配列は順番より昇順で作成
     * @param unknown_type $a
     * @param unknown_type $b
     */
    function cmpOrderNumber($a, $b) {
        return (intval($a['order_number']) > intval($b['order_number']));
    }

    /**
     * 配列は注文枝番より降順で作成
     * @param unknown_type $a
     * @param unknown_type $b
     */
    function cmpOrderRecordNum($a, $b) {
        return ($a['order_no'] < $b['order_no'] || ($a['order_no'] == $b['order_no'] && $a['record_num'] > $b['record_num']));
    }

    /**
     * 配列は注文作成時間より降順で作成
     * @param unknown_type $a
     * @param unknown_type $b
     */
    function cmpOrderDatetimeDesc($a, $b) {
        return ($a['order_datetime'] < $b['order_datetime']);
    }

    /**
     * 配列は作成時間より降順で作成
     * @param unknown_type $a
     * @param unknown_type $b
     */
    function cmpCreateDatetimeDesc($a, $b) {
        return ($a['create_datetime'] < $b['create_datetime']);
    }

    /**
     * 配列は更新時間より降順で作成
     * @param unknown_type $a
     * @param unknown_type $b
     */
    function cmpUpdateDatetimeDesc($a, $b) {
        return ($a['update_datetime'] < $b['update_datetime']);
    }

    /**
     * 配列は売買価格より降順で作成
     * @param unknown_type $a
     * @param unknown_type $b
     */
    function cmpSalePriceDesc($a, $b) {
        return (intval($a['sale_price']) < intval($b['sale_price']));
    }

    /**
     * 配列は売買価格より昇順で作成
     * @param unknown_type $a
     * @param unknown_type $b
     */
    function cmpSalePriceAsc($a, $b) {
        return (intval($a['sale_price']) > intval($b['sale_price']));
    }

    /**
     * Objから配列になる
     * @param unknown_type $d
     * @return multitype:
     */
    function objectToArray($d) {
        if (is_object($d)) {
            $d = get_object_vars($d);
        }
 
        if (is_array($d)) {
            return array_map(__FUNCTION__, $d);
        }
        else {
            return $d;
        }
    }

    /**
     * 配列をエスケープになる
     * @param unknown_type $d
     * @return multitype:
     */
    function addslashesToArray($d) {
        if (is_array($d)) {
            foreach($d as $key => $value) {
                if (is_array($value)) {
                    $d[$key] = addslashesToArray($value);
                } else {
                    $d[$key] = (is_string($value))?addslashes($value):$value;
                }
            }
            return $d;
        }
        else {
            return (is_string($value))?addslashes($value):$value;;
        }
    }

    /**
     * メッセージを作成
     * @param unknown_type $msg
     * @param unknown_type $labelName
     * @return mixed
     */
    function renderMsg($msg, $labelName) {
        return str_replace('{0}', $labelName, $msg);
    }
    /**
     * システム時間のミリ秒を取得する
     * @author TD shilei
     * @return システム時間のミリ秒
     */
    function __getUsecond() {
        $temp_result = explode(" ", microtime());
        list($usec, $sec) = explode(" ", microtime());
        return round((float)$usec, 3)*1000;
    }

    /**
     * ハッシュコードを作成
     * @param unknown_type $val
     * @return string
     */
    function createHashCode($val) {
        $ctx = hash_init('sha1');
        hash_update($ctx, $val);
        return hash_final($ctx);
    }

    function splitWordsWithUnderLine($words) {
        $words = preg_replace("/([A-Z]{1})/", "_\$1", $words);
        if (strpos($words, '_') === 0) {
            $words = substr($words, 1);
        }
        return strtolower($words);
    }

    function removeUnderLineFromWords($words) {
        $arrWords = explode('_', $words);
        $words = '';
        foreach($arrWords as $value) {
            $words .= ucfirst($value);
        }
        return $words;
    }

    function arrayToStringForSQL(&$arr, &$str = '') {
        foreach($arr as $key => $value) {
            if (!empty($str)) {
                $str .= ",";
            }
            $str .= "'{$value}'";
        }
    }

    function getRemainTime($endTime) {
        $endTime = strtotime($endTime);
        $remainTime = $endTime - time();
        //日
        $remainDay = floor($remainTime / (24*3600));
        //時間
        $remainHour = floor(($remainTime % (24*3600)) / 3600);
        //分
        $remainMin  = floor((($remainTime % (24*3600)) % 3600) / 60);
        //秒
        $remainSec  = floor((($remainTime % (24*3600)) % 3600) % 60);
        return sprintf("%s天%s小时%s分钟%s秒", $remainDay, $remainHour, $remainMin, $remainSec);
    }

    function mergeArray(&$a, &$b) {
        foreach($b as $key => $value) {
            if (is_array($value)) {
                mergeArray($a[$key], $b[$key]);
            } else {
                $a[$key] = $value;
            }
        }
    }

    function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    function base64url_decode($data) {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    function getMailPrefix($email) {
        return substr($email, 0, strpos($email, '@'));
    }

    function mergeOrderNo($orderNo, $recordNum) {
        return $orderNo.'-'.$recordNum;
    }

    function addArray(&$arr1, $arr2, $useIndex = true) {
        $key = count($arr1);
        if ($useIndex) {
            for($i = 0; $i < count($arr2); $i++) {
                $arr1[$key] = $arr2[$i];
                $key++;
            }
        } else {
            foreach($arr2 as $k2 => $v2) {
                $arr1[$k2] = $arr2[$k2];
            }
        }
    }

    function relocateArrKey(&$arr) {
        $tmp = $arr;
        $arr = array();
        if (!empty($tmp)) {
            foreach($tmp as $key => $value) {
                $arr[] = $value;
            }
        }
        unset($tmp);
    }

    function getMaxValue($arr, $field) {
        if (empty($field)) {
            return max($arr);
        }
        $max = null;
        foreach($arr as $value) {
            if ($value[$field] > $max) {
                $max = $value[$field];
            }
        }
        return $max;
    }
?>