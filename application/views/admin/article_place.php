
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
      <h3><?php echo lang('adv_index_manage');?>文章分类</h3>
      <ul class="tab-base">
        
        <li><a href="JavaScript:void(0);" class="current"><span>文章分类列表<?php echo lang('adv_manage');?></span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/article_place/add';?>"><span >添加文章分类</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" id="store_form" action="<?php echo ADMIN_SITE_URL.'/article_place/del'?>">
    <input type="hidden" name="form_submit" value="ok" />
   
   
  <!----//全部都给我按照主键列去-------> 
   
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th></th>
          <th></th>
          <th>文章标题</th>
          <th>父节点</th>
         
          <th class="align-center">排序</th>
          <th class="align-center">状态</th>
          <th class="align-center" width="10%">编辑列</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($list['rows']) && is_array($list['rows'])){ ?>
        <?php foreach($list['rows'] as $k => $v){ ?>
        <tr class="hover">
          <td class="w24"><input type="checkbox" class="checkitem" name="del_id[]" value="<?php echo $v['id']; ?>" /></td>
 <!-- -------------------------------------------------------------------------------------------------- -->
   <td><img src="http://www.jshgwsc.com/admin/templates/default/images/tv-expandable.gif" fieldid="1" status="open" nc_type="flex">
</td>
 <td class="name"><span title="可编辑" required="1" fieldid="1" ajax_branch='article_class_name' fieldname="ac_name" nc_type="inline_edit" class="editable "><?php echo $v["name"];?></span> <a class='btn-add-nofloat marginleft' <a href="<?php echo ADMIN_SITE_URL.'/article_place/add?id='.$v['id'];?>"><span>新增下级</span></a></td>

   <td class="align-center nowrap"><?php echo $v['parent_id']; ?></td>
   <td class="align-center nowrap"><?php echo $v['sort']; ?></td>
    <td class="align-center nowrap"><?php echo $v['status']; ?></td>        
  
  
  
  
  
  
          
  <!-- -------------------------------------------------------------------------------------------------- -->
            
          <td class="w72 align-center">
          <a href="<?php echo ADMIN_SITE_URL.'/article_place/add?id='.$v['id'];?>">编辑</a>&nbsp;|&nbsp;
          <a href="<?php echo ADMIN_SITE_URL.'/article_place/del?id='.$v['id'];?>">删除</a></td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="15"><?php echo $output['ap_name'].' '.lang('nc_no_record');?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkall"/></td>
          <td id="batchAction" colspan="15"><span class="all_checkbox">
            <label for="checkall">全选<?php echo lang('nc_select_all');?></label>
            </span>&nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="if(confirm('您确定要删除选中信息吗？')){$('#store_form').submit();}"><span>删除<?php echo lang('nc_del');?></span></a>
            <div class="pagination"> <?php echo $list['pages'];?> </div></td>
        </tr>
      </tfoot>
    </table>

    
  </form>
</div>
<?php echo _get_html_cssjs('admin_js','zh-CN.js','js');?>
<?php echo _get_html_cssjs('lib','jquery-ui/themes/ui-lightness/jquery.ui.css','css');?>
<?php echo _get_html_cssjs('lib','jquery-ui/jquery.ui.js','js');?>
<script type="text/javascript">
$(function(){
    $('#effect_time').datepicker({dateFormat: 'yy-mm-dd'});
    $('#expire_time').datepicker({dateFormat: 'yy-mm-dd'});


    $('#ap_id').change(function(){
    	var select   = document.getElementById("ap_id");


    });
});
</script>
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#adv_form").valid()){
     $("#adv_form").submit();
	}
	});
});
//
$(document).ready(function(){
	$('#adv_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:article_place'));
        },
        rules : {
        	adv_name : {
                required : true
            },
            content : {
                required : true
            },
            memo : {
                required : true
            },
            effect_time  : {
                required : true,
                date	 : false
            },
            expire_time  : {
            	required : true,
                date	 : false
            }
        },
        messages : {
        	adv_name : {
                required : '<?php echo lang('adv_can_not_null');?>'
            },
            content : {
                required : '<?php echo lang('textadv_null_error');?>'
            },
            memo : {
                required : '<?php echo lang('textadv_null_error');?>'
            },
            effect_time  : {
                required : '<?php echo lang('adv_start_time_can_not_null'); ?>'
            },
            expire_time  : {
            	required   : '<?php echo lang('adv_end_time_can_not_null'); ?>'
            }
        }
    });
});
</script>
<script type="text/javascript">
$(function(){
	var textButton="<input type='text' name='textfield' id='textfield1' class='type-file-text' /><input type='button' name='button' id='button1' value='' class='type-file-button' />"
    $(textButton).insertBefore("#file_adv_pic");
    $("#file_adv_pic").change(function(){
	$("#textfield1").val($("#file_adv_pic").val());
    });

	var textButton="<input type='text' name='textfield' id='textfield3' class='type-file-text' /><input type='button' name='button' id='button3' value='' class='type-file-button' />"
    $(textButton).insertBefore("#file_flash_swf");
    $("#file_flash_swf").change(function(){
	$("#textfield3").val($("#file_flash_swf").val());
    });
    $('#ap_id').val('<?php echo $_GET['ap_id'];?>');
    $('#ap_id').change();
});
</script>
<!-- --JS文件------------------------- -->
<script>
$(document).ready(function(){
	//列表下拉
	$('img[nc_type="flex"]').click(function(){
		var status = $(this).attr('status');
		if(status == 'open'){
			var pr = $(this).parent('td').parent('tr');
			var id = $(this).attr('fieldid');
			var obj = $(this);
			$(this).attr('status','none');
			//ajax
			$.ajax({
				url: 'article_place.php?act=article_place&op=article_place&ajax=1&parent_id='+id,
				dataType: 'json',
				success: function(data){
					var src='';
					for(var i = 0; i < data.length; i++){
						var tmp_vertline = "<img class='preimg' src='templates/images/vertline.gif'/>";
						src += "<tr class='"+pr.attr('class')+" row"+id+"'>";
						src += "<td class='w36'><input type='checkbox' name='check_ac_id[]' value='"+data[i].ac_id+"' class='checkitem'>";
						if(data[i].have_child == 1){
							src += "<img fieldid='"+data[i].ac_id+"' status='open' nc_type='flex' src='"+ADMIN_TEMPLATES_URL+"/images/tv-expandable.gif' />";
						}else{
							src += "<img fieldid='"+data[i].ac_id+"' status='none' nc_type='flex' src='"+ADMIN_TEMPLATES_URL+"/images/tv-item.gif' />";
						}
						//图片
						src += "</td><td class='w48 sort'>";
						//排序
						src += "<span title='可编辑' ajax_branch='article_class_sort' datatype='number' fieldid='"+data[i].ac_id+"' fieldname='ac_sort' nc_type='inline_edit' class='editable'>"+data[i].ac_sort+"</span></td>";
						//名称
						src += "<td class='name'>";
						for(var tmp_i=1; tmp_i < (data[i].deep-1); tmp_i++){
							src += tmp_vertline;
						}
						if(data[i].have_child == 1){
							src += " <img fieldid='"+data[i].ac_id+"' status='open' nc_type='flex' src='"+ADMIN_TEMPLATES_URL+"/images/tv-item1.gif' />";
						}else{
							src += " <img fieldid='"+data[i].ac_id+"' status='none' nc_type='flex' src='"+ADMIN_TEMPLATES_URL+"/images/tv-expandable1.gif' />";
						}
						src += " <span title='可编辑' required='1' fieldid='"+data[i].ac_id+"' ajax_branch='article_class_name' fieldname='ac_name' nc_type='inline_edit' class='editable'>"+data[i].ac_name+"</span>";
						//新增下级
						if(data[i].deep < 2){
							src += "<a class='btn-add-nofloat marginleft' href='index.php?act=article_class&op=article_class_add&ac_parent_id="+data[i].ac_id+"'><span>新增下级</span></a></span>";
						}
						src += "</td>";
						
						//操作
						src += "<td class='w84'>";
						src += "<span><a href='index.php?act=article_class&op=article_class_edit&ac_id="+data[i].ac_id+"'>编辑</a>";
						src += " | <a href=\"javascript:if(confirm('删除该分类将会同时删除该分类的所有下级分类，您确定要删除吗'))window.location = 'index.php?act=article_class&op=article_class_del&ac_id="+data[i].ac_id+"';\">删除</a>";
						src += "</td>";
						src += "</tr>";
					}
					//插入
					pr.after(src);
					obj.attr('status','close');
					obj.attr('src',obj.attr('src').replace("tv-expandable","tv-collapsable"));
					$('img[nc_type="flex"]').unbind('click');
					$('span[nc_type="inline_edit"]').unbind('click');
					//重现初始化页面
                    $.getScript(RESOURCE_SITE_URL+"/js/jquery.edit.js");
					$.getScript(RESOURCE_SITE_URL+"/js/jquery.article_class.js");
					$.getScript(RESOURCE_SITE_URL+"/js/admincp.js");
				},
				error: function(){
					alert('获取信息失败');
				}
			});
		}
		if(status == 'close'){
			$(".row"+$(this).attr('fieldid')).remove();
			$(this).attr('src',$(this).attr('src').replace("tv-collapsable","tv-expandable"));
			$(this).attr('status','open');
		}
	})
});

<!------>
$(document).ready(function(){
    var url = window.location.search;
    var params  = url.substr(1).split('&');
    var act = '';
    var op  = '';
    for(var j=0; j < params.length; j++)
    {
        var param = params[j];
        var arr   = param.split('=');
        if(arr[0] == 'act')
        {
            act = arr[1];
        }
        if(arr[0] == 'op')
        {
            sort = arr[1];
        }
    }
	//给需要修改的位置添加修改行为
	$('span[nc_type="inline_edit"]').click(function(){
		var s_value  = $(this).text();
		var s_name   = $(this).attr('fieldname');
		var s_id     = $(this).attr('fieldid');
		var req      = $(this).attr('required');
		var type     = $(this).attr('datatype');
		var max      = $(this).attr('maxvalue');
		var ajax_branch      = $(this).attr('ajax_branch');
		$('<input type="text">')
                        .attr({value:s_value})
                        .insertAfter($(this))
                        .focus()
                        .select()
                        .keyup(function(event){
                        if(event.keyCode == 13)
                        {
                            if(req)
                            {
                                if(!required($(this).attr('value'),s_value,$(this)))
                                {
                                    return;
                                }
                            }
                            if(type)
                            {
                                if(!check_type(type,$(this).attr('value'),s_value,$(this)))
                                {
                                    return;
                                }
                            }
                            if(max)
                            {
                                if(!check_max($(this).attr('value'),s_value,max,$(this)))
                                {
                                    return;
                                }
                            }
                            $(this).prev('span').show().text($(this).attr("value"));
							//branch ajax 分支
							//id 修改内容索引标识
							//column 修改字段名
							//value 修改内容
                            $.get('index.php?act='+act+'&op=ajax',{branch:ajax_branch,id:s_id,column:s_name,value:$(this).attr('value')},function(data){
                                if(data === 'false')
                                {
                                    alert('名称已经存在，请您换一个');
                                    $('span[fieldname="'+s_name+'"][fieldid="'+s_id+'"]').text(s_value);
                                    return;
                                }
                            });
                            $(this).remove();
                        }
                    })
					.blur(function(){
					if(req)
					{
						if(!required($(this).attr('value'),s_value,$(this)))
						{
							return;
						}
					}
					if(type)
					{
						if(!check_type(type,$(this).attr('value'),s_value,$(this)))
						{
							return;
						}
					}
					if(max)
					{
						if(!check_max($(this).attr('value'),s_value,max,$(this)))
						{
							return;
						}
					}
					$(this).prev('span').show().text($(this).attr('value'));
					$.get('index.php?act='+act+'&op=ajax',{branch:ajax_branch,id:s_id,column:s_name,value:$(this).attr('value')},function(data){
						if(data === 'false')
							{
								alert('名称已经存在，请您换一个');
								$('span[fieldname="'+s_name+'"][fieldid="'+s_id+'"]').text(s_value);
								return;
							}
					});
					$(this).remove();
				});
		$(this).hide();
	});
	
	
		$('span[nc_type="inline_edit_textarea"]').click(function(){
		var s_value  = $(this).text();
		var s_name   = $(this).attr('fieldname');
		var s_id     = $(this).attr('fieldid');
		var req      = $(this).attr('required');
		var type     = $(this).attr('datatype');
		var max      = $(this).attr('maxvalue');
		var ajax_branch      = $(this).attr('ajax_branch_textarea');
		$('<textarea>')
                        .attr({value:s_value})
                        .appendTo($(this).parent())
                        .focus()
                        .select()
                        .keyup(function(event){
                        if(event.keyCode == 13)
                        {
                            if(req)
                            {
                                if(!required($(this).attr('value'),s_value,$(this)))
                                {
                                    return;
                                }
                            }
                            if(type)
                            {
                                if(!check_type(type,$(this).attr('value'),s_value,$(this)))
                                {
                                    return;
                                }
                            }
                            if(max)
                            {
                                if(!check_max($(this).attr('value'),s_value,max,$(this)))
                                {
                                    return;
                                }
                            }
                            $(this).prev('span').show().text($(this).attr("value"));
							//branch ajax 分支
							//id 修改内容索引标识
							//column 修改字段名
							//value 修改内容
                            $.get('index.php?act='+act+'&op=ajax',{branch:ajax_branch,id:s_id,column:s_name,value:$(this).attr('value')},function(data){
                                if(data === 'false')
                                {
                                    alert('名称已经存在，请您换一个');
                                    $('span[fieldname="'+s_name+'"][fieldid="'+s_id+'"]').text(s_value);
                                    return;
                                }
                            });
                            $(this).remove();
                        }
                    })
					.blur(function(){
					if(req)
					{
						if(!required($(this).attr('value'),s_value,$(this)))
						{
							return;
						}
					}
					if(type)
					{
						if(!check_type(type,$(this).attr('value'),s_value,$(this)))
						{
							return;
						}
					}
					if(max)
					{
						if(!check_max($(this).attr('value'),s_value,max,$(this)))
						{
							return;
						}
					}
					$(this).prev('span').show().text($(this).attr('value'));
					$.get('index.php?act='+act+'&op=ajax',{branch:ajax_branch,id:s_id,column:s_name,value:$(this).attr('value')},function(data){
						if(data === 'false')
							{
								alert('名称已经存在，请您换一个');
								$('span[fieldname="'+s_name+'"][fieldid="'+s_id+'"]').text(s_value);
								return;
							}
					});
					$(this).remove();
				});
		$(this).hide();
	});
	
	//给需要修改的图片添加异步修改行为
	$('img[nc_type="inline_edit"]').click(function(){
		var i_id    = $(this).attr('fieldid');
		var i_name  = $(this).attr('fieldname');
		var i_src   = $(this).attr('src');
		var i_val   = ($(this).attr('fieldvalue'))== 0 ? 1 : 0;
		var ajax_branch      = $(this).attr('ajax_branch');

		$.get('index.php?act='+act+'&op=ajax',{branch:ajax_branch,id:i_id,column:i_name,value:i_val},function(data){
		if(data == 'true')
			{
				if(i_val == 0)
				{
					$('img[fieldid="'+i_id+'"][fieldname="'+i_name+'"]').attr({'src':i_src.replace('enabled','disabled'),'fieldvalue':i_val});
				}
				else
				{
					$('img[fieldid="'+i_id+'"][fieldname="'+i_name+'"]').attr({'src':i_src.replace('disabled','enabled'),'fieldvalue':i_val});
				}
			}
		});
	});
	$('a[nc_type="inline_edit"]').click(function(){
		var i_id    = $(this).attr('fieldid');
		var i_name  = $(this).attr('fieldname');
		var i_src   = $(this).attr('src');
		var i_val   = ($(this).attr('fieldvalue'))== 0 ? 1 : 0;
		var ajax_branch      = $(this).attr('ajax_branch');

		$.get('index.php?act='+act+'&op=ajax',{branch:ajax_branch,id:i_id,column:i_name,value:i_val},function(data){
		if(data == 'true')
			{
				if(i_val == 0){
					$('a[fieldid="'+i_id+'"][fieldname="'+i_name+'"]').attr({'class':('enabled','disabled'),'title':('开启','关闭'),'fieldvalue':i_val});
				}else{
					$('a[fieldid="'+i_id+'"][fieldname="'+i_name+'"]').attr({'class':('disabled','enabled'),'title':('关闭','开启'),'fieldvalue':i_val});
				}
			}else{
				alert('响应失败');
			}
		});
	});
    //给每个可编辑的小图片的父元素添加可编辑标题 $('img[nc_type="inline_edit"]').parent().attr('title','可编辑');
   
    //给列表有排序行为的列添加鼠标手型效果
    $('span[nc_type="order_by"]').hover(function(){$(this).css({cursor:'pointer'});},function(){});
	
});
//检查提交内容的必须项
function required(str,s_value,jqobj)
{
	if(str == '')
	{
		jqobj.prev('span').show().text(s_value);
		jqobj.remove();
		alert('此项不能为空');
		return 0;
	}
return 1;
}
//检查提交内容的类型是否合法
function check_type(type, value, s_value, jqobj)
{
	if(type == 'number')
	{
		if(isNaN(value))
		{
		jqobj.prev('span').show().text(s_value);
		jqobj.remove();
		alert('此项仅能为数字');
		return 0;
		}
	}
	if(type == 'int')
	{
		var regu = /^-{0,1}[0-9]{1,}$/;
		if(!regu.test(value))
		{
			jqobj.prev('span').show().text(s_value);
			jqobj.remove();
			alert('此项仅能为整数');
			return 0;
		}
	}
	if(type == 'pint')
	{
		var regu = /^[0-9]+$/;
		if(!regu.test(value))
		{
			jqobj.prev('span').show().text(s_value);
			jqobj.remove();
			alert('此项仅能为正整数');
			return 0;
		}
	}
	if(type == 'zint')
	{
		var regu = /^[1-9]\d*$/;
		if(!regu.test(value))
		{
			jqobj.prev('span').show().text(s_value);
			jqobj.remove();
			alert('此项仅能为正整数');
			return 0;
		}
	}
		if(type == 'discount')
	{
		var regu = /[1-9]|0\.[1-9]|[1-9]\.[0-9]/;
		if(!regu.test(value))
		{
			jqobj.prev('span').show().text(s_value);
			jqobj.remove();
			alert('只能是0.1-9.9之间的数字');
			return 0;
		}
	}
	return 1;
}
//检查所填项的最大值
function check_max(str,s_value,max,jqobj)
{
	if(parseInt(str) > parseInt(max))
	{
		jqobj.prev('span').show().text(s_value);
		jqobj.remove();
		alert('此项应小于等于'+max);
		return 0;
	}
	return 1;
}


//新的inline_edit调用方法
//javacript
//$('span[nc_type="class_sort"]').inline_edit({act: 'microshop',op: 'update_class_sort'});
//html
//<span nc_type="class_sort" column_id="<?php echo $val['class_id'];?>" title="<?php echo $lang['nc_editable'];?>" class="editable tooltip"><?php echo $val['class_sort'];?></span>
//php 
//$result = array();
//$result['result'] = FALSE;/TURE
//$result['message'] = '错误';
//echo json_encode($result);
 
(function($) {
 $.fn.inline_edit= function(options) {
     var settings = $.extend({}, {open: false}, options);
     return this.each(function() {
         $(this).click(onClick);
     });

     function onClick() {
         var span = $(this);
         var old_value = $(this).html();
         var column_id = $(this).attr("column_id");
         $('<input type="text">')
         .insertAfter($(this))
         .focus()
         .select()
         .val(old_value)
         .blur(function(){
             var new_value = $(this).attr("value");
             if(new_value != '') {
                 $.get('index.php?act='+settings.act+'&op='+settings.op+'&branch=ajax',{id:column_id,value:new_value},function(data){
                     data = $.parseJSON(data);
                     if(data.result) {
                         span.show().text(new_value);
                     } else {
                         span.show().text(old_value);
                         alert(data.message);
                     }
                 });
             } else {
                 span.show().text(old_value);
             }
             $(this).remove();
         })
         $(this).hide();
     }
}
})(jQuery);

(function($) {
 $.fn.inline_edit_confirm = function(options) {
     var settings = $.extend({}, {open: false}, options);
     return this.each(function() {
         $(this).click(onClick);
     });

     function onClick() {
         var $span = $(this);
         var old_value = $(this).text();
         var column_id = $(this).attr("column_id");
         var $input = $('<input type="text">');
         var $btn_submit = $('<a class="inline-edit-submit" href="JavaScript:;">确认</a>');
         var $btn_cancel = $('<a class="inline-edit-cancel" href="JavaScript:;">取消</a>');

         $input.insertAfter($span).focus().select().val(old_value);
         $btn_submit.insertAfter($input);
         $btn_cancel.insertAfter($btn_submit);
         $span.hide();

         $btn_submit.click(function(){
             var new_value = $input.attr("value");
             if(new_value !== '' && new_value !== old_value) {
                 $.post('index.php?act=' + settings.act + '&op=' + settings.op, {id:column_id, value:new_value}, function(data) {
                     data = $.parseJSON(data);
                     if(data.result) {
                         $span.text(new_value);
                     } else {
                         alert(data.message);
                     }
                 });
             }
             show();
         });

         $btn_cancel.click(function() {
             show();
         });

         function show() {
             $span.show();
             $input.remove();
             $btn_submit.remove();
             $btn_cancel.remove();
         }
     }
};
})(jQuery);

<!-------->
//JavaScript Document


//自定义radio样式
$(document).ready( function(){ 
	$(".cb-enable").click(function(){
		var parent = $(this).parents('.onoff');
		$('.cb-disable',parent).removeClass('selected');
		$(this).addClass('selected');
		$('.checkbox',parent).attr('checked', true);
	});
	$(".cb-disable").click(function(){
		var parent = $(this).parents('.onoff');
		$('.cb-enable',parent).removeClass('selected');
		$(this).addClass('selected');
		$('.checkbox',parent).attr('checked', false);
	});
});


//图片比例缩放控制
function DrawImage(ImgD, FitWidth, FitHeight) {
	var image = new Image();
	image.src = ImgD.src;
	if (image.width > 0 && image.height > 0) {
		if (image.width / image.height >= FitWidth / FitHeight) {
			if (image.width > FitWidth) {
				ImgD.width = FitWidth;
				ImgD.height = (image.height * FitWidth) / image.width;
			} else {
				ImgD.width = image.width;
				ImgD.height = image.height;
			}
		} else {
			if (image.height > FitHeight) {
				ImgD.height = FitHeight;
				ImgD.width = (image.width * FitHeight) / image.height;
			} else {
				ImgD.width = image.width;
				ImgD.height = image.height;
			}
		}
	}
} 
	

$(function(){
	// 显示隐藏预览图 start
	$('.show_image').hover(
		function(){
			$(this).next().css('display','block');
		},
		function(){
			$(this).next().css('display','none');
		}
	);
	
	// 全选 start
	$('.checkall').click(function(){
		$('.checkall').attr('checked',$(this).attr('checked') == 'checked');
		$('.checkitem').each(function(){
			$(this).attr('checked',$('.checkall').attr('checked') == 'checked');
		});
	});

	// 表格鼠标悬停变色 start
	$("tbody tr").hover(
  function(){
      $(this).css({background:"#FBFBFB"} );
  },
  function(){
      $(this).css({background:"#FFF"} );
  });

	// 可编辑列（input）变色
	$('.editable').hover(
		function(){
			$(this).removeClass('editable').addClass('editable2');
		},
		function(){
			$(this).removeClass('editable2').addClass('editable');
		}
	);
	
	// 提示操作 展开与隐藏
	$("#prompt tr:odd").addClass("odd");
	$("#prompt tr:not(.odd)").hide();
	$("#prompt tr:first-child").show();
		
	$("#prompt tr.odd").click(function(){
		$(this).next("tr").toggle();
		$(this).find(".title").toggleClass("ac");
		$(this).find(".arrow").toggleClass("up");
		
	});

	// 可编辑列（area）变色
	$('.editable-tarea').hover(
		function(){
			$(this).removeClass('editable-tarea').addClass('editable-tarea2');
		},
		function(){
			$(this).removeClass('editable-tarea2').addClass('editable-tarea');
		}
	);

});

/* 火狐下取本地全路径 */
function getFullPath(obj)
{
  if(obj)
  {
      // ie
      if (window.navigator.userAgent.indexOf("MSIE")>=1)
      {
          obj.select();
          if(window.navigator.userAgent.indexOf("MSIE") == 25){
          	obj.blur();
          }
          return document.selection.createRange().text;
      }
      // firefox
      else if(window.navigator.userAgent.indexOf("Firefox")>=1)
      {
          if(obj.files)
          {
              //return obj.files.item(0).getAsDataURL();
          	return window.URL.createObjectURL(obj.files.item(0)); 
          }
          return obj.value;
      }
      return obj.value;
  }
}

/* AJAX选择品牌 */
(function($) {
	$.fn.brandinit = function(options){
		var brand_container = $(this);
		//根据首字母查询
		$(this).find('.letter[nctype="letter"]').find('a[data-letter]').click(function(){
			var _url = $(this).parents('.brand-index:first').attr('data-url');
			var _letter = $(this).attr('data-letter');
			var _search = $(this).html();
			$.getJSON(_url, {type : 'letter', letter : _letter}, function(data){
				$(brand_container).insertBrand({param:data,search:_search});
			});
		});
		// 根据关键字查询
		$(this).find('.search[nctype="search"]').find('a').click(function(){
			var _url = $(this).parents('.brand-index:first').attr('data-url');
			var _keyword = $('#search_brand_keyword').val();
			$.getJSON(_url, {type : 'keyword', keyword : _keyword}, function(data){
				$(brand_container).insertBrand({param:data,search:_keyword});
			});
		});
		// 选择品牌
		$(this).find('ul[nctype="brand_list"]').on('click', 'li', function(){
			$('#b_id').val($(this).attr('data-id'));
			$('#b_name').val($(this).attr('data-name'));
		});
		//搜索品牌列表滚条绑定
		$(this).find('div[nctype="brandList"]').perfectScrollbar();
	}
	$.fn.insertBrand = function(options) {
		//品牌搜索容器
		var dataContainer = $(this);
		$(dataContainer).find('div[nctype="brandList"]').show();
		$(dataContainer).find('div[nctype="noBrandList"]').hide();
		var _ul = $(dataContainer).find('ul[nctype="brand_list"]');
		_ul.html('');
		if ($.isEmptyObject(options.param)) {
			$(dataContainer).find('div[nctype="brandList"]').hide();
			$(dataContainer).find('div[nctype="noBrandList"]').show().find('strong').html(options.search);
			return false;
		}
		$.each(options.param, function(i, n){
			$('<li data-id="' + n.brand_id + '" data-name="' + n.brand_name + '"><em>' + n.brand_initial + '</em>' + n.brand_name + '</li>').appendTo(_ul);
		});

		//搜索品牌列表滚条绑定
		$(dataContainer).find('div[nctype="brandList"]').perfectScrollbar('update');
  };
})(jQuery);
</script>
</body>
</html>
