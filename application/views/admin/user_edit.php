<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>big city</title>
<?php echo _get_html_cssjs('admin_js','jquery.js,jquery.validation.min.js,admincp.js,jquery.cookie.js,common.js','js');?>
<link href="<?php echo _get_cfg_path('admin').TPL_ADMIN_NAME;?>css/skin_0.css" type="text/css" rel="stylesheet" id="cssfile" />
<?php echo _get_html_cssjs('admin_css','perfect-scrollbar.min.css','css');?>
<?php echo _get_html_cssjs('lib','uploadify/uploadify.css','css');?>

<?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome.min.css','css');?>

<!--[if IE 7]>
  <?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome-ie7.min.css','css');?>
<![endif]-->
<?php echo _get_html_cssjs('admin_js','perfect-scrollbar.min.js','js');?>

</head>
<body>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>会员管理</h3>
      <ul class="tab-base">
        <li><a href="<?php echo ADMIN_SITE_URL.'/user'?>" ><span>管理</span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/user/add'?>" ><span>新增</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>编辑</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="user_form" enctype="multipart/form-data" method="post" >
    <input type="hidden" name="member_id" value="<?php if (!empty($info['user_id'])) echo $info['user_id'];?>" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label>会员:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php if (!empty($info['user_name'])) echo $info['user_name'];?></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="member_passwd">密码:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="password" id="member_passwd" name="member_passwd" class="txt"></td>
          <td class="vatop tips"><?php echo lang('member_edit_password_keep')?></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="member_truename">昵称:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if (!empty($info['name'])) echo $info['name'];?>" id="member_truename" name="member_truename" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <!-- <tr>
                 <td colspan="2" class="required"><label>性别:</label></td>
               </tr>
               <tr class="noborder">
                 <td class="vatop rowform"><ul>
                     <li>
                       <input type="radio"  <?php //if($info['sex'] == 0){ ?>checked="checked"<?//php } ?> value="0" name="member_sex" id="member_sex0">
                       <label for="member_sex0">保密</label>
                     </li>
                     <li>
                       <input type="radio"  <?php //if($info['sex'] == 1){ ?>checked="checked"<?//php } ?> value="1" name="member_sex" id="member_sex1">
                       <label for="member_sex1">男</label>
                     </li>
                     <li>
                       <input type="radio"  <?php //if($info['sex'] == 2){ ?>checked="checked"<?//php } ?> value="2" name="member_sex" id="member_sex2">
                       <label for="member_sex2">女</label>
                     </li>
                   </ul></td>
                 <td class="vatop tips"></td>
               </tr> -->       
        
          <tr>
          <td colspan="2" class="required"><label class="member_mobile">手机号码:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if (!empty($info['mobile'])) echo $info['mobile'];?>" id="member_mobile" name="member_mobile" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label>头像:</label></td>
        </tr>
         <tr class="noborder">
          <td class="vatop rowform">
            <div class="upload_block">
              <span class="type-file-show"><img class="show_image" src="<?php echo _get_cfg_path('admin_images');?>preview.png">
                <div class="type-file-preview"><img id="preview_img" src="<?php if (!empty($info['logo'])) echo BASE_SITE_URL.'/'.$info['logo'];?>" onload="javascript:DrawImage(this,500,500);"></div>
              </span>
              <div class="f_note">
                  <input type="hidden"  name="img" id="img" value="<?php if( !empty($info['logo']) ) echo $info['logo']; else echo ''; ?>">
                  <em><i class="icoPro16"></i></em>
                  <div class="file_but">
                      <input id="img_upload" name="img_upload" value="<?php echo lang('adv_upload_img')?>" type="file" >
                  </div>
              </div>
            </div>
          </td>
          <td class="vatop tips"><?php echo lang('adv_edit_support');?>gif,jpg,jpeg,png</td>
        </tr>
<!--         <tr> -->
<!--           <td colspan="2" class="required"><label>账户状态:</label></td> -->
<!--         </tr> -->
<!--         <tr class="noborder"> -->
<!--           <td class="vatop rowform onoff"> -->
<!--          	<label for="memberstate_1" class="cb-enable <?php //if($info['status'] == '1'){ ?>selected<?php //} ?>" ><span>正常</span></label>-->
<!--            <label for="memberstate_2" class="cb-disable <?php //if($info['status'] == '2'){ ?>selected<?php //} ?>" ><span>锁定</span></label>-->
<!--            <input id="memberstate_1" name="memberstate"  <?php //if($info['status'] == '1'){ ?>checked="checked"<?php //} ?> value="1" type="radio">-->
<!--            <input id="memberstate_2" name="memberstate" <?php // if($info['status'] == '2'){ ?>checked="checked"<?php //} ?> value="2" type="radio"></td>-->
<!--           <td class="vatop tips"></td> -->
<!--         </tr> -->
        
        
        
        <!--zmr>v30-->
          <tr>
          <td colspan="2" class="required"><label>手机号码验证:</label></td>
        </tr>
         <tr class="noborder">
          <td class="vatop rowform onoff">
          	<label for="membermobilebind_1" class="cb-enable <?php if($info['mobile_verify'] == '1'){ ?>selected<?php } ?>" ><span>已验证</span></label>
            <label for="membermobilebind_2" class="cb-disable <?php if($info['mobile_verify'] == '0'){ ?>selected<?php } ?>" ><span>未验证</span></label>
            <input id="membermobilebind_1" name="membermobilebind"  <?php if($info['mobile_verify'] == '1'){ ?>checked="checked"<?php } ?> value="1" type="radio">
            <input id="membermobilebind_2" name="membermobilebind" <?php if($info['mobile_verify'] == '0'){ ?>checked="checked"<?php } ?> value="0" type="radio"></td>
          <td class="vatop tips"></td>
        </tr>
        
        <tr>
          <td colspan="2" class="required"><label>积分:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">积分&nbsp;<strong class="red"><?php echo !empty($info['acct_integral'])?$info['acct_integral']:0 ?></strong>&nbsp;</td>
          <td class="vatop tips"></td>
        </tr>
        <!-- <tr>
          <td colspan="2" class="required"><label>经验值:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">经验值&nbsp;<strong class="red"><?php //echo 'member_exppoints'; ?></strong>&nbsp;</td>
          <td class="vatop tips"></td>
        </tr> -->
        <!-- <tr>
          <td colspan="2" class="required"><label><?php //echo lang('member_index_available');?>可用预存款:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">可用&nbsp;<strong class="red"><?php //echo 'available_predeposit'; ?></strong>&nbsp;元</td>
          <td class="vatop tips"></td>
        </tr> -->
        <!-- <tr>
          <td colspan="2" class="required"><label><?php //echo lang('member_index_frozen');?>冻结预存款:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">冻结&nbsp;<strong class="red"><?php //echo 'freeze_predeposit'; ?></strong>&nbsp;元</td>
          <td class="vatop tips"></td>
        </tr> -->
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15"><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span>提交</span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>

<script src="<?php echo _get_cfg_path('lib')?>uploadify/jquery.uploadify.min.js" type="text/javascript"></script>

<script type="text/javascript">
<?php $timestamp = time();?>
$(function() {
  upload_file('img','img','<?php echo $timestamp?>','<?php echo md5($this->config->item('encryption_key') . $timestamp );?>');
});
</script>
<script type="text/javascript">

$(function(){
$("#submitBtn").click(function(){
    if($("#user_form").valid()){
     $("#user_form").submit();
	}
	});
    $('#user_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        rules : {
            member_passwd: {
                maxlength: 20,
                minlength: 6
            },
        },
        messages : {
            member_passwd : {
                maxlength: '<?php echo lang('member_edit_password_tip')?>',
                minlength: '<?php echo lang('member_edit_password_tip')?>'
            },
        }
    });
});
</script> 
</body>
</html>
