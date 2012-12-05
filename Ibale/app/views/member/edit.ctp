<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 个人资料';?>
<script type="text/javascript" src="/js/area.js"></script>
<script type="text/javascript" src="/js/date.js"></script>
<script type="text/javascript" src="/js/ajaxupload.js"></script>
<!-- main -->
<div class="titleBg m_10">
    <h3 class="mypageTitle"></h3>
</div>
<div class="mainCenter clearfix m10">
    <?php echo $this->requestAction('/member/customer_center_navi/breadcrumb:edit_member');?>
    <!-- 右侧详细信息 -->
    <div class=" mainRight">
        <h3 class="tableTop">
            <span class="tableTitle">个人资料</span>
        </h3>
        <!-- 个人信息 -->
        <div class="personalInfo clearfix">
            <div id="pPic" class="personalImg">
                <?php $url = (!empty($this->data['MemberPhoto']['photo_path']) && file_exists(WWW_ROOT.$this->data['MemberPhoto']['photo_path']))?$this->data['MemberPhoto']['photo_path']:'/image/front/img.jpg';?>
                <img src="<?php echo $url;?>" width="106" height="106" />
            </div>
            <div class="personalTxt">
                <p>
                    您好！<em><?php echo $appHtml->html($this->data['Member']['name']);?> <?php echo !empty($msts['sex'][$this->data['Member']['sex']])?$msts['sex'][$this->data['Member']['sex']]:'';?> (昵称：<?php echo $appHtml->html($this->data['Member']['nickname']);?>)</em> <b class="p_200_l"><?php echo $msts['customer_rank'][strtolower($this->data['Member']['customer_rank'])]?> </b> <a href="<?php echo HTTP_HOME_PAGE_URL;?>/article/detail/title:<?php echo base64url_encode('关于会员等级');?>">关于会员等级</a>
                </p>
                <ul class="otherTxt">
                <?php echo $appForm->create('MemberPhoto', array('id'=>'MemberPhotoForm', 'url'=>'/member/update_photo'));?>
                    <li><a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/password_reset">[修改密码]</a>
                    </li>
                    <li>图片上传 <?php echo $appForm->hidden("MemberPhoto.photo_path", array('id'=>"picPath"));?> 
                    <?php echo $appForm->file("MemberPhoto.photo_path.file", array('name'=>'filename', 'style'=>'height:25px;', 'onchange'=>"ajaxUploadImg(this, '".UPLOAD_PIC_ROOT."/member/', '106', '106', 'pPic', 'picPath');"));?> <?php echo $appForm->error("MemberPhoto.photo_path", '图片');?>
                        <button type="button" class="btnImg btnUpload middle" onclick="javaScript:uploadPhoto();"></button>
                        <label class="message"><?php echo $appSession->flash('memberPhotoUploadSuccess', false);?></label>
                    </li>
                    <?php echo $appForm->end();?>
                </ul>
            </div>
        </div>
        <h3 class="tableTop m_10">
            <span class="tableTitle">个人资料</span> <span class="tableTxt">帮助我们完善您的个人信息，有助于我们未来根据您的情况提供更加个性化的服务</span>
        </h3>
        <div class="clear"></div>
        <ul class="messageInfo">
    <?php if ($appSession->check('Message.memberEditSuccess')):?>
        <li class="memberUpdateSuccess"><p class="orange"><?php echo $appSession->flash('memberEditSuccess', false);?></p></li>
    <?php endif;?>
        <?php echo $appForm->create('Member', array('id'=>'MemberUpdateForm', 'url'=>'/member/edit_comp'));?>
        <?php echo $appForm->hidden('id');?>
            <li><span class="tit"><em>*</em> 姓名：</span> 
            <?php echo $appForm->text('name', array('class'=>'w_210', 'maxlength'=>'10'));?> <span class="nor">10字符以内</span> 
            <?php echo $appForm->error('Member.name', '姓名');?>
            </li>
            <?php /**
            <li><span class="tit">姓名[pingyin]：</span> 
            <?php echo $appForm->text('name_pinyin', array('class'=>'w_210'));?><span class="nor"></span> 
            <?php echo $appForm->error('Member.name_pinyin', '姓名[pingyin]');?>
            </li>
            */?>
            <li><span class="tit"><em>*</em> 昵称：</span> 
            <?php echo $appForm->text('nickname', array('class'=>'w_210', 'maxlength'=>'10'));?><span class="nor">10字符以内</span> 
            <?php echo $appForm->error('Member.nickname', '昵称');?>
            </li>
            <li><span class="tit"><em></em> 生日：</span> 
            <?php echo $appForm->year('birthday', '1930', date('Y') -1, null, array('empty' => __('label.pleaseSelect', true)));?> &nbsp;年&nbsp;&nbsp; 
            <?php echo $appForm->month('birthday', null, array('monthNames' => false, 'empty' => __('label.pleaseSelect', true)));?> &nbsp;月&nbsp;&nbsp; 
            <?php echo $appForm->day('birthday', null, array('empty' => __('label.pleaseSelect', true)));?> &nbsp;日
            <?php echo $appForm->error('Member.birthday_comp', '生日');?>
            <script>
            var ds = new DateSelector("MemberBirthdayYear", "MemberBirthdayMonth", "MemberBirthdayDay", {
                MinYear: 1930,
                MaxYear: new Date().getFullYear() - 1,
                onChange: function(){  }
            });
            ds.onChange();
            </script>
            </li>
            <li><span class="tit">性别：</span> 
            <?php $this->data['Member']['sex'] = !empty($this->data['Member']['sex'])?$this->data['Member']['sex']:SEX_MALE;?>
            <span class="sex"><?php echo $appForm->radio('sex', $msts['sex'], array('class'=>'noBorder', 'label' => true, 'legend' => false, 'separator' => '&nbsp;&nbsp;'));?></span>
            </li>
            <li><span class="tit"><em>*</em> 邮件地址：</span>
            <?php echo $appForm->text('email', array('class'=>'w_210', 'autocomplete'=>'off', 'onblur'=>"javascript:zenToHan(this);chageLetterCase(this);trimAllSpace(this);"));?>
            <?php echo $appForm->error('Member.email', '邮件地址');?>
            </li>
            <li><span class="tit">密码：</span>
            ●●●●●●●●●
            <span class="nor"><a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/password_reset">[密码修改]</a> </span>
            </li>
            <?php echo $this->element('address/area');?>
            <li><span class="tit"><em>*</em>手机/电话：</span>
            <?php echo $appForm->text('phone', array('class'=>'w_210', 'onblur'=>"javascript:zenToHan(this);trimAllSpace(this);removeHyphen(this);"));?>
            <?php echo $appForm->error('Member.phone', '手机/电话');?>
            </li>
            <li class="left" style="padding-left:110px"><button type="button" class="btnImg btnEdit" onclick="javaScript:submitForm('MemberUpdateForm');"></button>
            </li>
        <?php echo $appForm->end();?>
        </ul>
    </div>
    <!-- 右侧详细信息 end -->
</div>
<!-- main end -->
<div style="display: none">
<?php echo $appForm->create('Image', array('id'=>'uploadImg', 'type'=>'post', 'enctype'=>'multipart/form-data', 'url'=>'/image_upload/ajax_upload'));?>
    <input type="hidden" name="savePath" id="savePath" /> 
    <input type="hidden" name="widthNew" id="widthNew" /> 
    <input type="hidden" name="heightNew" id="heightNew" />
    <input type="hidden" name="prefix"    value="<?php echo $this->data['Member']['id'];?>_" />
<?php echo $appForm->end();?>
</div>
<script type="text/javascript">
function uploadPhoto() {
    if ($("#picPath").val() == '<?php echo $this->data['MemberPhoto']['photo_path'];?>') {
        return;//alert('<?php echo renderMsg(__('error.pleaseSelect', true), '图片');?>');
    } else {
        submitForm('MemberPhotoForm');
    }
}
</script>