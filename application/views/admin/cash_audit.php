
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
<?php echo _get_html_cssjs('lib','uploadify/uploadify.css','css');?> <!!--添加图片的样式-->

<!--[if IE 7]>
  <?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome-ie7.min.css','css');?>
<![endif]-->
<?php echo _get_html_cssjs('admin_js','perfect-scrollbar.min.js','js');?>

</head>
<body>


<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
       <h3><?php echo lang('adv_index_manage');?>审核链接</h3>
      <ul class="tab-base">
        
        <li><a href="<?php echo ADMIN_SITE_URL.'/cash/';?>" class="current" ><span>列表链接<?php echo lang('adv_manage');?></span></a></li>
        
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
 <form id="adv_form" method="post" action="<?php echo ADMIN_SITE_URL.'/cash/save_audit?id='.$info["fund_order_id"]?>" >
    <?php if(!empty($auditInfo)):?>
      <input type="hidden" name="list_url" value="<?php echo $auditInfo['list_url'];?>"> 
    <?php endif?>

    <table class="table tb-type2" id="main_table">
    
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required">
          <label class="" >提现id:</label>
          &nbsp;&nbsp; <?php  echo $info['fund_order_id'];?></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="" >提现编号:</label>
          &nbsp;&nbsp; <?php  echo $info['order_sn'];?></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label >用户名:</label>
          &nbsp;&nbsp; <?php  echo $info['buyer_username'];?></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label >提现方式:</label>
          &nbsp;&nbsp; 
          <?php 
            if($info['netpay_method']==1)
              echo '现金红包'; 
            elseif ($info['netpay_method']==2)
              echo '消费红包'; 
            elseif ($info['netpay_method']==11)
              echo '微信';
            elseif ($info['netpay_method']==12)
              echo '微信';
            else
              echo '微信';
          ?>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label >提现金额:</label>
          &nbsp;&nbsp; <?php  echo $info['total_amt'];?></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label >提现账号:</label>
          &nbsp;&nbsp; <?php  echo $info['netpay_account'];?></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label >提现时间:</label>
          &nbsp;&nbsp; <?php echo date('Y-m-d H:i:s',$info['create_time']);?></td>
        </tr>
<!--         <tr> -->
<!--           <td colspan="2" class="required"><label >提现手续费:</label> -->
          &nbsp;&nbsp; <?php  //echo $info['fee_amt'];?></td>
<!--         </tr> -->
        <?php if(!empty($auditInfo['audit_status'])):?>
            <tr>
              <td colspan="2" class="required"><label >ip</label>
              &nbsp;&nbsp; <?php if(!empty($auditInfo['audit_ip'])){ echo  $auditInfo['audit_ip'];}?></td>
            </tr>
            <tr class="noborder">
              <td colspan="2" class="required"><label class="" >审核人:</label>
              <?php if(!empty($auditInfo['admin_name'])){echo ($auditInfo['admin_name']);}?>
              </td>
            </tr>
            <tr class="noborder">
              <td colspan="2" class="required"><label class="" >审核时间:</label>
              <?php if(!empty($auditInfo['audit_time'])){echo date('Y-m-d H:i:m',$auditInfo['audit_time']);} ?>
               </td>
            </tr>
        <?php endif?>
        <?php if(empty($auditInfo['audit_status'])):?>
            <tr class="noborder">
              <td colspan="2" class="required"><label class="" >审核状态:</label></td>
            <tr class="noborder">
              <td align="left" class="padL5" colspan="2">
                  <input type="radio" name="audit_status" value="1" <?php if((!empty($auditInfo['audit_status']) && $auditInfo['audit_status']==1)||empty($auditInfo['audit_status'])){ echo 'checked'; }?> />通过
                  <input type="radio" name="audit_status" value="2" <?php if(!empty($auditInfo['audit_status']) && $auditInfo['audit_status']==2 ){echo ' checked';} ?> />不通过
                </td>
            </tr>
              
            </tr>
            <tr class="noborder">
              <td colspan="2" class="required"><label class="" >不通过原因:</label></td>
            </tr>
            <tr class="noborder">
              <td class="vatop rowform"><textarea  rows="6" name="audit_content" class="tarea" ><?php  echo !empty($auditInfo) && !empty($auditInfo['audit_content'])? $auditInfo['audit_content']:''?></textarea></td>
            </tr>
        <?php else:?>
            <tr class="noborder">
              <td colspan="2" class="required"><label class="" >审核情况:</label>
              </td>
            </tr>
            <tr class="noborder">
              <td align="left" class="padL5" colspan="2">
                  <?php if($auditInfo['audit_status']==1)
                      echo "审核通过";
                    else if($auditInfo['audit_status']==2)
                    {
                      echo "审核不通过<br />".$auditInfo['audit_content'];
                    }?>
                </td>
            </tr>
        <?php endif?>
      </tbody>  
      
      <tfoot>
        <tr class="tfoot">
          <td colspan="15" >
            <?php if(empty($auditInfo['audit_status'])):?> 
              <a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo lang('nc_submit');?>提交</span></a>
            <?php else:?>
              <a href="<?php echo ADMIN_SITE_URL.'/cash';?>" class="btn"><span>返回</span></a>
            <?php endif?>
          </td>
        </tr>
      </tfoot>
      
    </table>
  </form>
</div>

<?php echo _get_html_cssjs('admin_js','zh-CN.js','js');?>
<?php echo _get_html_cssjs('lib','jquery-ui/themes/ui-lightness/jquery.ui.css','css');?>
<?php echo _get_html_cssjs('lib','jquery-ui/jquery.ui.js','js');?>
<script src="<?php echo _get_cfg_path('lib')?>uploadify/jquery.uploadify.min.js" type="text/javascript"></script>

<script type="text/javascript">

</script>
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#adv_form").valid()){
     $("#adv_form").submit();
	}
	});
});

</script>
</body>
</html>