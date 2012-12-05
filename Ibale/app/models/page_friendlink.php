<?php
/**
 * ファイル名：page_friendlink.php
 * 概要：ページ友達リンクのモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/12
 */
class PageFriendlink extends AppModel {
    var $name     = 'PageFriendlink';
    var $useTable = 'page_friendlink';
    var $validate = array(
                        'name' => array(
                                        array('rule' => array('maxLength', 50)),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'url' => array(
                                        array('rule' => array('maxLength', 255)),
                                        array('rule' => array('appUrl')),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'img_url' => array(
                                        array('rule' => array('maxLength', 255)),
                                        array('rule' => array('appUrl')),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'comment' => array(
                                        array('rule' => array('maxLength', 200)),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'order_number' => array(
                                        array('rule' => array('numeric')),
                                        array('rule' => array('range', 0, 1000)),
                        ),
    );

    /**
     * 有効な友達リンクのリストを取得
     * @return Ambigous <multitype:, NULL, boolean, mixed>
     */
    function getList() {
        $conditions = array(
                        'conditions'    => array(
                                            'del_flg ='     => ACTIVE_FLG_FALSE,
                        ),
                        'order'         => array(
                                            'order_number'  => 'ASC',
                        ),
        );
        $recs = $this->find('all', $conditions);
        return $recs;
    }

    /**
     * 最大順番を取得
     * @return 最大順番
     */
    function getMaxOrderNumber() {
        $conditions = array(
                        'fields'	 => array(
                                        'Max(order_number) AS max_order_number',
                        ),
                        'conditions' => array(
                                        'del_flg'        => ACTIVE_FLG_FALSE,
                        ),
                        'recursive'  => 0,
        );
        $rec = $this->find('first', $conditions);
        if (!empty($rec[0]['max_order_number'])) {
            return $rec[0]['max_order_number'];
        }
        return 0;
    }

    /* (non-PHPdoc)
     * @see Model::afterSave()
     */
    function afterSave($created) {
        parent::afterSave($created);
        clearCache('element_cache_toppage_cached_friendlink','views', '');
    }
}
?>