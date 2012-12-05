<?php if (!empty($dataList)):?>
<ul class="referList">
<?php foreach($dataList as $key => $value):?>
    <li>
        <div class="referLeft">咨询内容:</div>
        <div class="referRight">
            <p class="question">
                <?php echo $appHtml->html($value['Enquiry']['create_user']);?> 问：<b><?php echo $msts[ENQUIRY_TYPE][$value['Enquiry']['type']];?></b><br /> <em><?php echo nl2br($appHtml->html($value['Enquiry']['content']));?></em><span class="date">[<?php echo substr($value['Enquiry']['create_datetime'], 0, 19);?>]</span>
            </p>
            <p class="answer">
                芭乐回复：<br /><?php echo nl2br($appHtml->html($value['Enquiry']['reply_content']));?><span class="date">[<?php echo substr($value['Enquiry']['update_datetime'], 0, 19);?>]</span>
            </p>
        </div>
    </li>
<?php endforeach;?>
<?php endif;?>
</ul>
<div class="clear"></div>
<?php echo $this->element('common/pagination', array('model'=>'Enquiry')); ?> 
<script type="text/javascript">
function reloadPageContent(rs) {
    $("#enquiryBody").html(rs);
}
</script>