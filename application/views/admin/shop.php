
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
      <h3>自营店铺</h3>
      <ul class="tab-base">
        <li><a href="javascript:;" class="current"><span>管理</span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/shop/add';?>"><span>新增</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="formSearch" id="formSearch">
  <table class="tb-type1 noborder search">
  <tbody>
    <tr>
      <th><label for="name">店铺名</label></th>

      <td><input type="text" value="<?php if (isset($arrParam['txtKey'])){echo $arrParam['txtKey'];}?>" name="txtKey" id="name" class="txt" /></td>
      <td>
        <a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo lang('name');?>">&nbsp;</a>
      </td>
    </tr>
  </tbody>
  </table>
  </form>
   <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title">
            <h5><?php echo lang('nc_prompts');?></h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
          <ul>
            <li>平台在此处统一管理自营店铺，可以新增、编辑、删除平台自营店铺</li>
            <li>已经发布商品的自营店铺不能被删除</li>
            <li>删除平台自营店铺将会同时删除店铺的相关图片以及相关商家中心账户，请谨慎操作！</li>
          </ul>
        </td>
      </tr>
    </tbody>
  </table>
  <form method="post" id="store_form">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th>店铺名</th>
          <th>店家用户名</th>
          <th></th>
          <th class="align-center">状态</th>
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
            <a href="<?php echo ADMIN_SITE_URL.'/shop/add?id='.$v['id'];?>" >
              <?php echo $v['name']; ?>
            </a>
          </td>
          <td><?php echo $v['seller_username']; ?></td>
           <td></td>
          <td class="align-center nowrap"><?php if($v['status'] ==1 ) echo '开启'; elseif ($v['status'] ==2) echo '不开启';?>
         </td>
          <td class="w72 align-center">
          <a href="<?php echo ADMIN_SITE_URL.'/shop/add?id='.$v['id'];?>">编辑</a>&nbsp;|&nbsp;
         <a href="/admin/message/send?user_name=<?php echo $v['seller_username']?>">通知</a></td>
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
<?php echo _get_html_cssjs('lib','jquery-ui/themes/ui-lightness/jquery.ui.css','css');?>
<?php echo _get_html_cssjs('lib','jquery-ui/jquery.ui.js','js');?>
<script>
$(function(){
    $('#ncsubmit').click(function(){
        $('#formSearch').submit();
    });
});
</script>
</body>
</html>
