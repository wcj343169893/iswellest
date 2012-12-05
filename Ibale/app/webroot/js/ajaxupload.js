/**
 * 画像をアップロード
 * @param obj           "file"オブジェクト
 * @param savePath      画像を保存する用のパス
 * @param widthNew      新しい画像の幅
 * @param heightNew     新しい画像の高
 * @param dispImgDivId  新しい画像のプレビュー用のDIVのID
 * @param imgPath       新しい画像のパスを保存する用の"hidden"オブジェクトのID
 */
function ajaxUploadImg(obj, savePath,widthNew, heightNew, dispImgDivId, imgPath) {
    $("#uploadImg input[type='file']").remove();
    if ( $.browser.msie || $.browser.safari) {
        var parentNode = $("#"+obj.id).parent();
        var prevNode = parentNode.children().eq($("#"+obj.id).index() -1);
        $("#uploadImg").append(obj);
        $(obj.outerHTML).insertAfter(prevNode)
    } else {
        $("#uploadImg").append($(obj).clone());
    }

    $("#savePath").val(savePath);
    $("#widthNew").val(widthNew);
    $("#heightNew").val(heightNew);
    $("body iframe[id='tempIframe']").remove();
    $('body').append('<iframe id="tempIframe" src="" name="tempIframe" style="display:none;width:0px;height:0px;"></iframe>');

    $("#"+dispImgDivId).css("background-repeat", "no-repeat");
    $("#"+dispImgDivId).css("background-position", "center");
    $("#"+dispImgDivId).css("background-image", "url(/image/wait.gif)");
    //$('#tempIframe').unbind('load');
    $('#tempIframe').bind('load', function(){
        if ($(this).contents().find("body").find("#uploadedImg").length == 0) {
            $("#"+dispImgDivId).css("background-image", "");
            $("#"+dispImgDivId).html($('#tempIframe').contents().find("body").html());
            return;
        }
        var uploadedImgPath = $(this).contents().find("body").find("#uploadedImg").text();
        $("#"+imgPath).val(uploadedImgPath);
        $("#"+dispImgDivId).css("background-image", "");
        var width = $("#"+dispImgDivId+ " img").attr('width');
        var height = $("#"+dispImgDivId+ " img").attr('height');
        var imgTag = "<img src=\""+uploadedImgPath+"\" width=\""+width+"\" height=\""+height+"\"/>";
        $("#"+dispImgDivId).html(imgTag);
    });

    $("#uploadImg").attr('target', 'tempIframe');
    $("#uploadImg").submit();
    return ;
}