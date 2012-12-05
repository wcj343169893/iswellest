<?php
class DataSyncController extends AppController {
    var $name       = 'DataSync';
    var $uses       = array();
    var $components = array('Query');
    var $helpers    = array('appForm', 'appSession', 'Paginator');


    function beforeFilter() {
        $this->AppAuth->allowedActions = array(
        );
        parent::beforeFilter();
    }

    /**
     * 画面初期化
     */
    function admin_index() {
        $this->layout = 'admin';
    }
    function admin_execute() {
        //$str = exec("/usr/local/php-5.2.8/bin/php /storage/html/ws/cake/console/cake.php load_oms_data -app /storage/html/ws/app/");
        $str = exec("/usr/local/php-5.3.2/bin/php /storage/html/ws/cake/console/cake.php load_oms_data -app /storage/html/ws/app/");
        die();
    }
}
?>
