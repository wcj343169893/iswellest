<div class="mainWrapper">
    <h2>操作日志</h2>
    <table cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <th>用户名</th>
                <th>操作时间</th>
                <th>操作记录</th>
            </tr>
            <?php if (!empty($operatorLogList)):?>
            <?php foreach($operatorLogList as $key => $value):?>
            <tr>
                <td class="bold"><?php echo $value['Admin']['login_id'];?></td>
                <td><?php echo substr($value['OperatorLog']['create_datetime'], 0, 19);?></td>
                <td><?php echo $value['OperatorLog']['content'];?></td>
            </tr>
            <?php endforeach;?>
            <?php else:?>
            <tr>
                <td colspan="3"><?php __('info.recodeNotFound');?></td>
            </tr>
            <?php endif;?>
        </tbody>
    </table>
    <?php echo $this->element('common/pagination', array('model'=>'OperatorLog')); ?>
</div>
