<table cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <th>订单编号</th>
            <th>序号</th>
            <th>订单日期</th>
            <th>订单分类</th>
            <th>收货人</th>
            <th>金额</th>
            <th>支付状态</th>
            <th>订单状态</th>
        </tr>
<?php if (!empty($orderList)):?>
    <?php $orderNos = array();?>
    <?php foreach($orderList as $key => $value):?>
        <tr>
        <?php if (!in_array($value['order_no'], $orderNos) && isset($value['has_divided'])):?>
            <td style="border-bottom:0px;">
                <?php $orderNos[] = $value['order_no'];?>
                <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/detail/order_no:<?php echo $value['order_no'];?>"><?php echo $value['order_no'];?></a>
            </td>
        <?php elseif (!in_array($value['order_no'], $orderNos)):?>
            <td>
                <?php $orderNos[] = $value['order_no'];?>
                <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/detail/order_no:<?php echo $value['order_no'];?>"><?php echo $value['order_no'];?></a>
            </td>
        <?php else:?>
            <td>
                &nbsp;
            </td>
        <?php endif;?>
            <td><?php echo $value['record_num'];?></td>
            <td><?php echo substr($value['order_datetime'], 0, 10);?></td>
            <td>
            <?php if (isset($value['orders'])):?>
                <?php //$orderType=$app->getOrderTypeDesc($value);?>
            <?php endif;?>
                <?php echo $value['order_type'];?>
            </td>
            <td><?php echo $appHtml->html($value['shipto_name']);?></td>
            <td>￥<?php echo $number->currency($value['claim_subtotal'], '');?></td>
            <td>
            <?php if (($value['charge_type'] == CHARGE_TYPE_ALIPAY && in_array($value['shipping_status'], array(SHIPPING_STATUS_NOTCREDITED, SHIPPING_STATUS_CANCELLED))) || ($value['charge_type'] == CHARGE_TYPE_COD && in_array($value['shipping_status'], array(SHIPPING_STATUS_NOTYET,SHIPPING_STATUS_SHIPPING, SHIPPING_STATUS_WAIT_ARRIVAL)))):?>
                <em>未支付</em>
            <?php else:?>
                已支付
            <?php endif;?>
            </td>
            <td>
            <?php echo $msts['shipping_status'][$value['shipping_status']];?>
            <?php if (isset($value['has_rejected'])):?>
                <br><label class="orange">(有退货)</label>
            <?php endif;?>
            <?php if (isset($value['divided_flg'])):?>
                <br><label class="orange">(有订单拆分)</label>
            <?php endif;?>
            </td>
        </tr>
    <?php endforeach;?>
<?php else:?>
        <tr>
            <td colspan="8"><?php __('info.recodeNotFound');?></td>
        </tr>
<?php endif;?>
    </tbody>
</table>