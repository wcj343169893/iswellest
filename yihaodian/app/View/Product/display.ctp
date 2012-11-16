<ul>
	<?php foreach($newsProducts as $product): ?>
		<li>
			<a href="/product/view/<?php echo $product["Product"]["product_cd"]?>" title="<?php echo $product["Product"]["product_name"]?>">
				<img src="<?php echo $product["Productphoto"]["url"]?>" height="20px" alt="<?php echo $product["Product"]["product_name"]?>"/>
				<?php echo $product["Product"]["product_name"]?>
				<?php echo $this->Text->truncate(($product["Product"]["product_name"]),20);?>

				
			</a>
		</li> 
	<?php endforeach; ?> 
</ul>
<p>JSON格式，方便调试数据结构 http://www.bejson.com/go.html?u=http://www.bejson.com/jsonview2/</p>
<?php echo json_encode($newsProducts);?>