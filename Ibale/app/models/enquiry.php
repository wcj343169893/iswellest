<?php
/**
 * ファイル名：enquiry.php
 * 概要：問い合わせのモデル
 * 
 * 作成者：shilei
 * 作成日時：2012/01/20
 */
class Enquiry extends AppModel {
    var $name     = 'Enquiry';
    var $useTable = 'enquiry';
    var $validate = array(
                        'type' => array(
                                array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'content' => array(
                                array('rule' => array('maxLength', 500)),
                                array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'reply_content' => array(
                                //array('rule' => array('maxLength', 500)),
                                array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
    );

}
?>
