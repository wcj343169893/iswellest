<?php $recs = $this->requestAction('/product/cached_relation_product/product_cd:'.$detail['Product']['product_cd'].'/relation_product_cds:'.$detail['Product']['relation_product_cd'].'/category_id:'.$categoryId);?>
<!-- 相关商品 -->
<div class="titleBg m_10">
    <h3 class="itemTitle2">相关商品</h3>
</div>
<ul class="itemContent clearfix">
<?php if (!empty($recs)):?>
    <?php foreach($recs as $key => $value):?>
    <li>
        <?php $this->set('productInfo', $value);?>
        <?php echo $this->element('product/product_info_without_navi');?>
    </li>
    <?php endforeach;?>
<?php endif;?>
</ul>
<!-- 相关商品 end -->
