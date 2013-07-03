<?php echo $this->Html->script(array('addtocart.js'), array('inline' => false)); ?>
<div id="sidebar">
    <!-- Search -->
    <div class="box search">
        <h2>Search by</h2>
        <div class="box-content">
            <?php  echo $this->Filter->filterForm('Keyword', array('class' => 'field'));?>
        </div>
    </div>
    <!-- End Search -->
	<div class="clear"></div>
    <!-- Categories -->
    <div class="box categories">
        <h2>Categories</h2>
        <div class="box-content">
            <?php if($current_user['role'] == 'admin'): ?>
            <?php echo $this->Html->link('View Categories', '/categories', array('class' => 'button', 'target' => '_blank'));?>
            <?php endif; ?>

        </div>
    </div>
    <!-- End Categories -->

</div>

<div id="product-detail" class="box_p">
    <h2><?php echo __('Products'); ?></h2>
    <div class="product_sort">
    	<a href="/shop/cart" target="_blank">Shop Cart</a>
        <?php echo $this->Paginator->sort('name','Name'); ?>
        <?php echo $this->Paginator->sort('cateID','Category');?>
        <?php echo $this->Paginator->sort('price','Price'); ?>
    </div>
    <table class="product">
    <?php foreach ($products as $product): ?>
    <tr>
    	<td>
    		<?php echo $this->Html->image($product['Product']['photo'], array('alt' => $product['Product']['name'],'pathPrefix' => '/images/small/','height' => 130, 'width' => 130));?>
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
        <td>
            <span class="price">$<?php echo h($product['Product']['price']); ?>/KG</span>
            <?php echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'add'))); ?>
			<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $product['Product']['id'])); ?>
			<?php echo $this->Form->input('quantity', array('type' => 'hidden', 'value' => 1)); ?>
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

