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
<?php echo _get_html_cssjs('lib','kindeditor/kindeditor-min.js,kindeditor/lang/zh_CN.js','js');?>
</head>
<body>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo lang('document_index_document');?></h3>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="doc_form" method="post" action="<?php echo ADMIN_SITE_URL.'/document/save';?>" onsubmit="return doValid();">
    <input type="hidden" name="id" value="<?php if (isset($info['id']))echo $info['id']?>" />
    <table class="table tb-type2 nobdb">
      <tbody>
        <tr>
          <td colspan="2" class="required"><label class="validation"><?php echo lang('document_index_title');?>: </label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if (isset($info['title']))echo $info['title']?>" name="title" id="doc_title" class="infoTableInput"></td>
          <td class="vatop tips"></td>
        </tr>
        </tbody>
        
        <tbody>
        <tr>
          <td colspan="2" class="required"><label class="validation"><?php echo lang('document_code');?>: </label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if (isset($info['code']))echo $info['code']?>" name="code" id="code" class="infoTableInput"></td>
          <td class="vatop tips"></td>
        </tr>
        </tbody>
        
        <tbody>
        <tr>
          <td colspan="2" class="required"><label ><?php echo lang('document_index_content');?>: </label></td>
        </tr>
        <tr class="noborder">
              <td class="vatop rowform">
                <textarea name="message_content" rows="6" class="tarea"><?php if (isset($info['content']))echo $info['content']?></textarea>
              </td>
              <td class="vatop tips"></td>
            </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
        </tr>
      </tfoot>
    </table>
    <td colspan="15" ><input class="btn" type="submit" id="submitBtn" value="<?php echo lang('nc_submit');?>"></td>
  </form>
</div>
<script>
$(function(){
    $('div[nctype="sellerTplContent"] > ul').find('li').click(function(){
        $(this).addClass('current').siblings().removeClass('current');
        var _index = $(this).index();
        var _div = $('div[nctype="sellerTplContent"]').find('div[class="tab-content"]');
        _div.hide();
        _div.eq(_index).show();

        $('.ke-container').width("650px");
    });

    getKindEditor_small('textarea[name="message_content"]');

});
</script>

<script>
//按钮先执行验证再提交表单
// $(function(){$("#submitBtn").click(function(){
//     if($("#doc_form").valid()){
//      $("#doc_form").submit();
// 	}
// 	});
// });
//

function doValid()
{
  if($("#doc_form").valid()) 
    return true;
  else
    return false;
};

$(document).ready(function(){
	$('#doc_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        rules : {
            title : {
                required   : true
            },
            code : {
                required   : true
            },
		
        },
        messages : {
            title : {
                required   : '<?php echo lang('document_index_title_null');?>'
            },
            code : {
                required   : '<?php echo lang('document_index_null');?>'
            },
			  
        }
    });
});

</script>

</body>
</html>
