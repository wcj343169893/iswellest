<?php
/**
 * ファイル名：banner.php
 * 概要：バナー用のモデル
 * 
 * 作成者：shilei
 * 作成日時：2012/02/27
 */
class Banner extends AppModel {
    var $name       = "Banner";
    var $useTable   = 'custom_page_setting';
    var $validate   = array(
                            'path' => array(
                                            //array('rule' => array('maxLength', 60)),
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
    );

    /**
     *カテゴリトップのリストを取得
     */
    function getList() {
        $conditions = array(
                        'conditions'    => array(
                                            'type '         => array(PAGE_SETTING_TYPE_PRODUCT_LIST_BANNER,PAGE_SETTING_TYPE_BRAND_TOP_BANNER),
                                            'del_flg ='     => ACTIVE_FLG_FALSE,
                        ),
                        'order'         => array(
                                            'order_number'  => 'ASC',
                        ),
        );
        $dataList = $this->find('all', $conditions);
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
        clearCache('element_cache_toppage_cached_category_tag','views', '');
    }
}
?>