<?php
/**
 * ファイル名：gift_top.php
 * 概要：ギフトトップ画面用のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/17
 */
class GiftTop extends AppModel {
    var $name       = "GiftTop";
    var $useTable   = 'custom_page_setting';
    var $validate   = array(
                        'keywords' => array(
                                        array('rule' => array('maxLength', 30)),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'category_product_name' => array(
                                        array('rule' => array('maxLength', 50)),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'gift_send_to' => array(
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'gift_send_date' => array(
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
                        'order_number' => array(
                                        array('rule' => array('numeric')),
                                        array('rule' => array('range', 0, 1000)),
                        ),
                        'email' => array(
                                        array('rule' => array('email')),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'min_price' => array(
                                        array('rule' => array('numeric'), 'allowEmpty' =>true),
                                        array('rule' => array('range', 0, 1000), 'allowEmpty' =>true),                        ),
                        'max_price' => array(
                                        array('rule' => array('numeric'), 'allowEmpty' =>true),
                                        array('rule' => array('range', 0, 1000), 'allowEmpty' =>true),
                        ),
    );

    /**
     * 編集内容を取得
     * @return Ambigous <multitype:, NULL, boolean, mixed>
     */
    function getInfo() {
        $conditions = array(
                        'conditions'    => array(
                                            'GiftTop.type ='    => PAGE_SETTING_TYPE_GIFT_TOP,
                                            'GiftTop.del_flg =' => ACTIVE_FLG_FALSE,
                        ),
                        'recursive'     => 0,
        );
        $rec = $this->find('first', $conditions);
        return $rec;
    }
    /* (non-PHPdoc)
     * @see Model::afterSave()
     */
    function afterSave($created) {
        parent::afterSave($created);
        clearCache('element_cache_gift_top_cached_keywords','views', '');
    }
}
?>