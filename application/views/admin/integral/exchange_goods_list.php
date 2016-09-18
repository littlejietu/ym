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
                <li><a href="JavaScript:void(0);" class="current"><span>礼品列表</span></a></li>
                <li><a href="/admin/integral_goods/add" ><span>新增礼品</span></a></li>
                <li><a href="/admin/integral_goods/order_list" ><span>兑换列表</span></a></li>
            </ul>
        </div>
    </div>
    <div class="fixed-empty"></div>
    <form method="get" name="formSearch">
<!--        <input type="hidden" name="act" value="pointprod">-->
<!--        <input type="hidden" name="op" value="pointprod">-->
        <input type="hidden" name="page" value="1">
        <table class="tb-type1 noborder search">
            <tbody>
            <tr>
                <th><label for="goods_name"></label></th>
                <td><input type="text" name="goods_name" id="goods_name" class="txt" placeholder='搜索物品名' value="<?php if($goods_name){echo $goods_name;}?>"></td>
<!--                <td><select name="pg_state">-->
<!--                        <option value="" selected="selected">状态</option>-->
<!--                        <option value="show" >上架</option>-->
<!--                        <option value="nshow" >下架</option>-->
<!--                        <option value="commend">推荐</option>-->
<!--                    </select></td>-->
                <td><a href="javascript:document.formSearch.submit();" class="btn-search " title="">&nbsp;</a>
                    <!--            --><?php //if($output['search_field_value'] != '' or $output['search_sort'] != ''){?>
                    <!--            <a href="index.php?act=member&op=member" class="btns "><span>--><?php //echo $lang['nc_cancel_search']?><!--</span></a>-->
                    <!--            --><?php //}?>
                </td>
            </tr>
            </tbody>
        </table>
    </form>

    <form method='post' id="form_prod" action="index.php">
        <input type="hidden" name="act" value="pointprod">
        <input type="hidden" id="list_op" name="op" value="prod_dropall">
        <table class="table tb-type2 nobdb">
            <thead>
            <tr class="thead">
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>礼品名称</th>
                <th class="align-center">积分兑换</th>
                <th class="align-center">礼品原价</th>
                <th class="align-center">库存</th>
                <th class="align-center">已兑换</th>
                <th class="align-center"></th>

                <th class="align-center">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($rows) && is_array($rows)){ ?>
                <?php foreach($rows as $k => $v){?>
                    <tr class="hover">
                        <td class="w24"><input type="checkbox" name="pg_id[]" value="<?php echo $v['id'];?>" class="checkitem"></td>
                        <td class="w48 picture"><div class="size-44x44"><span class="thumb size-44x44"><i></i><img height="44" width="44" src="<?php echo $v['goods_url']; ?>" onload="javascript:DrawImage(this,44,44);"/></span></div></td>
                        <td><a href="javascript:void(0);" target="_blank" ><?php echo $v['goods_name'];?></a></td>
                        <td class="align-center"><?php echo $v['integral_cost'];?></td>
                        <td class="align-center"><?php echo $v['price'];?></td>
                        <td class="align-center"><?php echo $v['total'] - $v['exchange_num'];?></td>
                        <td class="align-center"><?php echo $v['exchange_num'];?></td>
                        <td class="align-center"></td>

                        <td class="w72 align-center"><a href="/admin/integral_goods/add?id=<?php echo $v['id']; ?>" class="edit">编辑</a> | <a href="javascript:void(0)" onclick="delete_goods(<?php echo $v['id']; ?>)");">删除</a></td>
                    </tr>
                <?php } ?>
            <?php }else { ?>
                <tr class="no_data">
                    <td colspan="10">没有物品！</td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <?php if(!empty($rows) && is_array($rows)){ ?>
                <tr>
                    <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
                    <td colspan="16" id="dataFuncs"><label for="checkallBottom">全选</label>
                        &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="submit_form('');"><span>删除</span></a>
                        <div class="pagination"> </div></td>
                </tr>
            <?php } ?>
            <tr class="tfoot">
                <div class="pagination"><?php echo $pages; ?></div>
                </td>
            </tr>
            </tfoot>
        </table>
    </form>
</div>
<script type="text/javascript">
    function submit_form(op){
//        if(op=='prod_dropall'){
//            if(!confirm('')){
//                return false;
//            }
//        }
        var ids =  [];
        $('.checkitem').each(function(a,i){
            if($(this).is(':checked')){
                ids.push($(this).val());
            }

        });
        if(ids.length>0){
            sendPostData({id:ids.join(',')},'/admin/integral_goods/delete_goods',function(result){
                if(result.code == 1){
                    location.reload();
                    alert('删除成功')
                }else{
                    alert(result.msg);
                }
            });
        }

//        $('#list_op').val(op);
//        $('#form_prod').submit();
//        showDialog('确定删除所选物品吗?','confirm')
    }

    function delete_goods(id){
        sendPostData({id:id},'/admin/integral_goods/delete_goods',function(result){
            if(result.code == 1){
                location.reload();
                alert('删除成功')
            }else{
                alert(result.msg);
            }
        });
    }
</script>
</body>
</html>