<?php
/**
 * ファイル名：alipay.php
 * 概要：ALIPAY用のコンポーネント
 * 
 * 作成者：shilei
 * 作成日：2011/12/30
 */

App::import('Vendor', 'alipay/alipay_notify');
App::import('Vendor', 'alipay/alipay_service');
class AlipayComponent extends Object
{
    var $_controller;
    
    function startup(& $controller) {
        $this->_controller = $controller;
    }

    function post_to_alipay(&$orderInfo) {
        $productCd   = $orderInfo['orders'][0]['product_info_list'][0]['product_cd'];
        $productName = $orderInfo['orders'][0]['product_info_list'][0]['product_name'];
        $orderNo = $orderInfo['customer_id'].'_'.$orderInfo['order_no'];

        //Alipayへ送信用のパラメータを作成
        $params = array(
            "return_url"      => ALIPAY_RETURN_URL,
            "notify_url"      => ALIPAY_NOTIFY_URL,
            "subject"         => $orderNo,
            //"body"            => $productName,
            "out_trade_no"    => $orderNo,
            "total_fee"       => $orderInfo['ordered_subtotal'],
            "show_url"        => HTTP_HOME_PAGE_URL. '/product/detail/product_cd:'.$productCd,
        );

        $this->__redirectToAlipay($params);
        return;
    }

    /**
     * Alipayからのデータを受信し、DB更新処理を行う
     */
    function notify_from_alipay(){
        Configure::write('debug', 0);

        if (empty($_POST)) {
            exit();
        }

        $this->log("支付宝からの通知を受信しました。", LOG_INFO);
        $this->log($_POST, LOG_INFO);

        $customerId = intval(substr($_POST['out_trade_no'], 0, 6));
        $orderNo    = intval(substr($_POST['out_trade_no'], 7));

        $alipay = new alipay_notify(ALIPAY_PARTNER, ALIPAY_SECURITY_CODE, ALIPAY_SIGN_TYPE, ALIPAY_TRANSPORT, ALIPAY_TRANSPORT);
        //TODO:for test 
        //$verify_result = $alipay->notify_verify();
        $verify_result = true;
        //認証失敗の場合
        if(!$verify_result) {
            echo "fail";
            $this->log("注文番号：{$orderNo}に対する検証が不正。", LOG_ERROR);
            exit();
        }

        //交易状態が"等待付款"の場合
        if($_POST['trade_status'] == 'WAIT_BUYER_PAY') {
            echo "success";
        }
        //交易状態が"交易结束"の場合
        elseif($_POST['trade_status'] == 'TRADE_FINISHED' ||$_POST['trade_status'] == 'TRADE_SUCCESS') {
            $orderInfo = $this->_controller->Order->getInfo($customerId, $orderNo);
            //注文状態が"注文申請"の場合
            if ($orderInfo['orders'][0]['shipping_status'] == SHIPPING_STATUS_NOTCREDITED) {
                //注文情報更新
                $this->_controller->Order->updatePayment($orderInfo);
    
                //会員E-MAILにメールを送信
                //TODO
            }
            echo "success";
        }
        //交易状態が"交易关闭"の場合
        elseif ($_POST['trade_status'] == 'TRADE_CLOSED') {
            //注文キャンセル
            $orderInfo = $this->_controller->Order->getInfo($customerId, $orderNo);
            if ($orderInfo['orders'][0]['shipping_status'] != SHIPPING_STATUS_CANCELLED) {
                $this->_controller->Order->cancelOrder($orderInfo);
                //会員E-MAILに注文キャンセル完了メールを送信
                $this->__sendMailForCancelOrderToPayer($orderInfo);
            }

            echo "success";
        }
    }

    /**
     * 支付宝への遷移関数
     * @param $params
     * @author shilei
     */
    function __redirectToAlipay($params){
        $params_default = array(
            "service"         => "create_direct_pay_by_user",
            "partner"         => ALIPAY_PARTNER,
            "notify_url"      => '',
            "return_url"      => '',
            "_input_charset"  => ALIPAY_INPUT_CHARSET,
            "subject"         => '',
            "body"            => '',
            "out_trade_no"    => '',
            "total_fee"       => '',
            "payment_type"    => ALIPAY_PAYMENT_TYPE,
            "show_url"        => '',
            "seller_email"    => ALIPAY_SELLER_EMAIL,
            //"buyer_email"     => '',
            //"buyer_id"        => '',
            "paymethod"       => ALIPAY_PAYMETHOD,
            "it_b_pay"        => '',
        );
        $params = array_merge($params_default, $params);
        $alipay = new alipay_service($params, ALIPAY_SECURITY_CODE, ALIPAY_SIGN_TYPE);
        $link=$alipay->create_url();
        outputLog($link);
        $this->_controller->redirect($link);
        return;
    }

    function __sendMailForCancelOrderToPayer(&$orderInfo) {
        $memberModel = ClassRegistry::init('Member');
        $memberInfo = $memberModel->getCustomerInfo($orderInfo['customer_id']);

        $this->_controller->Email->layout   = 'email';
        $this->_controller->Email->sendAs   = 'html';
        $this->_controller->Email->from     = SITE_ADMIN_EMAIL;
        $this->_controller->Email->to       = $memberInfo['email'];
        $this->_controller->Email->subject  = sprintf(__('mail.subjectForCancelOrderToPayer', true), __('info.siteNameCN', true), $orderInfo['order_no']);
        $this->_controller->Email->template = 'cancel_order_to_payer';

        $this->_controller->set('memberInfo', $memberInfo);
        $this->_controller->set('orderInfo', $orderInfo);

        $this->_controller->Email->send();
    }
}
?>
