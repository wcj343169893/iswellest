<?php
class AdminController extends AppController {
    var $name       = 'Admin';
    var $uses       = array('Admin', 'OperatorLog');
    var $components = array('Query');
    var $helpers    = array('appForm', 'appSession', 'Paginator');

    function beforeFilter() {
        $this->AppAuth->allowedActions = array('admin_login', 'admin_logout');
        parent::beforeFilter();
    }

    /**
     * 管理者ログイン
     */
    function admin_login () {
        if ($this->Session->check($this->AppAuth->sessionKey)) {
            $this->redirect('/admin');
        }
    }

    /**
     * 管理者ログアウト
     */
    function admin_logout () {
        $userId = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $this->Session->delete($this->AppAuth->sessionKey);

        //ログインログを記入
        $operatorLog = array();
        $operatorLog['user_type']       = USER_TYPE_ADMIN;
        $operatorLog['user_id']         = $userId;
        $operatorLog['content']         = __("info.AdminLogout", true);
        $operatorLog['create_user']     = $userId;
        $operatorLog['create_datetime'] = 'NOW()';
        $this->OperatorLog->save($operatorLog);

        $this->redirect('/admin/login');
    }

    /**
     * 管理者一覧画面
     */
    function admin_index() {
        $conditions = array(
                        'conditions'    => array(
                                            'del_flg =' => ACTIVE_FLG_FALSE,
                        ),
                        'order'         => array(
                                            'create_datetime' => 'DESC',
                        ),
                        'limit'         => ADMIN_PAGE_LIMIT_COMM,
        );
        $this->paginate = $conditions;
        $this->set('adminList', $this->paginate());

        $this->layout = 'admin';
    }

    /**
     * 編集画面を初期化
     */
    function admin_edit() {
        $this->layout = 'admin';

        $menuList = array();
        if (!empty($this->data['Admin']['id']) && empty($this->data['Admin']['mode'])) {
            $conditions = array(
                            'conditions'    => array(
                                                'id =' => '###data.Admin.id###',
                                                'del_flg =' => ACTIVE_FLG_FALSE,
                            ),
            );
            $this->Query->renderSearchConditions($conditions);
            $rec = $this->Admin->find('first', $conditions);
            $this->data = $rec;

            unset($this->data['Admin']['password']);
            $this->data['Admin']['auth_info'] = $this->AppAuth->extractAuthInfo($rec['Admin']['auth_info']);
        } else {
        }
        $this->AppAuth->loadSitemap($menuList, $actionList);
        $this->set('menuList', $menuList);

        $this->loadBackListReferer();
        $this->render('admin_edit');
    }

    /**
     * 管理者編集完了
     */
    function admin_edit_comp() {
        //$this->layout = 'admin';
        if (empty($this->data)) {
            $this->redirect('/admin/admin/');
            return;
        }

        //パスワードをHASHにする
        $this->data['Admin']['password_confirm'] = $this->AppAuth->password($this->data['Admin']['password_confirm']);
        $validData = $this->data;
        if (!empty($this->data['Admin']['id']) 
                && empty($this->data['Admin']['password']) && empty($this->data['Admin']['password_confirm'])) {
            unset($this->data['Admin']['password']);
            unset($this->data['Admin']['password_confirm']);
        }
        $errMsg = $this->Admin->invalidFields(array(), $this->data);

        //ログインIDの存在性をチェック
        $invalidFlg  = $this->__isExistsAdminLoginId();

        //権限があることをチェック
        $invalidFlg |= $this->__isEmptyAuthInfo();

        //エラーがある場合
        if (!empty($errMsg) || $invalidFlg) {
            $this->admin_edit();
            return;
        }

        //DBに保存
        $updateData    = $this->data['Admin'];
        $updateUserId  = $this->Session->read($this->AppAuth->sessionKey.'.id');
        if (!empty($this->data['Admin']['id'])) {
            $updateData['id'] = $this->data['Admin']['id'];
        } else {
            $this->Admin->create();
            $updateData['create_user']      = $updateUserId;
            $updateData['create_datetime']  = 'NOW()';
        }
        $updateData['auth_info']        = json_encode($this->data['Admin']['auth_info']);
        $updateData['update_user']      = $updateUserId;
        $updateData['update_datetime']  = 'NOW()';
        $this->Admin->save($updateData, false);

        $this->redirect($this->getBackListReferer());
    }

    /**
     * 管理者IDより管理情報をロジック削除
     */
    function admin_delete() {
        if (empty($this->data['Admin']['id'])) {
            $this->redirect('/admin/admin/');
            return;
        }
        $updateData    = array();
        $updateUserId  = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData['id']              = $this->data['Admin']['id'];
        $updateData['del_flg']         = ACTIVE_FLG_TRUE;
        $updateData['update_user']     = $updateUserId;
        $updateData['update_datetime'] = 'NOW()';
        $updateData['delete_user']     = $updateUserId;
        $updateData['delete_datetime'] = 'NOW()';
        $this->Admin->save($updateData);

        $this->redirect($this->referer());
    }

    /**
     * ログインIDが存在かどうかことをチェック
     */
    function __isExistsAdminLoginId() {
        if (empty($this->data['Admin']['login_id'])) {
            return false;
        }

        $conditions = array(
                        'conditions'    => array(
                                            'id <>'      => '###data.Admin.id###',
                                            'login_id =' => '###data.Admin.login_id###',
                                            'del_flg ='  => ACTIVE_FLG_FALSE,
                        ),
        );
        $this->Query->renderSearchConditions($conditions);
        $recs = $this->Admin->find('all', $conditions);
        if (!empty($recs)) {
            $this->Session->setFlash(__('error.adminLoginIdIsExists', true), 'default', null, 'adminLoginIdIsExists');
            return true;
        }
        return false;
    }

    /**
     * 入力した権限情報をチェック
     */
    function __isEmptyAuthInfo() {
        $ret = false;
        foreach($this->data['Admin']['auth_info'] as $key => $value) {
            if ($value['self'] == ACTIVE_FLG_TRUE) {
                $ret = true;
                break;
            }
        }
        if (!$ret) {
            $msg = str_replace("{0}", "权限", __('error.required', true));
            $this->Session->setFlash($msg, 'default', null, 'authinfoIsRequired');
        }
        return !$ret;
    }
}
?>
