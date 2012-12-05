<?php
class FrameController extends AppController {
    var $name       = 'Frame';
    var $uses       = array();
    var $components = array('Session');
    var $helpers    = array('appForm', 'appSession');

    function admin_show_header() {
        $this->layout = 'empty';
        $this->render('/elements/frame/header');
    }
    function admin_show_menu() {
        $this->layout = 'empty';
        $menuList = $this->Session->read($this->AppAuth->sessionKey.'.sitemap.menuList');
        $this->set('menuList', $menuList);
        $this->render('/elements/frame/menu');
    }
    function admin_show_blank() {
        $this->layout = 'empty';
        //$this->render('/elements/frame/blank');
        $this->redirect('/admin/operator_log/list_by_user_id/');
    }
    function admin_show_drag() {
        $this->layout = 'empty';
        $this->render('/elements/frame/drag');
    }
}
?>