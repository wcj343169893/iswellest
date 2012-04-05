<?php
	class linkAction extends Common {
		//添加链接
		function addlink(){
			$this->display();
		}
		
		function insert(){
			$c=D('link');
			if($c->insert()){
				$this->success('添加成功！','2','index');
			}else {
				$this->error('恭喜您失败了','2','addlink');
			}
		}
		//链接列表
		function listlink(){
			$c=D('link');
			$data=$c->select();
			$this->assign('data',$data);
			$this->display();
		}
		
		//链接删除
		function delete(){
			$c=D('link');
			$row=$c->delete($_GET['id']);			
			if($row){
				$this->redirect('listlink');
			}else{
				$this->error($c->getMsg(),3,'listlink');
			}
		}
		
		//链接修改
		function listmod(){
			$c=D('link');
			$data=$c->find($_GET['id']);
			$this->assign('data',$data);
			$this->display();
		}
		function update(){
			$c=D('link');
			$row=$c->update($_POST);
			if($row){
				$this->success('修改成功',2,'listlink');
			}else{
				$this->error($c->getMsg(),2,'listlink');
			}
		}
	}