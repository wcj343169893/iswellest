// ��Cookie���ж�ȡ,���,ɾ������
var cookie={
//------------------------------------------Get start------------------------------------------// 

  	//��ȡcookie,nΪcookie�� 
	Get:function(n){ 
		
		//����cookie������һ��������ʽ
   		var re=new RegExp("(?:;)?"+n+"=([^;]*);?");

		//�ж��Ƿ��з���ֵ
		if(re.test(document.cookie)) 
		{
			//��cookie��ȡ��ֵ,������
   			return decodeURIComponent(RegExp["$1"]);
		}else{
			
			//����null
			return null;
		}
   	}, //��ȡcookie����
	
//------------------------------------------Get end------------------------------------------//
   
   
//------------------------------------------Set start------------------------------------------//

	//д��cookie,nΪcookie����vΪvalue 
   	Set:function(n,v){
			
		//����һ��ʱ�����t
   		var eTime=new Date();
	
		//CookieʧЧʱ��Ϊ1Сʱ,8.64e7 һ��, 3.6e6 һСʱ 
		eTime.setTime(eTime.getTime() + (1 * 3.6e6));
		
		//Cookie·��
		var path = "/";
		
		//Cookie��
		var domain;
		
		//Cookie��ȫ��־
		var secure;
		
		//����һ���ַ�������,�������Cookie������ֵ
		var sCookie = n + "=" +encodeURIComponent(v) +";expires=" + eTime.toGMTString()+"; path=" + path;

		//����Ϣд��cookie
		document.cookie = sCookie;
   	
	},//д��cookie����
	
//------------------------------------------Set end------------------------------------------//


//------------------------------------------Del end------------------------------------------//     
   
	//ɾ��cookie
	Del:function(n){ 
		
		//Cookie·��
		var path = "/";
		
		//Cookie��
		var domain;
		
		//Cookie��ȫ��־
		var secure;
		
		//����һ���ַ�������,�������Cookie������ֵ
		var sCookie = n + "=" + "" + ";expires=" + new Date(0).toGMTString() + "; path=" + path;
		
		//����Ϣд��cookie
		document.cookie = sCookie;

		//���ﳵ����Ʒ���ܼ�
		amount = 0;
   	} 

//------------------------------------------Del end------------------------------------------// 
};
