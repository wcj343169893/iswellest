<script type="text/javascript" src="/js/admin/admin.js"></script>
<div class="mainWrapper">
    <?php echo $appForm->create('Admin', array('action'=>'edit_comp'));?>
    <?php echo $appForm->hidden('id');?>
    <?php echo $appForm->hidden('referer');?>
    <?php echo $appForm->hidden('mode', array('value'=>'save'));?>
    <h2>添加/编辑管理员</h2>
    <div class="search">
        <p class="inline">用户名</p>
        <?php echo $appForm->text('login_id', array('maxLength'=>'20', 'class'=>'input', 'autocomplete'=>'off'));?>
        <?php echo $appForm->error('Admin.login_id', '用户名');?>
        <?php if ($appSession->check('Message.adminLoginIdIsExists')):?>
            <br><label class="error-message"><?php echo $appSession->flash('adminLoginIdIsExists', false);?></label>
        <?php endif;?>
    </div>
    <div class="search">
        <p class="inline">密&nbsp;&nbsp;&nbsp;码</p>
        <?php echo $appForm->password('password', array('maxLength'=>'16','class'=>'input', 'autocomplete'=>'off'));?>
        <?php echo $appForm->error('Admin.password', '密码');?>
    </div>
    <div class="search">
        <p class="inline">确认密码</p>
        <?php echo $appForm->password('password_confirm', array('maxLength'=>'16','class'=>'input', 'autocomplete'=>'off'));?>
        <?php echo $appForm->error('Admin.password_confirm', '确认密码');?>
    </div>
    <h3>权限</h3>
    <table cellpadding="0" cellspacing="0">
        <tbody>
        <?php foreach($menuList as $key => $value):?>
            <tr>
                <td class="title"><?php echo $appForm->checkBox("Admin.auth_info.{$value['path']}.self", array('id'=>"Admin.auth_info.{$value['path']}" ,'value'=>ACTIVE_FLG_TRUE, 'onClick'=>"javaScript:checkAll(this);"));?> <?php echo $value['name'];?> :</td>
                <td><?php foreach($value['list'] as $k => $v):?> 
                <span>
                <?php echo $appForm->checkBox("Admin.auth_info.{$value['path']}.{$v['path']}", array('id'=>"Admin.auth_info.{$value['path']}.{$v['path']}", 'value'=>ACTIVE_FLG_TRUE, 'onClick'=>"javaScript:checkObj(this,'Admin.auth_info.".$value['path']."');"));?> <?php echo $v['name'];?>
                </span> <?php endforeach;?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <?php if ( $appSession->check('Message.authinfoIsRequired')):?>
        <?php echo $appSession->flash('authinfoIsRequired');?>
    <?php endif;?>
    <div class="btn clearfix">
        <input type="submit" name="button3" id="button3" class="btnWidth" value="确定" />
    </div>
    <?php echo $appForm->end();?>
</div>