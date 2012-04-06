<?php
	//全局可以使用的通用函数声明在这个文件中.
	function ip(){
			return $_SERVER[REMOTE_ADDR];
	}
	function dsubstr($str,$length=null){
		return substr($str, 0,$length);
	}
?>