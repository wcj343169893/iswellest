<?php echo $this->Html->script(array('addtocart.js'), array('inline' => false)); ?>
    <!-- Search -->
    <div class="box search" style="display: none;">
        <h2>Search by</h2>
        <div class="box-content">
            <div class="field">
			<form action="/products/" id="KeywordFilter" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>						
			<input type="hidden" name="data[Filter][filterFormId]" value="Keyword" id="FilterFilterFormId"/>
			<div class="input text"><label for="ProductName||Description">Keyword</label><input name="data[Product][name || description]" type="text" id="ProductName||Description"/></div>
			<div class="submit"><input  class="btn btn-primary" type="submit" value="Submit"/></div></form>
			</div>
        </div>
    </div>
    <!-- End Search -->
<div id="sidebar">
    <!-- Categories -->
    <div class="box categories">
        <h2>Categories</h2>
        <div class="box-content">
			<ul><?php foreach ($categories as $k=>$v){?>
				<li><a href="/products/?cid=<?php echo $k?>"><?php echo $v?></a></li>
				<?php }?>
			</ul>
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
    	<?php if(empty($product['Product']['photo'])){?>
    	<img src="/images/small/no-photo.jpg" width="130px" height="130px"/>
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

