<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>coupon</title>
  <?php echo _get_html_cssjs('admin_js','jquery.js,jquery.validation.min.js,admincp.js,jquery.cookie.js,common.js','js');?>
  <link href="<?php echo _get_cfg_path('admin').TPL_ADMIN_NAME;?>css/skin_0.css" type="text/css" rel="stylesheet" id="cssfile" />
  <?php echo _get_html_cssjs('admin_css','perfect-scrollbar.min.css','css');?>

  <?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome.min.css','css');?>

  <!--[if IE 7]>
  <?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome-ie7.min.css','css');?>
  <![endif]-->
  <?php echo _get_html_cssjs('admin_js','perfect-scrollbar.min.js','js');?>
  <script>
    //



    function openItem(args){
      //cookie

      if($.cookie('<?php echo COOKIE_PRE?>sys_key') === null){
        //location.href = 'index.php?act=login&op=login';
        //return false;
      }

      var spl = args.split(',');
      var op  = spl[0];
      var nav;
      try {
        var act = spl[1];
        nav = spl[2];
      }catch(ex){}
      if (typeof(act)=='undefined'){var nav = args;}
      $('.actived').removeClass('actived');
      $('#nav_'+nav).addClass('actived');

      $('.selected').removeClass('selected');

      //show
      $('#mainMenu ul').css('display','none');
      $('#sort_'+nav).css('display','block');

      if (typeof(act)=='undefined'){
        //顶部菜单事件
        var html = $('#sort_'+nav+'>li>dl>dd>ol>li').first().html();
        str = html.match(/openItem\('(.*)'\)/ig);
        arg = str[0].split("'");
        spl = arg[1].split(',');
        op  = spl[0];
        act = spl[1];
        nav = spl[2];
        first_obj = $('#sort_'+nav+'>li>dl>dd>ol>li').first().children('a');
        $(first_obj).addClass('selected');
        //crumbs
        $('#crumbs').html('<span>'+$('#nav_'+nav+' > span').html()+'</span><span class="arrow">&nbsp;</span><span>'+$(first_obj).text()+'</span>');
      }else{
        //左侧菜单事件
        //location
        $.cookie('now_location_nav',nav);
        $.cookie('now_location_act',act);
        $.cookie('now_location_op',op);
        $("a[name='item_"+op+act+"']").addClass('selected');
        //crumbs
        $('#crumbs').html('<span>'+$('#nav_'+nav+' > span').html()+'</span><span class="arrow">&nbsp;</span><span>'+$('#item_'+op+act).html()+'</span>');
      }
      var src = '<?php echo ADMIN_SITE_URL?>/'+act+'/'+op;
      $('#workspace').attr('src',src);

    }

    function  deleteCoupon(id){

        sendPostData({id:id},'<?php echo ADMIN_SITE_URL . '/coupon/delete' ?>',function(result){
            if(result.code ==1){
                location.reload();
            }else{
                alert(result.msg)
            }
        })

    }


  </script>
</head>
<body>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
    <h3>优惠券管理</h3>
    <ul class="tab-base">
      <li><a class="current"><span>优惠券管理</span></a></li >
      <li><a href="/admin/coupon/add"><span>新增优惠券</span></a></li>
    </ul>
    </div>
  </div>
</div>
<div class="fixed-empty"></div>

<table class="table tb-type2" id="prompt">
  <tbody>
  <tr class="space odd">
    <th class="nobg" colspan="12"><div class="title"><h5>操作提示</h5><span class="arrow"></span></div></th>
  </tr>
  <tr>
    <td>
      <ul>
        <li>管理员规定优惠券面额，店铺发放优惠券时面额从规定的面额中选择</li>
      </ul></td>
  </tr>
  </tbody>
</table>
<form method='post' id="list_form" action="<?php echo ADMIN_SITE_URL.'/coupon/delete'?>">
  <input type="hidden" id="voucher_price_id" name="voucher_price_id" value="" />
  <table class="table tb-type2">
    <thead>
    <tr class="thead">
      <th class="w24"></th>
      <th>代金券名称</th>
      <th>消费金额</th>
      <th>面额</th>
      <th>有效期</th>
      <th>剩余数量</th>
      <th>状态</th>
      <th>操作</th>
<!--      <th class="align-center">--><?php //echo $lang['nc_handle'];?><!--</th>-->
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($rows) && is_array($rows)){ ?>
      <?php foreach($rows as $v){ ?>
        <tr class="hover">
<!--        <td><input type="checkbox" name='id[]' value="--><?php //echo $v['id'];?><!--" class="checkitem"></td>-->
        <td></td>
        <td><span><?php echo $v['coupon_name'];?></span></td>
        <td><span>￥<?php echo $v['condition']?></span></td>
        <td><span>￥<?php echo $v['price']?></span></td>
        <td><span><?php echo $v['effective_time'].'天' ?></span></td>
        <td><span><?php echo $v['coupon_count'] - $v['receive_count'] ?></span></td>
        <td><span><?php $status = $v['status'] == 0 ? "有效":"无效"; echo $status        ?></span></td>
        <!-- <td><span><?php //echo $v['voucher_defaultpoints'];?></span></td> -->
        <td class="w96 align-center">
          <a class="btn-blue" href="/admin/coupon/detail?id=<?php echo $v['id'] ?>">编辑</a>
          <a class="btn-red" href="javascript:void(0)" onclick="deleteCoupon('<?php echo $v['id'] ?>');">删除</a>
        </td>
      <?php } ?>
    <?php }else { ?>
      <tr class="no_data">
        <td colspan="10">没有可以发放的优惠卡</td>
      </tr>
    <?php } ?>
    </tbody>
    <?php if(!empty($rows) && is_array($rows)){ ?>
      <tfoot>
            <tr class="tfoot">
                <div class="pagination"><?php echo $pages; ?></div>
                </td>
            </tr>
      </tfoot>
    <?php } ?>
  </table>
</form>
<div class="pagination" style="margin-bottom:20px;"><?php echo $pages; ?></div>
</body>
</html>