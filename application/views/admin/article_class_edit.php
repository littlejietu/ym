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
      <h3><?php echo lang('article_class_index_class');?></h3>
      <ul class="tab-base">
        <li><a href="<?php echo ADMIN_SITE_URL.'/article_class'?>"><span><?php echo lang('nc_manage');?></span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/article_class/add'?>"><span><?php echo lang('nc_new');?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('nc_edit');?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="article_class_form" method="post" name="articleClassForm">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="ac_id" value="<?php echo $info['id']?>" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="ac_name"><?php echo lang('article_class_index_name');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $info['name'];?>" name="ac_name" id="ac_name" class="txt"></td>
          <td class="vatop tips"><?php echo lang('article_class_index_name');?></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="ac_sort"><?php echo lang('nc_sort');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $info['sort'];?>" name="ac_sort" id="ac_sort" class="txt"></td>
          <td class="vatop tips"><?php echo lang('article_class_add_update_sort');?></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15" ><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo lang('nc_submit');?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#article_class_form").valid()){
     $("#article_class_form").submit();
	}
	});
});
//
$(document).ready(function(){
	$('#article_class_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        rules : {
            ac_name : {
                required : true,
                remote   : {
                url :'<?php echo ADMIN_SITE_URL.'/article_class/ajax?branch=check_class_name'?>',
                type:'get',
                data:{
                    ac_name : function(){
                        return $('#ac_name').val();
                    },
                    ac_parent_id : function() {
                        return $('#ac_parent_id').val();
                    },
                    ac_id : '<?php echo $info['id'];?>'
                  }
                }
            },
            ac_sort : {
                number   : true
            }
        },
        messages : {
            ac_name : {
                required : '<?php echo lang('article_class_add_name_null');?>',
                remote   : '<?php echo lang('article_class_add_name_exists');?>'
            },
            ac_sort  : {
                number   : '<?php echo lang('article_class_add_sort_int');?>'
            }
        }
    });
});
</script>
</body>
</html>