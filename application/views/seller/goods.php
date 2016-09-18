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
<?php echo _get_html_cssjs('seller_js','ToolTip.js','js');?>
<div id="toolTipLayer" style="position: absolute; z-index: 999; display: none; visibility: visible; left: 172px; top: 365px;"></div>
<?php $this->load->view('seller/inc/header');?>
<div class="ncsc-layout wrapper">
  <div id="layoutLeft" class="ncsc-layout-left">
    <div id="sidebar" class="sidebar">
      <div class="column-title" id="main-nav"><span class="ico-goods"></span>
        <h2>商品</h2>
      </div>
      <div class="column-menu">
        <ul id="seller_center_left_menu">
            <!-- <li class=""> <a href="<?php //echo SELLER_SITE_URL;?>/goods_add"> 商品发布 </a> </li> -->
            <li class="<?php if(empty($arrParam['status'])) echo 'current';?>"> <a href="<?php echo SELLER_SITE_URL;?>/goods"> 出售中的商品 </a> </li>
            <!-- <li class="<?php //if(!empty($arrParam['status']) && $arrParam['status']==2) echo 'current';?>"> <a href="<?php //echo SELLER_SITE_URL;?>/goods?status=2"> 仓库中的商品 </a> </li> -->
        </ul>
      </div>
      <div class="column-menu">
        <ul id="seller_center_left_menu">
        </ul>
      </div>
    </div>
  </div>
  <div id="layoutRight" class="ncsc-layout-right">
    <div class="ncsc-path"><i class="icon-desktop"></i>商家管理中心<i class="icon-angle-right"></i>商品<i class="icon-angle-right"></i>出售中的商品</div>
    <div class="main-content" id="mainContent">
<div class="tabmenu">
  <ul class="tab pngFix">
  <li class="active"><a href="<?php echo SELLER_SITE_URL;?>/goods">出售中的商品</a></li></ul>
  <!-- <a href="<?php //echo SELLER_SITE_URL;?>/goods_add" class="ncsc-btn ncsc-btn-green" title="发布新商品"> 发布新商品</a> --></div>
<form method="get" action="<?php echo SELLER_SITE_URL.'/goods/index'?>">
    <table class="search-form">
        <input type="hidden" name="act" value="store_goods_online" />
        <input type="hidden" name="op" value="index" />
        <tr>
            <td>&nbsp;</td>
            
            <th> <select name="search_type">
                    <option value="1" <?php if (!empty($type)&&$type == 1) {?>selected="selected"<?php }?>><?php echo lang('store_goods_index_goods_name');?></option>
                    <!-- <option value="2" <?php //if (!empty($type)&&$type == 2) {?>selected="selected"<?//php }?>><?php //echo lang('store_goods_index_goods_no');?></option> -->
                    <!--<option value="2" <?php /*if (!empty($type)&&$type == 2) {*/?>selected="selected"<?php /*}*/?>>平台货号</option>-->
                </select>
            </th>
            <td class="w160"><input type="text" class="text w150" name="keyword" value="<?php echo !empty($keyword)?$keyword:''; ?>"/></td>
            <td class="tc w70"><label class="submit-border">
                    <input type="submit" class="submit" value="<?php echo lang('nc_search');?>" />
                </label></td>
        </tr>
    </table>
</form>
<table class="ncsc-default-table">
    <thead>
    <tr nc_type="table_header">
        <th class="w30">&nbsp;</th>
        <th class="w50">&nbsp;</th>
        <th coltype="editable" column="goods_name" checker="check_required" inputwidth="230px"><?php echo lang('store_goods_index_goods_name');?></th>
        <th class="w100"><?php echo lang('store_goods_index_price');?></th>
        <th class="w100"><?php echo lang('store_goods_index_stock');?></th>
        <th class="w100"><?php echo lang('store_goods_index_add_time');?></th>
        <th class="w120"><?php echo lang('nc_handle');?></th>
    </tr>
    <?php if (!empty($output['goods_list'])) { ?>
        <tr>
            <td class="tc"><input type="checkbox" id="all" class="checkall"/></td>
            <td colspan="20"><label for="all" ><?php echo lang('nc_select_all');?></label>
            <a href="javascript:void(0);" class="ncsc-btn-mini" nc_type="batchbutton" uri="<?php echo urlShop('store_goods_online', 'drop_goods');?>" name="commonid" confirm="<?php echo lang('nc_ensure_del');?>"><i class="icon-trash"></i><?php echo lang('nc_del');?></a> <a href="javascript:void(0);" class="ncsc-btn-mini" nc_type="batchbutton" uri="<?php echo urlShop('store_goods_online', 'goods_unshow');?>" name="commonid"><i class="icon-level-down"></i><?php echo lang('store_goods_index_unshow');?></a> <a href="javascript:void(0);" class="ncsc-btn-mini" nctype="batch" data-param="{url:'<?php echo urlShop('store_goods_online', 'edit_jingle');?>', sign:'jingle'}"><i></i>设置广告词</a> <a href="javascript:void(0);" class="ncsc-btn-mini" nctype="batch" data-param="{url:'<?php echo urlShop('store_goods_online', 'edit_plate');?>', sign:'plate'}"><i></i>设置关联版式</a></td>
        </tr>
    <?php } ?>
    </thead>
    <tbody>
    <?php if (!empty($list['rows'])) { ?>
        <?php foreach ($list['rows'] as $val) { ?>
            <tr>
                <th class="tc"></th>
                <th colspan="20">标准模板号：<?php echo $val['tpl_id'];?></th>
            </tr>
            <tr>
                <td class="trigger"></td>
                <td><div class="pic-thumb"><img src="<?php echo cthumb($val['pic_path']);?>"/></a></div></td>
                <td class="tl"><dl class="goods-name">
                        <dt style="max-width: 450px !important;">
                            <?php /*if ($val['is_virtual'] ==1) {*/?><!--
                                <span class="type-virtual" title="虚拟兑换商品">虚拟</span>
                            <?php /*}*/?>
                            <?php /*if ($val['is_fcode'] ==1) {*/?>
                                <span class="type-fcode" title="F码优先购买商品">F码</span>
                            <?php /*}*/?>
                            <?php /*if ($val['is_presell'] ==1) {*/?>
                                <span class="type-presell" title="预先发售商品">预售</span>
                            <?php /*}*/?>
                            <?php /*if ($val['is_appoint'] ==1) {*/?>
                                <span class="type-appoint" title="预约销售提示商品">预约</span>
                            --><?php /*}*/?>
                            <a href="<?php echo urlShop('seller/goods_add', 'add_step2',array('id'=>$val['id']));?>"><?php echo $val['title']; ?></dt>
                        <dd><?php echo lang('store_goods_index_goods_no').lang('nc_colon');?><?php echo $val['id'];?></dd>
                        <dd class="serve">
                        <!--    <span class="<?php /*if ($val['goods_commend'] == 1) { echo 'open';}*/?>" title="店铺推荐商品">
                            <i class="commend">荐</i></span>
                            <span class="<?php /*if ($val['mobile_body'] != '') { echo 'open';}*/?>" title="手机端商品详情">
                            <i class="icon-tablet"></i></span>
                            <span class="" title="商品页面二维码"><i class="icon-qrcode"></i>
                            <div class="QRcode">
                                <a target="_blank" href="">下载标签</a>
                                <p><img src=""/></p>
                            </div>
                            </span>
                            <?php /*if ($val['is_fcode'] ==1) {*/?>
                                <span><a class="ncsc-btn-mini ncsc-btn-red" href="<?php /*echo urlShop('store_goods_online', 'download_f_code_excel', array('commonid' => $val['goods_commonid']));*/?>">下载F码</a></span>
                            --><?php /*}*/?>
                        </dd>
                    </dl>
                </td>
                <td><span><?php echo lang('currency').$val['price']; ?></span></td>
                <td><?php echo $val['stock_num'].lang('piece'); ?></span></td>
                <td class="goods-time"><?php echo @date('Y-m-d',$val['addtime']);?></td>
                <td class="nscs-table-handle">
                <span class="tip" title="调整价格，需要总台审核哦~ 不会影响商品销售">
                    <a href="<?php echo urlShop('seller/goods_add', 'add_step2',array('id'=>$val['id']));?>" class="btn-orange-current">
                        <p>修改</p>
                    </a></span>
                   </td>
            </tr>
            <tr style="display:none;">
                <td colspan="20"><div class="ncsc-goods-sku ps-container"></div></td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="20" class="norecord"><div class="warning-option"><i class="icon-warning-sign"></i><span><?php echo lang('no_record');?></span></div></td>
        </tr>
    <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="20"><div class="pagination"> <?php echo $list['pages'];?> </div></td>
        </tr>
    </tfoot>
</table>
</div>
  </div>
</div>

<?php echo _get_html_cssjs('seller_js','common_select.js,jquery.mousewheel.js,shop_goods_add.step1.js,jquery.cookie.js,perfect-scrollbar.min.js,jquery.qtip.min.js,compare.js,store_goods_list.js,jquery.poshytip.min.js','js');?>
<?php $this->load->view('seller/inc/footer');?>
<script>
    $(function(){
        //Ajax提示
        $('.tip').poshytip({
            className: 'tip-yellowsimple',
            showTimeout: 1,
            alignTo: 'target',
            alignX: 'center',
            alignY: 'top',
            offsetY: 5,
            allowTipHover: false
        });
        $('a[nctype="batch"]').click(function(){
            if($('.checkitem:checked').length == 0){    //没有选择
                showDialog('请选择需要操作的记录');
                return false;
            }
            var _items = '';
            $('.checkitem:checked').each(function(){
                _items += $(this).val() + ',';
            });
            _items = _items.substr(0, (_items.length - 1));

            var data_str = '';
            eval('data_str = ' + $(this).attr('data-param'));

            if (data_str.sign == 'jingle') {
                ajax_form('ajax_jingle', '设置广告词', data_str.url + '&commonid=' + _items + '&inajax=1', '480');
            } else if (data_str.sign == 'plate') {
                ajax_form('ajax_plate', '设置关联版式', data_str.url + '&commonid=' + _items + '&inajax=1', '480');
            }
        });
    });
</script>
