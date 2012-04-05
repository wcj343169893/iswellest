<?php


//@Description 易宝支付产品通用支付接口 


function yeepay_bank($order,$frpid = '1000000-NET',$last = 0)
{

include 'merchantProperties.php';
#	商家设置用户购买商品的支付信息.

# 支付请求，固定值"Buy" .	
$p0_Cmd = "Buy";

#商户编号 
$p1_MerId = ID;


#	商户订单号,选填.
##若不为""，提交的订单号必须在自身账户交易中唯一;为""时，易宝支付会自动生成随机的商户订单号.
$p2_Order					='';

#	支付金额,必填.
##单位:元，精确到分.
$p3_Amt						= 0.01;

#	交易币种,固定值"CNY".
$p4_Cur						= "CNY";

#	商品名称
##用于支付时显示在易宝支付网关左侧的订单产品信息.
$p5_Pid						= '123';

#	商品种类
$p6_Pcat					= '123';

#	商品描述
$p7_Pdesc					= '123';

#	商户接收支付成功数据的地址,支付成功后易宝支付会向该地址发送两次成功通知.
$p8_Url						= BACKURL;

#	商户扩展信息
##商户可以任意填写1K 的字符串,支付成功时将原样返回.												
$pa_MP						= '123';

#	支付通道编码
##默认为""，到易宝支付网关.若不需显示易宝支付的页面，直接跳转到各银行、神州行支付、骏网一卡通等支付页面，该字段可依照附录:银行列表设置参数值.
/*
1000000-NET 易宝会员支付   
ICBC-NET-B2C  工商银行  
CMBCHINA-NET-B2C  招商银行
ABC-NET-B2C  中国农业银行  
CCB-NET-B2C  建设银行  
BCCB-NET-B2C  北京银行  
BOCO-NET-B2C  交通银行  
CIB-NET-B2C  兴业银行  
NJCB-NET-B2C  南京银行  
CMBC-NET-B2C  中国民生银行  
CEB-NET-B2C  光大银行  
BOC-NET-B2C  中国银行  
PINGANBANK-NET  平安银行  
CBHB-NET-B2C  渤海银行  
HKBEA-NET-B2C  东亚银行  
NBCB-NET-B2C  宁波银行  
ECITIC-NET-B2C  中信银行(需要证书才能连接到银行)  
SDB-NET-B2C  深圳发展银行  
GDB-NET-B2C  广东发展银行  
SHB-NET-B2C  上海银行  
SPDB-NET-B2C  上海浦东发展银行  
POST-NET-B2C  中国邮政  
BJRCB-NET-B2C  北京农村商业银行  
HXB-NET-B2C 华夏银行（此功能默认不开通，如需开通请与易宝支付销售人员联系）  
CZ-NET-B2C  浙商银行  
*/

$pd_FrpId					= $frpid;

switch($frpid)
{
    case '1000000-NET':     //易宝支付
    $img_url = 'themes/default/images/bank/YEEPAY.gif';
    break;
    case 'ICBC-NET-B2C':     //工商银行
    $img_url = 'themes/default/images/bank/ICBC.gif';
    break;                 
    case 'CMBCHINA-NET-B2C': //招商银行 
    $img_url = 'themes/default/images/bank/CMBCHINA.gif';
    break;
    case 'ABC-NET-B2C':      //中国农业银行
    $img_url = 'themes/default/images/bank/ABC.gif';
    break;
    case 'CCB-NET-B2C':      //建设银行
    $img_url = 'themes/default/images/bank/CCB.gif';
    break;
    case 'BCCB-NET-B2C':      //北京银行
    $img_url = 'themes/default/images/bank/BCCB.gif';
    break;
    case 'BOCO-NET-B2C':      //交通银行      
    $img_url = 'themes/default/images/bank/BOCO.gif';
    break;
    case 'CIB-NET-B2C':      //兴业银行
    $img_url = 'themes/default/images/bank/CIB.gif';
    break;
    case 'NJCB-NET-B2C':      //南京银行
    $img_url = 'themes/default/images/bank/NJCB.gif';
    break;
    case 'CMBC-NET-B2C':      //中国民生银行  
    $img_url = 'themes/default/images/bank/CMBC.gif';
    break;
    case 'CEB-NET-B2C':      //光大银行
    $img_url = 'themes/default/images/bank/CEB.gif';
    break;
    case 'BOC-NET-B2C':      //中国银行
    $img_url = 'themes/default/images/bank/BOC.gif';
    break;
    case 'PINGANBANK-NET':      //平安银行
    $img_url = 'themes/default/images/bank/PINGANBANK.gif';
    break;
    case 'CBHB-NET-B2C':      //渤海银行
    $img_url = 'themes/default/images/bank/CBHB.gif';
    break;
    case 'HKBEA-NET-B2C':      //东亚银行
    $img_url = 'themes/default/images/bank/HKBEA.gif';
    break;
    case 'NBCB-NET-B2C':      //宁波银行
    $img_url = 'themes/default/images/bank/NBCB.gif';
    break;
    case 'ECITIC-NET-B2C':      //中信银行(需要证书才能连接到银行)
    $img_url = 'themes/default/images/bank/ECITIC.gif';
    break;
    case 'SDB-NET-B2C':      //深圳发展银行
    $img_url = 'themes/default/images/bank/SDB.gif';
    break;
    case 'GDB-NET-B2C':      //广东发展银行 
    $img_url = 'themes/default/images/bank/GDB.gif';
    break;
    case 'SHB-NET-B2C':      //上海银行
    $img_url = 'themes/default/images/bank/SHB.gif';
    break;
    case 'SPDB-NET-B2C':      //上海浦东发展银行
    $img_url = 'themes/default/images/bank/SPDB.gif';
    break;
    case 'POST-NET-B2C':      //中国邮政
    $img_url = 'themes/default/images/bank/POST.gif';
    break;
    case 'BJRCB-NET-B2C':      //北京农村商业银行
    $img_url = 'themes/default/images/bank/BJRCB.gif';
    break;
    case 'CZ-NET-B2C':      //浙商银行
    $img_url = 'themes/default/images/bank/CZ.gif';
    break;
}

#	送货地址
# 为"1": 需要用户将送货地址留在易宝支付系统;为"0": 不需要，默认为 "0".
$p9_SAF = "0";


#	应答机制
##默认为"1": 需要应答机制;
$pr_NeedResponse	= "1";

#调用签名函数生成签名串
$url = $p0_Cmd . $p1_MerId . $p2_Order . $p3_Amt . $p4_Cur . $p5_Pid . $p6_Pcat . $p7_Pdesc . $p8_Url . $p9_SAF . $pa_MP . $pd_FrpId ;
$hmac = hmac($url,KEYS);


$html_yeepay  = '';
if($last == 2){
   $html_yeepay .= "<div class='blank10'></div>";
   $html_yeepay .= "<p class='fb'>请选择以下支付平台支付：</p>";
}
$html_yeepay .= "<form name='yeepay' target='_blank' action='" . URL . "' method='post'>";
$html_yeepay .= "<input type='hidden' name='p0_Cmd' value='" . $p0_Cmd . "'>";
$html_yeepay .= "<input type='hidden' name='p1_MerId' value='" . $p1_MerId . "'>";
$html_yeepay .= "<input type='hidden' name='p2_Order' value='" . $p2_Order . "'>";
$html_yeepay .= "<input type='hidden' name='p3_Amt' value='" . $p3_Amt . "'>";
$html_yeepay .= "<input type='hidden' name='p4_Cur' value='" . $p4_Cur . "'>";
$html_yeepay .= "<input type='hidden' name='p5_Pid' value='" . $p5_Pid . "'>";
$html_yeepay .= "<input type='hidden' name='p6_Pcat' value='" . $p6_Pcat . "'>";
$html_yeepay .= "<input type='hidden' name='p7_Pdesc' value='" . $p7_Pdesc . "'>";
$html_yeepay .= "<input type='hidden' name='p8_Url' value='" . $p8_Url . "'>";
$html_yeepay .= "<input type='hidden' name='p9_SAF' value='" . $p9_SAF . "'>";
$html_yeepay .= "<input type='hidden' name='pa_MP' value='" . $pa_MP . "'>";
$html_yeepay .= "<input type='hidden' name='pd_FrpId' value='" . $pd_FrpId . "'>";
$html_yeepay .= "<input type='hidden' name='hmac' value='" . $hmac . "'>";
$html_yeepay .= "<input type='submit' class='fl' style='background:url(" . $img_url . ");width:154px; height:33px;margin:4px 13px; border:0;cursor:pointer;' value=''/>";
$html_yeepay .= "</form>";
$last == 1 || $last == 3 ? $html_yeepay .="<div class='clear'></div>" :"";
return $html_yeepay;

}



function hmac($data, $key)
{
    // RFC 2104 HMAC implementation for php.
    // Creates an md5 HMAC.
    // Eliminates the need to install mhash to compute a HMAC
    // Hacked by Lance Rushing(NOTE: Hacked means written)

    $key  = iconv('GB2312', 'UTF8', $key);
    $data = iconv('GB2312', 'UTF8', $data);

    $b = 64; // byte length for md5
    if (strlen($key) > $b)
    {
        $key = pack('H*', md5($key));
    }

    $key    = str_pad($key, $b, chr(0x00));
    $ipad   = str_pad('', $b, chr(0x36));
    $opad   = str_pad('', $b, chr(0x5c));
    $k_ipad = $key ^ $ipad ;
    $k_opad = $key ^ $opad;

    return md5($k_opad . pack('H*', md5($k_ipad . $data)));

}
?> 