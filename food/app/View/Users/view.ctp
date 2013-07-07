<?php echo $this->element("user_menu")?>
<div id="product-detail" class="box_p">
        <h2><?php  echo __('Personal Information'); ?></h2>
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

