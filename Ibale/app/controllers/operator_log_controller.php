<?php
class OperatorLogController extends AppController {
    var $name       = 'OperatorLog';
    var $uses       = array('OperatorLog', 'OperatorLog');
    var $components = array('Query');
    var $helpers    = array('appForm', 'appSession', 'Paginator');


    function beforeFilter() {
        $this->AppAuth->allowedActions = array(
                                                'admin_list_by_user_id',
        );
        parent::beforeFilter();
    }

    /**
     * ログリスト画面
     */
    function admin_index() {
        $this->__loadSearchConditions($conditions);
        if (!empty($this->params['named']['id'])) {
            $conditions['conditions']['user_id ='] = $this->params['named']['id'];
        }
        $this->paginate = $conditions;
        $this->set('operatorLogList', $this->paginate());

        $this->layout = 'admin';
    }

    /**
     * ログインIDよりログ一覧が表示される
     */
    function admin_list_by_user_id() {
        $this->__loadSearchConditions($conditions);
        $conditions['conditions']['user_id ='] = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $this->paginate = $conditions;
        $this->set('operatorLogList', $this->paginate());

        $this->layout = 'admin';
        $this->render('admin_index');
    }

    function __loadSearchConditions(&$conditions = array()) {
        $conditions = array(
                        'fields'        => array(
                                            'OperatorLog.*',
                                            'Admin.login_id',
                        ),
                        'conditions'    => array(
                                            'user_type =' => USER_TYPE_ADMIN,
                        ),
                        'joins' => array(
                                            array("type" => "INNER",
                                                "table" => "admin",
                                                "alias" => "Admin",
                                                "conditions" => "Admin.id=OperatorLog.user_id",
                                            ),
                        ),
                        'order'         => array(
                                            "OperatorLog.create_datetime" => 'DESC',
                        ),
                        'limit'         => ADMIN_PAGE_LIMIT_COMM,
        );
    }
}
?>