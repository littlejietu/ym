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
<!-- <script src='//kefu.easemob.com/webim/easemob.js?tenantId=14237&hide=false' async='async'></script> -->

<body>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>会员管理</h3>
      <ul class="tab-base">
        <li><a href="<?php echo ADMIN_SITE_URL.'/user'?>" ><span>管理</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>新增</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="user_form" enctype="multipart/form-data" method="post" action="<?php echo ADMIN_SITE_URL.'/user/save'?>">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="member_name">会员:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="member_name" id="member_name" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="member_passwd">密码:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="password" id="member_passwd" name="member_passwd" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="member_tel">联系电话:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" id="member_tel" name="member_tel" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="member_truename">昵称:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" id="member_truename" name="member_truename" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <!-- <tr>
          <td colspan="2" class="required"><label>性别:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><ul>
              <li>
                <label>
                  <input type="radio" checked="checked" value="0" name="member_sex">
                  保密</label>
              </li>
              <li>
                <label>
                  <input type="radio" value="1" name="member_sex">
                  男</label>
              </li>
              <li>
                <label>
                  <input type="radio" value="2" name="member_sex">
                  女</label>
              </li>
            </ul></td>
          <td class="vatop tips"></td>
        </tr> -->
        <tr>
          <td colspan="2" class="required"><label>头像:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
            <div class="upload_block">
              <span class="type-file-show"><img class="show_image" src="<?php echo _get_cfg_path('admin_images');?>preview.png">
                <div class="type-file-preview"><img id="preview_img" src="<?php if (isset($_GET['id'])) echo $info['pic'];?>" onload="javascript:DrawImage(this,500,500);"></div>
              </span>
              <div class="f_note">
                  <input type="hidden"  name="img" id="img" value="<?php if( !empty($info['img']) ) echo $info['img']; else echo ''; ?>">
                  <em><i class="icoPro16"></i></em>
                  <div class="file_but">
                      <input type="hidden" name="orig_img" value="<?php if( !empty($info['pic']) ) echo $info['pic']?>"><input id="img_upload" name="img_upload" value="<?php echo lang('adv_upload_img')?>" type="file" >
                  </div>
              </div>
            </div>
          </td>
          <td class="vatop tips"><?php echo lang('adv_edit_support');?>gif,jpg,jpeg,png</td>
        </tr>
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
$.validator.addMethod("isMobile", function(value, element) {  
    var length = value.length;  
    var regPhone = /^1([3578]\d|4[57])\d{8}$/;  
    return this.optional(element) || ( length == 11 && regPhone.test( value ) );    
}, "请正确填写您的手机号码");
</script>
<script type="text/javascript">
$(function(){
	//按钮先执行验证再提交表单
	
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
			member_name: {
				required : true,
				minlength: 3,
				maxlength: 20,
				remote   : {
                    url :'<?php echo ADMIN_SITE_URL.'/user/ajax_check_name'?>',
                    type:'get',
                    data:{
                        user_name : function(){
                            return $('#member_name').val();
                        },
                        member_id : ''
                    }
                }
			},
            member_passwd: {
				required : true,
                maxlength: 20,
                minlength: 6
            },
            member_tel   : {
                required : true,	
                isMobile : true,

            },
        },
        messages : {
			member_name: {
				required : '<?php echo lang('member_add_name_null')?>',
				maxlength: '<?php echo lang('member_add_name_length')?>',
				minlength: '<?php echo lang('member_add_name_length')?>',
				remote   : '<?php echo lang('member_add_name_exists')?>',
			},
            member_passwd : {
				required : '<?php echo '密码不能为空'; ?>',
                maxlength: '<?php echo lang('member_edit_password_tip')?>',
                minlength: '<?php echo lang('member_edit_password_tip')?>'
            },
            member_tel  : {
                required : '<?php echo lang('member_edit_tel_null')?>',
                isMobile : '请输入正确的手机号码',
            },
        }
    });
});
</script>
</body>
</html>
