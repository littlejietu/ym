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

<!--[if IE 7]>
  <?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome-ie7.min.css','css');?>
<![endif]-->
<?php echo _get_html_cssjs('admin_js','perfect-scrollbar.min.js','js');?>

</head>
<body>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo lang('nc_pay_method');?></h3>
      <ul class="tab-base"><li><a class="current"><span><?php echo lang('nc_pay_method');?></span></a></li>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="post_form" method="post" name="form1" action="<?php echo ADMIN_SITE_URL.'/payment/save'?>">
    <input type="hidden" name="payment_id" value="<?php echo $info['id']?>" />
    <table class="table tb-type2 nobdb">
      <tbody>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $info['name'];?></td>
          <td class="vatop tips"></td>
        </tr>
        <?php if ($info['code'] == 'chinabank') { ?>
        <tr>
          <td colspan="2" class="required"><?php echo lang('payment_chinabank_account');?>: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="hidden" name="config_name" value="chinabank_account,chinabank_key" />
            <input name="chinabank_account" id="chinabank_account" value="<?php if (isset($config['chinabank_account'])){echo $config['chinabank_account'];}?>" class="txt" type="text"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo lang('payment_chinabank_key');?>:
            </th></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input name="chinabank_key" id="chinabank_key" value="<?php if (isset($config['chinabank_key'])){echo $config['chinabank_key'];}?>" class="txt" type="text"></td>
          <td class="vatop tips"></td>
        </tr>
        <?php } elseif ($info['code'] == 'tenpay') { ?>
        <tr>
          <td colspan="2" class="required"><?php echo lang('payment_tenpay_account');?>:
            </th></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="hidden" name="config_name" value="tenpay_account,tenpay_key" />
            <input name="tenpay_account" id="tenpay_account" value="<?php if (isset($config['tenpay_account'])){echo $config['tenpay_account'];}?>" class="txt" type="text"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo lang('payment_tenpay_key');?>: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input name="tenpay_key" id="tenpay_key" value="<?php if (isset($config['tenpay_key'])){echo $config['tenpay_key'];}?>" class="txt" type="text"></td>
          <td class="vatop tips"></td>
        </tr>
        <?php } elseif ($info['code'] == 'alipay') { ?>
        <tr>
          <td colspan="2" class="required"><?php echo lang('payment_alipay_account');?>: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="hidden" name="config_name" value="alipay_service,alipay_account,alipay_key,alipay_partner" />
          	<input type="hidden" name="alipay_service" value="create_direct_pay_by_user" />
            <input name="alipay_account" id="alipay_account" value="<?php if (isset($config['alipay_account'])){echo $config['alipay_account'];}?>" class="txt" type="text"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo lang('payment_alipay_key');?>: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input name="alipay_key" id="alipay_key" value="<?php if (isset($config['alipay_key'])){echo $config['alipay_key'];}?>" class="txt" type="text"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo lang('payment_alipay_partner');?>: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input name="alipay_partner" id="alipay_partner" value="<?php if (isset($config['alipay_partner'])){echo $config['alipay_partner'];}?>" class="txt" type="text"></td>
          <td class="vatop tips"><a href="https://b.alipay.com/order/pidKey.htm?pid=2088001525694587&product=fastpay" target="_blank">get my key and partner ID</a></td>
        </tr>
        <?php } ?>
        <tr>
          <td colspan="2" class="required"><?php echo lang('payment_index_enable');?>: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff"><label for="payment_status1" class="cb-enable <?php if($info['status'] == '1'){ ?>selected<?php } ?>" ><span><?php echo lang('nc_open');?></span></label>
            <label for="payment_status2" class="cb-disable <?php if($info['status'] == '0'){ ?>selected<?php } ?>" ><span><?php echo lang('nc_close');?></span></label>
            <input type="radio"  value="1" <?php if($info['status'] == '1'){ ?>checked="checked"<?php }?> name="payment_status" id="payment_status1">
            <input type="radio" <?php if($info['status'] == '0'){ ?>checked="checked"<?php }?> value="0" name="payment_status" id="payment_status2"></td>
          <td class="vatop tips"></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15"><a href="JavaScript:void(0);" class="btn" id="submitBtn"  onclick="document.form1.submit()"><span><?php echo lang('nc_submit');?></span></a> <a href="JavaScript:void(0);" class="btn" onclick="history.go(-1)"><span><?php echo lang('nc_back');?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
$(document).ready(function(){
	$('#post_form').validate({
		<?php if($output['payment']['payment_code'] == 'chinabank') { ?>
        rules : {
            chinabank_account : {
                required   : true
            },
            chinabank_key : {
                required   : true
            }
        },
        messages : {
            chinabank_account  : {
                required  : '<?php echo lang('payment_chinabank_account');?><?php echo lang('payment_edit_not_null'); ?>'
            },
            chinabank_key  : {
                required   : '<?php echo lang('payment_chinabank_key');?><?php echo lang('payment_edit_not_null'); ?>'
            }
        }
		<?php } elseif ($output['payment']['payment_code'] == 'tenpay') { ?>
        rules : {
            tenpay_account : {
                required   : true
            },
            tenpay_key : {
                required   : true
            }
        },
        messages : {
            tenpay_account  : {
                required  : '<?php echo lang('payment_tenpay_account');?><?php echo lang('payment_edit_not_null'); ?>'
            },
            tenpay_key  : {
                required   : '<?php echo lang('payment_tenpay_key');?><?php echo lang('payment_edit_not_null'); ?>'
            }
        }
			
		<?php } elseif ($output['payment']['payment_code'] == 'alipay') { ?>
        rules : {
            alipay_account : {
                required   : true
            },
            alipay_key : {
                required   : true
            },
            alipay_partner : {
                required   : true
            }
        },
        messages : {
            alipay_account  : {
                required  : '<?php echo lang('payment_alipay_account');?><?php echo lang('payment_edit_not_null'); ?>'
            },
            alipay_key  : {
                required   : '<?php echo lang('payment_alipay_key');?><?php echo lang('payment_edit_not_null'); ?>'
            },
            alipay_partner  : {
                required   : '<?php echo lang('payment_alipay_partner');?><?php echo lang('payment_edit_not_null'); ?>'
            }
        }
		<?php } ?>
    });
});
</script>
</body>
</html>