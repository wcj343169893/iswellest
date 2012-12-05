<?php if(isset($_COOKIE['browsed_product_cd'])):?>
    <?php $browsedProductCd = $_COOKIE['browsed_product_cd'];?>
    <?php $browsedProductCd = explode(',', $browsedProductCd);?>
    <?php unset($browsedProductCd[array_search($currentProductCd, $browsedProductCd)]);?>
    <?php $recs = $this->requestAction('/product/cached_product/product_cds:'.implode(',',$browsedProductCd));?>
<?php else:?>
    <?php $recs = array();?>
<?php endif;?>
<div class="titleBg m_10">
    <h3 class="itemTitle3">最近浏览的商品</h3>
</div>
<ul class="itemContent clearfix">
<?php if (!empty($recs)):?>
    <?php $count = 0;?>
    <?php foreach($recs as $key => $value):?>
    <?php $count++;?>
    <?php if ($count > PRODUCT_DETAIL_RELATION_PRODUCT_LIMIT):?>
        <?php continue;?>
    <?php endif;?>
    <li>
        <?php $this->set('productInfo', $value);?>
        <?php echo $this->element('product/product_info_without_navi');?>
    </li>
    <?php endforeach;?>
<?php else:?>
<?php endif;?>
</ul>