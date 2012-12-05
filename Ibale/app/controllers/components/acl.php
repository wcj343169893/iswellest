<?php
/**
 * ファイル名：acl.php
 * 概要：権限チェック用のコンポーネント
 * 
 * 作成者：shilei
 * 作成日：2012/01/03
 */
class AclComponent extends Object {
    var $controller         = null;
    var $excludeController  = array('Frame', 'Ajax', 'AdminTop');

    /**
     * Initialize component
     *
     * @param object $controller Instantiating controller
     * @access public
     */
	function initialize(&$controller, $settings = array()) {
		$this->controller =& $controller;
		
	}

    /**
     * Pass-thru function for ACL check instance.  Check methods
     * are used to check whether or not an ARO can access an ACO
     *
     * @param string $aro ARO The requesting object identifier.
     * @param string $aco ACO The controlled object identifier.
     * @param string $action Action (defaults to *)
     * @return boolean Success
     * @access public
     */
    function check($aro, $aco, $action = "*") {
        //フロン側　または　ACL検証が不必要な場合、"TRUE"を戻る
        if (!$this->isAdminRequest() 
                || ($this->controller->Session->check($this->controller->AppAuth->sessionKey) && in_array($this->controller->name, $this->excludeController))) {
            return true;
        }

        if (!$this->controller->Session->check($this->controller->AppAuth->sessionKey)) {
            $this->controller->hasAuthError = true;
            return false;
        }
        $actionList = $this->controller->Session->read($this->controller->AppAuth->sessionKey.'.sitemap.actionList');
        $controllerName = $this->controller->name;
        $actionName     = $this->controller->action;
        if (in_array($controllerName, array_keys($actionList)) && in_array($actionName, $actionList[$controllerName])) {
            return true;
        } else {
            $this->controller->hasAuthError = true;
            return false;
        }
    }


    /**
     * 管理側のSitemap情報を取得
     */
    function getAdminSitemap() {
        return $this->sitemap;
    }

    /**
     * 管理側のリクエストかどうかことをチェック
     */
    function isAdminRequest() {
        $routingPre = Configure::read('Routing.prefixes');
        foreach($routingPre as $key => $value) {
            if(isset($this->controller->params[$value])){
                return true;
            }
        }
        return false;
    }
}
?>
