<div class="box_p">
	<h2>Hot Admissions</h2>
	<div class="product_sort">
		<?php echo $this->element("cooking/cooking_list",array("data"=>$begin_cooking,"order"=>1));?>
	</div>
</div>
<div class="box_p">
	<h2>Upcoming Admissions</h2>
	<div class="product_sort"><?php echo $this->element("cooking/cooking_list",array("data"=>$future_cooking,"order"=>2));?></div>
</div>
<div class="box_p">
	<h2>Being trained</h2>
	<div class="product_sort"><?php echo $this->element("cooking/cooking_list",array("data"=>$doing_cooking,"order"=>3));?></div>
</div>