
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
      <h3>充值管理</h3>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" style="margin-top:2px" width="100%">
		<tr>
            <td height="32">
                <form class="form-horizontal" role="form" method="post">
                    <span>用户名&nbsp;&nbsp;&nbsp;</span><input type="text" name="txtUserName" value="<?php if (isset($arrParam['txtUserName'])){echo $arrParam['txtUserName'];}?>" class="w150">
                    <button type="submit" class="btn">查  询</button>
                  </form>
            </td>
        </tr>
    </table>
  <form method="post" id="store_form" action="">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th>订单id</th>
          <th class="align-center">订单编号</th>
          <th>用户名</th>
          <th>充值方式</th>
          <th>充值金额</th>
          <th>充值时间</th>
          <th>ip</th>
          <th class="align-center">状态</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($list['rows']) && is_array($list['rows'])){ ?>
        <?php foreach($list['rows'] as $k => $v){ ?>
        <tr class="hover">
          <td class="w24"><?php echo $v['fund_order_id']; ?></td>
          <td class="align-center nowrap" title="<?php echo $v['order_sn']; ?>"><?php echo $v['order_sn']; ?></td>
          <td><span title="<?php echo $v['buyer_username']; ?>"><?php echo $v['buyer_username']; ?></span></td>
          <td class="nowrap"><?php 
            if($v['netpay_method']==1) 
              echo '现金红包'; 
            elseif ($v['netpay_method']==2) 
              echo '消费红包'; 
            elseif ($v['netpay_method']==3)
              echo '手动充值';
            elseif ($v['netpay_method']==11)
              echo '微信';
            elseif ($v['netpay_method']==12)
              echo '微信';?></td>
          <td class="nowrap"><?php echo $v['total_amt']; ?></td>
          <td class="nowrap"><?php echo date('m-d H:i',$v['create_time']);?></td>
          <td class="nowrap"><?php echo $v['ip']; ?></td>
          <td class="align-center nowrap"><?php
          if ($v['status'] == C('FundOrderStatus.Waiting'))
            echo '等待支付'; 
          elseif ($v['status'] == C('FundOrderStatus.Paying'))
            echo '支付中'; 
          elseif ($v['status'] == C('FundOrderStatus.Payed'))
            echo '已支付'; 
          elseif ($v['status'] == C('FundOrderStatus.WaitingSettle'))
            echo '等待结算';
          elseif ($v['status'] == C('FundOrderStatus.Settled'))
            echo '成功';
          elseif ($v['status'] == C('FundOrderStatus.Closed'))
            echo '已关闭';
          elseif ($v['status'] == C('FundOrderStatus.Refunded'))
            echo '已退款';?></td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="15"><?php echo lang('nc_no_record');?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tr class="tfoot">
          <td id="batchAction" colspan="15"><span class="all_checkbox">
            <div class="pagination"> <?php echo $list['pages'];?> </div></td>
        </tr>
    </table>
  </form>
</div>
<?php echo _get_html_cssjs('lib','jquery-ui/themes/ui-lightness/jquery.ui.css','css');?>
<?php echo _get_html_cssjs('lib','jquery-ui/jquery.ui.js','js');?>


</body>
</html>
