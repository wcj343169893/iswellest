<?php
			class catAction extends Common {
						//类别列表页
						function index(){
								$c=D("cat");
								$data=$c->select();
								$this->assign("ls", $c->list1());
								$this->assign('data',$data);
								$this->display();
						}
						//转入添加类别页
						function add(){
												$c=D("cat");	
												$this->assign("select", $c->select1("pid"));
												$this->display();	
						}
						//添加类别
						function insert(){
												$c=D('cat');
												if($_POST['id']==0){
														$_POST['c_path']=0;
												}else{
														$data=$c->find($_POST['pid']);
														$_POST['c_path']=$data['c_path'].'-'.$_POST['pid'];
												}
												if($c->insert()){
														$this->redirect('index');
												}else{
														$this->error('添加类别失败',3,'add');
														p('bbbbbbbbbbbbbb');
												}
						}
						//删除类别
						function delete(){
											$c=D('cat');
											if($c->where(array('pid'=>$_GET['id']))->select()){
													$this->error('该类别下面有子类，请先删除子类',5,index);
											}else{
													$c->where(array('id'=>$_GET['id']))->delete();
													$this->redirect('index');
											}
						}
						//修改类别
						function mod(){
										$c=D('cat');
										$data=$c->where(array('id'=>$_GET['id']))->find();
										$this->assign('data',$data);
										$this->display();
						}
						function update(){
										$c=D('cat');
										if($c->update()){
												$this->success('修改类别成功',1,'index');
										}else{
												$this->error($c->getMsg(), 3, "cat/mod/id/{$_POST['id']}");
										}
						}
			}