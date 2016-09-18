<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>big city</title>
<?php echo _get_html_cssjs('admin_js','jquery.js,jquery.validation.min.js,admincp.js,jquery.cookie.js,common.js','js');?>
<script src="/res/seller/js/area_array.js"></script>
<link href="<?php echo _get_cfg_path('admin').TPL_ADMIN_NAME;?>css/skin_0.css" type="text/css" rel="stylesheet" id="cssfile" />
<?php echo _get_html_cssjs('admin_css','perfect-scrollbar.min.css','css');?>
<?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome.min.css','css');?>
<?php echo _get_html_cssjs('lib','uploadify/uploadify.css','css');?>

<!--[if IE 7]>
  <?php //echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome-ie7.min.css','css');?>
<![endif]-->
<?php echo _get_html_cssjs('admin_js','perfect-scrollbar.min.js','js');?>

</head>
<body>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>自营店铺</h3>
      <ul class="tab-base">
        <li><a href="<?php echo ADMIN_SITE_URL.'/shop/';?>"><span>管理</span></a></li>
        <li><a class="current" href="<?php echo ADMIN_SITE_URL.'/shop/add';?>"><span>新增</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title">
            <h5><?php echo lang('nc_prompts');?></h5>
            <span class="arrow"></span></div>
        </th>
      </tr>
      <tr>
        <td><ul>
            <li>平台可以在此处添加自营店铺</li>
            <li>新增自营店铺将自动创建店主会员账号（用于登录网站会员中心）</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form id="form1" method="post" action="<?php echo ADMIN_SITE_URL.'/shop/save'?>">
    <input type="hidden" name="form_submit" value="ok" />
   
    <input type="hidden" name="id" value="<?php if (isset($info['id'])){ echo $info['id'];}?>" />
   
    <table class="table tb-type2">
      <tbody>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="name">店铺名:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if (isset($info['name'])){ echo $info['name'];}?>" id="name" name="name" class="txt" /></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required">
              <label class="validation" for="seller_username">店家用户名:</label>
          </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
            <?php 
            if (isset($info['seller_username'])):?>
              <input type="hidden" value="<?php echo $info['seller_username']?>" id="seller_username" name="seller_username" class="txt" />
              <?php echo $info['seller_username']?>
           <?php else:?>
              <input type="text" value="" id="seller_username" name="seller_username" class="txt" />
            <?php endif?>
          </td>
          <td class="vatop tips"></td>
        </tr>
        <?php if(!isset($info['seller_username'])):?>
        <tr class="noborder">
            <td colspan="2" class="required">
                <label class="validation" for="seller_username">用户密码:</label>
            </td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
                <input type="password" value="" id="seller_pwd" name="seller_pwd" class="txt" />
            </td>
            <td class="vatop tips"></td>
        </tr>
      <?php endif?>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="province_id">省份id:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
              <select id="province_id" name="province_id"></select>
          </td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="city_id">城市id:</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
                <select id="city_id" name="city_id"></select>
            </td>
            <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="area_id">街区id:</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
                <select id="area_id" name="area_id"></select>
            </td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
            <td colspan="2" class="required"><label class="" for="area_id">详细地址:</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
              <input type="text" name="address" class="txt" value="<?php if (!empty($info['address'])){ echo $info['address'];}?>" />
            </td>
            <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="lng">经度:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if (isset($info['lng'])){ echo $info['lng'];}?>" id="lng" name="lng" class="txt" /></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="lat">纬度:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if (isset($info['lat'])){ echo $info['lat'];}?>" id="lat" name="lat" class="txt" /></td>
          <td class="vatop tips"></td>
        </tr>
        <!-- <tr>
            <td colspan="2" class="required"><label for="is_own">是否自营店:</label></td>
        </tr>
        <tr class="noborder">
          <td align="left" class="padL5" colspan="2">
              <input type="radio" name="is_own" checked="" value="1" <?php //if( !empty($info['is_own']) && $info['is_own']==1 ) echo ' checked' ?> />是
              <input type="radio" name="is_own" value="0" <?php //if( !empty($info['is_own']) && $info['is_own']==0 ) echo ' checked' ?> />否
            </td>
        </tr> -->
        <tr>
            <td colspan="2" class="required"><label for="status">状态:</label></td>
        </tr>
        <tr class="noborder">
          <td align="left" class="padL5" colspan="2">
              <input type="radio" name="status" checked="" value="1" <?php if( !empty($info['status']) && $info['status']==1 ) echo ' checked' ?> />开启
              <input type="radio" name="status" value="2" <?php if( !empty($info['status']) && $info['status']==2 ) echo ' checked' ?> />不开启
            </td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15"><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo lang('nc_submit');?></span></a></td>
        </tr>
      </tfoot>
    </table>
      <input type="hidden" id="hid_province_id" value="<?php if (!empty($info['province_id'])){ echo $info['province_id'];}?>" />
      <input type="hidden" id="hid_city_id" value="<?php if (!empty($info['city_id'])){ echo $info['city_id'];}?>" />
      <input type="hidden" id="hid_area_id" value="<?php if (!empty($info['area_id'])){ echo $info['area_id'];}?>" />
  </form>
</div>
<script type="text/javascript">
$(function(){
    //按钮先执行验证再提交表单
    $("#submitBtn").click(function(){
        if($("#form1").valid()){
            $("#form1").submit();
        }
    });

    $('#form1').validate({
        errorPlacement: function(error, element){
            error.appendTo(element.parentsUntil('tr').parent().prev().find('td:first'));
        },
        rules : {
            name: {
                required : true,
                   },
            seller_username:{
                required:true,
                remote:{
                    url:'<?php echo ADMIN_SITE_URL.'/Shop/repeat_seller_username'?>',
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
            seller_pwd:{
                required:true,
            }
        },
        messages : {
            name: {
                required: '请输入店铺名称',
            },
            seller_username: {
                required : '请输入店家用户名',
                remote : '用户名被占用',
            },
            seller_pwd:{
                required: '请输入密码！',
            }
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