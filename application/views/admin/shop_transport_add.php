<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>商家中心</title>

<?php echo _get_html_cssjs('seller_css','base.css','css');?>
<?php echo _get_html_cssjs('font','font-awesome/css/font-awesome.min.css','css');?>
<?php echo _get_html_cssjs('admin_css','seller_center.css','css');?>
<!--[if IE 7]>
  <?php echo _get_html_cssjs('font','font-awesome/font-awesome-ie7.min.css','css');?>
<![endif]-->
<script>
var COOKIE_PRE = '<?php echo COOKIE_PRE;?>';
var _CHARSET = '<?php echo strtolower(CHARSET);?>';
var SITEURL = '<?php echo BASE_SITE_URL;?>';
</script>
<?php echo _get_html_cssjs('seller_js','jquery.js,waypoints.js,jquery-ui/jquery.ui.js,jquery.validation.min.js,common.js,member.js','js');?>
<script type="text/javascript" src="<?php echo _get_cfg_path('lib');?>dialog/dialog.js" id="dialog_js" charset="utf-8"></script>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<?php echo _get_html_cssjs('seller_js','html5shiv.js,respond.min.js','js');?>
<![endif]-->
<!--[if IE 6]>
<?php echo _get_html_cssjs('seller_js','IE6_MAXMIX.js,IE6_PNG.js','js');?>
<script>
DD_belatedPNG.fix('.pngFix');
</script>
<script>
// <![CDATA[
if((window.navigator.appName.toUpperCase().indexOf("MICROSOFT")>=0)&&(document.execCommand))
try{
document.execCommand("BackgroundImageCache", false, true);
   }
catch(e){}
// ]]>
</script>
<![endif]-->

</head>
<body>

<?php echo _get_html_cssjs('seller_js','ToolTip.js','js');?>
<div class="ncsc-layout wrapper">

    <div id="layoutRight" class="ncsc-layout-right">
        <div class="tabmenu">
        </div>
        <div class="ncsc-form-default">
            <form method="post" id="tpl_form" name="tpl_form" action="<?php echo ADMIN_SITE_URL.'/shop_transport/save'?>">
                <input type="hidden" name="transport_id" value="<?php if (!empty($extend_tpl['id']))echo $extend_tpl['id'];?>" />
                <input type="hidden" name="shop_id" value="-1" />
                <input type="hidden" name="type" value="">
                <dl>
                    <dt>
                        <label for="J_TemplateTitle" class="label-like"><?php echo lang('transport_tpl_name').lang('nc_colon');?></label>
                    </dt>
                    <dd>
                        <input type="text"  class="text"  id="title" autocomplete="off"  value="<?php if (!empty($extend_tpl['title']))echo $extend_tpl['title'];?>" name="title">
                        <p class="J_Message" style="display:none" error_type="title"><i class="icon-exclamation-sign"></i><?php echo lang('transport_tpl_name_note');?></p>
                    </dd>
                </dl>
                <dl>
                    <dt><?php echo lang('transport_type').lang('nc_colon');?></dt>
                    <dd><?php echo lang('transport_type_description')?></p>
                    </dd>
                </dl>

                
                <dl>
                    <dt></dt>
                    <dd class="trans-line">
                    </dd>
                </dl>
                <div class="bottom">
                    <label class="submit-border"><input type="submit" id="submit_tpl" class="submit" value="<?php echo lang('transport_tpl_save');?>" /></label>&nbsp;&nbsp;
                    <label class="submit-border"><input type="submit" class="submit" value="返回" onclick="window.history.go(-1)" /></label>
                </div>
            </form>
            <div class="ks-ext-mask" style="position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; z-index: 999; display:none"></div>
            <div id="dialog_areas" class="dialog-areas" style="display:none">
                <div class="ks-contentbox">
                    <div class="title"><?php echo lang('transport_tpl_select_area');?><a class="ks-ext-close" href="javascript:void(0)">X</a></div>
                    <form method="post">
                        <ul id="J_CityList">
                            <?php $this->load->view('seller/store_transport_area');?>
                        </ul>
                        <div class="bottom"> <a href="javascript:void(0);" class="J_Submit ncsc-btn ncsc-btn-green"><?php echo lang('transport_tpl_ok');?></a> <a href="javascript:void(0);" class="J_Cancel ncsc-btn"><?php echo lang('transport_tpl_cancel');?></a> </div>
                    </form>
                </div>
            </div>
            <div id="dialog_batch" class="dialog-batch" style="z-index: 9999; display:none">
                <div class="ks-contentbox">
                    <div class="title"><?php echo lang('transport_tpl_pl_op');?><a class="ks-ext-close" href="javascript:void(0)">X</a></div>
                    <form method="post">
                        <div class="batch"><?php echo lang('transport_note_1').lang('nc_colon');?>
                            <input class="w30 mr5 text" type="text" maxlength="4" autocomplete="off" data-field="start" value="1" name="express_start">
                            <?php echo lang('transport_note_2');?>
                            <input class="w60 text" type="text" maxlength="6" autocomplete="off" value="0.00" name="express_postage" data-field="postage"><em class="add-on"> <i class="icon-renminbi"></i> </em><?php echo lang('transport_note_3');?>
                            <input class="w30 mr5 text" type="text" maxlength="4" autocomplete="off" value="1" data-field="plus" name="express_plus">
                            <?php echo lang('transport_note_4');?>
                            <input class="w60 text" type="text" maxlength="6" autocomplete="off" value="0.00" data-field="postageplus" name="express_postageplus"><em class="add-on"> <i class="icon-renminbi"></i> </em></div>
                        <div class="J_DefaultMessage"></div>
                        <div class="bottom"> <a href="javascript:void(0);" class="J_SubmitPL ncsc-btn ncsc-btn-green"><?php echo lang('transport_tpl_ok');?></a> <a href="javascript:void(0);" class="J_Cancel ncsc-btn"><?php echo lang('transport_tpl_cancel');?></a> </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo _get_html_cssjs('seller_js','transport.js','js');?>
<script>
$(function(){
	$('.trans-line').append(TransTpl.replace(/TRANSTYPE/g,'kd'));
	$('.tbl-except').append(RuleHead);
	<?php if (is_array($extends) && !empty($extends)){?>
	<?php foreach ($extends as $value){?>

		<?php if ($value['is_default']==1){?>

			var cur_tr = $('.tbl-except').prev();
			$(cur_tr).find('input[data-field="start"]').val('<?php echo $value['snum'];?>');
			$(cur_tr).find('input[data-field="postage"]').val('<?php echo $value['sprice'];?>');
			$(cur_tr).find('input[data-field="plus"]').val('<?php echo $value['xnum'];?>');
			$(cur_tr).find('input[data-field="postageplus"]').val('<?php echo $value['xprice'];?>');

		<?php }else{?>

			StartNum +=1;
			cell = RuleCell.replace(/CurNum/g,StartNum);
			cell = cell.replace(/TRANSTYPE/g,'kd');
			$('.tbl-except').find('table').append(cell);
			$('.tbl-attach').find('.J_ToggleBatch').css('display','').html('<?php echo lang('transport_tpl_pl_op');?>');

			var cur_tr = $('.tbl-except').find('table').find('tr:last');
			$(cur_tr).find('.area-group>p').html('<?php echo $value['area_name'];?>');
			$(cur_tr).find('input[type="hidden"]').val('<?php echo trim($value['area_id'],',');?>|||<?php echo $value['area_name'];?>');
			$(cur_tr).find('input[data-field="start"]').val('<?php echo $value['snum'];?>');
			$(cur_tr).find('input[data-field="postage"]').val('<?php echo $value['sprice'];?>');
			$(cur_tr).find('input[data-field="plus"]').val('<?php echo $value['xnum'];?>');
			$(cur_tr).find('input[data-field="postageplus"]').val('<?php echo $value['xprice'];?>');

		<?php }?>
	<?php }?>
	<?php }?>
});
</script>


</body>
</html>