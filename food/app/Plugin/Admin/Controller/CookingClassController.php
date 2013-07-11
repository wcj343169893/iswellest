<?php
App::uses ( 'AdminAppController', 'Admin.Controller' );
class CookingClassController extends AdminAppController {
	var $uses = array (
			"Cooking",
			"CookingOrder" 
	);
	/**
	 * 课程列表
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
		$users_allcount = $this->Cooking->find ( "count", $option );
		if ($users_allcount > 0) {
			$limit = ($p - 1) * $pageSize . "," . $pageSize;
			$option = array (
					"conditons" => array (),
					"limit" => $limit,
					"order" => array (
							"Cooking.id" => "desc" 
					) 
			);
			$cooking = $this->Cooking->find ( "all", $option );
			$this->set ( compact ( "cooking" ) );
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
	 * 查看详细
	 */
	public function view($id = 0) {
		$cookingClass = $this->Cooking->find ( "first", array (
				"conditions" => array (
						"Cooking.id" => $id 
				) 
		) );
		$this->set ( "cookingClass", $cookingClass ["Cooking"] );
	}
	/**
	 * 编辑
	 */
	public function edit($id = 0) {
		$this->view ( $id );
	}
	/**
	 * 增加
	 */
	public function add() {
	}
	/**
	 * 删除
	 */
	public function delete($id = 0) {
		$this->Cooking->delete ( $id );
		$this->redirect ( "/admin/cookingclass" );
	}
	/**
	 * 保存
	 */
	public function save() {
		if ($this->request->is ( "post" )) {
			$data = $this->request->data;
			$slug = str_replace ( array (
					" ",
					"'" 
			), "_", strtolower ( $data ["name"] ) );
			// 设置slug 转换时间
			$cookingClass = array (
					"name" => $data ["name"],
					"slug" => $slug,
					"description" => $data ["description"],
					"price" => $data ["price"],
					"video_address" => $data ["video_address"],
					"start_order" => strtotime ( $data ["start_order"] ),
					"start_learning" => strtotime ( $data ["start_learning"] ),
					"end_learning" => strtotime ( $data ["end_learning"] ),
					"active" => $data ["status"],
					"views" => rand ( 20, 120 ) 
			);
			if ($this->Cooking->save ( $cookingClass )) {
				$this->Session->setFlash ( __ ( 'Save Cooking Class Success.' ) );
			}
		}
		$this->redirect ( "/admin/cookingclass" );
	}

}