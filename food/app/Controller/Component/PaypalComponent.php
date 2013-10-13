<?php
App::uses ( 'Component', 'Controller' );
class PaypalComponent extends Component {
	
	public $components = array (
			'Session' 
	);
	public $controller;
	
	public $API_Endpoint = 'https://api-3t.sandbox.paypal.com/nvp';
	public $PAYPAL_URL = 'https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=';
	var $cookingClass;
	public function __construct(ComponentCollection $collection, $settings = array()) {
		$this->controller = $collection->getController ();
		parent::__construct ( $collection, array_merge ( $this->settings, ( array ) $settings ) );
	}
	
	public function initialize(Controller $controller) {
		$this->API_UserName = Configure::read ( 'PAYPAL.API_USERNAME' );
		$this->API_Password = Configure::read ( 'PAYPAL.API_PASSWORD' );
		$this->API_Signature = Configure::read ( 'PAYPAL.API_SIGNATURE' );
		$this->paypay_test = Configure::read ( 'PAYPAL.TEST' );
		$this->version = 64;
		$this->SandboxFlag = true;
		$this->returnURL = Configure::read ( 'PAYPAL.WEBSITE' ) . '/shop/step2';
		$this->cancelURL = Configure::read ( 'PAYPAL.WEBSITE' ) . '/shop/cart';
		$this->paymentType = 'Sale';
		$this->currencyCodeType = 'USD';
		$this->sBNCode = 'PP-ECWizard';
		if ($this->paypay_test) {
			$this->API_Endpoint = "https://api-3t.sandbox.paypal.com/nvp";
			$this->PAYPAL_URL = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=';
		} else {
			$this->API_Endpoint = "https://api-3t.paypal.com/nvp";
			$this->PAYPAL_URL = 'https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=';
		}
	}
	
	public function startup(Controller $controller) {
	}
	/**
	 * 购买课程第一步,一次只能购买一个
	 */
	public function cstep1($cookingClass = array()) {
		$this->cookingClass = $cookingClass;
		$this->returnURL=Configure::read ( 'PAYPAL.WEBSITE' ) . '/shop/cstep2';
		$this->cancelURL=Configure::read ( 'PAYPAL.WEBSITE' ) . '/cooking';
		$resArray=$this->cookingClassExpressCheckout();
		$ack = strtoupper ( $resArray ['ACK'] );
		if ($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING') {
			$this->controller->redirect ( $this->PAYPAL_URL . $resArray ['TOKEN'] );
		}
	}
	public function cookingClassExpressCheckout() {
		$nvpstr = '&RETURNURL=' . $this->returnURL;
		$nvpstr .= '&CANCELURL=' . $this->cancelURL;
		$sumCount = 0;
		App::uses ( "String", "Utility" );
		$nvpstr .= "&L_PAYMENTREQUEST_0_NUMBER" . $sumCount . "=" . $this->cookingClass ["id"];
		$nvpstr .= "&L_PAYMENTREQUEST_0_NAME" . $sumCount . "=" . strip_tags ( $this->cookingClass ["name"] );
		$nvpstr .= "&L_PAYMENTREQUEST_0_DESC" . $sumCount . "=" . String::truncate ( strip_tags ( $this->cookingClass["description"] ), 20 );
		$nvpstr .= "&L_PAYMENTREQUEST_0_AMT" . $sumCount . "=" . $this->cookingClass ["price"];
		$nvpstr .= "&L_PAYMENTREQUEST_0_QTY" . $sumCount . "=1";
		$nvpstr .= "&PAYMENTREQUEST_0_SHIPPINGAMT=0";
		$nvpstr .= "&PAYMENTREQUEST_0_ITEMAMT=" .  $this->cookingClass ["price"];
		$nvpstr .= "&PAYMENTREQUEST_0_AMT=" .  $this->cookingClass ["price"];
		$nvpstr .= '&PAYMENTREQUEST_0_PAYMENTACTION=' . $this->paymentType;
		$nvpstr .= '&PAYMENTREQUEST_0_CURRENCYCODE=' . $this->currencyCodeType;
		$this->Session->write ( 'Shop.Paypal.currencyCodeType', $this->currencyCodeType );
		$this->Session->write ( 'Shop.Paypal.PaymentType', $this->paymentType );
		$resArray = $this->hash_call ( 'SetExpressCheckout', $nvpstr );
		$ack = strtoupper ( $resArray ['ACK'] );
		if ($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING') {
			$token = urldecode ( $resArray ['TOKEN'] );
			$this->Session->write ( 'Shop.Paypal.TOKEN', $token );
		}
		return $resArray;
	}
	public function step1($carts = array()) {
		$this->cart = $carts;
		$resArray = $this->CallShortcutExpressCheckout ();
		$ack = strtoupper ( $resArray ['ACK'] );
		if ($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING') {
			$this->controller->redirect ( $this->PAYPAL_URL . $resArray ['TOKEN'] );
		}
	}
	
	public function CallShortcutExpressCheckout() {
		$nvpstr = '&RETURNURL=' . $this->returnURL;
		$nvpstr .= '&CANCELURL=' . $this->cancelURL;
		$sumCount = 0;
		App::uses ( "String", "Utility" );
		foreach ( $this->cart ["OrderItem"] as $k => $v ) {
			$nvpstr .= "&L_PAYMENTREQUEST_0_NUMBER" . $sumCount . "=" . $v ["product_id"];
			$nvpstr .= "&L_PAYMENTREQUEST_0_NAME" . $sumCount . "=" . strip_tags ( $v ["name"] );
			//$nvpstr .= "&L_PAYMENTREQUEST_0_DESC" . $sumCount . "=" . String::truncate ( strip_tags ( $v ["Product"] ["description"] ), 20 );
			$nvpstr .= "&L_PAYMENTREQUEST_0_AMT" . $sumCount . "=" . $v ["price"];
			$nvpstr .= "&L_PAYMENTREQUEST_0_QTY" . $sumCount . "=" . $v ["weight"];
			$sumCount ++;
		}
		$nvpstr .= "&PAYMENTREQUEST_0_SHIPPINGAMT=0";
		$nvpstr .= "&PAYMENTREQUEST_0_ITEMAMT=" . $this->cart ["Order"] ["subtotal"];
		$nvpstr .= "&PAYMENTREQUEST_0_AMT=" . $this->cart ["Order"] ["subtotal"];
		$nvpstr .= '&PAYMENTREQUEST_0_PAYMENTACTION=' . $this->paymentType;
		$nvpstr .= '&PAYMENTREQUEST_0_CURRENCYCODE=' . $this->currencyCodeType;
		$this->Session->write ( 'Shop.Paypal.currencyCodeType', $this->currencyCodeType );
		$this->Session->write ( 'Shop.Paypal.PaymentType', $this->paymentType );
		$resArray = $this->hash_call ( 'SetExpressCheckout', $nvpstr );
		$ack = strtoupper ( $resArray ['ACK'] );
		if ($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING') {
			$token = urldecode ( $resArray ['TOKEN'] );
			$this->Session->write ( 'Shop.Paypal.TOKEN', $token );
		}
		return $resArray;
	}
	
	public function GetShippingDetails($token) {
		$resArray = $this->hash_call ( 'GetExpressCheckoutDetails', '&TOKEN=' . $token );
		$ack = strtoupper ( $resArray ['ACK'] );
		if ($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING') {
			$this->Session->write ( 'Shop.Paypal.payer_id', $resArray ['PAYERID'] );
		}
		return $resArray;
	}
	
	public function ConfirmPayment($FinalPaymentAmt) {
		$paypal = $this->Session->read ( 'Shop.Paypal' );
		$token = urlencode ( $paypal ['TOKEN'] );
		$paymentType = urlencode ( $paypal ['PaymentType'] );
		$currencyCodeType = urlencode ( $paypal ['currencyCodeType'] );
		$payerID = urlencode ( $paypal ['payer_id'] );
		$serverName = urlencode ( $_SERVER ['SERVER_NAME'] );
		$nvpstr = '&TOKEN=' . $token . '&PAYERID=' . $payerID . '&PAYMENTREQUEST_0_PAYMENTACTION=' . $paymentType . '&PAYMENTREQUEST_0_AMT=' . $FinalPaymentAmt;
		$nvpstr .= '&PAYMENTREQUEST_0_CURRENCYCODE=' . $currencyCodeType . '&IPADDRESS=' . $serverName;
		
		$resArray = $this->hash_call ( 'DoExpressCheckoutPayment', $nvpstr );
		
		$ack = strtoupper ( $resArray ['ACK'] );
		return $resArray;
	}
	
	public function hash_call($methodName, $nvpStr) {
		
		$nvpreq = 'METHOD=' . urlencode ( $methodName ) . '&VERSION=' . urlencode ( $this->version ) . '&PWD=' . urlencode ( $this->API_Password );
		$nvpreq .= '&USER=' . urlencode ( $this->API_UserName ) . '&SIGNATURE=' . urlencode ( $this->API_Signature ) . $nvpStr . '&BUTTONSOURCE=' . urlencode ( $this->sBNCode );
		
		App::uses ( 'HttpSocket', 'Network/Http' );
		$httpSocket = new HttpSocket ();
		
		$response = $httpSocket->post ( $this->API_Endpoint, $nvpreq );
		
		$nvpResArray = $this->deformatNVP ( $response );
		
		return $nvpResArray;
	}
	
	public function deformatNVP($nvpstr) {
		$intial = 0;
		$nvpArray = array ();
		while ( strlen ( $nvpstr ) ) {
			$keypos = strpos ( $nvpstr, '=' );
			$valuepos = strpos ( $nvpstr, '&' ) ? strpos ( $nvpstr, '&' ) : strlen ( $nvpstr );
			$keyval = substr ( $nvpstr, $intial, $keypos );
			$valval = substr ( $nvpstr, $keypos + 1, $valuepos - $keypos - 1 );
			$nvpArray [urldecode ( $keyval )] = urldecode ( $valval );
			$nvpstr = substr ( $nvpstr, $valuepos + 1, strlen ( $nvpstr ) );
		}
		return $nvpArray;
	}

}
