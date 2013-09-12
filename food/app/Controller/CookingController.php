<?php
App::uses ( 'AppController', 'Controller' );
/**
 * Cooking class Controller
 *
 * @property Cooking $Cooking
 * @property CookingOrder $CookingOrder
 */
class CookingController extends AppController {
	var $uid;
	var $uses = array (
			"Cooking",
			"CookingOrder" 
	);
	public function index() {
		$now = time (); // 现在的时间戳
		$today = strtotime ( date ( "Y-m-d" ) );
		// 正在火热招生
		$this->findCooking ( "begin_cooking", array (
				"Cooking.start_order <" => $now,
				"Cooking.start_learning >" => $today 
		) );
		// 即将开始招生
		$this->findCooking ( "future_cooking", array (
				"Cooking.start_order >" => $now 
		) );
		// 正在进行中的培训
		$this->findCooking ( "doing_cooking", array (
				"Cooking.start_learning <" => $now 
		) );
	
	}
	private function findCooking($out = "", $option = array()) {
		$_defaultOption = array (
				"conditions" => array (
						"Cooking.active" => 1 
				) 
		);
		$_defaultOption ["conditions"] = array_merge ( $option, $_defaultOption ["conditions"] );
		$data = $this->Cooking->find ( "all", $_defaultOption );
		$this->set ( $out, $data );
	}
	/**
	 * 改签课程
	 */
	public function trainning() {
		$now = time (); // 现在的时间戳
		$today = strtotime ( date ( "Y-m-d" ) );
		$id = $this->Session->read ( "CookingClass.meal" );
		$this->set ( "meal_id", $id );
		// 排除已经报名的课程
		$myCookingOrders = $this->CookingOrder->find ( "all", array (
				"conditions" => array (
						"CookingOrder.user_id" => $this->Auth->user ( "id" ) 
				) 
		) );
		$co_id = array ();
		if (! empty ( $myCookingOrders )) {
			foreach ( $myCookingOrders as $k => $v ) {
				$co_id [] = $v ["CookingOrder"] ["cooking_id"];
			}
		}
		// 正在火热招生
		$this->findCooking ( "begin_cooking", array (
				"Cooking.start_order <" => $now,
				"Cooking.start_learning >" => $today ,
				"Cooking.id <>"=>$co_id
		) );
	}
	/**
	 * 查看详细
	 */
	public function view($id = 0) {
		$_defaultOption = array (
				"conditions" => array (
						"Cooking.active" => 1,
						"Cooking.id" => $id 
				) 
		);
		$data = $this->Cooking->find ( "first", $_defaultOption );
		$this->set ( "data", $data );
	}
	public function beforeFilter() {
		parent::beforeFilter ();
		$this->Auth->allow ( 'add', 'forgetpwd' );
	}

}
