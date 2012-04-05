<?php /* Smarty version 2.6.18, created on 2011-07-12 09:45:47
         compiled from index/content.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>心云</title>
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/header.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/news.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/jquery.js"></script>
</head>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'public/head.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body>
<div class="w960 mt_10">
	<p class="channel_guide">当前位置：<a href="<?php echo $this->_tpl_vars['app']; ?>
">首页</a> &gt; <a href="#">商城快报</a> &gt; <span>新闻标题</span></p>
	<div class="w960 mt_10">
		<div class="news_left">
			<div class="news_left_menu">
				<h2 class="news_left_tit">最新快报</h2>
				<ul>
				<?php unset($this->_sections['ls']);
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ls']['name'] = 'ls';
$this->_sections['ls']['show'] = true;
$this->_sections['ls']['max'] = $this->_sections['ls']['loop'];
$this->_sections['ls']['step'] = 1;
$this->_sections['ls']['start'] = $this->_sections['ls']['step'] > 0 ? 0 : $this->_sections['ls']['loop']-1;
if ($this->_sections['ls']['show']) {
    $this->_sections['ls']['total'] = $this->_sections['ls']['loop'];
    if ($this->_sections['ls']['total'] == 0)
        $this->_sections['ls']['show'] = false;
} else
    $this->_sections['ls']['total'] = 0;
if ($this->_sections['ls']['show']):

            for ($this->_sections['ls']['index'] = $this->_sections['ls']['start'], $this->_sections['ls']['iteration'] = 1;
                 $this->_sections['ls']['iteration'] <= $this->_sections['ls']['total'];
                 $this->_sections['ls']['index'] += $this->_sections['ls']['step'], $this->_sections['ls']['iteration']++):
$this->_sections['ls']['rownum'] = $this->_sections['ls']['iteration'];
$this->_sections['ls']['index_prev'] = $this->_sections['ls']['index'] - $this->_sections['ls']['step'];
$this->_sections['ls']['index_next'] = $this->_sections['ls']['index'] + $this->_sections['ls']['step'];
$this->_sections['ls']['first']      = ($this->_sections['ls']['iteration'] == 1);
$this->_sections['ls']['last']       = ($this->_sections['ls']['iteration'] == $this->_sections['ls']['total']);
?>
					<li><a href="<?php echo $this->_tpl_vars['url']; ?>
/content/id/<?php echo $this->_tpl_vars['list'][$this->_sections['ls']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['list'][$this->_sections['ls']['index']]['title']; ?>
</a></li>
				<?php endfor; endif; ?>
				</ul>
			</div>
			<p class="mt_10"><a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/news/1.png" width="180" alt="" class="block" /></a></p>
			<p class="mt_10"><a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/news/1.png" width="180" alt="" class="block" /></a></p>
		</div>
		<div class="news_right">
			<div class="news_details">
				<h1 class="news_right_tit"><?php echo $this->_tpl_vars['data']['title']; ?>
</h1>
				<div class="news_content"><?php echo $this->_tpl_vars['data']['content']; ?>
</div>
			</div>
		</div>
	</div>
	<!--优势保障 start-->
	<div class="w960 mt_10 index_odds">
		<ul>
			<li>
				<p><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/index/demo/odds_0.jpg" width="166" height="65" alt="" /></p>
				<p class="p_0"><span class="block">央企电子商务</span><span class="block c502">质量保证</span></p>
			</li>
			<li>
				<p><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/index/demo/odds_1.jpg" width="166" height="65" alt="" /></p>
				<p class="p_0"><span class="block">100%正品真货</span><span class="block c502">假一赔十</span></p>
			</li>
			<li>
				<p><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/index/demo/odds_2.jpg" width="166" height="65" alt="" /></p>
				<p class="p_0"><span class="block">满499免运费</span><span class="block c502">全场商品</span></p>
			</li>
			<li>
				<p><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/index/demo/odds_3.jpg" width="166" height="65" alt="" /></p>
				<p class="p_0"><span class="block">1100个城市</span><span class="block c502">送货上门</span></p>
			</li>
		</ul>
	</div>
	<!--优势保障 end-->
</div>
</body>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</html>