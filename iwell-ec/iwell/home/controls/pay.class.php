<?php
			class pay {
							//用户支付时，选择银行的界面
						function index(){
								$order=D('order');
								//订单ID
								$_POST['order_id']	=$order->randcode();
								//订单时间
								$_POST['order_time']=time();
								//生成订单信息
								//将订单信息插入到数据库
								if($id=$order->insert()){
								//生成商品属性信息
										$order=D('order');
										$order_ware=D('order_ware');
										$info=rtrim($_POST['info'],'|');
										$info=explode('|',$info);
										foreach($info as $key=>$value){
												$arr=explode('&',$value);
													$order_ware->insert(array('order_id'=>$_POST['order_id'],'wid'=>$arr[0],'wnum'=>$arr[1]));										
										}
								$res=$order->where(array('id'=>$id))->find();
								
								$c=D('pay');
								$data=$c->limit(5)->select();
								$data1=$c->limit(6,5)->select();
								$data2=$c->limit(11,5)->select();
								$this->assign('order_id',$_POST['order_id']);
								$this->assign('price',$_POST['price']);
								$this->assign('data',$data);
								$this->assign('data1',$data1);
								$this->assign('data2',$data2);

								include_once PROJECT_PATH . "/home/views/default/yeepay/req.php";

								$res_bank = yeepay_bank($res);
								
								$this->assign('banks',$res_bank);

								$this->display();
								
								}
								//转到另一个页面

						}
							
			}

