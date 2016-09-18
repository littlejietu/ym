
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>返佣记录</title>
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
      <h3>分佣关系</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" action="" name="formSearch" id="formSearch">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
         <th>用户ID</th>
         <td><input class="txt2" type="text" name="txtKey" value="<?php if(!empty($arrParam['txtKey'])) echo $arrParam['txtKey'];?>" ></td>
         <td><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo lang('nc_query');?>">&nbsp;</a></td>
        </tr>
      </tbody>
    </table>
  </form>
  
  <table class="table tb-type2 nobdb">
    <thead>
      <tr class="thead">
        <th>用户ID</th>
        <th class="align-center">一级ID</th>
        <th class="align-center">二级ID</th>
        <th class="align-center">三级ID</th>
        <th class="align-center">四级ID</th>
        <th class="align-center">五级ID</th>
        <th class="align-center">六级ID</th>
        <th class="align-center">七级ID</th>
        <th class="align-center">八级ID</th>
        <th class="align-center">九级ID</th>
        <th class="align-center">十级ID</th>
        <th class="align-center">添加时间</th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($list['rows']) && is_array($list['rows'])){?>
      <?php foreach($list['rows'] as $k => $v){?>
      <tr class="hover">
        <td><?php echo $v['user_id'];?><?php echo '(昵称:'.$v['name'].')';?></td>
        <td class="align-center" ><?php echo $v['parent_username_1'];?></td>
        <td class="align-center" ><?php echo $v['parent_username_2'];?></td>
        <td class="align-center" ><?php echo $v['parent_username_3'];?></td>
        <td class="align-center" ><?php echo $v['parent_username_4'];?></td>
        <td class="align-center" ><?php echo $v['parent_username_5'];?></td>
        <td class="align-center" ><?php echo $v['parent_username_6'];?></td>
        <td class="align-center" ><?php echo $v['parent_username_7'];?></td>
        <td class="align-center" ><?php echo $v['parent_username_8'];?></td>
        <td class="align-center" ><?php echo $v['parent_username_9'];?></td>
        <td class="align-center" ><?php echo $v['parent_username_10'];?></td>
        <td class="align-center" ><?php echo date('Y-m-d H:i:s',$v['addtime']);?></td>
      </tr>
      <?php }?>
      <?php }else{?>
      <tr class="no_data">
        <td colspan="15">没有符合条件的记录</td>
      </tr>
      <?php }?>
    </tbody>
    <tfoot>
      <tr class="tfoot">
        <td colspan="15" id="dataFuncs"><div class="pagination"> <?php echo $list['pages'];?> </div></td>
      </tr>
    </tfoot>
  </table>
</div>
<!-- <script type="text/javascript" src="<?php //echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script> --> 
<!-- <script type="text/javascript" src="<?php //echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js" charset="utf-8"></script> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php //echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  /> -->
<?php echo _get_html_cssjs('lib','jquery-ui/themes/ui-lightness/jquery.ui.css','css');?>
<?php echo _get_html_cssjs('lib','jquery-ui/jquery.ui.js','js');?>
<script type="text/javascript">
$(function(){
    $('#addtime').datepicker({dateFormat: 'yy-mm-dd'});
    $('#etime').datepicker({dateFormat: 'yy-mm-dd'});
    $('#ncsubmit').click(function(){
      $('input[name="op"]').val('index');$('#formSearch').submit();
    });
});
</script>
</body>
</html>
