<?php $this->page_props['title'] = __('info.siteNameCN', true).' -- 【'.$detail['Article']['title'].'】';?>
<!--
<h2 class="crumbList">
    <a href="<?php echo HTTP_HOME_PAGE_URL;?>">首页</a> > <?php echo $detail['Article']['category1_name'];?> > <?php echo $detail['Article']['category2_name'];?>
</h2>
-->
<div class="mainCenter clearfix m10">
    <?php echo $this->element('article/cached_article_category', array('cache'=>array('time'=>STATIC_PAGE_CACHED_DURATION, 'key'=>$detail['Article']['category1_id'])));?>
    <!-- 右侧文章详细信息 -->
    <div class=" mainRight">
        <h3 class="infoTitle"><?php echo $appHtml->html($detail['Article']['title']);?></h3>
        <div class="helpInfo clearfix">
            <?php echo $detail['Article']['content'];?>
        </div>
    </div>
    <!-- 右侧文章详细信息 end -->
</div>
<!-- main end -->