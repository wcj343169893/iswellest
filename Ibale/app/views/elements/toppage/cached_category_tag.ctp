<?php $dataList = $this->requestAction('/toppage/cached_category_tag');?>
<?php foreach($dataList as $key => $value):?>
<li><a href="<?php echo HTTP_HOME_PAGE_URL;?>/category_top/index/id:<?php echo $value['id'];?>"><?php echo $value['name'];?></a></li>
<?php endforeach;?>