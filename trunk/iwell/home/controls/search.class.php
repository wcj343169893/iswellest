<?php
		class search {
				//按商品查询页
				function ware(){
						$w=D('ware');
						$content=$_POST['content'];
						//查询结果集
						$data=$w->where(array('w_name'=>'%'.$content.'%'),array('w_price'=>'%'.$content.'%'),array('w_cat'=>'%'.$content.'%'),array('w_brand'=>'%'.$content.'%'))->select();
						//查询搜索出来的条数
						$num=$w->where(array('w_name'=>'%'.$content.'%'),array('w_price'=>'%'.$content.'%'),array('w_cat'=>'%'.$content.'%'),array('w_brand'=>'%'.$content.'%'))->total();
						//将结果，标题，数量统统传过去
						//便利出热销的商品，显示出5个商品信息
						$data1=$w->order('sale desc')->limit(5)->select();
						$this->assign('con',$content);
						$this->assign('data',$data);
						$this->assign('num',$num);
						$this->assign('data1',$data1);
						$this->display();
				}
				//按类别查询页
				function cat(){
						$w=D('ware');
						$data=$w->where(array('w_cat'=>$_GET['cname']))->select();
						$num=$w->where(array('w_cat'=>$_GET['cname']))->total();
						$this->assign('data',$data);
						$this->assign('num',$num);
						$this->assign('c_name',$_GET['cname']);
						$this->display();
				}
				
		}
?>