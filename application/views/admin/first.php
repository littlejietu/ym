
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $output['html_title'];?></title>
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
      <h3><?php echo lang('adv_index_manage');?></h3>
      <ul class="tab-base">
        <li><a href="<?php echo ADMIN_SITE_URL.'/first_place';?>"><span><?php echo lang('ap_manage');?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo lang('adv_manage');?></span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/first/add';?>"><span><?php echo lang('adv_add');?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" style="margin-top:2px" width="100%">
		<tr>
            <td height="32">
                <form class="form-horizontal" role="form" method="get">
                    <select name="place_id">
                        <option value=""><?php echo lang('ap_manage');?></option>
                        <?php foreach ($ad_placeList as $k=>$v):?>
                        <option value="<?=$k?>"<?php if(!empty($arrParam['place_id']) && $arrParam['place_id']==$k) echo ' selected'; ?>><?=$v?></option>
                        <?php endforeach?>
                    </select>
                    
                    <select name="field">
                      <option value="title"<?php if(!empty($arrParam['field']) && $arrParam['field']=='title') echo ' selected';?>>推首名称</option>
                      
                    </select>
                    <input type="text" name="key" value="<?=!empty($arrParam['key']) ? $arrParam['key']:'';?>" class="w150">
                   <!--  <select name="effect_time">
                     <option value="effect_time"<?php //if(!empty($arrParam['effect_time']) && $arrParam['effect_time']=='effect_time') echo ' selected';?>>生效时间</option>
                     <option value="expire_time"<?php //if(!empty($arrParam['effect_time']) && $arrParam['effect_time']=='expire_time') echo ' selected';?>>失效时间</option>
                   </select> -->

                    <!-- <input type="text"  id="begtime" name="begtime" class="w100" value="<?php //if( !empty($arrParam['begtime']) ) echo $arrParam['begtime']; ?>"  readonly="readonly" placeholder="请选择日期">
                    <input type="text" id="endtime" name="endtime" class="w100" value="<?php //if( !empty($arrParam['endtime']) ) echo $arrParam['endtime']; ?>" readonly="readonly" placeholder="请选择日期">
                    <select name="effect_time">
                      <option value="effect_time desc"<?php //if(!empty($arrParam['effect_time']) && $arrParam['effect_time']=='effect_time desc') echo ' selected';?>>生效时间倒序</option>
                      <option value="expire_time desc"<?php //if(!empty($arrParam['effect_time']) && $arrParam['effect_time']=='expire_time desc') echo ' selected';?>>失效时间倒序</option>
                    </select> -->
                    <button type="submit" class="btn">查  询</button>
                  </form>
            </td>
        </tr>
    </table>
  <form method="post" id="store_form" action="<?php echo ADMIN_SITE_URL.'/first/del'?>">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2" >
      <thead>
        <tr class="thead">
          <th></th>
          <th>推首名称</th>
          <th>所属推首位</th>
          <th>排序</th>
         <!--  <th class="align-center">开始时间</th>
         <th class="align-center">结束时间</th> -->
          <th class="align-center">推首状态</th>
          <th class="align-center" width="10%">编辑</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($list['rows']) && is_array($list['rows'])){ ?>
        <?php foreach($list['rows'] as $k => $v){ ?>
        <tr class="hover">
          <td class="w24"><input type="checkbox" class="checkitem" name="del_id[]" value="<?php echo $v['id']; ?>" /></td>
          <td><span title="<?php echo $v['title']; ?>"><?php echo $v['title']; ?></span></td>
          <td><span title="<?php echo $v['title']; ?>"><?php echo $v['place_name']; ?></span></td>
          <td><span title="<?php echo $v['sort']; ?>"><?php echo $v['sort']; ?></span></td>
          <!-- <td class="align-center nowrap"><?php //echo date('Y-m-d',$v['effect_time']); ?></td>
          <td class="align-center nowrap"><?php //echo date('Y-m-d',$v['expire_time']); ?></td> -->
          <td class="align-center nowrap"><?php echo $v['status']?'启用':'禁用'; ?></td>
          <td class="w72 align-center">
          <a href="<?php echo ADMIN_SITE_URL.'/first/add?id='.$v['id']?>"><?php echo lang('adv_edit');?></a>&nbsp;|&nbsp;
          <a href="<?php echo ADMIN_SITE_URL.'/first/del?id='.$v['id'];?>"><?php echo lang('nc_del');?></a></td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="15"><?php echo lang('nc_no_record');?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkall"/></td>
          <td id="batchAction" colspan="15"><span class="all_checkbox">
            <label for="checkall"><?php echo lang('nc_select_all');?></label>
            </span>&nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="if(confirm('<?php echo lang('adv_del_sure');?>')){$('#store_form').submit();}"><span><?php echo lang('nc_del');?></span></a>
            <div class="pagination"> <?php echo $list['pages'];?> </div></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<?php echo _get_html_cssjs('lib','jquery-ui/themes/ui-lightness/jquery.ui.css','css');?>
<?php echo _get_html_cssjs('lib','jquery-ui/jquery.ui.js','js');?>
<script type="text/javascript">
$(function(){
    $('#begtime').datepicker({dateFormat: 'yy-mm-dd'});
    $('#endtime').datepicker({dateFormat: 'yy-mm-dd'});


    // $('#ap_id').change(function(){
    // 	var select   = document.getElementById("ap_id");
    // });
});
</script>
<script>
//弹出复制代码框
function copyToClipBoard(id)
{
   ajax_form('copy_adv', '代码调用', 'index.php?act=adv&op=ap_copy&id='+id);
}
</script>
</body>
</html>
