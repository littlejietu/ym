<div class="goods-gallery add-step2"><a class='sample_demo' id="select_submit" href="<?php echo urlShop('seller/goods_album', 'pic_list', array('item'=>'goods'));?>" style="display:none;"><?php echo lang('nc_submit');?></a>
  <div class="nav"><span class="l"><?php echo lang('store_goods_album_users');?> >
    <?php if(isset($output['name']) && $output['name'] != ''){echo $output['name'];}else{?>
    <?php echo lang('store_goods_album_all_photo');?>
    <?php }?>
    </span><span class="r">

    <select name="jumpMenu" id="jumpMenu" style="width:100px;">
      <option value="0" style="width:80px;"><?php echo lang('nc_please_choose');?></option>
      <?php foreach($output['class_list'] as $val) { ?>
      <option style="width:80px;" value="<?php echo $val['id']; ?>" <?php if($val['id']==$output['param']['id']){echo 'selected';}?>><?php echo $val['name']; ?></option>
      <?php } ?>
    </select>
    </span></div>
  <?php if(!empty($output['pic_list'])){?>
  <ul class="list">
    <?php foreach ($output['pic_list']['rows'] as $v){
        if(!empty($output['type']) && $output['type']=='color'):?>
          <li onclick="insert_img_color('<?php echo $v['pic'];?>','<?php echo thumb($v, 240);?>');"><a href="JavaScript:void(0);"><img src="<?php echo thumb($v, 240);?>" title='<?php echo $v['pic_name']?>'/></a></li>
    <?php else:?>    
          <li onclick="insert_img('<?php echo $v['pic'];?>','<?php echo thumb($v, 240);?>');"><a href="JavaScript:void(0);"><img src="<?php echo thumb($v, 240);?>" title='<?php echo $v['pic_name']?>'/></a></li>
    <?php endif?>
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
		target:'#demo'
	});
	$('#jumpMenu').change(function(){
		$('#select_submit').attr('href',$('#select_submit').attr('href')+"&id="+$('#jumpMenu').val());
		$('.sample_demo').ajaxContent({
			event:'click', //mouseover
			loaderType:'img',
			loadingMsg:'<?php echo RES_SITE_URL;?>seller/images/loading.gif',
			target:'#demo'
		});
		$('#select_submit').click();
	});
});
</script>