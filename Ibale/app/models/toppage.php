<?php
/**
 * ファイル名：toppage.php
 * 概要：トップページ用のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/12
 */
class Toppage extends AppModel {
    var $name       = "Toppage";
    var $useTable   = 'custom_page_setting';
    var $validate   = array(
                        'keywords' => array(
                                        array('rule' => array('maxLength', 30)),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'category1_id' => array(
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'category3_id' => array(
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'label' => array(
                                        array('rule' => array('maxLength', 255)),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'icon_url' => array(
                                        array('rule' => array('maxLength', 255)),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'path' => array(
                                        //array('rule' => array('maxLength', 500)),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'url' => array(
                                        array('rule' => array('maxLength', 255)),
                                        array('rule' => array('appUrl')),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'comment' => array(
                                        array('rule' => array('maxLength', 255)),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'order_number' => array(
                                        array('rule' => array('numeric')),
                                        array('rule' => array('range', 0, 1000)),
                        ),
                        'test_url' => array(
                                        array('rule' => array('maxLength', 255)),
                                        array('rule' => array('url')),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'brand_content' => array(
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
    );

    /**
     *カテゴリトップのリストを取得
     */
    function getInfo() {
        $conditions = array(
                        'conditions'    => array(
                                            'Toppage.type ='    => PAGE_SETTING_TYPE_TOP,
                                            'Toppage.del_flg =' => ACTIVE_FLG_FALSE,
                        ),
                        'recursive'     => 0,
        );
        $dataList = $this->find('first', $conditions);
        return $dataList;
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
                                        'type ='         => PAGE_SETTING_TYPE_CATEGORY_TOP,
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
        clearCache('element_cache_toppage_cached_keywords','views', '');
        clearCache('toppage_loadToppageContent_data','custom', '');
        clearCache('toppage_loadToppageData_category_product','custom', '');
    }
}
?>