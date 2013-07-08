<?php if(!empty($data)){?>
<ul class="cooking">
	<?php foreach($data as $k=>$v){?>
	<li class="cooking_i">
		<h6 class="title"><?php echo $v["Cooking"]["name"]?></h6>
		<!-- 
		<iframe width="420" height="360" src="<?php echo $v["Cooking"]["video_address"]?>" frameborder="0" allowfullscreen></iframe>
		 -->
	</li>
	<?php }?>
</ul>
<div class="clear"></div>
<?php }?>