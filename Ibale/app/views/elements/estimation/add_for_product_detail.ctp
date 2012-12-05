<?php $ret = $this->requestAction('/estimation/ajax_add/product_cd:'.$this->params['named']['product_cd']);?>
<?php if (!empty($ret)):?>
    <div class="itemComment">
        <?php echo $appForm->create('Estimation', array('id'=>'EstimationForm', 'url'=>'/estimation/add_comp'));?>
        <?php echo $appForm->hidden('order_no', array('value' => $ret['order_no']));?>
        <?php echo $appForm->hidden('record_num', array('value' => $ret['record_num']));?>
        <?php echo $appForm->hidden('product_cd', array('value'=>$this->params['named']['product_cd']));?>
        <p class="commentTitle">评价登录</p>
        <p>
            <label>评价</label>
        <?php for($i=5;$i>=1;$i--):?>
            <?php $types[$i] = $i;?>
        <?php endfor;?>
            <?php echo $appForm->select('point', $types, null, array('empty'=>false));?>
        </p>
        <p>
            <label>评价内容</label>
            <?php echo $appForm->textarea('content', array('cols'=>'45', 'rows'=>'5'));?>
            <?php echo renderMsg($appSession->flash('estimationCreateFailurecontent'), '评价内容');?>
        </p>
        <p class="btn">
            <button type="button" class="btnImg btnEntry" onclick="javaScript:$('#EstimationForm').submit();"></button>
        </p>
        <?php echo $appForm->end();?>
    </div>
<?php endif;?>