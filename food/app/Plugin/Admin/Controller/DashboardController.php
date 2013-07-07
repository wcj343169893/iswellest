<?php

App::uses ( 'AdminAppController', 'Admin.Controller' );
class DashboardController extends AdminAppController {
	public $uses = array (
			"Contact",
			"User",
			"Order",
			"Product",
			"OrderItem" 
	);
	
	public function display() {
		// Last 5 Orders
		$this->lastOrders ();
		// Bestsellers
		// New Customers
		$this->newCusomers ();
		// Last 5 Reviews
	}
	private function newCusomers($count = 5) {
		$data = $this->User->find ( "all", array (
				"limit" => $count,
				"order" => array (
						"User.id" => "DESC" 
				) 
		) );
		$this->set ( "newCusomer", $data );
	}
	private function lastOrders($count = 5) {
		$data = $this->Order->find ( "all", array (
				"conditions" => array (
						"Order.status" => 2 
				),
				"limit" => $count,
				"order" => array (
						"Order.modified" => "DESC" 
				),
				"fields" => array (
						"Order.id",
						"`Order`.`email`",
						"`Order`.`first_name`",
						"`Order`.`last_name`",
						"`Order`.`order_item_count`",
						"`Order`.`total`" 
				) 
		) );
		$this->set ( "lastOrder", $data );
	}
}