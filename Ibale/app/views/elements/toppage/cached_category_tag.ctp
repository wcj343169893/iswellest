<?php $dataList = $this->requestAction('/toppage/cached_category_tag');?>
<?php $index=1;?>
<?php foreach($dataList as $key => $value):?><?php if($index==1):?>
<li><a href="<?php echo HTTP_HOME_PAGE_URL;?>/category_top/index/id:<?php echo $value['id'];?>"><?php echo $value['name'];?></a></li>
<?php endif;?><?php $index++;?><?php endforeach;?>