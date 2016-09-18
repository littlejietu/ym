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
    <!-- 页面导航 -->
    <div class="fixed-bar">
        <div class="item-title">
            <h3>运单模板</h3>
            <ul class="tab-base">
                <li><a href="<?php echo ADMIN_SITE_URL.'/waybill'?>" ><span>列表</span></a></li>
                <li><a href="JavaScript:void(0);" class="current"><span>添加</span></a></li>
            </ul>
        </div>
    </div>
    <div class="fixed-empty"></div>
    <form id="add_form" method="post" action="<?php echo ADMIN_SITE_URL.'/waybill/save'?>" enctype="multipart/form-data">
        <input type="hidden" name="waybill_id" value="<?php if (!empty($info)){echo $info['id'];}?>">
        <table class="table tb-type2">
            <tbody>
                <tr class="noborder">
                    <td colspan="2" class="required"><label class="validation" for="waybill_name">模板名称</label></td>
                </tr>
                <tr class="noborder">
                    <td class="vatop rowform"><input type="text" value="<?php if (!empty($info)){echo $info['name'];}?>" name="waybill_name" id="waybill_name" class="txt"></td>
                    <td class="vatop tips">运单模板名称，最多10个字</td>
                </tr>
                <tr class="noborder">
                    <td colspan="2" class="required"><label class="validation" for="waybill_name">物流公司</label></td>
                </tr>
                <tr class="noborder">
                    <td class="vatop rowform">
                        <select name="waybill_express">
                        <?php foreach ($express_list as $key => $value){?>
                            <option value="<?php echo $value['id']?>"  ><?php echo $value['name'];?></option>
                            <?php }?>
                        </select>
                    </td>
                    <td class="vatop tips">模板对应的物流公司</td>
                </tr>
                <tr class="noborder">
                    <td colspan="2" class="required"><label class="validation" for="waybill_width">宽度</label></td>
                </tr>
                <tr class="noborder">
                    <td class="vatop rowform"><input type="text" value="<?php if (!empty($info)){echo $info['width'];}?>" name="waybill_width" id="waybill_width" class="txt"></td>
                    <td class="vatop tips">运单宽度，单位为毫米(mm)</td>
                </tr>
                <tr class="noborder">
                    <td colspan="2" class="required"><label class="validation" for="waybill_height">高度</label></td>
                </tr>
                <tr class="noborder">
                    <td class="vatop rowform"><input type="text" value="<?php if (!empty($info)){echo $info['height'];}?>" name="waybill_height" id="waybill_height" class="txt"></td>
                    <td class="vatop tips">运单高度，单位为毫米(mm)</td>
                </tr>
                <tr class="noborder">
                    <td colspan="2" class="required"><label class="validation" for="waybill_top">上偏移量</label></td>
                </tr>
                <tr class="noborder">
                    <td class="vatop rowform"><input type="text" value="<?php if (!empty($info)){echo $info['wb_top'];}?>" name="waybill_top" id="waybill_top" class="txt"></td>
                    <td class="vatop tips">运单模板上偏移量，单位为毫米(mm)</td>
                </tr>
                <tr class="noborder">
                    <td colspan="2" class="required"><label class="validation" for="waybill_left">左偏移量</label></td>
                </tr>
                <tr class="noborder">
                    <td class="vatop rowform"><input type="text" value="<?php if (!empty($info)){echo $info['wb_left'];}?>" name="waybill_left" id="waybill_left" class="txt"></td>
                    <td class="vatop tips">运单模板左偏移量，单位为毫米(mm)</td>
                </tr>
                <tr class="noborder">
                    <td colspan="2" class="required"><label class="validation" for="waybill_image">模板图片</label></td>
                </tr>
                <tr class="noborder">
                    <td class="vatop rowform">
                        <div class="upload_block">
                            <span class="type-file-show"><img class="show_image" src="<?php echo _get_cfg_path('admin_images');?>preview.png">
                                <div class="type-file-preview"><img id="preview_img" src="<?php if (!empty($info['pic'])){echo BASE_SITE_URL.'/'.$info['pic'];}?>" onload="javascript:DrawImage(this,500,500);"></div>
                            </span>
                        <div class="f_note">
                            <input type="hidden"  name="img" id="img" value="<?php if( !empty($info['img']) ) echo $info['img']; else echo ''; ?>">
                            <em><i class="icoPro16"></i></em>
                        <div class="file_but">
                            <input type="hidden" name="orig_img" value="<?php if( !empty($info['pic']) ) echo $info['pic']?>"><input id="img_upload" name="img_upload" value="<?php echo lang('adv_upload_img')?>" type="file" >
                        </div>
                        </div>
                        </div>
                    </td>
                    <td class="vatop tips"><?php echo lang('adv_edit_support');?>请上传扫描好的运单图片，图片尺寸必须与快递单实际尺寸相符</td>
                </tr>
                <tr class="noborder">
                    <td colspan="2" class="required"><label class="validation" for="waybill_image">启用</label></td>
                </tr>
                <tr class="noborder">
                    <td class="vatop rowform">
                    <input id="waybill_usable_1" type="radio" <?php if (!empty($info) && $info['status'] == 1){echo 'checked="checked"';}?> name="waybill_usable" value="1" >
                    <label for="waybill_usable_1">是</label>
                    <input id="waybill_usable_0" type="radio" <?php if (!empty($info) && $info['status'] == 2){echo 'checked="checked"';}?>name="waybill_usable" value="2" >
                    <label for="waybill_usable_0">否</label>
                    <td class="vatop tips">请首先设计并测试模板然后再启用，启用后商家可以使用</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"><a id="submit" href="javascript:void(0)" class="btn"><span><?php echo lang('nc_submit');?></span></a></td>
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
});
</script>

<script type="text/javascript">
$(document).ready(function(){
	$("#waybill_image").change(function(){
		$("#waybill_image_name").val($(this).val());
	});

    $("#submit").click(function(){
        $("#add_form").submit();
    });
    $('#add_form').validate({
        errorPlacement: function(error, element){
            error.appendTo(element.parents('tr').prev().find('td:first'));
        },
        rules : {
            waybill_name: {
                required : true,
                maxlength : 10
            },
            waybill_width: {
                required : true,
                digits: true 
            },
            waybill_height: {
                required : true,
                digits: true 
            },
            waybill_top: {
                required : true,
                number: true 
            },
            waybill_left: {
                required : true,
                number: true 
            },
            waybill_image: {
                accept: "jpg|jpeg|png"
            }
        },
        messages : {
            waybill_name: {
                required : "模板名称不能为空",
                maxlength : "模板名称最多10个字" 
            },
            waybill_width: {
                required : "宽度不能为空",
                digits: "宽度必须为数字"
            },
            waybill_height: {
                required : "高度不能为空",
                digits: "高度必须为数字"
            },
            waybill_top: {
                required : "上偏移量不能为空",
                number: "上偏移量必须为数字"
            },
            waybill_left: {
                required : "左偏移量不能为空",
                number: "左偏移量必须为数字"
            },
            waybill_image: {
                accept: '图片类型不正确' 
            }
        }
    });
});
</script>
</body>
</html>

