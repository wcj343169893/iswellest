<?php
			class contentAction extends Common {
						
						//列表显示
						function index(){
								$c=D('content');
								$data=$c->field('id,title,content,ntime')->order("id asc")->select();      //浏览所有记录
								$this->assign('data',$data);
								$this->display();
						}
						
						//快报修改
						function mod(){
								$c=D('content');										//创建实例                        
								$data=$c->find($_GET["id"]);				//从隐藏的ID获得要修改的那一条，返回数组
								$this->assign('data',$data);					//分配名字和值
								//$this->assign('select',$c->select1(""))
								$this->display();                                     //显示页面
						}
						//快报详细的修改
						function update(){
								$c=D('content');
								$rows=$c->update();								//返回受影响行数
								if($rows){
									$this->success('快报修改成功',2,'index');
								}else{
									$this->error($c->getMsg(),2,"content/mod/id/{$_POST['id']}");
								}
						
						}

						//内容删除
						function delete(){
								$c=D('content');
								$rows=$c->delete($_GET["id"]);
								if($rows){
									$this->redirect('index');
								}else{
									$this->error($c->getMsg(),2,"content/delete/id{$_GET['id']}");
								}
						}

						//内容添加
						function add(){
								$this->display();
						}

						function insert(){
								$c=D('content');
								if($c->insert()){
									$this->success('添加成功',1,'index');
								}else{
									$this->error('添加失败',3,'add');
							}
						}

	}