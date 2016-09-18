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
      <h3><?php echo lang('upload_set');?></h3>
      <ul class="tab-base">
        <li><a href="<?php echo ADMIN_SITE_URL.'/upload'?>" ><span><?php echo lang('upload_param');?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('default_thumb');?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" enctype="multipart/form-data" onsubmit="MySubmit();return false;" name="form1" action="<?php echo ADMIN_SITE_URL.'/upload/save_thumb'?>">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="default_goods_image"><?php echo lang('default_product_pic');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
            <div class="upload_block">
              <span class="type-file-show"><img class="show_image" src="<?php echo _get_cfg_path('admin_images');?>preview.png">
                <div class="type-file-preview"><img id="preview_goods_image" src="<?php if(isset($list['goods_image'])){ echo BASE_SITE_URL.'/'.$list['goods_image'];}?>" onload="javascript:DrawImage(this,500,500);"></div>
              </span>
              <div class="f_note">
                  <input type="hidden"  name="goods_image" id="goods_image" value="<?php if (!empty($list['goods_image'])){echo $list['goods_image'];}?>">
                  <em><i class="icoPro16"></i></em>
                  <div class="file_but">
                      <input id="goods_image_upload" name="goods_image_upload" value="<?php echo lang('adv_upload_img')?>" type="file" >
                  </div>
              </div>
            </div>
          </td>
          <td class="vatop tips"><span class="vatop rowform">300px * 300px</span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="default_store_logo"><?php echo lang('default_store_logo');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
            <div class="upload_block">
              <span class="type-file-show"><img class="show_image" src="<?php echo _get_cfg_path('admin_images');?>preview.png">
                <div class="type-file-preview"><img id="preview_store_logo" src="<?php if(isset($list['store_logo'])){ echo BASE_SITE_URL.'/'.$list['store_logo'];}?>" onload="javascript:DrawImage(this,500,500);"></div>
              </span>
              <div class="f_note">
                  <input type="hidden"  name="store_logo" id="store_logo" value="<?php if (!empty($list['store_logo'])){echo $list['store_logo'];}?>">
                  <em><i class="icoPro16"></i></em>
                  <div class="file_but">
                  <input id="store_logo_upload" name="store_logo_upload" value="<?php echo lang('adv_upload_img')?>" type="file" >
                  </div>
              </div>
            </div>
          </td>
          <td class="vatop tips"><span class="vatop rowform">200px*60px</span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="default_store_logo">默认店铺头像:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
            <div class="upload_block">
              <span class="type-file-show"><img class="show_image" src="<?php echo _get_cfg_path('admin_images');?>preview.png">
                <div class="type-file-preview"><img id="preview_store_avatar" src="<?php if(isset($list['store_avatar'])){ echo BASE_SITE_URL.'/'.$list['store_avatar'];}?>" onload="javascript:DrawImage(this,500,500);"></div>
              </span>
              <div class="f_note">
                  <input type="hidden"  name="store_avatar" id="store_avatar" value="<?php if (!empty($list['store_avatar'])){echo $list['store_avatar'];}?>">
                  <em><i class="icoPro16"></i></em>
                  <div class="file_but">
                      <input id="store_avatar_upload" name="store_avatar_upload" value="<?php echo lang('adv_upload_img')?>" type="file" >
                  </div>
              </div>
            </div>
          </td>
          <td class="vatop tips"><span class="vatop rowform">100px*100px</span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="default_user_portrait"><?php echo lang('default_user_pic');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
            <div class="upload_block">
              <span class="type-file-show"><img class="show_image" src="<?php echo _get_cfg_path('admin_images');?>preview.png">
                <div class="type-file-preview"><img id="preview_user_portrait" src="<?php if(isset($list['user_portrait'])){ echo BASE_SITE_URL.'/'.$list['user_portrait'];}?>" onload="javascript:DrawImage(this,500,500);"></div>
              </span>
              <div class="f_note">
                  <input type="hidden"  name="user_portrait" id="user_portrait" value="<?php if (!empty($list['user_portrait'])){echo $list['user_portrait'];}?>">
                  <em><i class="icoPro16"></i></em>
                  <div class="file_but">
                      <input id="user_portrait_upload" name="user_portrait_upload" value="<?php echo lang('adv_upload_img')?>" type="file" >
                  </div>
              </div>
            </div>
          </td>
          <td class="vatop tips"><span class="vatop rowform">128px*128px</span></td>
        </tr>

		
      </tbody>
      <tfoot>
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
  upload_file('goods_image','goods_image','<?php echo $timestamp?>','<?php echo md5($this->config->item('encryption_key') . $timestamp );?>');
  upload_file('user_portrait','user_portrait','<?php echo $timestamp?>','<?php echo md5($this->config->item('encryption_key') . $timestamp );?>');
  upload_file('store_logo','store_logo','<?php echo $timestamp?>','<?php echo md5($this->config->item('encryption_key') . $timestamp );?>');
  upload_file('store_avatar','store_avatar','<?php echo $timestamp?>','<?php echo md5($this->config->item('encryption_key') . $timestamp );?>');
});
</script>


</body>
</html>
