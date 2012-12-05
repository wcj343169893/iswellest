<?php
/**
 * ファイル名：banner.php
 * 概要：バナー用のモデル
 * 
 * 作成者：shilei
 * 作成日時：2012/02/27
 */
class Order extends AppModel {
    var $name       = "Order";
    var $useTable   = false;
    var $validate   = array(
                        'pay_person_email' => array(
                                            array('rule' => array('maxLength', 255)),
                                            array('rule' => array('email')),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'relation_to_payer' => array(
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'message_to_pay_person' => array(
                                            array('rule' => array('maxLength', 500)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'gift_type' => array(
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'fapiao_name' => array(
                                            array('rule' => array('maxLength', 32)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'coupon_code' => array(
                                            array('rule' => array('custom', COUPON_CODE_REG), 'allowEmpty' =>true, 'message' => 'error.incorrect' ),
                        ),
                        'return_reason' => array(
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'return_num' => array(
                                            array('rule' => array('numeric'), 'allowEmpty' =>true, 'message' => 'error.incorrect' ),
                        ),
                        'exchange_num' => array(
                                            array('rule' => array('numeric'), 'allowEmpty' =>true, 'message' => 'error.incorrect' ),
                        ),
                        'address' => array(
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
    );

    /**
     * ブランド情報をOMSから取得
     */
    function getListByCustomerId($customerId, $start = null, $count = null) {
        $methodPath = 'getorderlist';
        $params = array(
                        'customer_id' => $customerId,
                        'start'       => $start,
                        'count'       => $count,
        );
        $ret = $this->requestOmsData($methodPath, $params);
        return $ret['results']['orders'];
    }

    /**
     * 注文詳細を取得
     * @param unknown_type $customerId
     * @param unknown_type $orderNo
     */
    function getInfo($customerId, $orderNo) {
        $methodPath = 'getorderdetail';
        $params = array(
                        'order_no'    => intval($orderNo),
                        'customer_id' => $customerId,
        );
        $ret = $this->requestOmsData($methodPath, $params);
        return $ret['results'];
    }
    /**
     * 注文番号を作成
     */
    function generateOrderNo() {
        $methodPath = 'generateorderno';
        $params = array();
        $ret = $this->requestOmsData($methodPath, $params);
        return $ret['results']['order_no'];
    }

    /**
     * 注文金額を計算
     */
    function calcOrder($params) {
        $methodPath = 'calcorder';
        $ret = $this->requestOmsData($methodPath, $params);
        return $ret;
    }

    /**
     * 注文情報を保存
     * @see AppModel::save()
     */
    function save($updateData, $addFlg = true) {
        $ret = array();

        if ($addFlg) {
            $methodPath = 'addorder';
        } else {
            $methodPath = 'modifyorder';
        }
        $responseData = $this->requestOmsData($methodPath, $updateData);
        return $responseData['results'];
    }

    /**
     * 出荷保留状態を設定・解除する。
     * @param unknown_type $orderInfo
     * @param unknown_type $shipStopFlg
     */
    function setShipStop(&$orderInfo, $shipStopFlg = true) {
        $ret = array();

        $methodPath = 'setshipstop';
        $slips = array();
        foreach($orderInfo['orders'] as $key => $value) {
            $slips[$key]['order_no']   = $orderInfo['order_no'];
            $slips[$key]['record_num'] = $value['record_num'];
        }
        $params = array(
                        'slips' => $slips,
                        'ship_stop_flg' => $shipStopFlg,
        );

        $ret = $this->requestOmsData($methodPath, $params);
        return $ret;
    }

    /**
     * 登録済受注をキャンセルする。
     * @param unknown_type $orderInfo
     */
    function cancelOrder(&$orderInfo) {
        $ret = array();
        $methodPath = 'cancelorder';
        $orderInfoList = array();
        foreach($orderInfo['orders'] as $key => $value) {
            $orderInfoList[$key]['record_num']             = $value['record_num'];
            $orderInfoList[$key]['record_update_datetime'] = $value['update_datetime'];
        }

        $params = array(
                        'order_no'        => intval($orderInfo['order_no']),
                        'order_info_list' => $orderInfoList,
        );
        $ret = $this->requestOmsData($methodPath, $params);
        return $ret;
    }

    /**
     * 注文金額を更新
     * @param unknown_type $orderInfo
     */
    function updatePayment(&$orderInfo) {
        $ret = array();
        $methodPath = 'updatepayment';
        $orderInfoList =  array(
                                'order_no'       => $orderInfo['order_no'],
                                'payment_amount' => floatval($orderInfo['ordered_subtotal']),
        );
        $params = array(
                        'order_info_list' => array($orderInfoList),
        );
        $ret = $this->requestOmsData($methodPath, $params);
        return $ret;
    }

    /**
     * OMSからのレスポンスデータよりリクエストデータを作成
     * @param unknown_type $req
     * @param unknown_type $rep
     */
    function convertRepToReqData(&$req = array(), &$rep) {
        $req = $rep;
        $req['auto_fill_customer_rank']   = true;
        $req['auto_fill_price_and_point'] = true;
        $req['auto_fill_shipping_charge'] = true;
        $req['auto_fill_gift_charge']     = true;
        $req['wish_to_use_point']         = false;
        unset($req['orders']);
        $index = 0;
        foreach($rep['orders'] as $k => $v) {
            if (!empty($v['point_used'])) {
                $req['wish_to_use_point'] = true;
                $req['point_used'] = intval($v['point_used']);
            }

            foreach($v['product_info_list'] as $key => $value) {
                $req['product_info_list'][$index]['price'] = floatval($value['price']);
                $req['product_info_list'][$index]['point'] = intval($value['point']);
                $req['product_info_list'][$index]['product_cd'] = $value['product_cd'];
                $req['product_info_list'][$index]['order_amount'] = $value['order_amount'];
                $req['product_info_list'][$index]['bonus_flg'] = $value['bonus_flg'];
                $req['product_info_list'][$index]['product_cd'] = $value['product_cd'];
                $index++;
            }
        }
        unset($req['order_datetime']);
        unset($req['charged_subtotal']);
        unset($req['difference']);
        unset($req['ordered_subtotal']);
        unset($req['priority_level']);
        
    }
}
?>
