<?php if(!empty($data)){?>
<ul class="cooking">
	<?php foreach($data as $k=>$v){?>
	<li class="cooking_i">
		<h6 class="title">
		<?php echo $this->Html->link($v["Cooking"]["name"], array('action' => 'view','controller'=>'cooking', $v["Cooking"]['id']),array("target"=>"_blank")); ?></h6>
		<!-- 
		<iframe width="420" height="360" src="<?php echo $v["Cooking"]["video_address"]?>" frameborder="0" allowfullscreen></iframe>
		 -->
	 	<?php if($order==2){?>
		<p>Start Order:<?php echo $this->Time->format($v["Cooking"]["start_order"])?></p>
	 	<?php }elseif ($order==3){?>
	 	
	 	<?php }else{?>
		<p>End Order:<?php echo $this->Time->format($v["Cooking"]["start_learning"])?></p>
		<?php }?>
		<p>Price:$<?php echo $v["Cooking"]["price"]?></p>
		<?php if($order==1){?>
			<?php if(empty($ischange)){?>
			  	<?php echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'buyclass'))); ?>
				<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $v['Cooking']['id'])); ?>
				<?php echo $this->Form->input('quantity', array('type' => 'hidden', 'value' => 1)); ?>
				<?php echo $this->Form->button('Buy', array('class' => 'btn btn-primary addtocart', 'id' => $v['Cooking']['id'], 'escape' => false));?>
				<?php echo $this->Form->end();?>
			<?php }elseif($v["Cooking"]['id']!=$meal_id){?>
			  	<?php echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'buyclass'))); ?>
				<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $v['Cooking']['id'])); ?>
				<?php echo $this->Form->input('quantity', array('type' => 'hidden', 'value' => 1)); ?>
				<?php echo $this->Form->input('change', array('type' => 'hidden', 'value' => 1)); ?>
				<?php echo $this->Form->button('Change', array('class' => 'btn btn-primary addtocart', 'id' => $v['Cooking']['id'], 'escape' => false));?>
				<?php echo $this->Form->end();?>
			
			<?php }?>
			<?php }?>
	</li>
	<?php }?>
</ul>
<div class="clear"></div>
<?php }else{?>
<div class="message t_a_l">No data</div>
<?php }?>