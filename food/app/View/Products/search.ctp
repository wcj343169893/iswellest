<div id="sidebar">
    <!-- Search -->
    <div class="box search">
        <h2>Search by</h2>
        <div class="box-content">
            <?php echo $this->Form->create();
            echo $this->Form->input('Keyword', array('label' =>'Search','class' => 'field'));
            echo $this->Form->input('Category',array ('options'=>$categories, 'empty' => '--Select a Category--','label'=>'Category','class' => 'field'));?>

            <?php echo $this->Form->submit('Search',array('class' => 'search-submit', 'name' => 'search')); ?>
        </div>
    </div>
    <!-- End Search -->

    <!-- Categories -->
    <div class="box categories">
        <h2>Categories</h2>
        <div class="box-content">
            <?php if($current_user['role'] == 'admin'): ?>

            <?php echo $this->Html->link('Categories', '/categories', array('class' => 'button', 'target' => '_blank'));?>
            <?php endif; ?>

        </div>
    </div>

</div>

<div id="product-detail" class="box_p">
    <h2><?php echo __('Products'); ?></h2>
    <div class="product_sort">
        <?php echo $this->Paginator->sort('name','Name'); ?>
    <?php echo $this->Paginator->sort('cateID','Category');?>
    <?php echo $this->Paginator->sort('price','Price'); ?>
</div>
    </br></br>
    <?php foreach ($products as $product): ?>
    <table>
        <td>
            <div class="product"><?php echo $this->Html->image($product['Product']['image'], array('alt' => 'CakePHP', 'height' => 120, 'width' => 130));?>
                <div class="product_text">
                    <h3><?php echo h($product['Product']['name']); ?>&nbsp;</h3>
                    <p><?php
               $string = $product['Product']['description'];
               $stringCut = substr($string, 0, 200);
               $string = substr($stringCut, 0, strrpos($stringCut, ' '));
               echo h($string);
               echo $this->Html->link(__('...Detail'), array('action' => 'view', $product['Product']['id']));?> &nbsp;<br /><br />
        </td>

        <td>
            <span class="price"><?php echo h($product['Product']['price']); ?>/KG</span>
            <?php if($current_user['id'] == $product['Product']['id'] || $current_user['role'] == 'admin'): ?>
            <?php echo $this->Html->link(__('Add'), array('action' => 'add')); ?>
            <?php echo $this->Html->link(__('View'), array('action' => 'view', $product['Product']['id'])); ?>
            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $product['Product']['id'])); ?>
            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $product['Product']['id']), null, __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?>
            <?php endif; ?>
            </p>
        </td>
</div>
</div>

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

