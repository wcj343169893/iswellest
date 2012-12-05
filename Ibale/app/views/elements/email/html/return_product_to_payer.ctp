<style>
<!--
table tr th {
    background: none repeat scroll 0 0 #EDF7FF;
    border-bottom: 1px solid #D4E9F9;
    color: #333333;
    height: 29px;
    line-height: 29px;
    padding: 0 0 0 10px;
}
table tr td {
    background: none repeat scroll 0 0 #FFFFFF;
    border-bottom: 1px solid #D4E9F9;
    height: 29px;
    line-height: 29px;
    padding: 0 0 0 10px;
}
-->
</style>
    <p class="f_14_b">
        亲爱的 <em><?php echo $appHtml->html($memberInfo['name']);?></em>：
    </p>
    <p class="f_14">
    您好！<br> <?php __('info.siteNameCN');?>(<a href="<?php echo HTTP_HOME_PAGE_URL;?>"><?php echo HTTP_HOME_PAGE_URL;?></a>)已收到您于
    <?php echo date('Y-m-d H:i:s');?>
    针对
    <?php echo $this->data['Order']['order_no'];?>
    订单的退货申请 ，我们会立即处理此申请。<br> <br>
    退换商品详细：
    <table cellpadding="0" cellspacing="0" style="width:100%;border: 1px solid #D4E9F9;">
        <tr>
            <th width="40">序号</th>
            <th width="80">商品编号</th>
            <th>商品名称</th>
            <th width="80">退货</th>
            <th width="80">换货</th>
        </tr>
    <?php $index = 1;?>
    <?php foreach($enableReturnList as $key => $value):?>
        <?php if (!empty($this->data['Order'][$key]['return_number']) || !empty($this->data['Order'][$key]['exchange_number'])):?>
        <tr>
            <td><?php echo $index;?></td>
            <td><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $key;?>"><?php echo $key;?></a></td>
            <td><?php echo $enableReturnProductInfoList[$key]['Product']['product_name'];?></td>
            <td>
                <?php if (!empty($this->data['Order'][$key]['return_number'])):?><?php echo $this->data['Order'][$key]['return_number'];?>件<?php endif;?>
            </td>
            <td>
                <?php if (!empty($this->data['Order'][$key]['exchange_number'])):?><?php echo $this->data['Order'][$key]['exchange_number'];?>件<?php endif;?>
            </td>
        </tr>
        <?php $index++;?>
        <?php endif;?>
    <?php endforeach;?>
    </table>
    退换货理由：<br>
    <?php echo $msts['return_reason'][$this->data['Order']['return_reason']];?><br>
    备注：<?php echo !empty($this->data['Order']['comment'])?$appHtml->html($this->data['Order']['comment']):'无';?>
    <br>
    您可以随时进入<a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/detail/order_no:<?php echo $this->data['Order']['order_no'];?>">订单详情页面</a>查看订单的后续处理情况。<br>
</p>
