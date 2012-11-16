<div class="t_head">基础护肤</div>
<div>
	<form action="/product/category/<?php echo $cid;?>/1">
		<label for="title">标题：</label><input id="title" name="title" class="search" type="search" value="<?php echo $title;?>"/>
			排序：<select name="order">
				<option value="id" <?php if(empty($order) || $order=="id"){echo "selected";}?>>编号</option>
				<option value="price" <?php if(!empty($order) && $order=="price"){echo "selected";}?>>价格</option>
				<option value="brank" <?php if(!empty($order) && $order=="brank"){echo "selected";}?>>品牌</option>
			</select>
		<input type="submit" value="搜索"/>
	</form>
</div>
<div class="clear"></div>
<ul>
	<?php foreach($products["data"] as $product): ?>
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
<div class="paging"><?php $searchs=empty($title)?"":"?title=".$title;?>
	<?php if($products["nowPage"]>1){?>
	<span class="prev"><a href="/product/category/<?php echo $cid;?>/<?php echo $products["nowPage"]-1;?><?php echo $searchs;?>">上一页</a></span>
	<?php }?>
	<span class="current"><a href="javascript:;"><?php echo $products["nowPage"];?></a></span>
	<?php if($products["nowPage"]<$products["totalPage"]){?>
	<span class="next"><a href="/product/category/<?php echo $cid;?>/<?php echo $products["nowPage"]+1;?><?php echo $searchs;?>">下一页</a></span>
	<?php }?>
	<?php echo $products["nowPage"]."/".$products["totalPage"]?>
</div>