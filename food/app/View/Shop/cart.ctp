<?php $this->Html->addCrumb('Product', '/Products/index');?>
<?php $this->Html->addCrumb('Shopping Cart', '/shop/cart');?>
<?php echo $this->set('title_for_layout', 'Shopping Cart'); ?>

<?php echo $this->Html->script(array('cart.js'), array('inline' => false)); ?>


<?php if(empty($shop['OrderItem'])) : ?>
Shopping Cart is empty
<?php else: ?>
<?php echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'cartupdate'))); ?>
<hr>

<div id="content">
<table width="800px" cellspacing="0" cellpadding="5">
     <tr bgcolor="#61C4E1">
        <th width="180" align="left">Image</th>
        <th width="100" align="left">Name</th>
        <th width="180" align="left">Description</th>
        <th width="100" align="left">Price/100G</th>
        <th width="100" align="center">Quantity</th>
        <th width="60" align="center">Subtotal</th>
        <th width="90"></th>
      </tr>
<tbody>
    <?php $tabindex = 1; ?>
    <?php foreach ($shop['OrderItem'] as $item): ?>
        <tr id="row-<?php echo $item['Product']['id']; ?>">
            <td><?php echo $this->Html->image('/images/small/' . $item['Product']['photo'], array('class' => 'px60')); ?></td>
            <td><strong><?php echo $this->Html->link($item['Product']['name'], array('controller' => 'products', 'action' => 'view', 'slug' => $item['Product']['slug'])); ?></strong></td>
            <td><?php
                $string = $item['Product']['description'];
                $stringCut = substr($string, 0, 80);
                $string = substr($stringCut, 0, strrpos($stringCut, ' '));
                echo h($string)."...";?> &nbsp;</td>
            <td align="left" id="price-<?php echo $item['Product']['id']; ?>">$<?php echo $item['Product']['price']; ?></td>
            <td align="center"><?php echo $this->Form->input('quantity-' . $item['Product']['id'], array('div' => false, 'class' => 'numeric span1', 'label' => false, 'size' => 2, 'maxlength' => 2, 'tabindex' => $tabindex++, 'data-id' => $item['Product']['id'], 'value' => $item['weight'])); ?></td>
            <td align="left" id="subtotal-<?php echo $item['Product']['id']; ?>">$<?php echo $item['subtotal']; ?></td>
            <td align="center"><span class="remove" id="<?php echo $item['Product']['id']; ?>"></span></td>
        </tr>

    <?php endforeach; ?>
        <tr>
        </tr>
        <tr>
    <?php
    $subtotal = $shop['Order']['subtotal'];
    $GST = $subtotal*0.11;
     $total = $subtotal + $GST;
     ?>
            <td colspan="4" align="right">Have you modified your basket? Please click here to <a href="cart.ctp"><strong>Update</strong></a>&nbsp;&nbsp;</td>
            <td align="right" style="background:#aae6f8; font-weight:bold"> Subtotal: </td>
            <td align="left" style="background:#aae6f8; font-weight:bold"><span class="normal" id="subtotal"><?php echo $this->Number->currency($subtotal); ?></span></td>
            <td style="background:#aae6f8; font-weight:bold"> </td>
        </tr>
        <tr>
              <td colspan="4"></td>
              <td align="right" style="background:#6fdaf9; font-weight:bold"> Total GST: </td>
              <td align="left" style="background:#6fdaf9; font-weight:bold"><?php echo $this->Number->currency($GST); ?></span></td>
              <td style="background:#6fdaf9; font-weight:bold"> </td>
        </tr>
        <tr>
              <td colspan="4"></td>
              <td align="right" style="background:#61C4E1; font-weight:bold"> Total:</td>
              <td align="left" style="background:#61C4E1; font-weight:bold"><span class="red" id="total"><?php echo $this->Number->currency($total); ?></span></td>
              <td style="background:#61C4E1; font-weight:bold"> </td>
        </tr>
</tbody>
        <tr>
            <td>
                <?php echo $this->Html->link('<i class="icon-remove icon"></i> Clear Cart', array('controller' => 'shop', 'action' => 'clear'), array('class' => 'btn', 'escape' => false)); ?>
                &nbsp; &nbsp;
                <?php echo $this->Form->end(); ?>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
                <?php echo $this->html->link('Continue Shopping',array('controller' => 'products', 'action' => 'index'), array('class' => 'btn', 'escape' => false)) ?>
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
                <?php echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'step1'))); ?>
                <input type='image' name='submit' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif' border='0' align='top' alt='Check out with PayPal' class="sbumit" />
                <?php echo $this->Form->end(); ?>
            </td>
        </tr>
</table>
    </div>
<br />
<br />

<?php endif; ?>
