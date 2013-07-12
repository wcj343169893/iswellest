<?php echo $this->element("user_menu")?>
<div id="product-detail" class="box_p">
 	<h2><?php  echo __('My Cooking Class'); ?></h2>
 	<table style="width: 100%">
 		<thead>
 			<tr>
 				<th>Class Name</th>
 				<th>Start Learning</th>
 				<th>Action</th>
 			</tr>
 		</thead>
 		<?php if(!empty($data)){?>
 		<tbody>
 		<?php foreach($data as $k=>$v){?>
 			<tr>
 				<td><?php echo $v["Cooking"]["name"]?></td>
 				<td><?php echo $this->Time->format("Y-m-d",$v["Cooking"]["start_learning"])?></td>
 				<td>
 					<?php if($v["Cooking"]["start_learning"]>time()){?>
 						<?php echo $this->Form->postLink(__('Meal class'), array('action' => 'meal', $v["CookingOrder"]['id'],$v["Cooking"]['id']), null, __('Are you sure you want to meal : %s?', $v["Cooking"]['name'])); ?>
 					<?php }?>
 					<?php echo $this->Html->link(__('View'), array('action' => 'view','controller'=>'cooking', $v["Cooking"]['id']),array("target"=>"_blank")); ?>
 				</td>
 			</tr>
 		<?php }?>
 		</tbody>
 		<?php }?>
 	</table>
</div>