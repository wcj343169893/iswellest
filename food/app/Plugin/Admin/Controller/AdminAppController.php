<?php
class AdminAppController extends AppController {
	var $subMenu = array (
			"dashboard" => array (
					array (
							"title" => "Sales Report",
							"className" => "report",
							"url" => "javascript:;" 
					),
					array (
							"title" => "SEO Report",
							"className" => "report_seo",
							"url" => "javascript:;" 
					) 
			),
			"orders" => array (),
			"products" => array (
					array (
							"title" => "Add Product",
							"className" => "",
							"url" => "/admin/products/add" 
					) 
			),
			"users" => array (
					array (
							"title" => "Add user",
							"className" => "useradd btn-user-add",
							"url" => "javascript:;" 
					),
					array (
							"title" => "User groups",
							"className" => "group",
							"url" => "javascript:;" 
					),
					array (
							"title" => "Find user",
							"className" => "search",
							"url" => "javascript:;" 
					) 
			),
			"manage" => array () 
	);
	public function beforeFilter() {
		parent::beforeFilter();
		$rusername = $this->Auth->user ( "username" );
		if ($rusername != "admin") {
			$this->redirect ( "/" );
			return;
		}
		$this->set ( "subMenu", $this->subMenu );
	}
}