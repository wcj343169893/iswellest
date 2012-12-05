<style>
<!--
.st_button {
    width:18px;
}
.shareto_toolbox .stico {
    padding-left:3px !important
}
.shareto_separator {
    width:5px;
}
-->
</style>
<!-- ShareTo Button START -->
    <div class="shareto_toolbox" style="width:160px;" shareto="<?php echo !empty($shareToURL)?$shareToURL:'';?>">
    <?php if(empty($shareToURL)):?>
        <a href="http://shareto.com.cn/share.html" class="shareto_button_compact"></a>
    <?php endif;?>
        <a class="shareto_button_qzone"></a>
        <a class="shareto_button_tsina"></a>
        <a class="shareto_button_tqq"></a>
        <a class="shareto_button_kaixin001"></a>
        <a class="shareto_button_renren"></a>
        <a class="shareto_button_douban"></a>
    </div>
    <!-- <script type="text/javascript" src="http://s.shareto.com.cn/js/shareto_button.js" charset="utf-8"></script> -->
    <script type="text/javascript" src="/js/front/shareto_button.js" charset="utf-8"></script>
<!-- ShareTo Button END -->