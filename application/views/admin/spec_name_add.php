<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>big city</title>
<?php echo _get_html_cssjs('admin_js','jquery.js,jquery.validation.min.js,admincp.js,jquery.cookie.js,common.js','js');?>
<script src="/res/seller/js/area_array.js"></script>
<link href="<?php echo _get_cfg_path('admin').TPL_ADMIN_NAME;?>css/skin_0.css" type="text/css" rel="stylesheet" id="cssfile" />
<?php echo _get_html_cssjs('admin_css','perfect-scrollbar.min.css','css');?>
<?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome.min.css','css');?>
<?php echo _get_html_cssjs('lib','uploadify/uploadify.css','css');?>

<!--[if IE 7]>
  <?php //echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome-ie7.min.css','css');?>
<![endif]-->
<?php echo _get_html_cssjs('admin_js','perfect-scrollbar.min.js','js');?>

</head>
<body>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>规格</h3>
      <ul class="tab-base">
        <li><a href="<?php echo ADMIN_SITE_URL.'/spec_name/';?>"><span>管理</span></a></li>
        <li><a class="current" href="<?php echo ADMIN_SITE_URL.'/spec_name/add';?>"><span>新增</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="form1" method="post" action="<?php echo ADMIN_SITE_URL.'/spec_name/save'?>">
    <input type="hidden" name="form_submit" value="ok" />
   
    <input type="hidden" name="id" value="<?php if (isset($info['name_id'])){ echo $info['name_id'];}?>" />
   
    <table class="table tb-type2">
      <tbody>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="name">规格名:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if (isset($info['name'])){ echo $info['name'];}?>" id="name" name="name" class="txt" /></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required">
              <label class="validation" for="vals">规格值:</label>
          </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
              <input type="text" value="<?php if (isset($info['vals'])){ echo $info['vals'];}?>" id="vals" name="vals" class="txt" />
          </td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
              <select name="type">
                <option value="1"<?php if (isset($info['type'])) echo $info['type']==1?' selected':'';?>>颜色</option>
                <option value="2"<?php if (isset($info['type'])) echo $info['type']==2?' selected':'';?>>文本型</option>
                <!-- <option value="3"<?php //echo $info['type']==3?' selected':'';?>>数字型</option> -->
              </select>
          </td>
          <td class="vatop tips"></td>
        </tr>
        
        <tr>
            <td colspan="2" class="required"><label for="status">状态:</label></td>
        </tr>
        <tr class="noborder">
          <td align="left" class="padL5" colspan="2">
              <input type="radio" name="status" checked="" value="1" <?php if( !empty($info['status']) && $info['status']==1 ) echo ' checked' ?> />开启
              <input type="radio" name="status" value="2" <?php if( !empty($info['status']) && $info['status']==2 ) echo ' checked' ?> />不开启
            </td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15"><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo lang('nc_submit');?></span></a></td>
        </tr>
      </tfoot>
    </table>
</div>
<script type="text/javascript">
$(function(){
    //按钮先执行验证再提交表单
    $("#submitBtn").click(function(){
        if($("#form1").valid()){
            $("#form1").submit();
        }
    });

    $('#form1').validate({
        errorPlacement: function(error, element){
            error.appendTo(element.parentsUntil('tr').parent().prev().find('td:first'));
        },
        rules : {
            name: {
                required : true,
                   },
            vals:{
                required:true,
            }
        },
        messages : {
            name: {
                required: '请输入店铺名称',
            },
            vals:{
                required: '请输入规格值！',
            }
        }
    });
});
</script>

</body>
</html>