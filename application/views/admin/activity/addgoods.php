<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>big city</title>
    <?php echo _get_html_cssjs('admin_js', 'jquery.js,jquery.validation.min.js,admincp.js,jquery.cookie.js,common.js', 'js'); ?>
    <link href="<?php echo _get_cfg_path('admin') . TPL_ADMIN_NAME; ?>css/skin_0.css" type="text/css" rel="stylesheet"
          id="cssfile"/>
    <?php echo _get_html_cssjs('admin_css', 'perfect-scrollbar.min.css', 'css'); ?>

    <?php echo _get_html_cssjs('font', 'font-awesome/css/font-awesome.min.css', 'css'); ?>

    <!--[if IE 7]>
    <?php echo _get_html_cssjs('font','font-awesome/css/font-awesome-ie7.min.css','css');?>
    <![endif]-->
    <?php echo _get_html_cssjs('admin_js', 'perfect-scrollbar.min.js', 'js'); ?>

</head>
<body>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <h3><?php echo '添加  '.$title; ?></h3>
            <ul class="tab-base">
<!--                <li><a href="JavaScript:void(0);" class="current"><span>所有商品</span></a></li>-->
                <li><a href="<?php echo ADMIN_SITE_URL . '/activity' ?>"><span>返回活动列表</span></a></li>
<!--                <li><a href="--><?php //echo ADMIN_SITE_URL . '/activity/goods_list?activity_id='.$activity_id.'&title='.$title; ?><!--"><span>当前活动商品</span></a></li>-->
            </ul>
        </div>
    </div>
    <div class="fixed-empty"></div>
    <form method="post" name="formSearch" id="formSearch">
<!--        <input type="hidden" name="act" value="goods">-->
<!--        <input type="hidden" name="op" value="goods">-->
        <table class="tb-type1 noborder search">
            <tbody>
            <tr>
                <th><label for="search_goods_name"> <?php echo lang('goods_index_name'); ?></label></th>
                <td><input type="text" value="<?php echo !empty($search_goods_name) ? $search_goods_name : '' ?>"
                           name="search_goods_name" id="search_goods_name" class="txt"></td>
                <th><label for="search_commonid">平台货号</label></th>
                <td><input type="text" value="<?php echo !empty($search_commonid) ? $search_commonid : '' ?>"
                           name="search_commonid" id="search_commonid" class="txt"/></td>
                <th><label for="search_goods_activity"> 活动状态</label></th>
                <td><select name="activity_status">
                        <option value="1" <?php if($activity_status == 1){echo 'selected="selected"';}?>>当前活动商品</option>
                        <option value="2" <?php if($activity_status ==2){echo 'selected="selected"';}?>>无活动商品</option>
                    </select></td>

                <td><a id="ncsubmit" class="btn-search "
                       title="<?php echo lang('nc_query'); ?>">&nbsp;</a></td>
            </tr>
            <tr>

            </tr>
            </tbody>
        </table>
    </form>
    <table class="table tb-type2" id="prompt">
        <tbody>
        <tr class="space odd">
            <th colspan="12">
                <div class="title">
                    <h5>操作提示</h5>
                    <span class="arrow"></span></div>
            </th>
        </tr>
        <tr>
            <td>
                <ul>
                    <li>当平台发起活动时，店铺可申请参与活动</li>
                    <li>只有关闭或者过期的活动才能删除</li>
                    <li>活动列表排序越小越靠前显示</li>
                   <li>当商品有多规格多价格时，原价取值为所有规格最低价格</li>
                </ul>
            </td>
        </tr>
        </tbody>
    </table>
    <form method='post' id="form_goods">
        <input type="hidden" name="form_submit" value="ok"/>
        <table class="table tb-type2">
            <thead>
            <tr class="thead">
<!--                <th class="w24"></th>-->
<!--                <th class="w24"></th>-->
                <th class="w60 align-center">平台货号</th>
                <th colspan="2"><?php echo lang('goods_index_name'); ?></th>
<!--                <th>--><?php //echo lang('goods_index_brand'); ?><!--&--><?php //echo lang('goods_index_class_name'); ?><!--</th>-->
<!--                <th class="align-center">价格(元)</th>-->
                <th class="align-center">活动总数</th>
                <th class="align-center">活动售出数量</th>
                <th class="align-center">活动剩余数量</th>
                <th class="align-center">库存</th>
                <th class="align-center">排序</th>
                <th class="align-center">商品状态</th>
                <th class="w108 align-center">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($goods_list) && is_array($goods_list)) { ?>
                <?php foreach ($goods_list as $k => $v) { ?>
                    <tr class="hover edit">
<!--                        <td><input type="checkbox" name="id[]" value="--><?php //echo $v['id']; ?><!--" class="checkitem"></td>-->
<!--                        <td></td>-->
                        <td class="align-center"><?php echo $v['tpl_id']; ?></td>
                        <td class="w60 picture">
                            <div class="size-56x56"><span class="thumb size-56x56"><i></i><img height="56" width="56"
                                                                                               src="<?php if (!empty($v['pic_path'])) {
                                            echo UPLOAD_SITE_URL . '/' . ATTACH_GOODS . '/' . $v['shop_id'] . '/' . $v['pic_path'];
                                        } else echo RES_SITE_URL . '/admin/images/default_image.png'; ?>"
                                        onload="javascript:DrawImage(this,56,56);"/></span></div>
                        </td>
                        <td>
                            <dl class="goods-info">
                                <dt class="goods-name"><?php echo $v['title']; ?></dt>
                                <dd class="goods-type">
<!--                                    --><?php //if ($v['have_gift'] == 1) { ?><!--<span class="virtual"-->
<!--                                                                              title="有赠品">赠</span>--><?php //} ?>
<!--                                    --><?php //if ($v['is_own'] == 1) { ?><!--<span class="fcode"-->
<!--                                                                           title="平台自营商品">自营</span>--><?php //} ?>
<!--                                    --><?php //if ($v['is_presell'] == 1) { ?><!--<span class="presell"-->
<!--                                                                               title="预先发售商品">预售</span>--><?php //} ?>
                                </dd>
                            </dl>
                        </td>
<!--                        <td>-->
<!--                            <p>--><?php //echo $category_list['data'][$v['category_id_1']]['name'] . '->' . $category_list['data'][$v['category_id_2']]['name'] . '->' . $category_list['data'][$v['category_id_3']]['name']; ?><!--</p>-->
<!---->
<!--                            <p class="goods-brand">品牌：--><?php //if (isset($brand_list['data'][$v['tpl_id']])) {
//                                    echo $brand_list['data'][$v['tpl_id']]['name'];
//                                } else echo '暂无品牌信息'; ?><!--</p>-->
<!--                        </td>-->
<!--                        <td class="align-center">--><?php //echo $v['price'] ?><!--</td>-->
                        <td class="align-center"><?php echo $v['total_num'] ?></td>
                        <td class="align-center"><?php echo $v['saled_num'] ?></td>
                        <td class="align-center"><?php echo $v['total_num']-$v['saled_num']; ?></td>
                        <td class="align-center"><?php echo $goods_num[$v['tpl_id']]['stock_num'] ?></td>
                        <td class="align-center"><?php echo $v['sort']; ?></td>
                        <td class="align-center"><?php echo $status[$v['status']]; ?></td>
                        
                        <td class="align-center">
                    <?php if (intval($v['activity_id']) !=0) { ?>
                       <a href="javascript:void(0)" onclick="eidtActivityGoods('<?php echo $v['tpl_id'] ?>','<?php echo $v['title'] ?>')">编辑</a>
                    <?php } ?>
                        <?php if (intval($v['activity_id']) ==0) { ?>
                            <a href="javascript:void(0)" onclick="addToActivity('<?php echo $v['tpl_id'] ?>','<?php echo $v['title'] ?>','<?php echo $v['category_id_1'] ?>','<?php echo $v['price'] ?>')">参加活动</a>
<!--                        --><?php //} else if(intval($v['activity_id']) ==-1){ ?>
                        <?php } else { ?>
<!--                           <span>活动中</span>-->
                            <a href="javascript:void(0)" onclick="deleteFromActivity('<?php echo $v['tpl_id'] ?>')">退出活动</a>
                        <?php } ?>
                            </td>
                    </tr>
                    <tr style="display:none;">
                        <td colspan="20">
                            <div class="ncsc-goods-sku ps-container"></div>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr class="no_data">
                    <td colspan="15"><?php echo lang('nc_no_record'); ?></td>
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
    <tfoot>
      <div class="pagination" style="margin-bottom:20px;"><?php echo $pages; ?></div>             
    </tfoot>
</div>

<form id="add_goods_info">
    <input type="hidden" name="goods_id" value="" id="goods_id"/>
    <input type="hidden" name="activity_goods_id" value="" id="activity_goods_id"/>
    <input type="hidden" name="category_id_1" value="" id="category_id_1"/>
    <div id="add_goods_div" style="display:none;position:fixed;left:0;top:0;width:100%;height: 100%;z-index:99;background:#000;background:rgba(0, 0, 0, 0.6)!important;filter:Alpha(opacity=60);background:#000; text-align:center;">
        <div style="width: 25%;left: 35%;top: 20%;position: absolute;background: #fff" >
    <table class="table tb-type2 tb-type1" style="width: 100%;height: 100%">
        <tr class="space">
            <th colspan="3">添加到活动</th>
        </tr>

        <td class="required" >
            <label class="validation" for="goodName">商品名称:</label>
            <label type="text" id="goodName" ></label>
        </td>
        </tr>
        <tr style="display: none;">
            <td class="required">
                <label class="validation" for="goodsPrice">出售价格:</label>
                <input type="text" name="goodsPrice" id="goodsPrice" class="txt"/>
            </td>
        </tr>
        <tr>
            <td class="required">
                <label class="validation" for="goodsNumber">出售总量:</label>
                <input type="text" name="goodsNumber" id="goodsNumber" class="txt"/>
            </td>
        </tr>

        <tr>
            <td class="required">
                <label class="validation" for="startTime">上线时间:</label>
                <input class="date" type="text" value="" id="startTime" name="startTime">
            </td>
        </tr>
        <tr>
            <td class="required">
                <label class="validation" for="fromSale">下线时间:</label>
                <input class="date" type="text" value="" id="fromSale" name="fromSale">
            </td>
        </tr>
        <tr class="tfoot">
            <td colspan="3"><a class="btn" id="submitBtn" onclick="$('#add_goods_info').submit()"><span>提交</span></a><a class="btn" id="cancelBtn"><span>取消</span></a></td>
        </tr>
    </table>
        </div>
    </div>
</form>
<?php echo _get_html_cssjs('admin_js', 'jquery-ui/jquery.ui.js', 'js'); ?>
<?php echo _get_html_cssjs('admin_js', 'jquery.mousewheel.js', 'js'); ?>
<?php echo _get_html_cssjs('admin_css','jquery.ui.css','css');?>
<?php echo _get_html_cssjs('admin_js', 'common_select.js', 'js'); ?>

<script type="text/javascript">
    $(document).ready(function () {

        $('#add_goods_info').validate({
            rules:{

                goodsPrice:{
                    "required":true,
                    "number":true,
                    "min":1,
                },
                goodsNumber:{
                    "required":true,
                    "number":true,
                    "min":1,
                },
                startTime:"required",
                fromSale:"required",

            },
            messages:{

                goodsPrice:{
                    "required":'价格必填',
                    "number":'必须是有效数字',
                    "min":'数量不能小于1',
                },
                goodsNumber:{
                    "required":'价格必填',
                    "number":'必须是有效数字',
                    "min":'数量不能小于1',
                },
                startTime:"请选择上线时间",
                fromSale:"请选择下线时间",

            },
            submitHandler: function() {
                var obj = {
                    'activity_goods_id':$('#activity_goods_id').val(),
                    'goods_id':$("#goods_id").val(),
                    'category_id_1':$("#category_id_1").val(),
                    'activity_id':<?php echo $activity_id ?>,
                    'price':$("#goodsPrice").val(),
                    'total': $("#goodsNumber").val(),
                    'start_time':$("#startTime").val(),
                    'from_sale':$("#fromSale").val(),
                };

               sendPostData(obj,'<?php echo ADMIN_SITE_URL . '/activity/addGoodsToActivity' ?>',function(result){
                   if(result.code == 1){
                       $('#add_goods_div').hide();
                       location.reload();
                   }else{
                        alert(result.msg);
                   }
               })
            }

        });
        $('#startTime').datepicker({dateFormat: 'yy-mm-dd',minDate: new Date()});
        $('#fromSale').datepicker({dateFormat: 'yy-mm-dd',minDate: new Date()});
        

        $('#ncsubmit').click(function () {
            $('#formSearch').submit();
        });

        // 违规下架批量处理
//        $('a[nctype="lockup_batch"]').click(function () {
//            str = getId();
//            if (str) {
//                goods_lockup(str);
//            }
//        });

        $("#submit").click(function () {
            $("#form_goods").submit();
        });
        $('#cancelBtn').click(function(){
            $('#add_goods_div').hide();
        })
    });

    function addToActivity(id,title,cid,price){


        $("#add_goods_div").show();
        $("#goodName").text(title)
        $("#goods_id").val(id);
        $("#category_id_1").val(cid);
        $("#goodsPrice").val(price)

//        $('#ui-datepicker-div').css('position','fixed')
    }

    function eidtActivityGoods(id,title){
        sendPostData({goods_id:id},'<?php echo ADMIN_SITE_URL . '/activity/getGoods' ?>',function(result){
            if(result.code == 1){
                $("#add_goods_div").show();
                $('#goods_id').val(id);
                $("#goodName").text(title);
                $("#goodsPrice").val(result.data.price);
                $("#goodsNumber").val(result.data.total);
                $("#startTime").val(result.data.start_time);
                $("#fromSale").val(result.data.from_sale);

            }else{
                alert(result.msg);
            }
        });

    }

    function deleteFromActivity(id){
        sendPostData({goods_id:id},'<?php echo ADMIN_SITE_URL . '/activity/deleteGoods' ?>',function(result){
            if(result.code == 1){
                location.reload();
            }else{
                alert(result.msg);
            }
        });
    }



</script>

</body>
</html>
