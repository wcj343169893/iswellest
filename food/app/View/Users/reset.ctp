<div class="login_container">
        <div class="login forgetwpd">
            <h3><?php echo __('Set a new password'); ?></h3>
            <?php echo $this->Session->flash('auth'); ?>
            <?php echo $this->Form->create('User'); ?>
            <?php 
            echo $this->Form->input('password');
            echo $this->Form->input('password_confirmation',array('type'=>'password'));
            ?>
            <p class="submit"><?php echo $this->Form->end(__('Submit')); ?></p>
        </div>

        <div class="login-help">
            <p>Have an account? <a href="login">Login</a>.</p>
            <p>Don't have an account? <a href=add>Join us</a>.</p>
        </div>
</div>