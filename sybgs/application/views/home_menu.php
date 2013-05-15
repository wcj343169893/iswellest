<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<base href="<?php echo base_url() ;?>"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<link type="text/css" rel="stylesheet" href="resource/home/style.css" />
</head>

<body>
	<div class="Left">
		<div class="LeftBox">
			<div style="height:1px;overflow:hidden;margin:0px 3px;background:#DDD;"></div>
			<div style="height:1px;overflow:hidden;margin:0px 2px;border-left:1px solid #DDD;border-right:1px solid #DDD;background:#FFF;"></div>
			<div style="height:1px;overflow:hidden;margin:0px 1px;border-left:1px solid #DDD;border-right:1px solid #DDD;background:#FFF;"></div>
			
			<ul class="LeftNav">
				<li class="LeftNavLiNow"><a href="javascript:void(0);">欢迎使用</a></li>
				<li class="LeftNavLi" style="margin-left:20px;background:none;"><?php echo $name ?>  你好!!</li>
				<li class="LeftNavLi" style="margin-left:20px;background:none;"><a href="index.php/home/logout" target="_top">退出</a></li>
			</ul>

			<ul class="LeftNav">
				<li class="LeftNavLiNow"><a href="javascript:void(0);">用户中心</a></li>
				<li class="LeftNavLi" style="margin-left:20px;"><?php echo anchor('home/me','我的资料','target="mainFrame"')?></li>
				<?php if($uid == 'admin'):?>
				<li class="LeftNavLi" style="margin-left:20px;"><?php echo anchor('home/userslist','老师列表','target="mainFrame"')?></li>
				<li class="LeftNavLi" style="margin-left:20px;"><?php echo anchor('home/userslist/1','学生列表','target="mainFrame"')?></li>
				<?php endif;?>
			</ul>
			<?php if($uid != 'admin'){?>
			<ul class="LeftNav">
				<li class="LeftNavLiNow"><a href="javascript:void(0);">实验报告书评分</a></li>
				<?php if($role){?>
				<li class="LeftNavLi" style="margin-left:20px;"><?php echo anchor('home/addWorks','添加实验报告书','target="mainFrame"')?></li>	
				<li class="LeftNavLi" style="margin-left:20px;"><?php echo anchor('home/workslist','我的报告书列表','target="mainFrame"')?></li>	
				<?php }else{?>
				<?php if($qx1){?>
				<li class="LeftNavLi" style="margin-left:20px;"><?php echo anchor('home/gradelist/1','科技理念类','target="mainFrame"')?></li>
				<?php }?>
				<?php if($qx2){?>
				<li class="LeftNavLi" style="margin-left:20px;"><?php echo anchor('home/gradelist/2','科技实物类','target="mainFrame"')?></li>
				<?php }}?>
			</ul>
			<?php }?>
			<?php if($uid == 'admin'):?>
			<ul class="LeftNav">
				<li class="LeftNavLiNow"><a href="javascript:void(0);">实验报告书管理</a></li>
				<li class="LeftNavLi" style="margin-left:20px;"><?php echo anchor('home/addWorks','添加实验报告书','target="mainFrame"')?></li>
				<li class="LeftNavLi" style="margin-left:20px;"><?php echo anchor('home/workslist','实验报告书列表','target="mainFrame"')?></li>
			</ul>
			<ul class="LeftNav">
				<li class="LeftNavLiNow"><a href="javascript:void(0);">评分结果统计</a></li>
				<li class="LeftNavLi" style="margin-left:20px;"><?php echo anchor('home/scorelist','评分结果统计','target="mainFrame"')?></li>
				<!--<li class="LeftNavLi" style="margin-left:20px;"><?php echo anchor('home/scoreofmine/1','科技理念类统计结果','target="mainFrame"')?></li>
				<li class="LeftNavLi" style="margin-left:20px;"><?php echo anchor('home/scoreofmine/2','科技实物类统计结果','target="mainFrame"')?></li>-->
			</ul>
			
			<ul class="LeftNav">
				<li class="LeftNavLiNow"><a href="javascript:void(0);">系统设置</a></li>
				<li class="LeftNavLi" style="margin-left:20px;"><?php echo anchor('home/cleanWorks','清空所有实验报告书','target="mainFrame"')?></li>
				<li class="LeftNavLi" style="margin-left:20px;"><?php echo anchor('home/cleanScores','清空所有实验报告书评分','target="mainFrame"')?></li>
			</ul>
			<?php endif;?>
			<div style="height:1px;overflow:hidden;margin:0px 1px;border-left:1px solid #DDD;border-right:1px solid #DDD;background:#FFF;"></div>
			<div style="height:1px;overflow:hidden;margin:0px 2px;border-left:1px solid #DDD;border-right:1px solid #DDD;background:#FFF;"></div>
			<div style="height:1px;overflow:hidden;margin:0px 3px;background:#DDD;"></div>

		</div>
	</div>
</body>
</html>
