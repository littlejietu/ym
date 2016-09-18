<a href="javascript:void(0);" nctype="meai_cancel" class="ncsc-btn mt5"><i class=" icon-circle-arrow-up"></i>关闭相册</a>
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
    <?php foreach ($output['pic_list']['rows'] as $v){?>
    <li onclick="<?php if ($output['type'] == 'replace') {?>replace<?php } else {?>insert<?php }?>_mobile_img('<?php echo thumb($v, 1280);?>');"><a href="JavaScript:void(0);"><img src="<?php echo thumb($v, 240);?>" title='<?php echo $v['pic_name']?>'/></a></li>
    <?php }?>
  </ul>
  <?php }else{?>
  <div class="warning-option"><i class="icon-warning-sign"></i><span>相册中暂无图片</span></div>
  <?php }?>
  <div class="pagination"><?php echo $output['show_page']; ?></div>
</div>
<script type="text/javascript">
$(function(){
    $('[nctype="mea_img"]').find('a[class="demo"]').click(function(){
        $('[nctype="mea_img"]').load($(this).attr('href'));
        return false;
    });
    $('#jumpMenu').change(function(){
        $('[nctype="mea_img"]').load('index.php?act=store_album&op=pic_list&item=mobile<?php if ($output['type'] == 'replace') {?>&type=replace<?php }?>&id=' + $(this).val());
    });
});
</script>