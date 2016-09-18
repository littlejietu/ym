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
      <h3>会员通知</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>发送通知</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="notice_form" method="POST" action="<?php echo ADMIN_SITE_URL.'/message/send_save'?>">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <tbody>
        <tr>
            <td colspan="2" class="required">消息类型:</td>
       </tr>
        <tr class="noborder">
          <td align="left" class="padL5" colspan="2">
              <input type="radio" checked="" value="1" name="type">通知消息
              <input type="radio"  value="2" name="type">交易消息
              <input type="radio"  value="3" name="type">物流消息
            </td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label>发送类型: </label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><ul class="nofloat">
              <li>
                <label><input type="radio" checked="" value="1" name="send_type">指定会员</label>
              </li>
              <li>
                <label><input type="radio" value="2" name="send_type" />全部会员</label>
              </li>
            </ul>
          </td>
          <td class="vatop tips"></td>
        </tr>
      </tbody>
      <tbody id="user_list">
        <tr>
          <td colspan="2" class="required"><label class="validation" for="user_name">会员列表: </label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea id="user_name" name="user_name" rows="6" class="tarea" ><?php echo !empty($user_name)?$user_name:''?><?php //echo base64_decode(str_replace(' ','+',$_GET['member_name'])); ?></textarea></td>
          <td class="vatop tips"><?php echo lang('notice_index_member_tip');?></td>
        </tr>
      </tbody>
      
      <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="link_title">消息标题:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if (isset($_GET['id'])){ echo $info['title'];}?>" name="title" id="message_title" class="txt"></td>
        </tr>


      <tbody id="msg">
        <tr>
          <td colspan="2" class="required"><label class="validation">通知内容: </label></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="vatop rowform"><textarea name="content1" rows="6" class="tarea"></textarea></td>
        </tr>
      </tbody>
      <!-- <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="link_action_title">跳转按钮名:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php //if (isset($_GET['id'])){ echo $info['action_title'];}?>" name="action_title" id="message_action_title" class="txt"></td>
        </tr> -->
        <!-- <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="link_web_url">跳转网址:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php //if (isset($_GET['id'])){ echo $info['web_url'];}else{echo 'http://';}?>" name="web_url" id="message_web_url" class="txt"></td>
        </tr> -->
        <!-- <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="link_app_url">app跳转:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php //if (isset($_GET['id'])){ echo $info['app_url'];}?>" name="app_url" id="message_app_url" class="txt"></td>
        </tr> -->
         <tr>
            <td colspan="2" class="required">是否推送:</td>
       </tr>
        <tr class="noborder">
          <td align="left" class="padL5" colspan="2">
              <input type="radio" name="is_push" value="1" <?php if( !empty($info['is_push']) && $info['is_push']==1 ) echo ' checked' ?> />是
            <input type="radio" name="is_push" value="2" <?php if( !empty($info['is_push']) && $info['is_push']==2 ) echo ' checked' ?> />否
            </td>
        </tr>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15"><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo lang('nc_submit');?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#notice_form").valid()){
        $("#notice_form").submit();
  }
  });
});
$(document).ready(function(){
  $('#notice_form').validate({
        errorPlacement: function(error, element){
      error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        rules : {
            user_name : {
                required : check_user_name
            },
            title :{
              required : true
            },
            content1 :{
              required : true
            }
        },
        messages : {
            user_name :{
                required     : '<?php echo lang('notice_index_member_error');?>'
            },
            title :{
              required : '<?php echo lang('notice_index_title_null'); ?>'
            },
            content1 :{
              required : '<?php echo lang('notice_index_content_null'); ?>'
            }
        },
    submitHandler: function(form) {
      form.submit();
    }
    });
    function check_user_name()
    {
        var rs = $(":input[name='send_type']:checked").val();
        return rs == 1 ? true : false;
    }

    $("input[name='send_type']").click(function(){
        var rs = $(this).val();
        switch(rs)
        {
            case '1':
                $('#user_list').show();
                break;
            case '2':
                $('#user_list').hide();
                break;
        }
    });
});
</script>




</body>
</html>
