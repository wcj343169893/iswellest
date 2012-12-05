<?php
App::import('Core', 'Auth');
class AppAuthComponent extends AuthComponent {

    /**
     * Initialize component
     *
     * @param object $controller Instantiating controller
     * @access public
     */
	function initialize(&$controller, $settings = array()) {
		$this->controller =& $controller;
		parent::initialize($controller, $settings);
	}

	/**
     * Manually log-in a user with the given parameter data.  The $data provided can be any data
     * structure used to identify a user in AuthComponent::identify().  If $data is empty or not
     * specified, POST data from Controller::$data will be used automatically.
     *
     * After (if) login is successful, the user record is written to the session key specified in
     * AuthComponent::$sessionKey.
     *
     * @param mixed $data User object
     * @return boolean True on login success, false on failure
     * @access public
     * @link http://book.cakephp.org/view/1261/login
     */
    function login($data = null) {
        $this->__setDefaults();
        $this->_loggedIn = false;
        if (empty($data)) {
            $data = $user;
        }

        $user = $this->identify($data);
        if (!empty($user) && $this->userModel == 'Admin') {
            $this->Session->write($this->sessionKey, $user);
            $model =& $this->getModel();
            $user['last_login_datetime'] = 'NOW()';
            $model->save($user);

            $this->setAdminSitemap();
            $this->_loggedIn = true;

            //ログインログを記入
            $operatorLog = array();
            $operatorLog['user_type']       = USER_TYPE_ADMIN;
            $operatorLog['user_id']         = $user['id'];
            $operatorLog['content']         = __("info.AdminLogin", true);
            $operatorLog['create_user']     = $user['id'];
            $operatorLog['create_datetime'] = 'NOW()';
            $modelOpertatorLog = ClassRegistry::init('OperatorLog');
            $modelOpertatorLog->save($operatorLog);
        } else if (!empty($user)) {
            $this->Session->write($this->sessionKey, $user);
            $this->_loggedIn = true;
        }
        return $this->_loggedIn;
    }

    /**
     * Identifies a user based on specific criteria.
     *
     * @param mixed $user Optional. The identity of the user to be validated.
     *              Uses the current user session if none specified.
     * @param array $conditions Optional. Additional conditions to a find.
     * @return array User record data, or null, if the user could not be identified.
     * @access public
     */
    function identify($user = null, $conditions = null) {
        $model =& $this->getModel();
        if ($this->userModel == 'Admin') {
            $conditions['conditions'] = array(
                                            $this->fields['username'] .' ='=> $user[$model->alias.'.'.$this->fields['username']],
                                            $this->fields['password'] .' ='=> $user[$model->alias.'.'.$this->fields['password']],
                                            'del_flg =' => ACTIVE_FLG_FALSE,
            );
            $rec = $model->find('first', $conditions);
        } else {
            $this->fields['email'] = $user[$model->alias.'.'.$this->fields['username']];
            $this->fields['password'] = $user[$model->alias.'.'.$this->fields['password']];
            $validationErrors = $model->invalidFields(array(), $this->fields);

            if (empty($validationErrors)) {
                $rec = $model->findByParams($user);
            } else {
                $this->loginError = null;
            }
        }
        if (!empty($rec)) {
            return $rec[$model->name];
        } else {
            return array();
        }
    }

    /**
     * 管理側のSitemap情報を設定
     */
    function setAdminSitemap() {
        $authInfo = $this->Session->read($this->sessionKey.'.auth_info');
        $authInfo = $this->extractAuthInfo($authInfo);
        $this->loadSitemap($menuList, $actionList, $authInfo);

        $sitemap['menuList']   = $menuList;
        $sitemap['actionList'] = $actionList;
        $this->Session->write($this->sessionKey.'.sitemap', $sitemap);
    }

    function loadSiteMap(&$menuList = array(), &$actionList = array(), $authInfo = array()) {
        $xml_obj = @simplexml_load_file(CONFIGS.'sitemap.xml');
        if (empty($xml_obj)) {
            $this->controller->CakeError('error');
            exit();
        }

        $menuList = array();
        $actionList = array();
        for($i=0; $i < count($xml_obj->admin->menuGroup); $i++) {
            $menuGroup = $xml_obj->admin->menuGroup[$i];
            $menuGroupPath  = (string)$menuGroup->attributes()->path;
            $menuGroupName  = (string)$menuGroup->attributes()->name;
            if (!empty($authInfo) && $authInfo[$menuGroupPath]['self'] != ACTIVE_FLG_TRUE) {
                continue;
            }
            $menuList[$menuGroupPath]['name'] = $menuGroupName;
            $menuList[$menuGroupPath]['path'] = $menuGroupPath;
            for($j=0; $j<count($menuGroup); $j++) {
                $menu = $menuGroup->menu[$j];
                $menuPath = (string)$menu->attributes()->path;
                $menuName = (string)$menu->attributes()->name;
                $menuUrl  = (string)$menu->attributes()->url;

                if (!empty($authInfo) 
                        && (empty($authInfo[$menuGroupPath][$menuPath]) || ($authInfo[$menuGroupPath][$menuPath] != ACTIVE_FLG_TRUE))) {
                    continue;
                }

                $menuList[$menuGroupPath]['list'][] = array('path' => $menuPath, 'name' => $menuName, 'url' => $menuUrl);
                for($m=0; $m<count($menu); $m++) {
                    $action = $menu->action[$m];
                    $controller = (string)$action->attributes()->controller;
                    $action = (string)$action->attributes()->action;
                    $actionList[$controller][] = $action;
                }
            }
        }
    }

    function extractAuthInfo($authInfo) {
        $authInfo = json_decode($authInfo);
        $ret = array();
        foreach((array)$authInfo as $key => $value) {
            $ret[$key] = (array)$value;
        }
        return $ret;
    }

    /**
     * パスワードを変更しなくになる
     *
     * @param string $password Password to hash
     * @return string Hashed password
     * @access public
     * @link http://book.cakephp.org/view/1263/password
     */
    function password($password) {
        //return Security::hash($password, null, true);
        return $password;
    }
}
?>
