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
    <?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome-ie7.min.css','css');?>
    <![endif]-->
    <?php echo _get_html_cssjs('admin_js','perfect-scrollbar.min.js','js');?>
</head>
<body>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <h3>兑换礼品</h3>
            <ul class="tab-base">
                <li><a href="/admin/integral_goods" ><span>礼品列表</span></a></li>
                <li><a href="/admin/integral_goods/add" ><span>新增礼品</span></a></li>
                <li><a href="/admin/integral_goods/order_list" ><span>兑换列表</span></a></li>
                <li><a href="JavaScript:void(0);" class="current"><span>发货</span></a></li>
            </ul>

        </div>
    </div>
    <div class="fixed-empty"></div>
    <?php if (is_array($order_info) && count($order_info)>0){ ?>
        <form id="ship_form" name="ship_form">
            <input type="hidden" name="form_submit" value="ok"/>
            <table class="table tb-type2">
                <tbody>
                <tr class="noborder">
                    <td colspan="2"><label>会员名称:</label></td>
                </tr>
                <tr class="noborder">
                    <td class="vatop rowform"><?php echo $order_info['user_name']; ?></td>
                    <td class="vatop tips"></td>
                </tr>
                <tr>
                    <td colspan="2"><label> 兑换单号:</label></td>
                </tr>
                <tr class="noborder">
                    <td class="vatop rowform"><?php echo $order_info['order_num']; ?></td>
                    <td class="vatop tips"></td>
                </tr>
                <tr>
                    <td colspan="2"><label class="validation" for="shippingcode"> 物流单号:</label></td>
                </tr>
                <tr class="noborder">
                    <td class="vatop rowform"><input type="text" id="shippingcode" name="shippingcode" class="txt" value=""></td>
                    <td class="vatop tips"></td>
                </tr>
                <tr>
                    <td colspan="2"><label class="validation" for="shippingcomp" for="">配送公司:</label></td>
                </tr>
                <tr class="noborder">
                    <td class="vatop rowform"><input type="text" id="shippingcomp" name="shippingcomp" class="txt" value=""></td>
                    <td class="vatop tips"></td>
                </tr>

                <tfoot>
                <tr class="tfoot">
                    <td colspan="2" >
                        <a class="btn" onclick="$('#ship_form').submit();"><span>提交</span></a>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    <?php } else { ?>
        <div class='msgdiv'>订单不存在<br>
            <br>
            <a class="forward" href="/admin/integral_goods/order_list">返回订单列表</a> </div>
    <?php } ?>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        $('#ship_form').validate({
            rules : {
                shippingcode  : 'required',
                shippingcomp  : 'required'
            },
            messages : {
                'required'  : '请填写快递单号',
                shippingcomp  : '请填写快递公司'

            },
            submitHandler: function() {
                sendPostData({id:<?php echo $_GET['order_id']; ?>,shippingcode:$("#shippingcode").val(),shippingcomp:$("#shippingcomp").val()},'/admin/integral_goods/ship',function(result){
                    if(result.code == 1){
                        alert('发货成功')
                        history.go(-1)
                    }else{
                        alert(result.msg)
                    }
                });
            }

        });

    });
</script>

</body>
</html>