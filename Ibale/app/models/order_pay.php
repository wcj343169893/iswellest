<?php
/**
 * ファイル名：order_pay.php
 * 概要：ギフト届け情報のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/03/19
 */
class OrderPay extends AppModel {
    var $name       = 'OrderPay';
    var $primaryKey = 'id';
    var $useTable   = 'order_pay';
    var $validate   = array(
                        'pay_person_email' => array(
                                            array('rule' => array('email')),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'pay_person_name' => array(
                                            array('rule' => array('maxLength', 20)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'receive_person_email' => array(
                                            array('rule' => array('email')),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'receive_person_name' => array(
                                            array('rule' => array('maxLength', 20)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'shipto_name' => array(
                                            array('rule' => array('maxLength', 20)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'shipto_phone' => array(
                                            array('rule' => array('maxLength', 255)),
                                            array('rule' => array('phone')),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'shipto_zip' => array(
                                            array('rule' => array('custom', ZIP_REG), 'message' => 'error.incorrect'),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'shipto_address1' => array(
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'shipto_address2' => array(
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'shipto_address3' => array(
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'shipto_address4' => array(
                                            array('rule' => array('maxLength', 500)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
    );

    function getInfo($customerId, $orderNo) {
        $conditions = array(
                        'conditions'    => array(
                                            'OrderPay.order_no ='  => $orderNo,
                                            'OrderPay.member_id =' => $customerId,
                        ),
                        'recursive'     => -1,
        );
        $rec = $this->find('first', $conditions);
        return $rec;
    }

}
?>