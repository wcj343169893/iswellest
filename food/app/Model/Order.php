<?php
class Order extends AppModel {
	var $name="Order";
	var $useTable="orders";
	public $validate = array(
			'name' => array(
					'notempty' => array(
							'rule' => array('notempty'),
							'message' => 'Name is invalid',
					),
			),
			'email' => array(
					'email' => array(
							'rule' => array('email'),
							'message' => 'Email is invalid',
					),
			),
// 							'rule' => array('phone'),
// 							'message' => 'Phone is invalid',
			'phone' => array(
					'notempty' => array(
							'rule' => array('notempty'),
							'message' => 'Phone is invalid',
					),
			),
			'shipping_address' => array(
					'notempty' => array(
							'rule' => array('notempty'),
							'message' => 'Shipping Address is invalid',
					),
			),
			'shipping_city' => array(
					'notempty' => array(
							'rule' => array('notempty'),
							'message' => 'Shipping City is invalid',
							//'allowEmpty' => false,
							//'required' => true,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
			'shipping_state' => array(
					'notempty' => array(
							'rule' => array('notempty'),
							'message' => 'Shipping State is invalid',
					),
			),
			'creditcard_number' => array(
					'notempty' => array(
							'rule' => array('cc'),
							'message' => 'Credit Card Number is invalid',
					),
			),
			'creditcard_code' => array(
					'rule1' => array(
							'rule' => array('notEmpty'),
							'message' => 'Credit Card Code is required',
					),
					'rule2' => array(
							'rule' => '/^[0-9]{3,4}$/i',
							'message' => 'Credit Card Code is invalid',
					),
			),
	);
	
	public $hasMany = array(
			'OrderItem' => array(
					'className' => 'OrderItem',
					'foreignKey' => 'order_id',
					'dependent' => true,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => '',
			)
	);
}