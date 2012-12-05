<?php
/**
 * ファイル名：admin.php
 * 概要：管理者情報のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/09
 */
class Admin extends AppModel {
    var $name       = 'Admin';
    var $useTable   = 'admin';

    var $validate = array(
                        'login_id' => array(
                                            array('rule' => array('maxLength', 20)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                                ),
                        'password' => array(
                                            array('rule' => array('maxLength', 16)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                                ),
                        'password_confirm' => array(
                                            array('rule' => array('compareValue', '==',  'password'), 'message'=>'error.twiceInputNotMatch'),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                                ),
    );

}
?>
