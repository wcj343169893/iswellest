<?php
$paginator->options(array('url' => $this->passedArgs));
if (!empty($paginator->params['paging'])) {
    $paging = reset($paginator->params['paging']);
}
$pageSection = !empty($pageSection)?$pageSection:1;
?>

<?php if($this->layout == 'admin' && !empty($paging['count']) && (!empty($paging['prevPage']) || !empty($paging['nextPage']))):?>
	<div class="page">
		<?php echo $paginator->counter(array('format' => '<b>%count%条记录 (%page%/%pages%页)</b>'));?>
        <?php echo $paginator->first('首页', array('tag'=>'span', 'class'=>'disabled', 'escape'=>false));?>
			<?php echo $paginator->prev('上一页',array('tag'=>'span', 'class'=>'disabled', 'escape' => false));?>
			<?php echo $paginator->numbers(array('separator'=>false));?>
			<?php echo $paginator->next('下一页',array('tag'=>'span', 'class'=>'disabled', 'escape' => false));?>
			<?php echo $paginator->last('尾页', array('tag'=>'span', 'class'=>'disabled', 'escape'=>false));?>
		</div>
<?php elseif($this->layout == 'front'&&!empty($onlyButton) && !empty($paging['count']) && (!empty($paging['prevPage']) || !empty($paging['nextPage']))):?>
		<div class="tool_page">
              <?php echo $paginator->counter(array('format' => '<span><a href="javascript:;">%page%</a>/%pages%</span>'));?>
              <?php echo $paginator->prev('',array('escape' => false,'class'=>"prev"));?>
              <?php echo $paginator->next('',array('escape' => false));?>
		</div>
<?php $this->set("onlyButton",0);?>
<?php elseif($this->layout == 'front' && !empty($paging['count']) && (!empty($paging['prevPage']) || !empty($paging['nextPage']))):?>
        <div class="page pageStyle">
            <p>
                <span class="btnBack2">
                <?php echo $paginator->prev('',array('escape' => false));?>
                </span>
            </p>
            <p>
                <?php echo $paginator->numbers(array('separator'=>false));?>
            </p>
            <p style="width:81px;">
                <span class="btnNext2">
                <?php echo $paginator->next('',array('escape' => false));?>
                </span>
            </p>
            <p class="pageSkip">
                <button type="button" class="btnImg btnOk" onclick="javaScript:ajaxJumpPage('/<?php echo $this->params['url']['url'];?>', '<?php echo $pageSection;?>');"></button>
            </p>
            <p class="pageSkip">
                共<?php echo $paginator->counter(array('format' => '%pages%'));?>页 到第 <input id="jumpPageNo<?php echo $pageSection;?>" name="textfield2" type="text" id="textfield2" size="8" />
            </p>
        </div>
<?php elseif($this->layout == 'ajax' && !empty($paging['count']) && (!empty($paging['prevPage']) || !empty($paging['nextPage']))):?>
<?php
    $pageStr = "<div class=\"page pageStyle\">
        <p>
            <span class=\"btnBack2\">
            {$paginator->prev('',array('escape' => false))}
            </span>
        </p>
        <p>
            {$paginator->numbers(array('separator'=>false))}
        </p>
        <p>
            <span class=\"btnNext2\">
            {$paginator->next('',array('escape' => false))}
            </span>
        </p>
        <p class=\"pageSkip\">
            <button type=\"button\" class=\"btnImg btnOk\" onclick=\"javaScript:return ajaxJumpPage('{$this->params['url']['url']}','{$pageSection}');\"></button>
        </p>
        <p class=\"pageSkip\">
            共{$paginator->counter(array('format' => '%pages%'))}页 到第 <input id=\"jumpPageNo{$pageSection}\" name=\"Search.page\" type=\"text\" id=\"textfield2\" size=\"8\" value=\"{$this->data['Search']['page']}\" />
        </p>
    </div>";?>
    <?php echo preg_replace("/href=\"(\/[\w\/\:]*)\"/", "href=\"javaScript:void(0);\" onclick=\"javaScript:redirectTo('\$1')\"", $pageStr);?>
<?php endif;?>
