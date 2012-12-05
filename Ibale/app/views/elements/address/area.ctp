<li>
    <span class="tit"><em>*</em>所在省份：</span> 
    <?php echo $appForm->select('Address.address1', $addressList1, null, array('id'=>'address1', 'onchange' => "javaScript:getCities('address1', 'address2', 'address2Other', 'address3', 'address3Other', 'zip')", 'empty' => __('label.pleaseSelect', true)));?>
    <?php echo $appForm->error('Address.address1', '所在省份');?>
</li>
<li>
    <span class="tit"><em>*</em>所在城市：</span> 
    <?php echo $appForm->select('Address.address2', $addressList2, null, array('id'=>'address2', 'onchange' => "javaScript:getRegions('address2', 'address3', 'address2Other', 'address3Other', 'zip')", 'empty' => __('label.pleaseSelect', true)));?> 
    <?php //echo $appForm->text('Address.address2_other', array('id' => 'address2Other', 'class'=>'w_210'));?> 
    <?php echo $appForm->error('Address.address2', '所在城市');?>
    <?php echo $appForm->error('Address.address2_other', '所在城市');?>
</li>
<li>
    <span class="tit"><em>*</em>所在区县：</span> 
    <?php echo $appForm->select('Address.address3', $addressList3, null, array('id'=>'address3', 'empty' => __('label.pleaseSelect', true), 'onchange' => "javaScript:chooseRegions('address3', 'address3Other', 'zip', 'address1')"));?> 
    <?php //echo $appForm->text('Address.address3_other', array('id' => 'address3Other','class'=>'w_210'));?> 
    <?php echo $appForm->error('Address.address3', '所在区县');?> <?php echo $appForm->error('Address.address3_other', '所在区县');?>
</li>
<li>
    <span class="tit"><em>*</em>详细地址：</span> 
    <?php echo $appForm->text('Address.address4', array('class'=>'w_210'));?> 
    <?php echo $appForm->error('Address.address4', '详细地址');?>
</li>
<li>
    <span class="tit"><em>*</em> 邮政编码：</span>
    <?php echo $appForm->text('Address.zip', array('id'=>'zip', 'class'=>'w_210', 'readonly'=>true));?>
    <?php echo $appForm->error('Address.zip', '邮政编码');?>
</li>
<script type="text/javascript">
loadCity('address2', 'address2Other');
loadCity('address3', 'address3Other');
//loadZip('address3', 'zip');
</script>