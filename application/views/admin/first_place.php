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
      <h3><?php echo lang('adv_index_manage');?></h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('ap_manage');?></span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/first';?>"><span><?php echo lang('adv_manage');?></span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/first_place/add';?>" ><span><?php echo lang('ap_add');?></span></a></li>
        
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" action="<?php echo ADMIN_SITE_URL.'/first_place?search_name='?>" name="formSearch">
    <input type="hidden" name="act" value="adv" />
    <input type="hidden" name="op" value="ap_manage" />
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="search_name"><?php echo lang('ap_name'); ?></label></th>
          <td><input class="txt" type="text" name="search_name" id="search_name" value="<?php echo empty($arrParam['search_name'])?'':$arrParam['search_name'];?>"/></td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search " title="<?php echo lang('nc_query');?>">&nbsp;</a>
            <?php if($output['search_title'] != '' || $output['search_ac_id'] != ''){?>
            <a href="JavaScript:void(0);" onclick=window.location.href='index.php?act=adv&op=ap_manage' class="btns " title="<?php echo lang('adv_all'); ?>"><span><?php echo lang('adv_all'); ?></span></a>
            <?php }?></td>
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
        <td><ul>
            <li><?php echo lang('adv_help2');?></li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method="post" id="store_form" action="<?php echo ADMIN_SITE_URL.'/first_place/del'?>">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
     <thead>
        <tr class="thead">
          <th></th>
          <th><?php echo lang('ap_name');?></th>
          <th class="align-center"><?php echo lang('ap_memo');?></th>
          <th><?php echo lang('nc_edit');?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['ap_list']['rows']) && is_array($output['ap_list']['rows'])){ ?>
        <?php foreach($output['ap_list']['rows'] as $k => $v){ ?>
        <tr class="hover">
          <td class="w24"><input type="checkbox" class="checkitem" name="del_id[]" value="<?php echo $v['id']; ?>" /></td>
          <td><span title="<?php echo $v['name'];?>"><?php echo $v['name'];?></span></td>
          <td class="align-center">
          <?php echo $v['memo'];?>
          </td>
          <td>
          <a href="<?php echo ADMIN_SITE_URL.'/first_place/add?id='.$v['id'];?>"><?php echo lang('nc_edit');?></a>
          <a href="<?php echo ADMIN_SITE_URL.'/first_place/del?id='.$v['id'];?>"><?php echo lang('nc_del');?></a>
		  </td>
         </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="15"><?php echo lang('nc_no_record');?></td>
        </tr>
        <?php } ?>
      </tbody>
      <?php if (!empty($list['rows'])){?>
      <tfoot>
        <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkall"/></td>
          <td id="batchAction" colspan="15"><span class="all_checkbox">
            <label for="checkall"><?php echo lang('nc_select_all');?></label>
            </span>&nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="if(confirm('<?php echo lang('ap_del_sure');?>')){$('#store_form').submit();}"><span><?php echo lang('nc_del');?></span></a>
            <div class="pagination"> <?php echo $list['pages'];?> </div>
            
            </td>
        </tr>
      </tfoot>
      <?php }?>
    </table>
  </form>
</div>
<?php echo _get_html_cssjs('admin_js','jquery.edit.js,dialog/dialog.js,jquery-ui/jquery.ui.js','js');?>

<script>
//弹出复制代码框
function copyToClipBoard(id)
{
   ajax_form('copy_adv', '<?php echo lang('ap_get_js');?>', 'index.php?act=adv&op=ap_copy&id='+id);
}
</script>
</body>
</html>
