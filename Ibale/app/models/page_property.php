<?php
/**
 * ファイル名：page_property.php
 * 概要：ページプロパティのモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/12
 */
class PageProperty extends AppModel {
    var $name     = 'PageProperty';
    var $useTable = 'page_property';

    var $validate = array(
                        'name' => array(
                                        array('rule' => array('maxLength', 50)),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'url' => array(
                                        array('rule' => array('maxLength', 255)),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                                        array('rule' => array('appUrl')),
                        ),
                        'order_number' => array(
                                        array('rule' => array('numeric')),
                                        array('rule' => array('range', 0, 1000)),
                        ),
    );

    /**
     * プロパティリストを取得
     */
    function getList() {
        $ret = array();
        $conditions = array(
                        'conditions'    => array(
                                            'del_flg ='     => ACTIVE_FLG_FALSE,
                        ),
                        'order'            => array(
                                            'type'          => 'ASC',
                                            'order_number'  => 'ASC',
                        ),
        );
        $recs = $this->find('all', $conditions);
        if (empty($recs)) {
            return $ret;
        }

        foreach($recs as $key => $value) {
            $value = $value['PageProperty'];
            $ret[$value['type']][]['PageProperty'] = $value;
        }
        return $ret;
    }
    /**
     * プロパティ名前が存在かどうかことをチェック
     * @param unknown_type $data
     * @return boolean
     */
    function isExists($data) {
        $conditions = array(
                        'conditions'    => array(
                                            $data['associateKeyName'].' =' => $data['associateKeyValue'],
                                            $data['pKeyName'].' <>'  => $data['pKeyValue'],
                                            $data['fieldName'] .' =' => $data['fieldValue'],
                                            'del_flg ='              => ACTIVE_FLG_FALSE,
                        ),
        );
        $recs = $this->find('all', $conditions);
        if (!empty($recs)) {
            return true;
        }
        return false;
    }

    /* (non-PHPdoc)
     * @see Model::afterSave()
     */
    function afterSave($created) {
        parent::afterSave($created);
        clearCache('element_cache_toppage_cached_headerlink','views', '');
        clearCache('element_cache_toppage_cached_copyright','views', '');
    }
    
	function updateAll($fields, $conditions = true) {
		parent::updateAll($fields, $conditions);
		clearCache('element_cache_toppage_cached_copyright','views', '');
	}
}
?>