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
      <h3><?php echo lang('g_album_manage');?></h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('g_album_list');?></span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/goods_album/pic_list'?>" ><span><?php echo lang('g_album_pic_list');?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="formSearch">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="search_brand_name"><?php echo lang('g_album_keyword');?></label></th>
          <td><input class="txt" name="keyword" id="keyword" value="<?php if (!empty($keyword)) echo $keyword;?>" type="text"></td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search " title="<?php echo lang('nc_query');?>">&nbsp;</a>
            <!--      跳转到该店铺       <a class="btns" href=""><span></span></a> -->
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
            <li><?php echo lang('g_album_del_tips');?></li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method='post' id="picForm" name="picForm" action="<?php echo ADMIN_SITE_URL.'/goods_album/album_del'?>">
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24"></th>
          <th class="w72 center"><?php echo lang('g_album_fmian'); ?></th>
          <th class="w270"><?php echo lang('g_album_one');?></th>
          <th class=" w270"><?php echo lang('g_album_shop');?></th>
          <th><?php echo lang('g_album_pic_count');?></th>
          <th class="w72 align-center"><?php echo lang('nc_handle');?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($list) && is_array($list)){ ?>
        <?php foreach($list as $k => $v){ ?>
        <tr class="hover edit">
          <td><input value="<?php echo $v['id']?>" class="checkitem" type="checkbox" name="del_id[]"></td>
          <td>
          <?php if($v['pic'] != ''){ ?>
              <img src="" onload="javascript:DrawImage(this,70,70);">
              <?php }else{?>
              <img src="<?php echo BASE_SITE_URL.'/res/admin/images/default_image.png';?>" onload="javascript:DrawImage(this,70,70);">
              <?php }?>
          </td>
          <td class="name"><?php echo $v['name'];?></td>
          <td class="class"><a href="" ><?php if (isset($shop_list[$v['shop_id']]))echo $shop_list[$v['shop_id']];?></td>
          <td><?php if (isset($pic_count[$v['id']]))echo $pic_count[$v['id']]; else echo 0;?></td>
          <td class="align-center"><a href="<?php echo ADMIN_SITE_URL.'/goods_album/pic_list?album_id='.$v['id'];?>"><?php echo lang('d');?><?php echo lang('g_album_pic_one');?></a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="if(confirm('<?php echo lang('nc_ensure_del');?>')){location.href='<?php echo ADMIN_SITE_URL.'/goods_album/album_del?album_id='.$v['id'];?>';}else{return false;}"><?php echo lang('nc_del');?></a></td>
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
        <tr colspan="15" class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16"><label for="checkallBottom"><?php echo lang('nc_select_all'); ?></label>
            &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="if(confirm('<?php echo lang('nc_ensure_del');?>')){$('#picForm').submit()}"><span><?php echo lang('nc_del');?></span></a>
            <div class="pagination"> <?php echo $pages;?> </div></td>
        </tr>
        <?php } ?>
      </tfoot>
    </table>
  </form>
  <div class="clear"></div>
</div>
</div>
<?php echo _get_html_cssjs('admin_js','jquery.edit.js','js');?>
</body>
</html>
