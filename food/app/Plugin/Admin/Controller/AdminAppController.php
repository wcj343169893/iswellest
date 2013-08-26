<?php
class AdminAppController extends AppController {
	var $subMenu = array ();
	public function beforeFilter() {
		parent::beforeFilter ();
		$rusername = $this->Auth->user ( "username" );
		if ($rusername != "admin") {
			$this->redirect ( "/" );
			return;
		}
		$webroot=$this->request->webroot;
		$this->subMenu = array (
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
				"cookingclass" => array (
						array (
								"title" => "Add CookingClass",
								"className" => "add",
								"url" => $webroot."admin/cookingclass/add"
						)
				),
				"products" => array (
						array (
								"title" => "Add Product",
								"className" => "add",
								"url" => $webroot."admin/products/add"
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
		$this->set ( "subMenu", $this->subMenu );
	}
}