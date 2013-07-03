<?php
App::uses ( 'AdminAppController', 'Admin.Controller' );
class ProductsController extends AdminAppController {
	var $uses = array (
			"Product" 
	);
	var $helpers = array (
			"Html",
			"Text" 
	);
	public function beforeFilter() {
		parent::beforeFilter ();
	}
	/**
	 * 产品列表
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
		$users_allcount = $this->Product->find ( "count", $option );
		if ($users_allcount > 0) {
			$limit = ($p - 1) * $pageSize . "," . $pageSize;
			$option = array (
					"conditons" => array (),
					"limit" => $limit,
					"order" => array (
							"Product.id" => "desc" 
					) 
			);
			$orders = $this->Product->find ( "all", $option );
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
	/**
	 * 修改/初始化新增
	 */
	public function view($id = 0) {
		
	}
	public function add(){
		$this->view="Products/view";
	}
}