<?php $picUrl = (!empty($productInfo['product_pic_url']))?OMS_API_PHOTO_ROOT_URL.$productInfo['product_pic_url']:'/image/front/none_90.jpg';?>
    <a class="imgWrap" href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $productInfo['product_cd'];?><?php if (!empty($giftFlg)):?>/gift_flg:true<?php endif;?>" title="<?php echo $productInfo['product_name'];?>"><img height="100" width="100" src="<?php echo $picUrl;?>"><?php if ($productInfo['sale_rule_count'] > 0):?><span class="sale2"></span><?php endif;?></a>
    <div class="img_detail">
        <p>
            <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $productInfo['product_cd'];?><?php if (!empty($giftFlg)):?>/gift_flg:true<?php endif;?>" title="<?php echo $productInfo['product_name'];?>"><?php echo $text->truncate($productInfo['product_name'], 20, array('ending' => '...'));?></a>
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
         <span class="bluetxt"><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $productInfo['product_cd'];?>/selected:estimation#tab"><?php echo !empty($productInfo['estimatino_count'])?$productInfo['estimatino_count']:'0';?>人评论</a></span>
        </p>
    </div>