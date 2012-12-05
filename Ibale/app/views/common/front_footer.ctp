<div class="clear"></div>
<div id="footer">
<?php if (!$this->noFooterLink):?>
    <div class="help">
        <?php echo $this->element('/article/footer_help', array('cache' => STATIC_PAGE_CACHED_DURATION));?>
    </div>
    <?php echo $this->element('toppage/cached_friendlink', array('cache' => STATIC_PAGE_CACHED_DURATION));?>
<?php endif;?>
    <div class="service_2 clearfix">
        <ul>
            <li class="fore1">物美价廉</li>
            <li class="fore2">满百包邮</li>
            <li class="fore3">顾客至上</li>
            <li class="fore4">物美价廉</li>
        </ul>
        <br class="clear" />
        <p>爱健康，爱美丽，爱芭乐！来自中国与日本的两家健康领域的领军公司倾力打造，爱芭乐将为中国顾客提供最优质的健康商品服务。我们与500多家中外优秀的健康产品厂商合作， 向消费者提供药品、保健品、理疗器械、成人产品、中药饮片、美容护理等上万种医药健康产品。</p>
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
</body>
</html>