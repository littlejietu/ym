
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>big city</title>
    <?php echo _get_html_cssjs('admin_js','jquery.js,jquery.validation.min.js,admincp.js,jquery.cookie.js,common.js','js');?>
    <link href="<?php echo _get_cfg_path('admin').TPL_ADMIN_NAME;?>css/skin_0.css" type="text/css" rel="stylesheet" id="cssfile" />
    <?php echo _get_html_cssjs('admin_css','perfect-scrollbar.min.css','css');?>
    <?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome.min.css','css');?>
    <!--[if IE 7]>
    <?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome-ie7.min.css','css');?>
    <![endif]-->
    <?php echo _get_html_cssjs('admin_js','perfect-scrollbar.min.js','js');?>
</head>
<body>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <h3>退款管理</h3>
           <!-- <ul class="tab-base">
                <li><a href="/admin/Refund/refund_manage?type=wait" <?php /*echo $type=='wait'?'class="current"':''*/?>><span><?php /*echo '待处理';*/?></span></a></li>
                <li><a href="/admin/Refund/refund_manage?type=all" <?php /*echo $type=='all'?'class="current"':''*/?> ><span><?php /*echo '所有记录';*/?></span></a></li>
                <li><a href="index.php?act=refund&op=reason"><span><?php /*echo '退款退货原因';*/?></span></a></li>
            </ul>-->
        </div>
    </div>
    <div class="fixed-empty"></div>
    <form method="get" action="<?php echo ADMIN_SITE_URL.'/refund/refund_manage'?>" name="formSearch" id="formSearch">
        <table class="tb-type1 noborder search">
            <tbody>
            <tr>
                <th><select name="type">
                        <option value="order_sn">订单编号</option>
<!--                        <option value="store_name">店铺名</option>-->
<!--                        <option value="goods_name">商品名称</option>-->
<!--                        <option value="buyer_name">买家会员名</option>-->
                    </select></th>
                <td><input type="text" class="text" name="key" value="<?php echo $key ?>" /></td>
                <th><label for="add_time_from"></label></th>
                <td><input class="txt date" type="text" value="<?php echo $add_time_from ?>" id="add_time_from" name="add_time_from">
                    <label for="add_time_to">~</label>
                    <input class="txt date" type="text" value="<?php echo $add_time_to ?>" id="add_time_to" name="add_time_to"/></td>
                <td><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="">&nbsp;</a>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    <table class="table tb-type2" id="prompt">
        <tbody>
        <tr class="space odd">
            <th colspan="12"><div class="title"><h5>操作提示</h5><span class="arrow"></span></div></th>
        </tr>
        <tr>
            <td>
                <ul>
                    <li>买家提交申请，商家同意并经平台确认后，退款金额以预存款的形式返还给买家（充值卡部分只能退回到充值卡余额）。</li>
                </ul></td>
        </tr>
        </tbody>
    </table>
    <table class="table tb-type2 nobdb">
        <thead>
        <tr class="thead">
            <th>订单编号</th>
<!--            <th>退款编号</th>-->
            <th>店铺名</th>
            <th>商品名称</th>
            <th>买家会员名</th>
            <th class="align-center">申请时间</th>
<!--            <th class="align-center">商家审核时间</th>-->
            <th class="align-center">退款金额</th>
            <th class="align-center">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($list['rows'])){
            foreach($list['rows'] as $val){
            ?>
            <tr class="bd-line" >
                <td><?php echo $val['order_id'];?></td>
<!--                <td>--><?php //echo $val['refund_sn'];?><!--</td>-->
                <td><?php echo $val['seller_username']; ?></td>
                <td><?php echo $val['goods_name']; ?></td>
                <td><?php echo $val['buyer_name']; ?></td>
                <td class="align-center"><?php echo date('Y-m-d H:i:s',$val['addtime']);?></td>
<!--                <td class="align-center">--><?php //echo date('Y-m-d H:i:s',$val['seller_time']); ?><!--</td>-->
                <td class="align-center"><?php echo $val['refunds_money'];?></td>
                <td class="align-center">
                    <a href="<?php echo ADMIN_SITE_URL.'/order/detail?id='.$val['order_id'];?>">查看</a>
                </td>
            </tr>
        <?php }?>
        </tbody>
        <tbody>
        <?php }else{?>

            <tr class="no_data">
                <td colspan="20">没有符合条件的记录</td>
            </tr>
            <?php }?>
            </tbody>

            <tfoot>
            <tr>
                <td colspan="20">
                    <div class="pagination"><?php echo $list['pages'];?>
                    </div>
                </td>
            </tr>
            </tfoot>
    </table>
</div>
<script type="text/javascript">
    $(function(){
        $('#add_time_from').datepicker({dateFormat: 'yy-mm-dd'});
        $('#add_time_to').datepicker({dateFormat: 'yy-mm-dd'});
        $('#ncsubmit').click(function(){
        $('#formSearch').submit();
        });
    });
</script>
<?php echo _get_html_cssjs('lib','jquery-ui/themes/ui-lightness/jquery.ui.css','css');?>
<?php echo _get_html_cssjs('lib','jquery-ui/jquery.ui.js','js');?>
</body>
</html>
