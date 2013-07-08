<?php
class CookingOrder extends AppModel {
	var $name = "CookingOrder";
	var $useTable = "cooking_order";
	public $belongsTo = array (
			'Cooking' => array (
					'className' => 'Cooking',
					'foreignKey' => 'cooking_id',
					'conditions' => '',
					'fields' => '',
					'order' => '' 
			) 
	);
}