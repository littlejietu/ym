
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>big city</title>
<?php echo _get_html_cssjs('admin_js','jquery.js,jquery.validation.min.js,admincp.js,jquery.cookie.js,common.js','js');?>
<link href="<?php echo _get_cfg_path('admin').TPL_ADMIN_NAME;?>css/skin_0.css" type="text/css" rel="stylesheet" id="cssfile" />
<?php echo _get_html_cssjs('admin_css','perfect-scrollbar.min.css','css');?>
<?php echo _get_html_cssjs('admin_js','uploadify/uploadify.css','css');?>

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
      <h3><?php echo lang('data_output');?></h3>
      <ul class="tab-base">
      <li><a href="<?php echo ADMIN_SITE_URL.'/excel/export_all';?>"><span><?php echo lang('export_all');?></span></a></li>
      <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('export_by_shop');?></span></a></li>
      <li><a href="<?php echo ADMIN_SITE_URL.'/excel/export_by_area';?>"><span><?php echo lang('export_by_area');?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th class="nobg" colspan="12"><div class="title"><h5><?php echo lang('nc_prompts');?></h5><span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
        <ul>
            <li><?php echo lang('tips');?></li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form id="adv_form" method="post" action="<?php echo ADMIN_SITE_URL.'/excel/export_excel_shop'?>">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="action" value="shop" />
    <table class="table tb-type2" id="main_table">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="seller_username"><?php echo lang('seller_username');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="seller_username" id="seller_username" class="txt" value=""></td>
          <td class="vatop tips"></td>
        </tr>
      </tbody>

       <tr>
          <td colspan="2" class="required"><label class="validation" for="start_time"><?php echo lang('start_time');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="start_time" id="start_time" class="txt date"></td>
          <td class="vatop tips"></td>
         </tr> 
         <tr>
          <td colspan="2" class="required"><label class="validation" for="end_time"><?php echo lang('end_time');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="end_time" id="end_time" class="txt date"></td>
          <td class="vatop tips"></td>
         </tr> 
         <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><?php echo lang('field_name');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="field_name" id="field_name" class="txt" value=""></td>
          <td class="vatop tips"></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15" ><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo lang('export');?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<?php echo _get_html_cssjs('lib','jquery-ui/themes/ui-lightness/jquery.ui.css','css');?>
<?php echo _get_html_cssjs('lib','jquery-ui/jquery.ui.js','js');?>
<script type="text/javascript">
$(function(){
    $('#start_time').datepicker({dateFormat: 'yy-mm-dd'});
    $('#end_time').datepicker({dateFormat: 'yy-mm-dd'});

});
</script>
<script type="text/javascript">
$(function(){
    //按钮先执行验证再提交表单
    $("#submitBtn").click(function(){
        if($("#adv_form").valid()){
            $("#adv_form").submit();
        }
    });

    $('#adv_form').validate({
        errorPlacement: function(error, element){
            error.appendTo(element.parentsUntil('tr').parent().prev().find('td:first'));
        },
        rules : {
        	seller_username:{
                required:true,
                remote:{
                    url:'<?php echo ADMIN_SITE_URL.'/excel/repeat_seller_username'?>',
                    type:'get',
                    data:{
                        user_id:function(){
                            return '<?php if (!empty($info['seller_userid'])){ echo $info['seller_userid'];}else{echo 0;}?>';
                        },
                        seller_username:function(){
                            return $('#seller_username').val();
                        }
                    }
                }
            },
            start_time: {
                required : true,
            },
            end_time: {
                required : true,
            },
        },
        messages : {
            seller_username: {
                required : '请输入店家用户名',
                remote : '卖家不存在',
            },
        	start_time: {
                required: '请选择开始日期',
            },
            end_time: {
                required: '请选择截止日期',
            },
        }
    });
});
</script>
</body>
</html>