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
		$nowDate = date ( "y-m-d H:i:s" );
		// $startdate = strtotime ( $begin );
		$startdate = $begin;
		$enddate = local_strtotime ( $nowDate );
		// strtotime($time)
		$count = $startdate - $enddate;
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
/**
 * 构造url
 */
function getURL($type, $id) {
	include 'url.php';
	$app = "index.php";
	$results = "";
	$suffix = ".html";
	$url_arr = $urls [$type];
	if ($GLOBALS ["shop_config"] ["rewrite"] > 0) {
		$url = $url_arr ["short"];
	} else {
		$url = $url_arr ["longger"];
	}
// 	return $url;
	$results = str_replace ( "{1}", $id, $url );
	$results = str_replace ( "{2}", $suffix, $results );
	$results = str_replace ( "{3}", $app, $results );
	
	// // 判断是否使用url重定向
	// if ($GLOBALS ["shop_config"] ["rewrite"] > 0) {
	// switch ($type) {
	// case 1 : // 产品 源地址：index.php/index/ware/id/$id
	// $results = "goods-" . $id . $suffix;
	// break;
	// case 2 : // 结账
	// $results = "order/orderinfo" . $suffix;
	// break;
	// case 3 : // 分类列表
	// $results = "category/list-" . $id . $suffix;
	// break;
	// }
	// } else {
	// switch ($type) {
	// case 1 : // 产品
	// $results = $app . "/index/ware/id/" . $id;
	// break;
	// case 2 : //
	// $results = $app . "/order/orderinfo";
	// break;
	// case 3 :
	// $results = $app . "/search/cat/cid/" . $id;
	// break;
	// }
	// }
	return $results;
}
?>