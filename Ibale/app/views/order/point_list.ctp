<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 积分一览';?>
<!-- main -->
<div class="titleBg m_10">
    <h3 class="mypageTitle"></h3>
</div>
<div class="mainCenter clearfix m10">
    <!-- 左侧个人信息导航栏 -->
    <?php echo $this->requestAction('/member/customer_center_navi/breadcrumb:point');?>
    <!-- 左侧个人信息导航栏 end -->
    <!-- 右侧详细信息 -->
    <div class=" mainRight">
        <h3 class="tableTop">
            <span class="tableTitle">积分列表</span>
        </h3>
        <!-- 订单列表 -->
        <div class="personalInfo clearfix">
            <ul class="otherTxt">
                <li>
            <?php if (!empty($pointInfo['points'])):?>
                可用积分：<?php echo $pointInfo['points'];?><em>&nbsp;&nbsp;&nbsp;&nbsp;
                【有效期 <?php echo $pointInfo['expiredate'];?>】&nbsp;&nbsp;&nbsp;&nbsp;</em> 
            <?php else:?>
                可用积分：0&nbsp;&nbsp;&nbsp;&nbsp;
            <?php endif;?>
                <a href="<?php echo HTTP_HOME_PAGE_URL;?>/article/detail/title:<?php echo base64url_encode('积分规则');?>">积分规则>></a>
                </li>
            </ul>
        </div>
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" class="m_10">
            <tbody>
                <tr>
                    <th>积分日期</th>
                    <th>订单号码</th>
                    <th>获得积分</th>
                    <th>使用积分</th>
                </tr>
        <?php if(!empty($dataList)):?>
            <?php foreach($dataList as $key => $value):?>
                <tr>
                    <td><?php echo substr($value['order_datetime'], 0, 10);?></td>
                    <td><a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/detail/order_no:<?php echo $value['order_no'];?>"><?php echo $value['order_no'];?></a></td>
                    <td><?php echo $value['point_got'];?></td>
                    <td><?php echo $value['point_used'];?></td>
                </tr>
            <?php endforeach;?>
        <?php else:?>
            <tr><td colspan="4"><?php __('info.noPoint');?></td></tr>
        <?php endif;?>
            </tbody>
        </table>
        <?php echo $this->element('common/pagination', array('model'=>'Order')); ?>
    </div>
    <!-- 右侧详细信息 end -->
</div>
<!-- main end -->