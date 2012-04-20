<?php
class WareModel extends Dpdo {
	//用时间U戳的后六位做编号
	function code() {
		return substr ( time (), - 6 );
	}
	function select1($name = "w_cat", $value = "0") {
		$data = $this->field ( 'id,c_name,concat(c_path,"-",id) abspath' )->order ( "abspath,id asc" )->select ();
		$html = '<select name="' . $name . '">';
		$html .= '<option value="0">根分类</option>';
		foreach ( $data as $val ) {
			
			if ($val ['id'] == $value)
				$html .= '<option selected value="' . $val ['id'] . '">';
			else
				$html .= '<option value="' . $val ['id'] . '">';
			
			$num = count ( explode ( "-", $val ["abspath"] ) ) - 2;
			$space = str_repeat ( "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $num );
			$name = $val ["c_name"];
			$html .= $space . "|--" . $name;
			$html .= '</option>';
		}
		$html .= '</select>';
		
		return $html;
	}

}