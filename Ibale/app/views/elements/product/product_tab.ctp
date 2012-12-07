<?php if(!empty($product_tabs)):?>
<ol>
<?php foreach ($product_tabs as $k=>$v):?>
	<li>
		<a title="<?php echo $v["product_name"]?>" href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $v['product_cd'];?><?php if (!empty($giftFlg)):?>/gift_flg:true<?php endif;?>">
		<img width="155px" height="160px" src="<?php echo $v["product_pic_url"]?>" alt="<?php echo $v["product_name"]?>"/></a>
		<p class="product_name"><a title="<?php echo $v["product_name"]?>" href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $v['product_cd'];?><?php if (!empty($giftFlg)):?>/gift_flg:true<?php endif;?>">
		<?php if(!empty($v["brank_name"])){echo '['.$v["brank_name"].']';}?><?php echo $v["product_name"]?>
		</a></p>
		<p>
			<?php if (!empty($v['sale_price']) && !empty($v['retail_price']) && ($v['retail_price'] > $v['sale_price'])):?>
		        <b>￥<?php echo $number->currency($v['sale_price'], '');?></b> 
		        <del>￥<?php echo $number->currency($v['retail_price'], '');?></del>
		    <?php elseif(!empty($v['sale_price'])):?>
		        <b>￥<?php echo $number->currency($v['sale_price'], '');?> </b>
		    <?php else:?>
		        <b>&nbsp;</b>
		    <?php endif;?>
		</p>
	</li>
	<?php endforeach;?>
</ol>
<?php endif;?>
<div class="clear"></div>