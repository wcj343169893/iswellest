<?php
/**
 * ファイル名：common_code.php
 * 概要：コードマスタ用のモデル
 * 
 * 作成者：shilei
 * 作成日時：2012/01/20
 */
class CommonCode extends AppModel {
    var $name    = 'CommonCode';
    var $useTable = 'common_code';

    /**
     * コードリストを作成
     * @return Ambigous <multitype:, unknown>
     */
    function getList() {
        $ret = array();
        if (isset($GLOBALS['GLOBALS']['CommonCodeList'])) {
            return $GLOBALS['GLOBALS']['CommonCodeList'];
        }
        $conditions = array(
                        'conditions'    => array(
                                            //'del_flg'      => ACTIVE_FLG_FALSE,
                        ),
                        'order'         => array(
                                            'order_number' => 'ASC',
                        ),
        );
        $recs = $this->find('all', $conditions);
        foreach($recs as $key => $value) {
            $value = $value['CommonCode'];
            $ret[$value['code_type']][$value['code']] = $value['code_desc'];
        }
        $GLOBALS['GLOBALS']['CommonCodeList'] = $ret;
        return $ret;
    }
}
?>
