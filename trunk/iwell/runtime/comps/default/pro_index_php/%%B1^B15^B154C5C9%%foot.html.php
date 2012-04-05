<?php /* Smarty version 2.6.18, created on 2011-07-08 14:07:50
         compiled from public/foot.html */ ?>
 <!--优势保障 start-->

	<div class="w960 mt_10">
		<div id="service" class="clearFix">
			<dl class="dl_0">
				<dt><a href="#">购物指南</a></dt>
				<dd><a href="#">注册流程</a></dd>
				<dd><a href="#">订购流程</a></dd>
			</dl>
			<dl class="dl_1">
				<dt><a href="#">配送服务</a></dt>
				<dd><a href="#">配送服务</a></dd>
				<dd><a href="#">配送时间</a></dd>
				<dd><a href="#">配送方式</a></dd>
				<dd><a href="#">运费说明</a></dd>
			</dl>
			<dl class="dl_2">
				<dt><a href="#">支付说明</a></dt>
				<dd><a href="#">支付方式</a></dd>
			</dl>
			<dl class="dl_3">
				<dt><a href="#">售后服务</a></dt>
				<dd><a href="#">如何退换货</a></dd>
				<dd><a href="#">在线客服</a></dd>
				<dd><a href="#">顾客留言板</a></dd>
			</dl>
			<dl class="dl_4">
				<dt><a href="#">会员中心</a></dt>
				<dd><a href="#">找回密码</a></dd>
				<dd><a href="#">会员权益</a></dd>
				<dd><a href="#">优 惠 券</a></dd>
			</dl>
			<a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/service.png" alt="" class="fr" /></a>
		</div>
	</div>
	<div id="footer">
		<dl id="links">
			<dt>友情链接：</dt>
			<?php unset($this->_sections['ls']);
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['link']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<dd><a href="#"><?php echo $this->_tpl_vars['link'][$this->_sections['ls']['index']]['linkname']; ?>
</a>|</dd>
			<?php endfor; endif; ?>


		</dl>
		<ul class="footer_nav">
			<li><a href="#">关于我们</a>|</li>
			<li><a href="#">心云承诺</a>|</li>
			<li><a href="#">联系我们</a>|</li>
			<li><a href="#">人才招聘</a>|</li>
			<li><a href="#">友情链接</a>|</li>
			<li><a href="#">网站联盟</a></li>
		</ul>
		<p class="mt_10">心云商城 版权所有 京ICP备11006562号  Copyright©2006-2011 ptacmall.com</p>
		<ul class="footer_links">
			<li><a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/link_0.png" alt="" /></a></li>
			<li><a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/link_1.png" alt="" /></a></li>
			<li><a href="#"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/link_2.png" alt="" /></a></li>
		</ul>
	</div>
	<!--底部 end-->
</div>
</body>
</html>