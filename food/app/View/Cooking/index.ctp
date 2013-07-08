<div class="box_p">
	<h2>Hot Admissions</h2>
	<div class="product_sort">
		<?php echo $this->element("cooking/cooking_list",array("data"=>$begin_cooking));?>
	</div>
</div>
<div class="box_p">
	<h2>Upcoming Admissions</h2>
	<div class="product_sort"><?php echo $this->element("cooking/cooking_list",array("data"=>$future_cooking));?></div>
</div>
<div class="box_p">
	<h2>Being trained</h2>
	<div class="product_sort"><?php echo $this->element("cooking/cooking_list",array("data"=>$doing_cooking));?></div>
</div>