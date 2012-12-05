<div id="bookmarkPop" class="popup z-index-top display-none">
    <h6 class="popupTop">
        <span id="closeBookmark" class="close cursor_pointer" onclick="javaScript:closePop('bookmarkPop');">关闭</span> 
        <span class="closeImg"><a href="javaScript:void(0);" onclick="javaScript:closePop('bookmarkPop');return false;"><img src="/image/front/close.gif"> </a> </span>
    </h6>
    <div class="popupMain">
        <span class="collectImg"></span>
        <p class="popupTitle">商品已成功添加到收藏夹</p>
        <p>
            收藏夹共<span class="orange"><?php echo $count;?> </span>件商品
        </p>
        <p>
            <button type="button" class="btnImg btnCollect2" onclick="javaScript:window.location='<?php echo HTTPS_HOME_PAGE_URL;?>/product_bookmark/index/'"></button>
            <a href="javaScript:void(0);" onclick="javaScript:closePop('bookmarkPop');return false;">继续购物</a>
        </p>
    </div>
</div>
<script type="text/javascript">
showPop('bookmarkPop');
</script>