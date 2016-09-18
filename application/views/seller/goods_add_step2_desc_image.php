<div class="goods-gallery add-step2"> <a class="sample_demo" id="select_s" href="<?php echo urlShop('seller/goods_album', 'pic_list', array('item'=>'des'));?>" style="display:none;"><?php echo lang('nc_submit');?></a>
  <div class="nav"><span class="l"><?php echo lang('store_goods_album_users');?> >
    <?php if(isset($output['class_name']) && $output['class_name'] != ''){echo $output['class_name'];}else{?>
    <?php echo lang('store_goods_album_all_photo');?>
    <?php }?>
    </span><span class="r">
    <select name="jumpMenu" id="jump_menu" style="width:100px;">
      <option value="0" style="width:80px;"><?php echo lang('nc_please_choose');?></option>
      <?php foreach($output['class_list'] as $val) { ?>
      <option style="width:80px;" value="<?php echo $val['id']; ?>" <?php if($val['id']==$output['param']['id']){echo 'selected';}?>><?php echo $val['name']; ?></option>
      <?php } ?>
    </select>
    </span></div>
  <?php if(!empty($output['pic_list']['rows'])){?>
  <ul class="list">
    <?php foreach ($output['pic_list']['rows'] as $v){?>
    <li onclick="insert_editor('<?php echo cthumb($v['pic'], 1280, $output['param']['shop_id']);?>');"><a href="JavaScript:void(0);"><img src="<?php echo cthumb($v['pic'], 240, $output['param']['shop_id']);?>" title='<?php echo $v['pic_name']?>'/></span></a></li>
    <?php }?>
  </ul>
  <?php }else{?>
  <div class="warning-option"><i class="icon-warning-sign"></i><span>相册中暂无图片</span></div>
  <?php }?>
  <div class="pagination"><?php echo $output['show_page']; ?></div>
</div>
<script>
$(document).ready(function(){
	$('.demo').ajaxContent({
		event:'click', //mouseover
		loaderType:'img',
		loadingMsg:'<?php echo RES_SITE_URL;?>seller/images/loading.gif',
		target:'#des_demo'
	});
	$('#jump_menu').change(function(){
		$('#select_s').attr('href',$('#select_s').attr('href')+"&id="+$('#jump_menu').val());
		$('.sample_demo').ajaxContent({
			event:'click', //mouseover
			loaderType:'img',
			loadingMsg:'<?php echo RES_SITE_URL;?>seller/images/loading.gif',
			target:'#des_demo'
		});
		$('#select_s').click();
	});
});
</script>