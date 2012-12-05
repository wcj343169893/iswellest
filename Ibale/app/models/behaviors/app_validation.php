<?php
/**
 * ファイル名：app_validation.php
 * 概要：ECサイトのモデル
 *
 * 作成者：shilei
 * 作成日：2011/12/30
 * 変更履歴：
 */
App::import('Core', 'Validation');
/**
 * Offers different validation methods.
 *
 * @package       cake
 * @subpackage    cake.cake.libs
 * @since         CakePHP v 1.2.0.3830
 */
class AppValidation extends Validation {

    /**
     * 電話番号のチェックを行う
     * @author shilei
     * @param $check フォームのデータ
     * @return TRUE: 有効 FALSE:無効
     */
    function phone($check) {
        return preg_match(TEL_REG, $check);
    }

    /**
     * Mobile電話番号のチェックを行う
     * @author shilei
     * @param $check フォームのデータ
     * @return TRUE: 有効 FALSE:無効
     */
    function checkMobile($check) {
        $value = array_values($check);
        $value = $value[0];

        return preg_match(MOBILE_REG, $value);
    }

    /**
     * ZIPのチェックを行う
     * @author shilei
     * @param $check フォームのデータ
     * @return TRUE: 有効 FALSE:無効
     */
    function checkZip($check) {
        $value = array_values($check);
        $value = $value[0];

        return preg_match(ZIP_REG, $value);
    }

    /**
     * 空白を入力するのができるのチェックを行う
     * @author shilei
     * @param $validates 検証ルール
     * @return TRUE:できる FALSE:できない
     */
    function _isAllowEmpty($validates) {
        foreach ($validates as $value) {
            if (isset($value['allowEmpty']) && $value['allowEmpty'] === true) {
                return true;
            }
        }
        return false;
    }

    /**
     * price のチェックを行う
     * @author mmzhang
     * @param $check フォームのデータ
     * @return TRUE: 有効 FALSE:無効
     */
    function checkPrice($check, $regex = null) {
        $value = array_values($check);
        $value = $value[0];

        return preg_match(PRICE_REG, $value);
    }

    /**
     * 日付フォーマットのcheckを行う
     * @param $check
     * @param $format
     * @return TRUE:有効 FALSE:無効
     */
    function appDate($check, $format) {
        $_this =& Validation::getInstance();
        $_this->__reset();
        if (empty($check)) {
            return true;
        }

        //$value = array_values($check);
        $_this->check = $check;

        $regex['dmy'] = '%^(?:(?:31(\\/|-|\\.|\\x20)(?:0?[13578]|1[02]))\\1|(?:(?:29|30)(\\/|-|\\.|\\x20)(?:0?[1,3-9]|1[0-2])\\2))(?:(?:1[6-9]|[2-9]\\d)?\\d{2})$|^(?:29(\\/|-|\\.|\\x20)0?2\\3(?:(?:(?:1[6-9]|[2-9]\\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\\d|2[0-8])(\\/|-|\\.|\\x20)(?:(?:0?[1-9])|(?:1[0-2]))\\4(?:(?:1[6-9]|[2-9]\\d)?\\d{2})$%';
        $regex['mdy'] = '%^(?:(?:(?:0?[13578]|1[02])(\\/|-|\\.|\\x20)31)\\1|(?:(?:0?[13-9]|1[0-2])(\\/|-|\\.|\\x20)(?:29|30)\\2))(?:(?:1[6-9]|[2-9]\\d)?\\d{2})$|^(?:0?2(\\/|-|\\.|\\x20)29\\3(?:(?:(?:1[6-9]|[2-9]\\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:(?:0?[1-9])|(?:1[0-2]))(\\/|-|\\.|\\x20)(?:0?[1-9]|1\\d|2[0-8])\\4(?:(?:1[6-9]|[2-9]\\d)?\\d{2})$%';
        $regex['ymd'] = '%^(?:(?:(?:(?:(?:1[6-9]|[2-9]\\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))(\\/|-|\\.|\\x20)(?:0?2\\1(?:29)))|(?:(?:(?:1[6-9]|[2-9]\\d)?\\d{2})(\\/|-||\\.|\\x20)(?:(?:(?:0?[13578]|1[02])\\2(?:31))|(?:(?:0?[1,3-9]|1[0-2])\\2(29|30))|(?:(?:0?[1-9])|(?:1[0-2]))\\2(?:0?[1-9]|1\\d|2[0-8]))))$%';
        $regex['dMy'] = '/^((31(?!\\ (Feb(ruary)?|Apr(il)?|June?|(Sep(?=\\b|t)t?|Nov)(ember)?)))|((30|29)(?!\\ Feb(ruary)?))|(29(?=\\ Feb(ruary)?\\ (((1[6-9]|[2-9]\\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)))))|(0?[1-9])|1\\d|2[0-8])\\ (Jan(uary)?|Feb(ruary)?|Ma(r(ch)?|y)|Apr(il)?|Ju((ly?)|(ne?))|Aug(ust)?|Oct(ober)?|(Sep(?=\\b|t)t?|Nov|Dec)(ember)?)\\ ((1[6-9]|[2-9]\\d)\\d{2})$/';
        $regex['Mdy'] = '/^(?:(((Jan(uary)?|Ma(r(ch)?|y)|Jul(y)?|Aug(ust)?|Oct(ober)?|Dec(ember)?)\\ 31)|((Jan(uary)?|Ma(r(ch)?|y)|Apr(il)?|Ju((ly?)|(ne?))|Aug(ust)?|Oct(ober)?|(Sept|Nov|Dec)(ember)?)\\ (0?[1-9]|([12]\\d)|30))|(Feb(ruary)?\\ (0?[1-9]|1\\d|2[0-8]|(29(?=,?\\ ((1[6-9]|[2-9]\\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)))))))\\,?\\ ((1[6-9]|[2-9]\\d)\\d{2}))$/';
        $regex['My'] = '%^(Jan(uary)?|Feb(ruary)?|Ma(r(ch)?|y)|Apr(il)?|Ju((ly?)|(ne?))|Aug(ust)?|Oct(ober)?|(Sep(?=\\b|t)t?|Nov|Dec)(ember)?)[ /]((1[6-9]|[2-9]\\d)\\d{2})$%';
        $regex['my'] = '%^(((0[123456789]|10|11|12)([- /.])(([1][9][0-9][0-9])|([2][0-9][0-9][0-9]))))$%';

        $format = (is_array($format)) ? array_values($format) : array($format);
 
        foreach ($format as $key) {
            $_this->regex = $regex[$key];
            if ($_this->_check() === true) {
                return true;
            }
        }
        return false;
    }

    /**
     * フィールド値を比較する
     * @param $check1　フィールド１
     * @param $operator 操作符(>,>=,<,<=,==,!=)
     * @param $check2 フィールド２
     * @return TRUE FALSE
     */
    function compareValue($check1, $operator = null, $check2 = null) {
        if (empty($check1) || empty($check2)) {
            return false;
        }

        if (is_array($check2)) {
            extract($check2, EXTR_OVERWRITE);
        }

        // フィールド値を取得
        if (is_array($check2)) {
            $value = array_values($check2);
            $check2 = $value[0];
        } else if ($check2 == 'now') {
            $check2 = date('Y-m-d H:i');
        }

        $operator = str_replace(array(' ', "\t", "\n", "\r", "\0", "\x0B"), '', strtolower($operator));
        switch ($operator) {
            case 'isgreater':
            case '>':
                if ($check1 > $check2) {
                    return true;
                }
                break;
            case 'isless':
            case '<':
                if ($check1 < $check2) {
                    return true;
                }
                break;
            case 'greaterorequal':
            case '>=':
                if ($check1 >= $check2) {
                    return true;
                }
                break;
            case 'lessorequal':
            case '<=':
                if ($check1 <= $check2) {
                    return true;
                }
                break;
            case 'equalto':
            case '==':
                if ($check1 == $check2) {
                    return true;
                }
                break;
            case 'notequal':
            case '!=':
                if ($check1 != $check2) {
                    return true;
                }
                break;
            default:
                $_this =& Validation::getInstance();
                $_this->errors[] = __('You must define the $operator parameter for Validation::comparison()', true);
                break;
        }
        return false;
    }

    /**
     * Validate that a number is in specified range.
     * if $lower and $upper are not set, will return true if
     * $check is a legal finite on this platform
     *
     * @param string $check Value to check
     * @param integer $lower <= limit
     * @param integer $upper >= limit
     * @return boolean Success
     * @access public
     */
    function appRange($check, $lower = null, $upper = null ) {
        $value = array_values($check);
        $check = $value[0];

        if (!is_numeric($check)) {
            return false;
        }
        if (isset($lower) && isset($upper)) {
            return ($check >= $lower && $check <= $upper);
        }
        return is_finite($check);
    }

    /**
     * Checks that a string contains only integer or letters
     *
     * Returns true if string contains only integer or letters
     *
     * $check can be passed as an array:
     * array('check' => 'valueToCheck');
     *
     * @param mixed $check Value to check
     * @return boolean Success
     * @access public
     */
    function alphaNumeric($check) {
        $value = array_values($check);
        $value = $value[0];
        $regex = '/^[a-z\d]*$/i';
        return preg_match($regex, $value);
    }
    
    /**
     * 半角スペースを入力する場合、FALSEを戻る
     * @param $check
     * @return boolean Success
     */
    function noHankuSpace($check){  
        $value = array_values($check);
        $value = $value[0];
        $regex = '/\s/i';
        return !preg_match($regex, $value);
    }
    
    /**
     * そのた市の名前に入力した値をチェックする
     * 機能概要：
     * ①プルダウンーボタンに選択した市の名前が"其他"及びテキストボックスに入力した市の値が空白の場合、
     * TUREを"FALSE"を戻る。
     * ②①以外の場合、"TRUE"を戻る
     * @author shilei 
     * @param $city_name プルダウンーボタンに選択した市の名前
     * @param $city テキストボックスに入力した市の値
     * @return TRUE/FALSE
     */
    function checkCityEmpty($city_name, $city) {
        // 選択した市の値は"その他"、そのた市の入力した値が""の場合 
        if (($city_name == OTHER_CITY_NAME) && empty($city)) {
            return false;
        }
        return true;
    }

    function appUrl($check) {
        return true;
        $ret = parent::url($check, false);
        return $ret;
    }
}

?>