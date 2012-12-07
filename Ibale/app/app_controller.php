<?php
/**
 * ファイル名：app_controller.php
 * ファイル名：app_controller.php
 * 概要：ECサイト用のコントローラ
 * 
 * 作成者：shilei
 * 作成日：2011/12/30
 * 変更履歴：
 */
App::import ( 'Vendor', 'app_basics' );

class AppController extends Controller {
	var $components = array (
			'CommFuncs',
			'AppAuth',
			'Acl',
			'Session' 
	);
	var $helpers = array (
			'App',
			'AppForm',
			'Text',
			'Number',
			'AppSession',
			'AppHtml' 
	);
	var $uses = array (
			'Category' 
	);
	var $hasAuthError = false;
	var $view = 'App';
	
	function beforeFilter() {
		parent::beforeFilter ();
		$this->Email->layout = 'email';
		$this->__initAuth ();
		if (! $this->Acl->isAdminRequest ()) {
			$this->__loadAreaList ();
		}
		$msts_path = "appcontroller_beforefilter_msts";
		$categorys_path = "appcontroller_beforefilter_categorys";
		$codeList = readCache ( $msts_path );
		if (empty ( $codeList )) {
			$this->loadModel ( 'CommonCode' );
			$codeList = $this->CommonCode->getList ();
			writeCache ( $codeList, $msts_path );
		}
		$this->set ( 'msts', $codeList );
		$categoryList = readCache ( $categorys_path );
		if (empty ( $categoryList )) {
			$categoryList = $this->Category->getAllOptionList ();
			writeCache ( $categoryList, $categorys_path );
		}
		$this->set ( 'categoryAllOptionList', $categoryList );
	}
	
	function beforeRender() {
		//冗余代码
		if (! isset ( $this->viewVars ['msts'] )) {
			$this->loadModel ( 'CommonCode' );
			$codeList = $this->CommonCode->getList ();
			$this->set ( 'msts', $codeList );
		}
		parent::beforeRender ();
		// if (in_array($this->layout, array('empty', 'ajax'))) {
		header ( 'Content-Type: text/html; charset=UTF-8' );
		header ( "Cache-Control: no-cache, no-store, max-age=0, must-revalidate" );
		// }
	}
	
	/**
	 * Returns the referring URL for this request.
	 *
	 * @param string $default
	 *        	Default URL to use if HTTP_REFERER cannot be read from headers
	 * @param boolean $local
	 *        	If true, restrict referring URLs to local server
	 * @return string Referring URL
	 * @access public
	 */
	function referer($default = null, $local = false) {
		// 権限検証失敗の場合、エラー画面へ遷移
		if ($this->hasAuthError) {
			$this->CakeError ( 'error', array (
					'message' => __ ( 'error.noAuth', true ) 
			) );
			exit ();
		}
		return parent::referer ( $default, $local );
	}
	
	function __adminLoginDemo() {
		if (! $this->Acl->isAdminRequest ()) {
			return;
		}
		
		$this->Session->write ( $this->AppAuth->sessionKey, array (
				'username' => 'test' 
		) );
		// $this->Session->write($this->AppAuth->sessionKey, null);
		// 権限文字列
		$acl_str = '{"product":{"product_list":"1"}}\n{"admintop":{"admin_index":"1"}}\n{"admin":{"admin_index":"1","admin_add":"0"}}\n{"member":{"index":"1"}}';
		$ret = array ();
		foreach ( explode ( '\n', $acl_str ) as $key => $value ) {
			$obj = json_decode ( $value );
			$ret = array_merge ( $ret, ( array ) $obj );
		}
		
		$this->Session->write ( $this->AppAuth->sessionKey . '.Auth', $ret );
	}
	
	/**
	 * AUTHを初期化
	 */
	function __initAuth() {
		// 管理側の場合
		if ($this->Acl->isAdminRequest ()) {
			$this->AppAuth->loginAction = '/admin/login';
			$this->AppAuth->sessionKey = 'Auth.Admin';
			$this->AppAuth->authorize = 'actions';
			$this->AppAuth->userModel = 'Admin';
			$this->AppAuth->fields = array (
					'username' => 'login_id',
					'password' => 'password' 
			);
			$this->AppAuth->loginRedirect = '/admin/';
			$this->AppAuth->loginError = __ ( 'error.adminLoginFailure', true );
		} else {
			$this->AppAuth->loginAction = '/member/login';
			$this->AppAuth->sessionKey = FRONT_AUTH_SESSION_KEY;
			$this->AppAuth->userModel = 'Member';
			$this->AppAuth->loginRedirect = '/member/mypage';
			$this->AppAuth->fields = array (
					'username' => 'email',
					'password' => 'password' 
			);
			$this->AppAuth->loginError = __ ( 'error.memberLoginFailure', true );
		}
		
		$this->AppAuth->authError = ' '; // __('error.authError', true);
	}
	
	/**
	 * 一覧画面へ戻る用のURLを設定
	 */
	function loadBackListReferer($loadReferer = true) {
		if ($loadReferer && empty ( $this->data [$this->name] ['referer'] )) {
			$this->data [$this->name] ['referer'] = $this->referer ();
		} elseif (! $loadReferer && empty ( $this->data [$this->name] ['referer'] )) {
			$this->data [$this->name] ['referer'] = DS . $this->params ['url'] ['url'];
		}
	}
	
	/**
	 * 一覧画面へ戻る用のURLを取得
	 */
	function getBackListReferer() {
		if (! empty ( $this->data [$this->name] ['referer'] )) {
			return $this->data [$this->name] ['referer'];
		}
		if ($this->Acl->isAdminRequest ()) {
			return '/admin/';
		} else {
			return '/';
		}
	}
	
	/**
	 * 入力データがないの場合、指定画面へ遷移
	 *
	 * @param unknown_type $redirectUrl        	
	 */
	function handleInputEmpty($redirectUrl) {
		if (empty ( $this->data [$this->name] )) {
			$this->redirect ( $redirectUrl );
			return;
		}
	}
	
	function __loadAreaList() {
		$area_path = "appcontroller_loadarealist_areas";
		$recs = readCache ( $area_path );
		if (empty ( $recs )) {
			$this->loadModel ( 'Area' );
			$this->Area->getAllOptionList ( $recs );
			writeCache($recs,$area_path);
		}
		$this->set ( 'areaList', $recs );
	}
}
?>
