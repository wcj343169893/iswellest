<div class="t_head">最新产品肤</div>
<ul>
	<?php foreach($newsProducts as $product): ?>
		<li>
			<a href="/product/view/<?php echo $product["Product"]["product_cd"]?>" title="<?php echo $product["Product"]["product_name"]?>">
				<img src="<?php echo $product["Productphoto"]["url"]?>" height="20px" alt="<?php echo $product["Product"]["product_name"]?>"/>
				<?php echo $product["Product"]["product_name"]?>
				<?php echo $product["Product"]["product_name"];?>

				
			</a>
		</li> 
	<?php endforeach; ?> 
</ul>
<div class="clear"></div>
<div class="t_head"><a href="/product/category/1">基础护肤</a></div>
<ul>
	<?php foreach($base_products["data"] as $product): ?>
		<li>
			<a href="/product/view/<?php echo $product["Product"]["product_cd"]?>" title="<?php echo $product["Product"]["product_name"]?>">
				<img src="<?php echo $product["Productphoto"]["url"]?>" height="20px" alt="<?php echo $product["Product"]["product_name"]?>"/>
				<?php echo $product["Product"]["product_name"]?>
				<?php echo ($product["Product"]["product_name"]);?>
			</a>
		</li> 
	<?php endforeach; ?> 
</ul>
<div class="clear"></div>
<div class="t_head"><a href="/product/category/2">婴儿护肤</a></div>
<ul>
	<?php foreach($baby_products["data"] as $product): ?>
		<li>
			<a href="/product/view/<?php echo $product["Product"]["product_cd"]?>" title="<?php echo $product["Product"]["product_name"]?>">
				<img src="<?php echo $product["Productphoto"]["url"]?>" height="20px" alt="<?php echo $product["Product"]["product_name"]?>"/>
				<?php echo $product["Product"]["product_name"]?>
				<?php echo ($product["Product"]["product_name"]);?>
			</a>
		</li> 
	<?php endforeach; ?> 
</ul>
<div class="clear"></div>
<div class="t_head"><a href="/product/category/3">日常护理</a></div>
<ul>
	<?php foreach($day_products["data"] as $product): ?>
		<li>
			<a href="/product/view/<?php echo $product["Product"]["product_cd"]?>" title="<?php echo $product["Product"]["product_name"]?>">
				<img src="<?php echo $product["Productphoto"]["url"]?>" height="20px" alt="<?php echo $product["Product"]["product_name"]?>"/>
				<?php echo $product["Product"]["product_name"]?>
				<?php echo ($product["Product"]["product_name"]);?>
			</a>
		</li> 
	<?php endforeach; ?> 
</ul>
<div class="clear"></div>
<div class="t_head"><a href="/product/category/4">瘦身美体</a></div>
<ul>
	<?php foreach($slimming_products["data"] as $product): ?>
		<li>
			<a href="/product/view/<?php echo $product["Product"]["product_cd"]?>" title="<?php echo $product["Product"]["product_name"]?>">
				<img src="<?php echo $product["Productphoto"]["url"]?>" height="20px" alt="<?php echo $product["Product"]["product_name"]?>"/>
				<?php echo $product["Product"]["product_name"]?>
				<?php echo ($product["Product"]["product_name"]);?>
			</a>
		</li> 
	<?php endforeach; ?> 
</ul>