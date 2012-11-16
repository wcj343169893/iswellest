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
	// public $uses = array (
	// 'Product'
	// );
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
		// @todo 左侧分类
		// @todo 中间广告
		// @todo 促销精选
		// @todo 新品上市
		$newsProducts = $this->Product->findNews ();
		// 基础护肤
		$base_products = $this->Product->findByPage ( 1, 8, array (
				"conditions" => array (
						"Product.product_type" => 1 
				) 
		) );
		// 婴儿护肤
		$baby_products = $this->Product->findByPage ( 1, 8, array (
				"conditions" => array (
						"Product.product_type" => 2 
				) 
		) );
		// 日常护理
		$day_products = $this->Product->findByPage ( 1, 8, array (
				"conditions" => array (
						"Product.product_type" => 3 
				) 
		) );
		// 瘦身美体
		$slimming_products = $this->Product->findByPage ( 1, 8, array (
				"conditions" => array (
						"Product.product_type" => 4 
				) 
		) );
		$this->set ( compact ( "newsProducts" ) );
		$this->set ( compact ( "base_products" ) );
		$this->set ( compact ( "baby_products" ) );
		$this->set ( compact ( "day_products" ) );
		$this->set ( compact ( "slimming_products" ) );
	}
	public function view($id = 0) {
		$product = $this->Product->findById ( $id );
		$this->set ( compact ( "product" ) );
	}
	/**
	 * 按分类查询产品
	 */
	public function category($id = 0, $page = 1) {
		$title = empty ( $_REQUEST ["title"] ) ? "" : h ( $_REQUEST ["title"] );
		$order = empty ( $_REQUEST ["order"] ) ? "id" : h ( $_REQUEST ["order"] );
		$order_arr = array (
				"id" => "product_cd",
				"price" => "retail_price",
				"brank" => "brand_id" 
		);
		if (! array_key_exists ( $order, $order_arr )) {
			$order = "id";
		}
		$products = $this->Product->findByPage ( $page, 16, array (
				"conditions" => array (
						"Product.product_type" => $id,
						"Product.product_name like" => "%{$title}%" 
				),
				"order" => array (
						"Product." . $order_arr [$order] => "DESC" 
				) 
		) );
		$this->set ( "cid", $id );
		$this->set ( compact ( "order" ) );
		$this->set ( compact ( "products" ) );
		$this->set ( compact ( "title" ) );
	}
}
