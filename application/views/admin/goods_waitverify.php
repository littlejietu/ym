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
        <li><a href="<?php echo ADMIN_SITE_URL.'/goods'?>"><span><?php echo lang('goods_index_all_goods');?></span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/goods/goods_lockup'?>" ><span><?php echo lang('goods_index_lock_goods');?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>等待审核</span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/goods/goods_set'?>"><span><?php echo lang('nc_goods_set');?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="formSearch" id="formSearch" action="<?php echo ADMIN_SITE_URL.'/goods/goods_waitverify'?>">
    <input type="hidden" name="act" value="goods" />
    <input type="hidden" name="op" value="goods" />
    <input type="hidden" name="type" value="waitverify" />
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th> <label for="search_goods_name"><?php echo lang('goods_index_name');?></label></th>
          <td><input type="text" value="<?php if (!empty($arrParam['search_goods_name'])){echo $arrParam['search_goods_name'];}?>" name="search_goods_name" id="search_goods_name" class="txt"></td>
          <th>审核状态</th>
          <td><select name="search_verify">
              <option value="0">请选择...</option>
              <option value="3" <?php if (!empty($arrParam['search_verify']) && $arrParam['search_verify'] == 3){?>selected="selected"<?php }?>>等待审核</option>
              <option value="4" <?php if (!empty($arrParam['search_verify']) && $arrParam['search_verify'] == 4){?>selected="selected"<?php }?>>未通过</option>
              </select>
          </td>
          <th><label>分类</label></th>
          <td id="searchgc_td"></td>
          <input type="hidden" id="choose_gcid" name="choose_gcid" value="0"/>
        </tr>
        <tr>
          <th><label for="search_store_name"><?php echo lang('goods_index_store_name');?></label></th>
          <td><input type="text" value="<?php if (!empty($arrParam['search_store_name'])){echo $arrParam['search_store_name'];}?>" name="search_store_name" id="search_store_name" class="txt"></td>
          <th><label><?php echo lang('goods_index_brand');?></label></th>
          <td><div id="ajax_brand" class="ncsc-brand-select w180">
              <div class="selection">
                <input name="b_name" id="b_name" value="<?php if (!empty($arrParam['b_name'])){echo $arrParam['b_name'];}?>" type="text" class="txt w180" readonly="readonly" />
                <input type="hidden" name="b_id" id="b_id" value="<?php if (!empty($arrParam['b_id'])){echo $arrParam['b_id'];}?>" />
              </div>
              <div class="ncsc-brand-select-container">
                <div class="brand-index" data-url="ajax_get_brand">
                  <div class="letter" nctype="letter">
                    <ul>
                      <li><a href="javascript:void(0);" data-letter="all">全部品牌</a></li>
                      <li><a href="javascript:void(0);" data-letter="A">A</a></li>
                      <li><a href="javascript:void(0);" data-letter="B">B</a></li>
                      <li><a href="javascript:void(0);" data-letter="C">C</a></li>
                      <li><a href="javascript:void(0);" data-letter="D">D</a></li>
                      <li><a href="javascript:void(0);" data-letter="E">E</a></li>
                      <li><a href="javascript:void(0);" data-letter="F">F</a></li>
                      <li><a href="javascript:void(0);" data-letter="G">G</a></li>
                      <li><a href="javascript:void(0);" data-letter="H">H</a></li>
                      <li><a href="javascript:void(0);" data-letter="I">I</a></li>
                      <li><a href="javascript:void(0);" data-letter="J">J</a></li>
                      <li><a href="javascript:void(0);" data-letter="K">K</a></li>
                      <li><a href="javascript:void(0);" data-letter="L">L</a></li>
                      <li><a href="javascript:void(0);" data-letter="M">M</a></li>
                      <li><a href="javascript:void(0);" data-letter="N">N</a></li>
                      <li><a href="javascript:void(0);" data-letter="O">O</a></li>
                      <li><a href="javascript:void(0);" data-letter="P">P</a></li>
                      <li><a href="javascript:void(0);" data-letter="Q">Q</a></li>
                      <li><a href="javascript:void(0);" data-letter="R">R</a></li>
                      <li><a href="javascript:void(0);" data-letter="S">S</a></li>
                      <li><a href="javascript:void(0);" data-letter="T">T</a></li>
                      <li><a href="javascript:void(0);" data-letter="U">U</a></li>
                      <li><a href="javascript:void(0);" data-letter="V">V</a></li>
                      <li><a href="javascript:void(0);" data-letter="W">W</a></li>
                      <li><a href="javascript:void(0);" data-letter="X">X</a></li>
                      <li><a href="javascript:void(0);" data-letter="Y">Y</a></li>
                      <li><a href="javascript:void(0);" data-letter="Z">Z</a></li>
                      <li><a href="javascript:void(0);" data-letter="0-9">其他</a></li>
                    </ul>
                  </div>
                  <div class="search" nctype="search">
                    <input name="search_brand_keyword" id="search_brand_keyword" type="text" class="text" placeholder="品牌名称关键字查找"/>
                    <a href="javascript:void(0);" class="ncsc-btn-mini" style="vertical-align: top;">Go</a></div>
                </div>
                <div class="brand-list" nctype="brandList">
                  <ul nctype="brand_list">
                    <?php if(is_array($brand_list['data']) && !empty($brand_list['data'])){?>
                    <?php foreach($brand_list['data'] as $val) { ?>
                    <li data-id='<?php echo $val['id'];?>'data-name='<?php echo $val['name'];?>'><em><?php echo $val['initial'];?></em><?php echo $val['name'];?></li>
                    <?php } ?>
                    <?php }?>
                  </ul>
                </div>
                <div class="no-result" nctype="noBrandList" style="display: none;">没有符合"<strong>搜索关键字</strong>"条件的品牌</div>
              </div>
            </div></td>
          <td><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo lang('nc_query');?>">&nbsp;</a></td>
        </tr>
      </tbody>
    </table>
  </form>
  <form method='post' id="form_goods" action="">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15"><?php echo lang('nc_list');?></th>
        </tr>
        <tr class="thead">
          <th class="w24"></th>
          <th class="w24"></th>
          <th class="w60">平台货号</th>
          <th colspan="2"><?php echo lang('goods_index_name');?></th>
          <th><?php echo lang('goods_index_brand');?>&<?php echo lang('goods_index_class_name');?></th>
          <th class="w72 align-center">价格（元）</th>
          <th class="w72 align-center">库存</th>
          <th class="w72 align-center">审核状态</th>
          <th class="w96 align-center"><?php echo lang('nc_handle');?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($goods_list) && is_array($goods_list)){ ?>
        <?php foreach($goods_list as $k => $v){  ?>
        <tr class="hover edit">
          <td><input type="checkbox" name="id[]" value="<?php echo 'goods_commonid';?>" class="checkitem"></td>
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
              <dd class="goods-store"></dd>
            </dl></td>
          <td>
            <p><?php echo $category_list['data'][$v['category_id_1']]['name'].'->'.$category_list['data'][$v['category_id_2']]['name'].'->'.$category_list['data'][$v['category_id_3']]['name'];?></p>
            <p class="goods-brand">品牌：<?php if (isset($brand_list['data'][$v['brand_id']])){echo $brand_list['data'][$v['brand_id']]['name'];}else echo '暂无品牌信息';?></p>
            </td>
          <td class="align-center"><?php echo lang('currency').$v['price'];?></td>
          <td class="align-center"><?php echo $goods_num[$v['id']]['stock_num'];?></td>
          <td class="align-center"><p><?php echo $status[$v['status']]?></p>
            <?php if ($v['status'] == 0) {?>
            <p><?php echo $v['goods_verifyremark'];?></p>
            <?php }?></td>
          <td class="w48 align-center"><a href="" target="_blank"><?php echo lang('nc_view');?></a>&nbsp;|&nbsp;<a href="<?php echo ADMIN_SITE_URL.'/goods/verify?id='.$v['id']?>" >审核</a></td>
        </tr>
        <tr style="display:none;">
          <td colspan="20"><div class="ncsc-goods-sku ps-container"></div></td>
        </tr>
        <?php } ?>
        <?php } else { ?>
        <tr class="no_data">
          <td colspan="10"><?php echo lang('nc_no_record');?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16"><label for="checkallBottom"><?php echo lang('nc_select_all'); ?></label>
            &nbsp;&nbsp;<a href="javascript:void(0);" class="btn" nctype="verify_batch"><span>审核</span></a>
            <div class="pagination"> <?php echo $pages;?> </div></td>
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
	init_gcselect();
	/* AJAX选择品牌 */
    $("#ajax_brand").brandinit();
	
    $("#submit").click(function(){
        $("#form_goods").submit();
    });
    $("#ncsubmit").click(function(){
        $("#formSearch").submit();
    });
});
</script>
</body>
</html>
