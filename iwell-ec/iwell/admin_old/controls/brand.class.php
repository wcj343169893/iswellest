<?php
	//品牌类
	class Brand {
			//查看品牌的信息
			function index(){
						$b=D('brand');
						$data=$b->select();
						$this->assign('data',$data);
						$this->display();
			}
			//添加品牌页
			function add(){
					$this->display();
			}
			//执行添加品牌
			function insert(){
					$b=D('brand');
					$_POST['logo']=$this->upload();
					if($b->insert()){
							$this->success("添加成功", 3, "index");
					}else{
										unlink(PROJECT_PATH.'public/uploads/'.$_POST["logo"]);
										$this->error($b->getMsg(), 3, 'add');
					}
			}
			//修改品牌页
			function mod(){
				$b=D('brand');
				$data=$b->where(array('id'=>$_GET['id']))->find();
				$this->assign('data',$data);
				$this->display();
			}
			private function upload(){
					//new一个文件上传对象
					$up=new Fileupload;
					if($up->upload('logo')){
							return $up->getFileName();
					}else{
							$this->error($up->getErrorMsg(),3,'add');
					}
			}
			//执行修改
			function update(){
					$b=D('brand');
					if($_FILES['logo']['error']==0){
							$path=PROJECT_PATH."/public/uploads/".$_POST['srcimg'];
							if(file_exists($path)){
									unlink($path);
							}
							$_POST['logo']=$this->upload();
					}
					if($b->update()){
							$this->success('修改成功',1,'index');
					}else{
							$this->error($b->getErrorMsg(),3,'brand/mod/id/'.$_POST['id']);
					}
			}
			//删除品牌
			function delete(){
					$b=D('brand');
					if($d->delete($_GET['id'])){
							$this->redirect("index");
					}else{
							$this->error('删除失败',3,'index');
					}
			}
	}