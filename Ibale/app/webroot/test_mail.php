<?php //echo mail('shilei@natec.cn', 'My Subject', 'test....');exit();?>
<?php echo mail('bftk.sl@gmail.com', 'My Subject', 'test....');exit();?>

<?
class stmp{
    private $mailcfg=array();
    private $error_msg='';

    function __construct($mailcfg){
        $this->mailcfg=$mailcfg;
    }

    public function send($mail){
        $mailcfg=$this->mailcfg;
        if(!$fp = fsockopen($mailcfg['server'], $mailcfg['port'], $errno, $errstr, 30)) {
            return $this->error("($mailcfg[server]:$mailcfg[port]) CONNECT - Unable to connect to the SMTP server, please check your \"mail_config.php\".");
        }
        stream_set_blocking($fp, true);
        $lastmessage = fgets($fp, 512);
        if(substr($lastmessage, 0, 3) != '220') {
            return $this->error("$mailcfg[server]:$mailcfg[port] CONNECT - $lastmessage");
        }
        fputs($fp, ($mailcfg['auth'] ? 'EHLO' : 'HELO')." ".$mailcfg['auth_username']."\r\n");
        $lastmessage = fgets($fp, 512);
        if(substr($lastmessage, 0, 3) != 220 && substr($lastmessage, 0, 3) != 250) {
            return $this->error("($mailcfg[server]:$mailcfg[port]) HELO/EHLO - $lastmessage");
        }
        while(1) {
            if(substr($lastmessage, 3, 1) != '-' || empty($lastmessage)) {
                break;
            }
            $lastmessage = fgets($fp, 512);
        }
        if($mailcfg['auth']) {
            fputs($fp, "AUTH LOGIN\r\n");
            $lastmessage = fgets($fp, 512);
            if(substr($lastmessage, 0, 3) != 334) {
                return $this->error("($mailcfg[server]:$mailcfg[port]) AUTH LOGIN - $lastmessage");
            }
            fputs($fp, base64_encode($mailcfg['auth_username'])."\r\n");
            $lastmessage = fgets($fp, 512);
            if(substr($lastmessage, 0, 3) != 334) {
                return $this->error("($mailcfg[server]:$mailcfg[port]) USERNAME - $lastmessage");
            }

            fputs($fp, base64_encode($mailcfg['auth_password'])."\r\n");
            $lastmessage = fgets($fp, 512);
            if(substr($lastmessage, 0, 3) != 235) {
                return $this->error("($mailcfg[server]:$mailcfg[port]) PASSWORD - $lastmessage");
            }

            $email_from = $mailcfg['from'];
        }
        fputs($fp, "MAIL FROM: <".preg_replace("/.*\<(.+?)\>.*/", "\\1", $email_from).">\r\n");
        $lastmessage = fgets($fp, 512);
        if(substr($lastmessage, 0, 3) != 250) {
            fputs($fp, "MAIL FROM: <".preg_replace("/.*\<(.+?)\>.*/", "\\1", $email_from).">\r\n");
            $lastmessage = fgets($fp, 512);
            if(substr($lastmessage, 0, 3) != 250) {
                return $this->error("($mailcfg[server]:$mailcfg[port]) MAIL FROM - $lastmessage");
            }
        }

        $email_to=$mail['to'];
        foreach(explode(',', $email_to) as $touser) {
            $touser = trim($touser);
            if($touser) {
                fputs($fp, "RCPT TO: <$touser>\r\n");
                $lastmessage = fgets($fp, 512);
                if(substr($lastmessage, 0, 3) != 250) {
                    fputs($fp, "RCPT TO: <$touser>\r\n");
                    $lastmessage = fgets($fp, 512);
                    return $this->error("($mailcfg[server]:$mailcfg[port]) RCPT TO - $lastmessage");
                }
            }
        }
        fputs($fp, "DATA\r\n");
        $lastmessage = fgets($fp, 512);
        if(substr($lastmessage, 0, 3) != 354) {
            return $this->error("($mailcfg[server]:$mailcfg[port]) DATA - $lastmessage");
        }
        $str = '';
        $str  = 'MIME-Version: 1.0' . "\r\n";
        $str .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $str .= "To: $email_to\r\nFrom: $email_from\r\nSubject: ".$mail['subject']."\r\n\r\n".$mail['content']."\r\n\r\n.\r\n";
        fputs($fp, $str);
        fputs($fp, "QUIT\r\n");
        return true;
    }

    public function get_error(){
        return $this->error_msg;
    }

    private function error($msg){
        $this->error_msg.=$msg;
        return false;
    }

}
?>
<?
$mailcfg['server'] = 'mail002.bohan-it.com';
$mailcfg['server'] = 'mail.163.com';
$mailcfg['port'] = '25';
$mailcfg['from'] = 'shilei@natec.cn';
$mailcfg['from'] = 'bftk.sl@163.com';
$mailcfg['auth_username'] = 'shilei';
$mailcfg['auth_username'] = 'bftk.sl';
$mailcfg['auth_password'] = '123natec';
$mailcfg['auth_password'] = 'sk7845';


$stmp=new stmp($mailcfg);

$_POST['title'] = "我们是还从";
$_POST['content'] = '     <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
     <html xmlns="http://www.w3.org/1999/xhtml">
     <head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <title>芭乐网</title>
     <link type="text/css" rel="stylesheet" href="http://kenko.local/css/email/style.css">
     </head>
     <body>
         <div id="wrapper">
             <!-- header -->
             <div class="header">
                 <div class="logo">
                     <a href="http://kenko.local"><img src="http://kenko.local/image/front/logo.jpg" /> </a>
                 </div>
             </div>
             <!-- header end -->
     <!-- main -->
     <div class="main">    <p class="f_14_b">
             亲爱的 <em>bftk</em>：
         </p>
         <p class="f_14">
             您的账号密码取回请求已收到，请点击下面的链接重置您的密码：（链接三日内访问有效）<br>
             <a href="https://kenko.local/member/password_reset/case:100097/hashCode:bc9f18fc933a0cfbecc153d50505dd95/expired:MTMzNDkwNTA0MQ">https://kenko.local/member/password_reset/case:100097/hashCode:bc9f18fc933a0cfbecc153d50505dd95/expired:MTMzNDkwNTA0MQ</a><br>
             如果以上链接无法点击，请将它复制到你的浏览器（如IE）地址栏中进入访问。<br>
             这是一封自动产生的email，请勿回复。<br>
         </p>    <p>芭乐商城秉承"诚信、顾客、执行、创新"的经验理念，为千家万户提供最优质的健康产品服务。我们与500多家国内优秀的医药健康产品厂商合作， 向消费者提供药品、保健品、理疗器械、成人产品、中药饮片、美容护理等上千种医药健康产品。</p>
     </div>
     <!-- main end -->
     <div class="copyRight">
         <div class="content">
             <p>
                 <a href="http://kenko.local/article/detail/title:5YWz5LqO5oiR5Lus">关于我们</a> │ 
                 <a href="http://kenko.local/article/detail/title:6IGU57O75oiR5Lus">联系我们</a> │ 
                 <a href="http://kenko.local/article/detail/title:5Yqg5YWl5oiR5Lus">加入我们</a> │ 
                 <a href="http://kenko.local/article/detail/title:5oSP6KeB5Y-N6aaI">意见反馈</a> │ 
                 <a href="http://kenko.local/article/detail/title:5bi46KeB6Zeu6aKY">常见问题</a>
             </p>
             <p>Copyright © 2006-2010 中华人民共和国增值电信业务经营许可证：浙B2-20080xxx</p>
             <!-- 
             <span class="iLogo"><a href="http://www.pingpinganan.gov.cn/web/index.aspx"></a></span> 
             <span class="iLogo2"><a href="http://www.pingpinganan.gov.cn/web/index.aspx"></a></span>
             -->
         </div>
     </div>
     </div>
     </body>
     </html>


';

$mail=array('to'=>'shilei@natec.cn','subject'=>$_POST['title'],'content'=>$_POST['content']);
if(!$stmp->send($mail)){
    echo $stmp->get_error();
}else{
    echo 'mail succ!';
}
?>
