// 对Cookie进行读取,添加,删除操作
var cookie={
//------------------------------------------Get start------------------------------------------// 

  	//读取cookie,n为cookie名 
	Get:function(n){ 
		
		//根据cookie名建立一个正则表达式
   		var re=new RegExp("(?:;)?"+n+"=([^;]*);?");

		//判断是否有返回值
		if(re.test(document.cookie)) 
		{
			//从cookie中取出值,并返回
   			return decodeURIComponent(RegExp["$1"]);
		}else{
			
			//返回null
			return null;
		}
   	}, //读取cookie结束
	
//------------------------------------------Get end------------------------------------------//
   
   
//------------------------------------------Set start------------------------------------------//

	//写入cookie,n为cookie名，v为value 
   	Set:function(n,v){
			
		//创建一个时间对象t
   		var eTime=new Date();
	
		//Cookie失效时间为1小时,8.64e7 一天, 3.6e6 一小时 
		eTime.setTime(eTime.getTime() + (1 * 3.6e6));
		
		//Cookie路径
		var path = "/";
		
		//Cookie域
		var domain;
		
		//Cookie安全标志
		var secure;
		
		//定义一个字符串变量,用来存放Cookie的属性值
		var sCookie = n + "=" +encodeURIComponent(v) +";expires=" + eTime.toGMTString()+"; path=" + path;

		//将信息写入cookie
		document.cookie = sCookie;
   	
	},//写入cookie结束
	
//------------------------------------------Set end------------------------------------------//


//------------------------------------------Del end------------------------------------------//     
   
	//删除cookie
	Del:function(n){ 
		
		//Cookie路径
		var path = "/";
		
		//Cookie域
		var domain;
		
		//Cookie安全标志
		var secure;
		
		//定义一个字符串变量,用来存放Cookie的属性值
		var sCookie = n + "=" + "" + ";expires=" + new Date(0).toGMTString() + "; path=" + path;
		
		//将信息写入cookie
		document.cookie = sCookie;

		//购物车里商品的总价
		amount = 0;
   	} 

//------------------------------------------Del end------------------------------------------// 
};
