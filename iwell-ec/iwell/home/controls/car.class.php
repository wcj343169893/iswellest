<?php
class car {
	function mycar() {
		// $w=D('ware');
		// $data=$w->filed('id,w_name,w_price,w_pic')->limit(5)->select();
		// $this->assign('data',$data);
		$goods = D ( "goods" );
		$d=strtotime("0 day");
		$data = $goods->filed ( 'goods_id,goods_name,goods_sn,goods_number,market_price,shop_price,goods_thumb' )->where(array ('sale_end_time > ' => $d ,'is_hot'=>1))->limit ( 5 )->select ();
		$this->assign ( 'data', $data );
		$this->assign("step","1");
		$this->display ();
	}
}