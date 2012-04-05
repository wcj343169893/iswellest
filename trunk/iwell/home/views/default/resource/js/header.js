function search_focus(oBj,defaultKey){
	oBj.className="active";
	if (oBj.value==defaultKey) {
		oBj.value=""
	};
	document.getElementById("search_input").style.borderColor='#bb0000';
};
function search_blur(oBj,defaultKey){
	oBj.className="";
	if (oBj.value=="") {
		oBj.value=defaultKey
	};
	document.getElementById("search_input").style.cssText="";
};

function show_goods_list(i,Max) {
	for (var x=0;x<Max;x++) {
		document.getElementById("goods_pop_"+x).style.display="none";
	};
	var obj=document.getElementById("goods_pop_"+i);
	obj.style.display="block";
};
function hide_pop(Max){
	for (var x=0;x<Max;x++) {
		document.getElementById("goods_pop_"+x).style.display="none";
	};
};
function mouseleave(e,o,funcCallBack) {   
	if(window.navigator.userAgent.indexOf("MSIE") == "-1") {
		var reltg = e.relatedTarget ? e.relatedTarget : e.type == 'mouseout' ? e.toElement : e.fromElement;
			while (reltg && reltg != o)    
				reltg = reltg.parentNode;      
			if(reltg != o) { 
		funcCallBack();   
		};
	}
	else {   
		if(o.contains(event.toElement ) == false) funcCallBack();   
	}; 
};