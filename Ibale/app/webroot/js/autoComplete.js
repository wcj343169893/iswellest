//提示文字配列
var commonTextValue,textValue;
var platkeysDefault = '中文/拼音';

var parentbject;
var text_suggest = function(){
    this.object = '';
    this.hiddenObj = '';
    this.pageno = 1;
    this.search_type = '';
    this.pagelimit = 10;
    this.taskid = 0;
    this.delaySec = 100; // 默认延迟多少毫秒出现提示框
    this.lastkeys_val= 0;
    var lastkeys_val= 0;
    this.lastinputstr = '';    
    /**
     * 初始化类库
     */
    this.init_zhaobussuggest=  function(){
        var objBody = document.body;//getElementById("mainbody");
        var objiFrame = document.createElement("iframe");
        var objplatform = document.createElement("div");
                 
        objiFrame.setAttribute('id','getiframe');
        objiFrame.style.zindex='100';
        objiFrame.style.position = 'absolute';
        objiFrame.style.display = 'none';
        objplatform.setAttribute('id','getplatform');
        objplatform.setAttribute('align','left');
        objplatform.style.zindex='10000';
        objBody.appendChild(objiFrame);
        objBody.appendChild(objplatform);
        var win=objBody || window
                
        if(!document.all) {
            objBody.addEventListener("click",this.hidden_suggest,false);
            
        }else{
            win.document.attachEvent("onclick",this.hidden_suggest);
            
        }
    }

    /** *************************************************fill_div()******************************************** */
    // 函数功能：动态填充div的内容，该div显示所有的提示内容
    // 函数参数：allplat 一个字符串数组，包含了所有可能的提示内容
    this.fill_div = function(allplat){
        var msgplat = '';
        var all = '';
        var spell = '';
        var chinese = '';
        var platkeys = this.object.value;
        platkeys=this.ltrim(platkeys);
        
        if(platkeys==platkeysDefault)
        {
            this.object.text='';
            this.object.value='';
            platkeys = '';
            this.object.focus();
            // allplat = 0;
        }
        
        
        if(!platkeys){
            // alert('here');
            msgplat += '<table class="hint" width="200" ><tr align="left"><td class="tdleft" height="10" align="left">'+platkeysDefault+'</td></tr></table>';
            for(i=0;i<allplat.length;i++){
                all=allplat[i].split(",");
                spell=all[0];
                chinese=all[1];
                szm=all[2];
                msgplat += '<table class="mout" width="200"><tr onclick="parentbject.add_input_text(\'' + chinese + '\',\'' + szm + '\')"><td class="tdleft" height="10" align="left">'+ spell +
                       '</td><td class="tdright" align="right">' + chinese + '</td><td style="display:none">' + szm + '</td></tr></table>';
            }
        }
        else {
            if(allplat.length < 1 || !allplat[0]){
                msgplat += '<table class="hint" width="200"><tr align="left"><td class="tdleft" height="10" align="left">一致的品牌没有找到！</td></tr></table>';

            }
            else{
               msgplat += '<table class="hint" width="200"><tr align="left"><td class="tdleft" height="10" align="left">'+platkeys+'</td></tr></table>';
               var start = (this.pageno - 1) * this.pagelimit;
               for(i=start;i<allplat.length;i++){
                    if (i > start + this.pagelimit) {
                        break;
                    }
                    all=allplat[i].split(",");
                    spell=all[0];
                    chinese=all[1];
                    szm=all[2];
                    msgplat += '<table class="mout" width="200"><tr onclick="parentbject.add_input_text(\'' + chinese + '\',\'' + szm + '\')"><td class="tdleft" height="10" align="left">'+ spell +
                       '</td><td class="tdright" align="right">' + chinese + '</td><td style="display:none">' + szm + '</td></tr></table>';
                }
            }
        }
        // page
        if (allplat.length > 1 && platkeys != '' && allplat.length > this.pagelimit){
        	var pagetable = '';//
        	pagetable = '<table width="200" height="35"class="hint" id="page"  style="cursor:default"><tbody><tr align="left"><td align="left" height="10" class="tdleft">';
            var this_page = this.pageno;
            var this_pagecount = Math.ceil(allplat.length/this.pagelimit);
            // pagedivstr += "<div class=\"page\" style=\"height:25px;\">";
            var begin = 1;
            // var disp_page_count = 2;
            if (this_page -2 > 0) {
                begin = this_page - 2;
            }
            if ((this_pagecount  - this_page) < 2){
                begin = this_pagecount  - 4;
            }
            // for (var page = this_page - 3; page <= this_page + 3; page++){
            for (var page = begin; page <= begin + 4; page++){
                if (page > 0 && page <= this_pagecount){
                    var fun = "suggest.display('"+this.object.id+"','"+this.search_type+"','"+page+"',event)";
                    //fun = fun.replace(/'page'/, page);
                    pagetable += "&nbsp;&nbsp;<span style=\"color:blue;cursor: pointer;\" onclick=\"eval("+fun+")\">"+page+"</span>&nbsp;";
                }
            }
            pagetable += "</td></tr></tbody></table>";
            msgplat += pagetable;
        }
        // end page.
        document.getElementById("getplatform").innerHTML =  msgplat;
        var nodes = document.getElementById("getplatform").childNodes;
        nodes[0].className = "hint";
        if(allplat.length >= 1 && allplat[0]){
            nodes[1].className = "selected";
        }
        // this.lastkeys_val = 0;
        for(var i=2;i<nodes.length;i++){
            if (nodes[i].id == 'page') {
                continue;
            }
            nodes[i].onmouseover = function(){
                this.className = "mover";
                }
            nodes[i].onmouseout = function(){
                if(parentbject.lastkeys_val==(parentIndexOf(this)-2)){this.className = "selected";}
                else{this.className = "mout";}
            }
        }
        document.getElementById("getiframe").style.width = document.getElementById("getplatform").clientWidth+2;
        document.getElementById("getiframe").style.height = document.getElementById("getplatform").clientHeight+5;
    }

    /** *************************************************fix_div_coordinate******************************************** */
    // 函数功能：控制提示div的位置，使之刚好出现在文本输入框的下面
    this.fix_div_coordinate = function(){
        var leftpos=0;
        var toppos=0;
        var testtmp=this.object.value;
        var testtmp1=this.object.id;
        aTag = this.object;
        do {
            if( aTag.offsetParent )
            {
                aTag = aTag.offsetParent;
            }
            else
            {
                leftpos += aTag.style.left;
                toppos += aTag.style.top;
                break;
            }
            leftpos    += aTag.offsetLeft;
            toppos += aTag.offsetTop;
        }while(aTag.id!="mainbody");
        // alert("leftpos=["+leftpos+"]--toppos=["+toppos+"]--this.object.offsetTop=["+this.object.offsetTop+"]--this.object.offsetLeft=["+this.object.offsetLeft+"]--this.object.offsetHeight=["+this.object.offsetHeight+"]");
        document.getElementById("getiframe").style.width = this.object.offsetWidth + 'px';
        
        if(document.layers){
            document.getElementById("getiframe").style.left = this.object.offsetLeft    + parseInt(leftpos) + "px";
            document.getElementById("getiframe").style.top = this.object.offsetTop +    parseInt(toppos) + this.object.offsetHeight + 2 + "px";
        }else{
            document.getElementById("getiframe").style.left =this.object.offsetLeft    + parseInt(leftpos)  +"px";
            document.getElementById("getiframe").style.top = this.object.offsetTop +    parseInt(toppos) + this.object.offsetHeight + 2 + "px";
        }
        // document.getElementById("getplatform").style.width =
        // this.object.offsetWidth + 'px';
        // document.getElementById("getiframe").style.width=
        // this.object.offsetWidth + 'px';
        if(document.layers){
            document.getElementById("getplatform").style.left = this.object.offsetLeft    + parseInt(leftpos) + "px";
            document.getElementById("getplatform").style.top = this.object.offsetTop +    parseInt(toppos) + this.object.offsetHeight + 2 + "px";
        }else{
            document.getElementById("getplatform").style.left =this.object.offsetLeft    + parseInt(leftpos)  +"px";
            document.getElementById("getplatform").style.top = this.object.offsetTop +    parseInt(toppos) + this.object.offsetHeight + 2 + "px";
        }
        // alert("getiframe.left=["+document.getElementById("getiframe").style.left+"]--getiframe.top=["+document.getElementById("getiframe").style.top+"]--getplatform.left=["+document.getElementById("getplatform").style.left+"]--getplatform.top=["+document.getElementById("getplatform").style.top+"]");
    }

    /** *************************************************hidden_suggest******************************************** */
    // 函数功能：隐藏提示框
    this.hidden_suggest = function (){
        this.lastkeys_val = 0;         
        document.getElementById("getiframe").style.visibility = "hidden";
        document.getElementById("getplatform").style.visibility = "hidden";
    }

    /** *************************************************show_suggest******************************************** */
    // 函数功能：显示提示框
    this.show_suggest = function (){
        document.getElementById("getiframe").style.visibility = "visible";
        document.getElementById("getplatform").style.visibility = "visible";
    }
    this.is_showsuggest= function (){
        if(document.getElementById("getplatform").style.visibility == "visible") return true;else return false;
    }

    this.sleep = function(n){
        var start=new Date().getTime(); // for opera only
        while(true) if(new Date().getTime()-start>n) break;
    }
    this.ltrim = function (strtext){
        return strtext.replace(/[\$&\|\^*%#@! ]+/, '');
    }

    /** *************************************************add_input_text******************************************** */
    // 函数功能：当用户选中时填充相应的城市名字

    this.add_input_text = function (keys,szm){
         
        keys=this.ltrim(keys)
        this.object.value = keys;
        var id=this.object.id;        
        // document.getElementById(this.id2.id).value = szm;
        document.getElementById(id).style.color="#000000";
        document.getElementById(id).value=keys;
        document.getElementById(this.hiddenObj).value=szm;
     }

    /** *************************************************keys_handleup******************************************** */
    // 函数功能：用于处理当用户用向上的方向键选择内容时的事件
    this.keys_handleup = function (){
        if(this.lastkeys_val > 0) this.lastkeys_val--;
        var nodes = document.getElementById("getplatform").childNodes;
        if(this.lastkeys_val < 0) this.lastkeys_val = nodes.length-1;
        var b = 0;
        for(var i=2;i<nodes.length;i++){
            if(b == this.lastkeys_val){
                nodes[i].className = "selected";
                this.add_input_text(nodes[i].childNodes[0].childNodes[0].childNodes[1].innerHTML,nodes[i].childNodes[0].childNodes[0].childNodes[2].innerHTML);
            }else{
                nodes[i].className = "mout";
            }
            b++;
        }
    }

    /** *************************************************keys_handledown******************************************** */
    // 函数功能：用于处理当用户用向下的方向键选择内容时的事件
    this.keys_handledown = function (){
        
        this.lastkeys_val++;
        
        var nodes = document.getElementById("getplatform").childNodes;
        
        if(this.lastkeys_val >= nodes.length-2) {
            
            this.lastkeys_val--;
            return;
        }
        
        var b = 0;
        for(var i=2;i<nodes.length;i++){
            
            if(b == this.lastkeys_val){
                
                nodes[i].className = "selected";
                this.add_input_text(nodes[i].childNodes[0].childNodes[0].childNodes[1].innerHTML,nodes[i].childNodes[0].childNodes[0].childNodes[2].innerHTML);
            }else{
                nodes[i].className = "mout";
            }
            b++;
        }
    }

    this.ajaxac_getkeycode = function (e)
    {
        var code;
        if (!e) var e = window.event;
        if (e.keyCode) code = e.keyCode;
        else if (e.which) code = e.which;
        
        return code;
        
    }

    /** *************************************************keys_enter******************************************** */
    // 函数功能：用于处理当用户回车键选择内容时的事件
    this.keys_enter = function (){
          
        var nodes = document.getElementById("getplatform").childNodes;
        for(var i=2;i<nodes.length;i++){
            if(nodes[i].className == "selected"){
                
              this.add_input_text(nodes[i].childNodes[0].childNodes[0].childNodes[1].innerHTML,nodes[i].childNodes[0].childNodes[0].childNodes[2].innerHTML);
            }
        }
        this.hidden_suggest();
    }

    function getEvent()
    {
     if(document.all)    return window.event;// 如果是ie
     func=getEvent.caller;
            while(func!=null){
                var arg0=func.arguments[0];
                if(arg0){if((arg0.constructor==Event || arg0.constructor ==MouseEvent) || (typeof(arg0)=="object" && arg0.preventDefault && arg0.stopPropagation)){return arg0;}            }
                func=func.caller;
            }
           return null;
    }

    /** *************************************************display******************************************** */
    // 函数功能：入口函数，将提示层div显示出来
    // 输入参数：object 当前输入所在的对象，如文本框
    // 输入参数：e IE事件对象
    this.display = function (object, search_type,pageno,e,hiddenObj){
        this.search_type = search_type;
        change_search_type(search_type);
        this.object = document.getElementById(object);
        if (hiddenObj != undefined) {
            this.hiddenObj = hiddenObj;
        }
        this.pageno = pageno;
        if(!document.getElementById("getplatform")) this.init_zhaobussuggest();
        e = e || window.event;
        // var e=getEvent();
        e.stopPropagation;
        e.cancelBubble = true;
        if (e.target) targ = e.target;  else if (e.srcElement) targ = e.srcElement;
        if (targ.nodeType == 3)  targ = targ.parentNode;

        var inputkeys = this.ajaxac_getkeycode(e);
        switch(inputkeys){
            case 38: // 向上方向键
                this.keys_handleup(this.object.id);
                return;break;
            case 40: // 向下方向键
              
                if(this.is_showsuggest()) this.keys_handledown(this.object.id); else this.show_suggest();
                return;break;
            case 39: // 向右方向键
                return;break;
            case 37: // 向左方向键
                return;break;
            case 13: // 对应回车键
             
                this.keys_enter();
                return;break;
            case 18: // 对应Alt键
                this.hidden_suggest();
                return;break;
            case 27: // 对应Esc键
                this.hidden_suggest();
                return;break;
        }

        // object.value = this.ltrim(object.value);
        
        // if(object.value == this.lastinputstr) return;else this.lastinputstr =
        // object.value;
        if(window.opera) this.sleep(100);// 延迟0.1秒
        parentbject = this;
        if(this.taskid) window.clearTimeout(this.taskid);
        this.taskid=setTimeout("parentbject.localtext();" , this.delaySec)
        // this.taskid = setTimeout("parentbject.remoteurltext();" ,
        // this.delaySec);

    }

    // 函数功能：从本地js数组中获取要填充到提示层div中的文本内容
    this.localtext = function(){
        var id=this.object.id;
        var suggestions="";
        suggestions=this.getSuggestionByName(suggestions.split(';').length);
        suggestions=suggestions.substring(0,suggestions.length-1);
        
        parentbject.show_suggest();
        parentbject.fill_div(suggestions.split(';'));
        parentbject.fix_div_coordinate();
    }

    /** *************************************************getSuggestionByName******************************************** */
    // 函数功能：从本地js数组中获取要填充到提示层div中的城市名字
    this.getSuggestionByName = function(citycount){
        platkeys = this.object.value;
        if (platkeys==platkeysDefault)
        {
            platkeys = '';
        }
        // alert(platkeys);
        var str="";
        platkeys=this.ltrim(platkeys);
        if(!platkeys){
            for(i=0;i<commonTextValue.length;i++){
                str+=commonTextValue[i][2]+","+commonTextValue[i][1]+","+commonTextValue[i][0]+";";
            }
            return str;
        }
        else{
            platkeys=platkeys.toUpperCase();
            var start = (this.pageno - 1) * this.pagelimit
            var str = "";
            for(i=0;i<textValue.length;i++){
                if(this.getLeftStr(textValue[i][2],platkeys.length).toUpperCase()==platkeys||
                   (textValue[i][1].toUpperCase().indexOf(platkeys)!=-1)||
                   this.getLeftStr(textValue[i][2],platkeys.length).toUpperCase()==platkeys||
                   this.getLeftStr(textValue[i][0],platkeys.length).toUpperCase()==platkeys||
                   this.getLeftStr(textValue[i][3],platkeys.length).toUpperCase()==platkeys) {
                    str+=textValue[i][2]+","+textValue[i][1]+","+textValue[i][0]+";";
                }
            }
            return str;
        }
    }

    /**
     * *************************************************getLeftStr*************
     * ************************************
     */
    // 函数功能：得到左边的字符串
    this.getLeftStr = function(str,len){
        str = new String(str);
        if(isNaN(len)||len==null){
            len = str.length;
        }
        else{
            if(parseInt(len)<0||parseInt(len)>str.length){
                len = str.length;
             }
        }
        return str.substr(0,len);
    }

    /**
     * *************************************************parentIndexOf*************
     * ************************************
     */
    // 函数功能：得到子结点在父结点的位置
    function parentIndexOf(node){
      for (var i=0; i<node.parentNode.childNodes.length; i++){
            if(node==node.parentNode.childNodes[i]){return i;}
      }
   }

}

var suggest = new text_suggest();

//検索種類を切り替え
function change_search_type(search_type){
    if(search_type == "brand"){
        commonTextValue = commonTextValueBrand;
        textValue = textValueBrand;
    }
}
