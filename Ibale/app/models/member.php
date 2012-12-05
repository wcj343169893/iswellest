<?php
/**
 * ファイル名：member.php
 * 概要：会員情報のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/17
 */
class Member extends AppModel {
    var $name       = "Member";
    var $useTable   = false;
    var $validate   = array(
                        'name' => array(
                                            array('rule' => array('maxLength', 10)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'name_pinyin' => array(
                                            array('rule' => array('maxLength', 64)),
                                            array('rule' => array('custom', ENGLISH_NAME), 'allowEmpty' =>true, 'message' => 'error.incorrect'),
                        ),
                        'nickname' => array(
                                            array('rule' => array('maxLength', 10)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'password' => array(
                                            array('rule' => array('minLength', 6), 'message'=> 'error.password'),
                                            array('rule' => array('maxLength', 16), 'message'=> 'error.password'),
                                            array('rule' => array('custom', PASSWORD_REG), 'message'=> 'error.password'),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'password_confirm' => array(
                                            array('rule' => array('compareValue', '==',  'password'), 'message'=>'error.twiceInputNotMatch'),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'email' => array(
                                            array('rule' => array('maxLength', 255)),
                                            array('rule' => array('email')),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'phone' => array(
                                            array('rule' => array('maxLength', 255)),
                                            array('rule' => array('phone')),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'security_code' => array(
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'birthday_comp' => array(
                                            array('rule' => array('appDate', 'ymd')),
                                            //array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'address1' => array(
                                            array('rule' => array('maxLength', 15)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'address2' => array(
                                            array('rule' => array('maxLength', 15)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'address3' => array(
                                            array('rule' => array('maxLength', 15)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'address4' => array(
                                            array('rule' => array('maxLength', 50)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'zip' => array(
                                            array('rule' => array('custom', ZIP_REG), 'allowEmpty' =>true, 'message' => 'error.incorrect'),
                        ),
                        'phone' => array(
                                            array('rule' => array('custom', TEL_REG), 'message' => 'error.incorrect'),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
    );

    /**
     * ブランド情報をOMSから取得
     */
    function getCustomerInfo($id) {
        $ret = array();
        $methodPath = 'getcustomerinfo';
        $params = array(
                        'id' => intval($id),
        );
        $responseData = $this->requestOmsData($methodPath, $params);
        if ($responseData['succeeded'] == ACTIVE_FLG_TRUE) {
            $ret = $responseData['results'];
        } 
        return $ret;
    }

    /**
     * メールと携帯電話をチェック
     * @param unknown_type $email
     * @param unknown_type $phone
     * @return boolean
     */
    function verifyMailAndPhone($email, $phone) {
        $ret = false;
        $methodPath = 'verifyemailandphone';
        $params = array(
                        'email' => $email,
                        'phone' => $phone,
        );
        $responseData = $this->requestOmsData($methodPath, $params);
        if ($responseData['succeeded'] == ACTIVE_FLG_TRUE) {
            $ret = $responseData['results']['id'];
        } 
        return $ret;
        
    }
    /**
     * 会員IDを作成
     * @return Ambigous <string, array>
     */
    function generateCustomerId() {
        $ret = '';
        $methodPath = 'generatecustomerid';
        $params = array();
        $responseData = $this->requestOmsData($methodPath, $params);
        if ($responseData['succeeded'] == ACTIVE_FLG_TRUE) {
            $results = (array)$responseData['results'];
            $ret     = $results['customer_id'];
        }

        return $ret;
    }

    /**
     * 会員情報を保存
     * @see AppModel::save()
     */
    function save($updateData) {
        $ret = array();

        $methodPath = 'savecustomerinfo';
        if (empty($updateData['mode'])) {
            $updateData['mode'] = OMS_SAVE_TYPE_UPDATE;
        }
        $updateData['email_type'] = OMS_MAIL_TYPE_PC;
        $responseData = $this->requestOmsData($methodPath, $updateData);
        return $responseData;
    }

    function findByParams($user) {
        $ret = array();
        $methodPath         = 'authcustomer';
        $params['email']    = $user['Member.email'];
        $params['password'] = $user['Member.password'];
        $responseData = $this->requestOmsData($methodPath, $params);
        if ($responseData['succeeded'] == ACTIVE_FLG_TRUE) {
            $ret = (array)$responseData['results'];
        } 

        return array('Member'=>$ret);
    }
}
?>
