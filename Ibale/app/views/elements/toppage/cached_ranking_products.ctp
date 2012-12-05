<?php $this->requestAction('/toppage/cached_ranking_products');?>
<div class="adRight">
    <?php $this->set('type', 'hot_sale_product');?>
    <?php echo $this->element('toppage/ranking_products');?>
    <?php $this->set('type', 'otc_product');?>
    <?php echo $this->element('toppage/ranking_products');?>
    <?php $this->set('type', 'hot_enquiry_product');?>
    <?php echo $this->element('toppage/ranking_products');?>
</div>