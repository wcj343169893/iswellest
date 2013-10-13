<div id="product-detail" class="box_p">
 <?php echo $this->Session->flash(); ?>
        <?php echo $this->Form->create('UserAddress'); ?>
        <?php
        echo $this->Form->input('first_name');
        echo $this->Form->input('last_name');
        echo $this->Form->input('phone');
        echo $this->Form->input('shipping_country',array("label"=>"country"));
        echo $this->Form->input('shipping_state',array("label"=>"state"));
        echo $this->Form->input('shipping_zip',array("label"=>"zip"));
        echo $this->Form->input('shipping_city',array("label"=>"city"));
        echo $this->Form->input('shipping_address',array("label"=>"address"));
        echo $this->Form->input('shipping_address2',array("label"=>"address2"));
        ?>
       <?php echo $this->Form->end(array("label"=>__('Submit'),"class"=>"btn","id"=>"address_add_submit")); ?>
</div>