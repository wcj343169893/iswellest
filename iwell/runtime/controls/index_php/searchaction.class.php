<?php
		class searchAction extends Common {
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
						$c=D('cat');
						$w=D('ware');
						$p=empty($_GET['p'])?1:$_GET['p'];
						$cid=empty($_GET['cid'])?"0":$_GET['cid'];
						$num=$w->where(array('w_cat'=>$cid))->total();
						$pageSize=12;
						$sort=empty($_GET['sort'])?"asc":$_GET['sort'];
						$limit=(($p-1)*$pageSize).",".$pageSize;
						$order=empty($_GET['order'])?"sale_begin":$_GET['order'];
						$data=$w->where(array('w_cat'=>$cid))->limit($limit)->order($order." ".$sort)->select();
						$total_page = ceil($num/$pageSize)<1 ? 1:ceil($num/$pageSize); // 如果有余，向上取整
						
						$cat=$c->find($cid);
						$this->assign('cat',$cat);
						$this->assign('data',$data);
						$this->assign('sort',$sort);
						$this->assign('p',$p);
						$this->assign('order',$order);
						$this->assign('total_page',$total_page);
						$this->assign('pageSize',$pageSize);
						$this->assign('num',$num);
						$this->assign('cid',$cid);
						$this->display();
				}
				
		}
?>