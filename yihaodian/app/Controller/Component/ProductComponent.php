<?php
/**
 * 这个组件主要是用来查询数据
 * 使用方法：
 * 1、controller中引入
 * var $components = array (
*			'RequestHandler',
*			'Product',
*			'Session' 
*	);
*	2、调用方法
*	 $this->Product->findNews();
 * */
App::uses ( 'Component', 'Controller' );
class ProductComponent extends Component {
	/**
	 * Product模型，用来查询数据
	 */
	public $Product;
	public function __construct(ComponentCollection $collection, $settings = array()) {
		parent::__construct ( $collection, $settings );
		// 初始化 类Product
		$this->Product = ClassRegistry::init ( array (
				'class' => "Product",
				'alias' => "Product" 
		) );
	}
	/**
	 * 查询最新10条
	 */
	public function findNews() {
		$data = $this->Product->find ( "all", array (
				"conditions" => array (
						'Product.pub_flg' => 1 
				),
				"limit" => 10,
				"order" => array (
						"Product.product_cd" => "desc" 
				) 
		) );
		return $data;
	}
	/**
	 * 不用系统自带的分页组件，就自己写一个
	 *
	 * @param $page 页码        	
	 * @param $pageSize 每页条数        	
	 * @param $options 查询条件（自定）        	
	 * @return int 总条数 ，
	 *         int	总页数，
	 *         int	当前页码，
	 *         array 数据
	 */
	public function findByPage($page = 1, $pageSize = 10, $options = array()) {
		// 查询总条数
		$count = $this->Product->find ( "count", array (
				"conditions" => array (
						'Product.pub_flg' => 1 
				) 
		) );
		$totalPage = ceil ( $count / $pageSize );
		if ($page > $totalPage) {
			$page = $totalPage;
		}
		if ($count > 0) {
			$data = $this->Product->find ( "all", array (
					"conditions" => array (
							'Product.pub_flg' => 1 
					),
					"limit" => 10,
					"page" => $page,
					"order" => array (
							"Product.product_cd" => "DESC" 
					),
					"fields" => array () 
			) );
		}
		$data = array (
				"count" => $count,
				"totalPage" => $totalPage,
				"newPage" => $page,
				"data" => $data 
		);
		return $data;
	}
	/**
	 * 查询详细
	 */
	public function findById($id) {
		if ($id > 0) {
			$data = $this->Product->find ( "first", array (
					"conditions" => array (
							'Product.pub_flg' => 1,
							'Product.product_cd' => $id 
					) 
			) );
		}
		return $data;
	}

}
