<?php
/**
 * ファイル名：app_error.php
 * 概要：ECサイト用のエラーのハンドラー
 * 
 * 作成者：shilei
 * 作成日：2012/03/28
 * 変更履歴：
 */
class AppError extends ErrorHandler {
    /**
     * Displays an error page (e.g. 404 Not found).
     *
     * @param array $params Parameters for controller
     * @access public
     */
    function error($params) {
        $defaultParams = array(
            'code'    => '',
            'name'    => '',
            'message' => __('error.systemError', true),
            'title'   => '',
        );
        $params = array_merge($defaultParams, $params);
        $this->controller->set($params);
        if ($this->controller->Acl->isAdminRequest()) {
            $this->controller->layout = 'admin';
            $this->_outputMessage('admin_error');
            return;
        } else {
            $this->controller->layout = 'front';
        }
        $this->_outputMessage('error');

    }

    /**
     * Convenience method to display a 404 page.
     *
     * @param array $params Parameters for controller
     * @access public
     */
    function error404($params) {
        $params['message'] =  __('error.pageNotExists', true);
        $this->error($params);
    }

    /**
     * Renders the Missing Action web page.
     *
     * @param array $params Parameters for controller
     * @access public
     */
    function missingAction($params) {
        $this->error404($params);
    }

    /**
     * Renders the Missing Controller web page.
     *
     * @param array $params Parameters for controller
     * @access public
     */
    function missingController($params) {
        $this->error404($params);
    }

    /**
     * Renders the Missing View web page.
     *
     * @param array $params Parameters for controller
     * @access public
     */
    function missingView($params) {
        $this->error404($params);
    }
}
?>
