<?php
/**
 * ファイル名：brand.php
 * 概要：ブランド用のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/17
 */
class Address extends AppModel {
    var $name       = 'Address';
    var $primaryKey = 'id';
    var $useTable   = false;
    var $validate   = array(
                        'name' => array(
                                            array('rule' => array('maxLength', 20)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'zip' => array(
                                            array('rule' => array('custom', ZIP_REG), 'message' => 'error.incorrect'),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'address1' => array(
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                                            array('rule' => array('maxLength', 15)),
                        ),
                        'address2' => array(
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                                            array('rule' => array('maxLength', 15)),
                        ),
                        'address3' => array(
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                                            array('rule' => array('maxLength', 15)),
                        ),
                        'address4' => array(
                                            array('rule' => array('maxLength', 50)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'phone' => array(
                                            array('rule' => array('phone')),
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
    );

    /**
     * アドレス情報を保存
     * @see AppModel::save()
     */
    function save($updateData) {
        $ret = array();
        $updateData['mode'] = OMS_SAVE_TYPE_UPDATE;
        $methodPath = 'savecustomerinfo';
        $responseData = $this->requestOmsData($methodPath, $updateData);
        return $responseData;
    }
}
?>