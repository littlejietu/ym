<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>coupon</title>
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
            <h3>兑换礼品</h3>
            <ul class="tab-base">
                <li><a href="JavaScript:void(0);" class="current"><span>礼品列表</span></a></li>
                <li><a href="/admin/integral_goods/add" ><span>新增礼品</span></a></li>
                <li><a href="/admin/integral_goods/order_list" ><span>兑换列表</span></a></li>
            </ul>
        </div>
    </div>
    <div class="fixed-empty"></div>
    <form id="pointprod_form" method="post" enctype="multipart/form-data" >
        <input type="hidden" name="form_submit" value="ok" />
        <table class="table tb-type2">
            <thead>
            <tr class="space">
                <th colspan="3">礼品基本信息</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th class="required" style="line-height:normal; border-top: 1px dotted #CBE9F3;"><label for="">礼品图片:</label></th>
                <td colspan="2" class="required"><label class="validation" for="goodsname">礼品名称:</label></td>
            </tr>
            <tr class="noborder">
                <th rowspan="6" class="picture"><div class="size-200x200"><span class="thumb size-200x200"><i></i><img src="" onload="javascript:DrawImage(this,200,200);" nc_type="goods_image" /></span></div>
                </th>
                <td class="vatop rowform"><input type="text" name="goodsname" id="goodsname" class="txt"/></td>
                <td class="vatop tips"></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><label class="validation" for="goodsprice">礼品编号:</label></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><input type="text" name="goodsprice" id="goodsprice" class="txt"/></td>
                <td class="vatop tips"></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><label class="validation" for="goodspoints">礼品原价:</label></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><input type="text" name="goodspoints" id="goodspoints" class="txt"/></td>
                <td class="vatop tips"></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><label class="validation" for="goodsserial">兑换积分:</label></td>
            </tr>
            <tr class="noborder">
                <th style="line-height:normal;"><span class="type-file-box">
            <input name="goods_images" type="file" class="type-file-file" id="goods_images" size="30" hidefocus="true" nc_type="change_goods_image">
            </span> </th>
                <td class="vatop rowform"><input type="text" name="goodsserial" id="goodsserial" class="txt"/></td>
                <td class="vatop tips"></td>
            </tr>
            <tr>
                <th class="required" style="line-height:normal; border-top: 1px dotted #CBE9F3;"><label for="goodstag">礼品标签:</label></th>
                <td colspan="2" class="required"><label class="validation" for="goodsstorage">库存:</label></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><input type="text" name="goodstag" id="goodstag" class="txt"/></td>
                <td class="vatop rowform"><input type="text" name="goodsstorage" id="goodsstorage" class="txt"/></td>
                <td class="vatop tips"></td>
            </tr>
            <tr>
                <th class="required" style="line-height:normal; border-top: 1px dotted #CBE9F3;"><label for="goodstag">添加时间:</label></th>
            </tr>
            <tr>
                <th class="" style="line-height:normal; border-top: 1px dotted #CBE9F3;"><label for="goodstag">1900-1-1</label></th>
            </tr>
            <tr>
                <th class="required" style="line-height:normal; border-top: 1px dotted #CBE9F3;"><label for="goodstag">出售数量:</label></th>
            </tr>
            <tr>
                <th class="" style="line-height:normal; border-top: 1px dotted #CBE9F3;"><label for="goodstag">0</label></th>
            </tr>
            <tr>
                <th class="required" style="line-height:normal; border-top: 1px dotted #CBE9F3;"><label for="goodstag"></label></th>
            </tr>
            </tbody>

            <tbody>


            <tr class="space" style="display: none">
                <th colspan="3"></th>
            </tr>
            <tr style="display: none">
                <td colspan="3"><?php showEditor('pgoods_body',$output['goods']['goods_body'],'600px','400px','visibility:hidden;',"false",$output['editor_multimedia']);?></td>
            </tr>
            <tr style="display: none">
                <td colspan="3" class="required">:</td>
            </tr>
            <tr class="noborder" style="display: none">
                <td colspan="3" id="divComUploadContainer"><input type="file" multiple="multiple" id="fileupload" name="fileupload" /></td>
            </tr>
            <tr style="display: none">
                <td colspan="3" class="required">:</td>
            </tr>
            <tr class="noborder">
<!--                <td colspan="3"><ul id="thumbnails" class="thumblists">-->
<!--                        --><?php //if(is_array($output['file_upload'])){?>
<!--                            --><?php //foreach($output['file_upload'] as $k => $v){ ?>
<!--                                <li id="--><?php //echo $v['upload_id'];?><!--" class="picture" >-->
<!--                                    <input type="hidden" name="file_id[]" value="--><?php //echo $v['upload_id'];?><!--" />-->
<!--                                    <div class="size-64x64"><span class="thumb"><i></i><img src="--><?php //echo $v['upload_path'];?><!--" alt="--><?php //echo $v['file_name'];?><!--" onload="javascript:DrawImage(this,64,64);"/></span></div>-->
<!--                                    <p><span><a href="javascript:insert_editor('--><?php //echo $v['upload_path'];?><!--');">--><?php //echo $lang['admin_pointprod_uploadimg_add'];?><!--</a></span><span><a href="javascript:del_file_upload('--><?php //echo $v['upload_id'];?><!--');">删除</a></span></p>-->
<!--                                </li>-->
<!--                            --><?php //} ?>
<!--                        --><?php //} ?>
<!--                    </ul></td>-->
            </tr>
            </tbody>
            <tfoot>
            <tr class="tfoot">
                <td colspan="3"><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span>提交></span></a></td>
            </tr>
            </tfoot>
        </table>
    </form>

</div>
<script>
    // 模拟上传input type='file'样式
    $(function(){
        var textButton="<input type='text' name='textfield' id='textfield1' class='type-file-text' /><input type='button' name='button' id='button1' value='' class='type-file-button'></input>"
        $(textButton).insertBefore("#goods_images");
        $("#goods_images").change(function(){
            $("#textfield1").val($("#goods_images").val());
        });
    });

    //按钮先执行验证再提交表单
    $(function(){$("#submitBtn").click(function(){
        if($("#pointprod_form").valid()){
            $("#pointprod_form").submit();
        }
    });
    });
    //
    function showlimit(){
        //var islimit = $('input[name=islimit][checked]').val();
        var islimit = $(":radio[name=islimit]:checked").val();
        if(islimit == '1'){
            $("#limitnum_div").show();
            $("#limitnum").val('');
        }else{
            $("#limitnum_div").hide();
            $("#limitnum").val('1');//为了减少提交表单的验证，所以添加一个虚假值
        }
    }
    function showforbidreason(){
        var forbidstate = $(":radio[name=forbidstate]:checked").val();
        if(forbidstate == '1'){
            $("#forbidreason_div").show();
        }else{
            $("#forbidreason_div").hide();
        }
    }
//    function showlimittime(){
//        var islimit = $(":radio[name=islimittime]:checked").val();
//        if(islimit == '1'){
//            $("[name=limittime_div]").show();
//            $("#starttime").val('');
//            $("#endtime").val('');
//        }else{
//            $("[name=limittime_div]").hide();
//            $("#starttime").val('<?php //echo @date('Y-m-d',time()); ?>//');
//            $("#endtime").val('<?php //echo @date('Y-m-d',time()); ?>//');
//        }
//    }
    $(function(){
        $('input[nc_type="change_goods_image"]').change(function(){
            var src = getFullPath($(this)[0]);
            $('img[nc_type="goods_image"]').attr('src', src);
            $('input[nc_type="change_goods_image"]').removeAttr('name');
            $(this).attr('name', 'goods_image');
        });

        showlimit();
        showforbidreason();
//        showlimittime();

//        $('#starttime').datepicker({dateFormat: 'yy-mm-dd'});
//        $('#endtime').datepicker({dateFormat: 'yy-mm-dd'});

        $('#pointprod_form').validate({
            errorPlacement: function(error, element){
                error.appendTo(element.parent().parent().prev().find('td:first'));
            },
            rules : {
                goodsname : {
                    required   : true
                },
                goodsprice    : {
                    required  : true,
                    number    : true,
                    min       : 0
                },
                goodspoints : {
                    required   : true,
                    digits     : true,
                    min		   :0
                },
                goodsserial : {
                    required   : true
                },
                goodsstorage  : {
                    required  : true,
                    digits    : true
                },
                limitnum  : {
                    required   : true,
                    digits     : true,
                    min        : 0
                },
                starttime  : {
                    required  : true,
                    date      : false
                },
                endtime  : {
                    required  : true,
                    date      : false
                },
                sort : {
                    required  : true,
                    digits    : true,
                    min		  :0
                }
            },
            messages : {
                goodsname  : {
                    required   : ''
                },
                goodsprice : {
                    required: '',
                    number  : '',
                    min     : ''
                },
                goodspoints : {
                    required: '',
                    digits     : '',
                    min		   : ''
                },
                goodsserial:{
                    required : ''
                },
                goodsstorage : {
                    required: '',
                    digits  : ''
                },
                limitnum : {
                    required: '',
                    digits  : '',
                    min		: ''
                },
                starttime  : {
                    required: ''
                },
                endtime  : {
                    required: ''
                },
                sort : {
                    required: '',
                    digits  : '',
                    min		: ''
                }
            }
        });

        // 替换图片
        $('#fileupload').each(function(){
            $(this).fileupload({
                dataType: 'json',
                url: 'index.php?act=pointprod&op=pointprod_pic_upload',
                done: function (e,data) {
                    if(data != 'error'){
                        add_uploadedfile(data.result);
                    }
                }
            });
        });
    });
    function add_uploadedfile(file_data)
    {
        var newImg = '<li id="' + file_data.file_id + '" class="picture"><input type="hidden" name="file_id[]" value="' + file_data.file_id + '" /><div class="size-64x64"><span class="thumb"><i></i><img src="' + file_data.file_name + '" alt="' + file_data.file_name + '" width="64px" height="64px"/></span></div><p><span><a href="javascript:insert_editor(\'' + file_data.file_name + '\');">添加</a></span><span><a href="javascript:del_file_upload(' + file_data.file_id + ');">删除</a></span></p></li>';
        $('#thumbnails').prepend(newImg);
    }
    function insert_editor(file_path){
        KE.appendHtml('pgoods_body', '<img src="'+ file_path + '" alt="'+ file_path + '">');
    }
    function del_file_upload(file_id)
    {
        if(!window.confirm('')){
            return;
        }
        $.getJSON('index.php?act=pointprod&op=ajaxdelupload&file_id=' + file_id, function(result){
            if(result){
                $('#' + file_id).remove();
            }else{
                alert('兑换');
            }
        });
    }
</script>
</body>
</html>