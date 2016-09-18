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
      <h3><?php echo lang('web_set');?></h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('web_set');?></span></a></li>   
        <li><a href="<?php echo ADMIN_SITE_URL.'/base_setting/dump';?>"><span><?php echo lang('dis_dump');?></span></a></li>   
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" enctype="multipart/form-data" name="form1" action="<?php echo ADMIN_SITE_URL.'/base_setting/save'?>">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <tbody>
        <tr class="required">
          <td colspan="2" class="required"><label for="site_name"><?php echo lang('web_name');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="site_name" name="site_name" value="<?php if($list['site_name']){ echo $list['site_name'];}?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo lang('web_name_notice');?></span></td>
        </tr>
      </tbody>
      
      <tbody>
        <tr>
          <td colspan="2" class="required"><label for="site_logo"><?php echo lang('site_logo');?>:</label></td>
        </tr>
        <tr class="noborder">
        <td class="vatop rowform">
            <div class="upload_block">
              <span class="type-file-show"><img class="show_image" src="<?php echo _get_cfg_path('admin_images');?>preview.png">
                <div class="type-file-preview"><img id="preview_img" src="<?php if(isset($list['img'])){ echo BASE_SITE_URL.'/'.$list['img'];}?>" onload="javascript:DrawImage(this,500,500);"></div>
              </span>
              <div class="f_note">
                  <input type="hidden"  name="img" id="img" value="">
                  <em><i class="icoPro16"></i></em>
                  <div class="file_but">
                      <input type="hidden" name="orig_img" value="<?php if(isset($list['img'])){ echo $list['img'];}?>"><input id="img_upload" name="img_upload" value="<?php echo lang('adv_upload_img')?>" type="file" >
                  </div>
              </div>
            </div>
          </td>
          <td class="vatop tips"><span class="vatop rowform">默认网站LOGO,通用头部显示，最佳显示尺寸为240*60像素</span></td>
        </tr>
        </tbody>

         <tr>
          <td colspan="2" class="required"><label for="site_mobile_logo">手机网站LOGO:</label></td>
        </tr>
        <tr class="noborder">
        <td class="vatop rowform">
            <div class="upload_block">
              <span class="type-file-show"><img class="show_image" src="<?php echo _get_cfg_path('admin_images');?>preview.png">
                <div class="type-file-preview"><img id="preview_logo" src="<?php if(isset($list['logo'])){ echo BASE_SITE_URL.'/'.$list['logo'];}?>" onload="javascript:DrawImage(this,500,500);"></div>
              </span>
              <div class="f_note">
                  <input type="hidden"  name="logo" id="logo" value="">
                  <em><i class="icoPro16"></i></em>
                  <div class="file_but">
                      <input type="hidden" name="orig_logo" value="<?php if($list['logo']){ echo $list['logo'];}?>"><input id="logo_upload" name="logo_upload" value="<?php echo lang('adv_upload_img')?>" type="file" >
                  </div>
              </div>
            </div>
          </td>
          <td class="vatop tips"><span class="vatop rowform">默认手机网站LOGO,通用头部显示，最佳显示尺寸为116*43像素</span></td>
        </tr>
        
        <tr>
          <td colspan="2" class="required"><label for="site_logo"><?php echo lang('member_logo');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
            <div class="upload_block">
              <span class="type-file-show"><img class="show_image" src="<?php echo _get_cfg_path('admin_images');?>preview.png">
                <div class="type-file-preview"><img id="preview_member_logo" src="<?php if(isset($list['member_logo'])){ echo BASE_SITE_URL.'/'.$list['member_logo'];}?>" onload="javascript:DrawImage(this,500,500);"></div>
              </span>
              <div class="f_note">
                  <input type="hidden"  name="member_logo" id="member_logo" value="">
                  <em><i class="icoPro16"></i></em>
                  <div class="file_but">
                      <input type="hidden" name="orig_member_logo" value="<?php if($list['member_logo']){ echo $list['member_logo'];}?>"><input id="member_logo_upload" name="member_logo_upload" value="<?php echo lang('adv_upload_img')?>" type="file" >
                  </div>
              </div>
            </div>
          </td>
          <td class="vatop tips"><span class="vatop rowform">网站小尺寸LOGO，会员个人主页显示，最佳显示尺寸为200*40像素</span></td>
        </tr>
        <!-- 商家中心logo -->
        <tr>
          <td colspan="2" class="required"><label for="seller_center_logo">商家中心Logo:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
            <div class="upload_block">
              <span class="type-file-show"><img class="show_image" src="<?php echo _get_cfg_path('admin_images');?>preview.png">
                <div class="type-file-preview"><img id="preview_seller_logo" src="<?php if(isset($list['seller_logo'])){ echo BASE_SITE_URL.'/'.$list['seller_logo'];}?>" onload="javascript:DrawImage(this,500,500);"></div>
              </span>
              <div class="f_note">
                  <input type="hidden"  name="seller_logo" id="seller_logo" value="">
                  <em><i class="icoPro16"></i></em>
                  <div class="file_but">
                      <input type="hidden" name="orig_seller_logo" value="<?php if($list['seller_logo']){ echo $list['seller_logo'];}?>"><input id="seller_logo_upload" name="seller_logo_upload" value="<?php echo lang('adv_upload_img')?>" type="file" >
                  </div>
              </div>
            </div>
          </td>
          <td class="vatop tips"><span class="vatop rowform">商家中心LOGO，最佳显示尺寸为150*40像素，请根据背景色选择使用图片色彩</span></td>
        </tr>
        <!-- 商家中心logo -->
	  <!-- 商城底部微信二维码 -->
        <tr>
          <td colspan="2" class="required"><label for="site_logowx"><?php echo lang('site_bank_weixinerwei');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
            <div class="upload_block">
              <span class="type-file-show"><img class="show_image" src="<?php echo _get_cfg_path('admin_images');?>preview.png">
                <div class="type-file-preview"><img id="preview_site_logowx" src="<?php if(isset($list['site_logowx'])){ echo BASE_SITE_URL.'/'.$list['site_logowx'];}?>" onload="javascript:DrawImage(this,500,500);"></div>
              </span>
              <div class="f_note">
                  <input type="hidden"  name="site_logowx" id="site_logowx" value="">
                  <em><i class="icoPro16"></i></em>
                  <div class="file_but">
                      <input type="hidden" name="orig_site_logowx" value="<?php if($list['site_logowx']){ echo $list['site_logowx'];}?>"><input id="site_logowx_upload" name="site_logowx_upload" value="<?php echo lang('adv_upload_img')?>" type="file" >
                  </div>
              </div>
            </div>
          </td>
          <td class="vatop tips"><span class="vatop rowform">放在网站右上角顶部及首页底部右下角,最佳显示尺寸为66*66像素</span></td>
        </tr>	
	 <!-- 商城底部微信二维码 -->
        <tr>
          <td colspan="2" class="required"><label for="icp_number"><?php echo lang('icp_number');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop )"><input id="icp_number" name="icp_number" value="<?php if($list['icp_number']){ echo $list['icp_number'];}?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo lang('icp_number_notice');?></span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="site_phone"><?php echo lang('site_phone');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="site_phone" name="site_phone" value="<?php if($list['site_phone']){ echo $list['site_phone'];}?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo lang('site_phone_notice');?></span></td>
        </tr>
	
	
	
	<!-- 400 电话 -->		
<tr>
          <td colspan="2" class="required"><label for="site_tel400"><?php echo lang('site_tel400');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="site_tel400" name="site_tel400" value="<?php if($list['site_tel400']){ echo $list['site_tel400'];}?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo lang('icp_number_notice400');?></span></td>
        </tr>
		<!-- 400 电话 -->	

	
        <!--
        平台付款账号，前台暂时无调用
        <tr>
          <td colspan="2" class="required"><label for="site_bank_account"><?php echo lang('site_bank_account');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="site_bank_account" name="site_bank_account" value="<?php echo $output['list_setting']['site_bank_account'];?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo lang('site_bank_account_notice');?></span></td>
        </tr>
        -->
        <tr>
          <td colspan="2" class="required"><label for="site_email"><?php echo lang('site_email');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="site_email" name="site_email" value="<?php if($list['site_email']){ echo $list['site_email'];}?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo lang('site_email_notice');?></span></td>
        </tr>
         <tr>
          <td colspan="2" class="required"><label for="statistics_code"><?php echo lang('flow_static_code');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea name="statistics_code" rows="6" class="tarea" id="statistics_code"><?php if($list['statistics_code']){ echo $list['statistics_code'];}?></textarea></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo lang('flow_static_code_notice');?></span></td>
        </tr> 
        <tr>
          <td colspan="2" class="required"><label for="time_zone"> <?php echo lang('time_zone_set');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><select id="time_zone" name="time_zone">
              <option value="-12" <?php if($list['time_zone'] == -12){ echo 'selected';}?>>(GMT -12:00) Eniwetok, Kwajalein</option>
              <option value="-11" <?php if($list['time_zone'] == -11){ echo 'selected';}?>>(GMT -11:00) Midway Island, Samoa</option>
              <option value="-10" <?php if($list['time_zone'] == -10){ echo 'selected';}?>>(GMT -10:00) Hawaii</option>
              <option value="-9" <?php if($list['time_zone'] == -9){ echo 'selected';}?>>(GMT -09:00) Alaska</option>
              <option value="-8" <?php if($list['time_zone'] == -8){ echo 'selected';}?>>(GMT -08:00) Pacific Time (US &amp; Canada), Tijuana</option>
              <option value="-7" <?php if($list['time_zone'] == -7){ echo 'selected';}?>>(GMT -07:00) Mountain Time (US &amp; Canada), Arizona</option>
              <option value="-6" <?php if($list['time_zone'] == -6){ echo 'selected';}?>>(GMT -06:00) Central Time (US &amp; Canada), Mexico City</option>
              <option value="-5" <?php if($list['time_zone'] == -5){ echo 'selected';}?>>(GMT -05:00) Eastern Time (US &amp; Canada), Bogota, Lima, Quito</option>
              <option value="-4" <?php if($list['time_zone'] == -4){ echo 'selected';}?>>(GMT -04:00) Atlantic Time (Canada), Caracas, La Paz</option>
              <option value="-3.5" <?php if($list['time_zone'] == -3.5){ echo 'selected';}?>>(GMT -03:30) Newfoundland</option>
              <option value="-3" <?php if($list['time_zone'] == -3){ echo 'selected';}?>>(GMT -03:00) Brassila, Buenos Aires, Georgetown, Falkland Is</option>
              <option value="-2" <?php if($list['time_zone'] == -2){ echo 'selected';}?>>(GMT -02:00) Mid-Atlantic, Ascension Is., St. Helena</option>
              <option value="-1" <?php if($list['time_zone'] == -1){ echo 'selected';}?>>(GMT -01:00) Azores, Cape Verde Islands</option>
              <option value="0" <?php if($list['time_zone'] == 0){ echo 'selected';}?>>(GMT) Casablanca, Dublin, Edinburgh, London, Lisbon, Monrovia</option>
              <option value="1" <?php if($list['time_zone'] == 1){ echo 'selected';}?>>(GMT +01:00) Amsterdam, Berlin, Brussels, Madrid, Paris, Rome</option>
              <option value="2" <?php if($list['time_zone'] == 2){ echo 'selected';}?>>(GMT +02:00) Cairo, Helsinki, Kaliningrad, South Africa</option>
              <option value="3" <?php if($list['time_zone'] == 3){ echo 'selected';}?>>(GMT +03:00) Baghdad, Riyadh, Moscow, Nairobi</option>
              <option value="3.5" <?php if($list['time_zone'] == 3.5){ echo 'selected';}?>>(GMT +03:30) Tehran</option>
              <option value="4" <?php if($list['time_zone'] == 4){ echo 'selected';}?>>(GMT +04:00) Abu Dhabi, Baku, Muscat, Tbilisi</option>
              <option value="4.5" <?php if($list['time_zone'] == 4.5){ echo 'selected';}?>>(GMT +04:30) Kabul</option>
              <option value="5" <?php if($list['time_zone'] == 5){ echo 'selected';}?>>(GMT +05:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
              <option value="5.5" <?php if($list['time_zone'] == 5.5){ echo 'selected';}?>>(GMT +05:30) Bombay, Calcutta, Madras, New Delhi</option>
              <option value="5.75" <?php if($list['time_zone'] == 5.75){ echo 'selected';}?>>(GMT +05:45) Katmandu</option>
              <option value="6" <?php if($list['time_zone'] == 6){ echo 'selected';}?>>(GMT +06:00) Almaty, Colombo, Dhaka, Novosibirsk</option>
              <option value="6.5" <?php if($list['time_zone'] == 6.5){ echo 'selected';}?>>(GMT +06:30) Rangoon</option>
              <option value="7" <?php if($list['time_zone'] == 7){ echo 'selected';}?>>(GMT +07:00) Bangkok, Hanoi, Jakarta</option>
              <option value="8" <?php if($list['time_zone'] == 8){ echo 'selected';}?>>(GMT +08:00) Beijing, Hong Kong, Perth, Singapore, Taipei</option>
              <option value="9" <?php if($list['time_zone'] == 9){ echo 'selected';}?>>(GMT +09:00) Osaka, Sapporo, Seoul, Tokyo, Yakutsk</option>
              <option value="9.5" <?php if($list['time_zone'] == 9.5){ echo 'selected';}?>>(GMT +09:30) Adelaide, Darwin</option>
              <option value="10" <?php if($list['time_zone'] == 10){ echo 'selected';}?>>(GMT +10:00) Canberra, Guam, Melbourne, Sydney, Vladivostok</option>
              <option value="11" <?php if($list['time_zone'] == 11){ echo 'selected';}?>>(GMT +11:00) Magadan, New Caledonia, Solomon Islands</option>
              <option value="12" <?php if($list['time_zone'] == 12){ echo 'selected';}?>>(GMT +12:00) Auckland, Wellington, Fiji, Marshall Island</option>
            </select></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo lang('set_sys_use_time_zone');?>+8</span></td>
        </tr>              
        <tr>
          <td colspan="2" class="required"><?php echo lang('site_state');?>:</td>
        </tr>
        <tr class=")">
          <td class="vatop rowform onoff">
          <label for="site_status1" class="cb-enable <?php if($list['site_status'] == 1){ echo 'selected';}?>" ><span><?php echo lang('nc_open');?></span></label>
            <label for="site_status0" class="cb-disable <?php if($list['site_status'] == 0){ echo 'selected';}?>" ><span><?php echo lang('nc_close');?></span></label>
            <input id="site_status1" name="site_status" <?php if($list['site_status'] == 1){ echo 'checked="checked"';}?>  value="1" type="radio">
            <input id="site_status0" name="site_status"  <?php if($list['site_status'] == 0){ echo 'checked="checked"';}?> value="0" type="radio"></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo lang('site_state_notice');?></span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="closed_reason"><?php echo lang('closed_reason');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea name="closed_reason" rows="6" class="tarea" id="closed_reason" ><?php if($list['closed_reason']){ echo $list['closed_reason'];}?></textarea></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo lang('closed_reason_notice');?></span></td>
        </tr>
      <tfoot id="submit-holder">
        <tr class="tfoot">
          <td colspan="2" ><a href="JavaScript:void(0);" class="btn" onclick="document.form1.submit()"><span><?php echo lang('nc_submit');?></span></a></td>
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
  upload_file('logo','logo','<?php echo $timestamp?>','<?php echo md5($this->config->item('encryption_key') . $timestamp );?>');
  upload_file('member_logo','member_logo','<?php echo $timestamp?>','<?php echo md5($this->config->item('encryption_key') . $timestamp );?>');
  upload_file('seller_logo','seller_logo','<?php echo $timestamp?>','<?php echo md5($this->config->item('encryption_key') . $timestamp );?>');
  upload_file('site_logowx','site_logowx','<?php echo $timestamp?>','<?php echo md5($this->config->item('encryption_key') . $timestamp );?>');
});
</script>
</body>
</html>
