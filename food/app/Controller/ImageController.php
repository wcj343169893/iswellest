<?php
class ImageController extends AppController {
	
	public function beforeFilter() {
		$this->Auth->allow ( 'seccode', 'view', 'display' );
	}
	/**
	 * 生成验证码,并把值存入session
	 */
	public function seccode() {
		App::uses ( 'SeccodeComponent', 'Controller/Component' );
		$code = new SeccodeComponent ();
		$code->code = rand ( 100000, 999999 );
		$code->width = 150;
		$code->height = 47;
		$code->ttf = "PilsenPlakat";
		$code->fontpath = CACHE . "seccode" . DS . "font" . DS;
		$code->datapath = CACHE . "seccode" . DS;
		$code->display ();
		$this->Session->write ( $this->seccodeKey, $code->code );
		exit ();
	}
}
?>