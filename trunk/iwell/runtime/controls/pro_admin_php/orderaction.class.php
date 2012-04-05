<?php
	//订单类
	class orderAction extends Common {
			//订单列表 要的字段是订单号 下单时间 收货人 总金额 订单状态（ok,pay,consignment）三个字段合为一个表格
			function index(){
					$d=D('order');
					$page=new Page($d->total(),15);
					$data=$d->limit($page->limit)->order('id desc')->select();
					$this->assign('data',$data);
					$this->assign('fpage',$page->fpage());
					$this->display();

			}
			function order_info(){
					$d=D('order');
					//找到传过来的ID信息
					$data=$d->find($_GET['id']);
					$this->assign('data',$data);

					//通过订单ID，来找到该订单下面都有什么商品，和商品的数量
					$o=D('order_ware');
					$data1=$o->where(array('order_id'=>$data['order_id']))->select();
					foreach($data1 as $val){
							$arr[]=$val['wid'];
							$num[]=$val['wnum'];
					}
					//在读取到该商品的信息
					$w=D('ware');
					$data2=$w->where($arr)->select();
					foreach($data2 as $k=>$v){
							for($i=0;$i<count($data2);$i++){
									$data2[$k]['num']=$num[$i];
							}
					}
					$a=D('order_operate');
					$data3=$a->where(array('order_id'=>$_GET['id']))->select();
					$this->assign('data3',$data3);
					$this->assign('data2',$data2);
					$this->display();
			}
			function submit(){
					$d=D('order');
					$s=D('order_operate');
					if($_POST['pay']=='确认'){
						if($d->where(array('id'=>$_POST['order_id']))->update('ok=1')){
								$data=$d->where(array('id'=>$_POST['order_id']))->find();
								$arr['order_id']=$_POST['order_id'];
								$arr['operater']=$_SESSION['username'];
								$arr['operate_time']=time();
								$arr['ok']=$data['ok'];
								$arr['pay']=$data['pay'];
								$arr['consignment']=$data['consignment'];
								$arr['desn']=$_POST['action_note'];
								$s->insert($arr);
								$this->success('操作成功',3,"order/order_info/id/".$_POST['order_id']);
						}
					}
					if($_POST['unship']=='发货'){
								if($d->where(array('id'=>$_POST['order_id']))->update('consignment=1')){
								$data=$d->where(array('id'=>$_POST['order_id']))->find();
								$arr['order_id']=$_POST['order_id'];
								$arr['operater']=$_SESSION['username'];
								$arr['operate_time']=time();
								$arr['ok']=$data['ok'];
								$arr['pay']=$data['pay'];
								$arr['consignment']=$data['consignment'];
								$arr['desn']=$_POST['action_note'];
								$s->insert($arr);
								$this->success('操作成功',3,"order/order_info/id/".$_POST['order_id']);
						}
					}
			}
	}