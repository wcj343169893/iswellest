<?php
/**
 * ファイル名：area_controller.php
 * 概要：省市区域用のコントローラ
 * 
 * 作成者：shilei
 * 作成日：2011/12/30
 * 変更履歴：
 */
class AreaController extends AppController {
    var $name = 'Area';
    function beforeFilter() {
        $this->AppAuth->allowedActions = array('*');
        parent::beforeFilter();
    }

    /**
     * 省より市情報を取得する
     */
    function ajax_get_cities() {
        //Configure::write('debug', 0);
        $this->layout = "empty";

        $ret = $this->__getRegions();

        $this->set('cities', $ret);
        $this->render('/elements/common/area_list');
    }

    /**
     * 市より区域情報を取得する
     */
    function ajax_get_regions() {
        Configure::write('debug', 0);
        $this->layout = "empty";

        $ret = $this->__getRegions();
        $this->set('cities', $ret);
        $this->render('/elements/common/area_list');
    }

    /**
     * 区域より郵便番号を取得する
     */
    function ajax_get_zip() {
        Configure::write('debug', 0);
        $this->layout = "empty";

        if (empty($this->params['form']['id'])) {
            exit();
        }
        $areaId = $this->params['form']['id'];
        $zip = $GLOBALS['GLOBALS']['AreaList']['zip'][$areaId];
        echo $zip;
        exit();
    }

    /**
     * 親IDより子の情報を取得する
     */
    function __getRegions() {
        $parentId = '0';
        if (isset($this->params['form']['parentId'])) {
            $parentId = $this->params['form']['parentId'];
        }
        $this->Area->getAreaListByParentId($parentId, $ret);
        return $ret;
    }
}
?>
