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
      <h3><?php echo lang('goods_class_index_class');?></h3>
      <ul class="tab-base">
        <li><a href="<?php echo ADMIN_SITE_URL.'/category'?>"><span><?php echo lang('nc_manage');?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current" ><span><?php echo lang('nc_new');?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="goods_class_form"  method="post" action="<?php echo ADMIN_SITE_URL.'/category/save'?>">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="edit_id" id="cid" value="<?php if (!empty($info['id'])) echo $info['id'];?>" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="gc_name"><?php echo lang('goods_class_index_name');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if (!empty($info['name'])) echo $info['name'];?>" name="gc_name" id="gc_name" maxlength="20" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="parent_id"><?php echo lang('goods_class_add_sup_class');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><select name="gc_parent_id" id="gc_parent_id">
              <option value="0"><?php echo lang('nc_please_choose');?>...</option>
              <?php if(!empty($type) && is_array($type)){ ?>
              <?php foreach($type[0] as $k => $v){ ?>
              <option <?php if((isset($parent_id) && $parent_id == $v['id']) || (isset($info['parent_id']) && $info['parent_id'] == $v['id'])){ ?>selected='selected'<?php } ?> value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
              <?php foreach ($type[$v['id']] as $key => $value){?>
              <option <?php if((isset($parent_id) && $parent_id == $value['id'])||(isset($info['parent_id']) && $info['parent_id'] == $value['id'])){ ?>selected='selected'<?php } ?> value="<?php echo $value['id'];?>"><?php echo '　'.$value['name'];?></option>
              <?php } ?>
              <?php } ?>
              <?php } ?>
            </select></td>
          <td class="vatop tips"><?php echo lang('goods_class_add_sup_class_notice');?></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label><?php echo lang('nc_sort');?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if (!empty($info['sort'])) echo $info['sort']; else echo '0';?>" name="gc_sort" id="gc_sort" class="txt"></td>
          <td class="vatop tips"><?php echo lang('goods_class_add_update_sort');?></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label>自定义属性&值:</label>&nbsp;&nbsp;<input type="button" id="btnSpuAdd" value="+" name="btnSpuAdd">&nbsp;(属性值 多项用,来间隔)</td>
        </tr>
        <tr>
          <td id="tdSpuList" colspan="2">
            <?php if(!empty($info['spu_attr_val'])):
            foreach($info['spu_attr_val'] as $k => $v): ?>
            <div class="spu_<?php echo $v['name_id'];?>">
              <select name="spu[<?php echo $v['name_id'];?>][input_type]" class="spu_attr_val">
                <option value="1"<?php echo $v['input_type']==1?' selected':'';?>>文本</option>
                <option value="2"<?php echo $v['input_type']==2?' selected':'';?>>下拉框</option>
              </select>
              <input type="text" value="<?php echo $v['name']?>" name="spu[<?php echo $v['name_id'];?>][name]" readonly class="txt" placeholder="属性名称">   
              <input type="text" value="<?php if(!empty($v['valList'])) echo implode(',', array_values($v['valList'])); ?>" name="spu[<?php echo $v['name_id'];?>][val]" class="txt" style="width:200px;<?php if($v['input_type']==1) echo 'display:none'?>" placeholder="属性值(多项用,来间隔)">
              <input type="button" value="-" name="btnSpuDel" nctype="<?php echo $v['name_id'];?>" spuid="<?php echo $info['spu']['id'];?>" spucode="<?php echo $info['spu']['spu_code'];?>"><br />
            </div>
            <?php endforeach;
            endif; ?>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label>规格:</label>&nbsp;&nbsp;<input type="button" id="btnSpecAdd" value="+" name="btnSpecAdd" style="display:<?php if(!empty($info['spec_attr_val']) && count($info['spec_attr_val'])>=2) echo 'none';?>">&nbsp;
            <br />(注：若有颜色，先加颜色)</td>
        </tr>
        <tr>
          <td id="tdSpecList" colspan="2">
            <table>
            <?php if(!empty($info['spec_attr_val'])):
            foreach($info['spec_attr_val'] as $k => $v):
              $strVal = '';
              if(is_array($v['valList']))
              {
                foreach ($v['valList'] as $kk => $vv) {
                  $strVal = $strVal.','.$vv['val'];
                }
                $strVal = trim($strVal,',');
              }
              ?>
            <tr class="spec_<?php echo $v['name_id'];?>">
            <td>
              <input type="hidden" name="spec[<?php echo $v['name_id']?>]" value="<?php echo $v['name_id']?>"><?php echo $v['name']?> : <?php echo $strVal; ?>
            </td>
            <td><input type="button" value="-" name="btnSpecDel" nctype="<?php echo $v['name_id'];?>"></td>
            </tr>
            <?php endforeach;
            endif; ?>
            </table>
          </td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2"><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo lang('nc_submit');?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script  type="text/javascript" src="<?php echo _get_cfg_path('admin_js');?>common_select.js" charset="utf-8"></script>
<script  type="text/javascript" src="<?php echo _get_cfg_path('admin_js');?>jquery.goods_class.js" ></script>
<script>
//按钮先执行验证再提交表单
$(function(){

  $('#type_div').perfectScrollbar();

  //spu
  var i = 0;
  $("#btnSpuAdd").click(function(){
    i = i-1;
    $("#tdSpuList").append('<div class="spu_'+i+';?>"><select name="spu['+i+'][input_type]" class="spu_attr_val"><option value="1">文本</option><option value="2">下拉框</option></select> <input type="text" value="" name="spu['+i+'][name]" class="txt" placeholder="属性名称">  <input type="text" value="" name="spu['+i+'][val]" class="txt" style="width:200px; display:none" placeholder="属性值(多项用,来间隔)"><br /></div>');
  });
  $(".spu_attr_val").live('change',function(){
    var obj = $(this).next().next();
    if($(this).val()==2)
      obj.show();
    else
      obj.hide();
  });

  $("input[name=btnSpuDel]").click(function(){
    var name_id = $(this).attr('nctype');
    if(name_id<0){
      $('.spu_'+name_id).hide();
      $('.spu_'+name_id+' select').remove();
      $('.spu_'+name_id+' input').remove();
      return;
    }


    var spuid = $(this).attr('spuid');
    var spucode = $(this).attr('spucode');
    $.ajax({
        url: "<?php echo ADMIN_SITE_URL;?>/category/ajax_spu",
        data:{
          name_id:name_id,
          spu_id:spuid,
          spu_code:spucode
        },  
        type:'post',
        success: function(data){
          if(data=='true'){
            $('.spu_'+name_id).hide();
            $('.spu_'+name_id+' select').remove();
            $('.spu_'+name_id+' input').remove();
          }
        },
        error: function(){
          alert('删除失败');
        }
      });
  });
  //-spu
  //spec
  var j = 0;
  var num = "<?php echo count(@$info['spec_attr_val'])?>";
  $("#btnSpecAdd").click(function(){
    num = parseInt(num)+1;
    j = j-1;
    <?php
    $strSpecOption = '';
     if(!empty($spec_list)):
      foreach($spec_list as $k => $v):
        $strSpecOption .= "<option value='".$v['name_id']."'>".$v['name']."</option>";
      endforeach;
    endif; ?>
    var specOption = "<?php echo $strSpecOption?>";

    var specDiv = '<div class="spec_'+j+';?>"><select name="spec['+j+']">'+specOption+'</select></div>';
    $("#tdSpecList").append(specDiv);
    if(parseInt(num)>=2)
      $(this).hide();
  });
  $("input[name=btnSpecDel]").click(function(){
    var name_id = $(this).attr('nctype');
    if(name_id<0){
      $('.spec_'+name_id).hide();
      $('.spec_'+name_id+' select').remove();
      $('.spec_'+name_id+' input').remove();
      return;
    }
    $.ajax({
        url: "<?php echo ADMIN_SITE_URL;?>/category/ajax_spec",
        data:{
          name_id:name_id,
          cid:$('#cid').val()
        },  
        type:'post',
        success: function(data){
          if(data=='true'){
            $('.spec_'+name_id).hide();
            $('.spec_'+name_id+' select').remove();
            $('.spec_'+name_id+' input').remove();
            num = num-1;
            if(num<2)
              $('#btnSpecAdd').show();
          }else{
            alert('规格在使用中，不能删除');
          }
        },
        error: function(){
          alert('删除失败');
        }
      });
  });
  //-spec


    
	$("#submitBtn").click(function(){
		if($("#goods_class_form").valid()){
			$("#goods_class_form").submit();
      alert("操作成功");
		}
	});

	
	$("#pic").change(function(){
		$("#textfield1").val($(this).val());
	});
	$('input[type="radio"][name="t_id"]').click(function(){
		if($(this).val() == '0'){
			$('#t_name').val('');
		}else{
			$('#t_name').val($(this).next('span').html());
		}
	});
	
	$('#goods_class_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        rules : {
            gc_name : {
                required : true,
                remote   : {                
                url :"/admin/category/ajax_check_name?id=<?php if(!empty($info['id']) ) echo $info['id'];?>",
                type:'get',
                data:{
                    gc_name : function(){
                        return $('#gc_name').val();
                    },
                    gc_parent_id : function() {
                        return $('#gc_parent_id').val();
                    },
                  }
                }
            },
            gc_sort : {
                number   : true
            }
        },
        messages : {
            gc_name : {
                required : '<?php echo lang('goods_class_add_name_null');?>',
                remote   : '<?php echo lang('goods_class_add_name_exists');?>'
            },
            gc_sort  : {
                number   : '<?php echo lang('goods_class_add_sort_int');?>'
            }
        }
    });

	// 所属分类
    $("#gc_parent_id").live('change',function(){
    	type_scroll($(this));
    });
    // 类型搜索
    $("#gcategory > select").live('change',function(){
    	type_scroll($(this));
    });
});
var typeScroll = 0;
function type_scroll(o){
	var id = o.val();
	if(!$('#type_dt_'+id).is('dt')){
		return false;
	}
	$('#type_div').scrollTop(-typeScroll);
	var sp_top = $('#type_dt_'+id).offset().top;
	var div_top = $('#type_div').offset().top;
	$('#type_div').scrollTop(sp_top-div_top);
	typeScroll = sp_top-div_top;
}
//gcategoryInit('gcategory');
</script> 

</body>
</html>