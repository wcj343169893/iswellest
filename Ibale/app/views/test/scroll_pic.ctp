<style>
<!--
#scrollingText {
    border: 1px solid #CCCCCC;
    height: 100px;
    padding: 2px 0;
    position: relative;
    width: 150px;
}

-->
</style>
<html>
<head>
<link href="/css/front/smoothDivScroll.css" type="text/css" rel="Stylesheet">
<script type="text/javascript" src="/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/js/jquery.smoothDivScroll-1.1.js"></script>
<script type="text/javascript" src="/js/Groject.ImageSwitch.yui.js"></script>
</head>
<body>
<div id="scrollingText">
        <div class="scrollingHotSpotLeft" ></div>
        <div class="scrollingHotSpotRight"></div>
        <div class="scrollWrapper">
            <div class="scrollableArea" style="width: 500px;">
            <img src="/image/upload/ad/products_sort_left.jpg" width="100" height="100"/>
            <img src="/image/upload/ad/products_sort_left.jpg" width="100" height="100"/>
            <img src="/image/upload/ad/products_sort_left.jpg" width="100" height="100"/>
            </div>
        </div>
    </div>
<img src="/image/upload/ad/products_sort_left.jpg" alt="Slash" class="Slash"/>
<p id="demo" rel="/image/upload/ad/products_sort_left.jpg">テキスト</p>
<div id="PicBlock">
    <span id="up">up</span>
    <p><img src="http://farm4.static.flickr.com/3214/3142429603_3b4ddd96a9.jpg" width="100" height="100"></p>
    <p><img src="http://farm4.static.flickr.com/3244/3142386073_87c62671a5.jpg" width="100" height="100"></p>
    <span id="down">down</span>
</div>
</body>
</html>
<script>
$(document).ready(function(){
    $("#demo").click(function(){ //切り替えるときのボタンid
        $(".Slash").ImageSwitch({Type:$(this).attr("class"), 
            NewImage:$(this).attr("rel"),   
            Direction:"DownTop"　//動き通常は左右
            });
    });
});
</script>
<script>
$(window).load(function() {
/**
    $("div#scrollingText").smoothDivScroll(
                {autoScroll: "always", autoScrollDirection: "endlessloopright", autoScrollStep: 1, autoScrollInterval: 15});
        
 
 */       
        $("div#scrollingText").bind("mouseover", function(){
            $("div#scrollingText").smoothDivScroll("stopAutoScroll");
        });
        
        $("div#scrollingText").bind("mouseout", function(){
            $("div#scrollingText").smoothDivScroll("startAutoScroll");
        });
        
    });
    // Mouse over
    $("div#scrollingText").bind("mouseover", function(){
        $("div#scrollingText").smoothDivScroll("stopAutoScroll");
    });
    
    // Mouse out
    $("div#scrollingText").bind("mouseout", function(){
        $("div#scrollingText").smoothDivScroll("startAutoScroll");
    });
</script>
<script>
var pics=[
          "http://farm4.static.flickr.com/3214/3142429603_3b4ddd96a9.jpg",
          "http://farm4.static.flickr.com/3244/3142386073_87c62671a5.jpg",
          "http://farm4.static.flickr.com/3113/3142386067_fc176636eb.jpg",
          "http://farm4.static.flickr.com/3089/3143248598_018daa38eb.jpg"
       ];
var beginImgIndex = 0;
$(function(){
    $("#up").click(function() {
        if (parseInt(beginImgIndex) > 0) {
            beginImgIndex--;
            var index = parseInt(beginImgIndex);
            $("#picBlock p img").each(function(){
                $(this).attr('src', pics[index]);
                index++;
            });
        }
    });
    $("#down").click(function() {
        if (parseInt(beginImgIndex) +2 < pics.length) {
            beginImgIndex++;
            var index = parseInt(beginImgIndex);
            $("#picBlock p img").each(function(){
                $(this).attr('src', pics[index]);
                index++;
            });
        }
    });
});
</script>
<img src="http://farm4.static.flickr.com/3214/3142429603_3b4ddd96a9.jpg" width="100" height="100"/>
<img src= "http://farm4.static.flickr.com/3244/3142386073_87c62671a5.jpg" width="100" height="100"/>
<img src= "http://farm4.static.flickr.com/3113/3142386067_fc176636eb.jpg" width="100" height="100"/>
<img src= "http://farm4.static.flickr.com/3089/3143248598_018daa38eb.jpg" width="100" height="100"/>




