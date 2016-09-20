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
      <h3>公司设置</h3>
      <ul class="tab-base">
      <li><a href="JavaScript:void(0);" class="current"><span>公司列表</span></a></li>
      <li><a href="<?php echo ADMIN_SITE_URL.'/company/add';?>"><span>添加公司</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" id='form_admin' action="<?php echo ADMIN_SITE_URL.'/company/del'?>">
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg">列表</th>
        </tr>
        <tr class="thead">
          <th></th>
          <th>公司名称</th>
          <th class="align-center">联系人</th>
          <th class="align-center">电话</th>
          <th class="align-center">套餐产品</th>
          <th class="align-center">产品开始时间</th>
          <th class="align-center">产品结束时间</th>
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
          <td><?php echo $v['company'];?></td>
          <td class="align-center"><?php echo $v['linkman'];?></td>
          <td class="align-center"><?php echo $v['phone'];?></td>
          <td class="align-center"><?php echo $v['product_name'];?></td>
          <td class="align-center"><?php echo $v['prd_start_time'] ? date('Y-m-d ',$v['prd_start_time']) : ''; ?></td>
          <td class="align-center"><?php echo $v['prd_end_time'] ? date('Y-m-d ',$v['prd_end_time']) : ''; ?></td>
          <td class="align-center"><?php 
            if($v['status'] == 1)
              echo '正常';
            else
              echo '禁用';?>
           </td>
          <td class="w150 align-center">
            <a href="javascript:void(0)" onclick="if(confirm('您确定要删除吗?')){location.href='<?php echo ADMIN_SITE_URL.'/company/del?id='.$v['id']; ?>'}">删除</a> | 
            <a href="<?php echo ADMIN_SITE_URL.'/company/add?id='.$v['id']; ?>">编辑</a>
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
