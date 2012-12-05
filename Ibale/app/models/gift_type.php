<?php
/**
 * ファイル名：gift_type.php
 * 概要：ギフト種類のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/02/06
 */
class GiftType extends AppModel {
    var $name     = 'GiftType';
    var $useTable = 'gift_type';

    var $validate = array(
                        'name' => array(
                                array('rule' => array('maxLength', 50)),
                                array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'order_number' => array(
                                array('rule' => array('numeric')),
                                array('rule' => array('range', 0, 1000)),
                        ),
    );

    /**
     * リスト情報を取得
     */
    function getList() {
        $ret = array();
        $conditions = array(
                        'conditions'    => array(
                                            'del_flg ='     => ACTIVE_FLG_FALSE,
                        ),
                        'order'            => array(
                                            'type'          => 'ASC',
                                            'order_number'  => 'ASC',
                        ),
        );
        $recs = $this->find('all', $conditions);
        if (empty($recs)) {
            return $ret;
        }

        foreach($recs as $key => $value) {
            $value = $value['GiftType'];
            $ret[$value['type']][]['GiftType'] = $value;
        }
        return $ret;
    }

    /**
     * リスト情報を取得
     */
    function getOptionList() {
        $ret = array();
        $conditions = array(
                        'conditions'    => array(
                                            'del_flg ='     => ACTIVE_FLG_FALSE,
                        ),
                        'order'            => array(
                                            'type'          => 'ASC',
                                            'order_number'  => 'ASC',
                        ),
        );
        $recs = $this->find('all', $conditions);
        if (empty($recs)) {
            return $ret;
        }

        foreach($recs as $key => $value) {
            $value = $value['GiftType'];
            $ret[$value['type']][$value['id']] = $value['name'];
        }
        return $ret;
    }

    /**
     * 名前が存在かどうかことをチェック
     * @param unknown_type $data
     * @return boolean
     */
    function isExists($data) {
        $conditions = array(
                        'conditions'    => array(
                                            $data['associateKeyName'].' =' => $data['associateKeyValue'],
                                            $data['pKeyName'].' <>'  => $data['pKeyValue'],
                                            $data['fieldName'] .' =' => $data['fieldValue'],
                                            'del_flg ='              => ACTIVE_FLG_FALSE,
                        ),
        );
        $recs = $this->find('all', $conditions);
        if (!empty($recs)) {
            return true;
        }
        return false;
    }

    /**
     * 最大順番を取得
     * @return 最大順番
     */
    function getMaxOrderNumber($type) {
        $conditions = array(
                        'fields'	 => array(
                                        'Max(order_number) AS max_order_number',
                        ),
                        'conditions' => array(
                                        'type'           => $type,
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
}
?>