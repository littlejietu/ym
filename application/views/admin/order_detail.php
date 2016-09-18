
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>九号街区</title>
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
  <table class="table tb-type2 order">
    <tbody>
      <tr class="space">
        <th colspan="2">订单详情</th>
      </tr>
      <tr>
        <th>订单信息</th>
      </tr>
      <tr>
        <td colspan="2"><ul>
            <li>
            <strong>订单序号:</strong><?php if (!empty($order_detail['order_sn'])) echo $order_detail['order_sn'];?>
            </li>
            <li style="color: red"><strong>订单状态:</strong><?php
        if($order_detail['status']=='Create'){
          echo '订单创建';
        } elseif ($order_detail['status']=='WaitPay'){ 
          echo '等待支付';
        } elseif ($order_detail['status']=='WaitSend'){
          echo '等待发货';
        } elseif ($order_detail['status']=='WaitConfirm'){
          echo '等待确认';
        } elseif ($order_detail['status']=='Finished'){
          echo '已完成';
        } elseif ($order_detail['status']=='Closed'){
          echo '已关闭';
        } elseif ($order_detail['status']=='ClosedBySys'){
          echo '平台手动关闭';
        };?></li>
            <li><strong>订单总额:</strong>￥<?php if (!empty($order_detail['total_amt'])) echo $order_detail['total_amt'];?></li> 
            <li><strong>佣金金额:</strong>￥<?php if (!empty($order_detail['comm_amt'])) echo $order_detail['comm_amt'];?></li>
            <li><strong>运费:</strong>￥<?php if (!empty($order_detail['fare_amt'])) echo $order_detail['fare_amt'];?></li>
          </ul></td>
      </tr>
      <tr>
        <td>
        <ul>
            <li><strong>买家：</strong><?php if(!empty($order_detail['buyer_username'])) echo $order_detail['buyer_username'];?></li>
            <li><strong>卖家： </strong><?php if(!empty($order_detail['seller_username'])) echo $order_detail['seller_username'];?></li>
            <li><strong>支付方式：</strong><?php 
            if ($order_detail['pay_type']==1){
               echo '在线支付';
            } elseif ($order_detail['pay_type']==2){
               echo '余额支付';
            } elseif ($order_detail['pay_type']==3){
               echo '货到付款';
            }?>&nbsp;&nbsp;<?php echo !empty($order_detail['netpay_method'])?C('PayMethodName.'.$order_detail['netpay_method'] ):'';?>
            </li>
            <li><strong>下单时间：</strong><?php if(!empty($order_detail['createtime'])) echo date('Y-m-d H:i:s',$order_detail['createtime']);?></li>
          
        </ul>
        </td>
      </tr>
      <tr>
        <th>收货人信息</th>
      </tr>
      <tr>
        <td>
        <ul>
            <li><strong>收货人姓名：</strong><?php if(!empty($order_detail['real_name'])) echo $order_detail['real_name'];?></li>
            <li><strong>电话号码：</strong><?php if(!empty($order_detail['mobile'])) echo @$order_detail['mobile'];?></li>
            <li><strong>详细地址：</strong><?php if(!empty($order_detail['address'])) echo @$order_detail['address'];?></li>
            
        </ul>
        </td>
      </tr>
      <tr>
        <th>商品信息</th>
      </tr>
      <tr>
        <td>
            <table class="table tb-type2 goods ">
            <tbody>
              <tr>
                <th>商品图片</th>
                <th>商品信息</th>
                <th class="align-center">价格</th>
                <th class="align-center">数量</th>
                <th class="align-center">利润价</th>
              </tr>
              <?php foreach ($goods_list as $kk => $aa){?>
              <tr>
                <td class="w60 picture"><div ><span ><i></i><a href="<?php echo cthumb($aa['pic_path'],360);?>" target="_blank" >
                <img alt="" src="<?php echo cthumb($aa['pic_path'],60)?>" /></a></span></div></td>
                <td class="w50pre"><?php echo $aa['title']?></td>
                <td class="w96 align-center"><span class="red_common"><?php if(!empty($aa['price'])) echo $aa['price'];?></span></td>
                <td class="w96 align-center"><?php echo $aa['num'];?></td>
                <td class="w96 align-center"><?php if(!empty($aa['comm_price'])) echo $aa['comm_price'];?></td>
              </tr>
              <?php }?>
            </tbody>
          </table>
        </td>
      </tr>

<!--      平台订单详情-->
      <tr>
          <td>
              <table class="table tb-type2 goods ">
                  <tbody>
                  <tr>
                      <td colspan="5" style="color: red;">平台订单详情</td>
                  </tr>
                  <tr>
                      <th>商品图片</th>
                      <th>商品信息</th>
                      <th class="align-center">规格</th>
            <th class="align-center">数量</th>
                      <th class="align-center">状态</th>
                  </tr>
                  <?php foreach ($mainDesk as $kk => $aa){?>
                      <tr>
             <td class="w60 picture"><div ><span ><i></i><a href="<?php echo !empty($aa['pic_path'])? $aa['pic_path']:'';?>" target="_blank" >
                          <img alt="" src="<?php echo !empty($aa['pic_path'])? $aa['pic_path']:'';?>" width="60px" height="60px" /></a></span></div></td>
                          <td class="w50pre"><?php echo !empty($aa['title'])? $aa['title']:'';?></td>
                         <td class="w96 align-center"><?php echo !empty($aa['spec'])?$aa['spec']:''?></td>
                          
              <td class="w96 align-center"><?php echo !empty($aa['num'])? $aa['num']:'';?></td>
                          <td class="w96 align-center"><?php echo !empty($aa['status'])? $aa['status']==1?'已配送':'未配送':'未配送';?></td>
                      </tr>
                  <?php }?>
                  <?php if(count($mainDesk)>0 && $order_detail['status']=='WaitSend'):?>
                  <tr>
                      <td colspan="5" class="w96 align-center"><input class="ncsc-btn" type="submit" class="btn" value="发货" onclick="return save(1);" /></td>
                  </tr>
                    <?php endif?>
                  </tbody>
              </table>
          </td>
      </tr>
<!--      平台订单详情-->
<!--      商品订单详情-->
      <tr>
          <td>
              <table class="table tb-type2 goods ">
                  <tr>
                      <td colspan="5" style="color: red;">商铺订单详情</td>
                  </tr>
                  <tbody>
                  <tr>
                      <th>商品图片</th>
                      <th>商品信息</th>
                      <th class="align-center">规格</th>
            <th class="align-center">数量</th>
                      <th class="align-center">状态</th>
                  </tr>
                  <?php foreach ($nineBlocks as $kk => $aa){?>
                      <tr>
              <td class="w60 picture"><div ><span ><i></i><a href="<?php echo !empty($aa['pic_path'])? $aa['pic_path']:'';?>" target="_blank" >
                                          <img alt="" src="<?php echo !empty($aa['pic_path'])? $aa['pic_path']:'';?>" width="60px" height="60px" /></a></span></div><br></td>
                          <td class="w50pre"><?php echo !empty($aa['title'])? $aa['title']:'';?></td>
                          <td class="w96 align-center"><?php echo !empty($aa['spec'])?$aa['spec']:''?></td>
                          <td class="w96 align-center"><?php echo !empty($aa['num'])? $aa['num']:'';?></td>
                          <td class="w96 align-center"><?php echo !empty($aa['status'])? $aa['status']==1?'已配送':'未配送':'未配送';?></td>
                      </tr>
                  <?php }?>
                  <?php if(count($nineBlocks)>0 && $order_detail['status']=='WaitSend'):?>
                  <tr>
                      <td colspan="5" class="w96 align-center"><input class="ncsc-btn" <input type="submit" class="btn" value="发货" onclick="return save(2);" /></td>
                  </tr>
                      <?php endif?>
                  </tbody>
              </table>
          </td>
      </tr>
      <form action="<?php echo ADMIN_SITE_URL.'/order/save_order_deliver'?>" method="post" id="isForm">
      <input type="hidden" value="" name="hidtype" id="hidtype">
      <input type="hidden" value="<?php echo $_SERVER['HTTP_REFERER'];?>" name="list_url" id="list_url">
      <input type="hidden" value="<?php echo $orderId?>" name="order_id" id="order_id">
      </form>
      <script>
          function save(type){

              $("#hidtype").val(type);
//              if(type==1){
//                  var couriertype = $("#couriertype").val();
//                  var courierno = $("#courierno").val();
//
//                  if(!couriertype){
//                      alert('快递名称不能为空！');
//                      $("#couriertype").focus();
//                      return false;
//                  }
//                  if(!courierno){
//                      alert('运单号不能为空！');
//                      $("#courierno").focus();
//                      return false;
//                  }
//              }

              $("#isForm").submit();
          }
      </script>
      <!--      商品订单详情-->
    </tbody>
    <tfoot>
      <tr class="tfoot">
        <td><a href="JavaScript:void(0);" class="btn" onclick="history.go(-1)"><span>返回</span></a></td>
      </tr>
    </tfoot>
  </table>
</div>
</body>
</html>