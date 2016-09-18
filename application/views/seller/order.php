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
                    <li class="<?php echo !empty($type)&&in_array($type, array(2,6))?'':'current'?>"> <a href="/seller/order"> 交易订单 </a> </li>
                    <li class="<?php echo !empty($type)&&$type==2?'current':''?>"> <a href="/seller/order?type=2"> 发货 </a> </li>
                    <li class="<?php echo !empty($type)&&$type==6?'current':''?>"> <a href="/seller/order?type=6"> 退货 </a> </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="layoutRight" class="ncsc-layout-right">
        <div class="ncsc-path"><i class="icon-desktop"></i>商家管理中心<i class="icon-angle-right"></i>订单物流<i class="icon-angle-right"></i>实物交易订单</div>
        <div class="main-content" id="mainContent">

            <div class="tabmenu">
                <ul class="tab pngFix">
                    <li class="<?php echo empty($arrParam['type'])?'active':'normal' ?>"><a href="/seller/order">所有订单</a> </li>
                    <li class="<?php  if(!empty($arrParam['type']) && $arrParam['type']==1) echo 'active';else echo 'normal';?>"><a href="/seller/order?type=1">待付款</a></li>
                    <li class="<?php if(!empty($arrParam['type']) && $arrParam['type']==2) echo 'active';else echo 'normal';?>"><a href="/seller/order?type=2">待发货</a></li>
                    <li class="<?php if(!empty($arrParam['type']) && $arrParam['type']==3) echo 'active';else echo 'normal';?>"><a href="/seller/order?type=3">已发货</a></li>
                    <li class="<?php if(!empty($arrParam['type']) && $arrParam['type']==4) echo 'active';else echo 'normal';?>"><a href="/seller/order?type=4">已完成</a></li>
                    <li class="<?php if(!empty($arrParam['type']) && $arrParam['type']==5) echo 'active';else echo 'normal';?>"><a href="/seller/order?type=5">已取消</a></li>
                    <li class="<?php if(!empty($arrParam['type']) && $arrParam['type']==6) echo 'active';else echo 'normal';?>"><a href="/seller/order?type=6">退货中</a></li>
                </ul>
            </div>
            <form method="post" action="<?php echo SELLER_SITE_URL.'/order'?>" >
                <table class="search-form">
                    <input type="hidden" name="type" value="<?php echo !empty($type)?$type:0?>" />
                    <tr>
                        <td>&nbsp;</td>
<!--                        <td><input type="checkbox" id="skip_off" value="1"   name="skip_off"> <label for="skip_off">不显示已关闭的订单</label></td>-->
                        <th>下单时间</th>
                        <td class="w250">
                            <input type="text" class="text w70" name="query_start_date" id="query_start_date" value="<?php echo !empty($query_start_date)?$query_start_date:''?>" />
                            <label class="add-on"><i class="icon-calendar"></i></label>&nbsp;&#8211;&nbsp;
                            <input id="query_end_date" class="text w70" type="text" name="query_end_date" value="<?php echo !empty($query_end_date)?$query_end_date:''?>" />
                            <label class="add-on"><i class="icon-calendar"></i></label>
<!--                        <th>买家</th>-->
<!--                        <td class="w100"><input type="text" class="text w80" name="buyer_name" value="" /></td>-->
                        <th>订单编号</th>
                        <td class="w160"><input type="text" class="text w150" name="order_sn" value="<?php echo !empty($order_sn)?$order_sn:''?>" /></td>
                        <td class="w70 tc"><label class="submit-border">
                                <input type="submit" class="submit" value="搜索" />
                            </label></td>
                    </tr>
                </table>
            </form>
            <table class="ncsc-default-table order">
                <thead>
                <tr>
                    <th class="w10"></th>
                    <th colspan="">商品</th>
                    <th class="w100">名称</th>
                    <th class="w100">单价（元）</th>
                    <th class="w40">数量</th>
                    <th class="w50"></th>
<!--                    <th class="w110">买家</th>-->
                    <th class="w100">订单金额</th>
                    <th class="w100">交易状态</th>
                    <th class="w100">交易操作</th>
                </tr>

                </thead>
                <?php foreach($list['rows'] as $k =>$v){ ?>
                <tbody>
                <tr>
                    <td colspan="20" class="sep-row"></td>
                </tr>
                <tr>
                    <th colspan="20"><span class="ml10">订单编号：<em><?php echo $v['order_sn']?></em>
                   </span> <span>下单时间：<em class="goods-time"><?php echo date('Y-m-d H:i:s',$v['createtime'])?></em></span>
                        <!-- <span class="fr mr5"> <a href="index.php?act=store_order_print&order_id=3" class="ncsc-btn-mini" target="_blank" title="打印发货单"/><i class="icon-print"></i>打印发货单</a></span> -->
                    </th>
                </tr>
                <tr>
                    <td class="bdl"></td>
                    <td class="w70">
                        <div class="ncsc-goods-thumb"><a href="javascript:void(0)" target="_blank">
                                <img src="<?php echo !empty($v['GoodsList'])? cthumb( $v['GoodsList'][0]['pic_path'] ):'' ?>" onMouseOver="toolTip('<img src=<?php echo !empty($v['GoodsList'])?cthumb($v['GoodsList'][0]['pic_path']):''?>>')" onMouseOut="toolTip()"/></a>
                        </div>
                    </td>
                    <td class="tl"><dl class="goods-name">
                            <dt><a target="_blank" href="javascript:void(0)"><?php echo !empty($v['GoodsList'])?$v['GoodsList'][0]['title']:'' ?></a></dt>
                            <dd>
                            </dd>
                        </dl></td>
                        <td><?php echo !empty($v['GoodsList'])?$v['GoodsList'][0]['price']:'' ?></td>
                    <td><?php echo !empty($v['GoodsList'])?$v['GoodsList'][0]['num']:'' ?></td>
                    <td>
                        <?php
                        if(!empty($v['GoodsList'][0]['refunds_status'])&&$v['GoodsList'][0]['refunds_status']==1){
                            ?>
                            退款完成
                        <?php }elseif(!empty($v['GoodsList'][0]['refunds_status'])&&$v['GoodsList'][0]['refunds_status']==2){?>
                            申请待审核
                        <?php }elseif(!empty($v['GoodsList'][0]['refunds_status'])&&$v['GoodsList'][0]['refunds_status']==3){?>
                            待用户退货
                        <?php }elseif(!empty($v['GoodsList'][0]['refunds_status'])&&$v['GoodsList'][0]['refunds_status']==4){?>
                            商家等待收货
                        <?php }elseif(!empty($v['GoodsList'][0]['refunds_status'])&&$v['GoodsList'][0]['refunds_status']==5){?>
                            用户取消退款
                        <?php }?>
                    </td>
                    <!-- S 合并TD -->
                    <td class="bdl" rowspan="<?php echo !empty($v['GoodsList'])?count($v['GoodsList'])+1:1?>"><p class="ncsc-order-amount"><?php echo $v['pay_amt']?></p>
                        <!-- <p class="goods-freight">
                            （免运费）
                        </p> -->
                        <p class="goods-pay" title="支付方式：在线付款">在线付款</p>
                    </td>
                    <td class="bdl bdr" rowspan="<?php echo !empty($v['GoodsList'])?count($v['GoodsList'])+1:1?>">
                        <!-- 物流跟踪 -->
                        <p>
                            <?php if ($v['status']=='WaitPay'|| $v['status']=='Create'): ?>
                                <a href='javascript:void(0);'>等待付款</a>
                            <?php endif ?>
                            <?php if ($v['status']=='WaitSend'): ?>
                                <a href='javascript:void(0);'>等待发货</a>
                            <?php endif ?>
                            <?php if ($v['status']=='WaitConfirm'): ?>
                                <a href='javascript:void(0);'>等待确认</a>
                            <?php endif ?>
                            <?php if ($v['status']=='Finished'): ?>
                                <a href='javascript:void(0);'>已完成</a>
                            <?php endif ?>
                            <?php if ($v['status']=='Closed'): ?>
                                <a href='javascript:void(0);'>已关闭</a>
                            <?php endif ?>
                        </p>
                    </td>
                    <!-- 取消订单 -->
                    <td class="bdl bdr" rowspan="<?php echo !empty($v['GoodsList'])?count($v['GoodsList'])+1:1?>">
                        <p><a href="/seller/order/orderinfo?order_id=<?php echo $v['order_id'] ?>" class="ncsc-btn ncsc-btn-green mt10" target="_blank"> <i class="icon-columns"></i>查看订单</a></p>
                        <?php if($v['status']=='WaitPay'): ?>
                            <p>
                                <a href="/seller/order/close?order_id=<?php echo $v['order_id'] ?>" class="ncsc-btn ncsc-btn-red mt5" />
                                <i class="icon-remove-circle"></i>取消订单</a></p>
                        <?php endif ?>
                        <!-- 修改运费 -->
                     <!--   <?php /*if ($v['status']=='WaitPay'||$v['status']=='Create'): */?>
                            <p>
                                 <a href="javascript:void(0)" class="ncsc-btn-mini ncsc-btn-orange mt10" uri="" dialog_id="seller_order_adjust_fee" />
                                <i class="icon-pencil"></i>修改运费</a>
                            </p>
                        --><?php /*endif*/?>
                        <!-- 修改价格 -->
                     <!--   <?php /*if ($v['status']=='WaitPay'): */?>
                            <p><a href="javascript:void(0)" class="ncsc-btn-mini ncsc-btn-green mt10" uri="" dialog_id="seller_order_adjust_fee" />
                                <i class="icon-pencil"></i>修改价格</a>
                            </p>
                        --><?php /*endif*/?>
                        <!-- 发货 -->
                        <?php if ($v['status']=='WaitSend'): ?>
                            <p><a class="ncsc-btn ncsc-btn-green mt10" href="/seller/order/order_deliver?order_id=<?php echo $v['order_id'] ?>"/><i class="icon-truck"></i>商家发货</a></p>
                        <?php endif ?>
                        <!-- 锁定 -->
                    </td>
                    <!-- E 合并TD -->
                </tr>
                <!-- S 赠品列表 -->
                <?php
                if(!empty($v['GoodsList'])):
                    foreach($v['GoodsList'] as $kk => $vv):
                        if($kk==0){continue;}
                         ?>
                    <!-- E 赠品列表 -->
                    <tr>
                        <td class="bdl"></td>
                        <td class="w70"><div class="ncsc-goods-thumb"><a href="javascript:void(0)" target="_blank">
                            <img src="<?php echo !empty($vv)?cthumb($vv['pic_path']):'' ?>" onMouseOver="toolTip('<img src=<img src=<?php echo !empty($vv)?cthumb($vv['pic_path']):'' ?>>')" onMouseOut="toolTip()"/></a>
                            </div>
                        </td>
                        <td class="tl"><dl class="goods-name">
                                <dt>
                                    <a target="_blank" href="javascript:void();">
                                    <?php echo !empty($vv)?$vv['title']:'' ?>
                                    </a>
                                </dt>
                                <dd>
    <!--                                <span class="sale-type">抢购</span>-->
                                </dd>
                            </dl></td>
                        <td><?php echo !empty($vv)?$vv['price']:'' ?></td>
                        <td><?php echo !empty($vv)?$vv['num']:'' ?></td>
                        <td>  <?php
                            if(!empty($v['GoodsList']['refunds_status'])&&$vv['refunds_status']==1){
                                ?>
                                退款完成
                            <?php }elseif(!empty($vv['refunds_status'])&&$vv['refunds_status']==2){?>
                                退款待审核
                            <?php }elseif(!empty($vv['refunds_status'])&&$vv['refunds_status']==3){?>
                                退款待审核
                            <?php }elseif(!empty($vv['refunds_status'])&&$vv['refunds_status']==4){?>
                                商家等待收货
                            <?php }elseif(!empty($vv['refunds_status'])&&$vv['refunds_status']==5){?>
                                退款 取消
                            <?php }?></td>
                        <!-- E 合并TD -->
                    </tr>
                    <?php
                    endforeach;
                endif?>
                <!-- S 赠品列表 -->
                <!-- E 赠品列表 -->
                </tbody>
                <?php } ?>
                <!-- S 赠品列表 -->

                <!--分页-->
                <tfoot>
                <tr>
                    <td colspan="20"><div class="pagination">
                            <?php echo $list['pages'] ?>
                        </div></td>
                </tr>
                </tfoot>
            </table>
            <?php echo _get_html_cssjs('seller_js','jquery.poshytip.min.js,/jquery-ui/i18n/zh-CN.js','js');?>
            <script type="text/javascript">
                $(function(){
                    $('#query_start_date').datepicker({dateFormat: 'yy-mm-dd'});
                    $('#query_end_date').datepicker({dateFormat: 'yy-mm-dd'});
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
                    $('#skip_off').click(function(){
                        url = location.href.replace(/&skip_off=\d*/g,'');
                        window.location.href = url + '&skip_off=' + ($('#skip_off').attr('checked') ? '1' : '0');
                    });
                });
            </script>
        </div>
    </div>
</div>
<?php echo _get_html_cssjs('seller_js','common_select.js,jquery.mousewheel.js,shop_goods_add.step1.js,jquery.cookie.js,perfect-scrollbar.min.js,jquery.qtip.min.js,compare.js,store_goods_list.js,jquery.poshytip.min.js','js');?>
<?php $this->load->view('seller/inc/footer');?>
</body>
</html>
