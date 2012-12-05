<?php
/**
 * ファイル名：app_form.php
 * 概要：ECサイト用のフォームヘルプのクラス
 * 
 * 作成者：shilei
 * 作成日：2012/01/10
 * 変更履歴：
 */
App::import('Helper', 'Session'); 
class AppSessionHelper extends SessionHelper {
    
    /**
     * Used to render the message set in Controller::Session::setFlash()
     *
     * In your view: $session->flash('somekey');
     * Will default to flash if no param is passed
     *
     * @param string $key The [Message.]key you are rendering in the view.
     * @return boolean|string Will return the value if $key is set, or false if not set.
     * @access public
     * @link http://book.cakephp.org/view/1466/Methods
     * @link http://book.cakephp.org/view/1467/flash
     */
	function flash($key = 'flash', $withTag = true) {
		$out = false;
		if ($this->__active === true && $this->__start()) {
			if (parent::check('Message.' . $key)) {
				$flash = parent::read('Message.' . $key);
				if ($flash['element'] == 'default') {
					if (!empty($flash['params']['class'])) {
						$class = $flash['params']['class'];
					} else {
						$class = 'message';
					}
					if (empty($flash['message'])) {
					    return;
					}
					if ($withTag) {
					    $out = '<p id="' . $key . 'Message" class="' . $class . '">' . $flash['message'] . '</p>';
					} else {
    					$out = $flash['message'];
					}
				} elseif ($flash['element'] == '' || $flash['element'] == null) {
					$out = $flash['message'];
				} else {
					$view =& ClassRegistry::getObject('view');
					$tmpVars = $flash['params'];
					$tmpVars['message'] = $flash['message'];
					$out = $view->element($flash['element'], $tmpVars);
				}
				parent::delete('Message.' . $key);
			}
		}
		return $out;
	}
}
?>