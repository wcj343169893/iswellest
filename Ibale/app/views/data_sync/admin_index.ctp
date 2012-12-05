<div class="mainWrapper">
    <h2>DB数据同步</h2>
    <p><?php echo $appForm->button('同步更新', array('onclick' => "javascript:dataSync();"))?></p>
</div>
<script type="text/javascript">
function dataSync() {
    $.get('/admin/data_sync/execute',{}
        ,function(rs){
            alert('<?php __('info.dataSyncSuccess');?>');
        } 
    );
}
</script>