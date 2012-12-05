<?php
/**
 * ファイル名：app_form.php
 * 概要：ECサイト用のフォームヘルプのクラス
 * 
 * 作成者：shilei
 * 作成日：2012/01/10
 * 変更履歴：
 */
App::import('Helper', 'Form'); 
App::import('Core', 'Sanitize'); 
class AppFormHelper extends FormHelper {

    /**
     * Returns a formatted error message for given FORM field, NULL if no errors.
     *
     * ### Options:
     *
     * - `escape`  bool  Whether or not to html escape the contents of the error.
     * - `wrap`  mixed  Whether or not the error message should be wrapped in a div. If a
     *   string, will be used as the HTML tag to use.
     * - `class` string  The classname for the error message
     *
     * @param string $field A field name, like "Modelname.fieldname"
     * @param mixed $text 検証項目の名前
     * @param array $options Rendering options for <div /> wrapper tag
     * @return string If there are errors this method returns an error message, otherwise null.
     * @access public
     * @link http://book.cakephp.org/view/1423/error
     */
    function error($field, $text = null, $options = array()) {
        $defaults = array('wrap' => true, 'class' => 'error-message', 'escape' => true, 'hasBr' => true);
        $options = array_merge($defaults, $options);
        $this->setEntity($field);
        $error = $this->tagIsInvalid();
        if ($error !== null) {
            if (is_array($error)) {
                list(,,$field) = explode('.', $field);
                if (isset($error[$field])) {
                    $error = $error[$field];
                } else {
                    return null;
                }
            }

            if ($text !== null) {
                $error = str_replace('{0}', $text, $error);
            } elseif (is_numeric($error)) {
                $error = sprintf(__('Error in field %s', true), Inflector::humanize($this->field()));
            }
            if ($options['escape']) {
                $error = h($error);
                unset($options['escape']);
            }
            if ($options['wrap']) {
                $tag = is_string($options['wrap']) ? $options['wrap'] : 'label';
                unset($options['wrap']);
                $out = '';
                if (!empty($options['hasBr'])) {
                    $out .= '<br>';
                }
                $out .= $this->Html->tag($tag, $error, $options);
                return $out;
            } else {
                return $error;
            }
        } else {
            return null;
        }
    }

    /**
     * 編集できるラベルを作成
     * @param unknown_type $name
     * @param unknown_type $options
     *             array(
     *                 'id' => 1,
     *                 'value' => '用户中心',
     *                 'modelName' => 'PageProperty',
     *                 'fieldName' => 'property_value', 
     *                 'onblurFunction' => 'submitForm',
     *                 'uniqueFunction' => 'isExistsName',
     *                 'style' => 'width:100px;',
     *             )
     */
    function labelText($name, $options = array()) {
        $optionsDefault = array(
                                'id'=>'', 
                                'value'=>'', 
                                'onblurFunction'=>'', 
                                'uniqueFunction'=>'', 
                                'associateKeyName'=>'',
                                'associateKeyValue'=>'',
                                'style'=>'',
                                'reloadUrl'=>'',
        );
        $options = array_merge($optionsDefault, $options);
        $onblurFuncton = "saveLineData('{$options['modelName']}','id','{$options['id']}','{$options['fieldName']}',this,'{$options['labelName']}','{$options['uniqueFunction']}','{$options['associateKeyName']}','{$options['associateKeyValue']}','{$options['reloadUrl']}')";
        $out  = "";
        $htmlValue = Sanitize::html($options['value']);
        $out .= "<label id='{$name}Label{$options['id']}' onclick=\"javaScript:showTextBox('{$options['id']}', '{$name}','{$name}Label');\">{$htmlValue}</label>";
        $textOut = $this->text($name, array(
                                'id'=>$name.$options['id'], 
                                'value'=>$options['value'], 
                                'style'=>'display:none;'.$options['style'], 
                                'onblur'=>'javaScript:'.$onblurFuncton.';'));
        //$out .= str_replace("\"", "&quot;", $textOut);
        $out .= $textOut;
        $out .= "<label id='{$name}Error{$options['id']}' class='error-message' style='display:none;'></label>";
        return $out;
    }

    /**
     * Returns a SELECT element for minutes.
     *
     * ### Attributes:
     *
     * - `empty` - If true, the empty select option is shown.  If a string,
     *   that string is displayed as the empty element.
     *
     * @param string $fieldName Prefix name for the SELECT element
     * @param string $selected Option which is selected.
     * @param string $attributes Array of Attributes
     * @return string Completed minute select input.
     * @access public
     * @link http://book.cakephp.org/view/1421/minute
     */
    function minute($fieldName, $selected = null, $attributes = array()) {
        $attributes += array('empty' => true);
        $selected = $this->__dateTimeSelected('min', $fieldName, $selected, $attributes);

        if (strlen($selected) > 2) {
            $selected = date('i', strtotime($selected));
        } elseif ($selected === false) {
            $selected = null;
        }
        $minuteOptions = array();

        if (isset($attributes['interval'])) {
            $minuteOptions['interval'] = $attributes['interval'];
            unset($attributes['interval']);
        }
        return $this->select(
            $fieldName . ".min", $this->__generateOptions('minute', $minuteOptions),
            $selected, $attributes
        );
    }

/**
 * Generates option lists for common <select /> menus
 * @access private
 */
    function __generateOptions($name, $options = array()) {
        if (!empty($this->options[$name])) {
            return $this->options[$name];
        }
        $data = array();

        switch ($name) {
            case 'minute':
                if (isset($options['interval'])) {
                    $interval = $options['interval'];
                } else {
                    $interval = 1;
                }
                $i = 0;
                while ($i < 60) {
                    $data[sprintf('%02d', $i)] = sprintf('%02d', $i);
                    $i += $interval;
                }
            break;
            case 'hour':
                for ($i = 1; $i <= 12; $i++) {
                    $data[sprintf('%02d', $i)] = $i;
                }
            break;
            case 'hour24':
                for ($i = 0; $i <= 23; $i++) {
                    $data[sprintf('%02s', $i)] = sprintf('%02s', $i);
                }
            break;
            case 'meridian':
                $data = array('am' => 'am', 'pm' => 'pm');
            break;
            case 'day':
                $min = 1;
                $max = 31;

                if (isset($options['min'])) {
                    $min = $options['min'];
                }
                if (isset($options['max'])) {
                    $max = $options['max'];
                }

                for ($i = $min; $i <= $max; $i++) {
                    $data[sprintf('%02d', $i)] = sprintf('%02d', $i);
                }
            break;
            case 'month':
                if ($options['monthNames'] === true) {
                    $data['01'] = __('January', true);
                    $data['02'] = __('February', true);
                    $data['03'] = __('March', true);
                    $data['04'] = __('April', true);
                    $data['05'] = __('May', true);
                    $data['06'] = __('June', true);
                    $data['07'] = __('July', true);
                    $data['08'] = __('August', true);
                    $data['09'] = __('September', true);
                    $data['10'] = __('October', true);
                    $data['11'] = __('November', true);
                    $data['12'] = __('December', true);
                } else if (is_array($options['monthNames'])) {
                    $data = $options['monthNames'];
                } else {
                    for ($m = 1; $m <= 12; $m++) {
                        $data[sprintf("%02s", $m)] = strftime("%m", mktime(1, 1, 1, $m, 1, 1999));
                    }
                }
            break;
            case 'year':
                $current = intval(date('Y'));

                if (!isset($options['min'])) {
                    $min = $current - 20;
                } else {
                    $min = $options['min'];
                }

                if (!isset($options['max'])) {
                    $max = $current + 20;
                } else {
                    $max = $options['max'];
                }
                if ($min > $max) {
                    list($min, $max) = array($max, $min);
                }
                for ($i = $min; $i <= $max; $i++) {
                    $data[$i] = $i;
                }
                if ($options['order'] != 'asc') {
                    $data = array_reverse($data, true);
                }
            break;
        }
        $this->__options[$name] = $data;
        return $this->__options[$name];
    }
}
?>
