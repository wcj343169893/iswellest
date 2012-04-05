<?php
	class Common extends Action {
		function init(){
				//判断是否登录，如果没有登录的话直接跳转到登录的页面
				if(!(isset($_SESSION["isLogin"]) && $_SESSION["isLogin"]===1)){
					$this->redirect("user/login");
				}
		}		
	}