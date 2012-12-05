<?php
/**
 * ファイル名：category_top.php
 * 概要：商品種類トップ画面用のモデル
 * 
 * 作成者：shilei
 * 作成日時：2012/01/20
 */
class CategoryTop extends AppModel {
    var $name       = "CategoryTop";
    var $useTable   = 'custom_page_setting';
    var $validate   = array(
                            'name' => array(
                                            array('rule' => array('maxLength', 50)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                            ),
                            'order_number' => array(
                                            array('rule' => array('numeric')),
                                            array('rule' => array('range', 0, 1000)),
                            ),
                            'category1_id' => array(
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                            ),
                            'category3_id' => array(
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                            ),
                            'keywords' => array(
                                            array('rule' => array('maxLength', 30)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                            ),
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
                            'label' => array(
                                            array('rule' => array('maxLength', 255)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                            ),
                            'icon_url' => array(
                                            array('rule' => array('maxLength', 255)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                            ),
                            'pic_path' => array(
                                            array('rule' => array('maxLength', 255)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                            ),
    );

    /**
     *カテゴリトップのリストを取得
     */
    function getList($activeFlg = true) {
        $conditions = array(
                        'conditions'    => array(
                                            'type ='        => PAGE_SETTING_TYPE_CATEGORY_TOP,
                                            'del_flg ='     => ACTIVE_FLG_FALSE,
                        ),
                        'order'         => array(
                                            'order_number'  => 'ASC',
                        ),
        );
        if ($activeFlg) {
            $conditions['conditions']['active_flg =']  = $activeFlg;
        }
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
        clearCache('category_top_cached_keywords','views', '');
    }
}
?>