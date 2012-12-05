<?
include_once $_SEVER['DOCUMENT_ROOT'].'../vendors/common_funcs.php';
/**
//session_start();
//生成验证码图片
Header("Content-type: image/PNG");
$im = imagecreate(44,18);
$back = ImageColorAllocate($im, 245,245,245);
imagefill($im,0,0,$back); //背景

srand((double)microtime()*1000000);
//生成4位文字
$vcodes = '';
for($i=0;$i<4;$i++){
    $font = ImageColorAllocate($im, rand(100,255),rand(0,100),rand(100,255));
    $number = rand(0,2);
    switch($number)
    {
        case 0:
            $rand_number = rand(48,57);//数字 
            break;
        case 1: 
            $rand_number = rand(65,90);//大写字母
            break;
        case 2: 
            $rand_number = rand(97,122);//小写字母
            break;
    }
    $str = sprintf("%c",$rand_number);
    imagestring($im, 5, 2+$i*10, 1, $str, $font);
    $vcodes .= $str;
}

for($i=0;$i<100;$i++) //加入干扰象素
{
    $randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
    imagesetpixel($im, rand()%70 , rand()%30 , $randcolor);
}
//setcookie("TestCookie", $vcodes, time()+3600);
$_SESSION['SecurityCode'] = $vcodes;
ImagePNG($im);
ImageDestroy($im);

//setcookie('Member.regist.security_code', $vcodes);
//setcookie("TestCookie", 'xxxxxxxxxxx', time()+3600);
writeLog($vcodes);
writeLog($_SESSION);
//echo 'xxxxxxxxxxxx';
*/

//setcookie("TestCookie", $value, time()+3600, "/~rasmus/", ".example.com", 1);
//echo $_COOKIE["TestCookie"];
//echo $HTTP_COOKIE_VARS["TestCookie"];
?>
<img src="data:image/jpeg;base64,<?php $im = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT'].'/image/admin/logo.jpg');
imagejpeg($im);
?>" />