<?php
	class IndexAction extends Common {
		function index(){
					$s=D('ware');
					//特价商品
					$data=$s->limit(6)->where(array('w_type'=>'tj'))->select();
					$this->assign('data',$data);
					//手机配件
					$pj=$s->limit(6)->where(array('w_type'=>'pj'))->select();
					$this->assign('pj',$pj);
					//右侧广告栏的信息
					$r=$s->limit(6)->where(array('w_type'=>'r'))->select();
					$this->assign('r',$r);
					$this->display();
		}		
		//商品单品类
		function ware(){
				$s=D('ware');
				$data=$s->where(array('id'=>$_GET['id']))->find();
				$this->assign('data',$data);
				$this->display();
		}
		
		//商场快报
		function content(){
				$c=D('content');
				$data=$c->limit(3)->select();
				$this->assign('data',$data);
				$this->display("index");
		}

	}