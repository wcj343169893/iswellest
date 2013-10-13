<?php
App::uses ( 'AppModel', 'Model' );
/**
 * User Model
 */
class UserAddress extends AppModel {
	var $name="UserAddress";
	var $useTable="user_address";
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array (
			'phone' => array (
					'notempty' => array (
							'rule' => array (
									'notempty','phone' 
							) 
					) 
			),
			'shipping_address' => array (
					'notempty' => array (
							'rule' => array (
									'notempty' 
							) 
					) 
			),
			'shipping_city' => array (
					'notempty' => array (
							'rule' => array (
									'notempty' 
							) 
					) 
			),
			'shipping_zip' => array (
					'notempty' => array (
							'rule' => array (
									'notempty' 
							) 
					) 
			),
			'shipping_state' => array (
					'notempty' => array (
							'rule' => array (
									'notempty' 
							) 
					) 
			),
			'shipping_country' => array (
					'notempty' => array (
							'rule' => array (
									'notempty' 
							) 
					) 
			),
	);
	public $belongsTo = array (
			"User" => array (
					'className' => 'User',
					'foreignKey' => 'user_id',
					"fields" => array (
							"`User`.`id`" ,
							"`User`.`first_name`" ,
							"`User`.`last_name`" ,
					) 
			) 
	);
}
