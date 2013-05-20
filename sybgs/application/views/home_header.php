<!DOCTYPE html>
<html lang="en">
<head>
<base href="<?php echo base_url() ;?>"/>
	<!--
		Charisma v1.0.0

		Copyright 2012 Muhammad Usman
		Licensed under the Apache License v2.0
		http://www.apache.org/licenses/LICENSE-2.0

		http://usman.it
		http://twitter.com/halalit_usman
	-->
	<meta charset="utf-8">
	<title>实验报告书提交网站</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
	<meta name="author" content="Muhammad Usman">
	<!-- jQuery -->
	<script src="theme/js/jquery-1.7.2.min.js"></script>
	<!-- The styles -->
	<link id="bs-css" href="theme/css/bootstrap-cerulean.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="theme/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="theme/css/charisma-app.css" rel="stylesheet">
	<link href="theme/css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='theme/css/fullcalendar.css' rel='stylesheet'>
	<link href='theme/css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='theme/css/chosen.css' rel='stylesheet'>
	<link href='theme/css/uniform.default.css' rel='stylesheet'>
	<link href='theme/css/colorbox.css' rel='stylesheet'>
	<link href='theme/css/jquery.cleditor.css' rel='stylesheet'>
	<link href='theme/css/jquery.noty.css' rel='stylesheet'>
	<link href='theme/css/noty_theme_default.css' rel='stylesheet'>
	<link href='theme/css/elfinder.min.css' rel='stylesheet'>
	<link href='theme/css/elfinder.theme.css' rel='stylesheet'>
	<link href='theme/css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='theme/css/opa-icons.css' rel='stylesheet'>
	<link href='theme/css/uploadify.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
		
</head>
<?php $role_name=empty($role)?"老师":"学生";?>
<body>
	<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
	<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.html"> <img alt="Charisma Logo" src="theme/img/logo20.png" /> <span>Charisma</span></a>
				
				<!-- theme selector starts -->
				<div class="btn-group pull-right theme-container" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-tint"></i><span class="hidden-phone"> Change Theme / Skin</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" id="themes">
						<li><a data-value="classic" href="#"><i class="icon-blank"></i> Classic</a></li>
						<li><a data-value="cerulean" href="#"><i class="icon-blank"></i> Cerulean</a></li>
						<li><a data-value="cyborg" href="#"><i class="icon-blank"></i> Cyborg</a></li>
						<li><a data-value="redy" href="#"><i class="icon-blank"></i> Redy</a></li>
						<li><a data-value="journal" href="#"><i class="icon-blank"></i> Journal</a></li>
						<li><a data-value="simplex" href="#"><i class="icon-blank"></i> Simplex</a></li>
						<li><a data-value="slate" href="#"><i class="icon-blank"></i> Slate</a></li>
						<li><a data-value="spacelab" href="#"><i class="icon-blank"></i> Spacelab</a></li>
						<li><a data-value="united" href="#"><i class="icon-blank"></i> United</a></li>
					</ul>
				</div>
				<!-- theme selector ends -->
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> <?php echo $user_name;?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#">设置</a></li>
						<li class="divider"></li>
						<li><?php echo anchor('home/logout','退出')?></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<div class="top-nav nav-collapse">
					<ul class="nav">
						<li><a href="#">Visit Site</a></li>
						<li>
							<form class="navbar-search pull-left">
								<input placeholder="Search" class="search-query span2" name="query" type="text">
							</form>
						</li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<!-- topbar ends -->
	<?php } ?>
	<div class="container-fluid">
		<div class="row-fluid">
		<?php if(!isset($no_visible_elements) || !$no_visible_elements) { ?>
		
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">欢迎使用</li>
						<li class="nav-header hidden-tablet"><i class="icon-user"></i> 用户中心</li>
						<li><?php echo anchor('home/me','<i class="icon-arrow-right"></i><span class="hidden-tablet"> 我的资料 </span>')?></li>
						<?php if($uid == 'admin'):?>
						<li><?php echo anchor('home/userslist','<i class="icon-arrow-right"></i><span class="hidden-tablet"> 老师列表 </span>')?></li>
						<li><?php echo anchor('home/userslist/1','<i class="icon-arrow-right"></i><span class="hidden-tablet"> 学生列表 </span>')?></li>
						<?php endif;?>
						
						<?php if($uid != 'admin'){?>
						<li class="nav-header hidden-tablet"><i class="icon-check"></i> 实验报告书</li>
						<?php if($role){?>
						<li><?php echo anchor('home/addWorks','<i class="icon-edit"></i><span class="hidden-tablet"> 添加实验报告书 </span>')?></li>
						<li><?php echo anchor('home/workslist','<i class="icon-th-list"></i><span class="hidden-tablet"> 我的报告书列表 </span>')?></li>
						<?php }else{?>
						<?php if($qx1){?>
						<li><?php echo anchor('home/gradelist/1','<i class="icon-th-list"></i><span class="hidden-tablet"> 科技理念类 </span>')?></li>
						<li><?php echo anchor('home/scoreofmine/1','<i class="icon-hand-right"></i><span class="hidden-tablet"> 科技理念类统计结果</span>')?></li>
						<?php }?>
						<?php if($qx2){?>
						<li><?php echo anchor('home/gradelist/2','<i class="icon-th-list"></i><span class="hidden-tablet"> 科技实物类</span>')?></li>
						<li><?php echo anchor('home/scoreofmine/2','<i class="icon-hand-right"></i><span class="hidden-tablet"> 科技实物类统计结果</span>')?></li>
						<?php }}?>
						<?php }?>
						
						<?php if($uid == 'admin'):?>
						<li class="nav-header hidden-tablet"><i class="icon-book"></i> 实验报告书管理</li>
						<li><?php echo anchor('home/workslist','<i class="icon-th-list"></i><span class="hidden-tablet"> 实验报告书列表</span>')?></li>
						
						<li class="nav-header hidden-tablet"><i class="icon-align-right"></i> 评分结果统计</li>
						<li><?php echo anchor('home/scorelist','<i class="icon-hand-right"></i><span class="hidden-tablet"> 评分结果统计</span>')?></li>
						
						<li class="nav-header hidden-tablet"><i class="icon-cog"></i> 系统设置</li>
						<li><?php echo anchor('home/cleanWorks','<i class="icon-chevron-right"></i><span class="hidden-tablet"> 清空所有实验报告书</span>')?></li>
						<li><?php echo anchor('home/cleanScores','<i class="icon-chevron-right"></i><span class="hidden-tablet"> 清空所有实验报告书评分</span>')?></li>
						<?php endif;?>
						
						<li><?php echo anchor('home/logout','<i class="icon-lock"></i><span class="hidden-tablet"> 退出 </span>')?></li>
					</ul>
					<label id="for-is-ajax" class="hidden-tablet" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax</label>
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			<?php } ?>
