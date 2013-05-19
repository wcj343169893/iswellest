<?php include('home_header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li><?php echo anchor('home','Home')?> <span class="divider">/</span></li>
					<li></li>
				</ul>
			</div>
			<div class="row-fluid">
					<div class="box-content">
						<table width="100%" border="0">
							<tr>
							  <td align="center" valign="middle">
							 <iframe width="150" scrolling="No" height="20" frameborder="0" vspace="0" hspace="0" marginheight="0" marginwidth="0" allowtransparency="true" src="http://m.weather.com.cn/m/pn6/weather.htm "></iframe>
							  </td>
							</tr>
							<tr>
							  <td align="center" valign="middle"><h4><?php $this->load->helper('date');$datestring = "%Y年%m月 %d日 %h:%i %a";$time = time();
						echo mdate($datestring, $time);?>
						</h4></td>
							</tr>
							<tr>
							  <td align="center" valign="middle"><h4>亲爱的用户 <span class="STYLE1"><?php echo $name ?></span>&nbsp;&nbsp;[IP:<?php echo $_SERVER['REMOTE_ADDR']
						;?>]&nbsp;你好~!</h4></td>
							</tr>
							<tr>
							  <td align="center" valign="middle"></td>
							</tr>
						</table>
						<table width="100%" border="0">
						  <tr align="center">
						    <td>
							<div style="text-align:center; color:#666666; font-size:12px;">
							内存消耗:<?php echo $this->benchmark->memory_usage();?><br />
							页面执行时间:<?php echo $this->benchmark->elapsed_time();?>秒<br /><br />
							<?php echo $_SERVER['HTTP_USER_AGENT']?>
							</div>
							</td>
						  </tr>
						</table>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
<?php include('home_footer.php'); ?>