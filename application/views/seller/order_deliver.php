<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>商家中心</title>
    <?php echo _get_html_cssjs('seller_css','base.css,seller_center.css,perfect-scrollbar.min.css,jquery.qtip.min.css','css');?>
    <?php echo _get_html_cssjs('font','font-awesome/css/font-awesome.min.css','css');?>
    <?php echo _get_html_cssjs('lib','jquery-ui/themes/ui-lightness/jquery.ui.css','css');?>
    <!--    --><?php //echo _get_html_cssjs('lib','jquery-ui/jquery.ui.js','js');?>
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
            <div class="column-title" id="main-nav"><span class="ico-order"></span>
                <h2>订单物流</h2>
            </div>
            <div class="column-menu">
                <ul id="seller_center_left_menu">
                    <li class="<?php echo empty($type)?'current':''?>"> <a href="/seller/order"> 交易订单 </a> </li>
                    <li class="<?php echo !empty($type)&&$type==2?'current':''?>"> <a href="/seller/order?type=2"> 发货 </a> </li>
                    <li class="<?php echo !empty($type)&&$type==3?'current':''?>"> <a href="/seller/order?type=2"> 退货 </a> </li>
                    <!-- <li class=""> <a href="/seller/shop_transport"> 运单模板 </a> </li> -->
                </ul>
            </div>
        </div>
    </div>
    <div id="layoutRight" class="ncsc-layout-right">
        <div class="ncsc-path"><i class="icon-desktop"></i>商家管理中心<i class="icon-angle-right"></i>订单物流<i class="icon-angle-right"></i>发货</div>
        <div class="main-content" id="mainContent">
            <style type="text/css">
                .sticky .tabmenu { padding: 0;  position: relative; }
            </style>
            <span class="fr mr5"></span>
            <div class="wrap">
                <div class="step-title"><em>第一步</em>确认收货信息及交易详情</div>
                <form name="deliver_form" method="POST" id="deliver_form" action="<?php echo SELLER_SITE_URL.'/order/save_order_deliver'?>" >
                    <table class="ncsc-default-table order deliver">
                        <tbody>

                        <tr>
                            <td colspan="20" class="sep-row"></td>
                        </tr>
                        <tr>
                            <th colspan="20">    </th>
                                <i class="print-order"></i></a><span class="fr mr30"></span><span class="ml10">订单编号：<?php  echo !empty($orderInfo['order_sn'])?$orderInfo['order_sn']:''?></span>
                                <span class="ml20">下单时间：<em class="goods-time"><?php  echo !empty($orderInfo['createtime'])? date('Y-m-d H:i:s',$orderInfo['createtime']):''?></em></span>

                        </tr>
                        <?php foreach($aGoodsList as $k => $v){?>
                        <tr>
                            <td class="bdl w10"></td>
                            <td class="w50"><div class="pic-thumb"><a href="javascript:void(0);" target="_blank"><img src="<?php echo $v['pic_path']?>" /></a></div></td>
                            <td class="tl"><dl class="goods-name">
                                    <dt><a target="_blank" href="javascript:void(0);"><?php echo $v['title']?></a></dt>
                                    <dd><strong>￥<?php echo $v['price']?></strong>&nbsp;x&nbsp;<em><?php echo $v['num']?></em>件</dd>
                                </dl>
                            </td>
                            <?php if($k==0){  ?>
                            <td class="bdl bdr order-info w500" rowspan="<?php echo !empty($aGoodsList)?count($aGoodsList):1 ?>"><dl>
                                    <dt>运费：</dt>
                                    <dd>
                                        （免运费）
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>发货备忘：</dt>
                                    <dd>
                                        <textarea name="deliver_explain" cols="100" rows="2" class="w400 tip-t" title="您可以输入一些发货备忘信息（仅卖家自己可见）"></textarea>
                                    </dd>
                                </dl></td>
                        </tr>
                        <?php }?>
                        <?php } ?>
                        <tr>
                            <td colspan="20" class="tl bdl bdr" style="padding:8px" id="address">
                                <strong class="fl">收货人信息：</strong>
                                <span id="buyer_address_span"><?php echo !empty($orderDetailInfo['real_name'])? $orderDetailInfo['real_name']:''?>&nbsp;<?php echo !empty($orderDetailInfo['mobile'])? $orderDetailInfo['mobile']:''?>,<?php echo !empty($orderDetailInfo['phone'])? $orderDetailInfo['phone']:''?>&nbsp;<?php echo !empty($orderDetailInfo['address'])? $orderDetailInfo['address']:''?></span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="step-title mt30"><em>第二步</em>确认发货信息</div>
                    <div class="deliver-sell-info"><strong class="fl">我的发货信息：</strong>
<!--                        <a href="javascript:void(0);" onclick="ajax_form('modfiy_daddress', '选择发货地址', 'index.php?act=store_deliver&op=send_address_select&order_id=1', 640,0);" class="ncsc-btn-mini fr">-->
<!--                            <i class="icon-edit"></i>编辑-->
<!--                        </a>-->
                        <span id="seller_address_span">
<!--                            还未设置发货地址，请进入发货设置 > 地址库中添加-->
                            <?php echo !empty($orderDetailInfo['seller_address'])?$orderDetailInfo['seller_address']:''?>
                        </span>
                    </div>
                    <input type="hidden" name="daddress_id" id="daddress_id" value="">
                    <div class="step-title mt30"><em>第三步</em>配送清单</div>
<!--                    <div class="alert alert-success">-->
<!--                        您可以通过"发货设置-><a href="index.php?act=store_deliver_set&op=express" target="_parent" >默认物流公司</a>"添加或修改常用货运物流。免运或自提商品可切换下方<span class="red">[无需物流运输服务]</span>选项卡并操作。-->
<!--                    </div>-->
                    <div class="tabmenu">
                        <ul class="tab pngFix">
                            <li id="eli1" class="active"><a href="javascript:void(0);" onclick="etab(1)">九号街区配送</a></li>
                            <li id="eli2" class="normal"><a href="javascript:void(0);" onclick="etab(2)">总公司配送</a></li>
                        </ul>
                    </div>
                    <table class="ncsc-default-table order" id="texpress1" >
                        <tr>
                            <td>产品名称</td>
                            <td>规格</td>
                            <td>数量</td>
                            <td>状态</td>
                        </tr>
                        <?php foreach($nineBlocks as $k => $v){?>
                        <tr>
                            <td><?php echo !empty($v['title'])?$v['title']:''?></td>
                            <td><?php echo !empty($v['spec'])?$v['spec']:''?></td>
                            <td><?php echo !empty($v['num'])?$v['num']:''?></td>
                            <td><?php echo !empty($v['status'])?$v['status']==1?"已发货":"未发货":'未发货'?></td>
                        </tr>
                        <?php }?>
                        <tr>
                            <td colspan="3">
                                <?php if(!empty($nineBlocks)){?>
                                    <input class="ncsc-btn" type="submit" value="发货" />
<!--                                    <a href="--><?php //echo SELLER_SITE_URL.'/order/'?><!--" class="ncsc-btn-mini fr"><i class="icon-edit"></i>返回</a>-->
                                <?php  }?>
                            </td>
                        </tr>
                    </table>
                    <table class="ncsc-default-table order" id="texpress2" style="display:none">
                        <tr>
                            <td>产品名称</td>
                            <td>规格</td>
                            <td>数量</td>
                            <td>状态</td>
                        </tr>
                        <?php foreach($mainDesk as $k => $v){?>
                            <tr>
                                <td><?php echo !empty($v['title'])?$v['title']:''?></td>
                                <td><?php echo !empty($v['spec'])?$v['spec']:''?></td>
                                <td><?php echo !empty($v['num'])?$v['num']:''?></td>
                                <td><?php echo !empty($v['status'])?$v['status']==1?"已发货":"未发货":'未发货'?></td>
                            </tr>
                        <?php }?>
                    </table>

                    <input type="hidden" value="" name="hidtype" id="hidtype">
                    <input type="hidden" value="<?php echo $order_id?>" name="order_id" id="order_id">
                </form>
            </div>
            <?php echo _get_html_cssjs('seller_js','jquery.poshytip.min.js,/jquery-ui/i18n/zh-CN.js','js');?>

            <script type="text/javascript">
                function etab(t){
                    if (t==1){
                        $('#eli1').removeClass('normal').addClass('active');
                        $('#eli2').removeClass('active').addClass('normal');
                        $('#texpress1').css('display','');
                        $('#texpress2').css('display','none');
                    }else{
                        $('#eli1').removeClass('active').addClass('normal');
                        $('#eli2').removeClass('normal').addClass('active');
                        $('#texpress1').css('display','none');
                        $('#texpress2').css('display','');
                    }
                }
                $(function(){
                    //表单提示
                    $('.tip-t').poshytip({
                        className: 'tip-yellowsimple',
                        showOn: 'focus',
                        alignTo: 'target',
                        alignX: 'center',
                        alignY: 'top',
                        offsetX: 0,
                        offsetY: 2,
                        allowTipHover: false
                    });
                    $('.tip-r').poshytip({
                        className: 'tip-yellowsimple',
                        showOn: 'focus',
                        alignTo: 'target',
                        alignX: 'right',
                        alignY: 'center',
                        offsetX: -50,
                        offsetY: 0,
                        allowTipHover: false
                    });
                    $('a[nc_type="eb"]').on('click',function(){
                        if ($('input[nc_value="'+$(this).attr('nc_value')+'"]').val() == ''){
                            showDialog('请填写物流单号', 'error','','','','','','','','',2);return false;
                        }
                        $('input[nc_type="eb"]').attr('disabled',true);
                        $('input[nc_value="'+$(this).attr('nc_value')+'"]').attr('disabled',false);
                        $('#shipping_express_id').val($(this).attr('nc_value'));
                        $('#deliver_form').submit();
                    });

                    $('#add_time_from').datepicker({dateFormat: 'yy-mm-dd'});
                    $('#add_time_to').datepicker({dateFormat: 'yy-mm-dd'});
                    $('.checkall_s').click(function(){
                        var if_check = $(this).attr('checked');
                        $('.checkitem').each(function(){
                            if(!this.disabled)
                            {
                                $(this).attr('checked', if_check);
                            }
                        });
                        $('.checkall_s').attr('checked', if_check);
                    });

                    $('#my_address_add').click(function(){
                        ajax_form('my_address_add', '添加发货地址' , 'index.php?act=store_deliver&op=send_address_edit', 550,0);
                    });
                });
            </script>
        </div>
    </div>

</div>
<?php $this->load->view('seller/inc/footer');?>
</body>
</html>
