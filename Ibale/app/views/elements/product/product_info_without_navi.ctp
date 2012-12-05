<?php $picUrl = (!empty($productInfo['product_pic_url']))?OMS_API_PHOTO_ROOT_URL.$productInfo['product_pic_url']:'/image/front/none_90.jpg';?>
    <p>
        <span class="productImg"><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $productInfo['product_cd'];?><?php if (!empty($giftFlg)):?>/gift_flg:true<?php endif;?>" title="<?php echo $productInfo['product_name'];?>"><img src="<?php echo $picUrl;?>" width="90" height="90"></a></span>
        <span class="productName"><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $productInfo['product_cd'];?><?php if (!empty($giftFlg)):?>/gift_flg:true<?php endif;?>" title="<?php echo $productInfo['product_name'];?>"><?php echo $text->truncate($productInfo['product_name'], 20, array('ending' => '...'));?> </a></span>
    <?php if ((($this->name == "Shopping" && $this->action == "bag") ||($this->name == 'Member' && $this->action == 'mypage')) && $productInfo['enable_sale']):?>
        <span><a href="javascript:void(0);" onclick="javascript:addToBag('<?php echo $productInfo['product_cd'];?>');"><img src="/image/front/s_cart.png" /></a></span>
    <?php elseif ((($this->name == "Shopping" && $this->action == "bag") ||($this->name == 'Member' && $this->action == 'mypage')) && !$productInfo['enable_sale']):?>
    	<span><img src="/image/front/s_cart_2.png" /></span>
    <?php endif;?>
    </p>
    <p>
    <?php if (!empty($productInfo['sale_price']) && !empty($productInfo['retail_price']) && ($productInfo['retail_price'] > $productInfo['sale_price'])):?>
        价格：
        <del>
            ￥
            <?php echo $number->currency($productInfo['retail_price'], '');?>
        </del>
        <b>￥<?php echo $number->currency($productInfo['sale_price'], '');?> </b>
    <?php elseif(!empty($productInfo['sale_price'])):?>
        价格：
        <b>￥<?php echo $number->currency($productInfo['sale_price'], '');?> </b>
    <?php else:?>
        <b>&nbsp;</b>
    <?php endif;?>
     <br>
    </p>
    <?php if ($productInfo['sale_rule_count'] > 0):?><span class="sale"></span><?php endif;?>
