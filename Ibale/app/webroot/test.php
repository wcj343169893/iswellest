<?php
echo date('Y-m-d H:i:s');exit();

 $str = 'This is an encoded string';
  echo base64_encode($str);
  //die();
echo base64_encode("kamome|邵1002|kamome");
echo '<br/>';
//a2Ftb21lfMnbMTAwMnxrYW1vbWU=
echo base64_decode('a2Ftb21lfMnbMTAwMnxrYW1vbWU=');
echo '<br/>';
echo base64_decode('a2Ftb21lfOmCtTEwMDJ8a2Ftb21l');
die();
//時間からINTに変換
echo date('dHis');
echo '<br/>';
echo intval(date('dHis'));
die();

//JSONから配列に変換
$json_txt ='{
 "seq": 1,
 "system": "oms",
 "sender": "oms1",
 "succeeded": true,
 "results": {
 "order_no": 1001,
 "orders": [{
 "record_num": 1, 
 "order_type": "SALE",
 "shipping_status": "NOTYET",
 "charge_status": "NOTYET",
 "ship_stop_flg": false,
 "active_flg": true,
 "customer_id": 100,
 "order_datetime": "2011/08/04 14:34:00",
 "record_update_datetime": "2011/08/04 14:34:00",
 "channel": "front",
 "shipto_zip": "000111",
 "shipto_address1": "3-11-3 Akasaka, Minatoku",
 "shipto_address2": null,
 "shipto_address3": null,
 "charge_type": "ALIPAY",
 "gift_type": "NONE",
 "order_subtotal": 1990,
 "claim_subtotal": 1890,
 "shipping_charge": 390,
 "gift_charge": 0,
 "discount_subtotal": 0,
 "discount": 0,
 "salerule_ids": "",
 "sale_discount": 0,
 "coupon_code": null,
 "coupon_discount": 0,
 "point_used": 100,
 "point_adjustment": 0, 
 "customer_comment":  "17時くらいに配達を希望します",
 "operator_comment": null,
 "customer_rank": "NORMAL",
 "priority_level": "NORMAL",
 "product_info_list": [
{ 
 "product_cd": "A100100H", "amount": 1, "bonus_flg": false, "price": 100, "point": 1, 
 "allocated_count": 1, "backorder_count": 0, "product_reservation_id": null, 
 "salerule_ids": null, "sale_discount": 0, "point_adjustment": 0, "shipping_plan_date": "2011/08/05" 
},
{ 
 "product_cd": "A100200H", "amount": 5, "bonus_flg": false, "price": 100, "point": 1,
 "allocated_count": 5, "backorder_count": 0, "product_reservation_id": null, 
 "salerule_ids": null, "sale_discount": 0, "point_adjustment": 0, "shipping_plan_date": "2011/08/05" 
},
{ 
 "product_cd": "A100300H", "amount": 10, "bonus_flg": false, "price": 100, "point": 3,
 "allocated_count": 1, "backorder_count": 9, "product_reservation_id": null, 
 "salerule_ids": null, "sale_discount": 0, "point_adjustment": 0, "shipping_plan_date": "2011/08/11" 
}
]
}]
}
}';
print_r(json_decode($json_txt));
die();

//最大INT
echo intval('20111212120000');
die();


//権限配列
$acl_str='{"admin":{"index":"1","add":"0"}}\n{"member":{"index":"1"}}';
$ret = array();
foreach(explode('\n', $acl_str) as $key => $value) {
    $ret[] = json_decode($value);
}
print_r($ret);
$_SESSION = array('Auth.User' => array('username'=>'test'));
?>
