<?php
/**
 * {1}=>$id;
 * {2}=>$suffix
 * {3}=>$app
 * */
$urls = array (
		"1" => array (
				"short" => "goods-{1}{2}",
				"longger" => "{3}/index/ware/id/{1}" 
		),
		"2" => array (
				"short" => "order/orderinfo{2}",
				"longger" => "{3}/order/orderinfo" 
		),
		"3" => array (
				"short" => "/category/list-{1}{2}",
				"longger" => "{3}/search/cat/cid/{1}" 
		) 
);