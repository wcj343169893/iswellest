<?php

App::uses ( 'AppController', 'Controller' );
class UserController extends AppController {
	var $components = array (
			'RequestHandler',
			'Session' 
	);
	/**
	 * 这些是提供给view页面用的方法库
	 */
	var $helpers = array (
			'Cache',
			'Html',
			'Number',
			'Time',
			'Js',
			'Text',
			'Form' 
	);
	/**
	 * 默认是引入Users这个model
	 * 这里是强制引入User这个model
	 */
	public $uses = array (
			'User' 
	);
	/**
	 * 缓存的某一个方法已经缓存时间
	 * index 需要缓存的方法
	 * duration 缓存时间
	 */
	var $cacheAction = array (
			'index' => array (
					'callbacks' => true,
					'duration' => 3600 
			) 
	);
	/**
	 * 页面分页对象
	 * conditions 查询条件
	 * limit 每页条数
	 * fields 显示字段（空，则显示全部）
	 * order 排序方式
	 */
	var $paginate = array (
			'User' => array (
					'conditions' => array (),
					'limit' => 10,
					'fields' => array (),
					'order' => array (
							'User.id' => 'desc' 
					) 
			) 
	);
	/**
	 * 前台访问方法
	 *
	 * @link /user/index
	 *      
	 */
	public function index() {
		// 分页查询，至于第几页 $paginate 已经构造好了
		$data = $this->paginate ( "User" );
		// 设置值，传给view
		$this->set ( compact ( "data" ) );
	}
	/**
	 * 新增
	 */
	public function add() {
		// 保存
		if ($this->request->is ( "post" )) {
			$this->User->save ( $this->request->data );
			$this->redirect ( array (
					"action" => "index" 
			) );
		}
	}
	/**
	 * 查看
	 */
	public function view($id = 0) {
		$data = $this->User->findById ( $id );
		$this->set ( compact ( "data" ) );
	}
	/**
	 * 修改
	 */
	public function edit($id = 0) {
		if (empty ( $this->request->data )) {
			$this->request->data = $this->User->findById ( $id );
		} else {
			$user=$this->request->data;
			$user["User"]["id"]=$id;
			$this->User->save ($user );
			$this->redirect ( array (
					"action" => "index" 
			) );
		}
	}
	/**
	 * 删除
	 */
	public function delete($id = 0) {
		$this->User->delete ( $id );
		$this->redirect ( array (
				"action" => "index" 
		) );
	}
}
