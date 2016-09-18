<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $output['html_title'];?></title>
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
            <h3><?php echo lang('deliver_manage');?></h3>
            <ul class="tab-base">
                <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('deliver_index');?></span></a></li>
                <li><a href="<?php echo ADMIN_SITE_URL.'/deliver/save';?>"><span><?php echo lang('deliver_add');?></span></a></li>
            </ul>
        </div>
    </div>
    <div class="fixed-empty"></div>
    <table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" style="margin-top:2px" width="100%">
        <tr>
            <td height="32">
                <form class="form-horizontal" role="form" method="post">
                    <select name="place_id">
                        <option value="">请选择</option>
                        <option <?php echo $place_id=='user_name'?'selected="selected"':'' ?> value="user_name">用户名</option>
                        <option <?php echo $place_id=='name'?'selected="selected"':'' ?> value="name">真实姓名</option>
                        <option <?php echo $place_id=='mobile'?'selected="selected"':'' ?> value="mobile">手机号码</option>
                    </select>
                    <input type="text" name="txtKey" value="<?php echo !empty($txtKey)?$txtKey:''?>" placeholder="关键字查询" class="w150">
                    <button type="submit" class="btn">查  询</button>
                </form>
            </td>
        </tr>
    </table>
    <form method="post" id="store_form" action="<?php echo ADMIN_SITE_URL.'/deliver/del'?>">
        <input type="hidden" name="form_submit" value="ok" />
        <table class="table tb-type2" >
            <thead>
            <tr class="thead">
                <th></th>
                <th>用户名</th>
                <th>真实姓名</th>
                <th class="align-center">身份证号</th>
                <th class="align-center">手机号码</th>
                <th class="align-center">注册时间</th>
                <th class="align-center">状态</th>
                <th class="align-center" width="10%">编辑</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($list['rows']) && is_array($list['rows'])){ ?>
                <?php foreach($list['rows'] as $k => $v){ ?>
                    <tr class="hover">
                        <td class="w24"><input type="checkbox" class="checkitem" name="del_id[]" value="<?php echo $v['user_id']; ?>" /></td>
                        <td><span title="<?php echo $v['user_name']; ?>"><?php echo $v['user_name']; ?></span></td>
                        <td><span title="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></span></td>
                        <td class="align-center nowrap"><?php echo $v['id_card']; ?></td>
                        <td class="align-center nowrap"><?php echo $v['mobile']; ?></td>
                        <td class="align-center nowrap"><?php echo date('Y-m-d',$v['reg_time']); ?></td>
                        <td class="align-center nowrap"><?php echo $v['status']?'启用':'禁用'; ?></td>
                        <td class="w72 align-center">
                        <a href="<?php echo ADMIN_SITE_URL.'/deliver/save?id='.$v['user_id']?>"><?php echo lang('deliver_save');?></a>&nbsp;|&nbsp;
                        <a href="<?php echo ADMIN_SITE_URL.'/deliver/del?del_id='.$v['user_id'];?>"><?php echo lang('deliver_del');?></a></td>
                    </tr>
                <?php } ?>
            <?php }else { ?>
                <tr class="no_data">
                    <td colspan="15"><?php echo lang('nc_no_record');?></td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr class="tfoot">
                <td><input type="checkbox" class="checkall" id="checkall"/></td>
                <td id="batchAction" colspan="15"><span class="all_checkbox">
            <label for="checkall"><?php echo lang('nc_select_all');?></label>
            </span>&nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="if(confirm('<?php echo lang('adv_del_sure');?>')){$('#store_form').submit();}"><span><?php echo lang('nc_del');?></span></a>
                    <div class="pagination"> <?php echo $list['pages'];?> </div></td>
            </tr>
            </tfoot>
        </table>
    </form>
</div>
<?php echo _get_html_cssjs('lib','jquery-ui/themes/ui-lightness/jquery.ui.css','css');?>
<?php echo _get_html_cssjs('lib','jquery-ui/jquery.ui.js','js');?>
<script type="text/javascript">
    $(function(){
        $('#begtime').datepicker({dateFormat: 'yy-mm-dd'});
        $('#endtime').datepicker({dateFormat: 'yy-mm-dd'});


        // $('#ap_id').change(function(){
        // 	var select   = document.getElementById("ap_id");
        // });
    });
</script>
<script>
    //弹出复制代码框
    function copyToClipBoard(id)
    {
        ajax_form('copy_adv', '代码调用', 'index.php?act=adv&op=ap_copy&id='+id);
    }
</script>
</body>
</html>
