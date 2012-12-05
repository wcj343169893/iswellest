var submitFlg = false;

function submitForm(formId) {
    if (submitFlg) {
        return false;
    }
    submitFlg = true;
    $("#"+formId).submit();
}

function redirect(url) {
    window.location.href = url;
    return;
}

$.fn.outer = function(val){
    if(val){
        $(val).insertBefore(this);
        $(this).remove();
    }
    else{ return $("<div>").append($(this).clone()).html(); }
};

$.fn.cloneWithAttribut = function( withDataAndEvents ){
    if (jQuery.support.noCloneEvent){
        return $(this).clone(withDataAndEvents);
    }else{
        $(this).find("*").each(function(){
            $(this).data("name", $(this).attr("name"));
        });
        var clone = $(this).clone(withDataAndEvents);

        clone.find("*").each(function(){
            $(this).attr("name", $(this).data("name"));
        });
        return clone;
    }
};

$(function(){
    $("tr:odd").addClass("odd");
    $("tr:even").addClass("even");
});