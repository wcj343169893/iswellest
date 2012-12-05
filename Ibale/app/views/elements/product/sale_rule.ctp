<?php $index = 1;?>
<?php foreach($detail['SaleRule'] as $key => $value):?>
    <font><?php echo $index;?>. <?php echo $value['display_string'];?></font><br />
    <?php if (isset($value['product_list'])):?>
        <?php if (count($value['product_list']) > 2):?>
            <a href="javascript:void(0);" onclick="javascript:ctrlHiddenProduct(this, '<?php echo $key;?>');" style="float:right;padding-right:10px;" title="展开"><span class="more-product-expand" ></span>其他商品</a>
        <?php endif;?>
        <div style="margin-left:15px;padding-right:5px;border:dashed 0px gray;background:#fff;">
        <?php $productIndex = 0;?>
        <?php foreach($value['product_list'] as $k => $v):?>
            <?php if ($v['product_cd'] == $detail['Product']['product_cd']):?>
                <?php continue;?>
            <?php endif;?>
            <?php if ($productIndex == 2):?>
                <p id="hiddenProduct<?php echo $key;?>" class="display-none">
            <?php endif;?>
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $v['product_cd'];?>" target="_blank"><?php echo $v['product_name'];?></a><br>
            <?php $productIndex++;?>
        <?php endforeach;?>
        <?php if (count($value['product_list']) > 2):?>
            </p>
        <?php endif;?>
        </div>
    <?php endif;?>
    <?php $index++;?>
<?php endforeach;?>