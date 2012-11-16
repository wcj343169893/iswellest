<?php
App::uses ( 'AppController', 'Controller' );
class CategoryController extends AppController {
	var $components = array (
			'RequestHandler',
			'Product',
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
	public function index(){
		$categorys = $this->Product->findCategroy(44);
		$this->set(compact("categorys"));
	}
}
