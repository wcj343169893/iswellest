<?php
/**
 * ファイル名：estimation.php
 * 概要：評価情報のモデル
 * 
 * 作成者：shilei
 * 作成日時：2012/01/20
 */
class Estimation extends AppModel {
    var $name     = 'Estimation';
    var $useTable = 'estimation';
    var $validate = array(
                        'content' => array(
                                array('rule' => array('maxLength', 500)),
                                array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
    );

    /* (non-PHPdoc)
     * @see AppModel::isExists()
     */
    function isExists($memberId, $orderNo, $recordNum = null, $productCd = null) {
        $conditions = array(
                        'conditions'    => array(
                                            'member_id ='   => $memberId,
                                            'order_no ='    => $orderNo,
                        ),
                        'recursive'     => -1,
        );
        if (!empty($recordNum)) {
            $conditions['conditions']['record_num = '] = $recordNum;
        }
        if (!empty($productCd)) {
            $conditions['conditions']['product_cd = '] = $productCd;
        }
        $recs = $this->find('all', $conditions);
        if (count($recs) == 0) {
            return false;
        }
        foreach($recs as $key => $value) {
            $value = $value['Estimation'];
            $ret[$value['order_no']][$value['record_num']][$value['product_cd']] = true;
        }
        return $ret;
    }

    /**
     * 会員IDと商品番号より評価できることをチェック
     * @param unknown_type $memberId
     * @param unknown_type $productCd
     * @return multitype:unknown |multitype:
     */
    function isEnabledProductCd($memberId, $productCd) {
        //評価したものを取得
        $conditions = array(
                        'conditions'    => array(
                                            'member_id ='   => $memberId,
                                            'product_cd ='  => $productCd,
                        ),
        );
        $recs = $this->find('all', $conditions);
        $pointed = array();
        foreach($recs as $key => $value) {
            $value = $value['Estimation'];
            $pointed[$value['order_no'].$value['record_num']] = true;
        }

        //注文情報リストを取得
        $orderModel = ClassRegistry::init('Order');
        $recs = $orderModel->getListByCustomerId($memberId);
        $orderNos = array();
        foreach($recs as $key => $value) {
            if (!in_array($value['order_no'], $orderNos) && $value['shipping_status'] == SHIPPING_STATUS_SHIPPED) {
                $orderNos[] = $value['order_no'];
            } else {
                continue;
            }
            $orderInfo = $orderModel->getInfo($memberId, $value['order_no']);
            foreach($orderInfo['orders'] as $v1) {
                foreach($v1['product_info_list'] as $v2) {
                    if ($productCd == $v2['product_cd'] && empty($pointed[$orderInfo['order_no'].$v1['record_num']])) {
                        $ret = array('order_no' => $orderInfo['order_no'], 'record_num' => $v1['record_num']);
                        return $ret;
                    }
                }
            }
        }
        return array();
    }

    function save($data = null, $validate = true, $fieldList = array()) {
        parent::save($data, $validate, $fieldList);
    }
}
?>
