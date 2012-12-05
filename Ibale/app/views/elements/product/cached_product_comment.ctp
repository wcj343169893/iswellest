<?php $productCd = $detail['Product']['product_cd'];?>
<?php $ret = $this->requestAction('/product/cached_product_comment/product_cd:'.$productCd);?>
<!-- 商品详细 -->
<?php if($detail['Product']['custom_page_flg'] == ACTIVE_FLG_TRUE && !empty($detail['Product']['custom_content'])):?>
    <p class="txt">
    <?php echo $detail['Product']['custom_content'];?>
    </p>
<?php else:?>
    <?php $photoCount = count($ret['productPhotoList'][$productCd]);?>
    <?php $descCount  = count($ret['productDescList']);?>
    <?php $maxCount   = ($photoCount > $descCount)?$photoCount:$descCount;?>
    <?php $maxPhotoDisplayOrder = ($photoCount-1 > 0)?$ret['productPhotoList'][$productCd][$photoCount-1]['ProductPhoto']['display_order']:0;?>
    <?php $maxDescDisplayOrder  = ($descCount - 1 > 0)?$ret['productDescList'][$descCount - 1]['ProductDesc']['display_order']:0;?>
    <?php $maxDisplayOrder      = ($maxPhotoDisplayOrder > $maxDescDisplayOrder)?$maxPhotoDisplayOrder:$maxDescDisplayOrder;?>
    <?php $count    = ($maxCount < $maxDisplayOrder)?($maxDisplayOrder + 1):$maxCount;?>
    <?php $dataList = array();?>
    <?php $curPhotoDisplayOrder = 0;?>
    <?php $curDescDisplayOrder  = 0;?>
    <?php $pIndex = 0;?>
    <?php $dIndex = 0;?>
    <?php for($i = 0; $i < $count; $i++):?>
        <?php $curPhotoDisplayOrder = isset($ret['productPhotoList'][$productCd][$pIndex]['ProductPhoto']['display_order'])?$ret['productPhotoList'][$productCd][$pIndex]['ProductPhoto']['display_order']:$curPhotoDisplayOrder;?>
        <?php $curDescDisplayOrder  = isset($ret['productDescList'][$dIndex]['ProductDesc']['display_order'])?$ret['productDescList'][$dIndex]['ProductDesc']['display_order']:$curDescDisplayOrder;?>
        <?php if (($curDescDisplayOrder < $curPhotoDisplayOrder || $photoCount == $pIndex) && isset($ret['productDescList'][$dIndex])):?>
            <?php $dataList[] = $ret['productDescList'][$dIndex];?>
            <?php $dIndex++;?>
        <?php elseif (($curDescDisplayOrder > $curPhotoDisplayOrder || $descCount == $dIndex) && isset($ret['productPhotoList'][$productCd][$pIndex])):?>
            <?php $dataList[] = $ret['productPhotoList'][$productCd][$pIndex];?>
            <?php $pIndex++;?>
        <?php elseif (isset($ret['productPhotoList'][$productCd][$pIndex]) && isset($ret['productDescList'][$dIndex])):?>
            <?php $dataList[] = $ret['productPhotoList'][$productCd][$pIndex];?>
            <?php $pIndex++;?>
            <?php $dataList[] = $ret['productDescList'][$dIndex];?>
            <?php $dIndex++;?>
        <?php endif;?>
    <?php endfor;?>
    <?php foreach($dataList as $key => $value):?>
        <?php if (!empty($value['ProductPhoto'])):?>
            <p style="margin-bottom:10px;text-align:center;">
            <img src="<?php echo OMS_API_PHOTO_ROOT_URL.$value['ProductPhoto']['url'];?>" alt="<?php echo $value['ProductPhoto']['memo'];?>"/>
            </p>
        <?php endif;?>
        <?php if (!empty($value['ProductDesc'])):?>
            <div class="txt">
            <?php if (!empty($value['ProductDesc']['desc_title'])):?>
                <span class="display-block subTitle"><?php echo $value['ProductDesc']['desc_title'];?></span>
                <hr color="#D0E8F7" style="margin-top: 2px;"/>
            <?php endif;?>
            <p class="txt" >
            <?php echo nl2br($value['ProductDesc']['body']);?>
            </p>
            </div>
        <?php endif;?>
    <?php endforeach;?>
<?php endif;?>
