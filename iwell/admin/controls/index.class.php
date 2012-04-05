<?php
	class Index {
				function main(){
					$this->display();
				}
				function top(){
					$GLOBALS["debug"]=0;
					$this->display();
				}
				function center(){
					$GLOBALS["debug"]=0;
					$this->display();
				}
				function right(){
					$GLOBALS["debug"]=0;
					$this->display();
				}
				function left(){
					$GLOBALS["debug"]=0;
					$this->display();
				}
				function info(){
						$GLOBALS["debug"]=0;
						//系统信息
						$c=D();
						$arr2[]=PHP_OS.'('.$_SERVER['SERVER_ADDR'].')';
						$arr2[]=PHP_VERSION;
						$arr2[]=$_SERVER["SERVER_SOFTWARE"];
						$arr2[]=$c->dbVersion();
						//待发货的订单，说明是1,0,0的情况下
						$da=D('order');
						$arr[]=$a=$da->where(array('ok'=>'1','consignment'=>'0'))->total();
						$arr[]=$b=$da->where(array('ok'=>'0'))->total();
						$arr[]=$c=$da->where(array('ok'=>'1','pay'=>'0'))->total();
						$arr[]=$d=$da->where(array('ok'=>'1','pay'=>'1','consignment'=>'1'))->total();
						$arr[]=$e=1;
						$arr[]=$f=$da->where(array('retu'=>'1'))->total();
						//实体商品统计
						$wa=D('ware');
						$arr1[]=$wa->total();
						$arr1[]=$wa->where(array('w_num<'=>'100'))->total();
						$this->assign('d',$arr);
						$this->assign('w',$arr1);
						$this->assign('info',$arr2);
						$this->display();
				}

				
						
				
	}