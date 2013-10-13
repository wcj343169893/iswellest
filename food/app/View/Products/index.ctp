<?php $this->Html->addCrumb('Product', '/Products/index');?>
<?php echo $this->Html->script(array('addtocart.js'), array('inline' => false)); ?>

<div id="sidebar">
	<!-- Categories -->
	<div class="box categories">
		<h2>Categories</h2>
		<div class="box-content">
			<ul><?php foreach ($categories as $k=>$v){?>
				<li><?php echo $this->Html->link($v,array("controller"=>"products","?"=>array("cid"=>$k)))?></li>
				<?php }?>
			</ul>
		</div>
	</div>
	<!-- End Categories -->
</div>
<div id="product-detail" class="box_p">
	<h2><?php echo __('Products'); ?></h2>
	<?php echo $this->Html->link("Shop Cart",array("controller"=>"shop","action"=>"cart"),array("class"=>"shop_cart"))?>
	<span id="shop_cart_count">0</span>

    <div class="product_sort">
		<div class="s_mod_order_tit">Order：</div>
    	<div class="s_mod_order_term">
        <?php echo $this->Paginator->sort('name','<b class="s_mod_order_arrow">&nbsp;</b>Name',array("class"=>"s_mod_order_cate","escape"=>false)); ?>
        <?php echo $this->Paginator->sort('cateID','<b class="s_mod_order_arrow">&nbsp;</b>Category',array("class"=>"s_mod_order_cate","escape"=>false));?>
        <?php echo $this->Paginator->sort('price','<b class="s_mod_order_arrow">&nbsp;</b>Price',array("class"=>"s_mod_order_cate","escape"=>false)); ?>
        </div>
    </div>

	<table class="product">
    <?php foreach ($products as $product): ?>
    <tr>
			<td>
    	<?php if(empty($product['Product']['photo'])){?>
    	<img src="/images/small/no-photo.jpg" width="130px" height="130px" />
    	<?php }else{?>
    		<?php echo $this->Html->image($product['Product']['photo'], array('alt' => $product['Product']['name'],'pathPrefix' => '/images/small/','height' => 130, 'width' => 130));?>
    		<?php }?>
    	</td>
			<td>
				<div class="product_text">
					<h3>
                    <?php echo $this->Html->link($product['Product']['name'], array('controller' => 'products', 'action' => 'view', 'slug' => $product['Product']['slug'])); ?>
                    </h3>
					<p><?php
               $string = $product['Product']['excerpt'];
               $stringCut = substr($string, 0, 200);
               $string = substr($stringCut, 0, strrpos($stringCut, ' '));
               echo h($string);?> &nbsp;
               </p>
				</div>
			</td>
			<td><span class="price">$<?php echo h($product['Product']['price']); ?>/KG</span>
            <?php echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'add'))); ?>
			<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $product['Product']['id'])); ?>
			<?php echo $this->Form->input('quantity', array('type' => 'text', 'value' => 1,'id'=>"ProductQuantity_".$product['Product']['id'],'class'=>"product_quantitys","between"=>"<span class='btn p_q_minus'>-</span>","after"=>"<span class='btn p_q_add'>+</span>")); ?>
			<?php echo $this->Form->button('<i class="icon-shopping-cart icon-white"></i> Add to Cart', array('class' => 'btn btn-primary addtocart', 'id' => $product['Product']['id'], 'escape' => false));?>
			<?php echo $this->Form->end();?>
        </td>
		</tr>
<?php endforeach; ?>
</table>
	<div class="pagerDRUPAL">
		<div class="pager-list">
        <?php echo $this->Paginator->prev('<< ' . __('Previous'), array(), null, array('class' => 'pager-next active'));?>
        <?php echo $this->Paginator->numbers(array('separator' => '|'),array('class' => 'pager-list'));?>
        <?php echo $this->Paginator->next(__('next') . ' >>', array(), null, array('class' => 'pager-last active'));?>
        <?php
                echo $this->Paginator->counter(array(
        'format' => __('Page {:page} of {:pages}, {:current} records out of {:count} total.')));?>
    </div>
	</div>
</div>

