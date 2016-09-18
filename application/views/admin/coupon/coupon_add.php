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

	<style>

		.validation{display:inline-block;width: 100px;}
		input {width: 200px}
	</style>
</head>
<body>
<div class="page">
	<div class="fixed-bar">
		<div class="item-title">
			<h3>优惠券管理</h3>
			<ul class="tab-base">
				<li><a href="/admin/coupon" ><span>优惠券管理</span></a></li >
				<li><a class="current"><span>编辑优惠券</span></a></li>
			</ul>
		</div>
	</div>

<div class="fixed-empty"></div>

<div class="ncsc-form-default">
	<form id="add_form" method="post">
<!--		<input type="hidden" id="act" name="act" value="store_voucher">-->
<!--		<input type="hidden" id="op" name="op" value="templateadd">-->
<!--		<input type="hidden" id="form_submit" name="form_submit" value="ok">-->
		<table class="table tb-type2" style="width: 100%;height: 100%;">
			<input type="hidden" name="couponyId" id="couponyId" class="txt" value="<?php if(!empty($info)){ echo $info['id'];}?>"  />
			<tr class="space">
				<th colspan="3">添加编辑优惠券</th>
			</tr>
			<tr>

				<td class="required">
					<label class="validation" for="couponyName">优惠券名称:</label>
					<input type="text" name="couponyName" id="couponyName" class="txt" maxlength="15"  value="<?php if(!empty($info)){ echo $info['coupon_name'];}?>"  />
				</td>
			</tr>
			<tr>
				<td class="required">
					<label class="validation" for="effectTime">有效期(天):</label>
					<input type="text" name="effectTime" id="effectTime" class="txt" maxlength="5" value="<?php if(!empty($info)){ echo $info['effective_time'];}?>"  />
					<label >(领取后多少天内有效)</label>
				</td>
			</tr>
			<tr>
				<td class="required">
					<label class="validation" for="couponValue">面额:</label>
					<input type="text" name="couponValue" id="couponValue" class="txt" maxlength="5" value="<?php if(!empty($info)){ echo $info['price'];}?>"  />
				</td>
			</tr>
			<tr>
				<td class="required">
					<label class="validation" for="totalNum">可发放总数:</label>
					<input type="text" name="totalNum" id="totalNum" class="txt" maxlength="5"  value="<?php if(!empty($info)){ echo $info['coupon_count'];}?>"  />
				</td>
			</tr>
			<tr>
				<td class="required">
					<label class="validation" for="conditionNum">需要消费金额:</label>
					<input type="text" name="conditionNum" id="conditionNum" class="txt" maxlength="10"  value="<?php if(!empty($info)){ echo $info['condition'];}?>"  />
				</td>
			</tr>
			<tr>
				<td class="required">
					<label class="validation" for="desc" >优惠券描述:</label>

				</td>

			</tr>
			<tr>
				<td class="required">
					<textarea type="text" name="desc" id="desc" class="txt" style="width: 70%;height: 100px" maxlength="200"> <?php if(!empty($info)){ echo $info['desc'];}?> </textarea>
				</td>
			</tr>

			<tr class="tfoot">
				<td colspan="3"><a class="btn" id="submitBtn" onclick="$('#add_form').submit()"><span>提交</span></a></td>
			</tr>
		</table>

	</form>
</div>
</div>
<script type="text/javascript">

	$(document).ready(function () {

		$('#add_form').validate({
			rules: {
				couponyName: {
					"required": true,


				},
				effectTime: {
					"required": true,
					"number": true,
					"min": 1,

				},
				couponValue: {
					"required": true,
					"number": true,
					"min":1
				},
				totalNum: {
					"required": true,
					"number": true,
					"min":1
				},
				conditionNum: {
					"number": true,
					"min":0
				},
				desc: {
					"required": true,
				},
			},
			messages: {

				couponyName: {
					"required": '输入优惠券名称',
				},
				effectTime: {
					"required": '请输入有效时间',
					"number": '必须是数字',
					"min": '有效时间必须大于一天',
				},
				couponValue: {
					"required": '请填入优惠券的面额',
					"number": '必须是数字',
					"min": '优惠券面额必须大于0',
				},
				totalNum: {
					"required": '输入优惠券总数量',
					"number": '必须是数字',
					"min":'数量必须大于1',
				},
				conditionNum: {
					"number": '必须是数字',
					"min":'数量必须大于1',
				},
				desc: {
					"required": '输入优惠券描述',
				},

			},
			submitHandler: function () {
				var obj = {
					'id':$('#couponyId').val(),
					'couponyName':$('#couponyName').val(),
					'effectTime':$('#effectTime').val(),
					'couponValue':$('#couponValue').val(),
					'totalNum':$('#totalNum').val(),
					'conditionNum':$('#conditionNum').val(),
					'desc':$('#desc').val(),
				};

				sendPostData(obj, '<?php echo ADMIN_SITE_URL . '/coupon/addCou' ?>', function (result) {
					if (result.code == 1) {
						<?php if(!empty($info)){?>
						location.href ='<?php echo ADMIN_SITE_URL.'/coupon'?>';
						alert('编辑优惠券成功');
						<?php }else{ ?>
						alert('添加优惠券成功');
						$('#couponyId').val('');
						$('#couponyName').val('');
						$('#effectTime').val('');
						$('#couponValue').val('');
						$('#totalNum').val('');
						$('#conditionNum').val('');
						$('#desc').val('');
						<?php } ?>



					} else {
						alert(result.msg);
					}
				})
			}

		});

	});
</script>
</body>
</html>