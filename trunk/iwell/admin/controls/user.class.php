<?php
			class user extends Action {
						//验证用户密码，并跳转页
						function isLogin(){
								if($_POST['username']!="" && $_POST['password']!=""){
										$a=D('admin');
										//查找用户名与密码与前台登录页面相等的值.
										$d=$a->where(array('username'=>$_POST['username'],'password'=>md5($_POST['password'])))->find();
										if($d){
													$_SESSION=$d;
													switch($_SESSION['allow_1']){
															case 1:
																$_SESSION['sf']='管理员';
																break;
															case 2:
																$_SESSION['sf']='操作员';
																break;
															case 3:
																$_SESSION['sf']='信息统计员';
																break;
													}
													$_SESSION['isLogin']=1;
													$this->success("登录成功", 1, "index/main");
										}else{
													$this->error('用户名不存在或密码错误',3,'login');
										}
								}else{
													$this->error('用户名或密码不能为空',3,'login');
								}
						}
						//添加用户转入页
						function add(){
								$this->display();
						}
						//用户列表页
						function index(){
								$admin=D('admin');
								$data=$admin->field("id,username,phone,allow_1,utime,post")->select();
								$this->assign('data',$data);
								$this->display();
						}
						//添加用户方法
						function insert(){
								$admin=D('admin');				
								if($admin->where(array('username'=>$_POST['username']))->find()){
											$this->error('用户名已存在',3,'add');
								}else{
											$_POST['password']=md5($_POST['password']);
											$_POST['utime']=time();
											if($admin->insert()){
													$this->success('添加成功',3,'index');
											}else{
													$this->error('添加用户失败',3,'add');
											}
								}							

						}
						//转入修改密码页
						function pass(){
										$this->assign('username',$_SESSION['username']);
										$this->assign('id',$_SESSION['id']);
										$this->display();
						}
						//退出，清空SESSION
						function logout(){
							$username=$_SESSION["username"];

							$_SESSION=array();

							if(isset($_COOKIE[session_name()])){
								setCookie(session_name(), '', time()-100, '/');
							}

							session_destroy();

							$this->success("退出成功！再见{$username}", 2, 'login');
						}
						function delete(){
								$d=D('admin');
								if($d->where(array('id'=>$_GET['id']))->delete()){
										$this->redirect('index');
								}else{
										$this->error('删除失败',3,'index');
								}
						}
						//转入到修改密码页,将信息传过去
						function mod(){
								$d=D('admin');
								$data=$d->field('id,username,post,allow_1,phone')->where(array('id'=>$_GET['id']))->find();
								$this->assign('data',$data);
								$this->display();
						}
						//修改用户信息
						function update(){
								$d=D('admin');
								if($d->update()){
										$this->success('修改用户信息成功',1,'index');
								}else{
										$this->error('修改用户信息失败',3,'user/mod/id/$_POST["id"]');
								}
						}
						function login(){
								$this->display();
						}
						function quanxian(){
								$this->display();
						}
						function uppass(){
								$d=D('admin');
								//判断原密码输入是否正确，取ID，密码找到id= && password=""的记录。
								if($d->field('id,password')->where(array('id'=>$_POST['id'],'password'=>md5($_POST['password'])))->find()){
										//开始修改
										$_POST['password']=md5($_POST['newpassword']);
										if($d->update()){
											$this->success('修改密码成功',1,'index');
										}else{
											$this->error('修改密码失败',3,'pass');
										}
								}else{
										$this->error('原密码输入错误',3,'pass');
								}
						}
			}
