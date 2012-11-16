<?php
App::uses ( 'AppController', 'Controller' );
class ProductController extends AppController {
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
	/**
	 * 默认是引入Users这个model
	 * 这里是强制引入User这个model
	 * 注意：上面已经有了Product 组件，这里就不用引入数据模型了，数据处理都在Product组件中完成,不然调用的时候有冲突
	 */
// 	public $uses = array (
// 			'Product' 
// 	);
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
	 * 网站首页
	 */
	public function display() {
		//@todo 左侧分类
		//@todo 中间广告
		//@todo 促销精选
		//@todo 新品上市
		$newsProducts = $this->Product->findNews();
		$this->set(compact("newsProducts"));
	}
}
