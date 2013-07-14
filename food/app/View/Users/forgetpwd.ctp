<div class="login_container">
        <div class="login forgetwpd">
            <h3><?php echo __('Forgot Password'); ?></h3>
            <?php echo $this->Session->flash('auth'); ?>
            <?php echo $this->Form->create('User'); ?>
            <?php echo $this->Form->input('Email',array('placeholder' => 'Email','name'=>'data[User][email]'));
            ?>
            <p class="submit"><?php echo $this->Form->end(__('Submit')); ?></p>
        </div>

        <div class="login-help">
            <p>Have an account? <a href="login">Login</a>.</p>
            <p>Don't have an account? <a href=add>Join us</a>.</p>
        </div>
</div>