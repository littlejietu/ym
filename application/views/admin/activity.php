<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>big city</title>
<?php echo _get_html_cssjs('admin_js','jquery.js,jquery.validation.min.js,admincp.js,jquery.cookie.js,common.js','js');?>
<link href="<?php echo _get_cfg_path('admin').TPL_ADMIN_NAME;?>css/skin_0.css" type="text/css" rel="stylesheet" id="cssfile" />
<?php echo _get_html_cssjs('admin_css','perfect-scrollbar.min.css','css');?>

<?php echo _get_html_cssjs('font','font-awesome/css/font-awesome.min.css','css');?>

<!--[if IE 7]>
  <?php echo _get_html_cssjs('font','font-awesome/css/font-awesome-ie7.min.css','css');?>
<![endif]-->
<?php echo _get_html_cssjs('admin_js','perfect-scrollbar.min.js','js');?>

</head>
<body>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo lang('goods_index_goods');?></h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>所有商品</span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/activity?status=1'?>" ><span>活动中商品</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="formSearch" id="formSearch">
    <input type="hidden" name="act" value="goods">
    <input type="hidden" name="op" value="goods">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="search_goods_name"> <?php echo lang('goods_index_name');?></label></th>
          <td><input type="text" value="<?php echo !empty($search_goods_name)?$search_goods_name:''?>" name="search_goods_name" id="search_goods_name" class="txt"></td>
          <th><label for="search_commonid">平台货号</label></th>
          <td><input type="text" value="<?php echo !empty($search_commonid)?$search_commonid:''?>" name="search_commonid" id="search_commonid" class="txt" /></td>
          <td ><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo lang('nc_query');?>">&nbsp;</a></td>
        </tr>
        <tr>

        </tr>
      </tbody>
    </table>
  </form>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title">
            <h5>操作提示</h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li>当平台发起活动时，店铺可申请参与活动</li>
            <li>只有关闭或者过期的活动才能删除</li>
            <li>活动列表排序越小越靠前显示</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method='post' id="form_goods" action="<?php echo ADMIN_SITE_URL.'/activity/add_activity'?>">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24"></th>
          <th class="w24"></th>
          <th class="w60 align-center">平台货号</th>
          <th colspan="2"><?php echo lang('goods_index_name');?></th>
          <th><?php echo lang('goods_index_brand');?>&<?php echo lang('goods_index_class_name');?></th>
          <th class="w72 align-center">价格(元)</th>
          <th class="w72 align-center">库存</th>
          <th class="w72 align-center">活动状态</th>
          <th class="w72 align-center"></th>
          <th class="w108 align-center">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($goods_list) && is_array($goods_list)) { ?>
        <?php foreach ($goods_list as $k => $v) {?>
        <tr class="hover edit">
          <td><input type="checkbox" name="id[]" value="<?php echo $v['id'];?>" class="checkitem"></td>
          <td></td>
          <td class="align-center"><?php echo $v['id'];?></td>
          <td class="w60 picture"><div class="size-56x56"><span class="thumb size-56x56"><i></i><img src="<?php if (!empty($v['pic_path'])){echo UPLOAD_SITE_URL.'/'.ATTACH_GOODS.'/'.$v['shop_id'].'/'.$v['pic_path'];}else echo RES_SITE_URL.'/admin/images/default_image.png';?>" onload="javascript:DrawImage(this,56,56);"/></span></div></td>
          <td>
          <dl class="goods-info"><dt class="goods-name"><?php echo $v['title'];?></dt>
          <dd class="goods-type">
              <?php if ($v['have_gift'] == 1) {?><span class="virtual" title="有赠品">赠</span><?php }?>
              <?php if ($v['is_own'] == 1) {?><span class="fcode" title="平台自营商品">自营</span><?php }?>
              <?php if ($v['is_presell'] == 1) {?><span class="presell" title="预先发售商品">预售</span><?php }?>
            </dd>
            </dl>
            </td>
          <td>
            <p><?php echo $category_list['data'][$v['category_id_1']]['name'].'->'.$category_list['data'][$v['category_id_2']]['name'].'->'.$category_list['data'][$v['category_id_3']]['name'];?></p>
            <p class="goods-brand">品牌：<?php if (isset($brand_list['data'][$v['id']])){echo $brand_list['data'][$v['id']]['name'];}else echo '暂无品牌信息';?></p>
            </td>
          <td class="align-center"><?php echo $v['price']?></td>
          <td class="align-center"><?php echo $goods_num[$v['id']]['stock_num']?></td>
          <td class="align-center"><?php echo $status[$v['status']];?></td>
          <td class="align-center"></td>
          <?php if(true){?>
            <td class="align-center"><a href="javascript:void(0)" target="_blank">添加到活动</a></td>
          <?php }else{?>
            <td class="align-center"><a href="javascript:void(0)" target="_blank">从活动中删除</a></td>
          <?php } ?>

        </tr>
        <tr style="display:none;">
          <td colspan="20"><div class="ncsc-goods-sku ps-container"></div></td>
        </tr>
        <?php } ?>
        <?php } else { ?>
        <tr class="no_data">
          <td colspan="15"><?php echo lang('nc_no_record');?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16"><label for="checkallBottom">全选</label>
            &nbsp;&nbsp;<a id="submit" href="javascript:void(0)" class="btn"><span>添加活动</span></a>
            <div class="pagination"><?php echo $pages;?></div></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<?php echo _get_html_cssjs('admin_js','jquery-ui/jquery.ui.js','js');?>
<?php echo _get_html_cssjs('admin_js','jquery.mousewheel.js','js');?>
<?php echo _get_html_cssjs('admin_js','common_select.js','js');?>

<script type="text/javascript">
$(document).ready(function(){

	//商品分类
	init_gcselect(<?php echo $type_json?>,<?php echo $type_json?>);
	/* AJAX选择品牌 */
    $("#ajax_brand").brandinit();

    $('#ncsubmit').click(function(){
        $('input[name="op"]').val('goods');$('#formSearch').submit();
    });

    // 违规下架批量处理
    $('a[nctype="lockup_batch"]').click(function(){
        str = getId();
        if (str) {
            goods_lockup(str);
        }
    });
    
    $("#submit").click(function(){
        $("#form_goods").submit();
    });
});
</script>
</body>
</html>
