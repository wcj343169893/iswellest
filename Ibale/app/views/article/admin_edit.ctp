<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/js/ajaxOption.js"></script>
<div class="mainWrapper">
    <h2>添加/编辑文章</h2>
    <?php echo $appForm->create('Article', array('id'=>'Article', 'url'=>'/admin/article/edit_comp'));?>
    <?php echo $appForm->hidden('id');?>
    <?php echo $appForm->hidden('referer');?>
    <?php echo $appForm->hidden('mode', array('value'=>'save'));?>
    <div class="mainContent">
        <p>
            <span>标题</span> <?php echo $appForm->text('title', array('class'=>'input_400'));?>
            <?php echo $appForm->error('Article.title', '标题');?>
        </p>
        <p>
            <span>分类</span> 
            <?php echo $appForm->select('category1_id', $category1List, null, array('id'=>'category1', 'empty'=>__('label.pleaseSelect', true)));?>
            <?php echo $appForm->select('category2_id', $category2List, null, array('id'=>'category2','empty'=>__('label.pleaseSelect', true)));?>
            <?php echo $appForm->error('Article.category2_id', '分类');?>
        </p>
        <p>
            <span>正文</span>
        </p>
            <?php echo $appForm->textarea('content', array('class'=>'ckeditor'));?>
            <?php echo $appForm->error('Article.content', '正文');?>
        <p class="editWrapper">
        <?php if (!empty($this->data['Article']['id'])):?>
            <input type="submit" name="button" id="button" value="更新" class="btnWidth" />
        <?php else:?>
            <input type="submit" name="button" id="button" value="添加" class="btnWidth" />
        <?php endif;?>
        </p>
    </div>
    <?php echo $appForm->end();?>
</div>
<script type="text/javascript">
$(function(){
    $("#category1").change(function(){
        getAjaxOptions('/ajax/get_article_category2_option_list', this, 'category2');
    });
});
</script>