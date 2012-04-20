<?php
	class Index {
		function index(){
					$s=D('ware');
					$p=D('content'); 
					$l=D('link');
					//特价商品
					$data=$s->limit(6)->where(array('w_type'=>'tj'))->joins("cat","w_cat","id","id,c_name")->select();
					$this->assign('data',$data);
					//创意专区
					$data_r=$s->limit(3)->where(array('w_type'=>'r'))->joins("cat","w_cat","id","id,c_name")->select();
					$this->assign('datar',$data_r);
					//最新产品
					$newData=$s->limit(6)->order("sale_begin asc")->where(array('sale_end > '=>date("Y-m-d H:i:s")))->joins("cat","w_cat","id","id,c_name")->select();
// 					$result=$s->unit_select("SELECT w.*,c.c_name FROM pro_ware w LEFT JOIN pro_cat c ON w.w_cat=c.id WHERE sale_begin <> '' AND  DATE_FORMAT(sale_begin,'%Y%m%d%h%i')>DATE_FORMAT(NOW(),'%Y%m%d%h%i') ORDER BY sale_begin ASC LIMIT 0,10;");
					
					$result1=$s->limit(6)->order("sale_begin asc")->where(array('w_type'=>'tj'))->joins("cat","w_cat","id","id,c_name")->select();
// 					print_r($s->joins("cat","w_cat","id","id,c_name")->select());
					$this->assign('newData',$newData);
					//快要过期产品
					$endingsoondata=$s->limit(12)->order("sale_end asc")->where(array('sale_end > '=>date("Y-m-d H:i:s")))->joins("cat","w_cat","id","id,c_name")->select();
					$this->assign('endingsoondata',$endingsoondata);
					//明天上线的产品
//					echo "明天:".date("Y-m-d",strtotime("+1 day")). "<br>"; 
					$tr1Data=$s->limit(10)->where("sale_begin like '".date("Y-m-d",strtotime("+1 day"))."%'")->order("sale_begin asc")->joins("cat","w_cat","id","id,c_name")->select();
					$this->assign('tr1',date("l m/d",strtotime("+1 day")));
					$this->assign('tr1Data',$tr1Data);
//					print_r($tomorrowData);
					//后天上线的产品
					$tr2Data=$s->limit(10)->where("sale_begin like '".date("Y-m-d",strtotime("+2 day"))."%'")->order("sale_begin asc")->joins("cat","w_cat","id","id,c_name")->select();
					$this->assign('tr2',date("l m/d",strtotime("+2 day")));
					$this->assign('tr2Data',$tr2Data);
					//大后天上线的产品
					$tr3Data=$s->limit(10)->where("sale_begin like '".date("Y-m-d",strtotime("+3 day"))."%'")->order("sale_begin asc")->joins("cat","w_cat","id","id,c_name")->select();
					$this->assign('tr3',date("l m/d",strtotime("+3 day")));
					$this->assign('tr3Data',$tr3Data);
					
					$goods=D("goods");
					$goodsList=$goods->limit(10)->select();
					$this->assign('goodsList',$goodsList);
					//手机配件
// 					$pj=$s->limit(6)->where(array('w_type'=>'pj'))->select();
// 					$this->assign('pj',$pj);
					//右侧广告栏的信息
// 					$r=$s->limit(6)->where(array('w_type'=>'r'))->select();
// 					$this->assign('r',$r);
					//分类
// 					$c=D('cat');
// 					//高老师写的联合查询便利数组，没太明白。。。
// 					$cat=$c->where(array("pid"=>0))->r_select(array("cat", '', "pid", array("subcat", 'id desc', 15)));
// 					$this->assign('cat',$cat);
// 					print_r($cat);
					//右侧公告
// 					$c=$p->limit(3)->order('id desc')->select();
// 					$this->assign('c',$c);
	
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
// 				$id=$_GET['id'];
// 				$s=D('ware');
// 				//查询出最近浏览过的商品
// 				$lately=$s->where($_COOKIE['id'])->order('id desc')->limit(8)->select();
// 				$this->assign('lately',$lately);
// 				//首先获得该商品的商品信息
// 				$data=$s->where(array('id'=>$_GET['id']))->joins("cat","w_cat","id","id,c_name")->find();
// 				//然后获得该商品的商品属性
// 				$a=D('ware_attribute');
// 				$attribute=$a->where(array('wid'=>$_GET['id']))->select();
// 				//获取商品的介绍
// 				$inc=D("ware_introduction");
// 				$incData=$inc->limit(4)->where(array('wid'=>$_GET['id']))->select();
				
// 				//然后获得同品牌商品的信息,首先读取到这个商品的品牌，然后SELECT 商品表 w_cat 等于 DATA里的CAT
// 				$brand=$s->where(array('w_brand'=>$data['w_brand']))->limit(10)->select();
// 				$cat=$s->where(array('w_cat'=>$data['w_cat']))->limit(10)->select();
// 				$d=$data['w_price'] - $data['w_price']*0.05 ;
// 				$x=$data['w_price'] + $data['w_price']*0.05;
// 				$price=$s->where(array('w_price<'=>"$x",'w_price>'=>"$d"))->limit(10)->select();
				
// 				//查询评价
// 				$com=D("comment");
// 				$comment=$com->where(array("com_wid"=>$id))->joins("user","com_uid","id","id,reg_username")->select();
// 				//获取商品赠品信息
// 				$g=D('gift');
// 				$gift=$g->select();
// 				//------------------------------------------------------------------------------------------
// 				$this->assign('gift',$gift);
// 				$this->assign('brand',$brand);
// 				$this->assign('cat',$cat);
// 				$this->assign('price',$price);
// 				$this->assign('att',$attribute);
// 				$this->assign('inc',$incData);
// 				$this->assign('data',$data);
// 				$this->assign('comment',$comment);
// 				$this->assign('comment_count',count($comment));

				
				//最新查询
				$goods_id=$_GET['id'];
				//产品信息
				$goods=D('goods');
				$data=$goods->where(array('goods_id'=>$goods_id))->find();
				//产品相册
				$gg=D("goods_gallery");
				$gallerys=$gg->where(array("goods_id"=>$goods_id))->select();
				
				$this->assign('gallerys',$gallerys);
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