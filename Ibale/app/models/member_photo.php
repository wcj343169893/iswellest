<?php
/**
 * ファイル名：member_photo.php
 * 概要：ブランド用のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/17
 */
class MemberPhoto extends AppModel {
    var $name       = 'MemberPhoto';
    var $primaryKey = 'member_id';
    var $useTable   = 'member_photo';
    var $validate   = array(
                        'member_id' => array(
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'photo_path'  => array(
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
    );

    /**
     * ヘッダーリストを取得
     */
    function getInfo($customerId) {
        $conditions = array(
                        'conditions'    => array(
                                            'MemberPhoto.member_id =' => $customerId,
                                            'MemberPhoto.del_flg ='   => ACTIVE_FLG_FALSE,
                        ),
                        'recursive'     => 0,
        );

        $rec = $this->find('first', $conditions);
        return $rec;
    }
}

?>
