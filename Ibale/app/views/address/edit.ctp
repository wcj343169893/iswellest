<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 送货地址编辑';?>
<script type="text/javascript" src="/js/area.js"></script>
<!-- main -->
<div class="titleBg m_10">
    <h3 class="mypageTitle"></h3>
</div>
<div class="mainCenter clearfix m10">
<?php echo $this->requestAction('/member/customer_center_navi/breadcrumb:address');?>
    <!-- 右侧详细信息 -->
    <div class=" mainRight">
        <!-- 送货地址 -->
        <h3 class="tableTop">
            <span class="tableTitle">送货地址</span>
        </h3>
        <div class="clear"></div>
        <?php $className = '';?>
        <?php if (empty($this->data['Address']['update_flg'])):?>
            <?php $className = 'display-none';?>
        <?php endif;?>
        <div class="personalInfo clearfix" >
            <!-- 添加新地址 -->
            <div class="clear"></div>
            <h3 class="shoppingInfo" style="padding:0px 15px;">编辑送货地址</h3>
            <?php $this->set('className', '');?>
            <?php echo $this->element('address/edit');?>
            <!-- 添加新地址 end -->
        </div>
    </div>
    <!-- 右侧详细信息 end -->
</div>
<!-- main end -->
<script type="text/javascript">
function showAddAddress() {
    if ($("#updateAddress").css('display') == 'none') {
        $("#updateAddress").removeClass('display-none');
        $("#updateAddressBar").removeClass('display-none');
    } else {
        $("#updateAddress").addClass('display-none');
        $("#updateAddressBar").addClass('display-none');
    }
}
function updateAddress() {
    submitForm('AddressEdit');
}
</script>