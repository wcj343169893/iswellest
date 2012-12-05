<li id="liBrand<?php echo $key;?>">
<?php echo $appForm->hidden("CategoryTop.brand.{$key}.id", array('id'=>"brandId{$key}", 'class'=>'input'));?>
- <?php echo $this->data['CategoryTop']['brand'][$key]['brand_name'];?><a href="javaScript:void(0);" class="del" onClick="javaScript:delBrand(<?php echo $key;?>);">[删除]</a>
</li>
