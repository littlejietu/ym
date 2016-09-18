
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
<script src="/res/seller/js/area_array.js"></script>
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
      <li><a href="<?php echo ADMIN_SITE_URL.'/excel/export_by_shop';?>"><span><?php echo lang('export_by_shop');?></span></a></li>
      <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('export_by_area');?></span></a></li>
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
  <form id="adv_form" method="post" action="<?php echo ADMIN_SITE_URL.'/excel/export_excel_area'?>">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="action" value="area" />
    <table class="table tb-type2" id="main_table">
    <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="province_id">省份:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
              <select id="province_id" name="province_id"></select>
          </td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="city_id">城市:</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
                <select id="city_id" name="city_id"></select>
            </td>
            <td class="vatop tips"></td>
        </tr>

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
        	province_id: {
                required : true,
            },
            city_id: {
                required : true,
            },
            start_time: {
                required : true,
                   },
            end_time: {
                required : true,
            },
        },
        messages : {
        	province_id: {
                required : '请选择要导出报表的地区',
            },
            city_id: {
            	required : '请选择要导出报表的地区',
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
<script>

/**地区加载省份*/
$(function(){
  var province_list = nc_a[0];
    $("#province_id").html("");
    $('#province_id').append('<option value="">请选择</option>');
    for(var i=0;i < province_list.length;i++){
        $("#province_id").append('<option value="'+province_list[i][0]+'">'+province_list[i][1]+'</option>');
    }


    //市
    $("#province_id").change(function(){
        var province_id = $("#province_id").val();
        city(province_id);
        $("#area_id").html("");
    });

    //县
    $("#city_id").change(function(){
        var city_id = $("#city_id").val();
        area(city_id);
    });

    var hid_province_id = $("#hid_province_id").val();
    var hid_city_id     = $("#hid_city_id").val();
    var hid_area_id     = $("#hid_area_id").val();

    if(!!hid_province_id){
        city(hid_province_id);
        $("#province_id").find("option[value='"+hid_province_id+"']").attr("selected",true);
    }

    if(!!hid_city_id){
        area(hid_city_id);
        $("#city_id").find("option[value='"+hid_city_id+"']").attr("selected",true);
    }

    if(!!hid_area_id){
        $("#area_id").find("option[value='"+hid_area_id+"']").attr("selected",true);
    }

    //市
    function city(province_id){
        var city_list = nc_a[province_id];
        $("#city_id").html("");
        $("#city_id").append('<option value="">请选择</option>');
        for(var i=0;i < city_list.length;i++){
            $("#city_id").append('<option value="'+city_list[i][0]+'">'+city_list[i][1]+'</option>');
        }
    }

    //县
    function area(city_id){
        var area_list = nc_a[city_id];
        $("#area_id").html("");
        for(var i=0;i < area_list.length;i++){
            $("#area_id").append('<option value="'+area_list[i][0]+'">'+area_list[i][1]+'</option>');
        }
    }

});
</script>

</body>
</html>