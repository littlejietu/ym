
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
<?php echo _get_html_cssjs('lib','uploadify/uploadify.css','css');?> <!!--添加图片的样式-->

<!--[if IE 7]>
  <?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome-ie7.min.css','css');?>
<![endif]-->
<?php echo _get_html_cssjs('admin_js','perfect-scrollbar.min.js','js');?>

</head>
<body>


<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
       <h3><?php echo lang('adv_index_manage');?>添加文章分类</h3>
      <ul class="tab-base">
        
        <li><a href="<?php echo ADMIN_SITE_URL.'/article_place/';?>" ><span>列表文章<?php echo lang('adv_manage');?></span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/article_place/add';?>" class="current"><span>添加分类</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
 <form id="adv_form" method="post" action="<?php echo ADMIN_SITE_URL.'/article_place/save'?>" onsubmit="return check()">
   
    
    <input type="hidden" name="id" value="ok" />
    <?php  if (isset($_GET['id'])){?>
    <input type="hidden" name="id" value="<?php echo $_GET['id']?>" />
    <?php }?>
    <table class="table tb-type2" id="main_table">
    
    
    
    
    <!--<table class="table tb-type2 nobdb">-->
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="article_place_title">分类名称:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if (isset($_GET['id'])){ echo $info['name'];}?>" name="name" id="article_place_name" class="txt"></td>
          
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="article_place_pic">上级分类:</label></td>
        </tr>
 <!---子分类下拉列表--->      
       
       <tr class="noborder">
          <td class="vatop rowform"><select name="parent_id" id="parent_id">
              <option value="0">请选择...(默认不选添加同级分类)</option>
              <option value="1">商城公告</option>
              <option value="2">帮助中心</option>
              <option value="3">店主之家</option>
              <option value="4">支付方式</option>
              <option value="5">售后服务</option>
              <option value="6">客服中心</option>
              <option value="7">关于我们</option>
              
              
            </select></td>
          <td class="vatop tips">如果选择上级分类，那么新增的分类则为被选择上级分类的子分类</td>
          
        </tr> 
        
        
   
        
        <tr>
          <td colspan="2" class="required"><label for="article_place_sort">排序:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if (isset($_GET['id'])){ echo $info['sort'];}?>" name="sort" id="article_place_sort" class="txt"></td>
        
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="article_place_sort">状态:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if (isset($_GET['id'])){ echo $info['status'];}?>" name="status" id="article_place_sort" class="txt"></td>
          
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


<?php echo _get_html_cssjs('admin_js','zh-CN.js','js');?>
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
			error.appendTo(element.parent().parent().prev().find('td:article_place'));
        },
        rules : {
        	adv_name : {
                required : true
            },
            content : {
                required : true
            },
            memo : {
                required : true
            },
            effect_time  : {
                required : true,
                date	 : false
            },
            expire_time  : {
            	required : true,
                date	 : false
            }
        },
        messages : {
        	adv_name : {
                required : '<?php echo lang('adv_can_not_null');?>'
            },
            content : {
                required : '<?php echo lang('textadv_null_error');?>'
            },
            memo : {
                required : '<?php echo lang('textadv_null_error');?>'
            },
            effect_time  : {
                required : '<?php echo lang('adv_start_time_can_not_null'); ?>'
            },
            expire_time  : {
            	required   : '<?php echo lang('adv_end_time_can_not_null'); ?>'
            }
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
    $('#ap_id').val('<?php echo $_GET['ap_id'];?>');
    $('#ap_id').change();
});
</script>

<script>
function check()
{	/*//（1）手机号码验证11位合格数字
	var myphone =/^(((13[0-9]{1})|(14[0-9]{1})|(17[0]{1})|(15[0-3]{1})|(15[5-9]{1})|(18[0-9]{1}))+\d{8})$/;  
	//(2)用户名验证6-20字母加数字用户名
	var myuser =/^[0-9a-zA-Z]{4,21}$/;
	// 身份证号码为15位或者18位，15位时全为数字，18位前17位为数字，最后一位是校验位，可能为数字或字符X  
   var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
	var mymail = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
	if(adv_form.article_place_title.value=="")
	{
		alert('请输入链接名称!');
		return false;
	}
	else if(adv_form.article_place_url.value=="")
	{
		alert('请输入链接地址!');
		return false;
	}*/
	
}
</script>




</body>
</html>