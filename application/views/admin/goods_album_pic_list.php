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
      <h3><?php echo lang('g_album_manage'); ?></h3>
      <ul class="tab-base">
        <li><a href="<?php echo ADMIN_SITE_URL.'/goods_album'?>"><span><?php echo lang('g_album_list');?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('g_album_pic_list');?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="formSearch" action="<?php echo ADMIN_SITE_URL.'/goods_album/pic_list'?>">
    <input type="hidden" name="act" value="goods_album">
    <input type="hidden" name="op" value="pic_list">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="pic_name"><?php echo lang('g_album_keyword'); ?></label></th>
          <td><input class="txt" name="keyword" id="keyword" value="<?php if (!empty($keyword)) echo $keyword;?>" type="text"></td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search " title="<?php echo lang('nc_query');?>">&nbsp;</a>
            <!--      跳转到该店铺       <a class="btns" href=""><span></span></a> -->
          </td>
        </tr>
      </tbody>
    </table>
  </form>
<form method='post' action="<?php echo ADMIN_SITE_URL.'/goods_album/pic_del'?>" name="picForm" id="picForm">
    <table class="table tb-type2">
      <tbody>
        <?php if(!empty($list) && is_array($list)){ ?>
      	<tr><td colspan="20"><ul class="thumblists">
        <?php foreach($list as $k => $v){ ?>
          <li class="picture">
            <div class="size-64x64">
              <span class="thumb">
                <i></i>
				<?php if(!empty($v['pic'])){ ?>
				<a nctype="nyroModal"  href="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_GOODS.'/'.$v['shop_id'].'/'.$v['pic'];?>" rel="gal"><img title="<?php echo date('Y-m-d',$v['addtime']);?><br/><?php echo $v['spec'];?>px<br/><?php echo number_format($v['size']/1024),2;?>k" width="64" height="64"  class="tip" src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_GOODS.'/'.$v['shop_id'].'/'.$v['pic'];?>"></a>
				<?php }else{?>
				<img height="64" src="<?php echo BASE_SITE_URL.'/res/admin/images/default_image.png';?>" max-height='70px' max-width="70px">
				<?php }?>
            </span>
            </div>
            <p>
              <span><input class="checkitem" type="checkbox" name="delbox[]" value="<?php echo $v['id'];?>"></span><span><a href="javascript:void(0);" nc_type="delete" nc_key="<?php echo $v['id'].'|'.$v['pic'];?>"><?php echo lang('nc_del');?></a></span>
            </p>
          </li>
          <?php } ?>
      	</ul></td></tr>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="15"><?php echo lang('nc_no_record');?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td class="w48"><input id="checkallBottom" class="checkall" type="checkbox" /></td>
          <td colspan="16">
            <label for="checkallBottom"><?php echo lang('nc_select_all');?></label>
            <a class="btn" href="javascript:void(0);" onclick="if(confirm('<?php echo lang('nc_ensure_del');?>')){$('#picForm').submit();}"><span><?php echo lang('nc_del');?></span></a>
            <div class="pagination"> <?php echo $pages;?></div></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<?php echo _get_html_cssjs('admin_js','custom.min.js','js');?>
<?php echo _get_html_cssjs('admin_js','jquery.poshytip.min.js','js');?>
<?php echo _get_html_cssjs('admin_css','nyroModal.css','css');?>
<script>
$(function(){
	$('a[nctype="nyroModal"]').nyroModal();
	$('a[nc_type="delete"]').bind('click',function(){
		if(!confirm('<?php echo lang('nc_ensure_del');?>')) return false;
		cur_note = this;
		$.get("<?php echo ADMIN_SITE_URL.'/goods_album/ajax_pic_del'?>", {'key':$(this).attr('nc_key')}, function(data){
            if (data == 1)
            	$(cur_note).parent().parent().parent().remove();
            else
            	alert('<?php echo lang('nc_common_del_fail');?>');
        });
	});
	$('.tip').poshytip({
		className: 'tip-yellowsimple',
		//showOn: 'focus',
		alignTo: 'target',
		alignX: 'center',
		alignY: 'bottom',
		offsetX: 0,
		offsetY: 5,
		allowTipHover: false
	});
});
</script>
</body>
</html>
