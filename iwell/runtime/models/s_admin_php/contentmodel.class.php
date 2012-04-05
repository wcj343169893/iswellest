<?php
	class ContentModel extends Dpdo {
		function list1(){
			$data=$this->field('id,title,content,ntime')->order("id asc")->select();
			
			return $html;
		}

		function select1($name="cid", $value="0"){
			$data=$this->field('id,title,content,ntime')->order("id asc")->select();
			$html='<select name="'.$name.'">';
			$html.='<option value="0">根分类</option>';
			foreach($data as $val){
				if($value==$val["id"])
					$html.='<option selected value="'.$val['id'].'">';
				else
					$html.='<option value="'.$val['id'].'">';

				$num=count(explode("-", $val["abspath"]))-2;
				$space=str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$num);	
				$name=$val["c_name"];
				$html.=$space."|--".$name;
				$html.='</option>';	
			}
			$html.='</select>';

			return $html;
		}
	}
