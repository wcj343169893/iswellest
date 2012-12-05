function ajaxSubmit(dispDivId, hiddenDivId, formId) {
    $("#"+hiddenDivId).empty();

    var formIdNew = formId+'Hidden';
    var action = $("#"+dispDivId+" #"+formId).attr('action');

    //if ( $.browser.msie || $.browser.safari) {
        //$("#"+hiddenDivId).append($("#"+dispDivId).html());
        var formStr = "<FORM id=\""+formIdNew+"\" accept-charset=\"utf-8\" method=\"post\" action=\""+action+"\">";
        $("#"+dispDivId+" :input").each(function(){
            formStr += $(this).outer();
        });
        formStr += "</FORM>";
        $("#"+hiddenDivId).html(formStr);
    //} else {
    //    $("#"+hiddenDivId).append($("#"+dispDivId).clone());
    //}

    $("#"+dispDivId+" :input").each(function(){
        $("#"+hiddenDivId+" #"+$(this).attr('id')).val($(this).val());
        if ($(this).attr('type') == 'radio') {
            var checkedValue = $("#"+dispDivId+" input[name='"+$(this).attr('name')+"']:checked").val();
            $("#"+hiddenDivId+" input[name='"+$(this).attr('name')+"'][value="+checkedValue+"]").attr('checked', true);
        }
    });

    $("#"+dispDivId+" :input").each(function(){
        $("#"+hiddenDivId+" #"+$(this).attr('id')).val($(this).val());
        if ($(this).attr('type') == 'radio') {
            var checkedValue = $("#"+dispDivId+" input[name='"+$(this).attr('name')+"']:checked").val();
            $("#"+hiddenDivId+" input[name='"+$(this).attr('name')+"'][value="+checkedValue+"]").attr('checked', true);
        }
    });

    $("body iframe[id='tempIframe']").remove();
    $('body').append('<iframe id="tempIframe" src="" name="tempIframe" style="display:none;width:0px;height:0px;"></iframe>');

    $("#"+dispDivId).css("background-repeat", "no-repeat");
    $("#"+dispDivId).css("background-position", "center");
    $("#"+dispDivId).css("background-image", "url(/image/wait.gif)");

    $('#tempIframe').load(function(){
        if ($(this).contents().find('body #redirectUrl').length > 0) {
            redirect($(this).contents().find('body #redirectUrl').text());
            return false;
        }
        $("#"+dispDivId).css("background-image", "");
        $("#wait").hide();
        $("#"+dispDivId).empty();
        if ($(this).contents().find("body #"+dispDivId).length != 0) {
            $("#"+dispDivId).append($(this).contents().find("body #"+dispDivId).html());
        } else {
            $("#"+dispDivId).append($(this).contents().find("body").html());
        }
        //wait
    });

    $("#"+hiddenDivId+" #"+formIdNew).attr('target', 'tempIframe');
    $("#"+hiddenDivId+" #"+formIdNew).submit();
    
    return false;
}
