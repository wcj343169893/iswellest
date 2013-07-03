<?php
/**
 * 用户管理
 * */
App::uses ( 'AdminAppController', 'Admin.Controller' );
class UsersController extends AdminAppController {
	var $uses = array (
			"User",
			"Role" 
	);
	/**
	 * 用户列表
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
		$users_allcount = $this->User->find ( "count", $option );
		if ($users_allcount > 0) {
			$limit = ($p - 1) * $pageSize . "," . $pageSize;
			$option = array (
					"conditons" => array (),
					"limit" => $limit,
					"order" => array (
							"User.id" => "desc" 
					) 
			);
			$users = $this->User->find ( "all", $option );
			$this->set ( compact ( "users" ) );
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
	 * 保存用户信息
	 */
	public function save($id = 0) {
		$data = $this->request->data;
		$user = array (
				"User" => array (
						"first_name" => $data ["firstname"],
						"last_name" => $data ["lastname"],
						"birth_date" => $data ["birthday"],
						"gender" => $data ["gender"],
						"join_date" => date ( "Y-m-d" ),
						"city" => $data ["city"],
						"state" => $data ["state"],
						"country" => $data ["country"],
						"address" => $data ["street"],
						"phone" => $data ["tel"],
						"username" => $data ["userName"],
						"password" => $data ["pass"],
						"email" => $data ["email"],
						"role_id" => $data ["role_id"],
						"active" => $data ["status"],
						"zip" => $data ["zip"] 
				) 
		);
		// 新增
		if (empty ( $id )) {
			$this->User->save ( $user );
			$this->redirect ( "/admin/users/add" );
		} else {
			$user ["User"] ["id"] = $id;
			unset ( $user ["User"] ["password"] );
			$this->User->id = $id;
			$this->User->save ( $user, false );
			$this->redirect ( "/admin/users/edit/" . $id );
		}
	}
	/**
	 * 增加用户
	 */
	public function add() {
		$this->findRoles ();
	}
	/**
	 * 编辑用户信息
	 */
	public function edit($id = 0) {
		$user = $this->User->findById ( $id );
		$this->set ( "user", $user ["User"] );
		$this->set ( "user_role", $user ["Role"] );
		$this->findRoles ();
	}
	/**
	 * 查询系统支持的角色
	 */
	private function findRoles() {
		$roles = $this->Role->find2trees ();
		$this->set ( "roles", $roles );
	}
	/**
	 * 删除用户
	 */
	public function delete() {
	}
	/**
	 * 查看用户详细
	 */
	public function show($id = 0) {
		$this->edit ( $id );
	}
}