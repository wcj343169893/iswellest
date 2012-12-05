<div class="clear"></div>
<div class="footer">
<div id="footer">
<?php if (!$this->noFooterLink):?>
    <div class="help">
        <?php echo $this->element('/article/footer_help', array('cache' => STATIC_PAGE_CACHED_DURATION));?>
    </div>
<?php endif;?>
    <div class="service_2 clearfix">
    	<ul class="func_s">
    		<li><a href="javascript:;" title="满99元包邮">满99元包邮</a></li>
    		<li><a href="javascript:;" title="品质保障">品质保障</a></li>
    		<li><a href="javascript:;" title="退货保障">退货保障</a></li>
    		<li><a href="javascript:;" title="会员积分">会员积分</a></li>
    		<li><a href="javascript:;" title="原产地证明">原产地证明</a></li>
    		<li><a href="javascript:;" title="500实体店">500实体店</a></li>
    	</ul>
    </div>
    <div class="service_category clearfix">
    	<?php $footer_category_count=count($categoryAllOptionList['level_1']);$footer_category_index=0;?>
    	<?php foreach($categoryAllOptionList['level_1'] as $k1 => $v1):?>
    		<?php $footer_category_index++;?>
    		<a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/category1_id:<?php echo $k1;?>"><?php echo $v1?></a> <?php if($footer_category_index<$footer_category_count){echo "|";}?>
    	<?php endforeach;?>
    </div>
</div>
<?php echo $this->element('toppage/cached_copyright', array('cache' => STATIC_PAGE_CACHED_DURATION));?>
<iframe id="hiddenForAjaxSubmit" src="" class="display-none"></iframe>
<!-- 
<iframe id="tempIframe" src="" name="tempIframe" style="display:none;width:0px;height:0px;"></iframe>
 -->
<div id="blockOtherOperation" class="block-operation display-none">
</div>
<div id="wait" class="wait-process display-none">
    <div class="wait-img">
        <img src="/image/wait.gif" width="32" height="32" alt="请等待。。。" />
    </div>
</div>
<?php if (SERVER_TYPE == SERVER_TYPE_HONBAN):?>
<script type="text/javascript">
(function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
<?php endif;?>
</div>
<div id="login_window" title="">
	<div class="lw_main">
		<div class="login_form floatL">
			<form action="<?php echo HTTPS_HOME_PAGE_URL;?>/member/login" method="post" accept-charset="utf-8">
				<div class="lg_title">会员登录</div>
					<div class="inputs"><label for="ajax_username">用户名</label><input id="ajax_username" name="data[Member][email]"/></div>
					<div class="inputs"><label for="ajax_password">密    码</label><input id="ajax_password" name="data[Member][password]"/></div>
					<div class="submits"><input type="submit" value="&nbsp;"/></div>
				<div class="clear"></div>
				<div class="lg_func">
					<input type="checkbox" name="data[Member][remember]" id="remember"/>
					<label for="remember">记住我的账户</label>
					<span class="lg_forget"><a href="/member/forget" title="忘记密码?">忘记密码?</a></span>
					<span class="lg_regist"><a href="/member/regist" title="即刻注册">即刻注册</a></span>
				</div>
				<input type="hidden" name="back_url" value="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>">
			</form>
			<div class="lg_other_login">
				<ul>
					<li class="lg_weibo"><a href="javascript:;" title="微博登录">微博登录</a></li>
					<li class="lg_qq"><a href="javascript:;" title="QQ登录">QQ登录</a></li>
					<li class="lg_alipay"><a href="javascript:;" title="支付宝登录">支付宝登录</a></li>
				</ul>
			</div>
		</div>
		<div class="login_ad floatL">
			<img alt="" src="/img/login_ad.png">
		</div>
		<div class="clear"></div>
	</div>
</div>
</body>
</html>