<?php
	class CatModel extends Dpdo {
		function list1(){
			$data=$this->field('id,c_name,concat(c_path,"-",id) abspath')->order("abspath,id asc")->select();
			$html='<ul>';
			foreach($data as $val){
				$html.='<li>';
				$num=count(explode("-", $val["abspath"]))-2;
				$space=str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$num);	
				$name=$val["c_name"];
				$html.=$space."".'<a href="">'.$name.'</a>';
				$html.='</li>';	
			}
			$html.='</ul>';

			return $html;
		}

		function select1($name="cid", $value="0"){
			$data=$this->field('id,c_name,concat(c_path,"-",id) abspath')->order("abspath,id asc")->select();
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
