
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
      <h3>评价管理</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>来自买家的评价</span></a></li>
        
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" name="formSearch">
    <input type="hidden" name="act" value="evaluate" />
    
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="user_name">商品名称</label></th>
          <td><input class="txt" type="text" name="txtKey" id="txtKey" value="<?php if (isset($arrParam['txtKey'])){echo $arrParam['txtKey'];}?>" /></td>
          <td>评价时间</td>
          <td><input class="txt date" type="text" value="<?php if (isset($arrParam['addtime'])){echo $arrParam['addtime'];}?>" id="addtime" name="addtime">
              <label for="addtime">~</label>
              <input class="txt date" type="text" value="<?php if (isset($arrParam['etime'])){echo $arrParam['etime'];}?>" id="etime" name="etime"/></td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search " title="<?php echo lang('nc_query');?>">&nbsp;</a></td>
        </tr>
      </tbody>
    </table>
  </form>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title">
            <h5>操作提示</h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li>买家可在订单完成后对订单商品进行评价操作</li>
            <li>评价信息将显示在对应的商品页面</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <table class="table tb-type2">
    <thead>
      <tr class="thead">
        <th class="w300">商品名称</th>
        <th>评论内容</th>
        <th class="w108 align-center">评论人</th>
        <th class="w108 align-center">店铺名称</th>
        <th class="w72 align-center">操作</th>
      </tr>
    </thead>
    <tbody>
     <?php if(!empty($list['rows']) && is_array($list['rows'])){ ?>
        <?php foreach($list['rows'] as $k => $v){ ?>
      <tr class="hover">
        <td><?php if(!empty($v['title'])) echo $v['title'];?></td>
        <td class="evaluation"><div>商品评分：<span class="raty" data-score="<?php echo $v['score_level'];?>"></span>&nbsp;<?php echo $v['score_level'];?>分&nbsp;<time>[<?php echo @date('Y-m-d',$v['addtime']);?>]</time></div>
          <div>评价内容：<?php echo $v['comment'];?></div>
          
          <?php if(!empty($v['pic_path'])) {?>
          <div>晒图：
            <ul class="evaluation-pic-list">
              <?php $image_array = explode('|', $v['pic_path']);?>
              <?php foreach ($image_array as $value) { ?>
              <li><a nctype="nyroModal"  href="<?php echo BASE_SITE_URL.'/'.$value;?>" target="_blank"> <img src="<?php echo BASE_SITE_URL.'/'.$value;?>"> </a></li>
              <?php } ?>
            </ul>
          </div>
          <?php } ?>
          <?php if(!empty($v['reply_comment'])){?>
          <div id="explain_div_<?php echo $v['id'];?>"> <span style="color:#996600;padding:5px 0px;">[<?php echo lang('admin_evaluate_explain'); ?>]<?php echo $v['geval_explain'];?></span> </div>
          <?php }?></td>
        <td class="align-center"><?php if(!empty($v['user_name'])) echo $v['user_name'];?></td>
        <td class="align-center"><?php if(!empty($v['shop_name'])) echo $v['shop_name'];?></td>
        <td class="align-center"><a href="<?php echo ADMIN_SITE_URL.'/comment/del?id='.$v['id'];?>">删除</a></td>
      </tr>
      <?php }?>
      <?php }
      else{?>
      <tr class="no_data">
        <td colspan="15"><?php echo lang('nc_no_record');?></td>
      </tr>
      <?php }?>
   
    <tfoot>
      <tr class="tfoot">
        <td colspan="15" id="dataFuncs"><div class="pagination"><?php  echo $list['pages'];?></div></td>
      </tr>                             
    </tfoot>
    
  </table>
</div>
<form id="submit_form" action="<?php echo ADMIN_SITE_URL.'/comment/del'?>" method="post">
  <input id="geval_id" name="geval_id" type="hidden">
</form>
<!-- <script type="text/javascript" src="<?php //echo ADMIN_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>  -->
<!-- <script type="text/javascript" src="<?php //echo ADMIN_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js" charset="utf-8"></script> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php //echo ADMIN_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  /> -->
<!-- <script type="text/javascript" src="<?php //echo ADMIN_SITE_URL;?>/js/jquery.raty/jquery.raty.min.js"></script> --> 
<!-- <script type="text/javascript" src="<?php //echo ADMIN_SITE_URL;?>/js/jquery.nyroModal/custom.min.js" charset="utf-8"></script> --> 
<!-- <script type="text/javascript" src="<?php //echo ADMIN_SITE_URL;?>/js/jquery.poshytip.min.js" charset="utf-8"></script> -->
<!-- <link href="<?php //echo ADMIN_SITE_URL;?>/js/jquery.nyroModal/styles/nyroModal.css" rel="stylesheet" type="text/css" id="cssfile2" /> -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#addtime').datepicker({dateFormat: 'yy-mm-dd'});
        $('#etime').datepicker({dateFormat: 'yy-mm-dd'});

        /*$('.raty').raty({
            path: "<?php echo ADMIN_SITE_URL;?>/js/jquery.raty/img",
            readOnly: true,
            score: function() {
              return $(this).attr('data-score');
            }
        });*/

        
    });
</script>
<?php echo _get_html_cssjs('lib','jquery-ui/themes/ui-lightness/jquery.ui.css','css');?>
<?php echo _get_html_cssjs('lib','jquery-ui/jquery.ui.js','js');?>

</body>
</html>
