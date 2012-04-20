<?php
class Common extends Action {
	function init() {
		//加载导航数据
		$s = D ( 'goods' );
		$cat = D ( "category" );
		// 最新产品
		$newData = $s->limit ( 6 )->order ( "sale_begin_time asc" )->where ( array (
				'sale_end_time > ' => date ( "Y-m-d H:i:s" ) 
		) )->joins ( "category", "cat_id", "cat_id", "cat_id,cat_name" )->select ();
		// 即将下架产品
		$endingsoondata = $s->limit ( 6 )->order ( "sale_end_time asc" )->where ( array (
				'sale_end_time > ' => date ( "Y-m-d H:i:s" ) 
		) )->joins ( "category", "cat_id", "cat_id", "cat_id,cat_name" )->select ();
		// 产品分类
		//高老师写的联合查询便利数组，没太明白。。。
		$category=$cat->where(array("parent_id"=>0))->r_select(array("category", '', "parent_id", array("subcat", 'cat_id desc', 20)));
// 		print_r($category);
		$this->assign ( 'category', $category );
		$this->assign ( 'head_newData', $newData );
		$this->assign ( 'head_endingsoondata', $endingsoondata );
	}
}