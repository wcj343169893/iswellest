<div id="product-detail" class="box">
    <h2><?php echo h($product['Product']['name']); ?></h2>
    <div class="prod_box_big">
        <div class="top_prod_box_big"></div>
        <div class="center_prod_box_big">
            <div class="product_img_big">
                <?php echo $this->Html->image($product['Product']['photo'], array('alt' => $product['Product']['name'],'pathPrefix' => '/images/small/','height' => 170, 'width' => 170));?>
            </div>
            <div class="details_big_box">
                <?php echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'add'))); ?>
                <div class="prod_price_big" id="bd">
                	<p class="price"><span class="desc_title">Price:</span>$<?php echo h($product['Product']['price']); ?>/KG</p>
                	<p class="price"><span class="desc_title">Quantity:</span><span class="tb-stock" id="J_Stock">
                	<a href="#" class="tb-reduce J_Reduce">-</a>
                	<input id="J_IptAmount" type="text" class="tb-text" value="1" name="data[Product][quantity]" maxlength="8" title="">
                	<a href="#" class="tb-increase J_Increase">﹢</a></span></p>
                </div>
                <div class="desc_add_cart">
					<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $product['Product']['id'])); ?>
					<?php echo $this->Form->button('<i class="icon-shopping-cart icon-white"></i> Add to Cart', array('class' => 'btn btn-primary addtocart', 'id' => $product['Product']['id'], 'escape' => false));?>
                </div>
                <?php echo $this->Form->end();?>
            </div>
        </div>
    </div>
</div>
<div class="product_description box">
	 <?php echo h($product['Product']['description']); ?>
</div>
<script type="text/javascript">
var quantity=1;
$(document).ready(function(){
	$("#bd .tb-reduce").click(function(){
		if(quantity>1){
			quantity--;
			$("#J_IptAmount").val(quantity);
		}
		return false;
	});
	$("#bd .tb-increase").click(function(){
		if(quantity<99){
			quantity++;
			$("#J_IptAmount").val(quantity);
		}
		return false;
	});
	
});
</script>
<?php echo $this->Html->script(array('addtocart.js'), array('inline' => false)); ?>