<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>hsht</title>
        <style>
            body { margin: 0; }
            .waybill_area { position: relative; width: <?php echo $info['width'];?>px; height: <?php echo $info['height'];?>px; }
            .waybill_back { position: relative; width: <?php echo $info['width'];?>px; height: <?php echo $info['height'];?>px; }
            .waybill_back img { width: <?php echo $info['width'];?>px; height: <?php echo $info['height'];?>px; }
            .waybill_design { position: absolute; left: 0; top: 0; width: <?php echo $info['width'];?>px; height: <?php echo $info['height'];?>px; }
            .waybill_item { position: absolute; left: 0; top: 0; width:100px; height: 20px; border: 1px solid #CCCCCC; }
        </style>
    </head>
    <body>
        <div class="waybill_back">
            <img src="<?php echo BASE_SITE_URL.'/'.$info['pic']?>" alt="">
        </div>
        <div class="waybill_design">
            <?php if(!empty($list) && is_array($list)) {?>
            <?php foreach ($list as $key=>$value){?>
            <div class="waybill_item" style="left:<?php echo $value['left'];?>px; top:<?php echo $value['top'];?>px; width:<?php echo $value['width'];?>px; height:<?php echo $value['height'];?>px;"><?php echo $key;?></div>
            <?php } ?>
            <?php } ?>
        </div>
        <div class="control">
            <a id="btn" href="javascript:;">打印</a>
        </div>
        <?php echo _get_html_cssjs('admin_js','jquery.js','js');?>
        <script>
            $(document).ready(function() {
                $('#btn').on('click', function() {
                    pos();

                    $('.waybill_back').hide();
                    $('.control').hide();

                    window.print();
                });

                var pos = function () {
                    var top = <?php echo $info['wb_top'];?>;
                    var left = <?php echo $info['wb_left'];?>;

                    $(".waybill_design").each(function(index) {
                        var offset = $(this).offset();
                        var offset_top = offset.top + top;
                        var offset_left = offset.left + left;
                        $(this).offset({ top: offset_top, left: offset_left})
                    });
                };
            });
        </script>

    </body>
</html>

