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
      <h3><?php echo lang('nc_admin_log');?></h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('nc_admin_log');?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="formSearch" id="formSearch">
      <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><?php echo lang('admin_log_man');?></th>
          <td><input class="txt" name="admin_name" value="<?php if (!empty($admin_name))echo $admin_name;?>" type="text"></td>
          <th><?php echo lang('admin_log_dotime');?></th>
          <td><input class="txt date" type="text" value="<?php if (!empty($arrWhere['createtime >']))echo date('Y-m-d H:i:s',$arrWhere['createtime >'])?>" id="time_from" name="time_from">
            <label for="time_to">~</label>
            <input class="txt date" type="text" value="<?php if (!empty($arrWhere['createtime <']))echo date('Y-m-d H:i:s',$arrWhere['createtime <'])?>" id="time_to" name="time_to"/></td>
          <td><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo lang('nc_query');?>">&nbsp;</a>
            </td>
        </tr>
      </tbody>
    </table>
  </form>
  <form method="post" id='form_list' action="<?php echo ADMIN_SITE_URL.'/log/del'?>">
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th></th>
          <th><?php echo lang('admin_log_man');?></th>
          <th><?php echo lang('admin_log_do');?></th>
          <th class="align-center"><?php echo lang('admin_log_dotime');?></th>
          <th class="align-center">IP</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($list) && is_array($list)){ ?>
        <?php foreach($list as $k => $v){ ?>
        <tr class="hover">
          <td class="w24">
            <input name="del_id[]" type="checkbox" class="checkitem" value="<?php echo $v['id']; ?>">
          </td>
          <td><?php echo $v['admin_name']; ?></td>
          <td><?php echo $v['content'];?></td>
          <td class="align-center"><?php echo date('Y-m-d H:i:s',$v['createtime']); ?></td>
          <td class="align-center"><?php echo $v['ip']; ?></td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="10"><?php echo lang('nc_no_record');?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>

      </tfoot>
    </table>
    <?php if(!empty($list) && is_array($list)){ ?>
      <tr class="tfoot">
        <div class="pagination"><?php echo $pages?></div></td>
      </tr>
    <?php } ?>
  </form>
</div>
<?php echo _get_html_cssjs('lib','jquery-ui/themes/ui-lightness/jquery.ui.css','css');?>
<?php echo _get_html_cssjs('lib','jquery-ui/jquery.ui.js','js');?>
<script type="text/javascript">
$(function(){
    $('#time_from').datepicker({dateFormat: 'yy-mm-dd'});
    $('#time_to').datepicker({dateFormat: 'yy-mm-dd'});
    $('#ncsubmit').click(function(){
    	$('input[name="op"]').val('list');
    	$('#formSearch').submit();
    });
});
</script>
</body>
</html>
