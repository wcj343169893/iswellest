<link type="text/css" rel="stylesheet" href="/css/admin/box.css"/>
<script type="text/javascript" src="/js/ajaxOption.js"></script>
<?php echo $appForm->create('ArticleCategory', array('id'=>'ArticleCategory', 'url'=>'/admin/article_category/add_category1'));?>
<?php echo $appForm->hidden('id');?>
<?php echo $appForm->hidden('parent_id');?>
<div class="mainWrapper">
	<h2>文章分类</h2>
    <div class="search">
        <?php echo $appForm->text('category1_name', array('class'=>'input'));?>
        <input type="button" name="button" id="button" value="添加主分类" class="btnWidth" onClick="javaScript:$('#ArticleCategory').submit();"/>
        <?php echo $appForm->error('ArticleCategory.name', '分类名称');?>
        <?php echo $appSession->flash('nameIsExists');?>
    </div>
    <table cellpadding="0" cellspacing="0">
        <tbody>
        <tr>
            <th>分类名称</th>
            <th width="100">子分类数量</th>
            <th width="100">文章数量</th>
            <th width="100">排序</th>
            <th class="action" width="120">操作</th>
        </tr>
<?php if (!empty($articleCategoryList)):?>
        <?php foreach($articleCategoryList as $key => $value):?>
        <?php $childCategoryCount = !empty($value['ChildCategory'])?count($value['ChildCategory']):0;?>
        <?php $imgSrc             = ($childCategoryCount)?'/image/admin/menu_plus.gif':'/image/admin/menu_minus.gif';?>
        <?php $className          = ($childCategoryCount)?"hasChild":"noChild"?>
        <tr id="P<?php echo $value['ArticleCategory']['id']?>" class="trClosed <?php echo $className;?>">
            <td class="bold">
            <img id="P<?php echo $value['ArticleCategory']['id']?>Img" src="<?php echo $imgSrc;?>" width="9" height="9"/>
            <?php echo $appForm->labelText('name', array('id'=>$value['ArticleCategory']['id'],'value'=>$value['ArticleCategory']['name'],'modelName'=>'ArticleCategory','fieldName'=>'name','labelName'=>'分类名称','style'=>'width:300px;','uniqueFunction'=>'isExists'));?>
            </td>
            <td><?php echo $childCategoryCount;?></td>
            <td><?php echo $value['ArticleCategory']['article_count'];?></td>
            <td><?php echo $appForm->labelText('order_number', array('id'=>$value['ArticleCategory']['id'],'value'=>$value['ArticleCategory']['order_number'],'modelName'=>'ArticleCategory','fieldName'=>'order_number','labelName'=>'排序','style'=>'width:60px;'));?></td>
            <td class="action">
                 <a href="javaScript:void(0)" onClick="javaScript:addChildCategoryTr('<?php echo $value['ArticleCategory']['id']?>');">添加子分类</a>
                 <a href="javaScript:void(0);" class="del" onClick="javaScript:delArticleCategory(0,<?php echo $value['ArticleCategory']['id'];?>);">删除</a>
             </td>
        </tr>
    <?php if (!empty($value['ChildCategory'])):?>
    <?php foreach($value['ChildCategory'] as $k => $v):?>
        <?php $className = "";?>
        <?php if ($k == count($value['ChildCategory'])-1):?>
        <?php $className="lastOne"?>
        <?php endif;?>
        <tr id="C<?php echo $value['ArticleCategory']['id']?>_<?php echo $v['id'];?>" style="display:none" class="<?php echo $className;?>">
            <td class="first-cell"><img src="/image/admin/menu_minus.gif" width="9" height="9" /> 
            <?php echo $appForm->labelText('name', array('id'=>$v['id'],'value'=>$v['name'],'modelName'=>'ArticleCategory','fieldName'=>'name','labelName'=>'分类名称','style'=>'width:300px;','uniqueFunction'=>'isExists', '','associateKeyValue'=>$value['ArticleCategory']['id']));?>
            </td>
            <td>&nbsp;</td>
            <td><?php echo $v['article_count'];?></td>
            <td id="C<?php echo $value['ArticleCategory']['id']?>_<?php echo $v['id'];?>OrderNumber"><?php echo $appForm->labelText('order_number', array('id'=>$v['id'],'value'=>$v['order_number'],'modelName'=>'ArticleCategory','fieldName'=>'order_number','labelName'=>'排序','style'=>'width:60px;','reloadUrl'=>'/admin/article_category/index/current_parent_id:'.$value['ArticleCategory']['id']));?></td>
            <td class="action">
                <a href="javaScript:void(0);" onClick="javaScript:showCategorySelector(<?php echo $v['id'];?>);">转移文章</a>
                <a href="javaScript:void(0);" class="del" onClick="javaScript:delArticleCategory(<?php echo $value['ArticleCategory']['id'];?>, <?php echo $v['id'];?>);">删除</a>
            </td>
        </tr>
    <?php endforeach;?>
    <?php endif;?>
    <?php endforeach;?>
<?php else:?>
        <tr><td colspan="5"><?php __('info.recodeNotFound');?></td></tr>
<?php endif;?>
        </tbody>
    </table>
</div>
<?php echo $this->element('/article_category/select_category');?>
<?php echo $appForm->end();?>
<script type="text/javascript">
function expand(parentId, flg) {
    if ($("#P"+parentId).hasClass('noChild')) {
        return;
    }

    $("tr[id^='P']").each(function(){
        var parentNodeId = $(this).attr('id');
        var parentImgObj = $("#"+parentNodeId+"Img");
        parentImgObj.unbind('click');

        if (parentNodeId == 'P'+parentId && flg) {
            parentImgObj.bind('click', function(){expand(parentNodeId.substring(1),false)});
            parentImgObj.attr('src','/image/admin/menu_minus.gif');
        } else {
            parentImgObj.bind('click', function(){expand(parentNodeId.substring(1),true)});
            parentImgObj.attr('src','/image/admin/menu_plus.gif');
        }
    });

    $("tr[id^='C']").each(function(){
        var tmpNodeId = $(this).attr('id').toString();
        var tmpParentId = tmpNodeId.substring(1,tmpNodeId.indexOf('_'));
        if (tmpParentId == parentId & flg) {
            $(this).show();
        }else {
            $(this).hide();
        }
    });
}
function addChildCategoryTr(parentId) {
    expand(parentId, true);
    var lastTr = null;
    var lastTrId = null;
    var maxOrderNumber = 0;
    $("tr[id^='C"+parentId+"_']").each(function(){
        lastTr = $(this);
    });
    if (lastTr != null) {
        lastTrId = lastTr.attr('id');
        maxOrderNumber = $("#"+lastTrId+"OrderNumber").find("label").eq(0).text();
    } else {
        lastTr = $("#P"+parentId);
        lastTrId = 'C'+parentId+'_0';
    }

    var newTrId = 'C'+parentId+'_'+(parseInt(lastTrId.substring(lastTrId.toString().indexOf('_')+1))+1);
    var newOrderNumber = parseInt(maxOrderNumber)+1;
    var newTr = '<tr class="lastOne even" id="'+newTrId+'">';
    newTr    += '<td class="first-cell"><img height="9" width="9" src="/image/admin/menu_minus.gif">';
    newTr    += '<input type="hidden" name="data[ArticleCategory][parent_id]" id="'+newTrId+'parentId" value="'+parentId+'" />';
    newTr    += '<input type="text" name="data[ArticleCategory][name]" id="'+newTrId+'Name" onBlur=\'javaScript:createCategory("'+newTrId+'")\'/>';
    newTr    += '<label id="'+newTrId+'ErrMsg" class="error-message"></label>';
    newTr    += '</td>';
    newTr    += '<td>&nbsp;</td>';
    newTr    += '<td>0</td>';
    newTr    += '<td id="'+newTrId+'OrderNumber"><label>'+newOrderNumber+'</label><input type="hidden" name="data[ArticleCategory][order_number]" id="'+newTrId+'OrderNumber" value="'+newOrderNumber+'"/></td>';
    newTr    += '<td class="action"><a class="del" href="javaScript:void(0)" onClick=\'javaScript:delTr("'+newTrId+'");\'>删除</a></td>';
    newTr    += '</tr>';
    $(newTr).insertAfter(lastTr);
    if ($("#P"+parentId).hasClass('noChild')) {
        $("#P"+parentId).removeClass('noChild');
    }
}

function createCategory(trId) {
    var url = '/admin/article_category/add_category2/';
    var parentId = $("#"+trId+"parentId").val();
    $.getJSON(url, {
            parent_id:parentId,
            name:$("#"+trId+"Name").val(),
            order_number:$("input[id='"+trId+"OrderNumber']").val()
        }, function(rs) {
            var categoryCount = $("#P"+parentId+" td").eq(1).text();
            if (rs.success == true) {
                $("#"+trId).outer(rs.result.toString().replace(/&quot;/g, "\""));
                $("#P"+parentId+" td").eq(1).text(parseInt(categoryCount)+1);
            } else {
                $("#"+trId+"ErrMsg").text(rs.errMsg);
            }
            return;
        });
}
function showCategorySelector(id) {
    $("#ArticleCategoryId").val(id);
    getAjaxOptions('/ajax/get_article_category1_option_list', this, 'category1');
    $("#categorySelector").show();
}
function closeCategorySelector(id) {
    $('#categorySelector').hide();
    $("#category1").val('');
    $("#category2").val('');
}
function changeArticleCategory() {
    if ($("#category2").val() == '') {
        alert('<?php echo str_replace('{0}', '分类', __('error.required', true));?>');
        return;
    }
    $("#ArticleCategory").attr('action', '/admin/article_category/change_article_category');
    $("#ArticleCategory").submit();
}
function delArticleCategory(parentId, id) {
    if (confirm('<?php __('info.confirmDelete');?>')) {
        $("#ArticleCategoryParentId").val(parentId);
        $("#ArticleCategoryId").val(id);
        $("#ArticleCategory").attr('action', '/admin/article_category/delete');
        $("#ArticleCategory").submit();
    }
    return false;
}
function delTr(trId) {
    if (confirm('<?php __('info.confirmDelete');?>')) {
        $("#"+trId).remove();
    }
    return false;
}
$(function(){
    $("tr[id^='P']").each(function(){
        var parentId = $(this).attr('id').toString().substring(1);
        $("#P"+parentId+"Img").bind('click', function(){expand(parentId, true);});
    });
    $("#category1").change(function(){
        var selfCategoryId = $("#ArticleCategoryId").val();
        getAjaxOptions('/ajax/get_article_category2_option_list', this, 'category2',selfCategoryId);
    });
});
<?php if (!empty($this->params['named']['current_parent_id'])):?>
expand('<?php echo $this->params['named']['current_parent_id'];?>', true);
<?php endif;?>
</script>