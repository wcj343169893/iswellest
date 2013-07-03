<?php
App::uses ( 'AppModel', 'Model' );
/**
 * User Model
 */
class User extends AppModel {
	
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array (
			'first_name' => array (
					'notempty' => array (
							'rule' => array (
									'notempty' 
							) 
					) 
			),
			'username' => array (
					'notempty' => array (
							'rule' => array (
									'notempty' 
							) 
					) 
			),
			'password' => array (
					'notempty' => array (
							'rule' => array (
									'notempty' 
							),
							'Match passwords' => array (
									'rule' => 'matchPasswords',
									'message' => 'Your passwords do not match' 
							) 
					) 
			),
			'password_confirmation' => array (
					'notempty' => array (
							'rule' => array (
									'notempty' 
							) 
					) 
			),
			
			'email' => array (
					'email' => array (
							'rule' => array (
									'email' 
							) 
					) 
			) 
	);
	public $belongsTo = array (
			"Role" => array (
					'className' => 'Role',
					'foreignKey' => 'role_id',
					"fields" => array (
							"`Role`.`id`" ,
							"`Role`.`name`" ,
					) 
			) 
	);
	
	public function matchPasswords($data) {
		if ($data ['password'] == $this->data ['User'] ['password_confirmation']) {
			return true;
		}
		$this->invalidate ( 'password_confirmation', 'Your passwords do not match' );
		return false;
	}
	public function beforeSave($options = array()) {
		if (isset ( $this->data ['User'] ['password'] )) {
			$this->data ['User'] ['password'] = AuthComponent::password ( $this->data ['User'] ['password'] );
		}
		return true;
	}
}
