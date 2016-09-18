<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>coupon</title>
    <?php echo _get_html_cssjs('admin_js','jquery.js,jquery.validation.min.js,admincp.js,jquery.cookie.js,common.js','js');?>
    <link href="<?php echo _get_cfg_path('admin').TPL_ADMIN_NAME;?>css/skin_0.css" type="text/css" rel="stylesheet" id="cssfile" />
    <?php echo _get_html_cssjs('admin_css','perfect-scrollbar.min.css','css');?>

    <?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome.min.css','css');?>

    <!--[if IE 7]>
    <?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome-ie7.min.css','css');
    function getStatus($sta){
            if($sta == 1){
                return "未发货";
            }else if($sta == 2){
                return "已发货";
            }else if($sta == 3){
                return "已收货";
            }else if($sta == 4){
                return "已取消";
            }else{
                return "失效";
            }
        }
    ?>
    <![endif]-->
    <?php echo _get_html_cssjs('admin_js','perfect-scrollbar.min.js','js');?>
</head>
<body>
<div class="page">
    <table class="table tb-type2 order">
        <tbody>
        <tr class="space">
            <th colspan="15">兑换信息</th>
        </tr>
        <tr>
            <td><ul>
                    <li><strong>兑换单号:</strong><?php echo $order_info['id'];?></li>
                    <li><strong>状态:</strong><?php echo getStatus( $order_info['logistical_status']); ?></li>
                    <li><strong>兑换积分:</strong><span class="red_common"><?php echo $order_info['integral_cost'];?></span></li>
                    <li><strong>兑换时间:</strong><span class="red_common"><?php echo @date('Y-m-d H:i:s',$order_info['exchange_date']);?></span></li>
                </ul></td>
        </tr>
        <tr class="space">
            <th colspan="2">兑换详情</th>
        </tr>
        <tr>
            <th>会员信息</th>
        </tr>
        <tr>
            <td><ul>
                    <li><strong>会员名称:</strong><?php echo $address_info['real_name'];?></li>
                    <li><strong>会员邮箱:</strong><?php echo $address_info['province'];?></li>
                    <li><strong>会员留言:</strong><?php echo $address_info['phone'];?></li>
                </ul></td>
        </tr>
        <tr>
            <th>收货人及发货信息</th>
        </tr>
        <tr>
            <td><ul>
                    <li><strong>收货人:</strong><?php echo $address_info['real_name'];?></li>
                    <li><strong>所在地区:</strong><?php echo $address_info['province'];?></li>
                    <li><strong>手机号码:</strong><?php echo $address_info['phone'];?></li>
                    <li><strong>详细地址:</strong><?php echo $address_info['province'].$address_info['city'].$address_info['area'].$address_info['street'];?></li>
                    <li><strong>快递公司:</strong><?php echo $order_info['express_comp'];?></li>
                    <li><strong>快递单号:</strong><?php echo $order_info['logistical_num'];?></li>
<!--                    --><?php //if ($order_info['point_shippingcode'] != ''){?>
<!--                        <li><strong>--><?php //echo $lang['admin_pointorder_shipping_code'];?><!--:</strong>--><?php //echo $order_info['point_shippingcode'];?><!--</li>-->
<!--                    --><?php //}?>
<!--                    --><?php //if ($order_info['point_shippingtime'] != ''){?>
<!--                        <li><strong>--><?php //echo $lang['admin_pointorder_shipping_time'];?><!--:</strong>--><?php //echo @date('Y-m-d',$order_info['point_shippingtime']);?><!--</li>-->
<!--                    --><?php //}?>
<!--                    --><?php //if ($order_info['point_shippingdesc'] != ''){?>
<!--                        <li style="width:60%;"><strong>--><?php //echo $lang['admin_pointorder_info_shipinfo_description'];?><!--:</strong>--><?php //echo $order_info['point_shippingdesc'];?><!--</li>-->
<!--                    --><?php //}?>
                </ul></td>
        </tr>
        <tr>
            <th>礼品信息</th>
        </tr>
        <tr>
            <td><table class="table tb-type2 goods ">
                    <tbody>
                    <tr>
                        <th>图片</th>
                        <th>礼品名称</th>
                        <th>兑换积分</th>
                        <th>兑换数量</th>
                    </tr>
<!--                    --><?php //foreach($goods_info as $v){?>
                        <tr>
                        <td class="w60 picture"><div class="size-56x56"><span class="thumb size-56x56"><img src="<?php echo $goods_info['goods_url']; ?>" onload="javascript:DrawImage(this,56,56);" /></span></div></td>
                        <td class="w50pre"><?php echo $goods_info['goods_name'];?></td>
                        <td><?php echo $order_info['integral_cost'];?></td>
                        <td><?php echo $order_info['num'];?></td>
<!--                        </tr>--><?php //}?>
                    </tbody>
                </table></td>
        </tr>
        </tbody>
        <tfoot>
        <tr class="tfoot">
            <td><a href="/admin/integral_goods/order_list" class="btn"><span>返回列表</span></a></td>
        </tr>
        </tfoot>
    </table>
</div>
</body>
</html>