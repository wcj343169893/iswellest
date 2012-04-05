<?php
		class foot {
					function foot(){
							$l=D('link');
							$data=$l->select();
							p($data);
							$this->assign('data',$data);
							$this->display('');
					}
		}
