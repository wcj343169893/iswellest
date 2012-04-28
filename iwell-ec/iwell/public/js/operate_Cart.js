// 购物车
var common = { 
//------------------------------------------intoCar start------------------------------------------//
   
	//添加至购物车,goods_id为商品ID,goods_name为商品名称,market_price为商品市场价,vip_price为商品会员价,goods_quantity为商品数目
	intoCart:function(goods_id,goods_name,market_price,goods_img,goods_quantity){ 
		
		//商品id、商品名称不能为空
		if(goods_id == "" && goods_name == "")
		{
			//跳出出程序
			return;
		}
	
		//从cookie中取出商品信息列表
		var goods_list = cookie.Get("cartList");
	
		//如果商品信息列表为空
		if(goods_list==null || goods_list=="" || goods_list=="null") 
   		{ 	
			//添加商品信息到商品信息列表
			goods_list=goods_id+"|"+goods_name+"|"+market_price+"|"+goods_img+"|"+goods_quantity;
		
			//将商品信息列表存入cookie
			cookie.Set("cartList",goods_list);

			showDIV();
			return false;

			//跳出出程序,并显示提示信息
			//return alert("商品已经添加到购物车中");
		}
		
		//判断商品信息列表是否已经存在该商品
		if(common.hasOne(goods_id)) 
		{ 		
			//添加商品信息到商品信息列表
			goods_list += "&"+goods_id+"|"+goods_name+"|"+market_price+"|"+goods_img+"|"+goods_quantity;
					
			//将商品信息列表存入cookie
			cookie.Set("cartList",goods_list);
				
			//显示提示信息
			showDIV();
			return false;
			//alert("商品已经添加到购物车中");
			 
		}else{
			//定义一个字符串变量
			var tempStr;
			
			//取得数组形式的商品信息列表
			var arr = common.convertArray(); 
			
			//循环取出数组中的各个商品信息
			for(i=0;i<arr.length;i++)
			{ 
				//商品id相符
				if(arr[i][0]==goods_id)
				{ 
					//修改商品的购买数量
					var a=parseInt(arr[i][4]);

					a+=parseInt(goods_quantity);

					arr[i][4]=a;
				}
				//以字符"|"为分割,将数组转换为字符串
				tempStr=arr[i].join("|"); 
				
				arr[i] = tempStr;
			}
			
			//以字符"&"为分割,将数组转换为字符串
			tempStr=arr.join("&"); 

			//将更新后的商品信息列表保存到Cookie
			cookie.Set("cartList",tempStr);
		
			//显示提示信息
			//alert("购物车中已含有此商品");
			showDIV();
			return false;
		}
	} ,//添加商品信息结束
	
//------------------------------------------intoCar end------------------------------------------//

//------------------------------------------updateQuantity end------------------------------------------//
	//更改单一商品的购买数量
	updateQuantity:function(goods_id,goods_quantity){
		
		//定义一个字符串变量
		var tempStr;
		
		//取得数组形式的商品信息列表
   		var arr = common.convertArray(); 
		
		//循环取出数组中的各个商品信息
		for(i=0;i<arr.length;i++)
		{ 
			//商品id相符
			if(arr[i][0]==goods_id)
			{ 
				//修改商品的购买数量
				arr[i][4]=goods_quantity;
			}
			//以字符"|"为分割,将数组转换为字符串
			tempStr=arr[i].join("|"); 
			
			arr[i] = tempStr;
		}
		
		//以字符"&"为分割,将数组转换为字符串
		tempStr=arr.join("&"); 

		//将更新后的商品信息列表保存到Cookie
		cookie.Set("cartList",tempStr);
		
		//更新购物车
		getCartInfo();
		
	},//更改商品数量结束

//------------------------------------------updateQuantity end------------------------------------------//



//------------------------------------------reMoveOne end------------------------------------------//	

	//移除购物车中的某一商品
	reMoveAll:function(){
			cookie.Del("cartList");
			document.location.reload();
			//window.location='/pro/index.php/car/mycar';
	},
reMoveOne:function(goods_id){ 
   
  		//判断商品是否存在
   		if(common.hasOne(goods_id))
		{
			//中断执行,并显示提示信息
			return alert("选择的商品不存在购物车!");
		}

		//取得数组形式的商品信息列表
   		var arr = common.convertArray();
		
		//如果数组只有一个值
		if(arr.length ==1)
		{
			//清空购物车
			cookie.Del("cartList");
			
			//更新购物车
			
		}
		
		//循环取出数组中的各个商品信息
		for(i=0;i<arr.length;i++)
		{ 
			//商品id相符
			if(arr[i][0]==goods_id)
			{ 
				//将该项从数组中移除
				arr = common.delArr(arr,i);
			}
		}
		
		//循环取出数组中的各个商品信息
		for(i=0;i<arr.length;i++)
		{ 
			//以字符"|"为分割,将数组转换为字符串
			tempStr=arr[i].join("|"); 
			
			//将转换后的字符串,传给arr的第i项
			arr[i] = tempStr;
		}

		//以字符"&"为分割,将数组转换为字符串
		tempStr=arr.join("&"); 

		//将更新后的商品信息列表保存到Cookie
		cookie.Set("cartList",tempStr); 
		
		//更新购物车
		getCartInfo();
		document.location.reload();
		
				
   }, //移除物品结束 
//------------------------------------------reMoveOne end------------------------------------------//	

    
//------------------------------------------hasOne start------------------------------------------//
   
   	//检验购物车内是否已经含有该商品,goods_id为商品id
   	hasOne:function(goods_id){ 
		//如果商品id为空
		if(goods_id=="" || goods_id=="null" || goods_id==null)
		{
			//返回true
			return true;
		}
		
		//取得数组形式的商品信息列表
   		var arr = common.convertArray(); 
		
		//如果商品列表为空
		if(arr=="" || arr=="null" || arr==null)
		{
			//返回true
			return true;
		}
		
		//循环取出数组中的各个商品信息
		for(i=0;i<arr.length;i++)
		{ 
			//商品id相符
			if(arr[i][0]==goods_id)
			{ 
				//中断执行,并返回false;
   				return false; 
			}
		}
		
		//中断执行,并返回false;
   		return true; 
				
	} ,//检验结束

//------------------------------------------hasOne end------------------------------------------//


//------------------------------------------delArr start------------------------------------------//

	//移除数组中指定项 
	delArr:function(arr,n) { //n表示第几项，从0开始算起。
	 
	 	//如果n<0，则不进行任何操作。
   		if(n<0)
		{ 
			//返回原数组
   			return arr; 
		}else{ 
			//返回操作后的数组
   			return arr.slice(0,n).concat(arr.slice(n+1,arr.length));
		}
   	}, 

//------------------------------------------delArr start------------------------------------------//



//------------------------------------------convertArray start------------------------------------------//		
	
	//将商品信息列表转换为数组形式
	convertArray:function(){
	
		//定义个数组,用来存储转换后的商品信息列表
		var  goods_Arr = Array();
		
		//定义一个字符串变量,用来存储单一商品的详细信息
		var goods_inf;
	
		//从Cookies中取出商品信息列表
   		var goods_list = cookie.Get("cartList"); 
		
		//如果商品信息列表为空
   		if(goods_list == "" || goods_list == "null" || goods_list == null)
		{
			//中断程序的执行,并返回一个空数组
			return null;
   		}
		
		//判断商品信息列表中是否含有多条商品信息
   		if(goods_list.lastIndexOf("&") != -1)
		{ 
			//根据字符"&",把商品信息列表分割成字符串数组arr
   			var arr=goods_list.split("&");
						 
			//对数组arr进行循环
   			for(i=0;i<arr.length;i++) 
   			{	
				//取出单一商品个属性的值
				goods_inf=arr[i].substr(arr[i].indexOf("=")+1,arr[i].length);
				 
				//根据字符"|",把单一商品的详细信息分割成字符串数组
				goods_Arr[i] = goods_inf.split("|");
   			}
			 
  		}else{
		
			//取出单一商品的详细信息
			goods_inf=goods_list.substr((goods_list.indexOf("=")+1),goods_list.length);
		
			//根据字符"|",把单一商品的详细信息分割成字符串数组	 
			goods_Arr[0] = goods_inf.split("|");
		}
		
		//返回转换后结果
		return goods_Arr; 
			
	}//重置结束

//------------------------------------------convertArray end------------------------------------------//	
 
};

//购物车里商品的种数和总价

var amount = 0;
function getCount(){
	amount = 0;	
	//取得数组形式的商品信息列表
	var arr = common.convertArray(); 
	
	//如果商品列表为空
	if(arr=="" || arr=="null" || arr==null)
	{
		//返回0
		return 0;
	}		
	for(i=0;i<arr.length;i++)
	{		
		//计算商品总额
		amount+=arr[i][2]*arr[i][3];
	}
	//中断执行,并返回arr.length;
	return arr.length; 
				
}

//show DIV
function showDIV() {
	window.location='/cart';

}

// 生成背景
function create_bg() {
	// 建立一个div的节点
	bg = document.createElement("div");
	bg.id = "dark_bg";
	with (bg.style) {
		position = "absolute";
		top = "0";
		left = "0";
		width = document.documentElement.scrollWidth + "px";
		if (document.documentElement.scrollHeight < document.documentElement.clientHeight) {
			height = document.documentElement.clientHeight + "px";
		} else {
			height = document.documentElement.scrollHeight + "px";
		}

	}
	// 打开对话框后禁用浏览器的滚动条
	//document.documentElement.style.overflow = "hidden";
	//document.body.style.overflow = "hidden";
	// 把这个节点附加到body上
	document.body.appendChild(bg);
}

//close DIV
function closeDIV() {
	//document.documentElement.style.overflow = "auto";
	//document.body.style.overflow = "auto";
	var new_dialogue = document.getElementById("new_dialogue");
	var dark_bg = document.getElementById("dark_bg");
	new_dialogue.parentNode.removeChild(new_dialogue);
	dark_bg.parentNode.removeChild(dark_bg);
}