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
            <div class="ncsc-oredr-show">
                <div class="ncsc-order-info">
                    <div class="ncsc-order-details">
                        <div class="title">订单信息</div>
                        <div class="content">
                            <dl>
                                <dt>收&nbsp;&nbsp;货&nbsp;&nbsp;人：</dt>
                                <dd><?php echo !empty($orderInfo)&&!empty($orderInfo['real_name'])? $orderInfo['real_name']:''?>&nbsp; <?php echo !empty($orderInfo)&&!empty($orderInfo['mobile'])? $orderInfo['mobile']:''?><?php echo !empty($orderInfo)&&!empty($orderInfo['phone'])? ','.$orderInfo['phone']:''?>&nbsp; <?php echo !empty($orderInfo)&&!empty($orderInfo['address'])? $orderInfo['address']:''?></dd>
                            </dl>
                            <dl>
                                <dd>
                                </dd>
                            </dl>
                            <dl>
                                <dd></dd>
                            </dl>
                            <dl class="line">
                                <dt>订单编号：</dt>
                                <dd><?php echo !empty($orderInfo)? $orderInfo['order_sn']:''?><a href="javascript:void(0);">
<!--                                        更多<i class="icon-angle-down"></i>-->
<!--                                        <div class="more"><span class="arrow"></span>-->
<!--                                            <ul>-->
<!--                                                <li>支付方式：<span>站内余额支付                                    (付款单号：180512825704432002)-->
<!--                                    </span></li>-->
<!--                                                <li>下单时间：<span>2016-04-01 11:35:04</span></li>-->
<!--                                                <li>付款时间：<span>2016-04-01 11:35:04</span></li>-->
<!--                                                <li>发货时间：<span>2016-04-02 11:30:35</span></li>-->
<!--                                            </ul>-->
<!--                                        </div>-->
                                    </a>
                                </dd>
                            </dl>
                            <dl>
                                <dt></dt>
                                <dd></dd>
                            </dl>
                        </div>
                    </div>
                    <div class="ncsc-order-condition">
                        <dl>
                            <dt><i class="icon-ok-circle green"></i>订单状态：</dt>
                            <dd><?php
                                switch($orderInfo['status']){
                                    case 'Create':
                                        echo '订单创建';
                                        break;
                                    case 'WaitPay':
                                        echo '等待支付';
                                        break;
                                    case 'WaitSend':
                                        echo '等待发货';
                                        break;
                                    case 'WaitConfirm':
                                        echo '等待确认';
                                        break;
                                    case 'Finished':
                                        echo '已完成';
                                        break;
                                    case 'Closed':
                                        echo '已关闭';
                                        break;
                                    case 'ClosedBySys':
                                        echo '平台手动关闭';
                                        break;
                                }
                                ?>
                            </dd>
                        </dl>
                        <ul>
                            <?php
                            switch($orderInfo['status']){
                                case 'Create':?>
                                    <!--订单创建-->
                                    <li>买家尚未对该订单进行支付</li>
                                    <?php
                                    break;
                                case 'WaitPay':
                                    ?>
                                    <!--等待支付-->
                                    <li>买家尚未对该订单进行支付</li>
                                    
                                    <?php
                                    break;
                                case 'WaitSend':
                                    ?>
                                    <!--等待发货-->
                                    <li>商品待发出；<?php echo !empty($orderInfo['deliver_status'])?'无需要物流。':''?></li>
                                    <?php
                                    break;
                                case 'WaitConfirm':
                                    ?>
                                    <!--等待确认-->
                                    <li>1. 商品已发出；<?php echo !empty($orderInfo['deliver_status'])?'无需要物流。':''?>
                                    </li>
                                    <li>2. 如果买家没有及时进行收货，系统将于
                                        <time><?php echo !empty($orderInfo)?date('Y-m-d',$orderInfo['createtime']+C('order_commis_day')*24*60*60):''?></time>
                                        自动完成“确认收货”，完成交易。</li>
                                    
                                    <?php
                                    break;
                                case 'Finished':
                                    ?>
                                    <!--已完成-->
                                    <li>1. 交易已完成，买家可以对购买的商品及服务进行评价。
                                    </li>
                                    <li>2. 评价后的情况会在商品详细页面中显示，以供其它会员在购买时参考。</li>
                                    
                                    <?php
                                    break;
                                case 'Closed':
                                    ?>
                                    <!--已关闭-->
                                    <li>商家关闭了订单</li>
                                    <?php
                                    break;
                                case 'ClosedBySys':
                                    ?>
                                    <!--平台手动关闭-->
                                    <li>平台手动关闭了订单</li>
                                    <?php
                                    break;
                            }
                            ?>

                        </ul>
                    </div>
                </div>
                <div id="order-step" class="ncsc-order-step">
                    <dl class="step-first current">
                        <dt>提交订单</dt>
                        <dd class="bg"></dd>
                        <dd class="date" title="下单时间"><?php echo date('Y-m-d H:i:s',$orderInfo['createtime']) ?></dd>
                    </dl>
                    <dl class="<?php if( in_array($orderInfo['status'], array(C('OrderStatus.WaitSend'),C('OrderStatus.WaitConfirm'),C('OrderStatus.Finished')) ) ) echo 'current';?>">
                        <dt>支付订单</dt>
                        <dd class="bg"> </dd>
                        <dd class="date" title="付款时间"><?php if($orderInfo['payed_time']>0) echo date('Y-m-d H:i:s',$orderInfo['payed_time']) ?></dd>
                    </dl>

                    <dl class="<?php if( in_array($orderInfo['status'], array(C('OrderStatus.WaitConfirm'),C('OrderStatus.Finished')) ) ) echo 'current';?>">
                        <dt>商家发货</dt>
                        <dd class="bg"> </dd>
                        <dd class="date" title="发货时间"><?php echo date('Y-m-d H:i:s',$orderInfo['sended_time']) ?></dd>
                    </dl>
                    <dl class="<?php if( in_array($orderInfo['status'], array(C('OrderStatus.Finished')) ) ) echo 'current';?>">
                        <dt>确认收货/完成</dt>
                        <dd class="bg"> </dd>
                        <dd class="date" title="完成时间"><?php echo date('Y-m-d H:i:s',$orderInfo['finished_time']) ?></dd>
                    </dl>
                    <dl class="">
                        <dt>完成</dt>
                        <dd class="bg"></dd>
                        <dd class="date" title="完成时间"><?php echo date('Y-m-d H:i:s',$orderInfo['finished_time']) ?></dd>
                    </dl>
                </div>
                <div class="ncsc-order-contnet">
                    <table class="ncsc-default-table order">
                        <thead>
                        <tr>
                            <th></th>
                            <th colspan="2">商品</th>
                            <th class="w120">单价(元)</th>
                            <th class="w60">数量</th>
<!--                            <th class="w100">优惠活动</th>-->
<!--                            <th class=""><strong>实付 * 佣金比 = 应付佣金(元)</strong></th>-->
                            <th class="w100">状态</th>
                            <th class="w160">交易操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($aGoodsList as $v){?>
                        <tr class="bd-line">
                            <td colspan="5">
                                <table width="100%">
                                <tr>
                                    <td class="w50">
                                        <div class="pic-thumb">
                                            <a target="_blank" href="javascript:void(0);">
                                                <img src="<?php echo $v['pic_path']?>" />
                                            </a>
                                        </div>
                                    </td>
                                    <td class="tl">
                                        <dl class="goods-name">
                                            <dt>
                                                <a target="_blank" href="javascript:void(0);">
                                                    <?php echo $v['title']?>
                                                </a>
                                            </dt>
                                        </dl>
                                    </td>
                                    <td class="w120"><?php echo $v['price']?></td>
                                    <td class="w60"><?php echo $v['num']?></td>
                                </tr>
                                    <?php if(!empty($v['orderPackageList'])):?>
                                        <?php foreach($v['orderPackageList'] as $kk => $vv){ ?>
                                            <tr align="left">
                                                <td colspan="2" style="text-align:left; padding-left:20px">
                                                    包裹<?php echo $kk+1?>
                                                </td>
                                                <td colspan="2">
                                                    <?php if($vv['deliver_way']==1){echo'九号街区配送';}elseif($vv['deliver_way']==2){echo'快递配送';}elseif($vv['deliver_way']==3){echo '混和配送';}?>
                                                    <?php echo $vv['num']?>件
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php endif?>
                                <?php if(!empty($v['OrderRrefunds'])):?>
                                <tr align="left">
                                    <td colspan="4" style="text-align:left; padding-left:20px">
                                        <b>退货理由</b><br>
                                        金额：<?php echo $v['OrderRrefunds']['refunds_money'] ?>&nbsp;&nbsp;</br>
                                        理由：<?php echo $v['OrderRrefunds']['reason_title'] ?>&nbsp;&nbsp;</br>
                                        备注：<?php echo $v['OrderRrefunds']['reason_content'] ?>&nbsp;&nbsp;</br>
                                        图片：
                                        <?php
                                        if(!empty($v['OrderRrefunds']['pic'])):
                                            foreach($v['OrderRrefunds']['pic'] as $vv):?>
                                                <img width="20px" height="20px" src="<?php echo $vv?>" />
                                        <?php
                                            endforeach;
                                        endif;?>
                                        <br><b>物流信息</b><br>
                                        <?php echo $v['OrderRrefunds']['logistic_name']?>,<?php echo $v['OrderRrefunds']['logistic_sn']?>,
                                        <?php echo $v['OrderRrefunds']['phone']?>
                                    </td>

                                </tr>
                                <?php endif?>
                               </table>
                            </td>
<!--                            <td>抢购</td>-->
<!--                            <td class="commis bdl bdr">-->
<!--                                190.00 * 0% = <b>0.00</b>-->
<!--                            </td>-->
                            <!-- S 合并TD -->
                            <td class="bdl bdr">
                            <span style="color:#F30">
                            <?php 
                                if(!empty($orderInfo) && $orderInfo['status']=='Create')
                                    echo '订单创建';
                                else
                                    echo C('OrderStatusName.'.$orderInfo['status']);
                            ?>
                            </span>
                            <p>
                            <?php if(!empty($v['OrderRrefunds'])&&$v['OrderRrefunds']['status']!=1):?>
                                <p class="green">退款退货中！</p>
                            <?php endif?></p>
                             </td>
                           <td align="center">
                           <!--退款状态：1-完成、2-审核中、3-商家同意退款、4-商家等待收货、5-取消退款-->
                            <?php if(!empty($v['OrderRrefunds'])){?>
                                <?php if($v['OrderRrefunds']['status'] == 1){?>
                                     退款金额：<?php echo $v['OrderRrefunds']['refunds_money']?>
                                <p class="green">成功退款！</p>
                                <?php }elseif($v['OrderRrefunds']['status'] == 2){?>
                                  退款金额：<?php echo $v['OrderRrefunds']['refunds_money']?>
                                <a class="submit" href="javascript:;" onclick="if(window.confirm('同意退货申请?')) window.location.href='/seller/order/agree_reply?refunds_id=<?php echo $v['refunds_id']?>&order_id=<?php echo $order_id?>';">同意退货申请</a>
                                   <?php }elseif($v['OrderRrefunds']['status']==5){?>
                                    退款金额：<?php echo $v['OrderRrefunds']['refunds_money']?>
                                <p class="green">买家取消退款！</p>
                                   <?php }elseif($v['OrderRrefunds']['status']==4 || $v['OrderRrefunds']['status']==6){?>
                                  退款金额：<?php echo $v['OrderRrefunds']['refunds_money']?>
                                <a class="submit" href="javascript:;"  onclick="if(window.confirm('已收到货，同意退款?')) window.location.href='/seller/order/agree_refund?refunds_id=<?php echo $v['refunds_id']?>&order_id=<?php echo $order_id?>';">已收到货，同意退款</a>
                                <?php }
                            }?>
                               <!-- 修改价格 -->
                            <!-- 取消订单 -->
                            <!-- 发货 -->
                            </td>
                            <!-- E 合并TD -->
                        </tr>
                        <!-- S 赠品列表 -->
                        <!-- E 赠品列表 -->
                        <?php }?>
                        <!-- S 赠品列表 -->
                        <!-- E 赠品列表 -->
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="20">
                                <?php //if($orderInfo['fare_amt']>0):?> 
                                <!-- <dl class="freight">
                                    <dd>运费：<em><?php //echo $orderInfo['fare_amt']?></em></dd>
                                </dl> -->
                                <?php //endif?>
                                <dl class="sum">
                                    <!--//zmr>v80-->
<!--                                    <dt style="color:blue">预存款已支付：</dt>-->
<!--                                    <dd><em>646.00</em>元</dd>-->
                                     <dt>订单金额：</dt>
                                    <dd style="text-align:right"><em><?php echo !empty($orderInfo)? $orderInfo['total_amt']:''?></em>元</dd><br>
                                <?php if($orderInfo['discount_amt']>0):?>    
                                    <dt>活动优惠金额：</dt>
                                    <dd style="text-align:right"><em>-<?php echo $orderInfo['discount_amt']; ?></em>元</dd><br>
                                <?php endif?>
                                <?php if($orderInfo['coupon_amt']>0):?>
                                    <dt>优惠券金额：</dt>
                                    <dd style="text-align:right"><em>-<?php echo $orderInfo['coupon_amt'];?></em>元</dd><br>
                                <?php endif?>
                                    <dt><hr style="height: 1px"></dt>
                                    <dd><hr style="height: 1px" ></dd><br>
                                    <dt>应付金额：</dt>
                                    <dd style="text-align:right"><em><?php echo !empty($orderInfo)? $orderInfo['pay_amt']:''?></em>元</dd><br>
                                </dl></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
           
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function(){
        // Membership card
        $('[nctype="mcard"]').membershipCard({type:'shop'});
    });
</script>
<?php $this->load->view('seller/inc/footer');?>
</body>
</html>
