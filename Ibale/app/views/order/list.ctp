<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 订单一览';?>
<div class="mainCenter clearfix m10">
<?php echo $this->requestAction('/member/customer_center_navi/breadcrumb:order');?>
    <!-- 右侧详细信息 -->
    <div class=" mainRight">
        <!-- 个人信息 -->
        <div class="personalInfo clearfix">
        <?php echo $this->requestAction('/order/order_summary');?>
        </div>
        <!-- 最近订单 -->
        <h3 class="tableTop m_10">
            <span class="tableTitle">订单列表</span>
            <span class="tableStyle"><a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/list/sale_method:<?php echo SALE_METHOD_PAID_BY_OTHER;?>">考验TA订单</a></span> 
            <span class="tableStyle"><a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/list/shipping_status:<?php echo SHIPPING_STATUS_NOTCREDITED;?>">未支付订单</a></span> 
            <span class="tableStyle"><a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/list/">全部订单</a></span>
        </h3>
        <div class="clear"></div>
        <?php echo $this->element('order/order_list');?>
        <?php echo $this->element('common/pagination'); ?>
    </div>
    <!-- 右侧详细信息 end -->
</div>
    <!-- main end -->
<script type="text/javascript">
<?php if ($appSession->check('Message.returnMailSendSuccess')):?>
alert('<?php echo $appSession->flash('returnMailSendSuccess', false);?>');
<?php endif;?>
</script>