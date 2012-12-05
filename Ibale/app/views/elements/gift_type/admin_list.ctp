    <div class="search">
        <?php echo $appForm->text('name'.$this->type, array('class'=>'input'));?>
        <input class="btnWidth" type="button" name="button2" id="button2" value="添加" onClick="javaScript:addGiftType('<?php echo $this->type;?>');"/>
<?php if ($this->data['GiftType']['type'] == $this->type):?>
        <?php echo $appForm->error('GiftType.name', '名称');?>
        <?php echo $appSession->flash('nameIsExists');?>
<?php endif;?>
    </div>
    <?php $tableId = ($this->type == GIFT_TYPE_SEND_TO)?'headerNaviTable':'footerNaviTable';?>
    <table cellpadding="0" cellspacing="0" id="<?php echo $tableId;?>">
        <tbody>
            <tr>
                <th>分类名称</th>
                <th width="100">商品数量</th>
                <th width="205">排序</th>
                <th width="250" class="action">操作</th>
            </tr>
<?php if (!empty($giftTypeDataList)):?>
        <?php foreach ($giftTypeDataList as $key =>$value):?>
            <?php $value = $value['GiftType'];?>
            <?php $appForm->data['GiftType'][$value['id']]['order_number'] = $value['order_number'];?>
            <tr id="tr<?php echo $value['id'];?>">
                <td class="bold">
                <?php echo $value['name'];?>
                </td>
                <td>
                <?php $product_count = 0;?>
            <?php if(!empty($categoryProductList)):?>
                <?php foreach($categoryProductList as $k => $v):?>
                    <?php if ($v['gift_send_to'] == $value['id'] || $v['gift_send_date'] == $value['id']):?>
                        <?php $product_count += count($v['product']);?>
                    <?php endif;?>
                <?php endforeach;?>
            <?php endif;?>
                <?php echo $product_count;?>
                </td>
                <td>
                <?php echo $appForm->text("GiftType.{$value['id']}.order_number", array('onblur'=>"javaScript:saveLineData('GiftType','id','{$value['id']}','order_number',this,'排序','','','','');"));?>
                <p style="display:none;width:195px;" class="error-message" id="order_numberError<?php echo $value['id'];?>"></p>
                </td>
                <td class="action">
                    <?php $optionList = $giftTypeOptionList[$this->type];?>
                    <?php unset($optionList[$value['id']]);?>
                    <?php echo $appForm->select("GiftType.{$key}.change_to", $optionList, null, array('id'=>"changeTo{$value['id']}", 'class'=>'input_100', 'empty'=>false));?>
                    <a href="javaScript:void(0);" class="disabled" onClick="javaScript:<?php if($product_count > 0):?>changeGiftType('<?php echo $this->type?>','<?php echo $value['id'];?>');<?php else:?>alert('<?php __('info.noPoroductForChange');?>');<?php endif;?>">转移商品</a>
                    <a href="javaScript:void(0);" class="del" onClick="javaScript:<?php if($product_count > 0):?>alert('<?php __('info.hasProductDenyDelete');?>');<?php else:?>delGiftType('<?php echo $value['id'];?>');<?php endif;?>">删除</a>
                </td>
            </tr>
        <?php endforeach;?>
<?php else:?>
        <tr><td colspan="4"><?php __('info.recodeNotFound');?></td></tr>
<?php endif;?>
        </tbody>
    </table>