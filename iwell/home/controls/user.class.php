<?php
			class User {
						function index(){
								p('aaaaaaaaaaaa');
						}
						//连接到注册页面
						function reg(){
								$this->display();
						}
						//验证码类
						function code(){
								echo new Vcode();
						}
						function yz(){
								$GLOBALS["debug"]=0;
								$user=D('user');
								if($user->field('reg_username')->where(array('reg_username'=>$_POST['reg_username']))->select()){
										echo "用户名已被使用";
								}else{
										echo "用户名可以使用";
								}
						}
						//注册
						function insert(){
								$user=D('user');
								$_POST['reg_ip']=ip();
								$_POST['reg_time']=time();
								$_POST['reg_password']=md5($_POST['reg_password']);
								$user->query('set names utf8');
								if($user->insert()){
										$this->assign('name',$_POST['reg_username']);
										$this->assign('info','恭喜你注册成功');
										$this->display();
								}								
						}
						//登陆
						function login(){
								$this->display();
						}
						function isLogin(){
							//先判断用户名密码是否为空,不为空的话从数据库里验证用户名密码.
								if($_POST['reg_username']=="" or $_POST['reg_password']==""){
										$this->error('用户名或密码不能为空',3,'login');
								}else{
										$u=D('user');
										$user=$u->field('reg_username,reg_password')->where(array('reg_username'=>$_POST['reg_username'],'reg_password'=>md5($_POST['reg_password'])))->find();
										if($user){
														$_SESSION=$user;
														$this->redirect('index/index');
										}else{
														$this->error('用户名或密码错误',3,'login');
										}
								}
						}
						function logout(){
											//获取到登陆名
											$username=$_SESSION["reg_username"];
											$_SESSION=array();

											if(isset($_COOKIE[session_name()])){
												setCookie(session_name(), '', time()-100, '/');
											}
											session_destroy();

											$this->redirect('index/index');
						}
			}
			