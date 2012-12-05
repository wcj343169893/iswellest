<?php $dataList = $this->requestAction('/toppage/cached_headerlink');?>
<?php if (!empty($dataList)):?>
    <?php foreach($dataList as $key => $value):?>
        <?php $value = $value['PageProperty'];?>
        <a href="<?php echo HTTPS_HOME_PAGE_URL;?><?php echo $value['url'];?>"><?php echo $value['name'];?></a>
        <?php if ($key < count($dataList) -1):?> │ <?php endif;?>
    <?php endforeach;?>
<?php endif;?>
