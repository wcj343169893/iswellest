<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 赠送礼物一览';?>
<!-- main -->
<h2 class="crumbList">
    <a href="<?php echo HTTP_HOME_PAGE_URL;?>">首页</a> > <a href="<?php echo HTTP_HOME_PAGE_URL;?>/gift_top/">赠送礼物</a> > 礼物一览
</h2>
<div class="mainCenter clearfix m_10_b">
    <?php echo $this->element('gift_top/left_navi');?>
    <div class=" mainRight">
        <h4 class="modTop"></h4>
        <div class="modOrder">
            <p style="width:220px;">
                <?php if ($this->params['named']['sort_key'] == '1'):?><a href="javascript:void(0);">销量<img src="/image/front/arrow_down.gif"></a><?php else:?><a href="javaScript:void(0);" onclick="javaScript:changeSortOrder('1');return false;">销量<img src="/image/front/arrow_down_dis.gif"></a><?php endif;?> 
                <?php if ($this->params['named']['sort_key'] == '2'):?><a href="javascript:void(0);">最新<img src="/image/front/arrow_down.gif"></a><?php else:?><a href="javaScript:void(0);" onclick="javaScript:changeSortOrder('2');return false;">最新<img src="/image/front/arrow_down_dis.gif"></a><?php endif;?> 
                <?php if ($this->params['named']['sort_key'] == '3' ):?><a href="javascript:void(0);">价格<img src="/image/front/arrow_down.gif"></a><?php else:?><a href="javaScript:void(0);" onclick="javaScript:changeSortOrder('3');return false;">价格<img src="/image/front/arrow_down_dis.gif"></a><?php endif;?> 
                <?php if ($this->params['named']['sort_key'] == '4'):?><a href="javascript:void(0);">价格<img src="/image/front/arrow_up.gif"></a><?php else:?><a href="javaScript:void(0);" onclick="javaScript:changeSortOrder('4');return false;">价格<img src="/image/front/arrow_up_dis.gif"></a><?php endif;?> 
            </p>
            <p class="pageSkip">
        <?php if (!empty($this->params['named']['gift_send_to'])):?>
            <?php foreach($giftTypeList[GIFT_TYPE_SEND_TO] as $key => $value):?>
                <?php if ($value['GiftType']['id'] == $this->params['named']['gift_send_to']):?>
                    <?php $sendTo = $value['GiftType']['name'];?>
                <?php endif;?>
            <?php endforeach;?>
        <?php endif;?>
        <?php if (!empty($this->params['named']['gift_send_date'])):?>
            <?php foreach($giftTypeList[GIFT_TYPE_SEND_DATE] as $key => $value):?>
                <?php if ($value['GiftType']['id'] == $this->params['named']['gift_send_date']):?>
                    <?php $sendDate = $value['GiftType']['name'];?>
                <?php endif;?>
            <?php endforeach;?>
        <?php endif;?>
                适合<?php echo !empty($sendDate)?$sendDate:'';?><?php echo !empty($sendTo)?'送给'.$sendTo:'';?>的礼物，共 <b class="orange"><?php echo count($dataList);?></b>个
            </p>
        </div>
        <ul class="itemLisit clearfix">
    <?php if(!empty($dataList)):?>
        <?php foreach($dataList as $key => $value):?>
            <?php $this->set('productInfo', $value);?>
            <?php $this->set('giftFlg', true);?>
            <li style="height:215px;padding-right:15px;text-align:center"><?php echo $this->element('product/category_product_info');?></li>
        <?php endforeach;?>
    <?php else:?>
        <?php __('info.recodeNotFound');?>
    <?php endif;?>
        </ul>
        <!---------->
        <div class="clear"></div>
<?php if(empty($dataList)):?>
    <div style="width:788px;height:300px;">
    <?php echo $this->requestAction('/toppage/ranking_products');?>
    </div>
<?php endif;?>
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