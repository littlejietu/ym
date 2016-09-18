
<ul class="add-goods-step">
  <li><i class="icon icon-list-alt"></i>
    <h6>STEP.1</h6>
    <h2>选择商品分类</h2>
    <i class="arrow icon-angle-right"></i> </li>
  <li><i class="icon icon-edit"></i>
    <h6>STEP.2</h6>
    <h2>填写商品详情</h2>
    <i class="arrow icon-angle-right"></i> </li>
  <li><i class="icon icon-camera-retro "></i>
    <h6>STEP.3</h6>
    <h2>上传商品图片</h2>
    <i class="arrow icon-angle-right"></i> </li>
  <li class="current"><i class="icon icon-ok-circle"></i>
    <h6>STEP.4</h6>
    <h2>商品发布成功</h2>
  </li>
</ul>
<div class="alert alert-block hr32">
  <h2><i class="icon-ok-circle mr10"></i>商品模板发布成功</h2>
  <div class="hr16"></div>
  <div>
  <div class="hr16"></div>
  <strong>

  </strong>  
  <div class="hr16"></div>
      <h4 class="ml10">商品模板发布成功！</h4>
      <ul class="ml30">
        <li>1. <a href="<?php echo urlShop('admin/goods_tpl_add', 'add_step2',array('tpl_id'=>$output['goods_id']));?>"><?php echo lang('store_goods_step3_edit_product');?></a></li>
        <li>2. <a href="<?php echo urlShop('admin/goods_tpl');?>">返回列表</a></li>
        <li>3. <?php echo lang('store_goods_step3_continue');?> &quot; <a href="<?php echo urlShop('admin/goods_tpl_add', '');?>"><?php echo lang('store_goods_step3_release_new_goods');?></a>&quot;</li>
      </ul>
<!--  <h4 class="ml10">--><?php //echo lang('store_goods_step3_more_actions');?><!--</h4>-->
<!--  <ul class="ml30">-->
<!--    <li>1. --><?php //echo lang('store_goods_step3_continue');?><!-- &quot; <a href="--><?php //echo urlShop('store_goods_add', 'index');?><!--">--><?php //echo lang('store_goods_step3_release_new_goods');?><!--</a>&quot;</li>-->
<!--    <li>2. --><?php //echo lang('store_goods_step3_access');?><!-- &quot; --><?php //echo lang('nc_seller');?><!--&quot; --><?php //echo lang('store_goods_step3_manage');?><!-- &quot;<a href="--><?php //echo urlShop('store_goods_online', 'index');?><!--">--><?php //echo lang('nc_member_path_goods_list');?><!--</a>&quot;</li>-->
<!--    <li>3. --><?php //echo lang('store_goods_step3_participation');?><!-- &quot; <a href="--><?php //echo urlShop('store_activity', 'store_activity');?><!--">--><?php //echo lang('store_goods_step3_special_activities');?><!--</a> &quot;</li>-->
<!--  </ul>-->
</div>
