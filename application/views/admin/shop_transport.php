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
            <h3>运费模板</h3>
            <ul class="tab-base">
            <li><a href="JavaScript:void(0);" class="current"><span>模板列表</span></a></li>
            <li><a href="<?php echo ADMIN_SITE_URL.'/shop_transport/add';?>"><span>新增模板</span></a></li>
            </ul>
        </div>
    </div>
    <table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" style="margin-top:32px" width="100%">
    </table>
    <table class="table tb-type2" >
      <thead>
        <tr class="thead">
          <th >模板名称</th>
          <th class="align-center"><?php echo lang('transport_snum');?></th>
          <th class="align-center"><?php echo lang('transport_price');?></th>
          <th class="align-center"><?php echo lang('transport_xnum');?></th>
          <th class="align-center"><?php echo lang('transport_price');?></th>
          <th class="align-center">修改时间</th>
          <th class="align-center">操作</th>
        </tr>
      </thead>
      <?php foreach ($trans as $v){?>
                    <tbody>
                    <?php foreach ($tpl_trans as $value){?>
                        <?php if ($value['transport_id'] == $v['id']){?>
                            <tr>
                                <td ><?php echo $v['title'];?></td>
                                <td class="align-center"><?php echo $value['snum'];?></td>
                                <td class="align-center"><?php echo $value['sprice'];?></td>
                                <td class="align-center"><?php echo $value['xnum'];?></td>
                                <td class="align-center"><?php echo $value['xprice'];?></td>
                                <td class="align-center"><?php echo date('Y-m-d H:i:s',$v['updatetime']);?></td>
                                <td class="align-center"><a class="ml5 ncsc-btn-mini ncsc-btn-orange" data-param="{name:'<?php echo $v['title'];?>',id:'<?php echo $v['id'];?>',price:''}" href="javascript:void(0)"><!--<i class="icon-truck"></i>--><?php echo lang('transport_applay');?></span></a> | 
                                                                      <a class="J_Clone ncsc-btn-mini" href="javascript:void(0)" data-id="<?php echo $v['id'];?>"><!--<i class="icon-copy"></i>--><?php echo lang('transport_tpl_copy');?></a> | 
                                                                      <a class="J_Modify ncsc-btn-mini" href="javascript:void(0)" data-id="<?php echo $v['id'];?>"><!--  <i class="icon-edit"></i>--><?php echo lang('transport_tpl_edit');?></a> | 
                                                                      <a class="J_Delete ncsc-btn-mini" href="javascript:void(0)" data-id="<?php echo $v['id'];?>"><!--<i class="icon-trash"></i>--><?php echo lang('transport_tpl_del');?></a></td>
                            </tr>
                        <?php }?>
                    <?php }?>
                    </tbody>
                <?php }?>
    </table>
</div>
<script>
$(function(){	
	$('a[class="J_Delete ncsc-btn-mini"]').click(function(){
		var id = $(this).attr('data-id');
		if(typeof(id) == 'undefined') return false;
		if( confirm('<?php echo lang('transport_del_confirm');?>') )
            window.location.href='<?php echo ADMIN_SITE_URL;?>/shop_transport/del?id='+id;
//		$(this).attr('href','<?php echo ADMIN_SITE_URL;?>/shop_transport/del?id='+id);
//		return true;
	});

	$('a[class="J_Modify ncsc-btn-mini"]').click(function(){
		var id = $(this).attr('data-id');
		if(typeof(id) == 'undefined') return false;
		$(this).attr('href','<?php echo ADMIN_SITE_URL;?>/shop_transport/edit?id='+id);
		return true;
	});
	
	$('a[class="J_Clone ncsc-btn-mini"]').click(function(){
		var id = $(this).attr('data-id');
		if(typeof(id) == 'undefined') return false;
		$(this).attr('href','<?php echo ADMIN_SITE_URL;?>/shop_transport/clone_tpl?id='+id);
		return true;
	});
	$('a[class="ml5 ncsc-btn-mini ncsc-btn-orange"]').click(function(){
		var data_str = '';
		eval('data_str = ' + $(this).attr('data-param'));
		$("#postageName", opener.document).css('display','inline-block').html(data_str.name);
		$("#transport_title", opener.document).val(data_str.name);
		$("#transport_id", opener.document).val(data_str.id);
		$("#g_freight", opener.document).val(data_str.price);
		window.close();
	});	

});
</script>
</body>
</html>