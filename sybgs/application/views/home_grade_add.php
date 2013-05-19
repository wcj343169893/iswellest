<?php include('home_header.php'); ?>
<div>
	<ul class="breadcrumb">
		<li><?php echo anchor('home','Home')?> <span class="divider">/</span></li>
		<li><?php echo anchor('/home/gradelist/','实验报告列表')?> <span class="divider">/</span></li>
		<li><?php echo $title?></li>
	</ul>
</div>
<div class="form-horizontal">
	<div class="control-group">
      	<label class="control-label">一、所属类别：</label>
      	<div class="controls">
          <span class="help-inline"><?php if($works->caid == 1)echo '科技理念类';else echo '科技实物类';?></span>
        </div>
	</div>
	<div class="control-group">
      	<label class="control-label">二、实验报告书名称：</label>
      	<div class="controls">
          <span class="help-inline"><?php echo $works->wname?></span>
        </div>
	</div>
	<div class="control-group">
      	<label class="control-label">三、实验报告书详情：</label>
      	<div class="controls">
          <span class="help-inline"><?php echo $play;?></span>
        </div>
	</div>
	<div class="control-group">
      	<label class="control-label">四、实验报告书评分：</label>
      	<div class="controls">
          <span class="help-inline">请根据评分观测点以及评分要求对实验报告书评分,各分项满分均为100分,所占总分的比例不同</span>
        </div>
	</div>
	  <?php 
	  $data = array('onSubmit' => 'return checkSubmit();');
	  echo form_open('home/addGradeSave',$data) ?>
		<div class="control-group">
	      	<label class="control-label" for="grade1">科学性(占20%)：</label>
	      	<div class="controls">
	      	  <input name="grade1" id="grade1" class="input-xlarge" type="text" value="" onChange="sum2()">
	          <span class="help-inline">科学性,实验报告书的理论水平、学术价值</span>
	        </div>
		</div>
		<div class="control-group">
	      	<label class="control-label" for="grade2">环保性(占20%)：</label>
	      	<div class="controls">
	      	  <input name="grade2" id="grade2" class="input-xlarge" type="text" value="" onChange="sum2()">
	          <span class="help-inline">环保性,实验报告书符合正确的环保理念，通过实验报告书可以体现出学生的环境责任感</span>
	        </div>
		</div>
		<div class="control-group">
	      	<label class="control-label" for="grade3">创新性(占20%)：</label>
	      	<div class="controls">
	      	  <input name="grade3" id="grade3" class="input-xlarge" type="text" value="" onChange="sum2()">
	          <span class="help-inline">创新性,实验报告书具有的创新程度</span>
	        </div>
		</div>
		<div class="control-group">
	      	<label class="control-label" for="grade4">可行性(占20%)：</label>
	      	<div class="controls">
	      	  <input name="grade4" id="grade4" class="input-xlarge" type="text" value="" onChange="sum2()">
	          <span class="help-inline">实用性,实验报告书策划的合理性、对环境保护和生态改善的实施性</span>
	        </div>
		</div>
		<?php if($works->caid == 1):?>
		<div class="control-group">
	      	<label class="control-label" for="grade5">文字表述(占20%)：</label>
	      	<div class="controls">
	      	  <input name="grade5" id="grade5" class="input-xlarge" type="text" value="" onChange="sum2()">
	          <span class="help-inline">文字表述,文字表达精炼流畅，用词准确，主题突出</span>
	        </div>
		</div>
		<?php else:?>
		<div class="control-group">
	      	<label class="control-label" for="grade5">经济性(占20%)：</label>
	      	<div class="controls">
	      	  <input name="grade5" id="grade5" class="input-xlarge" type="text" value="" onChange="sum2()">
	          <span class="help-inline">经济性,实验报告书经济效益、推广价值</span>
	        </div>
		</div>
		<?php endif;?>
		<div class="control-group">
	      	<label class="control-label" for="grade7">总分：</label>
	      	<div class="controls">
	      	  <input name="grade7" id="grade7" class="input-xlarge" type="text" value="" onChange="sum2()">
	          <span class="help-inline">您给出的最后综合得分</span>
	        </div>
		</div>
		<div class="control-group">
	      	<label class="control-label" for="iswin">是否及格：</label>
	      	<div class="controls">
	      	  <input name="iswin" type="checkbox" value="1" id="iswin">
	          <span class="help-inline">勾选则推荐进入及格线</span>
	        </div>
		</div>
	      <div class="form-actions">
	        <input name="wid" type="hidden" value="<?php echo $works->wid?>" />
			<input name="uid" type="hidden" value="<?php echo $uid?>" />
			<input name="caid" type="hidden" value="<?php echo $works->caid?>" />
			<input name="sid" type="hidden" value="0" />
			<input name="grade6" id="grade6" type="hidden" value="0" />
			<button id="zlsub" type="submit" class="btn btn-primary">评分</button>
	    </div>
	<?php echo form_close() ?>
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
<?php include('home_footer.php'); ?>
