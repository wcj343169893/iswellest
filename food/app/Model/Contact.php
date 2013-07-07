<?php
class Contact extends AppModel {
	var $name = 'Contact';
	
	var $validate = array (
			'name' => array (
					'rule' => array (
							'minLength',
							1 
					) 
			),
			'email' => array (
					'rule' => array (
							'minLength',
							1 
					) 
			) 
	);
}
?>