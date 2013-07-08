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
		//正在进行中的培训
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
	public function beforeFilter() {
		parent::beforeFilter ();
		$this->Auth->allow ( 'add', 'forgetpwd' );
	}

}
