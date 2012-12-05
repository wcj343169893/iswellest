<script type="text/javascript">
//ブランド配列
var textValueBrand=new Array();
<?php if (!empty($brandList)):?>
<?php $index=0;?>
<?php foreach($brandList as $key => $value):?>
<?php $value = $value['Brand'];?>
textValueBrand[<?php echo $index;?>]=new Array(<?php echo $value['id'];?>,'<?php echo $value['brand_name'];?>','<?php echo $value['brand_name_pinyin'];?>',<?php echo $value['id'];?>);
<?php $index++;?>
<?php endforeach;?>
<?php endif;?>

//常用なブランド配列
var commonTextValueBrand = new Array();
for(var i=0;i<10;i++) {
    commonTextValueBrand[i] = textValueBrand[i];
}
</script>
