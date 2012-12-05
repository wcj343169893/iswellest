<?php
/**
 * ファイル名：user_history.php
 * 概要：用户历史浏览记录
 *
 * 作成者：chaojun
 * 作成日時：2012/12/2
 */
class UserHistory extends AppModel {
	var $name = 'UserHistory';
	var $primaryKey = 'id';
	var $useTable = 'zw_user_history';
// 	var $hasOne = array (
// 			'Product' => array (
// 					'className' => 'Product',
// 					'foreignKey' => 'product_cd',
// 					'conditions' => array (
// 							'Product.pub_flg' => '1' 
// 					),
// 					'dependent' => true 
// 			) 
// 	);
}