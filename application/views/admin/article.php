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
      <h3><?php echo lang('article_index_manage');?></h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('nc_manage');?></span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/article/add'?>" ><span><?php echo lang('nc_new');?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>

  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title">
            <h5><?php echo lang('nc_prompts');?></h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li><?php echo lang('article_index_help1');?></li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method="post" id="form_article" action="<?php echo ADMIN_SITE_URL.'/article/del'?>">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24"></th>
          <th class="w48"><?php echo lang('nc_sort');?></th>
          <th><?php echo lang('article_index_title');?></th>
          <th><?php echo lang('article_index_class');?></th>
          <th class="align-center"><?php echo lang('article_index_show');?></th>
          <th class="align-center"><?php echo lang('article_index_updatetime');?></th>
          <th class="w60 align-center"><?php echo lang('nc_handle');?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($list) && is_array($list)){ ?>
        <?php foreach($list as $k => $v){ ?>
        <tr class="hover">
          <td><input type="checkbox" name='del_id[]' value="<?php echo $v['id']; ?>" class="checkitem"></td>
          <td><?php echo $v['sort']; ?></td>
          <td><?php echo $v['title']; ?></td>
          <!-- 生成文章所属分类 -->
          <td>
          <?php if (isset($class_list[$v['class_id']]['name'])){echo $class_list[$v['class_id']]['name'];} ?>
          <?php if (isset($class_list[$v['class_id_1']]['name'])){echo '->'.$class_list[$v['class_id_1']]['name'];} ?>
          </td>
          <!-- 文章所属分类结束 -->
          <td class="align-center"><?php if($v['status'] == '1'){echo lang('nc_yes');}else{echo lang('nc_no');} ?></td>
          <td class="nowrap align-center"><?php echo date('Y-m-d H:i:s',$v['updatetime']); ?></td>
          <td class="align-center"><a href="<?php echo ADMIN_SITE_URL.'/article/add?id='.$v['id']; ?>"><?php echo lang('nc_edit');?></a></td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="10"><?php echo lang('nc_no_record');?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <?php if(!empty($list) && is_array($list)){ ?>
        <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16"><label for="checkallBottom"><?php echo lang('nc_select_all'); ?></label>
            &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="if(confirm('<?php echo lang('nc_ensure_del');?>')){$('#form_article').submit();}"><span><?php echo lang('nc_del');?></span></a>
            <div class="pagination"> <?php echo $pages;?> </div></td>
        </tr>
        <?php } ?>
      </tfoot>
    </table>
  </form>
</div>
</body>
</html>
