<?php
	class Index {
		function index(){
					$s=D('ware');
					$p=D('content'); 
					$l=D('link');
					//特价商品
					$data=$s->limit(6)->where(array('w_type'=>'tj'))->select();
					$this->assign('data',$data);
					//最新产品
					$newData=$s->limit(6)->where(array('w_type'=>'tj'))->select();
					$this->assign('newData',$newData);
					//快要过期产品
					$endingsoondata=$s->limit(12)->order("sale_end asc")->select();
					$this->assign('endingsoondata',$endingsoondata);
					//手机配件
					$pj=$s->limit(6)->where(array('w_type'=>'pj'))->select();
					$this->assign('pj',$pj);
					//右侧广告栏的信息
					$r=$s->limit(6)->where(array('w_type'=>'r'))->select();
					$this->assign('r',$r);
					//分类
					$c=D('cat');
					//高老师写的联合查询便利数组，没太明白。。。
					$cat=$c->where(array("pid"=>0))->r_select(array("cat", '', "pid", array("subcat", 'id desc', 15)));
					$this->assign('cat',$cat);
					//右侧公告
					$c=$p->limit(3)->order('id desc')->select();
					$this->assign('c',$c);
					//友情链接
					$link=$l->select();
					$this->assign('link',$link);
					$this->display();

		}
		//商品单品类
		function ware(){	
			$count=count($_COOKIE['id']);
			//获取cookie数组的长度，将其赋值
			if(!isset($_COOKIE['id'])){
					setcookie("id[]",$_GET['id'],time()+3600*24*7);
			}else if(!in_array($_GET['id'],$_COOKIE['id'])){
					setcookie("id[$count]",$_GET['id'],time()+3600*24*7);
			}
				$s=D('ware');
				//查询出最近浏览过的商品
				$lately=$s->where($_COOKIE['id'])->order('id desc')->limit(8)->select();
				$this->assign('lately',$lately);
				//首先获得该商品的商品信息
				$data=$s->where(array('id'=>$_GET['id']))->find();
				//然后获得该商品的商品属性
				$a=D('ware_attribute');
				$attribute=$a->where(array('wid'=>$_GET['id']))->select();
				//然后获得同品牌商品的信息,首先读取到这个商品的品牌，然后SELECT 商品表 w_cat 等于 DATA里的CAT
				$brand=$s->where(array('w_brand'=>$data['w_brand']))->limit(10)->select();
				$cat=$s->where(array('w_cat'=>$data['w_cat']))->limit(10)->select();
				$d=$data['w_price'] - $data['w_price']*0.05 ;
				$x=$data['w_price'] + $data['w_price']*0.05;
				$price=$s->where(array('w_price<'=>"$x",'w_price>'=>"$d"))->limit(10)->select();
				//获取商品赠品信息
				$g=D('gift');
				$gift=$g->select();
				//------------------------------------------------------------------------------------------
				$this->assign('gift',$gift);
				$this->assign('brand',$brand);
				$this->assign('cat',$cat);
				$this->assign('price',$price);
				$this->assign('att',$attribute);
				$this->assign('data',$data);
				$this->display();
		}

		function cat(){
				$c=D('cat');
				$cat=$c->select();
				$this->assign('cat',$cat);
		}

		
		//显示新闻内容
		function content(){
				$c=D('content');
				$data=$c->find($_GET["id"]);
				$list=$c->limit(6)->select();
				$this->assign('list',$list);
				$this->assign('data',$data);
				$this->display();
		}
		
		function listnews(){
				$c=D('content');
				$data=$c->select();
				$this->assign('data',$data);
				$this->display();
		}


	}