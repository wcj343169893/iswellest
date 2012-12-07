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
function cloneFormElement(orgObj, descNodeId) {
    if ((orgObj.attr('type') == 'radio' && orgObj.attr('checked')) || orgObj.attr('type') != 'radio') {
        $elementStr = "<input type=\"hidden\" name=\""+orgObj.attr('name')+"\" value=\""+orgObj.val()+"\"/>";
        $("#"+descNodeId).append($elementStr);
    }
}
function searchProductByKeywords2(url, event) {
    var keyCode = null;
    if (event.which) {
        keyCode = event.which;
    }
    if (event.keyCode) {
        keyCode = event.keyCode;
    }
    if (keyCode == '13') {
        searchProductByKeywords(url);
    }
}
function searchProductByKeywords(url) {
    if ($("#TopKeywords").val() == '') {
        alert('请输入关键字！');
        return;
    }
    var keywords =  base64.encode($("#TopKeywords").val(), 1);
    keywords = keywords.replace(/\+/g, "-");
    keywords = keywords.replace(/\//g, "_");
    keywords = keywords.replace(/\s+$/g, "=");

    window.location.href=url+"/keywords:"+keywords;
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

function ajaxJumpPage(url, index) {
    var page = $("#jumpPageNo"+index).val();
    if (page == '') {
        alert('页码不能为空！');
        return false;
    }
    if (!checkInteger(page)) {
        alert('页码必须是数字！');
        return false;
    }

    var reg = new RegExp('(/page\:[0-9]*)', 'gi');
    var newUrl = url.replace(reg, "");
    newUrl += '/page:'+page;
    redirect(newUrl);
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
    $("span[id^='focusBtn']").each(function(){//
    	$(this).removeClass("focus_btn_img_hover");
        //$(this).attr('src', '/image/front/focusBtn_1.jpg');
    });
    $("#focusPic"+id).show();
    $("#focusPic"+id).fadeOut(100, function(){$(this).fadeIn(500)});
    $("#focusBtn"+id).fadeOut(100, function(){$(this).addClass("focus_btn_img_hover").fadeIn(300)});
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
function closeLoginPop(popId, location) {
    $.get('/ajax/clear_login_pop_session', {
            location:location
        }, function(rs){
            closePop(popId);
        }
    );
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
function doLogin(event) {
    var keyCode = null;
    if (event.which) {
        keyCode = event.which;
    }
    if (event.keyCode) {
        keyCode = event.keyCode;
    }
    if (keyCode == '13') {
        submitForm('LoginForm');
    }

}

function zenToHan(obj){
    if ($(obj).val().length == 0) {
        return;
    }
    var str = $(obj).val();
    var hanStr = '';
    hanStr = str.replace(/[Ａ-Ｚａ-ｚ０-９＠．]/g, function(s) {
        return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
    });
    hanStr = hanStr.replace(/(ー|─|－)/gi, "-");
    hanStr = hanStr.replace(/(　)/gi, " ");
    $(obj).val(hanStr);
    return;
    /**
    if(typeof($(obj).val())!="string")return false;
    var han= '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@--.,:';
    //var han= '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@.-';
    var zen= '１２３４５６７８９０ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚＡＢＣＤＥＦＧＨＩＪＫＬＭＮＯＰＱＲＳＴＵＶＷＸＹＺ＠－ー．，：';
    //var zen= '１２３４５６７８９０ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚＡＢＣＤＥＦＧＨＩＪＫＬＭＮＯＰＱＲＳＴＵＶＷＸＹＺ＠．－';
    var word = $(obj).val();
    for(i=0;i<zen.length;i++){
        var regex = new RegExp(zen[i],"gm");
        word = word.replace(regex,han[i]);
    }
    $(obj).val(word);
    */
}
function chageLetterCase(obj, toUpperCase) {
    if (toUpperCase == undefined || !toUpperCase) {
        $(obj).val($(obj).val().toLowerCase());
    } else {
        $(obj).val($(obj).val().toUpperCase());
    }
}
function removeHyphen(obj) {
    $(obj).val($(obj).val().replace(/(\-|ー|─|－)/gi, ""));
}
function trimAllSpace(obj) {
    $(obj).val(jQuery.trim($(obj).val()));
    $(obj).val($(obj).val().replace(/\s/gi, ""));
}
function addToBag(product_cd) {
    $.get('/shopping/ajax_add_to_bag/', {
                product_cd:product_cd,
                order_amount:1,
                sale_method:'',
                refresh_bag:true
            }, function(rs){
                $('body').append(rs);
                $("#shoppingBagCountHeader").text($("#shoppingBagCount").text());
            }
    );
}
//动态加载品牌
function loadBrand(cid,elem){
	$.getJSON("/product/getbrand?cid="+cid, function(data){
		$("#"+elem).empty();
		  $.each(data, function(i,item){
			  $("#"+elem).append("<li title='"+item["brand_name"]+"'><a href='/product/list/brand_id:"+item["id"]+"'>"+item["brand_name"]+"</a></li>");
		  });
		});
}
function login(){
	$('#login_window').dialog('open');
	$("#login_window").find("#ajax_username").focus();
	$(".ui-widget-overlay").bind("click", function(){
		$('#login_window').dialog('close');
	});
}
$(function(){
	$('#login_window').dialog({
		autoOpen: false,
		width: 683,
		dialogClass: "login_window",
		maxWidth: 730,
		minWidth: 630,
		maxHeight: 320,
		minHeight: 230,
		modal: true,
		resizable: false,
	});
	
    $("#MemberEmail").keypress(function(e) {
        doLogin(e);
    });
    $("#MemberPassword").keypress(function(e) {
        doLogin(e);
    });
    $("#picPrev").click(function() {
        if (parseInt(beginImgIndex) > 0) {
            beginImgIndex--;
            var index = parseInt(beginImgIndex);
            $("#picBlock li a img").each(function(){
                //$(this).fadeOut(100, function(){$(this).attr('src', pics[index]).fadeIn(100);});
                $(this).attr('src', pics[index]);
                $(this).fadeOut(100);
                $(this).fadeIn(100);
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
                $(this).fadeOut(100);
                $(this).fadeIn(100);
                index++;
            });
        }
        $(this).fadeOut(100, function(){$(this).fadeIn(500);});
    });
});