<?php if(isset($recs) && !empty($recs)):?>
<?php elseif(isset($_COOKIE['browsed_product_cd'])):?>
    <?php $browsedProductCd = $_COOKIE['browsed_product_cd'];?>
    <?php $browsedProductCd = explode(',', $browsedProductCd);?>
    <?php unset($browsedProductCd[array_search($currentProductCd, $browsedProductCd)]);?>
    <?php $recs = $this->requestAction('/product/cached_product/product_cds:'.implode(',',$browsedProductCd));?>
<?php else:?>
    <?php $recs = array();?>
<?php endif;?>
<?php if (!empty($recs)):?>
<div class="mainCenter m_10">
<link type="text/css" rel="stylesheet" href="/css/front/elastislide.css" />
<script type="text/javascript" src="/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="/js/jquery.elastislide.js"></script>
<div class="u_goods floatL">
			<div class="u_g_title"><span>我最近浏览的商品</span></div>
			<div class="goods">
				<div id="carousel" class="es-carousel-wrapper">
			        <div class="es-carousel">
			            <ul>
			            	<?php foreach($recs as $k => $v):?>
				                <li>
				                	<a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $v['product_cd'];?><?php if (!empty($giftFlg)):?>/gift_flg:true<?php endif;?>"><img src="http://www.ibale.com<?php echo $v["product_pic_url"];?>" alt="image01" /></a>
				                	<p class="pname"><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $v['product_cd'];?><?php if (!empty($giftFlg)):?>/gift_flg:true<?php endif;?>"><?php echo $v["product_name"]?></a></p>
				                	<p>
								    	<?php if (!empty($v['sale_price']) && !empty($v['retail_price']) && ($v['retail_price'] > $v['sale_price'])):?>
									        <b>￥<?php echo $number->currency($v['sale_price'], '');?> </b>
									        <del>￥<?php echo $number->currency($v['retail_price'], '');?></del>
									    <?php elseif(!empty($v['sale_price'])):?>
									        <b>￥<?php echo $number->currency($v['sale_price'], '');?> </b>
									    <?php else:?>
									        <b>&nbsp;</b>
									    <?php endif;?>
								    </p>
				                </li>
					        <?php endforeach;?>
			            </ul>
			        </div>
			    </div>
			</div>
		</div>
<script type="text/javascript">
	$(document).ready(function(){
			$('#carousel').elastislide({
			    imageW 	: 110,
			    margin	:22,
			    minItems: 5
			});
		});
</script>
</div>
<?php endif;?>