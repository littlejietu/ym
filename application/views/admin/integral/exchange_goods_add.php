<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>coupon</title>
    <?php echo _get_html_cssjs('admin_js', 'jquery.js,jquery.validation.min.js,admincp.js,jquery.cookie.js,common.js', 'js'); ?>


    <link href="<?php echo _get_cfg_path('admin') . TPL_ADMIN_NAME; ?>css/skin_0.css" type="text/css" rel="stylesheet"
          id="cssfile"/>
    <!--    --><?php //echo _get_html_cssjs('admin_css','perfect-scrollbar.min.css','css');?>

    <!--    --><?php //echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome.min.css','css');?>

    <!--[if IE 7]>
    <?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome-ie7.min.css','css');

    ?>
    <![endif]-->
    <!--    --><?php //echo _get_html_cssjs('admin_js','perfect-scrollbar.min.js','js');?>
</head>
<body>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <h3>兑换礼品</h3>
            <ul class="tab-base">
                <li><a href="/admin/integral_goods"><span>礼品列表</span></a></li>
                <li><a href="JavaScript:void(0);" class="current"><span><?php if (!empty($goodsInfo)) {
                                echo '编辑';
                            } else {
                                echo '新增';
                            } ?>礼品</span></a></li>
                <li><a href="/admin/integral_goods/order_list"><span>兑换列表</span></a></li>
            </ul>
        </div>
    </div>
    <div class="fixed-empty"></div>
    <form id="pointprod_form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="goodsid" id="goodsid" value="<?php if (!empty($goodsInfo)) {
            echo $goodsInfo['id'];
        } ?>"/>
        <table class="table tb-type2">
            <thead>
            <tr class="space">
                <th colspan="3">礼品基本信息</th>
            </tr>
            </thead>
            <tbody>
            <tr>
<!--                <th class="required" style="line-height:normal; border-top: 1px dotted #CBE9F3;"><label-->
<!--                        for="textfield1">礼品图片:</label></th>-->

                <td colspan="1" class="required"><label class="validation" for="textfield1">礼品图片:</label></td>
                <td colspan="2" class="required"><label class="validation" for="goodsname">礼品名称:</label></td>
            </tr>
            <tr class="noborder">
                <th rowspan="6" class="picture">
                    <div class="size-200x200" id="perviewDiv"><span class="thumb size-200x200"><i></i><img
                                id="preViewImage" src="<?php if (!empty($goodsInfo)) {echo $goodsInfo['goods_url'];}?>" onload="javascript:DrawImage(this,200,200);"
                                nc_type="goods_image"/></span></div>
                </th>
                <td class="vatop rowform"><input type="text" name="goodsname" id="goodsname" class="txt"
                                                 value="<?php if (!empty($goodsInfo)) {
                                                     echo $goodsInfo['goods_name'];
                                                 } ?>"/></td>
                <td class="vatop tips"></td>
            </tr>
<!--            <tr>-->
<!--                <td colspan="2" class="required"><label class="validation" for="goodsNumber">礼品编号:</label></td>-->
<!--            </tr>-->
<!--            <tr class="noborder">-->
<!--                <td class="vatop rowform"><input type="text" name="goodsNumber" id="goodsNumber" class="txt"/></td>-->
<!--                <td class="vatop tips"></td>-->
<!--            </tr>-->
            <tr>
                <!--                <th class="required" style="line-height:normal; border-top: 1px dotted #CBE9F3;"><label for="goodstag">礼品标签:</label>-->
                </th>
                <td colspan="2" class="required"><label class="validation" for="goodsstorage">库存:</label></td>
            </tr>
            <tr class="noborder">
                <!--                <td class="vatop rowform"><input type="text" name="goodstag" id="goodstag" class="txt"/></td>-->
                <td class="vatop rowform" style="width: 100%"><input type="text" name="goodsstorage" id="goodsstorage" class="txt"
                                                 value="<?php if (!empty($goodsInfo)) {
                                                     echo $goodsInfo['total'];
                                                 } ?>"/>
                    <?php if (!empty($goodsInfo)) {?>
                        <label>剩余( <?php echo $goodsInfo['total'] - $goodsInfo['exchange_num'];?>)</label>
                    <?php } ?>

                </td>

                <td class="vatop tips"></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><label class="validation" for="goodsprice">礼品原价:</label></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><input type="text" name="goodsprice" id="goodsprice" class="txt"
                                                 value="<?php if (!empty($goodsInfo)) {
                                                     echo $goodsInfo['price'];
                                                 } ?>"/></td>
                <td class="vatop tips"></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><label class="validation" for="goodspoints">兑换积分:</label></td>
            </tr>

            <tr class="noborder">
                <th style="line-height:normal;width: 300px;"><span class="type-file-box" >
<!--                        <input type='text' name='textfield1' id='textfield1' class='type-file-text'/>-->
                        <input type='button'
                               name='button'
                               id='button1'
                               value=''
                               class='type-file-button'/>
                        <input type="hidden" name="textfield1" id="textfield1" class="txt"
                               value="<?php if (!empty($goodsInfo)) {
                                   echo $goodsInfo['goods_path'];
                               } ?>"/>

            <input name="Filedata" type="file" class="type-file-file" id="goods_images" size="30" hidefocus="true"
                   nc_type="change_goods_image" title=" ">
            </span></th>
                <td class="vatop rowform"><input type="text" name="goodspoints" id="goodspoints" class="txt"
                                                 value="<?php if (!empty($goodsInfo)) {
                                                     echo $goodsInfo['integral_cost'];
                                                 } ?>"/></td>
                <td class="vatop tips"></td>
            </tr>


<!--            <tr>-->
<!--                <th class="required" style="line-height:normal; border-top: 1px dotted #CBE9F3;"><label for="goodstag">礼品标签:</label>-->
<!--                </th>-->
<!--                <td colspan="2" class="required"><label class="validation" for="goodsstorage">库存:</label></td>-->
<!--            </tr>-->
<!--            <tr class="noborder">-->
<!--                <td class="vatop rowform"><input type="text" name="goodstag" id="goodstag" class="txt"/></td>-->
<!--                <td class="vatop rowform"><input type="text" name="goodsstorage" id="goodsstorage" class="txt"-->
<!--                                                 value="--><?php //if (!empty($goodsInfo)) {
//                                                     echo $goodsInfo['total'] - $goodsInfo['exchange_num'];
//                                                 } ?><!--"/></td>-->
<!--                <td class="vatop tips"></td>-->
<!--            </tr>-->
            <?php if (!empty($goodsInfo)) { ?>
                <tr>
                    <th class="required" style="line-height:normal; border-top: 1px dotted #CBE9F3;"><label
                            for="addTime">添加时间:</label></th>
                </tr>
                <tr>
                    <th class="" style="line-height:normal; border-top: 1px dotted #CBE9F3;"><label
                            id="addTime"><?php echo date("Y-m-d H:i:s", ((int)$goodsInfo['add_date'])); ?></label></th>
                </tr>
                <tr>
                    <th class="required" style="line-height:normal; border-top: 1px dotted #CBE9F3;"><label
                            for="saleNum">已兑换数量:</label></th>
                </tr>
                <tr>
                    <th class="" style="line-height:normal; border-top: 1px dotted #CBE9F3;"><label
                            id="saleNum"><?php echo $goodsInfo['exchange_num'] ?></label></th>
                </tr>
            <?php } ?>
            </tbody>


            <tbody>


            <tr class="space" style="display: none">
                <th colspan="3"></th>
            </tr>
            <tr style="display: none">
                <td colspan="3"></td>
            </tr>
            <tr style="display: none">
                <td colspan="3" class="required">:</td>
            </tr>
            <tr class="noborder" style="display: none">
                <td colspan="3" id="divComUploadContainer"><input type="file" multiple="multiple" id="fileupload"
                                                                  name="fileupload"/></td>
            </tr>
            <tr style="display: none">
                <td colspan="3" class="required">:</td>
            </tr>
            <tr class="noborder">
                <td colspan="3">
                    <ul id="thumbnails" class="thumblists">
                        <!--                        --><?php //if(is_array($output['file_upload'])){?>
                        <!--                            --><?php //foreach($output['file_upload'] as $k => $v){ ?>
                        <!--                                <li id="-->
                        <?php //echo $v['upload_id'];?><!--" class="picture" >-->
                        <!--                                    <input type="hidden" name="file_id[]" value="-->
                        <?php //echo $v['upload_id'];?><!--" />-->
                        <!--                                    <div class="size-64x64"><span class="thumb"><i></i><img src="-->
                        <?php //echo $v['upload_path'];?><!--" alt="-->
                        <?php //echo $v['file_name'];?><!--" onload="javascript:DrawImage(this,64,64);"/></span></div>-->
                        <!--                                    <p><span><a href="javascript:insert_editor('-->
                        <?php //echo $v['upload_path'];?><!--');">-->
                        <?php //echo $lang['admin_pointprod_uploadimg_add'];?><!--</a></span><span><a href="javascript:del_file_upload('-->
                        <?php //echo $v['upload_id'];?><!--');">删除</a></span></p>-->
                        <!--                                </li>-->
                        <!--                            --><?php //} ?>
                        <!--                        --><?php //} ?>
                    </ul>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr class="tfoot">
                <td colspan="3"><a href="JavaScript:void(0);" class="btn" id="submitBtn"
                                   onclick="$('#pointprod_form').submit();"><span>提交</span></a></td>
            </tr>
            </tfoot>
        </table>
    </form>
</div>
<?php echo _get_html_cssjs('admin_js_fileupload', 'jquery.ui.widget.js,jquery.fileupload.js,jquery.iframe-transport.js', 'js'); ?>
<script>
    // 模拟上传input type='file'样式
    var imgUrl  = '<?php if (!empty($goodsInfo)) {
                                   echo $goodsInfo['goods_path'];
                               }else{
                               echo "";
                               } ?>'

    $('#goods_images').fileupload({
        dataType: 'json',
        url: '/public/upload/uploadIntegralimg',
        formData: {name: 'Filedata'},
        add: function (e, data) {
//            $('img[nctype="goods_image"]').attr('src', '/seller/images/loading.gif');
            data.submit();
            $("#textfield1").val($("#goods_images").val());
        },
        done: function (e, data) {
            var param = data.result;
            if (param.code != 1) {
                alert(param.msg);
//                $('img[nctype="goods_image"]').attr('src',DEFAULT_GOODS_IMAGE);
            } else {
                $('#preViewImage').attr('src', param.data.url);
                $("#textfield1").val(param.data.pic_url);
                imgUrl = param.data.pic_url;
            }
        }
    });
    $(function () {


        $('#pointprod_form').validate({
//            errorPlacement: function(error, element){
//                error.appendTo(element.parent().parent().prev().find('td:first'));
//            },
            rules: {
                goodsname: {
                    required: true
                },
                goodsprice: {
                    required: true,
                    number: true,
                    min: 1
                },
                goodspoints: {
                    required: true,
                    digits: true,
                    min: 0
                },
//                goodsserial: {
//                    required: true
//                },
                goodsstorage: {
                    required: true,
                    digits: true,
                    min: 1
                },
                textfield1: 'required'


//                starttime  : {
//                    required  : true,
//                    date      : false
//                },
//                endtime  : {
//                    required  : true,
//                    date      : false
//                },
//                sort : {
//                    required  : true,
//                    digits    : true,
//                    min		  :0
//                }
            },
            messages: {
                textfield1: '请选择图片',
                goodsname: {
                    required: '输入物品名称'
                },
                goodsprice: {
                    required: '输入物品原价',
                    number: '请输入有效数字',
                    min: '必须大于0'
                },
                goodspoints: {
                    required: '输入需要兑换积分的数量',
                    digits: '请输入整数',
                    min: '必须大于0'
                },
//                goodsserial: {
//                    required: ''
//                },
                goodsstorage: {
                    required: '请输入库存数量',
                    digits: '必须是整数',
                    min: '必须大于0'
                },

//                starttime  : {
//                    required: ''
//                },
//                endtime  : {
//                    required: ''
//                },
//                sort : {
//                    required: '',
//                    digits  : '',
//                    min		: ''
//                }
            },
            submitHandler: function () {
                var obj = {
                    'id': $('#goodsid').val(),
                    'goodsstorage': $('#goodsstorage').val(),
                    'goodspoints': $('#goodspoints').val(),
                    'goodsprice': $('#goodsprice').val(),
                    'goodsname': $('#goodsname').val(),
                    'goodsUrl':imgUrl
                };


                sendPostData(obj, '<?php echo ADMIN_SITE_URL . '/integral_goods/addGoods' ?>', function (result) {
                    if (result.code == 1) {
                        <?php if(!empty($goodsInfo)){?>

                        alert('修改礼品成功');

                        <?php }else{ ?>
                            alert('添加礼品成功');
                            window.history.go(-1);
//                        $('#goodsstorage').val('');
//                        $('#goodspoints').val('');
//                        $('#goodsname').val('');
//                        $('#goodsprice').val('');
//                        <?php } ?>
                        window.history.go(-1);

                    } else {
                        alert(result.msg);
                    }
                });

            }

        });
    });

</script>
</body>
</html>