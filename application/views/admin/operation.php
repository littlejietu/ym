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
      <h3><?php echo lang('nc_operation_set')?></h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('nc_operation_set');?></span></a></li>
        
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="settingForm" id="settingForm" action="<?php echo ADMIN_SITE_URL.'/operation/save'?>">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <tbody>
          <!-- <tr class="noborder">
          <td colspan="2" class="required"><label><?php echo lang('points_isuse');?>:</label></td>
                  </tr>
                  <tr class="noborder">
          <td class="vatop rowform onoff">
          <label for="points_isuse_1" class="cb-enable <?php if($list['points_isuse'] == 1){?>selected<?php }?>" title="<?php echo lang('gold_isuse_open');?>"><span><?php echo lang('points_isuse_open');?></span></label>
            <label for="points_isuse_0" class="cb-disable <?php if($list['points_isuse'] == 0){?>selected<?php }?>" title="<?php echo lang('gold_isuse_close');?>"><span><?php echo lang('points_isuse_close');?></span></label>
            <input type="radio" id="points_isuse_1" name="points_isuse" value="1" <?php if($list['points_isuse'] == 1){?>checked="checked"<?php }?>>
            <input type="radio" id="points_isuse_0" name="points_isuse" value="0" <?php if($list['points_isuse'] == 0){?>checked="checked"<?php }?>>
          <td class="vatop tips"><?php echo lang('points_isuse_notice');?></td>
                  </tr> -->
        <!-- <tr>
          <td colspan="2" class="required"><?php echo lang('open_pointshop_isuse');?>: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
            <label for="pointshop_isuse_1" class="cb-enable <?php if($list['pointshop_isuse'] == 1){?>selected<?php }?>" title="<?php echo lang('nc_open');?>"><span><?php echo lang('nc_open');?></span></label>
            <label for="pointshop_isuse_0" class="cb-disable <?php if($list['pointshop_isuse'] == 0){?>selected<?php }?>" title="<?php echo lang('nc_close');?>"><span><?php echo lang('nc_close');?></span></label>
            <input id="pointshop_isuse_1" name="pointshop_isuse"  value="1" type="radio" <?php if($list['pointshop_isuse'] == 1){?>checked="checked"<?php }?>>
            <input id="pointshop_isuse_0" name="pointshop_isuse"  value="0" type="radio" <?php if($list['pointshop_isuse'] == 0){?>checked="checked"<?php }?>></td>
          <td class="vatop tips"><?php echo lang('open_pointshop_isuse_notice');?></td>
        </tr> -->
        <!-- <tr>
          <td colspan="2" class="required"><?php echo lang('open_pointprod_isuse');?>: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
          <label for="pointprod_isuse_1" class="cb-enable <?php if($list['pointprod_isuse'] == 1){?>selected<?php }?>" title="<?php echo lang('nc_open');?>"><span><?php echo lang('nc_open');?></span></label>
            <label for="pointprod_isuse_0" class="cb-disable <?php if($list['pointprod_isuse'] == 0){?>selected<?php }?>" title="<?php echo lang('nc_close');?>"><span><?php echo lang('nc_close');?></span></label>
            <input id="pointprod_isuse_1" name="pointprod_isuse"  value="1" type="radio" <?php if($list['pointprod_isuse'] == 1){?>checked="checked"<?php }?>>
            <input id="pointprod_isuse_0" name="pointprod_isuse"  value="0" type="radio" <?php if($list['pointprod_isuse'] == 0){?>checked="checked"<?php }?>></td>
            <td class="vatop tips"><?php echo lang('open_pointprod_isuse_notice');?></td>
        </tr> -->
        
        <!-- <tr>
          <td colspan="2" class="required"><?php echo lang('voucher_allow');?>: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
          <label for="voucher_allow_1" class="cb-enable <?php if($list['voucher_allow'] == 1){?>selected<?php }?>" title="<?php echo lang('nc_open');?>"><span><?php echo lang('nc_open');?></span></label>
            <label for="voucher_allow_0" class="cb-disable <?php if($list['voucher_allow'] == 0){?>selected<?php }?>" title="<?php echo lang('nc_open');?>"><span><?php echo lang('nc_close');?></span></label>
            <input id="voucher_allow_1" name="voucher_allow"  value="1" type="radio" <?php if($list['voucher_allow'] == 1){?>checked="checked"<?php }?>>
            <input id="voucher_allow_0" name="voucher_allow"  value="0" type="radio" <?php if($list['voucher_allow'] == 0){?>checked="checked"<?php }?>></td>
          <td class="vatop tips"><?php echo lang('voucher_allow_notice');?></td>
        </tr> -->
        
        <tr style="display:none;">
          <td colspan="2" class="required" >配置apk文件的下载地址: </td>
        </tr>
        <tr class="noborder" style="display:none;">
          <td class="vatop rowform onoff">
            <input id="apkdownload_url" name="apkdownload_url"  value="<?php if(!empty($list['apkdownload_url'])){ echo $list['apkdownload_url'];}?>" type="text" >
          <td class="vatop tips"></td>
        </tr>
        
        <tr>
          <td colspan="2" class="required"><label for="file_adv_pic">起始广告图片:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
            <div class="upload_block">
              <span class="type-file-show"><img class="show_image" src="<?php echo _get_cfg_path('admin_images');?>preview.png">
                <div class="type-file-preview"><img id="preview_start_ad" src="<?php if (!empty($list['start_ad'])) echo BASE_SITE_URL.'/'.$list['start_ad'];?>" onload="javascript:DrawImage(this,500,500);"></div>
              </span>
              <div class="f_note">
                  <input type="hidden"  name="start_ad" id="start_ad" value="<?php if( !empty($list['start_ad']) ) echo $list['start_ad']; else echo ''; ?>">
                  <em><i class="icoPro16"></i></em>
                  <div class="file_but">
                      <input type="hidden" name="orig_img" value="<?php if( !empty($list['start_ad']) ) echo $list['start_ad']?>"><input id="start_ad_upload" name="start_ad_upload" value="<?php echo lang('adv_upload_img')?>" type="file" >
                  </div>
              </div>
            </div>
          </td>
          <td class="vatop tips"><?php echo lang('adv_edit_support');?>gif,jpg,jpeg,png</td>
        </tr>
        
        <tr>
          <td colspan="2" class="required">起始广告时间: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
            <input id="distribute_rate_10" name="start_ad_time"  value="<?php if(!empty($list['start_ad_time'])){ echo $list['start_ad_time'];}else {echo 0;}?>" type="text" >&nbsp;秒
          <td class="vatop tips">起始广告展现时间</td>
        </tr>
        
        <tr style="display:none;">
          <td colspan="2" class="required" >配置活动的网址: </td>
        </tr>
        <tr class="noborder" style="display:none;">
          <td class="vatop rowform onoff">
            <input id="activity_url" name="activity_url"  value="<?php if(!empty($list['activity_url'])){ echo $list['activity_url'];}?>" type="text" >
          <td class="vatop tips">活动网址</td>
        </tr>
        
        <tr>
          <td colspan="2" class="required">从发货到自动签收的时间: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
            <input id="order_confirm_day" name="order_confirm_day"  value="<?php if(!empty($list['order_confirm_day'])){ echo $list['order_confirm_day'];}else {echo 0;}?>" type="text" >&nbsp;天
          <td class="vatop tips">发货之后到确认收货的时间</td>
        </tr>
        
        <tr>
          <td colspan="2" class="required">从签收到不可再退货的时间(从签收到开始发放佣金的时间): </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
            <input id="order_commis_day" name="order_commis_day"  value="<?php if(!empty($list['order_commis_day'])){ echo $list['order_commis_day'];}else {echo 0;}?>" type="text" >&nbsp;天
          <td class="vatop tips">从签收到不可再退货的时间,当订单不可再退货的时候即开始发放佣金</td>
        </tr>
        <tr>
          <td colspan="2" class="required">1级上家分佣比: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
            <input id="distribute_rate_1" name="distribute_rate_1"  value="<?php if(!empty($list['distribute_rate_1'])){ echo $list['distribute_rate_1'];}else {echo 0;}?>" type="text" >
          <td class="vatop tips">上家所能够获得的佣金占利润的比例（数值范围0-1）</td>
        </tr>
        <tr>
          <td colspan="2" class="required">2级上家分佣比: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
            <input id="distribute_rate_2" name="distribute_rate_2"  value="<?php if(!empty($list['distribute_rate_2'])){ echo $list['distribute_rate_2'];}else {echo 0;}?>" type="text" >
          <td class="vatop tips">上家所能够获得的佣金占利润的比例（数值范围0-1）</td>
        </tr>
        <tr>
          <td colspan="2" class="required">3级上家分佣比: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
            <input id="distribute_rate_3" name="distribute_rate_3"  value="<?php if(!empty($list['distribute_rate_3'])){ echo $list['distribute_rate_3'];}else {echo 0;}?>" type="text" >
          <td class="vatop tips">上家所能够获得的佣金占利润的比例（数值范围0-1）</td>
        </tr>
        <tr>
          <td colspan="2" class="required">4级上家分佣比: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
            <input id="distribute_rate_4" name="distribute_rate_4"  value="<?php if(!empty($list['distribute_rate_4'])){ echo $list['distribute_rate_4'];}else {echo 0;}?>" type="text" >
          <td class="vatop tips">上家所能够获得的佣金占利润的比例（数值范围0-1）</td>
        </tr>
        <tr>
          <td colspan="2" class="required">5级上家分佣比: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
            <input id="distribute_rate_5" name="distribute_rate_5"  value="<?php if(!empty($list['distribute_rate_5'])){ echo $list['distribute_rate_5'];}else {echo 0;}?>" type="text" >
          <td class="vatop tips">上家所能够获得的佣金占利润的比例（数值范围0-1）</td>
        </tr>
        <tr>
          <td colspan="2" class="required">6级上家分佣比: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
            <input id="distribute_rate_6" name="distribute_rate_6"  value="<?php if(!empty($list['distribute_rate_6'])){ echo $list['distribute_rate_6'];}else {echo 0;}?>" type="text" >
          <td class="vatop tips">上家所能够获得的佣金占利润的比例（数值范围0-1）</td>
        </tr>
        <tr>
          <td colspan="2" class="required">7级上家分佣比: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
            <input id="distribute_rate_7" name="distribute_rate_7"  value="<?php if(!empty($list['distribute_rate_7'])){ echo $list['distribute_rate_7'];}else {echo 0;}?>" type="text" >
          <td class="vatop tips">上家所能够获得的佣金占利润的比例（数值范围0-1）</td>
        </tr>
        <tr>
          <td colspan="2" class="required">8级上家分佣比: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
            <input id="distribute_rate_8" name="distribute_rate_8"  value="<?php if(!empty($list['distribute_rate_8'])){ echo $list['distribute_rate_8'];}else {echo 0;}?>" type="text" >
          <td class="vatop tips">上家所能够获得的佣金占利润的比例（数值范围0-1）</td>
        </tr>
        <tr>
          <td colspan="2" class="required">9级上家分佣比: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
            <input id="distribute_rate_9" name="distribute_rate_9"  value="<?php if(!empty($list['distribute_rate_9'])){ echo $list['distribute_rate_9'];}else {echo 0;}?>" type="text" >
          <td class="vatop tips">上家所能够获得的佣金占利润的比例（数值范围0-1）</td>
        </tr>
        <tr>
          <td colspan="2" class="required">10级上家分佣比: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
            <input id="distribute_rate_10" name="distribute_rate_10"  value="<?php if(!empty($list['distribute_rate_10'])){ echo $list['distribute_rate_10'];}else {echo 0;}?>" type="text" >
          <td class="vatop tips">上家所能够获得的佣金占利润的比例（数值范围0-1）</td>
        </tr>
        
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2" ><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo lang('nc_submit');?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>

<script src="<?php echo _get_cfg_path('lib')?>uploadify/jquery.uploadify.min.js" type="text/javascript"></script>

<script type="text/javascript">
<?php $timestamp = time();?>
$(function() {
  upload_file('start_ad','start_ad','<?php echo $timestamp?>','<?php echo md5($this->config->item('encryption_key') . $timestamp );?>');
});
</script>
<script>

$(function(){$("#submitBtn").click(function(){
    if($("#settingForm").valid()){
     $("#settingForm").submit();
  }
  });
});
//
$(document).ready(function(){
  $("#settingForm").validate({
    errorPlacement: function(error, element){
      error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        rules : {
        },
        messages : {
        }
  });
});
</script>
</body>
</html>