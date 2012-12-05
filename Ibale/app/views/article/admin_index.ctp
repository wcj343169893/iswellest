<div class="mainWrapper">
    <h2>文章列表 <span class="f_12"><a href="/admin/article/edit">[添加文章]</a></span></h2>
    <?php echo $appForm->create('Article', array('id'=>'Article', 'url'=>'/admin/article/add'));?>
    <?php echo $appForm->hidden('id');?>
    <table cellpadding="0" cellspacing="0">
        <tbody>
        <tr>
            <th width="200">分类</th>
            <th width="140">更新时间</th>
            <th>标题</th>
            <th width="60">次序</th>
            <th class="action" width="80">操作</th>
        </tr>
<?php if (!empty($articleList)):?>
    <?php foreach ($articleList as $key =>$value):?>
    <?php $value['Article']['category1_name'] = $value['ParentArticleCategory']['name'];?>
    <?php $value['Article']['category2_name'] = $value['ArticleCategory']['name'];?>
    <?php $value = $value['Article'];?>
        <tr>
            <td>
            <?php echo $appHtml->html($value['category1_name']);?><?php echo $appHtml->html((!empty($value['category2_name']))?'-'.$value['category2_name']:'');?>
            </td>
            <td><?php echo substr($value['update_datetime'], 0, 19);?></td>
            <td><a href="<?php echo HTTP_HOME_PAGE_URL;?>/article/detail/id:<?php echo $value['id'];?>" target="_blank"><?php echo $appHtml->html($value['title']);?></a></td>
            <td><?php echo $appForm->labelText('order_number', array('id'=>$value['id'],'value'=>$value['order_number'],'modelName'=>'Article','fieldName'=>'order_number','labelName'=>'顺序','style'=>'width:60px;'));?></td>
            <td class="action">
                <a href="javaScript:void(0);" class="" onClick="javaScript:editArticle('<?php echo $value['id'];?>');">编辑</a>
                <a href="javaScript:void(0);" class="del" onClick="javaScript:delArticle('<?php echo $value['id'];?>');">删除</a>
            </td>
        </tr>
    <?php endforeach;?>
<?php else:?>
        <tr><td colspan="5"><?php __('info.recodeNotFound');?></td></tr>
<?php endif;?>
        </tbody>
    </table>
    <?php echo $this->element('common/pagination', array('model'=>'Article')); ?>
    <?php echo $appForm->end();?>
</div>
<script type="text/javascript">
function editArticle(id) {
    $("#ArticleId").val(id);
    $("#Article").attr('action', '/admin/article/edit');
    $("#Article").submit();
    return false;
}
function delArticle(id) {
    if (confirm('<?php __('info.confirmDelete');?>')) {
        $("#ArticleId").val(id);
        $("#Article").attr('action', '/admin/article/delete');
        $("#Article").submit();
    }
    return false;
}
</script>
