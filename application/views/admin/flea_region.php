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
      <h3>查看地区</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
   <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th class="nobg" colspan="12"><div class="title"><h5><?php echo lang('nc_prompts');?></h5><span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
        <ul>
            <li>添加，编辑或删除操作后需要点击"提交"按钮才生效</li>
          </ul></td>
      </tr>
    </tbody>
  </table> 
  <table class="tb-type1 noborder search">
    <tbody>
      <tr>
        <th><label>查看下一级地区</label></th>
        <td><select name="province" id="province" onchange="refreshdistrict($(this).val(),'province')">
			<option value="" >-城市-</option>
			<?php if(!empty($province) && is_array($province)){ ?>
			<?php foreach($province as $k => $v){ ?>
			<option value="<?php echo $v[0];?>" <?php if($v[0] == $ptype){?>selected<?php }?>><?php echo $v[1];?></option>
			<?php } ?>
			<?php } ?>
		  </select>
		  <select name="city" id="city" onchange="refreshdistrict($(this).val(),'city')">
			<option value="" >-地区-</option>
			<?php if(!empty($city) && is_array($city)){ ?>
			<?php foreach($city as $k => $v){ ?>
			<option value="<?php echo $v[0];?>" <?php if($v[0] == $ctype){?>selected<?php }?>><?php echo $v[1];?></option>
			<?php } ?>
			<?php } ?>
		  </select></td>
      </tr>
    </tbody>
  </table>
  <form method="post" id='form_area_list'; action="<?php echo ADMIN_SITE_URL.'/flea_region/save'?>">
    <input type="hidden" name="form_submit" value="ok" />
    <input type='hidden' name=province_id value="<?php echo $ptype;?>" />
    <input type='hidden' name='flea_area_parent_id' value="<?php echo $flea_area_parent_id;?>" />
    <input type='hidden' name='child_area_deep' value="<?php echo $child_area_deep;?>" />
    <input type='hidden' name='hidden_del_id' id='hidden_del_id' value='' />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="align-center">排序</th>
          <th>地区名称</th>
          <th class="align-center"><?php echo lang('nc_handle');?></th>
        </tr>
      </thead>
      <tbody id="treet1">
		<?php if(!empty($list) && is_array($list)){ ?>
        <?php foreach($list as $k => $v){?>
        <tr id='area_tr_<?php echo $v[0];?>' class="hover edit">
        <td class="w48 sort align-center"><span id='area_sort_<?php echo $v[0];?>'><input name="area_sort[<?php echo $v[0];?>]" value="<?php echo $v[2];?>" type='text'/></span></td><td class="node"><span class="node_name" id='area_name_<?php echo $v[0];?>'><input name="area_name[<?php echo $v[0];?>]" value="<?php echo $v[1];?>" type='text'/></span></td>
        <td class="w72 align-center"><a href="javascript:void(0)" onclick='del("<?php echo $v[0];?>");'><?php echo lang('flea_region_del');?></a></td>
        </tr>
        <?php } ?>
        <?php } ?>
      </tbody>
      <tbody>
        <tr>
          <td colspan="15"><a href="JavaScript:void(0);" class="btn-add marginleft" onclick='add_tr();'><span><?php echo lang('region_index_add');?></span></a></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15"><a href="JavaScript:void(0);" class="btn" onclick="form_list_submit();"><span><?php echo lang('nc_submit');?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>


function add_tr(){
	$('#treet1').append('<tr class="hover edit"><td class="w48 sort"><input type="text" name="new_area_sort[]" value="0" /></td><td class="node"><input type="text" name="new_area_name[]" value="" /></td><td></td></tr>');
}
function edit(id){
	//sort
	$('#area_sort_'+id).html("<input name='area_sort["+id+"]' value='"+$('#hidden_area_sort_'+id).val()+"' type='text'/>");
	//name
	$('#area_name_'+id).html("<input name='area_name["+id+"]' value='"+$('#hidden_area_name_'+id).val()+"' type='text'/> ");
}
function del(id){
	$('#area_tr_'+id).remove();
	$('#hidden_del_id').val($('#hidden_del_id').val()+'|'+id);
}
function refreshdistrict(parent_id,type){
	var url = '';
	if(type == 'province'){
		url += '&province='+$('#province').val();
	}
	if(type == 'city'){
		url += '&province='+$('#province').val()+'&city='+$('#city').val();
	}
	if(type == 'district'){
		url += '&province='+$('#province').val()+'&city='+$('#city').val()+'&district='+$('#district').val();
	}
	location.href='<?php echo ADMIN_SITE_URL;?>/flea_region?flea_area_parent_id='+parent_id+url;
}
function form_list_submit(){
	if($('#hidden_del_id').val()){
		if(!confirm('<?php echo lang('region_index_del_tip');?>?')){
			return false;
		}
	}
	$('#form_area_list').submit();
}
</script> 
</body>
</html>