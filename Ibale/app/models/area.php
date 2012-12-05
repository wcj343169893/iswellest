<?php
/**
 * ファイル名：area.php
 * 概要：エリアのモジュール
 * 
 * 作成者：shilei
 * 作成日時：2010/02/04
 */
class Area extends AppModel {
    var $name       = 'Area';
    var $primaryKey = 'id';
    var $useTable   = 'area';

    /**
     * 親IDよりエリア情報（ID→名前）を取得
     * @param $parentId
     * @return エリア情報のリスト（例えば、array('1'=> '北京'),...）
     */
    function getAreaListByParentId($parentId = '0', &$ret = array()) {
        $ret = array();
        if (!is_numeric($parentId)) {
            return;
        }
        if (!isset($GLOBALS['GLOBALS']['AreaList'])) {
            $this->getAllOptionList();
        }
        if (isset($GLOBALS['GLOBALS']['AreaList']['tree'][$parentId])) {
            $ret = $GLOBALS['GLOBALS']['AreaList']['tree'][$parentId];
        }

        /**
        $conditions = array(
                        'conditions'    => array(
                                            'parent_id' => $parentId,
                                            'del_flg'   => ACTIVE_FLG_FALSE,
                        ),
                        'order'         => array(
                                            'id'        => 'ASC',
                        ),
                        'recursive'     => '-1',
        );
        $recs = $this->find('all', $conditions);
        if (empty($recs)) {
            return $ret;
        }

        foreach($recs as $key => $value) {
            $value = $value['Area'];
            $ret[$value['id']] = $value['area_name'];
        }
        return $ret;
        */
    }

    /**
     * IDよりエリア名を取得する（廃止）
     * @param $parentId
     * @return エリア名
     */
    function __getAreaName($areaId){
        $name = '';
        if(empty($areaId)){
            return $name;
        }
        $conditions = array(
                        'conditions'    => array(
                                            'id'        => $areaId,
                                            'del_flg'   => ACTIVE_FLG_FALSE,
                        ),
                        'recursive'     => '-1',
        );
        $rec = $this->find('first', $conditions);
        if (!empty($rec)) {
            $name = $rec['Area']['area_name'];
        }

        return $name;
    }

    /**
     * プルダウンーボタン用のカテゴリのリストを取得
     */
    function getAllOptionList(&$ret = array()) {
        if (isset($GLOBALS['GLOBALS']['AreaList'])) {
            $ret = $GLOBALS['GLOBALS']['AreaList'];
            return;
        }

        $conditions = array(
                        'conditions'    => array(
                                            'Area.del_flg ='   => ACTIVE_FLG_FALSE,
                        ),
                        'order'         => array(
                                            'sort_number' => 'ASC',
                                            'id'          => 'ASC',
                        ),
                        'recursive'     => -1,
        );
        $recs = $this->find('all', $conditions);
        if (empty($recs)) {
            return $ret;
        }
        foreach($recs as $k1 => $v1) {
            $value = $v1['Area'];
            $ret[$value['id']] = $value['area_name'];
            if (!empty($value['zip'])) {
                $ret['zip'][$value['id']] = $value['zip'];
            }
            $ret['tree'][$value['parent_id']][$value['id']] = $value['area_name'];
        }

        $GLOBALS['GLOBALS']['AreaList'] = $ret;
    }
}
?>
