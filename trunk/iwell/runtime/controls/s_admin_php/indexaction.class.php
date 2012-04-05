<?php
	class IndexAction extends Common {
				function main(){
					$this->display();
				}
				function top(){
					$GLOBALS["debug"]=0;
					$this->display();
				}
				function center(){
					$GLOBALS["debug"]=0;
					$this->display();
				}
				function right(){
					$GLOBALS["debug"]=0;
					$this->display();
				}
				function left(){
					$GLOBALS["debug"]=0;
					$this->display();
				}
				function info(){
						$GLOBALS["debug"]=0;
						$this->display();
						
				}
	}