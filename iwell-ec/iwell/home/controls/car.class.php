<?php
		class car {	
				function mycar(){
						$w=D('ware');
						$data=$w->filed('id,w_name,w_price,w_pic')->limit(5)->select();
						$this->assign('data',$data);
						$this->display();
				}
		}