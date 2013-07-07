<section class="login_container">
    <div class="login">
        <?php echo $this->Form->create('User'); ?>
        <h3><?php echo __('Register'); ?></h3>
        <?php
        echo $this->Form->input('first_name');
        echo $this->Form->input('last_name');
        echo $this->Form->input('birth_date',array('label' => 'Birthday','dateFormat' => 'DMY','minYear' => date('Y') - 70,'maxYear' => date('Y') - 18,"class"=>"birthdays"));
        echo $this->Form->input('gender',array("type"=>"radio","options"=>array("M"=>"male","F"=>"female"),"value"=>"M"));
        echo $this->Form->input('address');
        echo $this->Form->input('phone');
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('password_confirmation',array('type'=>'password'));
        echo $this->Form->input('email');
        ?>

        <p class="submit"><?php echo $this->Form->end(__('Submit')); ?></p>
    </div>
</section>