<?php if ($type == 'hot_sale_product'):?>
<?php $h4Class="hotProduct"?>
<?php $divClass = "";?>
<?php elseif ($type == 'otc_product'):?>
<?php $h4Class="otc"?>
<?php $divClass = "";?>
<?php elseif ($type == 'hot_enquiry_product'):?>
<?php $h4Class="hotConsultation"?>
<?php $divClass = "none";?>
<?php endif;?>
    <div class="adList <?php echo $divClass;?>">
        <h4 class="<?php echo $h4Class;?>"></h4>
        <ul>
        <?php for($i=1;$i<=10;$i++):?>
            <?php $value = $this->data['Toppage'][$type][$i];?>
            <?php if ($i==10):?>
                <?php $class = 'noneBorder';?>
            <?php else:?>
                <?php $class = '';?>
            <?php endif;?>
            <li id="<?php echo $type;?>productInfoLine<?php echo $i;?>" class="<?php echo $class;?>" style="<?php if ($i==1):?>display:none;<?php endif;?>">
                <?php echo $i;?>.&nbsp;&nbsp;&nbsp;
                <a href="javaScript:void(0);" onclick="javaScript:showProductDesc('<?php echo $type;?>',<?php echo $i;?>);"><?php echo !empty($value['product_name'])?$text->truncate($value['product_name'], 19, array('ending'=>'...')):'';?> </a>
            </li>
            <li id="<?php echo $type;?>productInfoBlock<?php echo $i;?>" class="clearfix"  style="<?php if ($i>1):?>display:none;<?php endif;?>">
                <?php echo $i;?>.&nbsp;&nbsp;&nbsp;<br>
            <?php /**
            <a href="<?php echo HTTP_HOME_PAGE_URL?>/product/detail/product_cd:<?php echo $value['product_cd'];?>" class="imgWrap"><img src="<?php echo $value['product_pic_url'];?>" width="100" height="100" /><?php if ($value['sale_rule_count'] > 0):?><span class="sale2"></span> <?php endif;?> </a>
            */?>
            <?php if (!empty($value['product_cd'])):?>
                <?php $this->set('productInfo', $value);?>
                <?php echo $this->element('product/ranking_product_info');?>
            <?php endif;?>
            </li>
        <?php endfor;?>
        </ul>
    </div>
<script type="text/javascript">
function showProductDesc(type, index) {
    $("li[id^='"+type+"productInfoBlock']").each(function(){
        if ($(this).attr('id') == type+'productInfoBlock'+index) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
    $("li[id^='"+type+"productInfoLine']").each(function(){
        if ($(this).attr('id') == type+'productInfoLine'+index) {
            $(this).hide();
        } else {
            $(this).show();
        }
    });
}
</script>