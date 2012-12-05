/**
 * 親IDより子のリストを取得
 * @param url 親IDより子のリストを取得する用のURL
 * @param obj 親Obj
 * @param url 子ObjのID
 * @param excludeValue 削除必要なOPTION値
 */
function getAjaxOptions(url, obj, childNodeId, excludeValue) {
    $.post(url, {
                parentId    : $(obj).val()
            }, function(rs) {
                $("#" + childNodeId +" >option[value!='']").remove();
                $("#" + childNodeId).append(rs);
                if (excludeValue != undefined) {
                    $("#"+childNodeId+" >option[value='"+excludeValue+"']").remove();
                }
                return;
            }
        );
}