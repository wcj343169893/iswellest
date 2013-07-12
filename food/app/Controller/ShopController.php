<?php
/**
 * http://www.shoppingcartcore.com/
 * */
App::uses ( 'AppController', 'Controller' );
class ShopController extends AppController {
	public $components = array (
			'Cart',
			'Paypal' 
	);
	
	public $uses = array (
			'Product',
			'Cooking',
			'CookingOrder' 
	);
	
	public function beforeFilter() {
		parent::beforeFilter ();
		$this->Auth->allow ( 'itemupdate', "cart", "clear", "address", "update", "step1", "step2", "review", "success" );
		$this->disableCache ();
		// $this->Security->validatePost = false;
	}
	
	public function clear() {
		$this->Cart->clear ();
		$this->Session->setFlash ( 'All item(s) removed from your shopping cart', 'flash_error' );
		$this->redirect ( '/shop/cart' );
	}
	
	public function add() {
		if ($this->request->is ( 'post' )) {
			$id = $this->request->data ['Product'] ['id'];
			$quantity = $this->request->data ['Product'] ['quantity'];
			$product = $this->Cart->add ( $id, $quantity );
		}
		if (! empty ( $product )) {
			$this->Session->setFlash ( $product ['Product'] ['name'] . ' was added to your shopping cart.', 'flash_success' );
		}
		$this->redirect ( $this->referer () );
	}
	
	public function itemupdate() {
		header ( 'Content-type: application/json' );
		if ($this->request->is ( 'ajax' )) {
			$this->Cart->add ( $this->request->data ['id'], $this->request->data ['quantity'] );
		}
		$cart = $this->Session->read ( 'Shop' );
		echo json_encode ( $cart );
		$this->autoRender = false;
		exit ();
	}
	
	public function update() {
		$this->Cart->update ( $this->request->data ['Product'] ['id'], 1 );
	}
	
	public function remove($id = null) {
		$product = $this->Cart->remove ( $id );
		if (! empty ( $product )) {
			$this->Session->setFlash ( $product ['Product'] ['name'] . ' was removed from your shopping cart', 'flash_error' );
		}
		$this->redirect ( array (
				'action' => 'cart' 
		) );
	}
	
	public function cartupdate() {
		if ($this->request->is ( 'post' )) {
			foreach ( $this->request->data ['Product'] as $key => $value ) {
				$p = explode ( '-', $key );
				$this->Cart->add ( $p [1], $value );
			}
			$this->Session->setFlash ( 'Shopping Cart is updated.', 'flash_success' );
		}
		$this->redirect ( array (
				'action' => 'cart' 
		) );
	}
	
	public function cart() {
		$shop = $this->Session->read ( 'Shop' );
		$this->set ( compact ( 'shop' ) );
	}
	
	public function googlecheckout() {
		$this->helpers [] = 'Google';
		$shop = $this->Session->read ( 'Shop' );
		$this->set ( compact ( 'shop' ) );
	}
	
	public function address() {
		
		$shop = $this->Session->read ( 'Shop' );
		if (! $shop ['Order'] ['total']) {
			$this->redirect ( '/' );
		}
		
		if ($this->request->is ( 'post' )) {
			$this->loadModel ( 'Order' );
			$orders = $this->request->data;
			$orders ['Order'] ['billing_address'] = $orders ["Order"] ['shipping_address'];
			$orders ['Order'] ['billing_address2'] = $orders ["Order"] ['shipping_address2'];
			$orders ['Order'] ['billing_city'] = $orders ["Order"] ['shipping_city'];
			$orders ['Order'] ['billing_zip'] = $orders ["Order"] ['shipping_zip'];
			$orders ['Order'] ['billing_state'] = $orders ["Order"] ['shipping_state'];
			$orders ['Order'] ['billing_country'] = $orders ["Order"] ['shipping_country'];
			$this->Order->set ( $orders );
			if ($this->Order->validates ()) {
				$order = $orders ['Order'];
				$order ['order_type'] = 'creditcard';
				$this->Session->write ( 'Shop.Order', $order + $shop ['Order'] );
				$this->redirect ( array (
						'action' => 'review' 
				) );
			} else {
				$this->Session->setFlash ( 'The form could not be saved. Please, try again.', 'flash_error' );
			}
		}
		if (! empty ( $shop ['Order'] )) {
			$this->request->data ['Order'] = $shop ['Order'];
		}
	
	}
	
	public function step1() {
		$paymentAmount = $this->Session->read ( 'Shop.Order.total' );
		if (! $paymentAmount) {
			$this->redirect ( '/' );
		}
		$this->Session->write ( 'Shop.Order.order_type', 'paypal' );
		$cart = $this->Session->read ( 'Shop' );
		$this->Paypal->step1 ( $cart );
	}
	
	public function step2() {
		$token = $this->request->query ['token'];
		$paypal = $this->Paypal->GetShippingDetails ( $token );
		
		$ack = strtoupper ( $paypal ["ACK"] );
		if ($ack == "SUCCESS" || $ack == "SUCESSWITHWARNING") {
			$this->Session->write ( 'Shop.Paypal.Details', $paypal );
			$this->redirect ( array (
					'action' => 'review' 
			) );
		} else {
			$ErrorCode = urldecode ( $paypal ["L_ERRORCODE0"] );
			$ErrorShortMsg = urldecode ( $paypal ["L_SHORTMESSAGE0"] );
			$ErrorLongMsg = urldecode ( $paypal ["L_LONGMESSAGE0"] );
			$ErrorSeverityCode = urldecode ( $paypal ["L_SEVERITYCODE0"] );
			echo "GetExpressCheckoutDetails API call failed. ";
			echo "Detailed Error Message: " . $ErrorLongMsg;
			echo "Short Error Message: " . $ErrorShortMsg;
			echo "Error Code: " . $ErrorCode;
			echo "Error Severity Code: " . $ErrorSeverityCode;
			die ();
		}
	
	}
	
	public function review() {
		
		$shop = $this->Session->read ( 'Shop' );
		
		if (empty ( $shop )) {
			$this->redirect ( '/' );
		}
		
		if ($this->request->is ( 'post' )) {
			
			$this->loadModel ( 'Order' );
			
			$this->Order->set ( $this->request->data );
			if ($this->Order->validates ()) {
				$order = $shop;
				$order ['Order'] ['status'] = 1;
				$order ['Order'] ['ip_address'] = $this->request->clientIp ( false );
				
				if ($shop ['Order'] ['order_type'] == 'paypal') {
					$paypal = $this->Paypal->ConfirmPayment ( $order ['Order'] ['total'] );
					// debug($resArray);
					$ack = strtoupper ( $paypal ['ACK'] );
					if ($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING') {
						$order ['Order'] ['status'] = 2;
					}
					$order ['Order'] ['authorization'] = $paypal ['ACK'];
					// $order['Order']['transaction'] =
					// $paypal['PAYMENTINFO_0_TRANSACTIONID'];
				}
				
				$save = $this->Order->saveAll ( $order, array (
						'validate' => 'first' 
				) );
				if ($save) {
					
					$this->set ( compact ( 'shop' ) );
					
					/*
					 * App::uses ( 'CakeEmail', 'Network/Email' ); $email = new
					 * CakeEmail (); $email->from ( Configure::read (
					 * 'ADMIN_EMAIL' ) )->cc ( Configure::read ( 'ADMIN_EMAIL' )
					 * )->to ( $shop ['Order'] ['email'] )->subject ( 'Shop
					 * Order' )->template ( 'order' )->emailFormat ( 'text'
					 * )->viewVars ( array ( 'shop' => $shop ) )->send ();
					 */
					$this->redirect ( array (
							'action' => 'success' 
					) );
				} else {
					$errors = $this->Order->invalidFields ();
					$this->set ( compact ( 'errors' ) );
				}
			}
		}
		
		if (($shop ['Order'] ['order_type'] == 'paypal') && ! empty ( $shop ['Paypal'] ['Details'] )) {
			$shop ['Order'] ['first_name'] = $shop ['Paypal'] ['Details'] ['FIRSTNAME'];
			$shop ['Order'] ['last_name'] = $shop ['Paypal'] ['Details'] ['LASTNAME'];
			$shop ['Order'] ['email'] = $shop ['Paypal'] ['Details'] ['EMAIL'];
			$shop ['Order'] ['phone'] = '';
			$shop ['Order'] ['billing_address'] = $shop ['Paypal'] ['Details'] ['SHIPTOSTREET'];
			$shop ['Order'] ['billing_address2'] = '';
			$shop ['Order'] ['billing_city'] = $shop ['Paypal'] ['Details'] ['SHIPTOCITY'];
			$shop ['Order'] ['billing_zip'] = $shop ['Paypal'] ['Details'] ['SHIPTOZIP'];
			$shop ['Order'] ['billing_state'] = $shop ['Paypal'] ['Details'] ['SHIPTOSTATE'];
			$shop ['Order'] ['billing_country'] = $shop ['Paypal'] ['Details'] ['SHIPTOCOUNTRYNAME'];
			
			$shop ['Order'] ['shipping_address'] = $shop ['Paypal'] ['Details'] ['SHIPTOSTREET'];
			$shop ['Order'] ['shipping_address2'] = '';
			$shop ['Order'] ['shipping_city'] = $shop ['Paypal'] ['Details'] ['SHIPTOCITY'];
			$shop ['Order'] ['shipping_zip'] = $shop ['Paypal'] ['Details'] ['SHIPTOZIP'];
			$shop ['Order'] ['shipping_state'] = $shop ['Paypal'] ['Details'] ['SHIPTOSTATE'];
			$shop ['Order'] ['shipping_country'] = $shop ['Paypal'] ['Details'] ['SHIPTOCOUNTRYNAME'];
			
			$shop ['Order'] ['order_type'] = 'paypal';
			
			$this->Session->write ( 'Shop.Order', $shop ['Order'] );
		}
		
		$this->set ( compact ( 'shop' ) );
	
	}
	
	public function success() {
		$shop = $this->Session->read ( 'Shop' );
		$this->Cart->clear ();
		if (empty ( $shop )) {
			$this->redirect ( '/' );
		}
		$this->set ( compact ( 'shop' ) );
	}
	/**
	 * 购买课程(需要用户登录)
	 */
	public function buyclass() {
		$id = $this->request->data ["Cooking"] ["id"];
		if (empty ( $id )) {
			return;
		}
		$data = $this->Cooking->find ( "first", array (
				"conditions" => array (
						"Cooking.id" => $id 
				) 
		) );
		if (empty ( $data )) {
			return;
		}
		$class = $data ["Cooking"];
		// 如果是改签课程，计算价格,如果相等或者大于，直接改签成功，否则补差价
		if (! empty ( $this->request->data ["Cooking"] ["change"] )) {
			// 查询以前的课程
			$old_id = $this->Session->read ( "CookingClass.meal" );
			$old_data = $this->Cooking->find ( "first", array (
					"conditions" => array (
							"Cooking.id" => $old_id 
					) 
			) );
			if ($old_data ["Cooking"] ["price"] >= $data ["Cooking"] ["price"]) {
				// 直接成功
				$old_order_id = $this->Session->read ( "CookingClass.meal.oid" );
				if ($this->saveCookingOrder ( $class ["id"], $old_order_id )) {
					$this->Session->setFlash ( __ ( 'Meal Cooking Class Success' ) );
					$this->redirect ( array (
							'controller' => 'users',
							'action' => 'cookingclass' 
					) );
					return;
				}
			} else {
				// 修改价格
				$class ["price"] = $data ["Cooking"] ["price"] - $old_data ["Cooking"] ["price"];
			}
		}
		$this->Session->delete ( "CookingClass.meal" );
		$this->Session->write ( 'Shop.CookingClass.Order', $class );
		$this->Paypal->cstep1 ( $class );
	}
	/**
	 * 购买课程，回调确认订单(直接确认)
	 */
	public function cstep2() {
		$token = $this->request->query ['token'];
		$paypal = $this->Paypal->GetShippingDetails ( $token );
		
		$ack = strtoupper ( $paypal ["ACK"] );
		if ($ack == "SUCCESS" || $ack == "SUCESSWITHWARNING") {
			$this->Session->write ( 'Shop.Paypal.Details', $paypal );
			$this->redirect ( array (
					'action' => 'commitCookingClass' 
			) );
		} else {
			$ErrorCode = urldecode ( $paypal ["L_ERRORCODE0"] );
			$ErrorShortMsg = urldecode ( $paypal ["L_SHORTMESSAGE0"] );
			$ErrorLongMsg = urldecode ( $paypal ["L_LONGMESSAGE0"] );
			$ErrorSeverityCode = urldecode ( $paypal ["L_SEVERITYCODE0"] );
			echo "GetExpressCheckoutDetails API call failed. ";
			echo "Detailed Error Message: " . $ErrorLongMsg;
			echo "Short Error Message: " . $ErrorShortMsg;
			echo "Error Code: " . $ErrorCode;
			echo "Error Severity Code: " . $ErrorSeverityCode;
			die ();
		}
	}
	/**
	 * 保存课程订单/更新订单
	 */
	private function saveCookingOrder($cookingId, $oldId = 0) {
		$user_id = $this->Auth->user ( "id" );
		$corder = array (
				"cooking_id" => $cookingId,
				"user_id" => $user_id 
		);
		$result = $this->CookingOrder->save ( $corder );
		if (! empty ( $oldId )) {
			// 删除旧订单，并删除session值
			$this->CookingOrder->id = $oldId;
			$this->CookingOrder->delete ( $oldId );
			// $sql="UPDATA ".$this->CookingOrder->useTable." set delete=1 where
			// cooking_id={$oldId} and user_id=".$user_id;
			// $this->CookingOrder->query($sql);
			$this->Session->delete ( "CookingClass.meal" );
		}
		return $result;
	}
	/**
	 * 确认购买课程
	 */
	public function commitCookingClass() {
		$class = $this->Session->read ( 'Shop.CookingClass.Order' );
		$paypal = $this->Paypal->ConfirmPayment ( $class ['price'] );
		$ack = strtoupper ( $paypal ['ACK'] );
		if ($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING') {
			// 保存课程订单
			if ($this->saveCookingOrder ( $class ["id"] )) {
				$this->redirect ( array (
						'action' => 'buycookingsuccess' 
				) );
			}
		}
	}
	/**
	 * 购买课程成功
	 */
	public function buycookingsuccess() {
		// 移除cookie里面的只值
		$this->Session->delete ( 'Shop.CookingClass.Order' );
	}
}
