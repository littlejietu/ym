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
      <h3>会员管理</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
        <li><a href="<?php echo ADMIN_SITE_URL.'/user/add'?>" ><span>新增</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" name="formSearch" id="formSearch">
    <input type="hidden" value="member" name="act">
    <input type="hidden" value="member" name="op">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <td>
          <!--//zmr>v30-->
          <select name="search_field_name" >
              <option  value="">会员</option>
          </select>
          </td>
          <td><input type="text" value="<?php if (!empty($cKey)){echo $cKey;}?>" name="search_field_value" class="txt"></td>
          <!-- <td><select name="search_sort" >
              <option value="">排序</option>
              <option selected='selected' value="member_login_time desc">最后登录</option>
              <option  value="member_login_num desc">登录次数</option>
            </select></td> -->

          <!-- <td><select name="search_grade" >
              <option value='-1'>会员级别</option>
              <?php //if ($output['member_grade']){?>
                <?php //foreach ($output['member_grade'] as $k=>$v){?>
                <option <?php //if(isset($_GET['search_grade']) && $_GET['search_grade'] == $k){ ?>selected='selected'<?//php } ?> value="<?php //echo $k;?>"><?php //echo $v['level_name'];?></option>
                <?//php }?>
              <?//php }?>
            </select></td> -->
          <td><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo lang('nc_query');?>">&nbsp;</a>
            <?php if($this->input->get()){?>
            <a href="<?php echo ADMIN_SITE_URL.'/user'?>" class="btns "><span><?php echo lang('nc_cancel_search')?></span></a>
            <?php }?></td>
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
            <li>通过会员管理，你可以进行查看、编辑会员资料等操作</li>
            <li>你可以根据条件搜索会员，然后选择相应的操作</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method="post" id="form_member" action="<?php echo ADMIN_SITE_URL.'/user/del'?>">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2 nobdb">
      <thead>
        <tr class="thead">
          <th>&nbsp;</th>
          <th colspan="2">会员</th>
          <th class="align-center">积分</th>
<!--           <th class="align-center">经验值</th> -->
          <!-- <th class="align-center">级别</th> -->
<!--           <th class="align-center">状态</th> -->
          <th class="align-center">操作</th>
        </tr>
      <tbody>
        <?php if(!empty($user_list['rows']) && is_array($user_list['rows'])){ ?>
        <?php foreach($user_list['rows'] as $k => $v){ ?>
        <tr class="hover member">
          <td class="w24"><input type="checkbox" name='del_id[]' value="<?php echo $v['user_id']; ?>" class="checkitem"></td>
          <td class="w48 picture"><div class="size-44x44"><span class="thumb size-44x44"><i></i><img src="<?php echo $v['logo']?>"  onload="javascript:DrawImage(this,44,44);"/></span></div></td>
          <td><p class="name"><strong><?php echo $v['user_name']; ?></strong>(<?php echo lang('member_index_true_name')?>: <?php echo $v['name']; ?>)</p>
              <p class="smallfont"><?php echo lang('member_index_reg_time')?>:&nbsp;<?php echo date('Y-m-d H:i:s',$v['reg_time']); ?></p>
          </td>
          <td class="align-center"><?php foreach ($user_account_list as $value) if ($value['user_id']==$v['user_id']) echo $value['acct_integral']; ?></td>
          <!-- <td class="align-center"><?php //echo 'member_exppoints';?></td> -->
          <!-- <td class="align-center"><?php //echo 'member_grade';?></td> -->
          <!--<td class="align-center"><?php //echo $status[$v['status']]; ?></td>-->
          <td class="align-center"><a href="<?php echo ADMIN_SITE_URL.'/user/edit?id='.$v['user_id']?>">编辑</a> | <a href="/admin/message/send?user_name=<?php echo $v['user_name']?>">通知</a></td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="11"><?php echo lang('nc_no_record')?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot class="tfoot">
        <?php if(!empty($user_list) && is_array($user_list)){ ?>
        <tr>
        <td class="w24"><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16">
          <label for="checkallBottom">全选</label>
            &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="if(confirm('<?php echo lang('nc_ensure_del')?>')){$('#form_member').submit();}"><span>删除</span></a>
            <div class="pagination"> <?php echo $user_list['pages'];?> </div></td>
        </tr>
        <?php } ?>
      </tfoot>
    </table>
  </form>
</div>
<script>
$(function(){
    $('#ncsubmit').click(function(){
    	$('input[name="op"]').val('member');$('#formSearch').submit();
    });	
});
</script>
</body>
</html>