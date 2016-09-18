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

<style type="text/css">
.waybill-img-thumb { background-color: #FFF; vertical-align: top; display: inline-block; *display: inline; width: 70px; height: 45px; padding: 1px; border: solid 1px #E6E6E6; *zoom: 1;}
.waybill-img-thumb a { line-height: 0; text-align: center; vertical-align: middle; display: table-cell; *display: block; width: 70px; height: 45px; overflow: hidden;}
.waybill-img-thumb a img { max-width: 70px; max-height: 45px; margin-top:expression(45-this.height/2); *margin-top:expression(22-this.height/2)/*IE6,7*/;}
.waybill-img-size { color: #777; line-height: 20px; vertical-align: top; display: inline-block; *display: inline; margin-left: 10px; *zoom: 1;}
</style>

</head>
<body>



<div class="page"> 
  <!-- 页面导航 -->
  <div class="fixed-bar">
    <div class="item-title">
      <h3>运单模板</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>列表</span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/waybill/add'?>" ><span>添加</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <!-- 帮助 -->
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12" class="nobg"> <div class="title">
            <h5><?php echo lang('nc_prompts');?></h5>
            <span class="arrow"></span> </div>
        </th>
      </tr>
      <tr>
        <td><ul>
            <li>平台现有运单模板列表</li>
            <li>点击设计按钮可以对运单模板布局进行设计，点击测试按钮可以对模板进行打印测试，点击编辑按钮可以对模板参数进行调整</li>
            <li>设计完成后在编辑中修改模板状态为启用后，商家就可以绑定该模板进行运单打印</li>
            <li>点击删除按钮可以删除现有模板，删除后所有使用该模板的商家将自动解除绑定，请慎重操作</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <!-- 列表 -->
  <form id="list_form" method="post" >
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo lang('nc_list');?></th>
        </tr>
        <tr class="thead">
          <th class="w12">&nbsp;</th>
          <th>模板名称</th>
          <th class="w200">物流公司</th>
          <th class="w270">运单图例</th>
          <th class="w108 align-center">上偏移量</th>
          <th class="w108 align-center">左偏移量</th>
          <th class="w96 align-center">启用</th>
          <th class="w200 align-center"><span><?php echo lang('nc_handle');?></span></th>
        </tr>
      </thead>
      <tbody id="treet1">
        <?php if(!empty($list) && is_array($list)){ ?>
        <?php foreach($list as $key => $value){ ?>
        <tr class="hover">
          <td>&nbsp;</td>
          <td><?php echo $value['name'];?></td>
          <td><?php echo $value['express_name'];?></td>
          <td>
          <div class="waybill-img-thumb"><a class="nyroModal" rel="gal" href="<?php echo BASE_SITE_URL.'/';?><?php if (!empty($value['pic'])){echo $value['pic'];}else {echo 'res/admin/images/default_goods_image_240.gif';}?>"><img src="<?php echo BASE_SITE_URL.'/';?><?php if (!empty($value['pic'])){echo $value['pic'];}else {echo 'res/admin/images/default_goods_image_240.gif';}?>"></a></div>
          <div class="waybill-img-size"><p>宽度：<?php echo $value['width'];?>(mm)</p><p>高度：<?php echo $value['height'];?>(mm)</p></div></td>
          <td class="align-center"><?php echo $value['wb_top'];?></td>
          <td class="align-center"><?php echo $value['wb_left'];?></td>
          <td class="align-center yes-onoff"><?php echo $value['status']; ?></td>
          <td class="nowrap align-center"><a href="<?php echo ADMIN_SITE_URL.'/waybill/design?id='.$value['id']?>">设计</a>&nbsp;|&nbsp;<a href="<?php echo ADMIN_SITE_URL.'/waybill/test?id='.$value['id']?>" target="_blank">测试</a>&nbsp;|&nbsp;<a href="<?php echo ADMIN_SITE_URL.'/waybill/add?id='.$value['id']?>">编辑</a>&nbsp;|&nbsp;<a href="javascript:;" nctype="btn_del" data-waybill-id="<?php echo $value['id'];?>">删除</a></td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="16"><?php echo lang('nc_no_record');?></td>
        </tr>
        <?php } ?>
      </tbody>
      <?php if (!empty($pages)){?>
      <tfoot>
        <tr class="tfoot">
          <td colspan="16"><div class="pagination"> <?php echo $pages;?> </div></td>
        </tr>
      </tfoot>
      <?php }?>
    </table>
  </form>
</div>
<form id="del_form" method="post" action="<?php echo ADMIN_SITE_URL.'/waybill/del'?>">
  <input type="hidden" id="del_waybill_id" name="waybill_id">
</form>
<?php echo _get_html_cssjs('admin_js','custom.min.js','js');?>
<?php echo _get_html_cssjs('admin_css','nyroModal.css','css');?>
<script type="text/javascript">
    $(document).ready(function(){
        $('[nctype="btn_del"]').on('click', function() {
            if(confirm('确认删除?')) {
                $('#del_waybill_id').val($(this).attr('data-waybill-id'));
                $('#del_form').submit();
            }
        });

        //点击查看大图	
    	$('.nyroModal').nyroModal();
    });
</script> 
</body>
</html>
