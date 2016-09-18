
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
<script type="text/javascript">

ADMIN_SITE_URL = '<?php echo ADMIN_SITE_URL?>';

</script>

</head>
<body>


<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo lang('express_name');?></h3>
      <ul class="tab-base"><li><a class="current"><span><?php echo lang('express_name');?></span></a></li>
      <li><a href="<?php echo ADMIN_SITE_URL.'/express/add';?>"><span >添加快递公司</span></a></li></ul>
      
    </div>
  </div>
  <div class="fixed-empty"></div>
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="search_brand_name"><?php echo lang('express_letter');?></label></th>
          <td>
        <?php foreach (range('A','Z') as $v){?>
        <a href="<?php echo ADMIN_SITE_URL.'/express?letter='.$v ?>"><?php echo $v;?></a>&nbsp;&nbsp;
        <?php }?>
          </td>
        </tr>
      </tbody>
    </table>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title"><h5><?php echo lang('nc_prompts');?></h5><span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
        <ul>
            <li><?php echo lang('express_index_help1');?></li>
            <!--<li><?php echo $lang['express_index_help2'];?></li>-->
          </ul></td>
      </tr>
    </tbody>
  </table>
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24"></th>
          <th class="w270"><?php echo lang('express_name');?></th>
          <th ><?php echo lang('express_letter');?></th>
          <th class="w270"><?php echo lang('express_url');?></th>
          <th class="align-center"><?php echo lang('express_order');?></th>
          <th class="align-center"><?php echo lang('express_state');?></th>
          <th class="align-center">支持服务站配送</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($list) && is_array($list)){ ?>
        <?php foreach($list as $k => $v){ ?>
        <tr class="hover">
          <td></td>
          <td><a href="<?php echo $v['url']; ?>" target="_blank"><?php echo $v['name']?></td>
          <td><?php echo $v['initial']?></td>
          <td><a href="<?php echo $v['url']; ?>" target="_blank"><?php echo $v['url']?></a></td>
          <td class="align-center yes-onoff"><?php if($v['use_status'] == '1'){ ?>
            <a href="JavaScript:void(0);" class=" enabled" ajax_branch='use_status' nc_type="inline_edit" fieldname="use_status" fieldid="<?php echo $v['id']?>" fieldvalue="1" title="<?php echo lang('nc_editable');?>"><img src="<?php echo _get_cfg_path('admin').TPL_ADMIN_NAME;?>/images/transparent.gif"></a>
            <?php }else{ ?>
            <a href="JavaScript:void(0);" class=" disabled" ajax_branch='use_status' nc_type="inline_edit" fieldname="use_status" fieldid="<?php echo $v['id']?>" fieldvalue="0"  title="<?php echo lang('nc_editable');?>"><img src="<?php echo _get_cfg_path('admin').TPL_ADMIN_NAME;?>/images/transparent.gif"></a>
            <?php } ?></td>     
          <td class="align-center yes-onoff"><?php if($v['status'] == '0'){ ?>
            <a href="JavaScript:void(0);" class=" disabled" ajax_branch='status' nc_type="inline_edit" fieldname="status" fieldid="<?php echo $v['id']?>" fieldvalue="0" title="<?php echo lang('nc_editable');?>"><img src="<?php echo _get_cfg_path('admin').TPL_ADMIN_NAME;?>/images/transparent.gif"></a>
            <?php }else{ ?>
            <a href="JavaScript:void(0);" class=" enabled" ajax_branch='status' nc_type="inline_edit" fieldname="status" fieldid="<?php echo $v['id']?>" fieldvalue="1"  title="<?php echo lang('nc_editable');?>"><img src="<?php echo _get_cfg_path('admin').TPL_ADMIN_NAME;?>/images/transparent.gif"></a>
            <?php } ?></td>
          <td class="align-center yes-onoff"><?php if($v['delivery_status'] == '0'){ ?>
            <a href="JavaScript:void(0);" class=" disabled" ajax_branch='delivery_status' nc_type="inline_edit" fieldname="delivery_status" fieldid="<?php echo $v['id']?>" fieldvalue="0" title="<?php echo lang('nc_editable');?>"><img src="<?php echo _get_cfg_path('admin').TPL_ADMIN_NAME;?>/images/transparent.gif"></a>
            <?php }else{ ?>
            <a href="JavaScript:void(0);" class=" enabled" ajax_branch='delivery_status' nc_type="inline_edit" fieldname="delivery_status" fieldid="<?php echo $v['id']?>" fieldvalue="1"  title="<?php echo lang('nc_editable');?>"><img src="<?php echo _get_cfg_path('admin').TPL_ADMIN_NAME;?>/images/transparent.gif"></a>
            <?php } ?></td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="7"><?php echo lang('nc_no_record');?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <?php if(!empty($list) && is_array($list)){ ?>
        <tr class="tfoot">
          <td colspan="20"><div class="pagination"> <?php echo $pages;?> </div></td>
        </tr>
        <?php } ?>
      </tfoot>      
    </table>
  <div class="clear"></div>
</div>
</div>
<?php echo _get_html_cssjs('admin_js','jquery.edit.js','js');?>
<?php echo _get_html_cssjs('admin_js','jquery-ui/jquery.ui.js','js');?>


</body>
</html>
