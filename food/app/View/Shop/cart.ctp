<?php echo $this->set('title_for_layout', 'Shopping Cart'); ?>

<?php echo $this->Html->script(array('cart.js'), array('inline' => false)); ?>

<h1>Shopping Cart</h1>

<?php if(empty($shop['OrderItem'])) : ?>

Shopping Cart is empty

<?php else: ?>

<?php echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'cartupdate'))); ?>

<hr>

<table class="t_cart">
 <thead>
  <tr>
    <th class="span2">&nbsp;</th>
    <th class="span5">ITEM</th>
    <th class="span1">PRICE</th>
    <th class="span1">WEIGHT</th>
    <th class="span1">SUBTOTAL</th>
    <th class="span1">ACTION</th>
  </tr>
  </thead>
  <tbody>
  <?php $tabindex = 1; ?>
<?php foreach ($shop['OrderItem'] as $item): ?>
  <tr id="row-<?php echo $item['Product']['id']; ?>">
    <td><?php echo $this->Html->image('/images/small/' . $item['Product']['photo'], array('class' => 'px60')); ?></td>
    <td><strong><?php echo $this->Html->link($item['Product']['name'], array('controller' => 'products', 'action' => 'view', 'slug' => $item['Product']['slug'])); ?></strong></td>
    <td id="price-<?php echo $item['Product']['id']; ?>">$<?php echo $item['Product']['price']; ?></td>
    <td><?php echo $this->Form->input('quantity-' . $item['Product']['id'], array('div' => false, 'class' => 'numeric span1', 'label' => false, 'size' => 2, 'maxlength' => 2, 'tabindex' => $tabindex++, 'data-id' => $item['Product']['id'], 'value' => $item['weight'])); ?></td>
    <td id="subtotal-<?php echo $item['Product']['id']; ?>">$<?php echo $item['subtotal']; ?></td>
    <td><span class="remove" id="<?php echo $item['Product']['id']; ?>"></span></td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
<hr>
<div class="row">
	<div class="span6 offset3 tr">
		<?php echo $this->Html->link('<i class=".icon-step-backward icon"></i> Continue shopping', array('controller' => 'products', 'action' => 'index'), array('class' => 'btn', 'escape' => false)); ?>
		&nbsp; &nbsp;
		<?php echo $this->Html->link('<i class="icon-remove icon"></i> Clear Cart', array('controller' => 'shop', 'action' => 'clear'), array('class' => 'btn', 'escape' => false)); ?>
		&nbsp; &nbsp;
		<?php echo $this->Form->button('<i class="icon-refresh icon"></i> Recalculate', array('class' => 'btn', 'escape' => false));?>
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<hr>
	<div class="row tr cart_checkout">
		<ul>
			<li>Subtotal: <span class="normal" id="subtotal">$<?php echo $shop['Order']['subtotal']; ?></span></li>
			<li>Sales Tax: <span class="normal">N/A</span></li>
			<li>Shipping: <span class="normal">N/A</span></li>
			<li>Order Total: <span class="red" id="total">$<?php echo $shop['Order']['total']; ?></span></li>
			<li><?php echo $this->Html->link('<i class="icon-arrow-right icon-white"></i> Checkout', array('controller' => 'shop', 'action' => 'address'), array('class' => 'btn btn-primary', 'escape' => false)); ?></li>
			<li>
			<?php echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'step1'))); ?>
			<input type='image' name='submit' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif' border='0' align='top' alt='Check out with PayPal' class="sbumit" />
			<?php echo $this->Form->end(); ?></li>
		</ul>
	</div>
<br />
<br />

<?php endif; ?>
