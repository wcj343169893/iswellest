<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 送货地址一览';?>
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
            <?php if (!isset($this->data[$this->name]['id']) || $this->data[$this->name]['id'] === ''):?>
            <span class="tableTitle2"><a href="javaScript:void(0);" onclick="javaScript:showAddAddress();return false;">添加新地址</a></span>
            <?php endif;?>
        </h3>
        <div class="clear"></div>
        <?php $className = '';?>
        <?php if (empty($this->data['Address']['update_flg'])):?>
            <?php $className = 'display-none';?>
        <?php endif;?>
        <?php $this->set('className', $className);?>
        <div class="personalInfo clearfix" >
            <div class="clear"></div>
        <?php if (!isset($this->data[$this->name]['id']) || $this->data[$this->name]['id'] === ''):?>
            <!-- 添加新地址 -->
            <h3 class="shoppingInfo <?php echo $className;?>" style="padding:0px 15px;">添加送货地址</h3>
        <?php endif;?>
            <?php echo $this->element('address/edit');?>
            <div class="clear"></div>
            
            <!-- 添加新地址 end -->
            <?php echo $this->element('address/address_list');?>
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
        $(".shoppingInfo").removeClass('display-none');
    } else {
        $("#updateAddress").addClass('display-none');
        $("#updateAddressBar").addClass('display-none');
        $(".shoppingInfo").addClass('display-none');
    }
}
function updateAddress() {
    submitForm('AddressEdit');
}
function deleteAddress(id) {
    if (confirm('<?php __('info.confirmDelete');?>')) {
        redirect('<?php echo HTTPS_HOME_PAGE_URL;?>/address/delete/id:'+id);
    }
}
</script>