var aj=new Object();
aj.request=function(){


	if(window.XMLHttpRequest){

		var ajax=new XMLHttpRequest();

	}else{

	var arra=['Microsoft.XMLHTTP', 'MSXML.XMLHTTP', 'Microsoft.XMLHTTP', 'Msxml2.XMLHTTP.7.0', 'Msxml2.XMLHTTP.6.0', 'Msxml2.XMLHTTP.5.0', 'Msxml2.XMLHTTP.4.0', 'MSXML2.XMLHTTP.3.0', 'MSXML2.XMLHTTP'];

	for(i=0;i<arra.length;i++){
		try{
			var ajax=new ActiveXObject(arra[i]);
			if(ajax){
				return ajax;
			}

		}catch(e){
			
			var ajax=false;

		}	


	}

}
		return ajax;	
}
aj.req=aj.request();



aj.Handle=function(callback){
	aj.req.onreadystatechange=function(){

		if(aj.req.readyState==4){
			if(aj.req.status==200){
				callback(aj.req.responseText);
			}

		}

	}

}


aj.cl=function(o){
	if(typeof(o)=='object'){
		var str='';
		for(a in o){
			str+=a+'='+o[a]+'&';

		}
		str=str.substr(-1);
		return str;

	}else{

		return o;
	}

}

aj.get=function(url,callback){

	aj.req.open('get',url);
	aj.req.send(null);

	

	aj.Handle(callback);


}

aj.post=function(url,content,callback){
	aj.req.open('post',url);
	aj.req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	content=aj.cl(content);
	aj.req.send(content);
	aj.Handle(callback);
	

}

