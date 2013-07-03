<div id="sidebar">
        <div class="box_p">
        <h2><?php echo __('Actions'); ?></h2>
            <div class="box-content">
        <ul>
            <li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'],'class' => 'search-submit')); ?> </li>
            <?php if($current_user['role'] == 'admin'): ?>
                <li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id'],'class' => 'search-submit'), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
                <li><?php echo $this->Html->link(__('List Users'), array('action' => 'index','class' => 'search-submit')); ?> </li>
                <li><?php echo $this->Html->link(__('New User'), array('action' => 'add','class' => 'search-submit')); ?> </li>
            <?php endif ?>
        </ul>
          </div>

        </div>
</div>


<div id="product-detail" class="box_p">
        <h2><?php  echo __('Personal Information'); ?></h2>
    </br></br>
    <dl>

            <dt>
                <?php echo __('First Name'); ?>&nbsp;
                <?php echo h($user['User']['first_name']); ?>

            </dt></br>
            <dt><?php echo __('Last Name'); ?>&nbsp;
                <?php echo h($user['User']['last_name']); ?>

            </dt></br>
            <dt><?php echo __('Birth Date'); ?>&nbsp;
                <?php echo h($user['User']['birth_date']); ?>

            </dt></br>
            <dt><?php echo __('Gender'); ?>&nbsp;
                <?php echo h($user['User']['gender']); ?>

            </dt></br>
            <dt><?php echo __('Join Date'); ?>&nbsp;
                <?php echo h($user['User']['join_date']); ?>

            </dt></br>
            <dt><?php echo __('Address'); ?>&nbsp;
                <?php echo h($user['User']['address']); ?>

            </dt></br>
            <dt><?php echo __('Phone'); ?>&nbsp;
                <?php echo h($user['User']['phone']); ?>

            </dt></br>
            <dt><?php echo __('Email'); ?>&nbsp;
                <?php echo h($user['User']['email']); ?>

            </dt></br>
        </dl>
    </div>

