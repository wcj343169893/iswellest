<?php
	class Cat {
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
			$sql = "SELECT *,concat(`c_path`,'-',`id`) AS path_desc FROM pro_cat ORDER BY path_desc,id ";
			return $html;
		}

		function select1($name="cid", $value="0",$get){
				$w=D('ware');
					//如果用find的话  生成的是一位数组，用select 生成的则是二维数组，切记
//				$data1=$w->where(array('id'=>$get['id']))->find();
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
		function select2($name="pid", $value="0"){
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
