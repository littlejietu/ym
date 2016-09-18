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
            <h3><?php echo '活动列表' ?></h3>
        </div>
    </div>
    <div class="fixed-empty"></div>

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
                </ul>
            </td>
        </tr>
        </tbody>
    </table>
    <form method='post' id="form_goods" action="<?php echo ADMIN_SITE_URL . '/activity/add_activity' ?>">
        <input type="hidden" name="form_submit" value="ok"/>
        <table class="table tb-type2">
            <thead>
            <tr class="thead">
<!--                <th class="w24"></th>-->
<!--                <th class="w24"></th>-->
                <th class="w60 align-center">活动id</th>
                <th colspan="2">活动名称</th>
<!--                <th class="w72 align-center">折扣</th>-->
                <th class="w108 align-center">开始时间</th>
                <th class="w108 align-center">结束时间</th>
                <th class="w108 align-center">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($data['rows']) && is_array($data['rows'])) { ?>
                <?php foreach ($data['rows'] as $k => $v) { ?>
                    <tr class="hover edit">
<!--                        <td><input type="checkbox" name="id[]" value="--><?php //echo $v['id']; ?><!--" class="checkitem"></td>-->
<!--                        <td></td>-->
                        <td class="align-center"><?php echo $v['id']; ?></td>
                        <td class="w60 picture"><?php echo $v['title']; ?></td>
                        <td class="align-center"></td>
<!--                        <td class="align-center">--><?php //echo ($v['discount']/1000).'折'; ?><!--</td>-->
                        <td class="align-center"><?php echo $v['start_time']; ?>&nbsp;&nbsp;点</td>
                        <td class="align-center"><?php echo $v['end_time']; ?>&nbsp;&nbsp;点</td>

                        <td class="align-center">
                            <a href="javascript:void(0)" onclick="editActivityInfo('<?php echo $v['id'] ?>','<?php echo $v['title'] ?>','<?php echo $v['discount'] ?>','<?php echo $v['start_time'] ?>','<?php echo $v['end_time'] ?>','<?php echo $v['desc'] ?>');">
                                修改 </a>
                            <a href="<?php echo ADMIN_SITE_URL . '/activity/getGoodsList?id=' . $v['id'] . '&title=' . $v['title'] ?>">添加商品</a>
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
<!--            <tr class="tfoot">-->
<!--                <td><input type="checkbox" class="checkall" id="checkallBottom"></td>-->
<!--                <td colspan="16"><label for="checkallBottom">全选</label>-->
<!--                    &nbsp;&nbsp;<a id="submit" href="javascript:void(0)" class="btn"><span>添加活动</span></a>-->
<!--            </tr>-->
            </tfoot>
        </table>
    </form>
</div>
<form id="edit_activity">
    <div id="edit_activity_div"
         style="display:none;position:fixed;left:0;top:0;width:100%;height: 100%;z-index:99;background:#000;background:rgba(0, 0, 0, 0.6)!important;filter:Alpha(opacity=60);background:#000; text-align:left;">
        <div style="width: 25%;left: 35%;top: 20%;position: absolute;background: #fff">
            <input type="hidden" name="activityId" id="activityId" class="txt"/>
            <table class="table tb-type2" style="width: 100%;height: 100%;">
                <tr class="space">
                    <th colspan="3">修改活动信息</th>
                </tr>
                <tr>

                    <td class="required">
                        <label class="validation" for="activityName">活动名称:</label>
                        <label type="text" id="activityName"></label>
                    </td>
                </tr>
<!--                <tr>-->
<!--                    <td class="required">-->
<!--                        <label class="validation" for="activityDiscount">折扣:</label>-->
<!--                        <input type="text" name="activityDiscount" id="activityDiscount" class="txt"/>-->
<!--                        <label >(这个值除以1000得到折扣)</label>-->
<!--                    </td>-->
<!--                </tr>-->
                <tr>
                    <td class="required">
                        <label class="validation" for="startTime">每日开始时间:</label>
                        <input type="text" name="startTime" id="startTime" class="txt"/>
                    </td>
                </tr>
                <tr>
                    <td class="required">
                        <label class="validation" for="endTime">每日结束时间:</label>
                        <input type="text" name="endTime" id="endTime" class="txt"/>
                    </td>
                </tr>
                <tr>
                    <td class="required">
                        <label class="validation" for="desc" >活动描述:</label>

                    </td>

                </tr>
                <tr>
                    <td class="required">
                        <textarea type="text" name="desc" id="desc" class="txt" style="width: 70%;height: 100px" maxlength="200"></textarea>
                    </td>
                </tr>

                <tr class="tfoot">
                    <td colspan="3"><a class="btn" id="submitBtn" onclick="$('#edit_activity').submit()"><span>提交</span></a><a class="btn" id="cancelBtn"><span>取消</span></a></td>
                </tr>
            </table>
        </div>
    </div>
</form>
<?php echo _get_html_cssjs('admin_js', 'jquery-ui/jquery.ui.js', 'js'); ?>
<?php echo _get_html_cssjs('admin_js', 'jquery.mousewheel.js', 'js'); ?>
<?php echo _get_html_cssjs('admin_css', 'jquery.ui.css', 'css'); ?>
<?php echo _get_html_cssjs('admin_js', 'common_select.js', 'js'); ?>

<script type="text/javascript">
    function editActivityInfo(id, title, discount, start, end,desc) {

        $("#edit_activity_div").show();
        $('#activityId').val(id);
        $('#activityName').text(title);
        $('#activityDiscount').val(discount);
        $('#startTime').val(start);
        $('#endTime').val(end);
        $('#desc').val(desc);
    }


    $(document).ready(function () {
        $('#cancelBtn').click(function () {
            $('#edit_activity_div').hide();
        })

        $('#edit_activity').validate({
            rules: {

//                activityDiscount: {
//                    "required": true,
//                    "number": true,
//                    "min": 1,
//
//                },
                startTime: {
                    "required": true,
                    "number": true,
                    "range": [0, 24],

                },
                endTime: {
                    "required": true,
                    "number": true,
                    "range": [0, 24],
                },
                end: {
                    "required": true,
                },
            },
            messages: {

//                activityDiscount: {
//                    "required": '请填入折扣',
//                    "number": '必须是数字',
//                    "min": '不能小于1',
//                },
                startTime: {
                    "required": '请填入开始时间',
                    "number": '必须是数字',
                    "range": '时间必须是0-24点',
                },
                endTime: {
                    "required": '请填入结束时间',
                    "number": '必须是数字',
                    "range": '时间必须是0-24点',
                },
                end: {
                    "required": '请输入描述',
                },

            },
            submitHandler: function () {
                var obj = {
                    'id':$('#activityId').val(),
//                    'discount':$('#activityDiscount').val(),
                    'start_time':$('#startTime').val(),
                    'end_time':$('#endTime').val(),
                    'desc':$('#desc').val(),
                };

                sendPostData(obj, '<?php echo ADMIN_SITE_URL . '/activity/editActivity' ?>', function (result) {
                    if (result.code == 1) {
                        $('#add_goods_div').hide();
                        location.reload()
                    } else {
                        alert(result.msg);
                    }
                })
            }

        });

    });

</script>
</body>
</html>
