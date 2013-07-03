<section class="login_container">
    <div class="login">
        <?php echo $this->Form->create('User'); ?>
        <h3><?php echo __('Register'); ?></h3>
        <?php
        echo $this->Form->input('first_name');
        echo $this->Form->input('last_name');
        echo $this->Form->input('birth_date');
        echo $this->Form->input('gender');
        echo $this->Form->input('address');
        echo $this->Form->input('phone');
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('password_confirmation',array('type'=>'password'));
        echo $this->Form->input('email');
        ?>

        <p class="submit"><?php echo $this->Form->end(__('Submit')); ?></p></br></br>
    </div>