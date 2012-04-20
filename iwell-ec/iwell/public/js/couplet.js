


lastScrollY=0;
function heartBeat(){
var diffY;
if (document.documentElement && document.documentElement.scrollTop)
diffY = document.documentElement.scrollTop;
else if (document.body)
diffY = document.body.scrollTop
else
{/*Netscape stuff*/}
percent=.1*(diffY-lastScrollY);
if(percent>0)percent=Math.ceil(percent);
else percent=Math.floor(percent);
document.getElementById("full").style.top=parseInt(document.getElementById("full").style.top)+percent+"px";
lastScrollY=lastScrollY+percent;
if(diffY == 0){document.getElementById("full").style.display = "none"}
else{document.getElementById("full").style.display = "block"}
}
suspendcode="<div id=\"full\" class='full1' style='display:none; POSITION:absolute; left:95%; top:400px; z-index:100;'><a href='javascript:top()'  target='_self'><img src='../../../../public/images/top.gif'/></a></div>"
document.write(suspendcode);
window.setInterval("heartBeat()",1);
function top(){
	//	scrollTo(0,0)
	document.body.scrollTop = 0 ;
	document.documentElement.scrollTop = 0;
}



