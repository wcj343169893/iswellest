<?php
class Product extends AppModel {
	var $name = 'Product';
	var $useTable = 'oms_product';
	public $primaryKey = 'product_cd'; // 默认是id
	/**
	 * 一对一关系(这种只查询关联的一条)
	 */
	var $belongsTo = array (
			'Productphoto' => array (
					'className' => 'Productphoto',
					'foreignKey' => 'product_cd',
					'fields' => array (
							'create_datetime',
							'display_order',
							'memo',
							'url' 
					) 
			),
			'Productdesc' => array (
					'className' => 'Productdesc',
					'foreignKey' => 'product_cd',
					'fields' => array (
							'desc_title' 
					) 
			) 
	);
	/**
	 * 一对多(这种只查询关联的多条)
	 */
// 	public $hasMany = array (
// 			'Productphoto' => array (
// 					'className' => 'Productphoto',
// 					'foreignKey' => 'product_cd',
// 					'conditions' => array (),
// 					'order' => 'Productphoto.display_order DESC,Productphoto.id DESC',
// 					'dependent' => true 
// 			) 
// 	);
}