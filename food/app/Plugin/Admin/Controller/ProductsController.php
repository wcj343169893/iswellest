<?php
App::uses ( 'AdminAppController', 'Admin.Controller' );
class ProductsController extends AdminAppController {
	var $uses = array (
			"Product",
			"Category" 
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
		$this->edit ( $id );
	}
	/**
	 * 新增
	 */
	public function add() {
		// 加载分类
		$this->initCategory ();
	}
	/**
	 * 编辑产品
	 */
	public function edit($id = 0) {
		$id = intval ( $id );
		if ($id > 0) {
			$data = $this->Product->find ( "first", array (
					"conditions" => array (
							"Product.id" => $id 
					) 
			) );
			if (! empty ( $data )) {
				$this->initCategory ();
				$this->set ( "data", $data ["Product"] );
			} else {
				$this->redirect ( "/admin/products/add" );
			}
		} else {
			$this->redirect ( "/admin/products/" );
		}
	}
	/**
	 * 保存产品
	 */
	public function save() {
		if ($this->request->is ( "post" )) {
			$product = $this->request->data;
			if ($this->Product->save ( $product )) {
				$this->redirect ( "/admin/products/edit/" . $this->Product->id );
				return;
			}
		}
		$this->redirect ( "/admin/products/" );
		return;
	}
	/**
	 * 初始化分类
	 */
	private function initCategory() {
		$data = $this->Category->find ( "all" );
		$category = array ();
		foreach ( $data as $k => $v ) {
			$category [$v ["Category"] ["id"]] = $v ["Category"] ["name"];
		}
		$this->set ( compact ( "category" ) );
	
	}
	/**
	 * 上传文件
	 */
	public function uploadify() {
		header ( "Pragma: no-cache" );
		header ( "Cache-Control: no-store, no-cache, max-age=0, must-revalidate" );
		header ( 'Content-Type: text/x-json' );
		header ( 'Content-type: application/json' );
		$verifyToken = md5 ( 'unique_salt' . $_POST ['timestamp'] );
		$result = array (
				"error" => - 1,
				"filePath" => '',
				"size" => 0,
				"message" => __ ( "Error" ) 
		);
		if (! empty ( $_FILES ) && $_POST ['token'] == $verifyToken) {
			$type = empty ( $_REQUEST ["type"] ) ? "" : h ( $_REQUEST ["type"] );
			$filename = $_FILES ['Filedata'] ["name"];
			if ($type == "icon") {
				// @todo 如果type是icon，则自动压缩图片为90*90
			} elseif ($type == "screenshot") {
				// 如果type是截图，则图片尺寸必须为480*800px或800px*480px
			}
			// 上传到临时文件夹
			$result = $this->FileUtil->upload ( $_FILES ['Filedata'] );
			// 上传成功
			if ($result ["error"] == 0) {
				$result ["fileFullPath"] = DS . $this->FileUtil->smallPath . DS . $this->FileUtil->fileName;
				$result ["fileName"] = $filename;
			}
			// $this->log(json_encode($result),"debug");
		}
		echo json_encode ( $result );
		exit ();
	}
}