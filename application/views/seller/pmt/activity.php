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
      <h3>满就送活动</h3>
      <ul class="tab-base">
      <li><a href="JavaScript:void(0);" class="current"><span>活动列表</span></a></li>
      <li><a href="<?php echo SELLER_SITE_URL.'/activity/add';?>"><span>添加活动</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" id='form_admin' action="<?php echo SELLER_SITE_URL.'/activity/del'?>">
    <table class="tb-type1 noborder search">
      <tbody>
      <tr>
        <th><label>订单序列</label></th>
        <td><input class="txt2" type="text" name="order_sn" value="<?php if (isset($arrParam['order_sn'])){echo $arrParam['order_sn'];}?>" ></td>
        <th style="text-align:center;"><label >卖家<span></span></label></th>
        <td><input class="txt-short" type="text" name="seller_username" value="<?php if (isset($arrParam['seller_username'])){echo $arrParam['seller_username'];}?>" ></td>
        <th style="text-align:center;"><label >买家<span></span></label></th>
        <td><input class="txt-short" type="text" name="buyer_username" value="<?php if (isset($arrParam['buyer_username'])){echo $arrParam['buyer_username'];}?>" ></td>   
      </tr>
      <tr>
        <th><label>订单状态</label></th>
          <td><select name="status" class="querySelect">
              <option value="">请选择</option>
              <option value="WaitPay" <?php if (isset($arrParam['status']) && $arrParam['status']=='WaitPay'){echo " selected";}?>>待支付</option>
              <option value="WaitSend" <?php if (isset($arrParam['status']) && $arrParam['status']=='WaitSend'){echo " selected";}?>>待发货</option>
              <option value="WaitConfirm" <?php if (isset($arrParam['status']) && $arrParam['status']=='WaitConfirm'){echo " selected";}?>>待确认</option>
              <option value="Finished" <?php if (isset($arrParam['status']) && $arrParam['status']=='Finished'){echo " selected";}?>>已完成</option>
              <option value="Closed" <?php if (isset($arrParam['status']) && $arrParam['status']=='Closed'){echo " selected";}?>>已关闭</option>
            </select></td>
        <th><label>发货类型</label></th>
        <td><select name="deliverytype" class="querySelect">
                <option value="">请选择</option>
                <option <?php echo !empty($deliverytype)&& $deliverytype==1?'selected="selected"':''?>  value="1">平台发货</option>
                <option <?php echo !empty($deliverytype)&& $deliverytype==2?'selected="selected"':''?> value="2">商家发货</option>
                <option <?php echo !empty($deliverytype)&& $deliverytype==3?'selected="selected"':''?> value="3">混合发货</option>
            </select></td>
    <th>付款方式</th>
         <td>
            <select name="paymethod" class="w100">
            <option value="">请选择</option>
            <option value="1" <?php if (isset($arrParam['paymethod']) && $arrParam['paymethod']==1){echo " selected";}?>>余额支付</option>
            <option value="11" <?php if (isset($arrParam['paymethod']) && $arrParam['paymethod']==11){echo " selected";}?>>微信APP支付</option>
            <option value="12" <?php if (isset($arrParam['paymethod']) && $arrParam['paymethod']==12){echo " selected";}?>>微信Wap支付</option>
            </select>
         </td>
        </tr>
    <tr>
          <th><label for="query_start_time">下单时间</label></th>
          <td><input class="txt date" type="text" value="<?php if (isset($arrParam['addtime'])){echo $arrParam['addtime'];}?>" id="addtime" name="addtime">
              <label for="addtime">~</label>
              <input class="txt date" type="text" value="<?php if (isset($arrParam['etime'])){echo $arrParam['etime'];}?>" id="etime" name="etime"/></td>
         
         

          <td><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo lang('nc_query');?>">&nbsp;</a>
            
            </td>
        </tr>
        
      </tbody>
    </table>
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg">列表</th>
        </tr>
        <tr class="thead">
          <th></th>
          <th>活动</th>
          <th class="align-center">参与站点</th>
          <th class="align-center">参与对象</th>
          <th class="align-center">开始时间</th>
          <th class="align-center">结束时间</th>
          <th class="align-center">活动时段</th>
          <th class="align-center">状态</th>
          <th class="align-center">操作</th>
        </tr>
      </thead>
      <tbody>
      <?php if(!empty($list['rows']) && is_array($list['rows'])): ?>
        <?php foreach($list['rows'] as $k => $v): ?>
        <tr class="hover">
          <td class="w24">
            <input type="checkbox" name="del_id[]" value="<?php echo $v['id']; ?>" class="checkitem" onclick="javascript:chkRow(this);">
          </td>
          <td><?php echo $v['title'];?></td>
          <td class="align-center"><?php echo $v['site_names'];?></td>
          <td class="align-center"><?php echo $v['user_level_name'];?></td>
          <td class="align-center"><?php echo $v['start_time'] ? date('Y-m-d H:i',$v['start_time']) : ''; ?></td>
          <td class="align-center"><?php echo $v['end_time'] ? date('Y-m-d H:i',$v['end_time']) : ''; ?></td>
          <td class="align-center"><?php echo $v['period_time']?></td>
          <td class="align-center"><?php 
            if($v['status'] == 1)
              echo '正常';
            else
              echo '禁用';?>
           </td>
          <td class="w150 align-center">
            <a href="javascript:void(0)" onclick="if(confirm('您确定要删除吗?')){location.href='<?php echo SELLER_SITE_URL.'/activity/del?id='.$v['id']; ?>'}">删除</a> | 
            <a href="<?php echo SELLER_SITE_URL.'/activity/add?id='.$v['id']; ?>">编辑</a>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr class="no_data">
          <td colspan="10"><?php echo lang('nc_no_record');?></td>
        </tr>
      <?php endif; ?>
      </tbody>
      <tfoot>
        <?php if(!empty($list) && is_array($list)){ ?>
        <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkallBottom" name="chkVal"></td>
          <td colspan="16"><label for="checkallBottom">全选</label>
            &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="if(confirm('删除')){$('#form_admin').submit();}"><span>批量删除</span></a>
            <div class="pagination"> <?php echo $list['pages'];?> </div></td>
        </tr>
        <?php } ?>
      </tfoot>
    </table>
  </form>
</div>
</body>
</html>
