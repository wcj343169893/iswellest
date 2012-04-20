<?php
/**
 * 时间比较(精确到分钟数)
 * 格式：yyyy-MM-dd HH:mm
 * $begin 开始时间
 * $end 结束时间
 */
function compareDate($begin) {
	if (! empty ( $begin )) {
		$nowDate = date ( "Y-m-d H:i" );
		$startdate = strtotime ( $begin );
		$enddate = strtotime ( $nowDate );
		$count = $startdate - $enddate;
		$str = "";
		$str = "离下架还有" . round ( ($count) / 60 ) . "秒";
		if ($count > 60) {
			$str = "离下架还有" . round ( ($count) / 60 ) . "分钟";
		}
		if ($count > 60 * 60) {
			$str = "离下架还有" . round ( ($count) / 60 / 60 ) . "小时";
		}
		if ($count > 60 * 60 * 24) {
			$str = "离下架还有" . round ( ($count) / 60 / 60 / 24 ) . "天";
		}
		if ($count > 60 * 60 * 24 * 365) {
			$str = "离下架还有" . round ( ($count) / 60 / 60 / 24 / 365 ) . "年";
		
		}
		return $str;
	}
	return "即将下架";
}
function ip() {
	return $_SERVER [REMOTE_ADDR];
}
function dsubstr($str, $length = null) {
	return substr ( $str, 0, $length );
}