function lxfEndtime(){
    $(".remainTime").each(function() {
        var lxfday=$(this).attr("lxfday");
        var endtime = new Date($(this).attr("endtime")).getTime();
        var nowtime = new Date().getTime();
        var youtime = endtime-nowtime;
        var seconds = youtime/1000;
        var minutes = Math.floor(seconds/60);
        var hours = Math.floor(minutes/60);
        var days = Math.floor(hours/24);
        var CDay= days ;
        var CHour= hours % 24;
        var CMinute= minutes % 60;
        var CSecond= Math.floor(seconds%60);
        if(endtime<=nowtime){
            $(this).html("0天0小时0分钟0秒");
            if ($(this).parent().find(".buy .btnBuy").length != 0) {
                var obj = $(this).parent().find(".buy .btnBuy").eq(0);
                obj.removeClass('btnBuy');
                obj.addClass('btnStop');
            }else if ($(this).parent().parent().find(".priceBuy .saleBtn .btnBuyb").length !=0) {
                var obj = $(this).parent().parent().find(".priceBuy .saleBtn .btnBuyb").eq(0);
                obj.removeClass('btnBuyb');
                obj.addClass('btnStopb');
            }
        } else {
            $(this).html(days+"天"+CHour+"小时"+CMinute+"分钟"+CSecond+"秒");
        }
    });
    setTimeout("lxfEndtime()",1000);
};
$(function(){
    lxfEndtime();
});