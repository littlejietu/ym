<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>big city</title>
<?php echo _get_html_cssjs('admin_js','jquery.js,jquery.validation.min.js,admincp.js,jquery.cookie.js,common.js','js');?>
<link href="<?php echo _get_cfg_path('admin').TPL_ADMIN_NAME;?>css/skin_0.css" type="text/css" rel="stylesheet" id="cssfile" />
<?php echo _get_html_cssjs('admin_css','perfect-scrollbar.min.css','css');?>

<?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome.min.css','css');?>

<!--[if IE 7]>
  <?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome-ie7.min.css','css');?>
<![endif]-->
<?php echo _get_html_cssjs('admin_js','perfect-scrollbar.min.js','js');?>
<?php echo _get_html_cssjs('lib','kindeditor/kindeditor-min.js,kindeditor/lang/zh_CN.js','js');?>
</head>
<body>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo lang('nc_message_set');?></h3>
      <ul class="tab-base">
      <!-- <li><a href="<?php echo ADMIN_SITE_URL.'/message/email';?>"><span><?php echo lang('nc_email_config');?></span></a></li> -->
      <li><a href="<?php echo ADMIN_SITE_URL.'/message/mobile';?>"><span><?php echo lang('nc_mobile_config');?></span></a></li>
      <li><a href="<?php echo ADMIN_SITE_URL.'/message';?>"><span><?php echo lang('nc_message_tpl');?></span></a></li>
      <li><a href="JavaScript:void(0);" class="current">
      <span>
      <?php
      if(isset($_GET['id']))
      {
          echo lang('nc_message_tpl_edit');
      }
      else 
      {
          echo lang('nc_message_tpl_add');
      }
      ?>
      </span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>   
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title">
            <h5><?php echo lang('nc_prompts');?></h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li>平台可给商家提供站内信、短消息、邮件三种通知方式。平台可以选择开启一种或多种通知方式供商家选择。</li>
            <li>开启强制接收后，商家不能取消该方式通知的接收。</li>
            <li>短消息、邮件需要商家设置正确号码后才能正常接收。</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method="post" name="form1" action="<?php echo ADMIN_SITE_URL.'/message/save'?>">
  <input type="hidden" name="id"  value="<?php if( !empty($info)) echo $info['id'];?>">
  <h4>模板名称：<input type="text" name="message_title" value="<?php if( !empty($info)) echo $info['message_title'];?>"></h4>
          <table class="table tb-type2">    
          <tbody>
        <tr class="noborder">
          <td class="vatop rowform">
            <select name="type_id" id="type_id">
              <option value="0">所属分类</option>
              <?php foreach ($type as $k=>$v):?>
              <option value="<?=$v['id']?>"<?php if($info['type_id'] == $v['id']){ echo 'selected="selected"';}?>><?=$v['name']?></option>
              <?php endforeach?>
            </select>
          <td class="vatop tips"></td>
        </tr>
          <tr>
              <td colspan="2" class="required"><label>跳转按钮名：</label></td>
            </tr>
            <tr class="noborder">
              <td class="vatop rowform">
              <input type="text" name="action_title" value="<?php if( !empty($info)) echo $info['action_title'];?>"/></input>
              </td>
            </tr>
            <tr>
              <td colspan="2" class="required"><label>跳转网址：</label></td>
            </tr>
            <tr class="noborder">
              <td class="vatop rowform">
              <input type="text" name="web_url" value="<?php if( !empty($info)) echo $info['web_url'];?>"/></input>
              </td>
            </tr>
            <tr>
              <td colspan="2" class="required"><label>APP跳转地址：</label></td>
            </tr>
            <tr class="noborder">
              <td class="vatop rowform">
              <input type="text" name="app_url" value="<?php if( !empty($info)) echo $info['app_url'];?>"/></input>
              </td>
            </tr>
          </tbody>
    </table>
  <div class="homepage-focus" nctype="sellerTplContent" >
    
    <ul class="tab-menu">
      <li class="current">站内信模板</li>
      <li>手机短信模板</li>
      <li>邮件模板</li>
    </ul>

    
      <!-- 站内信 S -->
      
      <div class="tab-content">
        <table class="table tb-type2">
          <tbody>
            <tr class="noborder">
              <td colspan="2" class="required"><label>站内信开关:</label></td>
            </tr>
            <tr class="noborder">
              <td class="vatop rowform onoff">
                <label for="message_switch1" class="cb-enable <?php if($info['message_switch'] == 1){?>selected<?php }?>"><span><?php echo lang('nc_open');?></span></label>
                <label for="message_switch0" class="cb-disable <?php if($info['message_switch'] == 0){?>selected<?php }?>"><span><?php echo lang('nc_close');?></span></label>
                <input id="message_switch1" name="message_switch" <?php if($info['message_switch'] == 1){?>checked="checked"<?php }?> value="1" type="radio">
                <input id="message_switch0" name="message_switch" <?php if($info['message_switch'] == 0){?>checked="checked"<?php }?> value="0" type="radio"></td>
              <td class="vatop tips"></td>
            </tr>
            <tr class="noborder">
              <td colspan="2" class="required"><label>推送开关:</label></td>
            </tr>
            <tr class="noborder">
              <td class="vatop rowform onoff">
                <label for="need_push1" class="cb-enable <?php if($info['need_push'] == 1){?>selected<?php }?>"><span><?php echo lang('nc_open');?></span></label>
                <label for="need_push0" class="cb-disable <?php if($info['need_push'] == 0){?>selected<?php }?>"><span><?php echo lang('nc_close');?></span></label>
                <input id="need_push1" name="need_push" <?php if($info['need_push'] == 1){?>checked="checked"<?php }?> value="1" type="radio">
                <input id="need_push0" name="need_push" <?php if($info['need_push'] == 0){?>checked="checked"<?php }?> value="0" type="radio"></td>
              <td class="vatop tips"></td>
            </tr>
            <tr>
              <td colspan="2" class="required"><label>消息内容:</label></td>
            </tr>
            <tr class="noborder">
              <td class="vatop rowform">
                <textarea name="message_content" rows="6" class="tarea"><?php if( !empty($info)) echo $info['message_content'];?></textarea>
              </td>
              <td class="vatop tips"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- 站内信 E -->
      
      <!-- 短消息 S -->
      <div class="tab-content" style="display:none;">
        <table class="table tb-type2">
          <tbody>
            <tr class="noborder">
              <td colspan="2" class="required"><label>手机短信开关:</label></td>
            </tr>
            <tr class="noborder">
              <td class="vatop rowform onoff">
                <label for="short_switch1" class="cb-enable <?php if($info['sms_switch'] == 1){?>selected<?php }?>"><span><?php echo lang('nc_open');?></span></label>
                <label for="short_switch0" class="cb-disable <?php if($info['sms_switch'] == 0){?>selected<?php }?>"><span><?php echo lang('nc_close');?></span></label>
                <input id="short_switch1" name="sms_switch" <?php if($info['sms_switch'] == 1){?>checked="checked"<?php }?> value="1" type="radio">
                <input id="short_switch0" name="sms_switch"  <?php if($info['sms_switch'] == 0){?>checked="checked"<?php }?> value="0" type="radio"></td>
              <td class="vatop tips"></td>
            </tr>
            <tr>
              <td colspan="2" class="required"><label>消息内容:</label></td>
            </tr>
            <tr class="noborder">
              <td class="vatop rowform">
                <textarea name="sms_content" ><?php if( !empty($info)) echo $info['sms_content'];?></textarea>
              </td>
              <td class="vatop tips"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- 短消息 E -->
      <!-- 邮件 S -->
      <div class="tab-content" style="display:none;">
        
        <table class="table tb-type2">
          <tbody>
            <tr class="noborder">
              <td colspan="2" class="required"><label>邮件开关:</label></td>
            </tr>
            <tr class="noborder">
              <td class="vatop rowform onoff">
                <label for="mail_switch1" class="cb-enable <?php if($info['email_switch'] == 1){?>selected<?php }?>"><span><?php echo lang('nc_open');?></span></label>
                <label for="mail_switch0" class="cb-disable <?php if($info['email_switch'] == 0){?>selected<?php }?>"><span><?php echo lang('nc_close');?></span></label>
                <input id="mail_switch1" name="email_switch" <?php if($info['email_switch'] == 1){?>checked="checked"<?php }?> value="1" type="radio">
                <input id="mail_switch0" name="email_switch"  <?php if($info['email_switch'] == 0){?>checked="checked"<?php }?>value="0" type="radio"></td>
              <td class="vatop tips"></td>
            </tr>
            <tr>
              <td colspan="2" class="required"><label>邮件标题:</label></td>
            </tr>
            <tr class="noborder">
              <td class="vatop rowform">
                <input  type="text" name="email_title" value="<?php if( !empty($info)) echo $info['email_title'];?>"></input>
              </td>
              <td class="vatop tips"></td>
            </tr>
            <tr>
              <td colspan="2" class="required"><label>邮件内容:</label></td>
            </tr>
            <tr class="noborder">
              <td colspan="2"><textarea name="email_content" ><?php if( !empty($info['email_content'])) echo $info['email_content'];?></textarea></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- 邮件 E -->

      <div class="margintop">
        <input type="submit" />
      </div>
    
  </div>
  </form>
</div>


<script>
$(function(){
    $('div[nctype="sellerTplContent"] > ul').find('li').click(function(){
        $(this).addClass('current').siblings().removeClass('current');
        var _index = $(this).index();
        var _div = $('div[nctype="sellerTplContent"]').find('div[class="tab-content"]');
        _div.hide();
        _div.eq(_index).show();

        $('.ke-container').width("650px");
    });

    //getKindEditor_small_group(new Array('textarea[name="message_content"]','textarea[name="sms_content"]','textarea[name="email_content"]'));
    getKindEditor_small('textarea[name="email_content"]');

});
</script>
</body>
</html>
