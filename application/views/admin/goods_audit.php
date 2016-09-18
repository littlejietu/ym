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
      <h3><?php echo lang('goods_index_goods');?>价格审核管理</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('goods_index_all_goods');?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="formSearch" id="formSearch" action="<?php echo ADMIN_SITE_URL.'/goods_audit/index'?>">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="search_goods_name"> <?php echo lang('goods_index_name');?></label></th>
          <td><input type="text" value="<?php if (!empty($search_goods_name)){echo $search_goods_name;}?>" name="search_goods_name" id="search_goods_name" class="txt"></td>
          <th><label for="search_commonid">平台货号</label></th>
          <td><input type="text" value="<?php if (!empty($search_commonid)){echo $search_commonid;}?>" name="search_commonid" id="search_commonid" class="txt" /></td>
          <th><label></label></th>
          <td id="searchgc_td"></td>
        </tr>
        <tr>
          <th><label for="search_store_name"><?php echo lang('goods_index_store_name');?></label></th>
          <td><input type="text" value="<?php if (!empty($search_store_name)){echo $search_store_name;}?>" name="search_store_name" id="search_store_name" class="txt"></td>
          <th><label><?php echo lang('goods_index_class_name');?><?php //echo lang('goods_index_brand');?></label></th>
          <td>
              <span id="divCategorySelect"></span><input  type="hidden" id="choose_cid" name="choose_cid" value="<?php echo empty($arrParam['choose_cid'])?0:$arrParam['choose_cid'];?>" />
          </td>
          <th><label><?php //echo lang('goods_index_show');?></label></th>
          <td><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo lang('nc_query');?>">&nbsp;</a></td>
         <td ></td>
          <td class="w120">&nbsp;</td>
        </tr>
      </tbody>
    </table>
  </form>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title">
            <h5><?php echo lang('nc_prompts');?></h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li><?php echo lang('goods_index_help1');?></li>
            <li><?php echo lang('goods_index_help2');?></li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method='post' id="form_goods" action="<?php echo ADMIN_SITE_URL.'/goods_audit/save'?>">
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24"></th>
          <th class="w24"></th>
          <th class="w60 align-center">商家货号</th>
          <th colspan="2"><?php echo lang('goods_index_name');?></th>
          <th class="w72 align-center"></th>
          <th class="w72 align-center">销售价(元)</th>
          <th class="w72 align-center">成本价(元)</th>
          <th class="w72 align-center">库存</th>
          <th class="w72 align-center">商品状态</th>
          <th class="w250 align-center">待审核销售价</th>
          <th class="align-center">待审核成本价</th>

        </tr>
      </thead>
      <tbody>
        <?php if (!empty($goods_list) && is_array($goods_list)) { ?>
        <?php foreach ($goods_list as $k => $v) {?>
        <tr class="hover edit">
          <td><input type="checkbox" name="audit[<?php echo $v['id'];?>][id]" value="<?php echo $v['id'];?>" class="checkitem"></td>
          <td></td>
          <td class="align-center"><?php echo $v['id'];?></td>
          <td class="w60 picture"><div class="size-56x56"><span class="thumb size-56x56"><i></i><img src="<?php if (!empty($v['pic_path'])){echo cthumb($v['pic_path']);}else echo RES_SITE_URL.'/admin/images/default_image.png';?>" onload="javascript:DrawImage(this,56,56);"/></span></div></td>
          <td>
          <dl class="goods-info"><dt class="goods-name"><?php echo $v['title'];?></dt>
          <!-- <dd class="goods-type">
              <?php //if ($v['have_gift'] == 1) {?><span class="virtual" title="有赠品">赠</span><?php //}?>
              <?php //if ($v['is_own'] == 1) {?><span class="fcode" title="平台自营商品">自营</span><?php //}?>
              <?php //if ($v['is_presell'] == 1) {?><span class="presell" title="预先发售商品">预售</span><?php //}?>
            </dd> -->
            </dl>
            </td>
          <td>
           
            </td>
          <td class="align-center"><?php echo $v['price']?></td>
          <td class="align-center"><?php echo $v['cost_price']?></td>
          <td class="align-center"><?php echo $v['stock_num']?></td>
          <td class="align-center"><?php echo $status[$v['status']];?></td>
          <td class="align-center">
            <?php if(!empty($v['sku'])):?>
              <table align="center">
                <?php foreach ($v['sku'] as $kk => $aa):
                ?>
                <tr>
                  <td><?php echo $aa['sku_title'];?></td>
                  <td><input name="audit[<?php echo $v['id'];?>][sku_price][<?php echo $aa['id'];?>]" value="<?php echo $aa['audit_price']==0?$aa['price']:$aa['audit_price'];?>" class="txt w30"></td>
                </tr>
                <?php endforeach;?>
              </table>
            <?php else:?>
              <input name="audit[<?php echo $v['id'];?>][price]" value="<?php echo $v['audit_price']==0?$v['price']:$v['audit_price'];?>" class="txt w30">
            <?php endif?>
          </td>
          <td class="align-center">
            <?php if(!empty($v['sku'])):?>
              <table align="center">
                <?php foreach ($v['sku'] as $kk => $aa):
                ?>
                <tr>
                  <td><?php echo $aa['sku_title'];?></td>
                  <td><input name="audit[<?php echo $v['id'];?>][sku_cost_price][<?php echo $aa['id'];?>]" value="<?php echo $aa['audit_cost_price']==0?$aa['cost_price']:$aa['audit_cost_price'];?>" class="txt w30"></td>
                </tr>
                <?php endforeach;?>
              </table>
            <?php else:?>
              <input name="audit[<?php echo $v['id'];?>][cost_price]" value="<?php echo $v['audit_cost_price']==0?$v['cost_price']:$v['audit_cost_price'];?>" class="txt w30">
            <?php endif?>
          </td>
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
          <td colspan="16"><label for="checkallBottom"><?php echo lang('nc_select_all'); ?></label>
            &nbsp;&nbsp;<a id="submit" href="javascript:void(0)" class="btn"><span>审核通过</span></a>
            <div class="pagination"><?php echo $pages;?></div></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<?php echo _get_html_cssjs('admin_js','jquery-ui/jquery.ui.js','js');?>
<?php echo _get_html_cssjs('admin_js','jquery.mousewheel.js','js');?>
<?php echo _get_html_cssjs('js','category.js,multiselect.js','js');?>

<script type="text/javascript">
$(document).ready(function(){


	//商品分类
  if(typeof($('#choose_cid').val())!="undefined")
  {
    var multiSelect         = new MultiSelect('divCategorySelect','choose_cid',dataMultiArea,dataAllArea);
      multiSelect.pLabels  = '一级分类,二级分类,三级分类';
      //multiSelect.pClass   = 'w70 mr5';
      multiSelect.pNames  = 'category_id_1,category_id_2,category_id_3';
      multiSelect.pStart  = 1;
      multiSelect.init(top_id);
      var initId = $('#choose_cid').val();
      if(initId=='' || initId==0)
        initId = top_id;
      multiSelect.select(initId);
      // $("#divAreaSelect select").each(function(){
      //   $(this).addClass("select-style");
      //       //$(this).wrap('<span class="standard_select"><span class="select_shelter"></span></span></div>');
      //   });
  }

	/* AJAX选择品牌 */
    //$("#ajax_brand").brandinit();

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
