<?php
if ($_POST ['Submit'] == '开始') {

	$total = 0; //文件总数

	$dangerous = array (); //危险文件

	$dangerous_content = $_POST ["sstr"];

	$find_path = $_POST ["searchpath"];

	$shortname = $_POST ["shortname"];

	echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";

	echo "<html>";

	echo "<head>";

	echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";

	echo "</head>";

	echo "<body>";

	$begin_time=date("U");

	//	$dangerous_content = "小亮,Root_GP,Root_CSS,c99sh_updateurl,c99sh_sourcesurl,640684770";

	visitFile ( $find_path, $shortname );

	$end_time=date("U");

	foreach ($dangerous as $d){

		echo $d."<br/>";

	}

	echo "查找文件总数:" . $total." 危险文件:".count($dangerous)." 总用时".($end_time-$begin_time)."秒";

	echo "</body>";

	echo "</html>";

	//if (! empty ( $dangerous )) {

	//foreach ( $dangerous as $dan ) {

	//echo "[error]" . $dan . "<br/>";

	//}

	//}

	exit();

}

function visitFile($path, $ext) {

	global $total;

	global $dangerous_content;

	$fdir = dir ( $path );

	//echo "Handle: " . $d->handle . "<br>";

	//	echo "Path: " . $fdir->path . "<br>";

	set_time_limit ( 24 * 60 * 60 );



	while ( ($entry = $fdir->read ()) !== false ) {

		$pathSub = $path . "\\" . $entry;

		if ($entry != '.' && $entry != '..') {

			if (is_dir ( $pathSub )) {

				visitFile ( $pathSub, $ext );

			} else {

				$exten = explode ( '.', $entry );

				$exten = array_reverse ( $exten ); //把上面数组倒序

				//			foreach ()

				$shortnames = explode ( '|', $ext );

				foreach ( $shortnames as $sn ) {

					if (! empty ( $exten ) && $sn == $exten [0]) {

						$total = $total + 1;

						//echo "开始分析文件:".$path."/".$entry . "<br>";

						$content = file_get_contents ( $path . "/" . $entry ); //这个性能较好

						$content = strtolower ( $content ); //全部转为小写

						$dangerous_content = strtolower ( $dangerous_content ); //全部转为小写

						isExists ( $dangerous_content, $path . "/" . $entry, $content );//这个方法太耗内存了，希望有高手能解决一下

					}

				}

				//sleep(1);

			}

		}

	}

	$fdir->close ();

}

function isExists($str, $filename, $content) {

	global $dangerous;

	//sleep ( 1 );

	set_time_limit ( 10 );

	$arr = explode ( ',', $str );

	$signature="特征码：";

	if (! empty ( $arr )) {

		//		$content = file_get_contents ( $filename ); //这个性能较好

		$content = strtolower ( $content ); //全部转为小写

		$error_count = 0;

		foreach ( $arr as $a ) {

			if (trim ( $a ) != "") {

				if (strpos ( $content, $a )) {

					$error_count = $error_count + 1;

					$signature.=$a." ";

				}

			}

		}

		if ($error_count > 0) {

			//			$dangerous [] = $filename;

			$dangerous [] = "[error] " . $error_count . " " .$signature." " . $filename;

			//echo "[error] " . $error_count . " " .$signature." " . $filename . "<br/>";

		}else{

			//echo "[ok] "  . $filename . "<br/>";

		}

	}

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>批量查询文件</title>

<style type="text/css">

body {

	background: #FFFFFF;

	color: #000;

	font-size: 12px;

}

 

#top {

	text-align: center;

}

 

h1,p,form {

	margin: 0;

	padding: 0;

}

 

h1 {font-size; 14px;

	

}

</style>

</head>

<body>

<div id="top">

<h1>批量查找程序</h1>

<div>本程序可以扫描指定目录的所有文件，进行<strong>内容查找</strong>。<br />

在文件数量非常多的情况下，本操作比较占用服务器资源，请确脚本超时限制时间允许更改，否则可能无法完成操作。</div>

</div>

 

 

<form action="<?=$_SERVER ['SCRIPT_NAME']?>" name="form1"

	target="stafrm" method="post">

<table width="95%" border="0" align="center" cellpadding="3"

	cellspacing="1" bgcolor="#666666">

	<tr>

		<td width="10%" bgcolor="#FFFFFF"><strong>&nbsp;起始根路径：</strong></td>

		<td width="90%" bgcolor="#FFFFFF"><input name="searchpath" type="text"

			id="searchpath" value="<?php echo dirname(__FILE__)?>" size="20" /> 点表示当前目录，末尾不要加/ </td>

	</tr>

	<tr>

		<td bgcolor="#FFFFFF"><strong>&nbsp;文件扩展名：</strong></td>

		<td bgcolor="#FFFFFF"><input name="shortname" type="text"

			id="shortname" size="20" value="htm|html|shtml|php" /> 多个请用|隔开</td>

	</tr>

	<tr id="rpct">

		<td height="64" colspan="2" bgcolor="#FFFFFF">

		<table width="100%" border="0" cellspacing="1" cellpadding="1">

			<tr bgcolor="#EDFCE2">

				<td colspan="4"><strong>内容查找选项：</strong> <input type="checkbox"

					name="isreg" value="1" />使用正则表达式</td>

			</tr>

			<tr>

				<td colspan="4">查找内容类默认使用字符串查找，也可以使用正则表达式(需勾选)。"查找为"不填写的话，就表示删除"查找内容"。

					<br />com,system,exec,eval,escapeshell,cmd,passthru,base64_decode,gzuncompress
<br />小亮,Root_GP,Root_CSS,c99sh_updateurl,c99sh_sourcesurl,640684770,hx_dealdir,while(1)
				</td>

			</tr>

			<tr>

				<td width="10%">&nbsp;查找内容：</td>

				<td width="36%" colspan="3"><textarea name="sstr" id="sstr"

					style="width: 90%; height: 45px"></textarea></td>

			</tr>

		</table>

		</td>

	</tr>

	<tr>

		<td colspan="2" height="20" align="center" bgcolor="#E2F5BC"><input

			type="submit" name="Submit" value="开始" class="inputbut" /></td>

	</tr>

</table>

</form>

<table width="95%" border="0" align="center" cellpadding="3"

	cellspacing="1" bgcolor="#666666">

	<tr bgcolor="#FFFFFF">

		<td id="mtd">

		<div id='mdv' style='width: 100%; height: 100;'><iframe name="stafrm"

			frameborder="0" id="stafrm" width="100%" height="100%"></iframe></div>

		<script type="text/javascript">

	    document.all.mdv.style.pixelHeight = screen.height - 450;

	    </script></td>

	</tr>

</table>

</body>

</html>