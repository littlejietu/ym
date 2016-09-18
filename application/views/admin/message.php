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

</head>
<body>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo lang('nc_message_set');?></h3>
      <ul class="tab-base">
      <!-- <li><a href="<?php echo ADMIN_SITE_URL.'/message/email';?>"><span><?php echo lang('nc_email_config');?></span></a></li> -->
      <li><a href="<?php echo ADMIN_SITE_URL.'/message/mobile';?>"><span><?php echo lang('nc_mobile_config');?></span></a></li>
      <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('nc_message_tpl');?></span></a></li>
      <li><a href="<?php echo ADMIN_SITE_URL.'/message/add';?>"><span><?php echo lang('nc_message_tpl_add');?></span></a></li>
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
            <li>平台可给商家提供站内信、手机短信、邮件三种通知方式。平台可以选择开启一种或多种通知方式供商家选择。</li>
            <li>开启强制接收后，商家不能取消该方式通知的接收。</li>
            <li>短消息、邮件需要商家设置正确号码后才能正常接收。</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" style="margin-top:2px" width="100%">
		<tr>
            <td height="32">
                <form class="form-horizontal" role="form" method="post">
                    <select name="type_id">
                        <option value="0"><?php echo lang('mailtemplates_index_type');?></option>
                        <?php foreach ($type_list as $k=>$v):?>
                        <option value="<?=$k?>"<?php if(!empty($arrParam['type_id']) && $arrParam['type_id']==$k) echo 'selected="selected"'; ?>><?=$v?></option>
                        <?php endforeach?>
                    </select>
                    
                    <select name="field">
                      <option value="message_title"<?php if(!empty($arrParam['field']) && $arrParam['field']=='title') echo ' selected';?>><?php echo lang('mailtemplates_index_desc');?></option>
                      
                    </select>
                    <input type="text" name="txtKey" value="<?=!empty($arrParam['key']) ? $arrParam['key']:'';?>" class="w150">
                    <button type="submit" class="btn">查  询</button>
                  	
                  </form>
            </td>
        </tr>
    </table>
  <form name='form1' method='post' >
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="submit_type" id="submit_type" value="" />
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo lang('nc_list');?></th>
        </tr>
        <tr class="thead">
          <th>&nbsp;</th>
          <th><?php echo lang('mailtemplates_index_desc');?></th>
          <th class="align-center">站内信</th>
          <th class="align-center">手机短信</th>
          <th class="align-center">邮件</th>
          <th class="align-center"><?php echo lang('nc_handle');?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($list['rows'])){?>
        <?php foreach($list['rows'] as $val){?>
        <tr class="hover">
          <td class="w24">&nbsp;</td>
          <td class="w25pre"><?php echo $val['message_title']; ?></td>
          <td class="align-center"><?php echo ($val['message_switch']) ? '开启' : '关闭';?></td>
          <td class="align-center"><?php echo ($val['sms_switch']) ? '开启' : '关闭';?></td>
          <td class="align-center"><?php echo ($val['email_switch']) ? '开启' : '关闭';?></td>
          <td class="w60 align-center">
          <a href="<?php echo ADMIN_SITE_URL.'/message/add?id='.$val['id'];?>"><?php echo lang('nc_edit');?></a>
          <a href="<?php echo ADMIN_SITE_URL.'/message/del?id='.$val['id'];?>"><?php echo lang('nc_delete');?></a>
          </td>
        </tr>
        <?php } ?>
        <?php } ?>
      </tbody>
    </table>
          <div class="pagination"> <?php echo $list['pages'];?> </div>
  </form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.edit.js" charset="utf-8"></script> 
<script type="text/javascript">
function go(){
	var url="<?php echo ADMIN_SITE_URL.'/messs/save'?>";
	document.form1.action = url;
	document.form1.submit();
}
</script>

</body>
</html>