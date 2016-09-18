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
      <h3>标准<?php echo lang('goods_index_goods');?>模板</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('goods_index_all_goods');?></span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/goods_tpl_add';?>"><span>添加模板商品</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="formSearch" id="formSearch" action="<?php echo ADMIN_SITE_URL.'/goods_tpl';?>">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="search_goods_name"> <?php echo lang('goods_index_name');?></label></th>
          <td><input type="text" value="<?php echo !empty($arrParam['search_goods_name'])?$arrParam['search_goods_name']:''?>" name="search_goods_name" id="search_goods_name" class="txt"></td>
          <th><!-- <label for="search_commonid">模板id号</label> --></th>
          <!-- <td><input type="text" value="<?//php echo !empty($arrParam['search_commonid'])?$arrParam['search_commonid']:''?>" name="search_commonid" id="search_commonid" class="txt" /></td> -->
          <th><!-- <label><?php echo lang('goods_index_class_name');?></label> --></th>
          <td id="searchgc_td"></td>
        </tr>
        <tr>
          <th><label><?php echo lang('goods_index_class_name');?></label><!-- <label><?php echo lang('goods_index_brand');?></label> --></th>
          <td>
            <!-- <div id="ajax_brand" class="ncsc-brand-select w180">
                  <div class="selection">
                  	<input name="b_name" id="b_name" value="<?php echo !empty($b_name)?$b_name:''?>" type="text" class="txt w180" readonly="readonly" />
                  	<input type="hidden" name="b_id" id="b_id" value="<?php echo !empty($b_id)?$b_id:''?>" />
                  </div>
                  <div class="ncsc-brand-select-container">
                    <div class="brand-index" data-url="goods/ajax_get_brand">
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
                      <div class="search" nctype="search"><input name="search_brand_keyword" id="search_brand_keyword" type="text" class="text" placeholder="品牌名称关键字查找"/><a href="javascript:void(0);" class="ncsc-btn-mini" style="vertical-align: top;">Go</a></div>
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
                 </div> -->
                 <span id="divCategorySelect"></span><input  type="hidden" id="choose_cid" name="choose_cid" value="<?php echo empty($arrParam['choose_cid'])?0:$arrParam['choose_cid'];?>" />
          </td>
          <th><label><?php echo lang('goods_index_show');?></label></th>
          <td><select name="search_state">
              <option value=""><?php echo lang('nc_please_choose');?>...</option>
              <option value="1"<?php if(!empty($arrParam['status']) && $arrParam['status']==1) echo ' selected';?>>上架</option>
              <option value="2"<?php if(!empty($arrParam['status']) && $arrParam['status']==2) echo ' selected';?>>下架</option>
            </select></td>
         <td ><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo lang('nc_query');?>">&nbsp;</a></td>
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
  <form method='post' id="form_goods" action="<?php echo ADMIN_SITE_URL.'/goods_tpl/lockup_save'?>">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th ></th>
          <th class="align-center">平台货号</th>
          <th class="w60 align-center"></th>
          <th >商品名称</th>
          <th ></th>
          <th >价格(元)</th>
          <th >商品状态</th>
          <th ></th>
          <th class="align-center">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($goods_list) && is_array($goods_list)) { ?>
        <?php foreach ($goods_list as $k => $v) {?>

        <tr class="hover edit">
          <td><input type="checkbox" name="id[]" value="<?php if(!empty($v['tpl_id'])) echo $v['tpl_id'];?>" class="checkitem"></td>
          <td class="align-center"><?php echo $v['tpl_id'];?></td>
          <td class="w60 picture"><div class="size-56x56"><span class="thumb size-56x56"><i></i><img src="<?php if (!empty($v['pic_path'])){echo cthumb($v['pic_path']);}else echo RES_SITE_URL.'/admin/images/default_image.png';?>" onload="javascript:DrawImage(this,56,56);"/></span></div></td>
          <td>
          <dl  class="goods-info"><dt class="goods-name"><?php echo $v['title'];?></dt>
          <dd class="goods-type">
             <!-- <span class="virtual" title="有赠品">赠</span>
             <span class="fcode" title="平台自营商品">自营</span>
             <span class="presell" title="预先发售商品">预售</span> -->
            </dd>
            </dl>
            </td>
          <td>
            <p ><?php 
              /*if(!empty($v['category_id_1']) && !empty($category_list['data'][$v['category_id_1']])) 
                echo $category_list['data'][$v['category_id_1']]['name'].'->';
              if(!empty($v['category_id_2']) && !empty($category_list['data'][$v['category_id_2']])) 
                $category_list['data'][$v['category_id_2']]['name'].'->';
              if(!empty($v['category_id_3']) && !empty($category_list['data'][$v['category_id_3']])) 
                $category_list['data'][$v['category_id_3']]['name'];*/
              ?>
            </p>
            <!-- <p class="goods-brand">品牌：<?php //if (isset($brand_list['data'][$v['brand_id']])){echo $brand_list['data'][$v['brand_id']]['name'];}else echo '暂无品牌信息';?></p> -->
            </td>
          <td ><?php echo $v['price']?></td>
          <td ><?php echo $status[$v['status']];?></td>
          <td ></td>
          <td class="align-center">
            <a href="<?php echo ADMIN_SITE_URL;?>/goods_tpl_add/add_step2?tpl_id=<?php echo $v['tpl_id'];?>"><?php echo lang('nc_edit');?></a>&nbsp;|&nbsp;
            <?php if($v['status']==1):?>
              <a href="<?php if(!empty($v['tpl_id'])) echo ADMIN_SITE_URL.'/goods_tpl/lockup_save?id='.$v['tpl_id']?>&status=2" >下架</a>
            <?php else:?>
              <a href="<?php if(!empty($v['tpl_id'])) echo ADMIN_SITE_URL.'/goods_tpl/lockup_save?id='.$v['tpl_id']?>&status=1" >上架</a>
            <?php endif?>
          </td>
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
          <td colspan="16"><label for="checkallBottom"><?php echo lang('nc_select_all'); ?></label>
            &nbsp;&nbsp;<a id="submit" href="javascript:void(0)" class="btn"><span>下架</span></a>
            <div class="pagination"><?php echo $pages;?></div></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<?php echo _get_html_cssjs('admin_js','jquery-ui/jquery.ui.js','js');?>
<?php echo _get_html_cssjs('admin_js','jquery.mousewheel.js','js');?>
<?php //echo _get_html_cssjs('admin_js','common_select.js','js');?>
<?php echo _get_html_cssjs('js','category.js,multiselect.js','js');?>

<script type="text/javascript">
$(document).ready(function(){

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

	//商品分类
	//init_gcselect(<?php //echo empty($arrParam['choose_cid'])?0:$arrParam['choose_cid'];?>,<?php //echo $type_json?>);
	/* AJAX选择品牌 */
    $("#ajax_brand").brandinit();

    $('#ncsubmit').click(function(){
        $('#formSearch').submit();
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
