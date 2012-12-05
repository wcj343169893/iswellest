<?php $this->page_props['title'] = '赠送礼物'.' - '.__('info.siteNameCN', true);?>
<!-- main -->
<h2 class="crumbList">
    <a href="<?php echo HTTP_HOME_PAGE_URL;?>">首页</a> > 赠送礼物
</h2>
<div class="mainCenter clearfix m_10_b">
    <?php echo $this->element('gift_top/left_navi');?>
    <div class=" mainRight">
    <div class="padding-bottom">
        <div class="focusPics">
        <?php echo $this->element('page_setting/focus_pic_disp');?>
        </div>
    </div>
    <?php foreach($this->data['GiftTop']['category_product'] as $key => $value):?>
        <!-- 送父母 -->
        <h3 class="categorytopTitle2 padding-top-10"><?php echo $value['category_product_name'];?></h3>
        <div class="giftSort bottom clearfix">
            <div class="csLeft">
                <a href="<?php echo $value['leftmain_ad']['url'];?>" title="<?php echo $value['leftmain_ad']['comment'];?>"><img src="<?php echo $value['leftmain_ad']['path'];?>" alt="<?php echo $value['leftmain_ad']['comment'];?>"/></a>
            </div>
            <div class="csRight">
                <ul>
                <?php foreach($value['product'] as $k => $v):?>
                    <?php $this->set('productInfo', $v);?>
                    <?php $this->set('giftFlg', true);?>
                    <li style="text-align:center">
                    <?php echo $this->element('product/category_product_info');?>
                    </li>
                <?php endforeach;?>
                </ul>
            </div>
        </div>
        <!-- 送父母 end -->
    <?php endforeach;?>
    </div>
</div>
<!-- main end -->
<script type="text/javascript">
function changeSortOrder(sortKey) {
    var url = '<?php echo HTTP_HOME_PAGE_URL;?>/<?php echo $this->params['url']['url'];?>';
    var reg = new RegExp('/sort_key:.*', 'gi');
    var newUrl = url.replace(reg, "");
    newUrl += '/sort_key:'+sortKey;
    redirect(newUrl);
}

</script>