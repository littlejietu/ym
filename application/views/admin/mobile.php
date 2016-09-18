
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
      <!-- <li><a href="<?php echo ADMIN_SITE_URL.'/message/email';?>"><span><?php echo lang('nc_email_config');?></span></a></li> -->
      <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('nc_mobile_config');?></span></a></li>
      <li><a href="<?php echo ADMIN_SITE_URL.'/message/index';?>"><span><?php echo lang('nc_message_tpl');?></span></a></li>
      <li><a href="<?php echo ADMIN_SITE_URL.'/message/add';?>"><span><?php echo lang('nc_message_tpl_add');?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" id="form_email" name="settingForm">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <tbody>
       <tr class="noborder">
          <td colspan="2" class="required">选择短信平台:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">  
          <label>
          <input type="radio" name="mobile_host_type" value="1" <?php if($list['mobile_host_type'] == 1){?>checked="checked"<?php }?> />短信宝
          </label>
          <label>
          <input type="radio" name="mobile_host_type" value="2" <?php if($list['mobile_host_type'] == 2){?>checked="checked"<?php }?>/>
          云片网络
          </label>
          </td>
          <td class="vatop tips"><label class="field_notice">二选一</label></td>
        </tr>
        
        <tr class="noborder">
          <td colspan="2" class="required">短信服务商名称:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $list['mobile_host'];?>" name="mobile_host" id="mobile_host" class="txt"></td>
          <td class="vatop tips"><label class="field_notice"> 	可选填写【短信宝<a href="http://api.smsbao.com/" target="_blank">http://api.smsbao.com/</a>】，
          【云片网络<a href="http://www.yunpian.com/" target="_blank">http://www.yunpian.com/</a>】</label></td>
        </tr>
        <tr>
          <td colspan="2" class="required">短信平台账号:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $list['mobile_username'];?>" name="mobile_username" id="mobile_username" class="txt"></td>
          <td class="vatop tips"><label class="field_notice">用户名</label></td>
        </tr>
        <tr>
          <td colspan="2" class="required">短信平台密码:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $list['mobile_pwd'];?>" name="mobile_pwd" id="mobile_pwd" class="txt"></td>
          <td class="vatop tips"><label class="field_notice">短信平台密码</label></td>
        </tr>
        <tr>
          <td colspan="2" class="required">短信平台Key:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $list['mobile_key'];?>" name="mobile_key" id="mobile_key" class="txt"></td>
          <td class="vatop tips"><label class="field_notice">可选填写【使用云片网络时用到】</label></td>
        </tr>
        
         <tr>
          <td colspan="2" class="required">短信内容签名:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $list['mobile_signature'];?>" name="mobile_signature" id="mobile_signature" class="txt"></td>
          <td class="vatop tips"><label class="field_notice">如： 卓尔网络</label></td>
        </tr>
        
        <tr>
          <td colspan="2" class="required">备注信息:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
          <textarea id="statistics_code" class="tarea" rows="6" name="mobile_memo"><?php echo $list['mobile_memo'];?></textarea></td>
          <td class="vatop tips"><label class="field_notice">可选填写</label></td>
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
	$('#send_test_mobile').click(function(){
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
