    <div style="margin-bottom:10px;">
        名称：<?php echo $appForm->text('name'.$this->type, array('class'=>'input'));?>
        链接：<?php echo $appForm->text('url'.$this->type, array('class'=>'input'));?>
        顺序：<?php echo $appForm->text('order_number'.$this->type, array('class'=>'input'));?>
        <input class="btnWidth" type="button" name="button2" id="button2" value="添加" onClick="javaScript:addProperty('<?php echo $this->type;?>');"/>

<?php if ($this->data['PageProperty']['type'] == $this->type):?>
        <?php echo $appForm->error('PageProperty.name', '名称');?>
        <?php echo $appForm->error('PageProperty.url', '链接');?>
        <?php echo $appForm->error('PageProperty.order_number', '顺序');?>
        <?php if ( $appSession->check('Message.nameIsExists')):?>
            <?php echo $appSession->flash('nameIsExists');?>
        <?php endif;?>
<?php endif;?>
    </div>
    <?php $tableId = ($this->type == PAGE_PROPERTY_HEADER)?'headerNaviTable':'footerNaviTable';?>
    <table cellpadding="0" cellspacing="0" id="<?php echo $tableId;?>">
        <tbody>
            <tr>
                <th>排序</th>
                <th width="200">名称</th>
                <th width="400">链接</th>
                <th>操作</th>
            </tr>
<?php if (!empty($this->dataList)):?>
        <?php foreach ($this->dataList as $key =>$value):?>
            <?php $value = $value['PageProperty'];?>
            <?php $enableEditFlg = false;?>
            <?php if (!in_array($value['name'], array('用户中心'))):?>
                <?php $enableEditFlg = true;?>
            <?php endif;?>
            <tr id="tr<?php echo $value['id'];?>">
                <td id="orderNumber<?php echo $value['id'];?>"><?php echo $key + 1;?></td>
            <?php if ($enableEditFlg):?>
                <td class="bold">
                <?php echo $appForm->labelText('name', array('id'=>$value['id'],'value'=>$value['name'],'modelName'=>'PageProperty','fieldName'=>'name','labelName'=>'名称','uniqueFunction'=>'isExists','associateKeyName'=>'type','associateKeyValue'=>$this->type));?>
                </td>
                <td>
                <?php echo $appForm->labelText('url', array('id'=>$value['id'],'value'=>$value['url'],'modelName'=>'PageProperty','fieldName'=>'url','labelName'=>'链接','style'=>'width:300px;'));?>
                </td>
            <?php else:?>
                <td class="bold">
                <?php echo $value['name'];?>
                </td>
                <td>
                <?php echo $value['url'];?>
                </td>
            <?php endif;?>
                <td class="action2">
            <?php if ($key != 0):?>
                    <a id="upBtn<?php echo $value['id'];?>" href="javaScript:void(0);">上移</a>
            <?php else:?>
                    <a id="upBtn<?php echo $value['id'];?>" href="javaScript:void(0);" class="disabled">上移</a>
            <?php endif;?>
            <?php if ($key < count($this->dataList) - 1):?>
                    <a id="downBtn<?php echo $value['id'];?>" href="javaScript:void(0);">下移</a>
            <?php else:?>
                    <a id="downBtn<?php echo $value['id'];?>" href="javaScript:void(0);" class="disabled">下移</a>
            <?php endif;?> 
            <?php if ($enableEditFlg):?>
                    <a href="javaScript:void(0);" class="del" onClick="javaScript:delProperty('<?php echo $value['id'];?>');">删除</a>
            <?php endif;?>
                </td>
            </tr>
        <?php endforeach;?>
<?php else:?>
        <tr><td colspan="4"><?php __('info.recodeNotFound');?></td></tr>
<?php endif;?>
        </tbody>
    </table>