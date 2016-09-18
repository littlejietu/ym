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
      <h3><?php echo lang('web_set');?></h3>
      <ul class="tab-base">
        <li><a href="<?php echo ADMIN_SITE_URL.'/base_setting';?>"><span><?php echo lang('web_set');?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('dis_dump');?></span></a></li>        
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" id="settingForm" name="settingForm">
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label><?php echo lang('allowed_visitors_consult');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff"><label for="guest_comment_enable" class="cb-enable <?php if($list['guest_comment'] == 1){?>selected<?php }?>" title="<?php echo lang('nc_open');?>"><span><?php echo lang('nc_open');?></span></label>
            <label for="guest_comment_disabled" class="cb-disable <?php if($list['guest_comment'] == 0){?>selected<?php }?>" title="<?php echo lang('nc_close');?>"><span><?php echo lang('nc_close');?></span></label>
            <input id="guest_comment_enable" name="guest_comment" <?php if($list['guest_comment'] == 1){?>checked="checked"<?php }?> value="1" type="radio">
            <input id="guest_comment_disabled" name="guest_comment"  <?php if($list['guest_comment'] == 0){?>checked="checked"<?php }?> value="0" type="radio"></td>
          <td class="vatop tips"><?php echo lang('allowed_visitors_consult_notice');?></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><?php echo lang('open_checkcode');?>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><ul class="nofloat">
              <li>
                <input type="checkbox" value="1" name="captcha_status_login" id="captcha_status1" <?php if($list['captcha_status_login']){ echo 'checked="checked"';}?> />
                <label for="captcha_status1"><?php echo lang('front_login');?></label>
              </li>
              <li>
                <input type="checkbox" value="1" name="captcha_status_register" id="captcha_status2"  <?php if($list['captcha_status_register']){ echo 'checked="checked"';}?>/>
                <label for="captcha_status2"><?php echo lang('front_regist');?></label>
              </li>
              <li>
                <input type="checkbox" value="1" name="captcha_status_goodsqa" id="captcha_status3"  <?php if($list['captcha_status_goodsqa']){ echo 'checked="checked"';}?> />
                <label for="captcha_status3"><?php echo lang('front_goodsqa');?></label>
              </li>
            </ul></td>
          <td class="vatop tips" >&nbsp;</td>
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
</body>
</html>
