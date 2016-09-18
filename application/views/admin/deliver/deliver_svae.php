<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>big city</title>
    <?php echo _get_html_cssjs('admin_js', 'jquery.js,jquery.validation.min.js,admincp.js,jquery.cookie.js,common.js', 'js'); ?>
    <link href="<?php echo _get_cfg_path('admin') . TPL_ADMIN_NAME; ?>css/skin_0.css" type="text/css" rel="stylesheet"
          id="cssfile"/>
    <?php echo _get_html_cssjs('admin_css', 'perfect-scrollbar.min.css', 'css'); ?>
    <?php echo _get_html_cssjs('lib', 'uploadify/uploadify.css', 'css'); ?>

    <?php echo _get_html_cssjs('admin', TPL_ADMIN_NAME . 'css/font-awesome.min.css', 'css'); ?>

    <!--[if IE 7]>
    <?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome-ie7.min.css','css');?>
    <![endif]-->
    <?php echo _get_html_cssjs('admin_js', 'perfect-scrollbar.min.js', 'js'); ?>
</head>
<body>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <h3><?php echo lang('deliver_manage'); ?></h3>
            <ul class="tab-base">
                <li><a href="<?php echo ADMIN_SITE_URL.'/deliver/index';?>" ><span><?php echo lang('deliver_index');?></span></a></li>
                <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('deliver_add');?></span></a></li>
            </ul>
        </div>
    </div>
    <div class="fixed-empty"></div>
    <form id="adv_form" method="post" action="<?php echo ADMIN_SITE_URL . '/deliver/save' ?>">
        <input type="hidden" name="form_submit" value="ok"/>
        <?php if (!empty($id)) { ?>
            <input type="hidden" name="id" value="<?php echo $id?>"/>
        <?php } ?>
        <table class="table tb-type2" id="main_table">
            <tbody>
            <tr class="noborder">
                <td colspan="2" class="required"><label class="validation" for="adv_name">用户名:</label></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><input type="text" name="user_name" id="user_name" class="txt" value="<?php echo !empty($dataInfo)? $dataInfo['user_name']:''?>"></td>
                <td class="vatop tips"></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><label class="validation" for="ap_name">真实姓名:</label></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform">
                    <input type="text" name="name" id="name" class="txt" value="<?php echo !empty($dataInfo)? $dataInfo['name']:''?>">
                </td>
                <td class="vatop tips"></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><label class="validation" for="adv_id_card">身份证号:</label></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform">
                    <input type="text" value="<?php echo !empty($dataInfo)? $dataInfo['id_card']:''?>" name="id_card" id="id_card" class="txt">
                </td>
                <td class="vatop tips"></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><label class="validation" for="adv_mobile">手机号码:</label></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><input type="text" value="<?php echo !empty($dataInfo)? $dataInfo['mobile']:''?>" name="mobile" id="mobile" class="txt"></td>
                <td class="vatop tips"></td>
            </tr>
            </tbody>
            <tbody id="adv_pic_1">
            <tr>
                <td colspan="2" class="required"><label for="file_adv_pic">身份证A:</label></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform">
                    <div class="upload_block">
                      <span class="type-file-show"><img class="show_image" src="<?php echo _get_cfg_path('admin_images'); ?>preview.png">
                        <div class="type-file-preview"><img id="preview_img_1" src="/<?php echo !empty($dataInfo)? $dataInfo['id_card_a']:''?>" onload="javascript:DrawImage(this,500,500);"></div>
                      </span>
                        <div class="f_note">
                            <input type="hidden" name="img_1" id="img_1" value="<?php echo !empty($dataInfo)? $dataInfo['id_card_a']:''?>">
                            <em><i class="icoPro16"></i></em>
                            <div class="file_but">
                                <input type="hidden" name="orig_img_1" value="<?php echo !empty($dataInfo)? $dataInfo['id_card_a']:''?>"><input id="img_1_upload" name="img_1_upload" value="" type="file">
                            </div>
                        </div>
                    </div>
                </td>
                <td class="vatop tips"><?php echo lang('adv_edit_support'); ?>gif,jpg,jpeg,png</td>
            </tr>
            </tbody>
            <tbody id="adv_pic_2">
            <tr>
                <td colspan="2" class="required"><label for="file_adv_pic">身份证B:</label></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform">
                    <div class="upload_block">
                      <span class="type-file-show"><img class="show_image" src="<?php echo _get_cfg_path('admin_images'); ?>preview.png">
                        <div class="type-file-preview"><img id="preview_img_2" src="/<?php echo !empty($dataInfo)? $dataInfo['id_card_b']:''?>" onload="javascript:DrawImage(this,500,500);"></div>
                      </span>
                        <div class="f_note">
                            <input type="hidden" name="img_2" id="img_2" value="<?php echo !empty($dataInfo)? $dataInfo['id_card_b']:''?>">
                            <em><i class="icoPro16"></i></em>
                            <div class="file_but">
                                <input type="hidden" name="orig_img_2" value="<?php echo !empty($dataInfo)? $dataInfo['id_card_b']:''?>"><input id="img_2_upload" name="img_2_upload" value="" type="file">
                            </div>
                        </div>
                    </div>
                </td>
                <td class="vatop tips"><?php echo lang('adv_edit_support'); ?>gif,jpg,jpeg,png</td>
            </tr>
            </tbody>
            <tbody id="adv_pic_3">
            <tr>
                <td colspan="2" class="required"><label for="file_adv_pic">头像:</label></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform">
                    <div class="upload_block">
                      <span class="type-file-show"><img class="show_image" src="<?php echo _get_cfg_path('admin_images'); ?>preview.png">
                        <div class="type-file-preview"><img id="preview_img_3" src="/<?php echo !empty($dataInfo)? $dataInfo['logo']:''?>" onload="javascript:DrawImage(this,500,500);"></div>
                      </span>
                        <div class="f_note">
                            <input type="hidden" name="img_3" id="img_3" value="<?php echo !empty($dataInfo)? $dataInfo['logo']:''?>">
                            <em><i class="icoPro16"></i></em>
                            <div class="file_but">
                                <input type="hidden" name="orig_img_3" value="<?php echo !empty($dataInfo)? $dataInfo['logo']:''?>"><input id="img_3_upload" name="img_3_upload" value="" type="file">
                            </div>
                        </div>
                    </div>
                </td>
                <td class="vatop tips"><?php echo lang('adv_edit_support'); ?>gif,jpg,jpeg,png</td>
            </tr>
            </tbody>
            <tbody id="adv_mobile_verify">
            <tr>
                <td colspan="2" class="required"><label class="validation" for="adv_end_time">手机验证:</label></td>
            </tr>
            <tr class="noborder" style="background: rgb(255, 255, 255);">
                <td class="vatop rowform onoff">
                    <label for="mobile_verify_1" class="cb-enable <?php echo !empty($dataInfo['mobile_verify'])&& $dataInfo['mobile_verify']==1?'selected':''?>" title="开启"><span>开启</span></label>
                    <label for="mobile_verify_0" class="cb-disable <?php echo empty($dataInfo['mobile_verify'])?'selected':''?>" title="关闭"><span>关闭</span></label>
                    <input type="radio" id="mobile_verify_1" name="mobile_verify" value="1" <?php echo !empty($dataInfo)&& $dataInfo['mobile_verify']==1?'checked="checked"':''?>>
                    <input type="radio" id="mobile_verify_0" name="mobile_verify" value="0" <?php echo empty($dataInfo)?'checked="checked"':''?>>
                </td>
                <td class="vatop tips"></td>
            </tr>
            </tbody>
            <tbody id="adv_status">
            <tr>
                <td colspan="2" class="required"><label class="validation" for="adv_status">审核状态:</label></td>
            </tr>
            <tr class="noborder" style="background: rgb(255, 255, 255);">
                <td class="vatop rowform onoff">
                    <label for="status_1" class="cb-enable <?php echo !empty($dataInfo['status'])&& $dataInfo['status']==1?'selected':''?>" title="开启"><span>开启</span></label>
                    <label for="status_0" class="cb-disable <?php echo empty($dataInfo['status'])?'selected':''?>" title="关闭"><span>关闭</span></label>
                    <input type="radio" id="status_1" name="status" value="1" <?php echo !empty($dataInfo['status'])&& $dataInfo['status']==1?'checked="checked"':''?>>
                    <input type="radio" id="status_0" name="status" value="0" <?php echo empty($dataInfo['status'])?'checked="checked"':''?>>
                </td>
                <td class="vatop tips"></td>
            </tr>
            </tbody>
            <tbody id="adv_status">
            <tr>
                <td colspan="2" class="required"><label class="validation" for="adv_status">派送店铺分配:</label></td>
            </tr>
            <tr>
                <td>
                    <?php foreach($shopList as $k => $v){?>
                 <input type="checkbox" name="shop_id[]" <?php  echo strstr(','.$dataInfo['shop_id'].',',','.$v['id'].',')?'checked':'' ?>  value="<?php echo $v['id']?>"/><?php echo $v['name']?>&nbsp;&nbsp;
                    <?php }?></br>
                </td>
                <td class="vatop tips"></td>
            </tr>
            </tbody>
            <tfoot>
            <tr class="tfoot">
                <td colspan="15">
                    <a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo lang('nc_submit'); ?></span></a>
                    <a href="<?php echo ADMIN_SITE_URL.'/Deliver/'?>" class="btn"><span>返回</span></a>
                </td>
            </tr>
            </tfoot>
        </table>
    </form>
</div>
<?php echo _get_html_cssjs('lib','jquery-ui/themes/ui-lightness/jquery.ui.css','css');?>
<?php echo _get_html_cssjs('lib','jquery-ui/jquery.ui.js','js');?>
<script type="text/javascript">
    $(function () {
        $('#effect_time').datepicker({dateFormat: 'yy-mm-dd'});
        $('#expire_time').datepicker({dateFormat: 'yy-mm-dd'});

        // $('#ap_id').change(function(){
        // 	var select   = document.getElementById("ap_id");
        // });
    });
</script>
<script>
    //按钮先执行验证再提交表单
    $(function () {
        $("#submitBtn").click(function () {
            if ($("#adv_form").valid()) {
                $("#adv_form").submit();
            }
        });
    });
    //
    $(document).ready(function () {
        $('#adv_form').validate({
            errorPlacement: function (error, element) {
                error.appendTo(element.parent().parent().prev().find('td:first'));
            },
            rules: {
                adv_name: {
                    required: true
                },
                content: {
                    required: true
                },
                memo: {
                    required: true
                },
                effect_time: {
                    required: true,
                    date: false
                },
                expire_time: {
                    required: true,
                    date: false
                }
            },
            messages: {
                adv_name: {
                    required: '<?php echo lang('adv_can_not_null');?>'
                },
                content: {
                    required: '<?php echo lang('textadv_null_error');?>'
                },
                memo: {
                    required: '<?php echo lang('textadv_null_error');?>'
                },
                effect_time: {
                    required: '<?php echo lang('adv_start_time_can_not_null'); ?>'
                },
                expire_time: {
                    required: '<?php echo lang('adv_end_time_can_not_null'); ?>'
                }
            }
        });
    });
</script>

<script src="<?php echo _get_cfg_path('lib') ?>uploadify/jquery.uploadify.min.js" type="text/javascript"></script>

<script type="text/javascript">
    <?php $timestamp = time();?>
    $(function () {
        upload_file('img_1', 'img', '<?php echo $timestamp?>', '<?php echo md5($this->config->item('encryption_key') . $timestamp );?>');
        upload_file('img_2', 'img', '<?php echo $timestamp?>', '<?php echo md5($this->config->item('encryption_key') . $timestamp );?>');
        upload_file('img_3', 'img', '<?php echo $timestamp?>', '<?php echo md5($this->config->item('encryption_key') . $timestamp );?>');
    });
</script>


</body>
</html>