var submitFlg = false;

function submitForm(formId) {
//alert(submitFlg);
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
function searchProductByKeywords() {
    if ($("#TopKeywords").val() == '') {
        alert('请输入关键字！');
        return;
    }
    window.location.href="/product/search/keywords:"+$("#TopKeywords").val();
}

function showMenu() {
    $(".my_left_category").removeClass('display-none')
}
function hideMenu() {
    $(".my_left_category").addClass('display-none');
}

function checkInteger(value) {
    var intRegex = /^\d+$/;
    return intRegex.test(value);
}

function redirectTo(url) {
    $.get(url, {
        }, reloadPageContent);
}

function ajaxJumpPage() {
    var page = $("#jumpPageNo").val();
    if (page == '') {
        alert('页码不能为空！');
        return false;
    }
    if (!checkInteger(page)) {
        alert('页码必须是数字！');
        return false;
    }

    var reg = new RegExp('(/page\:.*)', 'gi');
    var newUrl = url.replace(reg, "");
    newUrl += '/page:'+page;

    redirectTo(newUrl);
}
/**
 * 金額をフォーマット
 * @param num
 * @return　フォーマットした金額
 */
function formatCurrency(num) {
    num = num.toString().replace(/\$|\,/g,'');
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num*100+0.50000000001);
    cents = num%100;
    num = Math.floor(num/100).toString();
    if(cents<10)
        cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++) {
        num = num.substring(0,num.length-(4*i+3))+','+ num.substring(num.length-(4*i+3));
    }
    var sum =((sign)?'':'-') + '$' + num + '.' + cents;
    return(sum.replace(/\$/g,''));
}
function showFocusPic(id) {
    $("img[id^='focusPic']").each(function(){
        $(this).hide();
    });
    $("img[id^='focusBtn']").each(function(){
        $(this).attr('src', '/image/front/focusBtn_1.jpg');
    });
    $("#focusPic"+id).show();
    $("#focusPic"+id).fadeOut(100, function(){$(this).fadeIn(500)});
    $("#focusBtn"+id).fadeOut(100, function(){$(this).attr('src', '/image/front/focusBtn_2.jpg').fadeIn(500)});
}

function showLargePic(obj) {
    var src = $(obj).find("img").eq(0).attr('src');
    $("#bigPic").fadeOut(100, function(){$(this).attr("src", src).fadeIn(500)});
}

function showPop(id) {
    var o=$("#"+id);
    var height     = $(window).height();
    var width      = $(window).width();
    var scrollTop  = $(window).scrollTop();
    var scrollLeft = $(window).scrollLeft();
    
    //alert(o.css('width')+';'+scrollLeft+";"+width);
    //alert(o.css('height')+';'+scrollTop+";"+height);

    var itop  = height/2+scrollTop;
    var ileft = width/3 + scrollLeft/2;
    o.appendTo($('body'));
    o.css({
        position:"absolute",
        top:itop+"px",
        left:ileft+"px"
    })
    o.show();
    showBlockOtherOperationDiv();
}
function showBlockOtherOperationDiv() {
    $("#blockOtherOperation").css('height', $('body').css('height'));
    $("#blockOtherOperation").css('width', $('body').css('width'));
    $("#blockOtherOperation").show();
}
function closePop(id) {
    $('#'+id).remove();
    $("#blockOtherOperation").hide();
}
var lastFocusImgIndex = 0;
function autoDispFocusImg() {
    $.each(focusPics, function(index, value){
        if(lastFocusImgIndex < index && focusPics.length > lastFocusImgIndex+1) {
            showFocusPic(value);
            lastFocusImgIndex = index;
            return false;
        } else if (focusPics.length == lastFocusImgIndex+1){
            showFocusPic(focusPics[0]);
            lastFocusImgIndex = 0;
            return false;
        }
    });
}


//调用方式：onkeydown = "DigitInput(this,event);"
function digitInput(el,ev) {
//8：退格键、46：delete、37-40： 方向键
//48-57：小键盘区的数字、96-105：主键盘区的数字
//110、190：小键盘区和主键盘区的小数
//189、109：小键盘区和主键盘区的负号
  var event = ev || window.event;                             //IE、FF下获取事件对象
  var currentKey = event.charCode||event.keyCode;             //IE、FF下获取键盘码
  
  //小数点处理
  if (currentKey == 110 || currentKey == 190) {
      if (el.value.indexOf(".")>=0) 
          if (window.event)                       //IE
              event.returnValue=false;                 //e.returnValue = false;效果相同.
          else                                    //Firefox
              event.preventDefault();
  } else 
      if (currentKey!=8 && currentKey != 46 && (currentKey<37 || currentKey>40) && (currentKey<48 || currentKey>57) && (currentKey<96 || currentKey>105))
          if (window.event)                       //IE
              event.returnValue=false;                 //e.returnValue = false;效果相同.
          else                                    //Firefox
              event.preventDefault();
}

function showWait() {
    $("#blockOtherOperation").css('height', $('body').css('height'));
    $("#blockOtherOperation").css('width', $('body').css('width'));
    $("#blockOtherOperation").show();
    $(".wait-img").show();
}
function hideWait() {
    $(".wait-img").hide();
}

$(function(){
    $("#picPrev").click(function() {
        if (parseInt(beginImgIndex) > 0) {
            beginImgIndex--;
            var index = parseInt(beginImgIndex);
            $("#picBlock li a img").each(function(){
                //$(this).fadeOut(100, function(){$(this).attr('src', pics[index]).fadeIn(100);});
                $(this).attr('src', pics[index]);
                $(this).fadeOut(500);
                $(this).fadeIn(500);
                index++;
            });
        }
        $(this).fadeOut(100, function(){$(this).fadeIn(500);});
    });
    $("#picNext").click(function() {
        if (parseInt(beginImgIndex) +5 < pics.length) {
            beginImgIndex++;
            var index = parseInt(beginImgIndex);
            $("#picBlock li a img").each(function(){
                //$("#bigPic").fadeOut(100, function(){$(this).attr("src", src).fadeIn(500)});
                //$(this).fadeOut(100, function(){$(this).attr('src', pics[index]).fadeIn(100)});
                $(this).attr('src', pics[index]);
                $(this).fadeOut(500);
                $(this).fadeIn(500);
                index++;
            });
        }
        $(this).fadeOut(100, function(){$(this).fadeIn(500);});
    });
});