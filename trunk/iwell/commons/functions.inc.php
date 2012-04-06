<?php
// 全局可以使用的通用函数声明在这个文件中.
function ip() {
	return $_SERVER [REMOTE_ADDR];
}
function dsubstr($str, $length = null) {
	return substr ( $str, 0, $length );
}
/**
 * 时间比较(精确到分钟数)
 * 格式：yyyy-MM-dd HH:mm
 * $begin 开始时间
 * $end 结束时间
 */
function compareDate($begin) {
	if (! empty ( $begin )) {
		// if (!isset ( $end )) {$end=date("Y-M-d H:m"); }
		// echo $end."<br/>";
		// list ( $b_y, $b_mm, $b_d, $b_h, $b_m ) = split ( $patten, $begin );
		// echo "b_y:".$b_y. " b_mm:".$b_mm. " b_d:".$b_d. " b_h:".$b_h. "
		// b_m:".$b_m."<br/>";
		// list ( $e_y, $e_mm, $e_d, $e_h, $e_m ) = split ( $patten, $end );
		// $startdate = mktime ( $b_h, $b_m, "0", $b_mm, $b_d, $b_y );
		// $enddate = mktime ( $e_h, $e_m, "0", $e_mm, $e_d, $e_y );
		// echo "startdate:".$startdate."strtotime:".strtotime($begin);
		// echo " 1:".$startdate." 2:".$enddate."3<br/>";
		// echo $enddate - $startdate;
		$nowDate=date ( "Y-m-d H:i" );
		$startdate = strtotime ( $begin );
		$enddate = strtotime ($nowDate);
// 		echo $begin."=".$startdate." ".$nowDate."=".$enddate."<br/>";
// 		return $startdate>$enddate ? round ( ($startdate - $enddate) / 60 ):round ( ( $enddate -$startdate ) / 60 );
		
		return round ( ($startdate - $enddate) / 60 );
	}
	return 0;
}
?>