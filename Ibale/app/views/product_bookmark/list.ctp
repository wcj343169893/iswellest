<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 我的收藏';?>
<!-- main -->
<div class="titleBg m_10">
    <h3 class="mypageTitle"></h3>
</div>
<div class="mainCenter clearfix m10">
    <?php echo $this->requestAction('/member/customer_center_navi/breadcrumb:bookmark');?>
    <!-- 右侧详细信息 -->
    <div class=" mainRight">
        <!-- 我的收藏 -->
        <h3 class="tableTop">
            <span class="tableTitle">我的收藏</span>
        </h3>
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <th>商品</th>
                    <th style="width:200px;">名称</th>
                    <th>商城价格</th>
                    <th>库存数量</th>
                    <th class='center'>操作</th>
                    <th>分享到</th>
                </tr>
        <?php if (!empty($dataList)):?>
            <?php foreach($dataList as $key => $value):?>
                <tr>
                    <td><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $value['product_cd'];?>" target="_blank"><img src="<?php echo !empty($value['product_pic_url'])?OMS_API_PHOTO_ROOT_URL.$value['product_pic_url']:'/image/front/none_90.jpg';?>" width="60" height="60" /></a></td>
                    <td style="width:200px;"><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $value['product_cd'];?>" target="_blank"><?php echo $value['product_name'];?></a></td>
                    <td class='center'>￥<?php echo $number->currency($value['sale_price'], '');?></td>
                    <td class='center'><?php echo $value['stock']?></td>
                    <td>
                    <?php if (!empty($value['enable_sale'])):?>
                        <a href="javaScript:void(0);" onclick="javaScript:addToBag('<?php echo $value['product_cd'];?>');return false;"><img class="no-border" src="/image/front/s_cart.png" /></a>│
                    <?php else:?>
                        <img class="no-border" src="/image/front/s_cart_2.png" />│
                    <?php endif;?>
                    <?php /**
                        <a href="javaScript:void(0);" onclick="javaScript:toKaoyanta('<?php echo $value['product_cd'];?>');return false;">考验TA</a>│
                    */?>
                        <a href="javaScript:void(0);" onclick="javaScript:deleteBookmark('<?php echo $value['product_cd'];?>');return false;">删除</a>
                    </td>
                    <td>
                        <?php $this->set('shareToURL', HTTP_HOME_PAGE_URL.'/product/detail/product_cd:'.$value['product_cd']);?>
                        <?php echo $this->element('product/share_to');?>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php else:?>
                <tr>
                    <td colspan="4"><?php __('info.recodeNotFound');?></td>
                </tr>
                <?php endif;?>
            </tbody>
        </table>
        <?php echo $this->element('common/pagination', array('model'=>'ProductBookmark')); ?>
    </div>
    <!-- 右侧详细信息 end -->
</div>
<div id="ajaxRet" class="display-none"></div>
<!-- main end -->
<script type="text/javascript">
/**
function addToBag(productCd) {
    $("#ajaxRet").empty();
    $.get('/shopping/ajax_add_to_bag/', {
                                product_cd:productCd,
                                order_amount:1,
                                referer:'product_bookmark'
                            }, function(rs){
                                $("#ajaxRet").html(rs);
                            }
    );
}
*/
function toKaoyanta(productCd) {
    $.get('/shopping/ajax_add_to_bag/', {
            product_cd:productCd,
            sale_method:'<?php echo SALE_METHOD_PAID_BY_OTHER?>',
            order_amount:1
        }, function(rs){
            $("#ajaxRet").html(rs);
        }
    );
}
function deleteBookmark(productCd) {
    $.get('/product_bookmark/ajax_delete/', {
                                product_cd:productCd
                            }, function(rs){
                                alert(rs);
                                redirect('product_bookmark/list');
                            }
    );
}
</script>