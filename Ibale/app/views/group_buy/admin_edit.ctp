<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<?php include_once WWW_ROOT.'/js/admin/product.js';?>
<?php echo $appForm->create('GroupBuy', array('id'=>'GroupBuy', 'url'=>'/admin/group_buy/edit_comp'));?>
<?php echo $appForm->hidden('id');?>
<?php echo $appForm->hidden('referer');?>
<?php echo $appForm->hidden('mode', array('value'=>'update'));?>
<div class="mainWrapper">
    <h2>添加/编辑团购活动</h2>
    <div class="topContent clearfix">
        <h4>
            团购标题 <?php echo $appForm->text('title', array('class'=>'input_400'));?>
            <?php echo $appForm->error('GroupBuy.title', '团购标题');?>
        </h4>
        <h4>
            对应商品ID <?php echo $appForm->text('product_cd', array('id'=>'productCd'));?> 
            <input name="button" type="button" class="btnWidth" id="button" value="确定" onClick="javaScript:getProductInfo('productCd','productName','productPic');"/> &nbsp;&nbsp;&nbsp;&nbsp;
            限购数量 <?php echo $appForm->text('max_purchase_number', array('class'=>'input_50'));?>
            <?php echo $appForm->error('GroupBuy.product_cd', '对应商品ID');?>
            <?php echo $appForm->error('GroupBuy.max_purchase_number', '限购数量');?>
            <?php if ( $appSession->check('Message.productCdIsWrong')):?>
                <?php echo $appSession->flash('productCdIsWrong');?>
            <?php endif;?>
        </h4>
        <p class="p_70_l">
        <?php $url = '/image/admin/img_2.gif';?>
        <?php if (!empty($productInfo['ProductPhoto'][0]['url'])):?>
            <?php $url = OMS_API_PHOTO_ROOT_URL.$productInfo['ProductPhoto'][0]['url'];?>
        <?php endif;?>
            <img id="productPic" src="<?php echo $url;?>" width="120" height="120" /><br /> 
        <?php $productName = '';?>
        <?php if (!empty($productInfo['Product']['product_name'])):?>
            <?php $productName = $productInfo['Product']['product_name'];?>
        <?php endif;?>
            <span id="productName" class="gray l_20"><?php echo $productName;?></span>
        </p>
        <p class="p_10_d">
            开始时间 <?php echo $appForm->text('start_date', array('class'=>'input_80'));?> 
            <?php echo $appForm->hour('start_time', true, null, array('class'=>'input_50', 'empty'=>false));?> 
            <?php echo $appForm->minute('start_time', null, array('class'=>'input_50', 'empty'=>false));?>&nbsp;&nbsp;&nbsp;&nbsp;
            结束时间 <?php echo $appForm->text('end_date', array('class'=>'input_80'));?> 
            <?php echo $appForm->hour('end_time', true, null, array('class'=>'input_50', 'empty'=>false));?>
            <?php echo $appForm->minute('end_time', null, array('class'=>'input_50', 'empty'=>false));?>
            <span>不能超过当前时间</span>
            <?php echo $appForm->error('GroupBuy.start_date', '开始日期');?>
            <?php echo $appForm->error('GroupBuy.end_date', '结束日期');?>
            <?php echo $appForm->error('GroupBuy.end_time_str', '结束时间');?>
        </p>
        <p class="p_10_d">
            <b>无效FLG</b> 
            <?php echo $appForm->checkbox('inactive_flg', array('value'=>ACTIVE_FLG_TRUE));?>
            <?php echo $appForm->hidden('inactive_flg_old', array('value'=>$this->data['GroupBuy']['inactive_flg']));?>
        </p>
        <p class="p_10_d">
            <b>团购人数</b> 
            <?php echo $appForm->checkbox('manual_purchase_person_count_flg', array('value'=>ACTIVE_FLG_TRUE));?>人工设定
        </p>
        <p class="p_55_l">
        <?php $disabled = 'disabled';?>
        <?php if ($this->data['GroupBuy']['manual_purchase_person_count_flg'] == ACTIVE_FLG_TRUE):?>
            <?php $disabled = '';?>
        <?php endif;?>
            基数： <?php echo $appForm->text('base_purchase_person_count_min', array('class'=>'input_50', 'disabled'=>$disabled));?> 
             至 <?php echo $appForm->text('base_purchase_person_count_max', array('class'=>'input_50', 'disabled'=>$disabled));?> 内的随机数，
             每小时增加 <?php echo $appForm->text('increase_purchase_person_count_min', array('class'=>'input_50', 'disabled'=>$disabled));?> 
             至 <?php echo $appForm->text('increase_purchase_person_count_max', array('class'=>'input_50', 'disabled'=>$disabled));?> 内的随机数
             <?php echo $appForm->error('GroupBuy.base_purchase_person_count_min', '最小基数');?>
             <?php echo $appForm->error('GroupBuy.base_purchase_person_count_max', '最大基数');?>
             <?php echo $appForm->error('GroupBuy.increase_purchase_person_count_min', '最小增加基数');?>
             <?php echo $appForm->error('GroupBuy.increase_purchase_person_count_max', '最大增加基数');?>
        </p>
        <h4>团购描述</h4>
        <?php echo $appForm->textarea('comment', array('class'=>'ckeditor'));?>
        <?php echo $appForm->error('GroupBuy.comment', '团购描述');?>
    </div>
    <br class="clear" />
    <div class="btn clearfix">
        <input name="button3" type="submit" class="btnWidth" id="button3" value="提交" />
    </div>
</div>
<?php echo $appForm->end();?>
<script type="text/javascript">
$(function(){
    $("#GroupBuyStartDate").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });
    $("#GroupBuyEndDate").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });
    $("#GroupBuyManualPurchasePersonCountFlg").click(function(){
        if ($(this).attr('checked') == true) {
            $("#GroupBuyBasePurchasePersonCountMin").attr("disabled",false);
            $("#GroupBuyBasePurchasePersonCountMax").attr("disabled",false);
            $("#GroupBuyIncreasePurchasePersonCountMin").attr("disabled",false);
            $("#GroupBuyIncreasePurchasePersonCountMax").attr("disabled",false);
        } else {
            $("#GroupBuyBasePurchasePersonCountMin").attr("disabled",true);
            $("#GroupBuyBasePurchasePersonCountMin").val('');
            $("#GroupBuyBasePurchasePersonCountMax").attr("disabled",true);
            $("#GroupBuyBasePurchasePersonCountMax").val('');
            $("#GroupBuyIncreasePurchasePersonCountMin").attr("disabled",true);
            $("#GroupBuyIncreasePurchasePersonCountMin").val('');
            $("#GroupBuyIncreasePurchasePersonCountMax").attr("disabled",true);
            $("#GroupBuyIncreasePurchasePersonCountMax").val('');
        }
    });

});
</script>