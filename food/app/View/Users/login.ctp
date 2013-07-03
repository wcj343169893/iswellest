<section class="login_container">
        <div class="login">
            <h3><?php echo __('Welcome to Blu Waters'); ?></h3>
            <?php echo $this->Session->flash('auth'); ?>
            <?php echo $this->Form->create('User'); ?>
            <?php   echo $this->Form->input('username',array('placeholder' => 'Username'));
            echo $this->Form->input('password',array('placeholder' => 'Password'));
            ?>
            <p class="remember_me">
                <label>
                    <input type="checkbox" name="remember_me" id="remember_me">
                    Remember me on this computer
                </label>
            </p>
            <p class="submit"><?php echo $this->Form->end(__('Login')); ?></p></br></br>
        </div>

        <div class="login-help">
            <p>Forgot your password? <a href="index.html">Click here to reset it</a>.</p>
            <p>Don't have an account? <a href=add>Join us</a>.</p>
        </div>