<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<?php echo $appForm->create('Product', array('id'=>'Product', 'url'=>'/admin/product/edit_comp'));?>
<?php echo $appForm->hidden('referer');?>
<?php echo $appForm->hidden('product_cd');?>
<div class="mainWrapper">
    <h2>商品编辑</h2>
    <div class="topContent clearfix">
        <h4>
            商品编号： <span><?php echo $detail['Product']['product_cd'];?> </span>
        </h4>
        <h4>
            商品名称： <span><?php echo $detail['Product']['product_name'];?> </span>
        </h4>
        <h4>正文</h4>
        <div class="brand">
        <?php echo $appForm->textarea('custom_content', array('class'=>'ckeditor'));?>
        <?php echo $appForm->error('Product.custom_content', '正文');?>
        </div>
    </div>
    <br class="clear" />
    <div class="btn clearfix">
        <input name="button3" type="submit" class="btnWidth" id="button3" value="确定" />
    </div>
</div>
<?php echo $appForm->end();?>