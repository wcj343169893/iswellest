<?php $picUrl = (!empty($productInfo['product_pic_url']))?OMS_API_PHOTO_ROOT_URL.$productInfo['product_pic_url']:'/image/front/none_90.jpg';?>
    <p class="imgCenter">
        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $productInfo['product_cd'];?><?php if (!empty($giftFlg)):?>/gift_flg:true<?php endif;?>" title="<?php echo $productInfo['product_name'];?>"><img src="http://www.ibale.com<?php echo $picUrl;?>" width="110" height="110" /> </a>
    </p>
    <p class="productName">
        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $productInfo['product_cd'];?><?php if (!empty($giftFlg)):?>/gift_flg:true<?php endif;?>" title="<?php echo $productInfo['product_name'];?>"><?php echo $productInfo['product_name'];?></a>
    </p>
    <p>
    <?php if (!empty($productInfo['sale_price']) && !empty($productInfo['retail_price']) && ($productInfo['retail_price'] > $productInfo['sale_price'])):?>
        <del>
            ￥
            <?php echo $number->currency($productInfo['retail_price'], '');?>
        </del>
        <b>￥<?php echo $number->currency($productInfo['sale_price'], '');?> </b>
    <?php elseif(!empty($productInfo['sale_price'])):?>
        <b>￥<?php echo $number->currency($productInfo['sale_price'], '');?> </b>
    <?php else:?>
        <b>&nbsp;</b>
    <?php endif;?>
     <br>
        <span class="bluetxt display-block"><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $productInfo['product_cd'];?>/selected:estimation#tab"><?php echo !empty($productInfo['estimatino_count'])?$productInfo['estimatino_count']:'0';?>人评论</a> </span>
    </p><?php if ($productInfo['sale_rule_count'] > 0):?><span class="sale"></span><?php endif;?>
