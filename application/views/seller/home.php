<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>商家中心</title>
  <?php echo _get_html_cssjs('seller_css','base.css,seller_center.css,perfect-scrollbar.min.css,jquery.qtip.min.css','css');?>
  <?php echo _get_html_cssjs('font','font-awesome/css/font-awesome.min.css','css');?>
<!--[if IE 7]>
  <?php echo _get_html_cssjs('seller_css','font-awesome-ie7.min.css','css');?>
<![endif]-->
<script>
var COOKIE_PRE = '<?php echo COOKIE_PRE;?>';
var _CHARSET = '<?php echo strtolower(CHARSET);?>';
var SITEURL = '<?php echo BASE_SITE_URL;?>';
var RESOURCE_SITE_URL = '<?php //echo RESOURCE_SITE_URL;?>';
var SHOP_RESOURCE_SITE_URL = '<?php //echo SHOP_RESOURCE_SITE_URL;?>';
var SHOP_TEMPLATES_URL = '<?php //echo SHOP_TEMPLATES_URL;?>';
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
<?php //echo _get_html_cssjs('seller_js','ToolTip.js','js');?>
</head>
<body>
<?php $this->load->view('seller/inc/header');?>

<div class="ncsc-layout wrapper">
  <div id="layoutLeft" class="ncsc-layout-left">
    <div id="sidebar" class="sidebar">
      <div class="column-title" id="main-nav"><span class="ico-index"></span>
        <h2>首页</h2>
      </div>
      <div class="column-menu">
        <!-- <ul id="seller_center_left_menu">
                              <div class="add-quickmenu"><a href="javascript:void(0);"><i class="icon-plus"></i>添加常用功能菜单</a></div>
                            </ul> -->
      </div>
    </div>
  </div>
  <div id="layoutRight" class="ncsc-layout-right">
    <div class="ncsc-path"><i class="icon-desktop"></i>商家管理中心<i class="icon-angle-right"></i>首页<i class="icon-angle-right"></i></div>
    <div class="main-content" id="mainContent">

<div class="ncsc-index">
  <div class="top-container">
    <div class="basic-info">
      <dl class="ncsc-seller-info">
        <dt class="seller-name">
          <h3><?php echo $output['loginUser']['shop_name']?></h3>
          <h5>(用户名：<?php echo $output['loginUser']['seller_username']?>)</h5>
        </dt>
      </dl>

    </div>
  </div>
  <div class="seller-cont">
    <div class="container type-a">
      <div class="hd">
        <h3>店铺及商品提示</h3>
        <h5>您需要关注的店铺信息以及待处理事项</h5>
      </div>
      <div class="content">
        <dl class="focus">
          <dt>店铺商品发布情况：</dt>
          <dd title="已发布/可传商品"><em id="nc_goodscount">0</em>&nbsp; </dd>
        </dl>
        <ul>
          <li><a href="<?php echo SELLER_SITE_URL;?>/goods">出售中 <strong id="nc_online"></strong></a></li>
          <!-- <li><a href="<?php //echo SELLER_SITE_URL;?>/goods?status=2">仓库中已审核 <strong id="nc_offline"></strong></a></li> -->
          <!-- <li><a href="index.php?act=store_goods_offline&op=index&type=lock_up">违规下架 <strong id="nc_lockup"></strong></a></li> -->
        </ul>
      </div>
    </div>
    <div class="container type-a">
      <div class="hd">
        <h3>交易提示</h3>
        <h5>您需要立即处理的交易订单</h5>
      </div>
      <div class="content">
        <dl class="focus">
          <dt>近期售出：</dt>
          <dd><a href="<?php echo SELLER_SITE_URL;?>/order">交易中的订单 <strong id="nc_progressing"></strong></a></dd>
          
        </dl>
        <ul>
          <li><a href="<?php echo SELLER_SITE_URL;?>/order?type=1"> 待付款 <strong id="nc_payment"></strong></a></li>
          <li><a href="<?php echo SELLER_SITE_URL;?>/order?type=2"> 待发货 <strong id="nc_delivery"></strong></a></li>
          <li><a href="<?php echo SELLER_SITE_URL;?>/order?type=3"> 已发货 <strong id="nc_refund_lock"></strong></a></li>
          <li><a href="<?php echo SELLER_SITE_URL;?>/order?type=5"> 已取消 <strong id="nc_return_lock"></strong></a></li>
        </ul>
      </div>
    </div>
    
    
  </div>
</div>
<script>
// $(function(){
// 	var timestamp=Math.round(new Date().getTime()/1000/60);//异步URL一分钟变化一次
//     $.getJSON('index.php?act=seller_center&op=statistics&rand='+timestamp, null, function(data){
//         if (data == null) return false;
//         for(var a in data) {
//             if(data[a] != 'undefined' && data[a] != 0) {
//                 var tmp = '';
//                 if (a != 'goodscount' && a != 'imagecount') {
//                     $('#nc_'+a).parents('a').addClass('num');
//                 }
//                 $('#nc_'+a).html(data[a]);
//             }
//         }
//     });
// });
</script>
    </div>
  </div>
</div>

<?php $this->load->view('seller/inc/footer');?>
</body>
</html>