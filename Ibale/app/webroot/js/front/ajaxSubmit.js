function ajaxSubmit(dispDivId, hiddenDivId, formId) {
    $("#"+hiddenDivId).contents().find('body').empty();

    var formIdNew = formId+'Hidden';
    var action = $("#"+dispDivId+" #"+formId).attr('action');

    var formStr = "<FORM id=\""+formIdNew+"\" accept-charset=\"utf-8\" method=\"post\" action=\""+action+"\">";
    $("#"+formId+" :input").each(function(){
        formStr += $(this).outer();
    });
    formStr += "</FORM>";
    $("#"+hiddenDivId).contents().find('body').html(formStr);

    $("#"+hiddenDivId).contents().find("body :input").each(function(){
        if ($(this).attr('type') == 'radio' || $(this).attr('type') == 'checkbox') {
            $(this).attr('checked', false);
        }
    });
    $("#"+dispDivId+" :input").each(function(){
        if (($(this).attr('type') == 'radio' || $(this).attr('type') == 'checkbox' )&& $(this).attr('checked')) {
            $("#"+hiddenDivId).contents().find("#"+$(this).attr('id')).attr('checked', true);
        } else if ($(this).attr('type') != 'radio' && $(this).attr('type') != 'checkbox') {
            $("#"+hiddenDivId).contents().find("#"+$(this).attr('id')).val($(this).val());
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
        $(this).contents().find("body").empty();
    });

    $("#"+hiddenDivId).contents().find("#"+formIdNew).attr('target', 'tempIframe');
    $("#"+hiddenDivId).contents().find("#"+formIdNew).submit();

    return false;
}
