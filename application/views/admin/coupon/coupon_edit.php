<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>coupon</title>
	<?php echo _get_html_cssjs('admin_js','jquery.js,jquery.validation.min.js,admincp.js,jquery.cookie.js,common.js','js');?>
	<link href="<?php echo _get_cfg_path('admin').TPL_ADMIN_NAME;?>css/skin_0.css" type="text/css" rel="stylesheet" id="cssfile" />
	<?php echo _get_html_cssjs('admin_css','perfect-scrollbar.min.css','css');?>

	<?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome.min.css','css');?>

	<!--[if IE 7]>
	<?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome-ie7.min.css','css');?>
	<![endif]-->
	<?php echo _get_html_cssjs('admin_js','perfect-scrollbar.min.js','js');?>
	<script>

		$(function(){
			$('#add_form').validate({
				errorPlacement: function (error, element) {
					var error_td = element.parent('dd').children('span');
					error_td.append(error);
				},
				rules: {
					txt_template_title: {
						required: true,
						rangelength: [0, 100]
					},
					txt_template_total: {
						required: true,
						digits: true
					},
					txt_template_limit: {
						required: true,
						number: true
					},
					txt_template_describe: {
						required: true
					},
					select_template_price: {
						required: true,
						min:5,
						digits:true
					}
				},
				messages: {
					txt_template_title: {
						required: '<i class="icon-exclamation-sign">模版名称不能为空且不能大于50个字符</i>',
						rangelength: '<i class="icon-exclamation-sign">模版名称不能为空且不能大于50个字符</i>'
					},
					txt_template_total: {
						required: '<i class="icon-exclamation-sign">可发放数量不能为空且必须为整数</i>',
						digits: '<i class="icon-exclamation-sign">可发放数量不能为空且必须为整数</i>'
					},
					txt_template_limit: {
						required: '<i class="icon-exclamation-sign">模版使用消费限额不能为空且必须是数字</i>',
						number: '<i class="icon-exclamation-sign">模版使用消费限额不能为空且必须是数字</i>'
					},
					txt_template_describe: {
						required: '<i class="icon-exclamation-sign">模版描述不能为空且不能大于255个字符</i>'
					},
					select_template_price: {
						required: '<i class="icon-exclamation-sign">模版折扣价格不能为空</i>',
						min: '<i class="icon-exclamation-sign">模版折扣价格不能低于5</i>',
						digits:'<i class="icon-exclamation-sign">模版折扣价格必须是整数</i>'
					}
				}
			});

			$('#add_form').submit(function (e){

				$.ajax({
					type:'post',
					url:'<?php echo ADMIN_SITE_URL.'/coupon/addCou'?>',
					data:$("#add_form").serializeArray(),
					dataType:'json',
					success:function(result){
						if(result.status.code==0){
//							$.sDialog({
//								skin:"green",
//								content:"添加优惠券成功",
//								okBtn:false,
//								cancelBtn:false
//							});

							alert("修改优惠券成功");
						}else{
							alert(result.status.msg);
//							$.sDialog({
//								skin:"red",
//								content:result.msg,
//								okBtn:false,
//								cancelBtn:false
//							});

						}
					},

					error : function() {
						alert("异常");
//						$.sDialog({
//							skin:"red",
//							content:'异常！',
//							okBtn:false,
//							cancelBtn:false
//						});
					}

				});
			}
			);

		});


	</script>

</head>
<body>
<div class="tabmenu">
	<ul class="tab pngFix">
		<li class="active">
			<a href="/admin/coupon/">代金券管理</a>
		</li>

	</ul>

<?php if(!isset($info)){

} ?>

</div>
<div class="ncsc-form-default">
	<form id="add_form" enctype="multipart/form-data">
<!--		<input type="hidden" id="act" name="act" value="store_voucher">-->
<!--		<input type="hidden" id="op" name="op" value="templateadd">-->
		<!--		<input type="hidden" id="form_submit" name="form_submit" value="ok">-->
				<input type="hidden" id="id" name="id" value="<?php echo !empty($info)&&!empty($info['id'])?$info['id']:''?>">
		<dl>
			<dt> <i class="required">*</i>
				代金券名称：
			</dt>
			<dd>
				<input type="text" class="w300 text" name="txt_template_title" value="<?php echo !empty($info)&&!empty($info['coupon_name'])?$info['coupon_name']:''?>">
				<span></span>
			</dd>
		</dl>
<!--		<dl>-->
<!--			<dt> <i class="required">*</i>-->
<!--				店铺分类-->
<!--			</dt>-->
<!--			<dd>-->
<!--				<select name="sc_id">-->
<!--					<option value="0">店铺分类</option>-->
<!--					<option value="2">服装鞋包</option>-->
<!--					<option value="3">3C数码</option>-->
<!--					<option value="4">美容护理</option>-->
<!--					<option value="5">家居用品</option>-->
<!--					<option value="6">食品/保健</option>-->
<!--					<option value="7">母婴用品</option>-->
<!--					<option value="8">文体/汽车</option>-->
<!--					<option value="1">珠宝/首饰</option>-->
<!--					<option value="9">收藏/爱好</option>-->
<!--					<option value="10">生活/服务</option>-->
<!--				</select>-->
<!--				<span></span>-->
<!--			</dd>-->
<!--		</dl>-->
		<dl>
			<dt> <em class="pngFix"></em>
				有效期：
			</dt>
			<dd>
				<input type="text" class="text w70 hasDatepicker" id="txt_template_enddate" name="txt_template_enddate" value="<?php echo !empty($info)&&!empty($info['effective_time'])?$info['effective_time']:''?>" >
<!--				<em class="add-on"><i class="ui-icon-calendar"></i></em> -->
				<span></span>
				<p class="hint">不超过30天</p>
			</dd>
		</dl>
		<dl>
			<dt>面额：</dt>
			<dd>
				<input type="text" class="w70 text" id="select_template_price" name="select_template_price" value="<?php echo !empty($info)&&!empty($info['price'])?$info['price']:''?>">
<!--				<em class="add-on"><i class="icon-renminbi"></i></em>-->
				<span></span>
			</dd>
		</dl>
		<dl>
			<dt>
				<i class="required">*</i>
				可发放总数：
			</dt>
			<dd>
				<input type="text" class="w70 text" name="txt_template_total" value="<?php echo !empty($info)&&!empty($info['coupon_count'])?$info['coupon_count']:''?>">
				<span></span>
			</dd>
		</dl>
		<!--<dl>
			<dt>
				<i class="required">*</i>
				每人限领：
			</dt>
			<dd>
				<select name="eachlimit" class="w80" tabindex="1">
					<option value="0">不限</option>
					<option value="1">1张</option>
					<option value="2">2张</option>
					<option value="3">3张</option>
					<option value="4">4张</option>
					<option value="5">5张</option>
				</select>
			</dd>
		</dl>-->
		<dl>
			<dt>
				<i class="required">*</i>
				消费金额：
			</dt>
			<dd>
				<input type="text" name="txt_template_limit" class="text w70" value="<?php echo !empty($info)&&!empty($info['condition'])?$info['condition']:''?>">
				<em class="add-on">
					<i class="icon-renminbi"></i>
				</em>
				<span></span>
			</dd>
		</dl>
		<dl>
			<dt>
				<i class="required">*</i>
				代金券描述：
			</dt>
			<dd>
				<textarea name="txt_template_describe" class="textarea w400 h600"><?php echo !empty($info)&&!empty($info['desc'])?$info['desc']:''?></textarea>
				<span></span>
			</dd>
		</dl>

		<div class="bottom">
			<label class="submit-border">
				<input id="btn_add" type="submit" class="submit" value="保存"></label>
		</div>
	</form>
</div>
</body>
</html>