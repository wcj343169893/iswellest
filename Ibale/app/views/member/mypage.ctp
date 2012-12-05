<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 用户中心';?>
<!-- main -->
<div class="titleBg m_10">
    <h3 class="mypageTitle">用户中心</h3>
</div>
<div class="mainCenter clearfix m10">
    <?php echo $this->requestAction('/member/customer_center_navi/breadcrumb:mypage');?>
    <!-- 右侧详细信息 -->
    <div class=" mainRight">
        <!-- 个人信息 -->
        <div class="personalInfo clearfix">
            <div class="personalImg">
                <?php $url = (!empty($this->data['MemberPhoto']['photo_path']) && file_exists(WWW_ROOT.$this->data['MemberPhoto']['photo_path']))?$this->data['MemberPhoto']['photo_path']:'/image/front/img.jpg';?>
                <img src="<?php echo $url;?>" width="106" height="106" /><br />
                <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/edit/">[编辑个人资料]</a>
            </div>
            <div class="personalTxt">
                <p>
                    您好,<em><?php echo $appHtml->html($memberInfo['name']);?><?php echo !empty($msts['sex'][$memberInfo['sex']])?$msts['sex'][$memberInfo['sex']]:'';?> (昵称：<?php echo $appHtml->html($memberInfo['nickname']);?>)</em> 
                <?php /**
                    <b class="p_200_l"><?php echo $msts['customer_rank'][strtolower($memberInfo['customer_rank'])]?></b> 
                    <a href="<?php echo HTTP_HOME_PAGE_URL;?>/article/detail/title:<?php echo base64url_encode('关于会员等级');?>">关于会员等级</a>
                */?>
                </p>
                <?php echo $this->requestAction('/order/order_summary');?>
            </div>
        </div>
        <!-- 我的收藏 -->
        <h3 class="tableTop m_10">
            <span class="tableTitle">我的收藏</span><span class="tableMore"><a href="<?php echo HTTPS_HOME_PAGE_URL;?>/bookmark/list/">全部收藏&gt;&gt;</a> </span>
        </h3>
        <div class="clear"></div>
    <?php if (!empty($bookmarkList)):?>
        <ul class="itemContent clearfix border-1">
        <?php foreach($bookmarkList as $key => $value):?>
            <?php $this->set('productInfo', $value);?>
            <li><?php echo $this->element('product/product_info_without_navi');?></li>
        <?php endforeach;?>
        </ul>
    <?php else:?>
        <p class="notFound"><?php __('info.recodeNotFound');?></p>
    <?php endif;?>
        <!-- 最近订单 -->
        <h3 class="tableTop m_10">
            <span class="tableTitle">最新订单</span> <span class="tableMore"><a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/list">全部订单&gt;&gt;</a> </span>
        </h3>
        <div class="clear"></div>
        <?php echo $this->element('order/order_list');?>
        <!-- 送货地址 -->
        <h3 class="tableTop m_10">
            <span class="tableTitle">送货地址</span> <span class="tableMore"><a href="<?php echo HTTPS_HOME_PAGE_URL;?>/address/list">全部收货地址&gt;&gt;</a> </span>
        </h3>
        <div class="clear"></div>
        <?php echo $this->element('address/address_list');?>
    </div>
    <!-- 右侧详细信息 end -->
</div>
<!-- main end -->
<script type="text/javascript">
function deleteAddress(id) {
    if (confirm('<?php __('info.confirmDelete');?>')) {
        redirect('<?php echo HTTPS_HOME_PAGE_URL;?>/address/delete/id:'+id);
    }
}
</script>