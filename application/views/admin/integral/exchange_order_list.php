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
    <div class="fixed-bar">
        <div class="item-title">
            <h3> <h3>兑换礼品</h3></h3>
            <ul class="tab-base">
                <li><a href="/admin/integral_goods" ><span>礼品列表</span></a></li>
                <li><a href="/admin/integral_goods/add" ><span>新增礼品</span></a></li>
                <li><a href="JavaScript:void(0);" class="current"><span>兑换列表</span></a></li>
            </ul>
        </div>
    </div>
    <div class="fixed-empty"></div>
    <form method="get" name="formSearch">
<!--        <input type="hidden" name="order_num" value="order_num">-->
<!--        <input type="hidden" name="order_name" value="order_name">-->
        <table class="tb-type1 noborder search">
            <tbody>
            <tr>
                <th><label for="pordersn">兑换单号</label></th>
                <td><input type="text" name="order_num_input" id="order_num_input" class="txt" value='<?php if($order_num_input){echo $order_num_input;}?>'></td>
                <th><label for="pbuyname">会员名称</label></th>
                <td><input type="text" name="user_name_input" id="user_name_input" class="txt" value='<?php if($user_name_input){echo $user_name_input;}?>'></td>
                <td>
                    <select name="order_state">
<!--                       --><?php //foreach ($output['pointorderstate_arr'] as $k=>$v){ ?>
                            <option value="" selected="selected" >状态</option>
                            <option value="1" <?php if($order_state == 1){echo 'selected="selected"';}?>>未发货</option>
                            <option value="2" <?php if($order_state == 2){echo 'selected="selected"';}?>>已发货</option>
                            <option value="3" <?php if($order_state == 3){echo 'selected="selected"';}?>>已收货</option>
                            <option value="4" <?php if($order_state == 4){echo 'selected="selected"';}?>>已取消</option>
<!--                            --><?php //} ?>
                    </select></td>
                <td><a href="javascript:document.formSearch.submit();" class="btn-search " title="查询">&nbsp;</a></td>
            </tr>
            </tbody>
        </table>
    </form>
    <form method='post' id="form_order" action="index.php">
        <input type="hidden" name="act" value="pointorder">
        <input type="hidden" id="list_op" name="op" value="order_dropall">
        <table class="table tb-type2">
            <thead> <tr class="space">
                <th colspan="15">列表</th>
            </tr>
            <tr class="thead">
                <th>&nbsp;</th>
                <th>兑换单号</th>
                <th>会员名称</th>
                <th class="align-center">兑换积分</th>
                <th class="align-center">兑换时间</th>
                <th class="align-center">状态</th>
                <th class="align-center">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($rows) && is_array($rows)){ ?>
                <?php foreach($rows as $k => $v){?>
                    <tr class="hover">
                        <td class="w12">&nbsp;</td>
                        <td><?php echo $v['id'];?></td>
                        <td><?php echo $v['user_name'];?></td>
                        <td class="align-center"><?php echo $v['integral_cost'];?></td>
                        <td class="nowarp align-center"><?php echo @date('Y-m-d H:i:s',$v['exchange_date']);?></td>
                        <td class="align-center"><?php echo getStatus($v['logistical_status']);?></td>
                        <td class="w150 align-center">
                            <a href="/admin/integral_goods/order_detail?order_id=<?php echo $v['id']; ?>" class="edit">查看</a>
                            <?php if ($v['logistical_status'] == 1) {//发货（已确认付款，待发货）?>
                                <a href="/admin/integral_goods/order_ship?order_id=<?php echo $v['id']; ?>">发货</a>
                            <?php } ?>
<!--                            --><?php //if ($v['point_orderalloweditship']) {//修改物流（已发货，待收货）?>
<!--                                <a href="index.php?act=pointorder&op=order_ship&id=--><?php //echo $v['point_orderid']; ?><!--">--><?php //echo $lang['admin_pointorder_ship_modtip']; ?><!--</a>-->
<!--                            --><?php //} ?>
                            <!-- 取消订单 -->
                            <?php if ($v['logistical_status'] == 1){//取消订单（未发货） ?>
                                <a href="javascript:void(0)" >取消兑换</a>
                            <?php } ?>
                            <br>
                            <!-- 删除订单 -->
                    </tr>
                <?php } ?>
            <?php }else { ?>
                <tr class="no_data">
                    <td colspan="10">没有兑换记录</td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr class="tfoot">
                <!--          <td><input type="checkbox" class="checkall" id="checkallBottom"></td>-->
                <!--          <td colspan="16"><label for="checkallBottom">全选</label>-->
                <!--            &nbsp;&nbsp;<a id="submit" href="javascript:void(0)" class="btn"><span>添加活动</span></a>-->
                <div class="pagination"><?php echo $pages; ?></div>
                </td>
            </tr>
            </tfoot>
        </table>
    </form>
</div>
<script type="text/javascript">
    function confirmorder(url,msg){
        if(!confirm(msg)){
            return false;
        }else{
            window.location.href = url;
        }
    }
</script>
</body>
</html>