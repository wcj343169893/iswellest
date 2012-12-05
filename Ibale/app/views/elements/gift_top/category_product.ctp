<?php $id = $this->data[$this->name]['id'];?>
<div id="categoryProduct<?php echo $key;?>">
    <h4>
        分栏<label id="categoryProductNo"><?php echo $appNumber->alphToChinese($index);?></label> 
        <a href="javaScript:void(0);" class="pageDown" onClick="javaScript:moveUp(this);">[上移]</a> 
        <a href="javaScript:void(0);" class="pageDown" onClick="javaScript:moveDown(this);">[下移]</a> 
        <a href="javaScript:void(0);" class="del" onClick="javaScript:delCategoryProduct(this);">[删除]</a>
        <?php echo $appForm->hidden("{$pageSettingType}.category_product.{$key}.order_number", array('id'=>'categoryOrderNumber','value'=>($key+1)));?>
    </h4>
    <div class="column clearfix">
        <p>
            栏目名称<?php echo $appForm->text("{$pageSettingType}.category_product.{$key}.category_product_name");?>
            &nbsp;&nbsp;对应送礼对象
            <?php echo $appForm->select("{$pageSettingType}.category_product.{$key}.gift_send_to", $giftSendToList, null, array('empty'=>false));?>
            &nbsp;&nbsp;对应送礼场合
            <?php echo $appForm->select("{$pageSettingType}.category_product.{$key}.gift_send_date", $giftSendDateList, null, array('empty'=>false));?>
            <?php echo $appForm->error("{$pageSettingType}.category_product.{$key}.category_product_name", '栏目名称');?>
            <?php echo $appForm->error("{$pageSettingType}.category_product.{$key}.gift_send_to", '对应送礼对象');?>
            <?php echo $appForm->error("{$pageSettingType}.category_product.{$key}.gift_send_date", '对应送礼场合');?>
            <?php echo $appForm->error("{$pageSettingType}.category_product.{$key}.gift_send", '对应送礼对象和对应送礼场合');?>
        </p>
        <div class="clearfix">
            <div class="leftContent">
                <div class="leftAd">
                    <div class="ad">
                        <p class="title">左主广告</p>
                    <p>
                        图片： 
                        <?php echo $appForm->hidden("{$pageSettingType}.category_product.{$key}.leftmain_ad.path", array('id'=>"leftmainAd{$key}PicPath"));?>
                        <?php echo $appForm->file("{$pageSettingType}.category_product.{$key}.leftmain_ad.pic", array('name'=>'filename','id'=>"leftmainAd{$key}Pic", 'size'=>'8', 'onchange'=>"ajaxUploadImg(this, '".UPLOAD_PIC_ROOT.DS.splitWordsWithUnderLine($pageSettingType)."/{$id}/category_product/{$key}/left_ad/{$index}/', '210', '230', 'pLeftmainAd{$key}Pic', 'leftmainAd{$key}PicPath');"));?>
                        <?php echo $appForm->error("{$pageSettingType}.category_product.{$key}.leftmain_ad.path", '图片');?>
                    </p>
                    <p class="f_11 gray">jpg,png,gif,尺寸210×230,大小400K内</p>
                    <p class="img" id="<?php echo 'pLeftmainAd'.$key.'Pic';?>">
                    <?php $url = '/image/admin/img_7.gif';?>
                    <?php if (!empty($this->data[$pageSettingType]['category_product'][$key]['leftmain_ad']['path']) && file_exists(WWW_ROOT.$this->data[$pageSettingType]['category_product'][$key]['leftmain_ad']['path'])):?>
                        <?php $url = $this->data[$pageSettingType]['category_product'][$key]['leftmain_ad']['path'];?>
                    <?php endif;?>
                        <img src="<?php echo $url;?>" width="180" height="245" />
                    </p>
                    <p>
                        链接： <?php echo $appForm->text("{$pageSettingType}.category_product.{$key}.leftmain_ad.url", array('class'=>'input_175'));?>
                        <?php echo $appForm->error("{$pageSettingType}.category_product.{$key}.leftmain_ad.url",'链接');?>
                    </p>
                    <p>
                        说明： <?php echo $appForm->text("{$pageSettingType}.category_product.{$key}.leftmain_ad.comment", array('class'=>'input_175'));?>
                        <?php echo $appForm->error("{$pageSettingType}.category_product.{$key}.leftmain_ad.comment",'说明');?>
                    </p>
                    </div>
                </div>
                <div class="border_top"></div>
                <h4>商品</h4>
            <?php for($i=1;$i<=3;$i++):?>
                <div class="productId">
                    <p>
                        商品<?php echo $appNumber->alphToChinese($i);?>ID 
                        <?php echo $appForm->text("{$pageSettingType}.category_product.{$key}.product.{$i}.product_cd", array('id'=>"categoryProductProductCd{$key}_{$i}", 'class'=>'input_100 gray'));?>
                        <input class="btnWidth" type="button" name="button" id="button" value="提交" onClick="javaScript:getCategoryProductProductInfo('categoryProductProductCd<?php echo $key;?>_<?php echo $i;?>','categoryProductProductCd<?php echo $key;?>','categoryProductProductName<?php echo $key;?>_<?php echo $i;?>','categoryProductProductPic<?php echo $key;?>_<?php echo $i;?>','categoryProductCategory<?php echo $key;?>_1','categoryProductCategory<?php echo $key;?>_2','categoryProductCategory<?php echo $key;?>_3', true);"/>
                         <?php echo $appForm->error("{$pageSettingType}.category_product.{$key}.product.{$i}.product_cd", '商品ID');?>
                         <?php echo $appSession->flash("CategoryProductProductCdIsDuplicate{$key}_{$i}");?>
                    </p>
                    <p class="productImg">
                    <?php $url = '/image/admin/img_2.gif';?>
                    <?php if (!empty($this->data[$pageSettingType]['category_product'][$key]['product'][$i]['product_pic_url'])):?>
                        <?php $url = OMS_API_PHOTO_ROOT_URL.$this->data[$pageSettingType]['category_product'][$key]['product'][$i]['product_pic_url'];?>
                    <?php endif;?>
                        <img id="categoryProductProductPic<?php echo $key;?>_<?php echo $i;?>" src="<?php echo $url;?>" width="120" height="120" />
                    </p>
                    <p>
                        <?php echo $appForm->text("{$pageSettingType}.category_product.{$key}.product.{$i}.product_name", array('id'=>"categoryProductProductName{$key}_{$i}",'class'=>'input_200 gray', 'disabled'=>'disabled'));?>
                    </p>
                </div>
            <?php endfor;?>
            </div>
        </div>
    </div>
</div>
