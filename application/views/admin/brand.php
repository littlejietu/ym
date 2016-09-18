
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
      <h3><?php echo lang('brand_index_brand');?></h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('nc_manage');?></span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/brand/add';?>"><span><?php echo lang('nc_new');?></span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/brand/add';?>"><span><?php //echo lang('brand_index_to_audit');?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" action="<?php echo ADMIN_SITE_URL.'/brand/index'?>" name="formSearch" id="formSearch">
    <input type="hidden" name="act" value="brand">
    <input type="hidden" name="op" value="brand">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="search_brand_name"><?php echo lang('brand_index_name');?></label></th>
          <td><input class="txt" name="txtKey" id="search_brand_name" value="<?php if (isset($arrParam['txtKey'])){echo $arrParam['txtKey'];}?>" type="text"></td>
          <th><label for="search_brand_class"><?php echo lang('brand_index_class');?></label></th>
          <td><input class="txt" name="search_brand_class" id="search_brand_class" value="<?php if (isset($arrParam['search_brand_class'])){echo $arrParam['search_brand_class'];}?>" type="text"></td>
          <td><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo lang('nc_query');?>">&nbsp;</a>
            <a class="btns " href="<?php echo ADMIN_SITE_URL.'/brand/index'?>" title="<?php echo lang('nc_cancel_search');?>"><span><?php echo lang('nc_cancel_search');?></span></a>
            
            </td>
        </tr>
      </tbody>
    </table>
  </form>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title"><h5><?php echo lang('nc_prompts');?></h5><span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
        <ul>
            <li><?php echo lang('brand_index_help1');?></li>
            <li><?php echo lang('brand_index_help3');?></li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method='post' action="<?php echo ADMIN_SITE_URL.'/brand/del'?>" onsubmit="if(confirm('<?php echo lang('nc_ensure_del');?>')){return true;}else{return false;}" name="brandForm">
    <div style="text-align:right;"><a class="btns" href="javascript:void(0);" id="ncexport"><span><?php echo lang('nc_export');?>Excel</span></a></div>
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24"></th>
          <th class="w48"><?php echo lang('nc_sort');?></th>
          <th class="w270"><?php echo lang('brand_index_name');?></th>
          <th class="w150"><?php echo lang('brand_index_class');?></th>
          <th><?php echo lang('brand_index_pic_sign');?></th>
          <th>状态</th>
          <th class="w72 align-center"><?php echo lang('nc_handle');?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($list) && is_array($list)){ ?>
        <?php foreach($list as $k => $v){ ?>
        <tr class="hover edit">
          <td><input value="<?php echo $v['id']?>" class="checkitem" type="checkbox" name="del_id[]"></td>
          <td class="sort"><span class=" editable"  nc_type="inline_edit" fieldname="brand_sort" ajax_branch='brand_sort' fieldid="<?php echo $v['id']?>" datatype="pint" maxvalue="255" title="<?php echo lang('nc_editable');?>"><?php echo $v['sort']?></span></td>
          <td class="name"><span class=" editable" nc_type="inline_edit" fieldname="brand_name" ajax_branch='brand_name' fieldid="<?php echo $v['id']?>" required="1"  title="<?php echo lang('nc_editable');?>"><?php echo $v['name']?></span></td>
          <td class="class"><?php echo $v['category_name']?></td>
          <td class="picture"><div class="brand-picture"><img src="<?php if(!empty($v['logo'])) echo '/'.$v['logo'];?>"/></div></td>
          <td><?php if($v['status']==1) echo '是'; else if($v['status']==-1) echo '删除';  else echo '否';?></td>
          <td class="align-center">
          <a href="<?php echo ADMIN_SITE_URL.'/brand/add?id='.$v['id'];?>"><?php echo lang('nc_edit');?></a>&nbsp;|&nbsp;
          <a href="javascript:void(0)" onclick="if(confirm('<?php echo lang('nc_ensure_del');?>')){location.href='<?php echo ADMIN_SITE_URL.'/brand/del?id='.$v['id'];?>';}else{return false;}"><?php echo lang('nc_del');?></a></td>
        </tr>

        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="10"><?php echo lang('nc_no_record');?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <?php if(!empty($pages)){ ?>
        <tr colspan="15" class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16"><label for="checkallBottom"><?php echo lang('nc_select_all'); ?></label>
            &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="document.brandForm.submit()"><span><?php echo lang('nc_del');?></span></a>
            <div class="pagination"> <?php echo $pages;?> </div></td>
        </tr>
        <?php } ?>
      </tfoot>
    </table>
  </form>
  <div class="clear"></div>
</div>
</div>

<script>
$(function(){
    $('#ncexport').click(function(){
      $('input[name="op"]').val('export_step1');
      $('#formSearch').submit();
    });
    $('#ncsubmit').click(function(){
      $('input[name="op"]').val('brand');$('#formSearch').submit();
    }); 
});
</script>
 

</body>
</html>
