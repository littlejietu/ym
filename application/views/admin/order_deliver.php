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
            <h3>派送列表管理</h3>
            <ul class="tab-base">
                <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
            </ul>
        </div>
    </div>
    <div class="fixed-empty"></div>
 <!--   <form method="get" action="/admin/order/index" name="formSearch" id="formSearch">
        <table class="tb-type1 noborder search">
            <tbody>
            <tr>
                <th><label>订单序列</label></th>
                <td><input class="txt2" type="text" name="order_sn" value="<?php /*if (isset($arrParam['order_sn'])){echo $arrParam['order_sn'];}*/?>" ></td>
                <th>卖家</th>
                <td><input class="txt-short" type="text" name="seller_username" value="<?php /*if (isset($arrParam['seller_username'])){echo $arrParam['seller_username'];}*/?>" ></td>
                <th><label>订单状态</label></th>
                <td colspan="4"><select name="status" class="querySelect">
                        <option value="">请选择</option>
                        <option value="WaitPay" <?php /*if (isset($arrParam['status']) && $arrParam['status']=='WaitPay'){echo " selected";}*/?>>待支付</option>
                        <option value="WaitSend" <?php /*if (isset($arrParam['status']) && $arrParam['status']=='WaitSend'){echo " selected";}*/?>>待发货</option>
                        <option value="WaitConfirm" <?php /*if (isset($arrParam['status']) && $arrParam['status']=='WaitConfirm'){echo " selected";}*/?>>待确认</option>
                        <option value="Finished" <?php /*if (isset($arrParam['status']) && $arrParam['status']=='Finished'){echo " selected";}*/?>>已完成</option>
                        <option value="Closed" <?php /*if (isset($arrParam['status']) && $arrParam['status']=='Closed'){echo " selected";}*/?>>已关闭</option>
                    </select></td>

            </tr>
            <tr>
                <th><label for="query_start_time">下单时间</label></th>
                <td><input class="txt date" type="text" value="<?php /*if (isset($arrParam['addtime'])){echo $arrParam['addtime'];}*/?>" id="addtime" name="addtime">
                    <label for="addtime">~</label>
                    <input class="txt date" type="text" value="<?php /*if (isset($arrParam['etime'])){echo $arrParam['etime'];}*/?>" id="etime" name="etime"/></td>
                <th>买家</th>
                <td><input class="txt-short" type="text" name="buyer_username" value="<?php /*if (isset($arrParam['buyer_username'])){echo $arrParam['buyer_username'];}*/?>" ></td>
                <th>付款方式</th>
                <td>
                    <select name="paymethod" class="w100">
                        <option value="">请选择</option>
                        <option value="1" <?php /*if (isset($arrParam['paymethod']) && $arrParam['paymethod']==1){echo " selected";}*/?>>余额支付</option>
                        <option value="11" <?php /*if (isset($arrParam['paymethod']) && $arrParam['paymethod']==11){echo " selected";}*/?>>微信APP支付</option>
                        <option value="12" <?php /*if (isset($arrParam['paymethod']) && $arrParam['paymethod']==12){echo " selected";}*/?>>微信Wap支付</option>
                    </select>
                </td>
                <td><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php /*echo lang('nc_query');*/?>">&nbsp;</a>

                </td>
            </tr>
            </tbody>
        </table>
    </form>-->
    <table class="table tb-type2" id="prompt">
        <tbody>
        <tr class="space odd">
            <th colspan="12"><div class="title"><h5>操作提示</h5><span class="arrow"></span></div></th>
        </tr>
        <tr>
            <td>
                <ul>
                    <li>点击查看操作将显示订单的详细信息</li>
                </ul></td>
        </tr>
        </tbody>
    </table>

    <table class="table tb-type2 nobdb">
        <thead>
        <tr class="thead">
            <th>订单id</th>
            <th>订单序列</th>
            <th>配送员</th>
            <th class="align-center">卖家用户名</th>
            <th class="align-center">买家用户名</th>
            <th class="align-center">订单状态</th>
            <th class="align-center">下单时间</th>
            <th class="align-center">配送状态</th>
            <th class="align-center">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($list['rows']) && is_array($list['rows'])){?>
            <?php foreach($list['rows'] as $k => $v){?>
                <tr class="hover">
                    <td><?php echo $v['orderInfo']['order_id'];?></td>
                    <td><?php echo $v['orderInfo']['order_sn'];?></td>
                    <td><?php echo $v['deliver_user_name'];?></td>
                    <td class="align-center" ><?php echo $v['orderInfo']['seller_username'];?></td>
                    <td class="align-center" ><?php echo $v['orderInfo']['buyer_username'];?></td>
                    <td class="align-center">  <?php
                        if ($v['orderInfo']['status']=='Create'){
                            echo '创建';
                        } elseif ($v['orderInfo']['status']=='WaitPay'){
                            echo '等待支付';
                        } elseif ($v['orderInfo']['status']=='WaitSend'){
                            echo '等待发货';
                        } elseif ($v['orderInfo']['status']=='WaitConfirm'){
                            echo '等待确认';
                        } elseif ($v['orderInfo']['status']=='Finished'){
                            echo '已完成';
                        } elseif ($v['orderInfo']['status']=='Closed'){
                            echo '已关闭';
                        } elseif ($v['orderInfo']['status']=='ClosedBySys'){
                            echo '平台手动关闭';
                        };?></td>
                    <td class="align-center">
                        <?php echo date('Y-m-d H:i:s',$v['addtime']);?></td>
                    <td class="align-center">
                        <?php if($v['status']=='0'){echo '配送中';}else{echo '配送完成';}?>
                      </td>
                    <td class="w144 align-center"><a href="<?php echo ADMIN_SITE_URL.'/order/detail?id='.$v['order_id'];?>">查看</a></td>
                </tr>
            <?php }?>
        <?php }else{?>
            <tr class="no_data">
                <td colspan="15">没有符合条件的记录</td>
            </tr>
        <?php }?>
        </tbody>
        <tfoot>
        <tr class="tfoot">
            <td colspan="15" id="dataFuncs"><div class="pagination"> <?php echo $list['pages'];?> </div></td>
        </tr>
        </tfoot>
    </table>
</div>
<!-- <script type="text/javascript" src="<?php //echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script> -->
<!-- <script type="text/javascript" src="<?php //echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js" charset="utf-8"></script> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php //echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  /> -->
<?php echo _get_html_cssjs('lib','jquery-ui/themes/ui-lightness/jquery.ui.css','css');?>
<?php echo _get_html_cssjs('lib','jquery-ui/jquery.ui.js','js');?>
<script type="text/javascript">
    $(function(){
        $('#addtime').datepicker({dateFormat: 'yy-mm-dd'});
        $('#etime').datepicker({dateFormat: 'yy-mm-dd'});
        $('#ncsubmit').click(function(){
            $('input[name="op"]').val('index');$('#formSearch').submit();
        });
    });
</script>
</body>
</html>
