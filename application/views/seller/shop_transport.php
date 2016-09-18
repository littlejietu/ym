<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>商家中心</title>

<?php echo _get_html_cssjs('seller_css','base.css,seller_center.css','css');?>
<?php echo _get_html_cssjs('font','font-awesome/css/font-awesome.min.css','css');?>
<!--[if IE 7]>
  <?php echo _get_html_cssjs('font','font-awesome/font-awesome-ie7.min.css','css');?>
<![endif]-->
<script>
var COOKIE_PRE = '<?php echo COOKIE_PRE;?>';
var _CHARSET = '<?php echo strtolower(CHARSET);?>';
var SITEURL = '<?php echo BASE_SITE_URL;?>';
</script>
<?php echo _get_html_cssjs('seller_js','jquery.js,waypoints.js,jquery-ui/jquery.ui.js,jquery.validation.min.js,common.js,member.js','js');?>
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
<div class="ncsc-layout wrapper">
    <div id="layoutLeft" class="ncsc-layout-left">
        <div id="sidebar" class="sidebar">
            <div class="column-title" id="main-nav"><span class="ico-order"></span>
                <h2>订单物流</h2>
            </div>
            <div class="column-menu">
                <ul id="seller_center_left_menu">
                    <li class=""> <a href="/seller/order"> 交易订单 </a> </li>
                    <li class=""> <a href="/seller/order?type=2"> 发货 </a> </li>
                    <!-- <li class="current"> <a href="/seller/shop_transport"> 运单模板 </a> </li> -->
                </ul>
            </div>
        </div>
    </div>
    <div id="layoutRight" class="ncsc-layout-right">
        <div class="tabmenu">
            <a class="ncsc-btn ncsc-btn-green" href="<?php echo SELLER_SITE_URL.'/shop_transport/add'?>"><?php echo lang('transport_tpl_add');?> </a> </div>
        <!-----------------list begin------------------------>
        <?php if (!empty($trans)){?>
            <table class="ncsc-default-table order">
                <thead>
                <tr>
                    <th class="w120"><?php echo lang('transport_type');?></th>
                    <th class="cell-area tl"><?php echo lang('transport_to');?></th>
                    <th class="w100"><?php echo lang('transport_snum');?></th>
                    <th class="w100"><?php echo lang('transport_price');?></th>
                    <th class="w100"><?php echo lang('transport_xnum');?></th>
                    <th class="w100"><?php echo lang('transport_price');?></th>
                </tr>
                </thead>
                <?php foreach ($trans as $v){?>
                    <tbody>
                    <tr>
                        <td colspan="20" class="sep-row"></td>
                    </tr>
                    <tr>
                        <th colspan="20">
                            <a class="ml5 ncsc-btn-mini ncsc-btn-orange" data-param="{name:'<?php echo $v['title'];?>',id:'<?php echo $v['id'];?>',price:''}" href="javascript:void(0)"><i class="icon-truck"></i><?php echo lang('transport_applay');?></span></a>
                            <h3><?php echo $v['title'];?></h3>

        <span class="fr mr5">
        <time title="<?php echo lang('transport_tpl_edit_time');?>"><i class="icon-time"></i><?php echo date('Y-m-d H:i:s',$v['updatetime']);?></time>
        <a class="J_Clone ncsc-btn-mini" href="javascript:void(0)" data-id="<?php echo $v['id'];?>"><i class="icon-copy"></i><?php echo lang('transport_tpl_copy');?></a> <a class="J_Modify ncsc-btn-mini" href="javascript:void(0)" data-id="<?php echo $v['id'];?>"><i class="icon-edit"></i><?php echo lang('transport_tpl_edit');?></a> <a class="J_Delete ncsc-btn-mini" href="javascript:void(0)" data-id="<?php echo $v['id'];?>"><i class="icon-trash"></i><?php echo lang('transport_tpl_del');?></a></span></th>
                    </tr>
                    <?php foreach ($tpl_trans as $value){?>
                        <?php if ($value['transport_id'] == $v['id']){?>
                            <tr>
                                <td class="bdl"></td>
                                <td class="cell-area tl"><?php echo $value['area_name'];?></td>
                                <td><?php echo $value['snum'];?></td>
                                <td><?php echo $value['sprice'];?></td>
                                <td><?php echo $value['xnum'];?></td>
                                <td class="bdr"><?php echo $value['xprice'];?></td>
                            </tr>
                        <?php }?>
                    <?php }?>
                    </tbody>
                <?php }?>
            </table>
        <?php } else {?>
          <!--  <div class="warning-option"><i class="icon-warning-sign"></i><span><?php /*echo lang('no_record');*/?></span></div>-->
        <?php } ?>
        <?php if (is_array($trans)){?>
            <div class="pagination"><?php echo $pages;?></div>
        <?php }?>
        <!-----------------list end----------------------->


    </div>
</div>

<script>
$(function(){	
	$('a[class="J_Delete ncsc-btn-mini"]').click(function(){
		var id = $(this).attr('data-id');
		if(typeof(id) == 'undefined') return false;
		get_confirm('<?php echo lang('transport_del_confirm');?>','<?php echo SELLER_SITE_URL;?>/shop_transport/del?id='+id);
//		$(this).attr('href','<?php echo SELLER_SITE_URL;?>/shop_transport/del?id='+id);
//		return true;
	});

	$('a[class="J_Modify ncsc-btn-mini"]').click(function(){
		var id = $(this).attr('data-id');
		if(typeof(id) == 'undefined') return false;
		$(this).attr('href','<?php echo SELLER_SITE_URL;?>/shop_transport/edit?id='+id);
		return true;
	});
	
	$('a[class="J_Clone ncsc-btn-mini"]').click(function(){
		var id = $(this).attr('data-id');
		if(typeof(id) == 'undefined') return false;
		$(this).attr('href','<?php echo SELLER_SITE_URL;?>/shop_transport/clone_tpl?id='+id);
		return true;
	});
	$('a[class="ml5 ncsc-btn-mini ncsc-btn-orange"]').click(function(){
		var data_str = '';
		eval('data_str = ' + $(this).attr('data-param'));
		$("#postageName", opener.document).css('display','inline-block').html(data_str.name);
		$("#transport_title", opener.document).val(data_str.name);
		$("#transport_id", opener.document).val(data_str.id);
		$("#g_freight", opener.document).val(data_str.price);
		window.close();
	});	

});
</script>
</body>
</html>