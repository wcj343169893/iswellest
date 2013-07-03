<div id="sidebar">
    <div class="box_p">
        <h2><?php echo __('Actions'); ?></h2>
        <ul>
            <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
            <?php if($current_user['role'] == 'admin'): ?>
            <li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
            <?php endif ?>
        </ul>
    </div>
</div>
<div id="product-detail" class="box_p">
<?php echo $this->Form->create('User'); ?>
    <h2><legend><?php echo __('Edit User'); ?></legend></h2>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('birth_date');
		echo $this->Form->input('gender');
		echo $this->Form->input('join_date');
		echo $this->Form->input('address');
		echo $this->Form->input('phone');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
        echo $this->Form->input('password_confirmation',array('type'=>'password'));
		echo $this->Form->input('email');
        if($current_user['role'] == 'admin'):
		echo $this->Form->input('role');
        endif;
	?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
