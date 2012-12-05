<?php
/**
 * ファイル名：group_buy.php
 * 概要：共同購入のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/31
 */
class GroupBuy extends AppModel {
    var $name      = 'GroupBuy';
    var $useTable  = 'group_buy';
    var $belongsTo = array(
                        'Product' => array(
                                            'className'  => 'Product',
                                            'foreignKey' => 'product_cd',
                                            'conditions' => array('Product.delete_datetime IS NULL'),
                        ),
    );
    var $validate = array(
                        'title' => array(
                                        array('rule' => array('maxLength', 100)),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'product_cd' => array(
                                        //array('rule' => array('maxLength', 100)),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'max_purchase_number' => array(
                                        array('rule' => array('numeric')),
                                        array('rule' => array('range', 0, 100000)),
                        ),
                        'start_date' => array(
                                        array('rule' => array('appDate', 'ymd')),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'end_date' => array(
                                        array('rule' => array('appDate', 'ymd')),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'start_time_str' => array(
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'end_time_str' => array(
                                        array('rule' => array('compareValue', '>', 'start_time_str'), 'message'=>'error.lessThanStartTime'),
                                        array('rule' => array('compareValue', '>', 'now'), 'message'=>'error.lessThanNow'),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'base_purchase_preson_count_min' => array(
                                        array('rule' => array('numeric')),
                                        array('rule' => array('range', 0, 1000)),
                        ),
                        'base_purchase_preson_count_max' => array(
                                        array('rule' => array('numeric')),
                                        array('rule' => array('range', 0, 1000)),
                        ),
                        'increase_purchase_preson_count_min' => array(
                                        array('rule' => array('numeric')),
                                        array('rule' => array('range', 0, 1000)),
                        ),
                        'increase_purchase_preson_count_max' => array(
                                        array('rule' => array('numeric')),
                                        array('rule' => array('range', 0, 1000)),
                        ),
                        'comment' => array(
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
    );

    /**
     * 情報を取得
     * @param unknown_type $id
     * @return multitype:|unknown
     */
    function getInfo($id, $recursive = '1') {
        $ret = array();
        $conditions = array(
                        'conditions'    => array(
                                            'GroupBuy.id ='          => $id,
                                            'GroupBuy.del_flg ='     => ACTIVE_FLG_FALSE,
                        ),
                        'recursive'     => $recursive,
        );
        $rec = $this->find('first', $conditions);
        return $rec;
    }

    /**
     * 販売数量を更新
     * @param unknown_type $id
     * @param unknown_type $soldNumber
     */
    function updateSoldNumber($id, $soldNumber) {
        $sql = "UPDATE {$this->tablePrefix}group_buy SET purchase_person_count=purchase_person_count+1, purchase_product_count=purchase_product_count+{$soldNumber}, sold_number = sold_number + {$soldNumber} WHERE id={$id}";
        $this->query($sql);
    }
}
?>