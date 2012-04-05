<?php
		class OrderModel extends Dpdo {
				function randcode(){
						$code = date("Y-m-dH-i-s");
						$code ='XY_'.str_replace("-","",$code);
						$code .= rand(1000,2000);
						return $code;
				}
		}
?>