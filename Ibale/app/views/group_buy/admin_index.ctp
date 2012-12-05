<div class="mainWrapper">
    <h2>
        团购活动列表 <span class="f_12"><a href="/admin/group_buy/edit">[添加活动]</a> </span>
    </h2>
    <table cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <th>编号</th>
                <th>商品</th>
                <th>开始时间</th>
                <th>结束时间</th>
                <th>无效<br>FLG</th>
                <th>限购数量</th>
                <th>售出数量</th>
                <th>团购价格</th>
                <th class="action">操作</th>
            </tr>
    <?php if (!empty($dataList)):?>
        <?php foreach($dataList as $key => $value):?>
            <tr>
                <td><?php echo $value['GroupBuy']['id'];?></td>
                <td><a target="_blank" href="/group_buy/detail/id:<?php echo $value['GroupBuy']['id'];?>"><?php echo $value['Product']['product_name'];?></a></td>
                <td><?php echo substr($value['GroupBuy']['start_time'],0,19);?></td>
                <td><?php echo substr($value['GroupBuy']['end_time'],0,19);?></td>
                <td><?php echo $msts['inactive_flg'][$value['GroupBuy']['inactive_flg']];?></td>
                <td><?php echo $value['GroupBuy']['max_purchase_number'];?></td>
                <td><?php echo $value['GroupBuy']['sold_number'];?></td>
                <td><?php echo $number->currency($value['Product']['price_for_normal'],'');?></td>
                <td class="action">
                    <a href="<?php HTTP_HOME_PAGE_URL;?>/group_buy/detail/id:<?php echo $value['GroupBuy']['id'];?>" target="_blank">查看</a>
                    <a href="/admin/group_buy/edit/id:<?php echo $value['GroupBuy']['id'];?>">编辑</a>
                    <a href="javaScript:void(0);" class="del" onClick="javaScript:delGroupBuy(<?php echo $value['GroupBuy']['id'];?>);">删除</a>
                </td>
            </tr>
        <?php endforeach;?>
    <?php else:?>
        <tr><td colspan="8"><?php __('info.recodeNotFound');?></td></tr>
    <?php endif;?>
        </tbody>
    </table>
    <?php echo $this->element('common/pagination', array('model'=>'GroupBuy')); ?>
</div>
<script type="text/javascript">
function delGroupBuy(id) {
    if (confirm('<?php __('info.confirmDelete');?>')) {
        window.location.href="/admin/group_buy/delete/id:"+id;
    }
    return false;
}
</script>