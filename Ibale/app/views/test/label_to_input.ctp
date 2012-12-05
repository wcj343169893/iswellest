<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>

<?php echo $form->create('Test', array('id'=>'TestForm', 'url'=>'/test/save_data/'));?>
<?php foreach($dataList as $key => $value):?>
<p>
<?php echo $form->hidden('id', array('id'=>'id_'.$key, 'value'=>$value['id']));?>
<label id="label_<?php echo $key;?>" onclick="javaScript:showTextBox(<?php echo $key;?>);"><?php echo $value['name'];?></label>
<?php echo $form->text('name', array('id'=>'name_'.$key, 'value'=>$value['name'],'style'=>'display:none;', 'onblur'=>'javaScript:saveData('.$key.', \'Test\', \'id\', \'name\', \'yyy\');'));?>
<label id="error_<?php echo $key;?>" style="display:none;"></label>
</p>
<?php endforeach;?>
<?php echo $form->end();?>
<script>


function afterSaveData(datos) {
    //alert(datos.error);
    //alert(datos.result);
}
</script>

