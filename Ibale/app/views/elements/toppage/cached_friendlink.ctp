<?php $dataList = $this->requestAction('/toppage/cached_friendlink')?>
<?php if (!empty($dataList)):?>
    <div class="friendLink clearfix">
        <span class="linkTitle">友情链接</span> 
        <span class="linkContent">
    <?php foreach($dataList as $key => $value):?>
        <a href="<?php echo $value['PageFriendlink']['url'];?>" target="_blank"><?php echo $value['PageFriendlink']['name'];?></a>
    <?php endforeach;?>
        </span>
    </div>
<?php endif;?>