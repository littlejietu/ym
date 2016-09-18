
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>big city</title>
<?php echo _get_html_cssjs('admin_js','jquery.js,jquery.validation.min.js,admincp.js,jquery.cookie.js,common.js','js');?>
<link href="<?php echo _get_cfg_path('admin').TPL_ADMIN_NAME;?>css/skin_0.css" type="text/css" rel="stylesheet" id="cssfile" />
<?php echo _get_html_cssjs('admin_css','perfect-scrollbar.min.css','css');?>
<?php echo _get_html_cssjs('admin_js','uploadify/uploadify.css','css');?>

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
      <h3><?php echo lang('nc_message_set');?></h3>
      <ul class="tab-base">
      <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('nc_email_config');?></span></a></li>
      <li><a href="<?php echo ADMIN_SITE_URL.'/message/mobile';?>"><span><?php echo lang('nc_mobile_config');?></span></a></li>
      <li><a href="<?php echo ADMIN_SITE_URL.'/message/index';?>"><span><?php echo lang('nc_message_tpl');?></span></a></li>
      <li><a href="<?php echo ADMIN_SITE_URL.'/message/add';?>"><span><?php echo lang('nc_message_tpl_add');?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" id="form_email" name="settingForm" action="<?php echo ADMIN_SITE_URL.'/message/email';?>">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><?php echo lang('smtp_server');?>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $list['email_host'];?>" name="email_host" id="email_host" class="txt"></td>
          <td class="vatop tips"><label class="field_notice"><?php echo lang('set_smtp_server_address');?></label></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo lang('smtp_port');?>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $list['email_port'];?>" name="email_port" id="email_port" class="txt"></td>
          <td class="vatop tips"><label class="field_notice"><?php echo lang('set_smtp_port');?></label></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo lang('sender_mail_address');?>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $list['email_addr'];?>" name="email_addr" id="email_addr" class="txt"></td>
          <td class="vatop tips"><label class="field_notice"><?php echo lang('if_smtp_authentication');?></label></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo lang('smtp_user_name');?>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $list['email_id'];?>" name="email_id" id="email_id" class="txt"></td>
          <td class="vatop tips"><label class="field_notice"><?php echo lang('smtp_user_name_tip');?></label></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo lang('smtp_user_pwd');?>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="password" value="<?php echo $list['email_pass'];?>" name="email_pass" id="email_pass" class="txt"></td>
          <td class="vatop tips"><label class="field_notice"><?php echo lang('smtp_user_pwd_tip');?></label></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo lang('test_mail_address');?>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $list['email_test'];?>" name="email_test" id="email_test" class="txt"></td>
          <td class="vatop tips"><input type="button" value="<?php echo lang('test');?>" name="send_test_email" class="btn" id="send_test_email"></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2" ><a href="JavaScript:void(0);" class="btn" onclick="document.settingForm.submit()"><span><?php echo lang('nc_submit');?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
$(document).ready(function(){
	$('#send_test_email').click(function(){
		$.ajax({
			type:'POST',
			url:'index.php',
			data:'act=message&op=email_testing&email_host='+$('#email_host').val()+'&email_port='+$('#email_port').val()+'&email_addr='+$('#email_addr').val()+'&email_id='+$('#email_id').val()+'&email_pass='+$('#email_pass').val()+'&email_test='+$('#email_test').val(),
			error:function(){
					alert('<?php echo lang('test_email_send_fail');?>');
				},
			success:function(html){
				alert(html.msg);
			},
			dataType:'json'
		});
	});
});
</script>
</body>
</html>