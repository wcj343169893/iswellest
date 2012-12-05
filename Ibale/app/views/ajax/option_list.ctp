<?php if (!empty($optionList)):?>
<?php foreach($optionList as $key => $value):?>
<option value="<?php echo $key;?>"><?php echo $value;?></option>
<?php endforeach;?>
<?php endif;?>