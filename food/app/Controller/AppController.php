<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses ( 'Controller', 'Controller' );
App::uses ( 'Folder', 'Utility' );
App::uses ( 'File', 'Utility' );

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	var $components = array (
			'DebugKit.Toolbar',
			'Session',
			'RequestHandler',
			'Cookie',
			'Email',
			'FileUtil',
			'Auth' => array (
					'loginRedirect' => array (
							'controller' => 'pages',
							'action' => 'index'
					),
					'logoutRedirect' => array (
							'controller' => 'pages',
							'action' => 'index'
					),
					'authError' => "You cant access that page",
					'authorize' => array (
							'controller'
					) 
			) 
	);
	public function isAuthorized($user) {
		return true;
	}
	public function beforeFilter() {
		$this->Auth->allow ( 'index', 'view', 'display' );
		$this->set ( 'logged_in', $this->Auth->loggedIn () );
		$this->set ( 'current_user', $this->Auth->user () );
		$this->set("webroot",$this->request->webroot);
	}
	/**
	 * 处理icon，同时转换数组
	 */
	public function makeProductIcon($data = array(), $isList = true) {
		$output = array ();
		if ($isList) {
			foreach ( $data as $k => $v ) {
				$v ["Product"] ["icon"] = "/images/small/" . $v ["Product"] ["photo"];
				$v ["Product"] ["large"] = "/images/large/" . $v ["Product"] ["photo"];
				$output [] = $v ["Product"];
			}
		} else {
			$data ["Product"] ["icon"] = "/images/small/" . $data ["Product"] ["photo"];
			$data ["Product"] ["large"] = "/images/large/" . $data ["Product"] ["photo"];
			$output = $data ["Product"];
		}
		return $output;
	}
}
