<?php $this->Html->addCrumb('Product', '/Products/index');?>
<?php $this->Html->addCrumb('Shopping cart', '/shop/cart');?>
<?php $this->Html->addCrumb('Address', '/shop/address');?>
<?php $this->Html->addCrumb('Order review', '/shop/review');?>

<?php echo $this->set('title_for_layout', 'Order Review'); ?>

<?php echo $this->Html->script(array('shop_review.js'), array('inline' => false)); ?>

<style type="text/css">
	#ccbox {
		background: transparent url("/img/cards.png");
		margin: 0 0 10px 0;
		padding: 0 0 0 150px;
		width: 0;
		height: 23px;
		overflow: hidden;
	}
</style>

<h1>Order Review</h1>

<hr>

<div class="row">
<div class="span4">

First Name: <?php echo $shop['Order']['first_name'];?><br />
Last Name: <?php echo $shop['Order']['last_name'];?><br />
Email: <?php echo $shop['Order']['email'];?><br />
Phone: <?php echo $shop['Order']['phone'];?><br />

<br />

</div>
<div class="span4">
Shipping Address: <?php echo $shop['Order']['shipping_address'];?><br />
Shipping Address 2: <?php echo $shop['Order']['shipping_address2'];?><br />
Shipping City: <?php echo $shop['Order']['shipping_city'];?><br />
Shipping State: <?php echo $shop['Order']['shipping_state'];?><br />
Shipping Zip: <?php echo $shop['Order']['shipping_zip'];?><br />
Shipping Country: <?php echo $shop['Order']['shipping_country'];?><br />

</div>
<a class="btn btn-info" href="javascript:void(0)" id="change_address_btn">Change Address</a>
</div>
<div id="other_address_part"></div>
<hr>

<div class="row">
<div class="span2">&nbsp;</div>
<div class="span4">ITEM</div>
<div class="span1">WEIGHT</div>
<div class="span1">PRICE</div>
<div class="span1" style="text-align: right;">SUBTOTAL</div>
</div>

<?php foreach ($shop['OrderItem'] as $item): ?>
<div class="row">
<div class="span2">
<?php echo $this->Html->image('/images/small/' . $item['Product']['photo'], array('class' => 'px60')); ?></div>
<div class="span4"><?php echo $item['Product']['name']; ?></div>
<div class="span1"><?php echo $item['weight']; ?></div>
<div class="span1">$<?php echo $item['Product']['price']; ?></div>
<div class="span1" style="text-align: right;">$<?php echo $item['subtotal']; ?></div>
</div>
<?php endforeach; ?>
<hr>
<div class="row">
	<ul>
		<li>Products:<?php echo $shop['Order']['order_item_count']; ?></li>
		<li>Items:<?php echo $shop['Order']['quantity']; ?></li>
		<li>Total:<strong>$<?php echo $shop['Order']['total']; ?></strong></li>
	</ul>
</div>
<hr>
<br />
<?php echo $this->Form->create('Order'); ?>
<?php if($shop['Order']['order_type'] == 'creditcard'): ?>
<div id="ccbox">
	Credit Card Type.
</div>
<?php echo $this->Form->input('creditcard_number', array('class' => 'span2 ccinput', 'maxLength' => 16, 'autocomplete' => 'off')); ?>
<div class="row">
	<div class="span2">
		<?php echo $this->Form->input('creditcard_month', array(
			'label' => 'Expiration Month',
			'class' => 'span2',
			'options' => array(
				'01' => '01 - January',
				'02' => '02 - February',
				'03' => '03 - March',
				'04' => '04 - April',
				'05' => '05 - May',
				'06' => '06 - June',
				'07' => '07 - July',
				'08' => '08 - August',
				'09' => '09 - September',
				'10' => '10 - October',
				'11' => '11 - November',
				'12' => '12 - December'
			)
		)); ?>
	</div>
	<div class="span2">
		<?php echo $this->Form->input('creditcard_year', array(
			'label' => 'Expiration Year',
			'class' => 'span2',
			'options' => array(
				'13' => '2013',
				'14' => '2014',
				'15' => '2015',
				'16' => '2016',
				'17' => '2017',
				'18' => '2018',
				'19' => '2019',
				'20' => '2020',
				'21' => '2021',
				'22' => '2022',
			)
		));?>
	</div>
</div>

<?php echo $this->Form->input('creditcard_code', array('label' => 'Card Security Code', 'class' => 'span1', 'maxLength' => 4)); ?>

<br />

<?php endif; ?>

<?php echo $this->Form->button('<i class="icon-thumbs-up icon-white"></i> Submit Order', array('class' => 'btn btn-primary', 'ecape' => false)); ?>

<?php echo $this->Form->end(); ?>

<br />
<br />

