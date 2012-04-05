<?php
		class carAction extends Common {	
				function mycar(){
						$w=D('ware');
						$data=$w->filed('id,w_name,w_price,w_pic')->limit(6)->select();
						$this->assign('data',$data);
						$this->display();
				}
		}