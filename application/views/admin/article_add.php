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
<?php echo _get_html_cssjs('lib','kindeditor/kindeditor-min.js,kindeditor/lang/zh_CN.js','js');?>

</head>
<body>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo lang('article_index_manage');?></h3>
      <ul class="tab-base">
        <li><a href="<?php echo ADMIN_SITE_URL.'/article'?>"><span><?php echo lang('nc_manage');?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span><?php if (!empty($info))echo lang('nc_edit');else echo lang('nc_new');?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="article_form" method="post" name="articleForm" action="<?php echo ADMIN_SITE_URL.'/article/save'?>" onsubmit="return doValid();">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="id" value="<?php if (!empty($info['id'])) echo $info['id'];?>" />
    <table class="table tb-type2 nobdb">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation"><?php echo lang('article_index_title');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if (!empty($info)){echo $info['title'];}?>" name="article_title" id="article_title" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="cate_id"><?php echo lang('article_add_class');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><select name="ac_id" id="ac_id">
              <option value=""><?php echo lang('nc_please_choose');?>...</option>
              <?php if(!empty($class_list) && is_array($class_list)){ ?>
              <?php foreach($class_list as $k => $v){ ?>
              <?php if ($v['parent_id'] == 0){?>
              <option  <?php if(!empty($info)){ if ($info['class_id_1'] == null){$id = $info['class_id'];}else{$id = $info['class_id_1'];}if ($id == $v['id']) echo 'selected="selected"';}?> value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
              <?php if (isset($child_list[$v['id']])){?>
              <?php foreach($child_list[$v['id']] as $key => $value){ ?>
              <option <?php if(!empty($info)){ if ($info['class_id_1'] == null){$id = $info['class_id'];}else{$id = $info['class_id_1'];}if ($id == $value) echo 'selected="selected"';}?> value="<?php echo $class_list[$value]['id']?>"><?php echo '　　'.$class_list[$value]['name']?></option>
              <?php }?>
              <?php }?>
              <?php }?>
              <?php } ?>
              <?php } ?>
            </select></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label><?php echo lang('article_add_show');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff"><label for="article_show1" class="cb-enable <?php if(!empty($info) && $info['status'] == 1){?>selected<?php }if (empty($info)){?>selected<?php }?>" ><span><?php echo lang('nc_yes');?></span></label>
            <label for="article_show0" class="cb-disable <?php if(!empty($info) && $info['status'] == 0){?>selected<?php }?>" ><span><?php echo lang('nc_no');?></span></label>
            <input id="article_show1" name="article_show" <?php if(!empty($info) && $info['status'] == 1){?>checked="checked"<?php }if (empty($info)){?>checked="checked"<?php }?> value="1" type="radio">
            <input id="article_show0" name="article_show" <?php if(!empty($info) && $info['status'] == 0){?>checked="checked"<?php }?> value="0" type="radio"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo lang('nc_sort');?>: 
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if (!empty($info)){echo $info['sort'];}else {echo '255';}?>" name="article_sort" id="article_sort" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation"><?php echo lang('article_add_content');?>:</label></td>
        </tr>
        <tr class="noborder">
              <td class="vatop rowform">
                <textarea name="article_content" rows="6" class="tarea"><?php if (!empty($info)){echo $info['content'];}?></textarea>
              </td>
              <td class="vatop tips"></td>
            </tr>
         <tr> 
          <td colspan="2" class="required"><?php echo lang('article_add_upload');?>:</td>
         </tr> 
         <tr class="noborder">
          <td class="vatop rowform">
            <div class="upload_block">
              <span class="type-file-show"><img class="show_image" src="<?php echo _get_cfg_path('admin_images');?>preview.png">
                <div class="type-file-preview"><img id="preview_pic" src="<?php if (!empty($info['pic'])){echo BASE_SITE_URL.'/'.$info['pic'];}?>" onload="javascript:DrawImage(this,500,500);"></div>
              </span>
              <div class="f_note">
                  <input type="hidden"  name="pic" id="pic" value="">
                  <em><i class="icoPro16"></i></em>
                  <div class="file_but">
                      <input type="hidden" name="orig_pic" value="<?php if (!empty($info['pic'])){echo $info['pic'];}?>"><input id="pic_upload" name="pic_upload" value="<?php echo lang('adv_upload_img')?>" type="file" >
                  </div>
              </div>
            </div>
          </td>
          <td class="vatop tips"><?php echo lang('adv_edit_support');?>gif,jpg,jpeg,png</td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15" ><input class="btn" type="submit" id="submitBtn" value="<?php echo lang('nc_submit');?>"></td>
        </tr>
      </tfoot>
    </table>
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

    getKindEditor_small('textarea[name="article_content"]');

});
</script>

<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#doc_form").valid()){
     $("#doc_form").submit();
	}
	});
});

function doValid()
{
  if($("#doc_form").valid()) 
    return true;
  else
    return false;
};
//
$(document).ready(function(){
	$('#article_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        rules : {
            article_title : {
                required   : true
            },
			ac_id : {
                required   : true
            },
            article_sort : {
                number   : true
            }
        },
        messages : {
            article_title : {
                required   : '<?php echo lang('article_add_title_null');?>'
            },
			ac_id : {
                required   : '<?php echo lang('article_add_class_null');?>'
            },
            article_sort  : {
                number   : '<?php echo lang('article_add_sort_int');?>'
            }
        }
    });
});
</script>

<script src="<?php echo _get_cfg_path('lib')?>uploadify/jquery.uploadify.min.js" type="text/javascript"></script>

<script type="text/javascript">
<?php $timestamp = time();?>
$(function() {
  upload_file('pic','pic','<?php echo $timestamp?>','<?php echo md5($this->config->item('encryption_key') . $timestamp );?>');
});
</script>
</body>
</html>