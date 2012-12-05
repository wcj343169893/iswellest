<?php ?>
<?php $recs = $this->requestAction('/shopping/cached_recommend_product/');?>
<div class="titleBg m_10">
    <h3 class="productTitle">推荐商品</h3>
</div>
<ul class="itemContent m_10_b clearfix">
<?php if (!empty($recs)):?>
    <?php foreach($recs as $key => $value):?>
    <li>
        <?php $this->set('productInfo', $value);?>
        <?php echo $this->element('product/product_info_without_navi');?>
    </li>
    <?php endforeach;?>
<?php endif;?>
</ul>