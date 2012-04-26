/*
 * 	Easy Slider 1.7 - jQuery plugin
 *	written by Alen Grakalic	
 *	http://cssglobe.com/post/4004/easy-slider-15-the-easiest-jquery-plugin-for-sliding
 *
 *	Copyright (c) 2009 Alen Grakalic (http://cssglobe.com)
 *	Dual licensed under the MIT (MIT-LICENSE.txt)
 *	and GPL (GPL-LICENSE.txt) licenses.
 *
 *	Built for jQuery library
 *	http://jquery.com
 *
 */
 
/*
 *	markup example for $("#slider").easySlider();
 *	
 * 	<div id="slider">
 *		<ul>
 *			<li><img src="images/01.jpg" alt="" /></li>
 *			<li><img src="images/02.jpg" alt="" /></li>
 *			<li><img src="images/03.jpg" alt="" /></li>
 *			<li><img src="images/04.jpg" alt="" /></li>
 *			<li><img src="images/05.jpg" alt="" /></li>
 *		</ul>
 *	</div>
 *
 */

(function($) {

	$.fn.easySlider = function(options){
	  
		// default configuration properties
		var defaults = {			
			prevId: 		'nextButton',
			prevText: 		'Prev',
			nextId: 		'prvButton',	
			nextText: 		'Next',
			controlsShow:	true,
			controlsBefore:	'',
			controlsAfter:	'',	
			controlsFade:	true,
			firstId: 		'firstBtn',
			firstText: 		'First',
			firstShow:		false,
			lastId: 		'lastBtn',	
			lastText: 		'Last',
			lastShow:		false,				
			vertical:		false,
			speed: 			800,
			auto:			false,
			pause:			20000,
			continuous:		false, 
			numeric: 		false,
			numericId: 		'controls',
			showCount:		5,
			isMagnifier:	true
			
		}; 
		
		var options = $.extend(defaults, options);  
				
		this.each(function() {  
			var obj = $(this); 				
			var s = $("li", obj).length;
			var w = $("li", obj).width()+8; 
			var h = $("li", obj).height(); 
			var clickable = true;
			obj.width(w*options.showCount); 
			obj.height(h); 
			obj.css("overflow","hidden");
			var ts = s-options.showCount;
			var t = 0;
			$("ul", obj).css('width',s*w);			
			
			if(options.continuous){
				$("ul", obj).prepend($("ul li:last-child", obj).clone().css("margin-left","-"+ w +"px"));
				$("ul", obj).append($("ul li:nth-child(2)", obj).clone());
				$("ul", obj).css('width',(s+1)*w);
			};				
			
			if(!options.vertical) $("li", obj).css('float','left');
								
			if(options.controlsShow){
				var html = options.controlsBefore;				
				if(options.numeric){
					html += '<ol id="'+ options.numericId +'"></ol>';
				} else {
//					if(options.firstShow) html += '<span id="'+ options.firstId +'"><a href=\"javascript:void(0);\">'+ options.firstText +'</a></span>';
//					html += ' <span id="'+ options.prevId +'"><a href=\"javascript:void(0);\">'+ options.prevText +'</a></span>';
//					html += ' <span id="'+ options.nextId +'"><a href=\"javascript:void(0);\">'+ options.nextText +'</a></span>';
//					if(options.lastShow) html += ' <span id="'+ options.lastId +'"><a href=\"javascript:void(0);\">'+ options.lastText +'</a></span>';				
				};
				
				html += options.controlsAfter;						
				$(obj).after(html);										
			};
			if(options.isMagnifier){
				//增加放大镜效果
				//新增放大div  magnifier
				var magnifier_id="originalImage";
				var magnifier_div='<a href="/shops/23" class="gimg" data-img-url=""><img src="" alt=""><span class="imgInfoBottom imgInfoBottomShops"><span class="floatLeft"><h3></h3></span><span class="viewDet floatRight round20 fabGrad"><span class="fabShopSprite gtIcon imgInfoArrow"></span></span></span></a>';
				
				$("#"+magnifier_id).append(magnifier_div);	
				$("li", obj).each(function(index,domEle){
					$(domEle).bind("mouseover",
						  function () {
							  $("#"+magnifier_id).css({
								  	"left":$(domEle).offset().left-250
							  });
							  $("img","#"+magnifier_id).attr("src",$("img",domEle).attr("src"));
							  $("h3","#"+magnifier_id).html($("h3",domEle).html());
							  $("a.gimg","#"+magnifier_id).attr("href", $("a.gimg",domEle).attr("href"));
							  $(obj).css({
								  "opacity":"0.6",	
								  "filter":"Alpha(opacity=60)"
							  });
							  $("#"+magnifier_id).removeClass("displayNone");
						  }
						);
				});
				var st="";
				$("#originalImage").bind("mouseout",function() {
					//设置1秒后关闭
					clearTimeout(st);
					st=setTimeout(function(){
					$("#"+magnifier_id).addClass("displayNone");
					$(obj).css({
						  "opacity":"1",
						  "filter":"Alpha(opacity=100)"
					  });
					},3000);
				});
			}
			
			if(options.numeric){									
				for(var i=0;i<s;i++){						
					$(document.createElement("li"))
						.attr('id',options.numericId + (i+1))
						.html('<a rel='+ i +' href=\"javascript:void(0);\">'+ (i+1) +'</a>')
						.appendTo($("#"+ options.numericId))
						.click(function(){							
							animate($($(this)).attr('rel'),true);
						}); 												
				};							
			} else {
				$("#"+options.nextId).click(function(){		
					animate("next",true);
				});
				$("#"+options.prevId).click(function(){		
					animate("prev",true);				
				});	
				$("#"+options.firstId).click(function(){		
					animate("first",true);
				});				
				$("#"+options.lastId).click(function(){		
					animate("last",true);				
				});				
			};
			
			function setCurrent(i){
				i = parseInt(i)+1;
				$("li", "#" + options.numericId).removeClass("current");
				$("li#" + options.numericId + i).addClass("current");
			};
			
			function adjust(){
				if(t>ts) t=0;		
				if(t<0) t=ts;	
				if(!options.vertical) {
					$("ul",obj).css("margin-left",(t*w*-1));
				} else {
					$("ul",obj).css("margin-left",(t*h*-1));
				}
				clickable = true;
				if(options.numeric) setCurrent(t);
			};
			
			function animate(dir,clicked){
				if (clickable){
					clickable = false;
					var ot = t;			
					switch(dir){
						case "next":
							t = (ot>=ts) ? (options.continuous ? t+1 : ts) : t+1;						
							break; 
						case "prev":
							t = (t<=0) ? (options.continuous ? t-1 : 0) : t-1;
							break; 
						case "first":
							t = 0;
							break; 
						case "last":
							t = ts;
							break; 
						default:
							t = dir;
							break; 
					};	
					var diff = Math.abs(ot-t);
					var speed = diff*options.speed;						
					if(!options.vertical) {
						p = (t*w*-1);
						$("ul",obj).animate(
							{ marginLeft: p }, 
							{ queue:false, duration:speed, complete:adjust }
						);				
					} else {
						p = (t*h*-1);
						$("ul",obj).animate(
							{ marginTop: p }, 
							{ queue:false, duration:speed, complete:adjust }
						);					
					};
					
					if(!options.continuous && options.controlsFade){	
						if(t==ts){
							$("#"+options.nextId).hide();
							$("#"+options.lastId).hide();
						} else {
							$("#"+options.nextId).show();
							$("#"+options.lastId).show();					
						};
						if(t==0){
							$("#"+options.prevId).hide();
							$("#"+options.firstId).hide();
						} else {
							$("#"+options.prevId).show();
							$("#"+options.firstId).show();
						};					
					};				
					
					if(clicked) clearTimeout(timeout);
					if(options.auto && dir=="next" && !clicked){;
						timeout = setTimeout(function(){
							animate("next",false);
						},diff*options.speed+options.pause);
					};
			
				};
				
			};
			// init
			var timeout;
			if(options.auto){;
				timeout = setTimeout(function(){
					animate("next",false);
				},options.pause);
			};		
			
			if(options.numeric) setCurrent(0);
		
			if(!options.continuous && options.controlsFade){					
				$("#"+options.prevId).hide();
				$("#"+options.firstId).hide();				
			};				
			
		});
	  
	};

})(jQuery);



