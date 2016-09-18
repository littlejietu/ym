
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
      <h3><?php echo lang('adv_index_manage');?></h3>
      <ul class="tab-base">
        <li><a href="<?php echo ADMIN_SITE_URL.'/first_place';?>"><span><?php echo lang('ap_manage');?></span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/first';?>"><span><?php echo lang('adv_manage');?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span><?php  if (isset($_GET['id'])){echo lang('adv_edit');}else{echo lang('adv_add');}?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="adv_form" method="post" action="<?php echo ADMIN_SITE_URL.'/first/save'?>">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="list_url" value="<?php echo $list_url;?>" />
    <?php  if (isset($_GET['id'])){?>
    <input type="hidden" name="id" value="<?php echo $_GET['id']?>" />
    <?php }?>
    <table class="table tb-type2" id="main_table">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="adv_name"><?php echo lang('adv_name');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="adv_name" id="adv_name" class="txt" value="<?php  if (isset($_GET['id'])){echo $info['title'];}?>"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="ap_id"><?php echo lang('adv_ap_select');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
            <select name="ap_id" id="ap_id">
              <option value="0">推首位</option>
              <?php foreach ($arrPlace as $k=>$v):?>
              <option value="<?=$v['id']?>" <?php if(!empty($info)){ if ($info['place_id'] == $v['id']) echo 'selected="selected"';}?>><?=$v['name']?></option>
              <?php endforeach?>
            </select>
          <td class="vatop tips"></td>
        </tr>
        <!-- <tr>
          <td colspan="2" class="required"><label class="validation" for="adv_start_time"><?php //echo lang('adv_start_time');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php //if (isset($_GET['id'])){ echo $info['effect_time'];}?>" name="effect_time" id="effect_time" class="txt date"></td>
          <td class="vatop tips"></td>
        </tr> -->
        <!-- <tr>
          <td colspan="2" class="required"><label class="validation" for="adv_end_time"><?php //echo lang('adv_end_time');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php  //if (isset($_GET['id'])){echo $info['expire_time'];}?>" name="expire_time" id="expire_time" class="txt date"></td>
          <td class="vatop tips"></td>
        </tr> -->
      </tbody>
      <tbody id="adv_pic">
        <tr>
          <td colspan="2" class="required"><label for="file_adv_pic"><?php echo lang('adv_img_upload');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
            <div class="upload_block">
              <span class="type-file-show"><img class="show_image" src="<?php echo _get_cfg_path('admin_images');?>preview.png">
                <div class="type-file-preview"><img id="preview_img" src="<?php if (!empty($info['pic'])) echo BASE_SITE_URL.'/'.$info['pic'];?>" onload="javascript:DrawImage(this,500,500);"></div>
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
          <td class="vatop tips"><?php echo lang('adv_edit_support');?>gif,jpg,jpeg,png</td>
        </tr>
      </tbody>
      <!-- <tbody id="adv_content">
        <tr>
          <td colspan="2" class="required"><label for="type_content"><?php //echo lang('adv_content');?>: </label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform" colspan="2"><textarea  name="content" style="height: 140px;width:300px;"><?php  //if (isset($_GET['id'])){echo $info['content'];//}?></textarea>
        </tr>
      </tbody> -->
      <!-- <tbody id="adv_memo">
        <tr>
          <td colspan="2" class="required"><label for="type_content"><?php //echo lang('ap_memo');?>: </label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform" colspan="2"><textarea name="memo" style="height: 40px;width:300px;"><?php // if (isset($_GET['id'])){echo $info['memo'];//}?></textarea>
        </tr>
      </tbody> -->
      <tbody id="adv_sort">
        <tr>
          <td colspan="2" class="required"><label for="type_content"><?php echo lang('adv_slide_sort');?>: </label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform" colspan="2"><input type="text" name="sort" value="<?php  if (isset($_GET['id'])){ echo $info['sort'];}?>" />
        </tr>
      </tbody>
      <tbody id="adv_url" >
        <tr>
          <td colspan="2" class="required"><label for="type_adv_url"><?php echo lang('adv_url');?>: </label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
            <select name="adv_path" id="select_id">
            <option value="">请选择</option>
              <option value="zooer://search?keyword={category_name}&category_id={category_id}">分类搜索</option>
              <option value="zooer://webview?url={url}">跳转wap页</option>
              <option value="zooer://productdetail?tpl_id={tpl_id}">商品详情</option>
            </select>
            <input type="text" name="adv_url" class="txt" id="type_adv_pic_url" value="<?php if (!empty($info['url'])) echo $info['url']?>" style="margin-top:5px;width:450px"></td>
          <td class="vatop tips">首先上方选择跳转的类型，然后将下面链接里 { } 中的内容连同 { } 替换掉</td>
        </tr>
      </tbody>
     <tbody id="title_status">
        <tr>
          <td colspan="2" class="required"><label for="status">推首状态: </label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="radio" name="status"  id="type_status" value="1" <?php if (isset($info['status']) && $info['status'] == 1){?>checked="checked"<?php }?>>启用　<input type="radio" name="status"  id="type_status" value="0" <?php if (isset($info['status']) && $info['status'] == 0){?>checked="checked"<?php }?>>禁用</td>
          <td class="vatop tips"></td>
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
<?php echo _get_html_cssjs('lib','jquery-ui/themes/ui-lightness/jquery.ui.css','css');?>
<?php echo _get_html_cssjs('lib','jquery-ui/jquery.ui.js','js');?>
<script type="text/javascript">
$(function(){
    $('#effect_time').datepicker({dateFormat: 'yy-mm-dd'});
    $('#expire_time').datepicker({dateFormat: 'yy-mm-dd'});


    // $('#ap_id').change(function(){
    // 	var select   = document.getElementById("ap_id");
    // });
});
</script>
<script>
$(function(){
	$("#select_id").change(function(){
		//alert(222);
		var text=$("#select_id").find("option:selected").val();
	    $("#type_adv_pic_url").val(text);
	});
	
 
});
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
        	adv_name : {
                required : true
            },
            adv_url : {
                required : true
            }
            /*content : {
                required : true
            }*/
            /*memo : {
                required : true
            }*/
            /*effect_time  : {
                required : true,
                date	 : false
            },*/
            /*expire_time  : {
            	required : true,
                date	 : false
            }*/
        },
        messages : {
        	adv_name : {
                required : '<?php echo lang('adv_can_not_null');?>'
            },
            adv_url : {
                required : '<?php echo lang('adv_url_can_not_null');?>'
            }
            /*content : {
                required : '<?php //echo lang('textadv_null_error');?>'
            }*/
           /* memo : {
                required : '<?php //echo lang('textadv_null_error');?>'
            }*/
            /*effect_time  : {
                required : '<?php //echo lang('adv_start_time_can_not_null'); ?>'
            },*/
            /*expire_time  : {
            	required   : '<?php //echo lang('adv_end_time_can_not_null'); ?>'
            }*/
        }
    });
});
</script>

<script src="<?php echo _get_cfg_path('lib')?>uploadify/jquery.uploadify.min.js" type="text/javascript"></script>

<script type="text/javascript">
<?php $timestamp = time();?>
$(function() {
  upload_file('img','img','<?php echo $timestamp?>','<?php echo md5($this->config->item('encryption_key') . $timestamp );?>');
});
</script>


</body>
</html>