<table cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <th>收货人</th>
            <th>邮政编码</th>
            <th>详细地址</th>
            <th>电话/手机</th>
            <th>操作</th>
        </tr>
<?php if(!empty($addressList)):?>
    <?php foreach($addressList as $key => $value):?>
        <tr>
            <td><?php echo $appHtml->html($value['name']);?></td>
            <td><?php echo $value['zip'];?></td>
            <td><?php echo $appHtml->html($areaList[$value['address1']].'-'.(isset($areaList[$value['address2']])?$areaList[$value['address2']]:$value['address2']).'-'.(isset($areaList[$value['address3']])?$areaList[$value['address3']]:$value['address3']) .'-'. $value['address4']);?></td>
            <td><?php echo $value['phone'];?></td>
            <td class="action"><a href="<?php echo HTTPS_HOME_PAGE_URL;?>/address/edit/id:<?php echo $key;?>">编辑</a><a href="javaScript:void(0)" onclick="javaScript:deleteAddress(<?php echo $key;?>);return false;">删除</a></td>
        </tr>
    <?php endforeach;?>
<?php else:?>
        <tr>
            <td colspan="5"><?php __('info.noAddress');?></td>
        </tr>
<?php endif;?>
    </tbody>
</table>