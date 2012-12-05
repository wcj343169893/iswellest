<?php echo $appForm->create('Product', array('id'=>'Product', 'url'=>'/admin/product/search'));?>
<div class="mainWrapper">
    <h2>商品列表</h2>
    <div class="search">
        名称或编号： <?php echo $appForm->text('Search.product_cd', array('class'=>'input_300'));?>&nbsp;&nbsp;
        <input name="submit_button" type="submit" id="submit_button" value="查找" class="btnWidth">
    </div>
    <table cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <th>商品编号</th>
                <th>商品名称</th>
                <th>操作</th>
            </tr>
    <?php if (!empty($dataList)):?>
        <?php foreach($dataList as $key => $value):?>
            <?php $value = $value['Product'];?>
            <tr>
                <td><?php echo $value['product_cd'];?></td>
                <td><?php echo (mb_strlen($value['product_name'])>50)?mb_substr($value['product_name'],0,50).'...':$value['product_name'];?></td>
                <td class="action2">
                <a href="/product/detail/product_cd:<?php echo $value['product_cd'];?>" target="_blank">查看</a> 
                <a href="/admin/product/edit_relation_product/product_cd:<?php echo $value['product_cd'];?>">关联商品</a>
            <?php if ($value['custom_page_flg'] == ACTIVE_FLG_TRUE):?>
                <a href="/admin/product/edit/product_cd:<?php echo $value['product_cd'];?>">编辑</a>
            <?php endif;?>
                </td>
            </tr>
            <?php endforeach;?>
        <?php else:?>
            <tr>
                <td colspan="9"><?php __('info.recodeNotFound');?></td>
            </tr>
        <?php endif;?>
        </tbody>
    </table>
    <?php echo $this->element('common/pagination', array('model'=>'Product')); ?>
</div>
<?php echo $appForm->end();?>