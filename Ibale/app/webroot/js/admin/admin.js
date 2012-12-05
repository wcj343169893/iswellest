function checkAll(obj, countId) {
    var obj = $(obj);
    var count = 0;
    objId = obj.attr("id");

    if (obj.attr("checked")) {
        $("input[id^='"+objId+".']").each(function(){
            if ($(this).attr("type") == 'checkbox') {
                $(this).attr("checked", true);
                count++;
            }
        });
    } else {
        $("input[id^='"+objId+".']").each(function(){
            if ($(this).attr("type") == 'checkbox') {
                $(this).attr("checked", false);
            }
        });
    }

    if ($("#"+countId).length != 0) {
        $("#"+countId).text(count);
    }
}
function checkObj(obj, parentId, countId) {
    var obj = $(obj);
    var count = 0;
    objId = obj.attr("id");

    if (!obj.attr("checked")) {
        var checkFlg = false;
        $("input[id^='"+parentId+".']").each(function(){
            if ($(this).attr("type") == 'checkbox' && $(this).attr("checked") == true) {
                checkFlg |= true;
            }
        });
        if (!checkFlg) {
            $("input[id='"+parentId+"']").attr("checked", false);
        }
        count -= 1;
    } else {
        $("input[id='"+parentId+"']").attr("checked", true);
        count += 1;

    }

    if ($("#"+countId).length != 0) {
        $("#"+countId).text(parseInt($("#"+countId).text())+count);
    }
}
function checkObj2(obj, parentId, countId) {
    var obj = $(obj);
    var count = 0;

    $("input[id^='"+parentId+".']:checkbox").each(function(){
        if ($(this).attr("checked")) {
            count++;
        } else {
            $("input[id='"+parentId+"']").attr("checked", false);
        }
    });

    if ($("#"+countId).length != 0) {
        $("#"+countId).text(count);
    }
}
function hasChecked(parentId) {
    var checked = false;

    $("input[id^='"+parentId+".']").each(function(){
        if ($(this).attr("checked")) {
            checked = true;
        }
    });
    return checked;
}