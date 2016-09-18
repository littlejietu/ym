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
      <h3><?php echo lang('adv_index_manage');?></h3>
      <ul class="tab-base">
        <li><a href="<?php echo ADMIN_SITE_URL.'/first_place';?>"><span><?php echo lang('ap_manage');?></span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/first';?>"><span><?php echo lang('adv_manage');?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current">
        <span><?php 
        if (isset($_GET['id'])){
            echo lang('nc_edit');
        }else{
        echo lang('ap_add');
        }?></span></a><em></em></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  
  <form action="<?php echo ADMIN_SITE_URL.'/first_place/save'?>" method="post">
  <input type="hidden" name="list_url" value="<?php echo $list_url;?>">
  <table class="table tb-type2">
   <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="ap_name"><?php echo lang('ap_name');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="name" id="name" class="txt" <?php if(!empty($info)) echo 'value="'.$info['name'].'"'?>>
            </td>
          <td class="vatop tips"></td>
        </tr>
      </tbody>
      <tbody id="ap_memo">
        <tr>
          <td colspan="2" class="required"><label class="validation" for="ap_width_media_input"><?php echo lang('ap_memo');?>:</label></td>
        </tr>
        <tr class="noborder" style="height: 150px;">
          <td class="vatop rowform"><textarea name="memo" style="height: 140px;" ><?php if(!empty($info)) echo $info['memo'];?></textarea></td>
        </tr>
        </tbody>
        <tr class="tfoot">
        <td><?php if (isset($_GET['id'])){?>
        <input type="hidden" name="id" value=<?php echo $_GET['id']?>>
        <?php }?>
        <input type="submit" /></td>
        </tr>
      </table>
  </form>

</div>
<script type="text/javascript">
$(function(){
	$("#ap_width_word").hide();
	$("#default_word").hide();
	$("#ap_class").change(function(){
	if($("#ap_class").val() == '1'){
		$("#ap_height").hide();
		$("#ap_width_media").hide();
		$("#default_pic").hide();
		$("#default_word").show();
		$("#ap_width_word").show();
		$("#ap_display").show();
	}else if($("#ap_class").val() == '0'||$("#ap_class").val() == '3'){
		$("#ap_height").show();
		$("#ap_width_media").show();
		$("#default_pic").show();
		$("#default_word").hide();
		$("#ap_width_word").hide();
		$("#ap_display").show();
	}
  });
});
</script>
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
     $("#link_form").submit();
	});
});
//
$(document).ready(function(){

	$('#link_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        rules : {
        	ap_name : {
                required : true
            },
			ap_width_media:{
				required :function(){return $("#ap_class").val()!=1;},
				digits	 :true,
				min:1
			},
			ap_height:{
				required :function(){return $("#ap_class").val()!=1;},
				digits	 :true,
				min:1
			},
			ap_width_word :{
				required :function(){return $("#ap_class").val()==1;},
				digits	 :true,
				min:1
			},
			default_word  :{
				required :function(){return $("#ap_class").val()==1;}
			},
			change_default_pic:{
				required :true
			}
        },
        messages : {
        	ap_name : {
                required : '<?php echo lang('ap_can_not_null'); ?>'
            },
            ap_width_media	:{
            	required   : '<?php echo lang('ap_input_digits_pixel'); ?>',
            	digits	:'<?php echo lang('ap_input_digits_pixel');?>',
            	min	:'<?php echo lang('ap_input_digits_pixel');?>'
            },
            ap_height	:{
            	required   : '<?php echo lang('ap_input_digits_pixel'); ?>',
            	digits	:'<?php echo lang('ap_input_digits_pixel');?>',
            	min	:'<?php echo lang('ap_input_digits_pixel');?>'
            },
            ap_width_word	:{
            	required   : '<?php echo lang('ap_input_digits_pixel'); ?>',
            	digits	:'<?php echo lang('ap_input_digits_pixel');?>',
            	min	:'<?php echo lang('ap_input_digits_pixel');?>'
            },
            default_word	:{
            	required   : '<?php echo lang('ap_default_word_can_not_null'); ?>'
            }
        }
    });
});
</script>
</body>
</html>