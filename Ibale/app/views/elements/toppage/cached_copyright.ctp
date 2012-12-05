<?php $dataList = $this->requestAction('/toppage/cached_copyright');?>
<div id="copyRight">
    <div class="content">
    <?php if (!empty($dataList)):?>
        <p class="c_c_p">
        <?php foreach($dataList as $key => $value):?>
            <?php $value = $value['PageProperty'];?>
            <a href="<?php echo HTTP_HOME_PAGE_URL;?><?php echo $value['url'];?>"><?php echo $value['name'];?></a>
            <?php if ($key < count($dataList) -1):?> │ <?php endif;?>
        <?php endforeach;?>
        </p>
    <?php endif;?>
    	<p class="f_share">
    		<a href="javascript:;" title="分享到新浪微博" class="s_sina"></a>
    		<a href="javascript:;" title="分享到人人网" class="s_renren"></a>
    		<a href="javascript:;" title="分享到qq空间" class="s_qzone"></a>
    		<a href="javascript:;" title="分享到腾讯微博" class="s_qweibo"></a>
    		<a href="javascript:;" title="分享到豆瓣网" class="s_douban"></a>
    	</p>
    </div>
</div>