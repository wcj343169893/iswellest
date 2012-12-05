<?php if (!empty($dataList)):?>
<ul class="userList">
<?php foreach($dataList as $key => $value):?>
    <li>
        <div class="userLeft">
            <?php echo nl2br($appHtml->html($value['Estimation']['content']));?><br />[<?php echo substr($value['Estimation']['create_datetime'], 0, 10);?>]
        </div>
        <div class="userRight">
            <?php echo $value['Estimation']['create_user']?><br />
            <?php $this->set('point', $value['Estimation']['point']);?>
            <?php echo $this->element('estimation/point');?>
        </div>
    </li>
<?php endforeach;?>
<?php else:?>
    <?php __('info.recodeNotFound');?>
<?php endif;?>
</ul>
<br class="clear" />
<?php echo $this->element('common/pagination', array('model'=>'Estimation')); ?> 
<script type="text/javascript">
function reloadPageContent(rs) {
    $("#estimationBody").html(rs);
}
</script>
