
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
<?php echo _get_html_cssjs('lib','uploadify/uploadify.css','css');?>

<!--[if IE 7]>
  <?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome-ie7.min.css','css');?>
<![endif]-->
<?php echo _get_html_cssjs('admin_js','perfect-scrollbar.min.js','js');?>

</head>
<body>


<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo lang('brand_index_brand');?></h3>
      <ul class="tab-base">
        <li><a href="<?php echo ADMIN_SITE_URL.'/brand';?>"><span><?php echo lang('nc_manage');?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('nc_new');?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="form1" method="post" action="<?php echo ADMIN_SITE_URL.'/brand/save'?>">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="id" id="brand_id" value="<?php if(!empty($info['id'])){echo $info['id'];}?>" />
    <table class="table tb-type2 nobdb">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation"><?php echo lang('brand_index_name');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if(!empty($info['name'])){echo $info['name'];}?>" name="brand_name" id="brand_name" value="<?php if (isset($_GET['id'])){ echo $info['name'];}?>" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation">名称首字母:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if(!empty($info['initial'])){echo $info['initial'];}?>" name="brand_initial" id="brand_initial" class="txt"></td>
          <td class="vatop tips">商家发布商品快捷搜索品牌使用</td>
        </tr>

         <tr>
          <td colspan="2" class="required"><?php echo lang('brand_index_class');?>: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform" id="gcategory"><input type="hidden" value="" name="class_id" class="mls_id">
            <input type="hidden" value="" name="brand_class" class="mls_name">
            <select class="class-select" id="cateone" name="cateone">
                <option value="">请选择</option>
                <?php
                foreach($cacheList as $v){
                ?>
                <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                <?php } ?>
            </select>
              <select class="class-select" name="catetwo" id="catetwo" style="display: none">

              </select>
              <select class="class-select" name="catethree" id="catethree" style="display: none">

              </select>
          </td>
          <td class="vatop tips"><?php echo lang('brand_index_class_tips');?></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo lang('brand_index_pic_sign');?>: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
            <div class="upload_block">
              <span class="type-file-show"><img class="show_image" src="<?php echo _get_cfg_path('admin_images');?>preview.png">
                <div class="type-file-preview"><img id="preview_img" class="show_image" src="<?php echo _get_cfg_path('admin_images');?>preview.png"></div>
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
          <td class="vatop tips"><?php echo lang('brand_index_upload_tips').lang('brand_add_support_type');?>gif,jpg,png</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo lang('nc_sort');?>: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if(!empty($info['sort'])){echo $info['sort'];}?>" name="brand_sort" id="brand_sort" class="txt"></td>
          <td class="vatop tips"><?php echo lang('brand_add_update_sort');?></td>
        </tr>
        <tr>
          <td colspan="2" class="required"> 状态：</td>
        </tr>
        <tr>
          <td align="left" class="padL10">
            <input type="radio" name="status" value="1" <?php if( !empty($info['status']) && $info['status']==1 ) echo ' checked' ?> />是
            <input type="radio" name="status" value="2" <?php if( !empty($info['status']) && $info['status']==2 ) echo ' checked' ?> />否
          </td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2" ><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo lang('nc_submit');?></span></a></td>
        </tr>
      </tfoot>
    </table>
      <input type="hidden" id="hid_cateone" value="<?php if (!empty($info['classone'])){ echo $info['classone'];}?>" />
      <input type="hidden" id="hid_catetwo" value="<?php if (!empty($info['classtwo'])){ echo $info['classtwo'];}?>" />
      <input type="hidden" id="hid_catethree" value="<?php if (!empty($info['classthree'])){ echo $info['classthree'];}?>" />
  </form>
</div>

<script src="<?php echo _get_cfg_path('lib')?>uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
 <script type="text/javascript">
<?php $timestamp = time();?>
$(function() {
  upload_file('img','img','<?php echo $timestamp?>','<?php echo md5($this->config->item('encryption_key') . $timestamp );?>');
});
</script>
<script>
//裁剪图片后返回接收函数
function call_back(picname){
  $('#brand_pic').val(picname);
  $('#view_img').attr('src','<?php echo UPLOAD_SITE_URL.'/'.ADMIN_SITE_URL;?>/'+picname);
}
$(function(){
  $("#submitBtn").click(function(){
      if($("#form1").valid()){
       $("#form1").submit();
    }
  });
  $('input[class="type-file-file"]').change(uploadChange);
  function uploadChange(){
    var filepatd=$(this).val();
    var extStart=filepatd.lastIndexOf(".");
    var ext=filepatd.substring(extStart,filepatd.lengtd).toUpperCase();   
    if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
      alert("file type error");
      $(this).attr('value','');
      return false;
    }
    if ($(this).val() == '') return false;
    ajaxFileUpload();
  }
  function ajaxFileUpload() {
    $.ajaxFileUpload
    (
      {
        url:'index.php?act=common&op=pic_upload&form_submit=ok&uploadpath=<?php echo ADMIN_SITE_URL;?>',
        secureuri:false,
        fileElementId:'_pic',
        dataType: 'json',
        success: function (data, status)
        {
          if (data.status == 1){
            ajax_form('cutpic','<?php echo lang('nc_cut');?>','index.php?act=common&op=pic_cut&type=brand&x=150&y=50&resize=1&ratio=3&url='+data.url,690);
          }else{
            alert(data.msg);
          }$('input[class="type-file-file"]').bind('change',uploadChange);
        },
        error: function (data, status, e)
        {
          alert('上传失败');$('input[class="type-file-file"]').bind('change',uploadChange);
        }
      }
    )
  };
  jQuery.validator.addMethod("initial", function(value, element) {
    return /^[A-Za-z0-9]$/i.test(value);
  }, "");
  $("#form1").validate({
    errorPlacement: function(error, element){
      error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        rules : {
            brand_name : {
                required : true,
                remote   : {
                    url :'<?php echo ADMIN_SITE_URL;?>/brand/ajax?branch=check_brand_name',
                    type:'get',
                    data:{
                        brand_name : function(){
                            return $('#brand_name').val();
                            },
                        id  : function(){
                            return $('#brand_id').val();
                            }
                    }
                }
            },
            brand_initial : {
                initial  : true
            },
            
        },
        messages : {
            brand_name : {
                required : '<?php echo lang('brand_add_name_null');?>',
                remote   : '<?php echo lang('brand_add_name_exists');?>'
            },
            brand_initial : {
                initial : '请填写正确首字母',
            },
           
        }
  }); 
});
</script>

<script>
    $(function(){
        //一级分类
        $("#cateone").change(function(){
            var cateone_id = $("#cateone").val();
            catetwo(cateone_id);
            $("#catethree").html("");
            $("#catethree").hide();
        });

        //二级分类
        $("#catetwo").change(function(){
            var city_id = $("#catetwo").val();
            catethree(city_id);
        });

        var hid_cateone     = $("#hid_cateone").val();
        var hid_catetwo     = $("#hid_catetwo").val();
        var hid_catethree   = $("#hid_catethree").val();

        if(!!hid_cateone){
            catetwo(hid_cateone);
            $("#cateone").find("option[value='"+hid_cateone+"']").attr("selected",true);
        }

        if(!!hid_catetwo){
            catethree(hid_catetwo);
            $("#catetwo").find("option[value='"+hid_catetwo+"']").attr("selected",true);
            $("#catetwo").show();
        }

        if(!!hid_catethree){
            $("#catethree").find("option[value='"+hid_catethree+"']").attr("selected",true);
            $("#catethree").show();
        }

        function catetwo(parent_id){
            var url = '/admin/Brand/get_category';
            var parmarr = {parent_id: parent_id};
            var rel = ajaxMain(url, parmarr);
           var listarr = $.parseJSON(rel);
            $("#catetwo").html("");
            $("#catetwo").append('<option value="">请选择</option>');
            for(var i=0;i < listarr.length;i++){
                $("#catetwo").append('<option value="'+listarr[i]['id']+'">'+listarr[i]['name']+'</option>');
            }
            $("#catetwo").show();
        }

        function catethree(parent_id){
            var url = '/admin/Brand/get_category';
            var parmarr = {parent_id: parent_id};
            var rel = ajaxMain(url, parmarr);
            var listarr = $.parseJSON(rel);
            $("#catethree").html("");
            $("#catethree").append('<option value="">请选择</option>');
            for(var i=0;i < listarr.length;i++){
                $("#catethree").append('<option value="'+listarr[i]['id']+'">'+listarr[i]['name']+'</option>');
            }
            $("#catethree").show();
        }
    });

    /**
     * ajax通用方法（同步模式）
     *
     * @parm:       url--请求的地址（注意要用相对地址）
     *              parmArr--JOSN格式（{act:"getLeft",id:45,cid:145}）
     * @autor:
     * @createtime: 2014-08-18
     */
    function ajaxMain(url,parmArr){
        if(url != ''){
            var rel = $.ajax({
                //dataType:"json",
                type: "post",
                url: url,
                async:false,
                data:parmArr,
                success: function (data) {
                    return data;
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            }).responseText;
        }
        return rel;
    }
</script>

</body>
</html>