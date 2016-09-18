
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
      <h3>规格管理</h3>
      <ul class="tab-base">
        <li><a href="javascript:;" class="current"><span>管理</span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/spec_name/add';?>"><span>新增</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>

  <form method="post" id="store_form">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th>规格名</th>
          <th>规格值</th>
          <th class="align-center">操作</th>
        </tr>
      </thead>
      <?php if (empty($list)) { ?>
      <tbody>
        <tr class="no_data">
          <td colspan="15"><?php echo lang('nc_no_record');?></td>
        </tr>
      </tbody>
      <?php } else { ?>
      <tbody>
      <?php foreach($list['rows'] as $k => $v) { ?>
        <tr class="">
          <td>
              <?php echo $v['name']; ?>
          </td>
          <td class="nowrap">
              <?php echo $v['vals']; ?>
         </td>
        <td class="w72 align-center">
            <?php if($v['status'] ==1 ) echo '开启'; elseif ($v['status'] ==2) echo '不开启';?> <a href="<?php echo ADMIN_SITE_URL.'/spec_name/add?id='.$v['id'];?>">编辑</a></td>
        </tr>
        </tr>
      <?php } ?>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td></td>
          <td colspan="16">
            <div class="pagination"><?php echo $list['pages']; ?></div></td>
        </tr>
      </tfoot>
<?php } ?>
    </table>
  </form>
</div>
<script>
$(function(){
    $('#ncsubmit').click(function(){
        $('#formSearch').submit();
    });
});
</script>
</body>
</html>
