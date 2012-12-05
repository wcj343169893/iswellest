<!-- 左侧个人信息导航栏 -->
<h3 class="breadcrumb ">
<?php switch ($this->params['named']['breadcrumb']): ?>
<?php case 'point':?>
    <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/mypage/">用户中心</a>&nbsp;&gt;&nbsp;<a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/point_list">我的积分</a>
    <?php break;?>
<?php case 'order':?>
    <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/mypage/">用户中心</a>&nbsp;&gt;&nbsp;<a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/list">订单信息</a>
    <?php break;?>
<?php case 'bookmark':?>
    <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/mypage/">用户中心</a>&nbsp;&gt;&nbsp;<a href="<?php echo HTTPS_HOME_PAGE_URL;?>/bookmark/list">我的收藏</a>
    <?php break;?>
<?php case 'edit_member':?>
    <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/mypage/">用户中心</a>&nbsp;&gt;&nbsp;<a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/edit">个人资料</a>
    <?php break;?>
<?php case 'address':?>
    <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/mypage/">用户中心</a>&nbsp;&gt;&nbsp;<a href="<?php echo HTTPS_HOME_PAGE_URL;?>/address/list/">送货地址管理</a>
    <?php break;?>
<?php default:?>
    <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/mypage/">用户中心</a>
<?php endswitch;?>
</h3>
<div class="mainLeft">
    <div class="listMypage clearfix">
        <dl class="listPersonal">
            <dd>
                <b>您好，<?php echo $appHtml->html($memberInfo['name']);?><?php echo !empty($msts['sex'][$memberInfo['sex']])?$msts['sex'][$memberInfo['sex']]:'';?></b>
            </dd>
        <?php /**
            <dd>
                <?php echo $msts['customer_rank'][strtolower($memberInfo['customer_rank'])]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo HTTP_HOME_PAGE_URL;?>/article/detail/title:<?php echo base64url_encode('关于会员等级');?>">关于会员等级</a>
            </dd>
        */?>
        </dl>
        <dl class="listPersonal">
            <dt>我的订单</dt>
            <dd>
                <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/list">全部订单(件数:<?php echo $orderCount['totalCount'];?>件)</a>
            </dd>
        <?php if (!empty($orderCount['notCredited'])):?>
            <dd>
                <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/list/shipping_status:<?php echo SHIPPING_STATUS_NOTCREDITED;?>" class="orangeLink">未支付订单(件数:<?php echo $orderCount['notCredited'];?>件)</a>
            </dd>
        <?php endif;?>
            <dd>
                <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/list/sale_method:<?php echo SALE_METHOD_NORMAL;?>">普通订单(件数:<?php echo $orderCount['normal'];?>件)</a>
            </dd>
        <?php /**
            <dd>
                <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/list/sale_method:<?php echo SALE_METHOD_PAID_BY_OTHER;?>">考验TA订单(件数:<?php echo $orderCount['paidByOther'];?>件)</a>
            </dd>
            <dd>
                <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/list/sale_method:<?php echo SALE_METHOD_GROUP_BUY;?>">团购订单(件数:<?php echo $orderCount['groupBuy'];?>件)</a>
            </dd>
            <dd>
                <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/list/sale_method:<?php echo SALE_METHOD_GIFT;?>">礼品订单(件数:<?php echo $orderCount['gift'];?>件)</a>
            </dd>
        */?>
        </dl>
        <dl class="listPersonal">
            <dt>收藏管理</dt>
            <dd>
                <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/bookmark/list/">我的收藏(件数:<?php echo $bookmarkCount;?>件)</a>
            </dd>
        </dl>
        <dl class="listPersonal">
            <dt>积分管理</dt>
            <dd>
                <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/point_list">我的积分</a>
            </dd>
        </dl>
        <dl class="listPersonal">
            <dt>我的信息</dt>
            <dd>
                <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/edit">个人资料</a>
            </dd>
            <dd>
                <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/address/list">送货地址管理</a>
            </dd>
        </dl>
    </div>
</div>
<!-- 左侧个人信息导航栏 end -->
