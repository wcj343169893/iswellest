<?php
class car {
	function mycar() {
		// $w=D('ware');
		// $data=$w->filed('id,w_name,w_price,w_pic')->limit(5)->select();
		// $this->assign('data',$data);
		$goods = D ( "goods" );
		$data = $goods->filed ( 'goods_id,goods_name,goods_sn,goods_number,market_price,shop_price,goods_thumb' )->limit ( 5 )->select ();
		$this->assign ( 'data', $data );
		$this->display ();
	}
}