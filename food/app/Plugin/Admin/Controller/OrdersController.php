<?php
App::uses ( 'AdminAppController', 'Admin.Controller' );
class OrdersController extends AdminAppController {
	var $uses = array (
			"Order",
			"OrderItem" 
	);
	/**
	 * 订单列表
	 */
	public function index() {
		$p = $this->request->query ( "page" );
		$pageSize = $this->request->query ( "psize" );
		if (empty ( $p ) || $p < 1) {
			$p = 1;
		}
		if (empty ( $pageSize ) || $pageSize < 1) {
			$pageSize = 10;
		}
		$option = array (
				"conditons" => array ()
		);
		$users_allcount = $this->Order->find ( "count", $option );
		if ($users_allcount > 0) {
			$limit = ($p - 1) * $pageSize . "," . $pageSize;
			$option = array (
					"conditons" => array (),
					"limit" => $limit,
					"order" => array (
							"Order.id" => "desc"
					)
			);
			$orders = $this->Order->find ( "all", $option );
			$this->set ( compact ( "orders" ) );
		}
		$paging = array (
				"count" => $users_allcount,
				"page" => $p,
				"pageSize" => $pageSize,
				"allPage" => ceil ( $users_allcount / $pageSize )
		);
		$this->set ( compact ( "paging" ) );
	}
}