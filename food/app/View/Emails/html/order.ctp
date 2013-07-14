<p>Shop Order:</p>

<p>First Name: <?php echo $shop['Order']['first_name'];?></p>

<p>Last Name: <?php echo $shop['Order']['last_name'];?></p>

<p>Email: <?php echo $shop['Order']['email'];?></p>

<p>Phone: <?php echo $shop['Order']['phone'];?></p>


<p>Billing Address: <?php echo $shop['Order']['billing_address'];?></p>

<p>Billing Address 2: <?php echo $shop['Order']['billing_address2'];?></p>
<p>
Billing City: <?php echo $shop['Order']['billing_city'];?></p>

<p>Billing State: <?php echo $shop['Order']['billing_state'];?></p>

<p>Billing Zip: <?php echo $shop['Order']['billing_zip'];?></p>
<p>
Billing Country: <?php echo $shop['Order']['billing_country'];?></p>
<p>

Shipping Address: <?php echo $shop['Order']['shipping_address'];?></p>
<p>
Shipping Address 2: <?php echo $shop['Order']['shipping_address2'];?></p>
<p>
Shipping City: <?php echo $shop['Order']['shipping_city'];?></p>
<p>
Shipping State: <?php echo $shop['Order']['shipping_state'];?></p>
<p>
Shipping Zip: <?php echo $shop['Order']['shipping_zip'];?></p>
<p>
Shipping Country: <?php echo $shop['Order']['shipping_country'];?></p>
<table>
  <tr>
    <th>Description</th>
    <th>Item Price</th>
    <th>Quantity</th>
    <th>Extended Price</th>
  </tr>
<?php foreach ($shop['OrderItem'] as $orderitem): ?>
	<tr>
	<td><?php echo $orderitem['Product']['name']; ?></td>			
	<td>$<?php echo $orderitem['Product']['price']; ?></td>		
	<td><?php echo $orderitem['quantity']; ?></td>
	<td>$<?php echo $orderitem['subtotal']; ?></td>
  </tr>
<?php endforeach; ?>
</table>
<p>Items:	<?php echo $shop['Order']['quantity'];?></p>
<p>Total:	$<?php echo $shop['Order']['total'];?></p>

