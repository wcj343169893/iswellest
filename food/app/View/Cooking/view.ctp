<div>
	<h1><?php echo $data["Cooking"]["name"]?></h1>
	<ul>
		<li>Price : <?php echo $data["Cooking"]["price"]?></li>
		<li>Start Order : <?php echo $this->Time->format("Y-m-d",$data["Cooking"]["start_order"])?></li>
		<li>Start Learning : <?php echo $this->Time->format("Y-m-d",$data["Cooking"]["start_learning"])?></li>
		<li>End Learning : <?php echo $this->Time->format("Y-m-d",$data["Cooking"]["end_learning"])?></li>
	</ul>
	<h2>Video</h2>
	<div class="video">
		<!-- 
		<iframe width="420" height="360" src="<?php echo $data["Cooking"]["video_address"]?>" frameborder="0" allowfullscreen></iframe>
		 -->
	</div>
	<h2>Description</h2>
	<div class="desctiption">
		<?php echo $data["Cooking"]["description"]?>
	</div>
</div>