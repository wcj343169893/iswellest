<?php
class Common extends Action {
	function init() {
		$s = D ( 'ware' );
		$cat = D ( "cat" );
		// 最新产品
		$newData = $s->limit ( 6 )->order ( "sale_begin asc" )->where ( array (
				'sale_end > ' => date ( "Y-m-d H:i:s" ) 
		) )->joins ( "cat", "w_cat", "id", "id,c_name" )->select ();
		// 即将下架产品
		$endingsoondata = $s->limit ( 6 )->order ( "sale_end asc" )->where ( array (
				'sale_end > ' => date ( "Y-m-d H:i:s" ) 
		) )->joins ( "cat", "w_cat", "id", "id,c_name" )->select ();
		// 产品分类
		//高老师写的联合查询便利数组，没太明白。。。
		$category=$cat->where(array("pid"=>0))->r_select(array("cat", '', "pid", array("subcat", 'id desc', 20)));
// 		print_r($category);
		$this->assign ( 'category', $category );
		$this->assign ( 'newData', $newData );
		$this->assign ( 'endingsoondata', $endingsoondata );
	}
}