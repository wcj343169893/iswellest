<script>
$(function(){
    $("#CategoryTopCategory1").change(function(){
        getAjaxOptions('/ajax/get_category_option_list', this, 'CategoryTopCategory2');
    });
});


function addFocusPic(type, blockDivId) {
    var nextKey = 1;
    if (blockDivId == undefined) {
        blockDivId = "focusPicBlock";
    }
    if ($("#"+blockDivId+" div").last().length != 0) {
        var lastNodeId = $("#"+blockDivId+" div").last().attr('id');
        nextKey        = parseInt(lastNodeId.substring(8))+1;
    }

    $.get('/ajax/create_focus_template', {
        key:nextKey,
        type:type
    }, function(rs){
        $("#"+blockDivId).append(rs);
        __resetLabelNo(blockDivId,'focusPic','focusPicNo');
        $("#focusPicRequired").hide();
    });
}
function delFocusPic(obj, blockDivId) {
    $(obj).parent().parent().remove();
    if (blockDivId == undefined) {
        blockDivId = "focusPicBlock";
    }
    __resetLabelNo(blockDivId,'focusPic','focusPicNo');
}
function addActiveAd(type) {
    var nextKey = 1;
    if ($("#activeAdBlock div").last().length != 0) {
        var lastNodeId = $("#activeAdBlock div").last().attr('id');
        nextKey        = parseInt(lastNodeId.substring(8))+1;
    }

    $.get('/ajax/create_active_ad_template', {
        key:nextKey,
        type:type
    }, function(rs){
        $("#activeAdBlock").append(rs);
        __resetLabelNo('activeAdBlock','activeAd','activeAdNo');
        $("#activeAdRequired").hide();
    });
}
function delActiveAd(obj) {
    $(obj).parent().parent().remove();
    __resetLabelNo('activeAdBlock','activeAd','activeAdNo');
}

function addBrand() {
    var out = '';
    var nextKey = 1;
    var isDuplicate = false;

    var selectedBrandId = null;
    $.each(textValueBrand, function(index, value){
        if ($("#brandNameSearch").val() == value[1] || $("#brandNameSearch").val() == value[2]) {
            selectedBrandId = value[0];
        }
    });
    if (selectedBrandId == null) {
        alert('<?php echo renderMsg(__('error.notExists', true),'品牌');?>');
        return;
    }

    $("#brandBlock input[id^='brandId']").each(function(){
        if (selectedBrandId == $(this).val()) {
            isDuplicate = true;
        }
    });
    if (isDuplicate) {
        alert('<?php __('error.brandCdIsDuplicate');?>');
        return;
    }

    if ($("#brandBlock input").last().length != 0) {
        var lastNodeId = $("#brandBlock input").last().attr('id');
        nextKey    = parseInt(lastNodeId.substring(7))+1;
    }

    
    out += '<li id="liBrand'+nextKey+'"><input type="hidden" name="data[CategoryTop][brand]['+nextKey+'][id]" id="brandId'+nextKey+'"value="'+selectedBrandId+'"/>';
    out += '- '+$("#brandNameSearch").val()+'<a href="javaScript:void(0);" class="del" onClick="javaScript:delBrand('+nextKey+');">[删除]</a></li>';
    $("#brandBlock").append(out);
    $("#brandNameSearch").val('');
    $("#brandRequired").hide();
}
function delBrand(id) {
    $("#liBrand"+id).remove();
}
function addCategoryProduct(type) {
    var lastNodeId = '';
    var nextKey = 0;

    if ($("div[id^='categoryProduct']").length > 1) {
        nextKey = parseInt($("div[id^='categoryProduct']").last().attr('id').substring(15))+1;
    }

    $.get('/ajax/create_category_product_template', {
        key:nextKey,
        type:type
    }, function(rs){
        $("#categoryProductBlock").append(rs);
        __resetLabelNo('categoryProductBlock','categoryProduct','categoryProductNo');
        $("#categoryProductRequired").hide();
    });
}
function delCategoryProduct(obj) {
    $(obj).parent().parent().remove();
    __resetLabelNo('categoryProductBlock','categoryProduct','categoryProductNo');
}
function addLeftAd(type) {
    var nextKey = 0;
    if ($("#leftAdBlock div").last().length != 0) {
        var lastNodeId = $("#leftAdBlock div").last().attr('id');
        nextKey        = parseInt(lastNodeId.substring(6))+1;
    }

    $.get('/ajax/create_left_ad_template', {
        key:nextKey,
        type:type
    }, function(rs){
        $("#leftAdBlock").append(rs);
        __resetLabelNo('leftAdBlock','leftAd','leftAdNo');
        $("#leftAdRequired").hide();
    });
}
function delLeftAd(obj) {
    $(obj).parent().parent().remove();
    __resetLabelNo('leftAdBlock','leftAd','leftAdPicNo');
}

function __resetLabelNo(blockId,elementId,labelNoId) {
    var firstId = 1;
    $("#"+blockId+" div[id^='"+elementId+"']").each(function(){
        if ($(this).attr('id') == blockId) return;
        //$(this).attr('id', elementId+firstId);
        $(this).find("#"+labelNoId).text(firstId);
        firstId++;
    });
}
function delUnderFocusAd(key) {
    $("#underFocusAdPath"+key).val('');
    $("#underFocusAdFile"+key).val('');
    $("#pUnderFocusAd"+key).children().eq(0).attr('src', '/image/admin/img_6.gif');
    $("#underFocusAdUrl"+key).val('');
    $("#underFocusAdComment"+key).val('');
}

function moveUp(obj) {
    var currentIndex = $(obj).parent().parent().index();
    if (currentIndex == 1) {
        return;
    }
    $(obj).parent().parent().insertBefore($("#categoryProductBlock").children().eq(parseInt(currentIndex)-1));
    //順番を変更
    $("#categoryProductBlock").children().eq(currentIndex).find("#categoryOrderNumber").val(currentIndex);
    $(obj).parent().parent().find("#categoryOrderNumber").val(parseInt(currentIndex)-1);

    __resetLabelNo('categoryProductBlock','categoryProduct','categoryProductNo');
}
function moveDown(obj) {
    var currentIndex = $(obj).parent().parent().index();
    if (currentIndex == $("#categoryProductBlock").children().length) {
        return;
    }
    $(obj).parent().parent().insertAfter($("#categoryProductBlock").children().eq(parseInt(currentIndex)+1));
    //順番を変更
    $("#categoryProductBlock").children().eq(currentIndex).find("#categoryOrderNumber").val(currentIndex);
    $(obj).parent().parent().find("#categoryOrderNumber").val(parseInt(currentIndex)+1);

    __resetLabelNo('categoryProductBlock','categoryProduct','categoryProductNo');
}

</script>