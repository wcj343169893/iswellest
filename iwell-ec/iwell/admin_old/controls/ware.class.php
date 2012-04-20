<?php
/**
			商品类，主要的功能是商品的添、删、改、查的方法
 */
class ware {
	//商品查询页面
	function index() {
		$ware = D ( 'ware' );
		$page = new Page ( $ware->total ( array ('is_show' => 1 ) ), 25 );
		$data = $ware->where ( array ('is_show' => '1' ) )->limit ( $page->limit )->select ();
		$this->assign ( 'data', $data );
		$this->assign ( 'fpage', $page->fpage () );
		$this->display ();
	}
	//商品添加跳转页
	function add() {
		//商品跳转页里面需要 类别表里的类别名 和 品牌表的里的品牌名称
		//分类
		$cat = D ( 'cat' );
		$catname = $cat->field ( 'c_name' )->select ();
		$this->assign ( 'select', $cat->select1 () );
		//品牌
		$brand = D ( 'brand' );
		$brandname = $brand->fieldList ( 'id','b_name' )->select ();
		$this->assign ( 'brand', $brandname );
		$this->display ();
	}
	//商品删除
	function delete() {
		$w = D ( 'ware' );
		if ($w->delete ( $_GET ['id'] )) {
			$this->success ( '删除成功', 3, 'recover' );
		} else {
			$this->error ( '删除失败', 1, 'recover' );
		}
	}
	//商品修改
	function update() {
		$b = D ( 'ware' );
		if ($_FILES ['w_pic'] ['error'] == 0) {
			$path = PROJECT_PATH . "/public/images/" . $_POST ['imgsrc'];
			if (file_exists ( $path )) {
				unlink ( $path );
			}
			$_POST ['w_pic'] = $this->upload ();
		}
		if (empty ( $_POST ['w_code'] )) {
			$_POST ['w_code'] = $b->code ();
		}
		if ($b->update ()) {
			$this->success ( '修改成功', 1, 'index' );
		} else {
			$this->error ( $b->getMsg (), 3, 'ware/mod/id/' . $_POST ['id'] );
		}
	}
	//商品修改跳转页
	function mod() {
		$w = D ( 'ware' );
		//如果用find的话  生成的是一位数组，用select 生成的则是二维数组，切记
		$data = $w->where ( array ('id' => $_GET ['id'] ) )->find ();
		//类别
		$cat = D ( 'cat' );
		$catname = $cat->field ( 'c_name' )->select ();
		$this->assign ( 'cat', $catname );
		$this->assign ( 'select', $cat->select1 ( 'w_cat', $_GET ['id'], $_GET ) );
		//品牌
		$brand = D ( 'brand' );
		$brandname = $brand->fieldList ( 'id','b_name' )->select ();
		$this->assign ( 'brand', $brandname );
		$this->assign ( 'data', $data );
		$this->display ();
	}
	//商品添加页面
	function insert() {
		$w = D ( 'ware' );
		if (empty ( $_POST ['w_code'] )) {
			$_POST ['w_code'] = $w->code ();
		}
		if ($_POST ['w_pic']) {
			$_POST ['w_pic'] = $this->upload ();
		}else{
			//暂无图片
			$_POST ['w_pic']="a.jpg";
		}
		if ($w->insert ()) {
			$this->success ( '添加商品成功', 1, 'index' );
		} else {
			unlink ( PROJECT_PATH . 'public/uploads/' . $_POST ["w_pic"] );
			$this->error ( $w->getMsg (), 3, 'add' );
		}
	}
	private function upload() {
		//new一个文件上传对象
		$up = new Fileupload ();
		$up->set ( "path", PROJECT_PATH . "public/images/ware" );
		if ($up->upload ( 'w_pic' )) {
			return $up->getFileName ();
		} else {
			$this->error ( $up->getErrorMsg (), 3, 'add' );
		}
	}
	//商品回收站页
	function recover() {
		$w = D ( 'ware' );
		$data = $w->where ( array ('is_show' => 0 ) )->select ();
		$this->assign ( 'data', $data );
		$this->display ();
	}
	//执行回收站操作
	function cover() {
		$w = D ( 'ware' );
		if ($w->where ( array ('id' => $_GET ['id'] ) )->update ( "is_show=0" )) {
			$this->redirect ( 'index' );
		}
	}
	function restore() {
		$w = D ( 'ware' );
		if ($w->where ( array ('id' => $_GET ['id'] ) )->update ( "is_show=1" )) {
			$this->redirect ( 'index' );
		}
	}
	//商品评论页
	function comment() {
	
	}

}
