<?php
App::uses ( 'AppController', 'Controller' );
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
	var $uses = array (
			"User",
			"CookingOrder" 
	);
	var $uid;
	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		// $this->User->recursive = 0;
		// $this->set ( 'users', $this->paginate () );
		$this->view ();
		$this->view = "view";
	}
	
	public function beforeFilter() {
		parent::beforeFilter ();
		$this->Auth->allow ( 'add', 'forgetpwd', 'reset' );
		
		// set cookie options
		$this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
		$this->Cookie->httpOnly = true;
		
		if (! $this->Auth->loggedIn () && $this->Cookie->read ( 'remember_me_cookie' )) {
			$cookie = $this->Cookie->read ( 'remember_me_cookie' );
			
			$user = $this->User->find ( 'first', array (
					'conditions' => array (
							'User.username' => $cookie ['username'],
							'User.password' => $cookie ['password'] 
					) 
			) );
			
			if ($user && ! $this->Auth->login ( $user )) {
				$this->redirect ( '/users/logout' ); // destroy session & cookie
			}
		} else {
			$this->uid = $this->Auth->user ( "id" );
		}
	}
	
	public function isAuthorized($user) {
		if ($user ['role'] == 'admin') {
			return true;
		}
		return true;
	}
	
	public function login() {
		if ($this->request->is ( 'post' )) {
			
			if ($this->Auth->login ()) {
				
				// did they select the remember me checkbox?
				if (isset ( $this->request->data ['remember_me'] ) && $this->request->data ['remember_me'] == 1) {
					// remove "remember me checkbox"
					unset ( $this->request->data ['User'] ['remember_me'] );
					
					// hash the user's password
					$this->request->data ['User'] ['password'] = $this->Auth->password ( $this->request->data ['User'] ['password'] );
					
					// write the cookie
					$this->Cookie->write ( 'remember_me_cookie', $this->request->data ['User'], true, '2 weeks' );
				}
				
				return $this->redirect ( $this->Auth->redirect () );
			
			} else {
				$this->Session->setFlash ( __ ( 'Username or password is incorrect.' ) );
			}
		}
		
		$this->set ( array (
				'title_for_layout' => 'Login' 
		) );
	}
	
	public function logout() {
		// clear the cookie (if it exists) when logging out
		$this->Cookie->delete ( 'remember_me_cookie' );
		
		return $this->redirect ( $this->Auth->logout () );
	}
	
	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id        	
	 * @return void
	 */
	public function view() {
		$options = array (
				'conditions' => array (
						'User.' . $this->User->primaryKey => $this->uid 
				) 
		);
		$this->set ( 'user', $this->User->find ( 'first', $options ) );
	}
	
	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is ( 'post' )) {
			$this->User->create ();
			$user = h ( $this->request->data );
			$user ["User"] ["join_date"] = date ( "Y-m-d" );
			if ($this->User->save ( $user )) {
				$this->Session->setFlash ( __ ( 'The user has been saved' ) );
				// 发送激活邮件
				// $this->Email->to($this->request->data["User"]["email"]);
				// $this->Email->send("Regist success");
				$this->redirect ( array (
						'controller' => 'pages',
						'action' => 'index' 
				) );
			} else {
				$this->Session->setFlash ( __ ( 'The user could not be saved. Please, try again.' ) );
			}
		}
	}
	
	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id        	
	 * @return void
	 */
	public function edit() {
		if (! $this->User->exists ( $this->uid )) {
			throw new NotFoundException ( __ ( 'Invalid user' ) );
		}
		if ($this->request->is ( 'post' ) || $this->request->is ( 'put' )) {
			if ($this->User->save ( $this->request->data )) {
				$this->Session->setFlash ( __ ( 'The user has been saved' ) );
				$this->redirect ( array (
						'action' => 'index' 
				) );
			} else {
				$this->Session->setFlash ( __ ( 'The user could not be saved. Please, try again.' ) );
			}
		} else {
			$options = array (
					'conditions' => array (
							'User.' . $this->User->primaryKey => $this->uid 
					) 
			);
			$this->request->data = $this->User->find ( 'first', $options );
		}
	}
	/**
	 * 我的订单
	 */
	public function order() {
	
	}
	
	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id        	
	 * @return void
	 */
	private function delete($id = null) {
		$this->User->id = $id;
		if (! $this->User->exists ()) {
			throw new NotFoundException ( __ ( 'Invalid user' ) );
		}
		$this->request->onlyAllow ( 'post', 'delete' );
		if ($this->User->delete ()) {
			$this->Session->setFlash ( __ ( 'User deleted' ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$this->Session->setFlash ( __ ( 'User was not deleted' ) );
		$this->redirect ( array (
				'action' => 'index' 
		) );
	
	}
	/**
	 * 我的课程
	 */
	public function cookingclass() {
		$data = $this->CookingOrder->find ( "all", array (
				"conditions" => array (
						"CookingOrder.user_id" => $this->uid 
				) 
		) );
		$this->set ( "data", $data );
	}
	/**
	 * 更改课程
	 *
	 * @param $id 订单号        	
	 * @param $cid 课程编号        	
	 */
	public function meal($oid = 0, $cid = 0) {
		$this->Session->write ( "CookingClass.meal", $cid );
		$this->Session->write ( "CookingClass.meal.oid", $oid );
		// 跳转到未开始课程
		$this->redirect ( array (
				'controller' => "cooking",
				'action' => 'trainning' 
		) );
	}
	function forgetpwd() {
		// $this->layout="signup";
		$this->User->recursive = - 1;
		if (! empty ( $this->data )) {
			if (empty ( $this->data ['User'] ['email'] )) {
				$this->Session->setFlash ( 'Please Provide Your Email Adress that You used to Register with Us' );
			} else {
				$email = $this->data ['User'] ['email'];
				$fu = $this->User->find ( 'first', array (
						'conditions' => array (
								'User.email' => $email 
						) 
				) );
				if ($fu) {
					// debug($fu);
					if ($fu ['User'] ['active']) {
						$key = Security::hash ( String::uuid (), 'sha512', true );
						$hash = sha1 ( $fu ['User'] ['username'] . rand ( 0, 100 ) );
						$url = Router::url ( array (
								'controller' => 'users',
								'action' => 'reset' 
						), true ) . '/' . $key . '#' . $hash;
						$ms = $url;
						$ms = wordwrap ( $ms, 1000 );
						// debug($url);
						$fu ['User'] ['tokenhash'] = $key;
						$this->User->id = $fu ['User'] ['id'];
						if ($this->User->saveField ( 'tokenhash', $fu ['User'] ['tokenhash'] )) {
							
							// ============Email================//
							/* SMTP Options */
							$this->Email->template = 'resetpw';
							$this->Email->from = 'yiersky<yiersky@yeah.net>';
							$this->Email->to = $fu ['User'] ['email'];
							$this->Email->subject = 'Reset Your Password';
							$this->Email->sendAs = 'both';
							
							$this->Email->delivery = 'smtp';
							$this->set ( 'ms', $ms );
							$this->set ( 'user', $fu );
							$this->Email->send ();
							$this->set ( 'smtp_errors', $this->Email->smtpError );
							$this->Session->setFlash ( __ ( 'Check Your Email To Reset your password', true ) );
							
							// ============EndEmail=============//
						} else {
							$this->Session->setFlash ( "Error Generating Reset link" );
						}
					} else {
						$this->Session->setFlash ( 'This Account is not Active yet.Check Your mail to activate it' );
					}
				} else {
					$this->Session->setFlash ( 'Email does Not Exist' );
				}
			}
		}
	}
	function reset($token = null) {
		// $this->layout="Login";
		$this->User->recursive = - 1;
		if (! empty ( $token )) {
			$u = $this->User->findBytokenhash ( $token );
			if ($u) {
				$this->User->id = $u ['User'] ['id'];
				if (! empty ( $this->data )) {
					$this->User->data = $this->data;
					$this->User->data ['User'] ['username'] = $u ['User'] ['username'];
					$new_hash = sha1 ( $u ['User'] ['username'] . rand ( 100, 1000 ) ); // created
					                                                                 // token
					$this->User->data ['User'] ['tokenhash'] = $new_hash;
					if ($this->User->validates ( array (
							'fieldList' => array (
									'password',
									'password_confirmation' 
							) 
					) )) {
						if ($this->User->save ( $this->User->data )) {
							$this->Session->setFlash ( 'Password Has been Updated' );
							$this->Auth->redirect ( "/users" );
							$this->redirect ( array (
									'controller' => 'users',
									'action' => 'login' 
							) );
						}
					
					} else {
						$this->set ( 'errors', $this->User->invalidFields () );
					}
				}
			} else {
				$this->Session->setFlash ( 'Token Corrupted,Please Retry.the reset link work only for once.' );
			}
		} 

		else {
			$this->redirect ( '/' );
		}
	}

}
