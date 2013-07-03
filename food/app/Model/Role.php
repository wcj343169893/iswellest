<?php

App::uses ( 'AppModel', 'Model' );
/**
 * Role Model
 */
class Role extends AppModel {
	var $name = "Role";
	var $useTable = "roles";
	/**
	 * 按树状查询
	 */
	public function find2trees() {
		$proles = $this->find ( "all", array (
				"conditions" => array (
						"`Role`.`pid`" => 0 
				) 
		) );
		$result = array ();
		foreach ( $proles as $k => $v ) {
			$result [$k] = $v ["Role"];
			$child = $this->find ( "all", array (
					"conditions" => array (
							"`Role`.`pid`" => $v ["Role"] ["id"] 
					) 
			) );
			$result [$k] ["children"] = $child;
		}
		return $result;
	}
}