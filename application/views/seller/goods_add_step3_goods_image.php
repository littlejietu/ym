
<div class="goods-gallery" nctype="gallery">
 <a class="sample_demo" href="<?php echo urlShop('seller/goods_album', 'pic_list', array('item'=>'goods_image'));?>" style="display:none;">
  <?php echo lang('nc_submit');?></a>
  <div class="nav"><span class="l"><?php echo lang('store_goods_album_users');?> >
    <?php if(isset($output['name']) && $output['name'] != ''){echo $output['name'];}else{?>
    <?php echo lang('store_goods_album_all_photo');?>
    <?php }?>
    </span><span class="r">
    <select name="jumpMenu" style="width:100px;">
      <option value="0" style="width:80px;"><?php echo lang('nc_please_choose');?></option>
      <?php foreach($output['class_list'] as $val) { ?>
      <option style="width:80px;" value="<?php echo $val['id']; ?>" <?php if($val['id']==$output['param']['id']){echo 'selected';}?>><?php echo $val['name']; ?></option>
      <?php } ?>
    </select>
    </span></div>
  <ul class="list">
    <?php if(!empty($output['pic_list'])){?>
    <?php foreach ($output['pic_list']['rows'] as $v){?>
    <li onclick="insert_img('<?php echo $v['pic'];?>','<?php echo thumb($v, 240);?>');"><a href="JavaScript:void(0);"><img src="<?php echo thumb($v, 240);?>" title='<?php echo $v['pic_name']?>'/></a></li>
    <?php }?>
    <?php }else{?>
    <?php echo lang('no_record');?>
    <?php }?>
  </ul>
  <div class="pagination"><?php echo $output['show_page']; ?></div>
</div>
<script>
$(document).ready(function(){
	$('div[nctype="gallery"]').find('.demo').unbind().ajaxContent({
		event:'click', //mouseover
		loaderType:'img',
		loadingMsg:'<?php echo RES_SITE_URL;?>seller/images/loading.gif',
		target:'div[nctype="album"]'
	});
	$('div[nctype="gallery"]').find('select[name="jumpMenu"]').unbind().change(function(){
		var $_select_submit = $('div[nctype="gallery"]').find('.sample_demo');
		var $_href = $_select_submit.attr('href') + "&id=" + $(this).val();
		$_select_submit.attr('href',$_href);
		$_select_submit.unbind().ajaxContent({
			event:'click', //mouseover
			loaderType:'img',
			loadingMsg:'<?php echo RES_SITE_URL;?>seller/images/loading.gif',
			target:'div[nctype="album"]'
		});
		$_select_submit.click();
	});
});
</script>