<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>big city</title>
<?php echo _get_html_cssjs('admin_js','jquery.js,jquery.validation.min.js,admincp.js,jquery.cookie.js,common.js','js');?>
<link href="<?php echo _get_cfg_path('admin').TPL_ADMIN_NAME;?>css/skin_0.css" type="text/css" rel="stylesheet" id="cssfile" />
<?php echo _get_html_cssjs('admin_css','perfect-scrollbar.min.css','css');?>

<?php echo _get_html_cssjs('font','font-awesome/css/font-awesome.min.css','css');?>

<!--[if IE 7]>
  <?php echo _get_html_cssjs('font','font-awesome/css/font-awesome-ie7.min.css','css');?>
<![endif]-->
<?php echo _get_html_cssjs('admin_js','perfect-scrollbar.min.js','js');?>

</head>
<body>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo lang('upload_set');?></h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('upload_param');?></span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/upload/default_thumb'?>" ><span><?php echo lang('default_thumb');?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="form" method="post" enctype="multipart/form-data" name="settingForm" action="<?php echo ADMIN_SITE_URL.'/upload/save_index'?>">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="site_name"><?php echo lang('image_dir_type');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><ul class="nofloat">
              <li>
                <input id="image_dir_type_0" name="image_dir_type" type="radio" style="margin-bottom:6px;" value="1" <?php if ($list['image_dir_type'] == 1){?>checked="checked"<?php }?>/>
                <label for="image_dir_type_0"><?php echo lang('image_dir_type_0');?></label>
              </li>
              <li>
                <input id="image_dir_type_1" name="image_dir_type" type="radio" style="margin-bottom:6px;" value="2" <?php if ($list['image_dir_type'] == 2){?>checked="checked"<?php }?>/>
                <label for="image_dir_type_1"><?php echo lang('image_dir_type_1');?></label>
              </li>
              <li>
                <input id="image_dir_type_2" name="image_dir_type" type="radio" style="margin-bottom:6px;" value="3" <?php if ($list['image_dir_type'] == 3){?>checked="checked"<?php }?>/>
                <label for="image_dir_type_2"><?php echo lang('image_dir_type_2');?></label>
              </li>
              <li>
                <input id="image_dir_type_3" name="image_dir_type" type="radio" style="margin-bottom:6px;" value="4" <?php if ($list['image_dir_type'] == 4){?>checked="checked"<?php }?>/>
                <label for="image_dir_type_3"><?php echo lang('image_dir_type_3');?></label>
              </li>
            </ul></td>
          <td class="vatop tips"></td>
        </tr>
		<tr>
          <td colspan="2" class="required"><label for="image_max_filesize"><?php echo lang('upload_image_filesize');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo lang('upload_image_file_size');?>:
            <input id="image_max_filesize" name="image_max_filesize" type="text" class="txt" style="width:30px;" value="<?php echo $list['image_max_filesize'];?>"/>
            KB&nbsp;(1024 KB = 1MB)</td>
          <td class="vatop tips"><?php echo lang('image_max_size_tips');?></td>
        </tr>
		<tr>
          <td colspan="2" class="required"><label for="image_allow_ext"><?php echo lang('image_allow_ext');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="image_allow_ext" name="image_allow_ext" value="<?php if (!empty($list['image_allow_ext'])){echo $list['image_allow_ext'];}?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo lang('image_allow_ext_notice');?></span></td>
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
<script type="text/javascript">
//<!CDATA[
$(function(){
	$('#form').validate({
		rules : {
			image_max_size : {
				number : true,
				maxlength : 4
			},
			image_allow_ext : {
				required : true
			}
		},
		messages : {
			image_max_size : {
				number : '<?php echo lang('image_max_size_only_num');?>',
				maxlength : '<?php echo lang('image_max_size_c_num');?>'
			},
			image_allow_ext : {
				required : '<?php echo lang('image_allow_ext_not_null');?>'
			}
		}
	});
});
//]]>
</script>
</body>
</html>