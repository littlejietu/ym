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
      <h3><?php echo lang('goods_index_goods')?></h3>
      <ul class="tab-base">
        <li><a href="<?php echo ADMIN_SITE_URL.'/goods/goods_waitverify'?>"><span><?php echo lang('goods_index_all_goods');?></span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/goods/goods_lockup'?>" ><span><?php echo lang('goods_index_lock_goods');?></span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/goods/goods_waitverify'?>"><span>等待审核</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('nc_goods_set')?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="form_goodsverify">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label><?php echo lang('goods_is_verify')?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff"><label for="rewrite_enabled"  class="cb-enable <?php if($goods_verify['val'] == '1'){ ?>selected<?php } ?>" title="<?php echo lang('nc_yes');?>"><span><?php echo lang('nc_yes');?></span></label>
            <label for="rewrite_disabled" class="cb-disable <?php if($goods_verify['val'] == '0'){ ?>selected<?php } ?>" title="<?php echo lang('nc_no');?>"><span><?php echo lang('nc_no');?></span></label>
            <input id="rewrite_enabled" name="goods_verify" <?php if($goods_verify['val'] == '1'){ ?>checked="checked"<?php } ?> value="1" type="radio">
            <input id="rewrite_disabled" name="goods_verify" <?php if($goods_verify['val']== '0'){ ?>checked="checked"<?php } ?> value="0" type="radio"></td>
          <td class="vatop tips">
            <?php echo lang('open_rewrite_tips');?></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2" ><a href="JavaScript:void(0);" class="btn" onclick="document.form_goodsverify.submit()"><span><?php echo lang('nc_submit');?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
</body>
</html>