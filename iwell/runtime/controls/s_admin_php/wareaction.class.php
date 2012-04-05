<?php
	/**
			商品类，主要的功能是商品的添、删、改、查的方法
	*/
	class wareAction extends Common {
			//商品查询页面
			function index(){
					$ware=D('ware');
					$page=new Page($ware->total(),25);
					$data=$ware->limit($page->limit)->select();
					$this->assign('data',$data);
					$this->assign('fpage',$page->fpage());
					$this->display();
			}
			//商品添加跳转页
			function add(){
					//商品跳转页里面需要 类别表里的类别名 和 品牌表的里的品牌名称
					//分类
					$cat=D('cat');
					$catname=$cat->field('c_name')->select();
					$this->assign('cat',$catname);
					//品牌
					$brand=D('brand');
					$brandname=$brand->field('b_name')->select();
					$this->assign('brand',$brandname);
					$this->display();		
			}
			//商品删除
			function delete(){

			}
			//商品修改
			function update(){

			}
			//商品修改跳转页
			function mod(){

			}
			//商品添加页面
			function insert(){

			}
			//商品回收站页
			function recover(){
					$this->display;
			}
			//商品评论页
			function comment(){

			}

	}
