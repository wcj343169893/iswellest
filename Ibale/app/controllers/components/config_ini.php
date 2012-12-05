<?php
/**
 * ファイル名：config_ini.php
 * 概要：設定ファイル用のコンポーネント
 * 
 * 作成者：shilei
 * 作成日：2011/12/30
 */
 

class ConfigIniComponent extends Object
{
    var $_controller;
    var $config_ini_arr;
    
    function startup(& $controller) {
        $this->_controller = $controller;
        $this->__loadConfigIni();
    }

    /**
     * config.iniファイルの項目値を取得する
     * @param $group_key グループキー（例えば、[item_orders]）
     * @param $key キー（例えば、order_num_limit）
     * @return $group_keyと$keyに対する項目値
     */
    function getConfigValue($group_key = null , $key = null) {
        $group_key = strtolower($group_key);
        $key       = strtolower($key);

        if (empty($this->config_ini_arr)) {
            $this->__loadConfigIni();
        }
        if (isset($this->config_ini_arr[$group_key][$key])) {
            return $this->config_ini_arr[$group_key][$key];
        }
        if (empty($group_key) && isset($this->config_ini_arr[$key])) {
        	return $this->config_ini_arr[$key];
        }
        return '';
    }

    function __loadConfigIni() {
        $ini_file = CONFIGS.'config.ini';
        $this->config_ini_arr = @parse_ini_file($ini_file, true);
    }
}
?>
