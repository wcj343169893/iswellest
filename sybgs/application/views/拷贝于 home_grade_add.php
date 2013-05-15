<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<base href="<?php echo base_url() ;?>"/>
<title>实验报告书提交网站</title>
<link href="resource/home/style2.css" rel="stylesheet" type="text/css">
<link href="resource/home/box.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="resource/home/js/jquery-1.3.2.min.js"></script>
</head>
<body>
<div class="so_main">
    <div class="page_tit"><?php echo $title;?></div>
	<div class="form2">	
      <dl class="lineD">
        <dt>一、所属类别：</dt>
        <dd><?php if($works->caid == 1)echo '科技理念类';else echo '科技实物类';?></dd>
      </dl>
      <dl class="lineD">
        <dt>二、实验报告书名称：</dt>
        <dd><?php echo $works->wname?></dd>
      </dl>
	  <dl class="lineD">
        <dt>三、实验报告书详情：</dt>
        <dd><p id="files"><?php echo $play;?></p></dd>
      </dl>
	  <?php 
	  $data = array('onSubmit' => 'return checkSubmit();');
	  echo form_open('home/addGradeSave',$data) ?>
	  <dl class="lineD">
        <dt>四、实验报告书评分：</dt>
        <dd><p>请根据评分观测点以及评分要求对实验报告书评分</p>
      </dd>
      </dl>
	   <style type="text/css">
	  .lineD{}
	  .lineD dt{ font-size:15px; font-weight:bold;}
	  .lineD dd input{ font-size:14px;}
	  .lineD dd p{ font-size:14px;}
	  </style>
	  <?php if($works->caid == 1):?>
	  <dl class="lineD">
        <dt>科学性：</dt>
        <dd>
          <input name="grade1" id="grade1" type="text" value="" onChange="sum2()">
          <p>科学性,实验报告书的理论水平、学术价值,满分100分,该项占最后得分的20%</p>
      </dd>
      </dl>
	  <dl class="lineD">
        <dt>环保性：</dt>
        <dd>
          <input name="grade2" id="grade2" type="text" value="" onChange="sum2()">
          <p>环保性,实验报告书符合正确的环保理念，通过实验报告书可以体现出参赛者的环境责任感,满分100分,该项占最后得分的20%</p>
      </dd>
      </dl>
	  <dl class="lineD">
        <dt>创新性：</dt>
        <dd>
          <input name="grade3" id="grade3" type="text" value="" onChange="sum2()">
          <p>创新性,实验报告书具有的创新程度,满分100分,该项占最后得分的25%</p>
      </dd>
      </dl>
	  <dl class="lineD">
        <dt>可行性：</dt>
        <dd>
          <input name="grade5" id="grade5" type="text" value="" onChange="sum2()">
          <p>实用性,实验报告书策划的合理性、对环境保护和生态改善的实施性,满分100分,该项占最后得分的20%</p>
      </dd>
      </dl>
	  <dl class="lineD">
        <dt>文字表述：</dt>
        <dd>
          <input name="grade6" id="grade6" type="text" value="" onChange="sum2()">
          <p>文字表述,文字表达精炼流畅，用词准确，主题突出,满分100分,该项占最后得分的15%</p>
      </dd>
      </dl>
	  <dl class="lineD">
        <dt>总分：</dt>
        <dd>
          <input name="grade7" id="grade7" type="text" value="" readonly="readonly">
          <p>您给出的最后综合得分</p>
      </dd>
      </dl>
	  <dl class="lineD">
        <dt>是否及格：</dt>
        <dd>
          <label><input name="iswin" type="checkbox" value="1">推荐进入及格线</label>
          <p>勾选则推荐进入及格线</p>
      </dd>
      </dl>
	  <?php else:?>
	  <dl class="lineD">
        <dt>科学性：</dt>
        <dd>
          <input name="grade1" id="grade1" type="text" value="" onChange="sum2()">
          <p>科学性,实验报告书的理论水平、学术价值,满分100分,该项占最后得分的20%</p>
      </dd>
      </dl>
	  <dl class="lineD">
        <dt>环保理念：</dt>
        <dd>
          <input name="grade2" id="grade2" type="text" value="" onChange="sum2()">
          <p>环保理念,实验报告书符合正确的环保理念，通过实验报告书可以体现出参赛者的环境责任感,满分100分,该项占最后得分的20%</p>
      </dd>
      </dl>
	  <dl class="lineD">
        <dt>创新性：</dt>
        <dd>
          <input name="grade3" id="grade3" type="text" value="" onChange="sum2()">
          <p>创新性,实验报告书具有的创新程度,满分100分,该项占最后得分的25%</p>
      </dd>
      </dl>
	  <dl class="lineD">
        <dt>可行性：</dt>
        <dd>
          <input name="grade4" id="grade4" type="text" value="" onChange="sum2()">
          <p>可行性,实验报告书策划的合理性、对环境保护和生态改善的实施性、技术的成熟程度,满分100分,该项占最后得分的20%</p>
      </dd>
      </dl>
	  <dl class="lineD">
        <dt>经济性：</dt>
        <dd>
          <input name="grade5" id="grade5" type="text" value="" onChange="sum2()">
          <p>经济性,实验报告书经济效益、推广价值,满分100分,该项占最后得分的15%</p>
      </dd>
      </dl>
	  <dl class="lineD">
        <dt>总分：</dt>
        <dd>
          <input name="grade7" id="grade7" type="text" value="" readonly="readonly">
          <p>您给出的最后综合得分</p>
      </dd>
      </dl>
	  <dl class="lineD">
        <dt>是否及格：</dt>
        <dd>
          <label><input name="iswin" type="checkbox" value="1">推荐进入及格线</label>
          <p>勾选则推荐进入及格线</p>
      </dd>
      </dl>
	  <?php endif;?>
      <div class="page_btm">
        <input name="wid" type="hidden" value="<?php echo $works->wid?>" />
		<input name="uid" type="hidden" value="<?php echo $uid?>" />
		<input name="caid" type="hidden" value="<?php echo $works->caid?>" />
		<input name="sid" type="hidden" value="0" />
		<input id="zlsub" type="submit" class="btn_b" value="评分" />
      </div>
    </div>
	<?php echo form_close() ?>
</div>
<div style="text-align:center; color:#666666;font-size:12px; padding:50px 0 10px;">
执行时间:<?php echo $this->benchmark->elapsed_time();?>秒
</div>
<script language=javascript>
function sum(){
	var fs1 = isnum('grade1');
	var fs2 = isnum('grade2');
	var fs3 = isnum('grade3');
	var fs4 = isnum('grade4');
	var fs5 = isnum('grade5');
	var fs6 = isnum('grade6');
	
	var zf = fs1*0.2 + fs2*0.2 + fs3*0.25 + fs4*0.15 + fs5*0.1 + fs6*0.1;
	
	document.getElementById('grade7').value = zf;
}
function sum2(){
	var fs1 = isnum('grade1');
	var fs2 = isnum('grade2');
	var fs3 = isnum('grade3');
	var fs4 = isnum('grade4');
	var fs5 = isnum('grade5');
	
	var zf = fs1*0.2 + fs2*0.2 + fs3*0.25 + fs4*0.2 + fs5*0.15;
	
	document.getElementById('grade7').value = zf;
}
function isnum(grade){
	var fs = document.getElementById(grade).value;
	if(isNaN(fs)){document.getElementById(grade).focus();document.getElementById(grade).value = "";alert("请输入数字!!");return;}
	if(fs>100 || fs<0){document.getElementById(grade).focus();document.getElementById(grade).value = "";alert("分数应在0~100之间!!");return;}
	return fs;
}
function checkSubmit(){
	var grade1 = document.getElementById("grade1").value;
	if(grade1 == ""){
		alert("请输入分数！");
		document.getElementById("grade1").focus();
		return false;
	}
	var grade2 = document.getElementById("grade2").value;
	if(grade2 == ""){
		alert("请输入分数！");
		document.getElementById("grade2").focus();
		return false;
	}
	var grade3 = document.getElementById("grade3").value;
	if(grade3 == ""){
		alert("请输入分数！");
		document.getElementById("grade3").focus();
		return false;
	}
	var grade4 = document.getElementById("grade4").value;
	if(grade4 == ""){
		alert("请输入分数！");
		document.getElementById("grade4").focus();
		return false;
	}
	var grade5 = document.getElementById("grade5").value;
	if(grade5 == ""){
		alert("请输入分数！");
		document.getElementById("grade5").focus();
		return false;
	}
	return true;
}
</script>
</body>
</html>
