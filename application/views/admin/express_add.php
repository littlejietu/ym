
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
       <h3><?php echo lang('adv_index_manage');?>添加快递公司</h3>
      <ul class="tab-base">
        
        <li><a href="<?php echo ADMIN_SITE_URL.'/express/';?>" ><span>列表链接<?php echo lang('adv_manage');?></span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/express/add';?>" class="current"><span>添加连接</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
 <form id="adv_form" method="post" action="<?php echo ADMIN_SITE_URL.'/express/save'?>">
   
    
    <input type="hidden" name="id" value="ok" />
    <?php  if (isset($_GET['id'])){?>
    <input type="hidden" name="id" value="<?php echo $_GET['id']?>" />
    <?php }?>
    <table class="table tb-type2" id="main_table">
    
    
    
    
    <!--<table class="table tb-type2 nobdb">-->
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="express_title">名称:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if (isset($_GET['id'])){ echo $info['name'];}?>" name="name" id="express_name" class="txt"></td>
          <td class="vatop tips">快递公司的名称</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation"><?php echo lang('express_code');?>调用代码: </label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if (isset($info['code']))echo $info['code']?>" name="code" id="code" class="infoTableInput"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="express_title">首字母:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if (isset($_GET['id'])){ echo $info['initial'];}?>" name="initial" id="express_initial" class="txt"></td>
          <td class="vatop tips">快递公司的首个字母</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="express_url">网址:</label></td>

        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="http://<?php if (isset($_GET['id'])){ echo $info['url'];}?>" name="url" id="express_url" class="txt"></td>
          <td class="vatop tips">快递公司的网址</td>
        </tr>
        <tr>
            <td colspan="2" class="required"><label for="express_sort">常用:</label></td>
        </tr>
        <tr class="noborder">
          <td align="left" class="padL5" colspan="2">
              <input type="radio" name="use_status" value="1" <?php if( !empty($info['use_status']) && $info['use_status']==1 ) echo ' checked' ?> />常用
              <input type="radio" name="use_status" value="0" <?php if( !empty($info['use_status']) && $info['use_status']==0 ) echo ' checked' ?> />不常用
            </td>
        </tr>
        <tr>
            <td colspan="2" class="required"><label for="express_sort">状态:</label></td>
        </tr>
        <tr class="noborder">
          <td align="left" class="padL5" colspan="2">
              <input type="radio" name="status" value="1" <?php if( !empty($info['status']) && $info['status']==1 ) echo ' checked' ?> />可用
              <input type="radio" name="status" value="2" <?php if( !empty($info['status']) && $info['status']==2 ) echo ' checked' ?> />不可用
            </td>
        </tr>
        <tr>
            <td colspan="2" class="required"><label for="express_sort">支持服务站配送:</label></td>
        </tr>
        <tr class="noborder">
          <td align="left" class="padL5" colspan="2">
              <input type="radio" name="delivery_status" value="1" <?php if( !empty($info['delivery_status']) && $info['delivery_status']==1 ) echo ' checked' ?> />支持
              <input type="radio" name="delivery_status" value="0" <?php if( !empty($info['delivery_status']) && $info['delivery_status']==0 ) echo ' checked' ?> />不支持
            </td>
        </tr>
      </tbody>   

      <tfoot>
        <tr class="tfoot">
          <td colspan="15" ><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo lang('nc_submit');?>提交</span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>


<?php echo _get_html_cssjs('lib','jquery-ui/themes/ui-lightness/jquery.ui.css','css');?>
<?php echo _get_html_cssjs('lib','jquery-ui/jquery.ui.js','js');?>
<script src="<?php echo _get_cfg_path('lib')?>uploadify/jquery.uploadify.min.js" type="text/javascript"></script>

<script type="text/javascript">
<?php $timestamp = time();?>
$(function() {
  upload_file('img','img','<?php echo $timestamp?>','<?php echo md5($this->config->item('encryption_key') . $timestamp );?>');
});
</script>
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#adv_form").valid()){
     $("#adv_form").submit();
	}
	});
});
//
$(document).ready(function(){
	$('#adv_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        rules : {
        	name : {
                required : true
            },
            code : {
                required : true
            },
            initial : {
                required : true
            },
            url  : {
                required : true,
                date	 : false
            },
            
        },
        messages : {
        	name : {
                required : '<?php echo lang('express_can_not_null');?>'
            },
            code : {
                required : '<?php echo lang('express_can_not_null');?>'
            },
            initial : {
                required : '<?php echo lang('express_can_not_null');?>'
            },
            url  : {
                required : '<?php echo lang('adv_start_time_can_not_null'); ?>'
            },
            
        }
    });
});
</script>
<script type="text/javascript">
$(function(){
	var textButton="<input type='text' name='textfield' id='textfield1' class='type-file-text' /><input type='button' name='button' id='button1' value='' class='type-file-button' />"
    $(textButton).insertBefore("#file_adv_pic");
    $("#file_adv_pic").change(function(){
	$("#textfield1").val($("#file_adv_pic").val());
    });

	var textButton="<input type='text' name='textfield' id='textfield3' class='type-file-text' /><input type='button' name='button' id='button3' value='' class='type-file-button' />"
    $(textButton).insertBefore("#file_flash_swf");
    $("#file_flash_swf").change(function(){
	$("#textfield3").val($("#file_flash_swf").val());
    });
    
    
});
</script>





</body>
</html>