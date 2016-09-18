<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>商家中心</title>
<?php echo _get_html_cssjs('seller_css','base.css,seller_center.css,perfect-scrollbar.min.css,jquery.qtip.min.css','css');?>
<?php echo _get_html_cssjs('font','font-awesome/css/font-awesome.min.css','css');?>
<!--[if IE 7]>
  <?php echo _get_html_cssjs('font','font-awesome/font-awesome-ie7.min.css','css');?>
<![endif]-->
<script>
var COOKIE_PRE = '<?php echo COOKIE_PRE;?>';
var _CHARSET = '<?php echo strtolower(CHARSET);?>';
var SITEURL = '<?php echo BASE_SITE_URL;?>';
</script>
<?php echo _get_html_cssjs('seller_js','jquery.js,seller.js,waypoints.js,jquery-ui/jquery.ui.js,jquery.validation.min.js,common.js,member.js','js');?>
<script type="text/javascript" src="<?php echo _get_cfg_path('lib');?>dialog/dialog.js" id="dialog_js" charset="utf-8"></script>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<?php echo _get_html_cssjs('seller_js','html5shiv.js,respond.min.js','js');?>
<![endif]-->
<!--[if IE 6]>
<?php echo _get_html_cssjs('seller_js','IE6_MAXMIX.js,IE6_PNG.js','js');?>
<script>
DD_belatedPNG.fix('.pngFix');
</script>
<script>
// <![CDATA[
if((window.navigator.appName.toUpperCase().indexOf("MICROSOFT")>=0)&&(document.execCommand))
try{
document.execCommand("BackgroundImageCache", false, true);
   }
catch(e){}
// ]]>
</script>
<![endif]-->

</head>
<body>
<?php $this->load->view('seller/inc/header');?>

<?php echo _get_html_cssjs('seller_js','ToolTip.js','js');?>

<div class="ncsc-layout wrapper">
  <div id="layoutLeft" class="ncsc-layout-left">
    <div id="sidebar" class="sidebar">
      <div class="column-title" id="main-nav"><span class="ico-goods"></span>
        <h2>商品</h2>
      </div>
      <div class="column-menu">
        <ul id="seller_center_left_menu">
            <li class="current"> <a href="<?php echo SELLER_SITE_URL;?>/goods_add"> 商品发布 </a> </li>
            <li class=""> <a href="<?php echo SELLER_SITE_URL;?>/goods"> 出售中的商品 </a> </li>
            <li class=""> <a href="<?php echo SELLER_SITE_URL;?>/goods?status=2"> 仓库中的商品 </a> </li>
        </ul>
      </div>
    </div>
  </div>
  <div id="layoutRight" class="ncsc-layout-right">
    <div class="ncsc-path"><i class="icon-desktop"></i>商家管理中心<i class="icon-angle-right"></i>首页<i class="icon-angle-right"></i></div>
    <div class="main-content" id="mainContent">
      <ul class="add-goods-step">
        <li class="current"><i class="icon icon-list-alt"></i>
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
        <li><i class="icon icon-ok-circle"></i>
          <h6>STEP.4</h6>
          <h2>商品发布成功</h2>
        </li>
      </ul>
      
      <div class="wrapper_search">
        <div class="wp_sort">
          <div id="dataLoading" class="wp_data_loading">
            <div class="data_loading"><?php echo lang('store_goods_step1_loading');?></div>
          </div>
          <div id="class_div" class="wp_sort_block">
            <div class="sort_list">
              <div class="wp_category_list">
                <div id="class_div_1" class="category_list">
                  <ul>
                    <?php if(isset($output['goods_class']) && !empty($output['goods_class']) ) {?>
                    <?php foreach ($output['goods_class'] as $val) {?>
                    <li class="" nctype="selClass" data-param="{cid:<?php echo $val['id'];?>,deep:1}"> <a class="" href="javascript:void(0)"><i class="icon-double-angle-right"></i><?php echo $val['name'];?></a></li>
                    <?php }?>
                    <?php }?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="sort_list">
              <div class="wp_category_list blank">
                <div id="class_div_2" class="category_list">
                  <ul>
                  </ul>
                </div>
              </div>
            </div>
            <div class="sort_list sort_list_last">
              <div class="wp_category_list blank">
                <div id="class_div_3" class="category_list">
                  <ul>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="sort_selector">
          <table>
            <tr><td>标准商品模板：</td>
              <td><input type="text" class="text w200 valid" name="tpl_title" id="tpl_title" placeholder="商品名称">&nbsp;</td>
              <td><input type="button" class="submit" id="btnTplSearch" value="搜索" ></td>
              <td><span id="tpl_id_msg"></span></td>
            </tr>
          </table>
        </div>

        <div class="alert">
          <dl class="hover_tips_cont">
            <dt id="commodityspan"><span style="color:#F00;"><?php echo lang('store_goods_step1_please_choose_category');?></span></dt>
            <dt id="commoditydt" style="display: none;" class="current_sort"><?php echo lang('store_goods_step1_current_choose_category');?><?php echo lang('nc_colon');?></dt>
            <dd id="commoditydd"></dd>
          </dl>
        </div>
        <div class="wp_confirm">
          <input type="hidden" name="cid" id="class_id" value="" />
          <form method="get" action="<?php echo SELLER_SITE_URL.'/goods_add/add_step2';?>">
            <div class="bottom tc" id="div_tpl_id" style="display:none">
              <select id="tpl_id" name="tpl_id">
                </select>
            </div>
            <div class="bottom tc">
              <label class="submit-border"><input disabled="disabled" nctype="buttonNextStep" value="<?php echo lang('store_goods_add_next');?>，填写商品信息" type="submit" class="submit"style=" width: 200px;" /></label>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo _get_html_cssjs('seller_js','common_select.js,jquery.mousewheel.js,shop_goods_add.step1.js,jquery.cookie.js,perfect-scrollbar.min.js,jquery.qtip.min.js,compare.js','js');?>
<?php $this->load->view('seller/inc/footer');?>
</body>
</html>