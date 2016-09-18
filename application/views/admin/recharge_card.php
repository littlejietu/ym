
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
      <h3>平台充值卡</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>列表</span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/recharge_card/add';?>"><span>新增</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="formSearch">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="act" value="recharge_card" />
    <input type="hidden" name="op" value="index" />
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="search-sn">充值卡卡号</label></th>
          <td><input class="txt" type="text" name="sn" id="search-sn" value="<?php if (isset($arrParam['sn'])){echo $arrParam['sn'];}?>" /></td>
          <th><label for="search-batch">批次标识</label></th>
          <td><input class="txt" type="text" name="batch" id="search-batch" value="<?php if (isset($arrParam['batch'])){echo $arrParam['batch'];}?>" /></td>
          <th><label for="search-status">使用状态</label></th>
          <td>
            <select name="status" id="search-status">
              <option value="">全部</option>
              <option value="1" <?php if (isset($arrParam['status']) && $arrParam['status']==1){echo 'selected';}?>>未使用</option>
              <option value="3" <?php if (isset($arrParam['status']) && $arrParam['status']==3){echo 'selected';}?>>已使用</option>
            </select>
            <!-- <script>$('#search-status').val('<?php //echo lang('status'); ?>');</script> -->
          </td>
          <td>
            <a href="javascript:document.formSearch.submit();" class="btn-search " title="<?php echo lang('nc_query');?>">&nbsp;</a>
<?php if (lang('form_submit') == 'ok'): ?>
            <a class="btns " href="<?php echo urlAdmin('recharge_card', 'index');?>" title="<?php echo lang('nc_cancel_search');?>"><span><?php echo lang('nc_cancel_search');?></span></a>
<?php endif; ?>
          </td>
        </tr>
      </tbody>
    </table>
  </form>

  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title"><h5>操作提示</h5><span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
          <ul>
            <li>平台发布充值卡，用户可在会员中心通过输入正确充值卡号的形式对其充值卡账户进行充值。</li>
          </ul>
        </td>
      </tr> 
    </tbody>
  </table>

<div style="text-align: right;"><a class="btns" href="index.php?<?php echo http_build_query($_GET); ?>&op=export_step1" target="_blank"><span>导出Excel</span></a></div>

  <form method="post" action="<?php echo ADMIN_SITE_URL.'/recharge_card/del'?>" onsubmit="" name="form1">
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24"> </th>
          <th class=" ">卡号</th>
          <th class=" ">批次标识</th>
          <th class="w60 align-center">面额(元)</th>
          <th class="w96 align-center">管理员</th>
          <th class="w150 align-center">创建时间</th>
          <th class="w150 align-center">使用时间</th>
          <th class="w270 align-center">使用状态</th>
          <th class="w270 align-center">使用用户名</th>
          <th class="w48 align-center">操作 </th>
        </tr>
      </thead>
<?php if (empty($list['rows'])): ?>
      <tbody>
        <tr class="no_data">
          <td colspan="20"><?php echo lang('nc_no_record');?></td>
        </tr>
      </tbody>
<?php else: ?>
      <tbody>
<?php foreach ($list['rows'] as $val): ?>
        <tr class="space">
          <td class="w24">
<?php if ($val['status']<>3): ?>
            <input type="checkbox" class="checkitem" name="del_id[]" value="<?php echo $val['id']; ?>" />
<?php else: ?>
            <input type="checkbox" disabled="disabled" />
<?php endif; ?>
          </td>
          <td class=""><?php echo $val['sn']; ?></td>
          <td class=""><?php echo $val['batch']; ?></td>
          <td class="align-center"><?php echo $val['denomination']; ?></td>
          <td class="align-center"><?php echo $val['admin_username']; ?></td>
          <td class="align-center"><?php echo date('Y-m-d H:i:s', $val['create_time']); ?></td>
          <td class="align-center"><?php if($val['used_time']> 0) echo date ('Y-m-d H:i:s', $val['used_time']); ?></td>
          <td class="align-center">
<?php if ($val['status'] == 3 && $val['user_id'] > 0 && $val['used_time'] > 0): ?>
            会员 <?php echo $val['user_name']; ?> 在 <?php echo date('Y-m-d H:i:s', $val['used_time']); ?> 使用
<?php else: ?>
            未使用
<?php endif; ?>
          </td>
          <td class="align-center"><?php echo $val['user_name']; ?></td>
          <td class="align-center">
<?php if ($val['status'] == 1): ?>
            <a onclick="return confirm('确定删除？');" href="<?php echo ADMIN_SITE_URL.'/recharge_card/del?id='.$val['id'];?>" class="normal">删除</a>
<?php endif; ?>
          </td>
        </tr>
<?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16"><label for="checkallBottom">全选</label>
            &nbsp;&nbsp;<a href="javascript:void(0);" class="btn" onclick="if ($('.checkitem:checked ').length == 0) { alert('请选择需要删除的选项！');return false;}  if(confirm('<?php echo lang('nc_ensure_del');?>')){document.form1.submit();}"><span>删除</span></a>
            <div class="pagination"><?php echo $list['pages'];?></div></td>

          

        </tr>
      </tfoot>
<?php endif; ?>
    </table>
  </form>
</div>

<script>

</script>
 

</body>
</html>
