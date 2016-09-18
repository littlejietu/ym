
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
      <h3>分类管理</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>分类列表</span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/first_category/add?parent_id='.(!empty($parent_id)?$parent_id:0);?>"><span>新增分类</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" style="margin-top:2px" width="100%">
		<tr>
            <td height="32">
                <form class="form-horizontal" action="<?php echo ADMIN_SITE_URL.'/first_category/index';?>" method="get">
                    <select name="parent_id">
                      <option value="0">分类名称</option>
                      <?php foreach ($categorylist as $k => $v):?>
                        <option value="<?=$v['id']?>" <?php echo !empty($category_id) && $v['id'] == $category_id?'selected="selected"':'' ?>><?=$v['name']?></option>
                       <?php endforeach?>
                    </select>
                    <select name="status">
                      <option value="0">分类状态</option>
                      <option value="1" <?php if($category_status == 1){echo 'selected="selected"';}?>>启用</option>
                      <option value="2" <?php if($category_status == 2){echo 'selected="selected"';}?>>禁用</option>
                    </select>
                    <button type="submit" class="btn">查  询</button>
                  </form>
            </td>
        </tr>
    </table>
  <form method="post" id="store_form" action="<?php echo ADMIN_SITE_URL.'/first/del'?>">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2" >
      <thead>
        <tr class="thead">
          <th></th>
          <th>分类名称</th>
          <th class="align-center">分类状态</th>
          <th class="align-center">排序</th>
          <th class="align-center" width="10%"><?php echo lang('nc_edit');?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($list) && is_array($list)){ ?>
        <?php foreach($list as $k => $v){ ?>
        <tr class="hover">
          <td class="w24"><input type="checkbox" class="checkitem" name="del_id[]" value="<?php echo $v['id']; ?>" /></td>
          <td><?php echo $v['name']; ?></td>
          <td class="align-center nowrap"><?php if($v['status']==1){echo '启用';}elseif($v['status']==2){ echo '禁止';}else{echo '未确认';}?></td>
          <td class="align-center nowrap"><?php echo $v['sort']; ?></td>
          <td class="w72 align-center">
          <a href="<?php echo ADMIN_SITE_URL.'/first_category/add?id='.$v['id']?>">编辑分类</a>
          <?php if($v['type']==3):?>&nbsp;|&nbsp;<a href="<?php echo ADMIN_SITE_URL.'/first_category/del?id='.$v['id'];?>">删除分类</a><?php endif?>
          </td>
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
            </span>&nbsp;&nbsp;
            <div class="pagination">
            </div></td>
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
