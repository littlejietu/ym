<ul class="add-goods-step">
  <li><i class="icon icon-list-alt"></i>
    <h6>STEP.1</h6>
    <h2>选择商品分类</h2>
    <i class="arrow icon-angle-right"></i> </li>
  <li><i class="icon icon-edit"></i>
    <h6>STEP.2</h6>
    <h2>填写商品详情</h2>
    <i class="arrow icon-angle-right"></i> </li>
  <li class="current"><i class="icon icon-camera-retro "></i>
    <h6>STEP.3</h6>
    <h2>上传商品图片</h2>
    <i class="arrow icon-angle-right"></i>
  </li>
  <li><i class="icon icon-ok-circle"></i>
    <h6>STEP.4</h6>
    <h2>商品发布成功</h2>
  </li>
</ul>

<form method="post" id="goods_image" action="<?php echo urlShop('admin/goods_tpl_add', 'save_image');?>">
  <input type="hidden" name="goods_id" value="<?php echo $output['goods_id'];?>">
  <div class="ncsc-form-goods-pic">
    <div class="container">
      <div class="ncsc-goodspic-list">
        <ul nctype="ul">
          <?php $is_default_i = -1;
          for ($i = 0; $i < 5; $i++) {
            if(!empty($output['pic_list'][$i]))
              $a = $output['pic_list'][$i];
            else
              $a = array();

            if (!empty($a) && $output['goods_pic']==$a['pic'] && $is_default_i==-1)
              $is_default_i = $i;
            ?>
          <li class="ncsc-goodspic-upload">
            <input type="hidden" name="img[<?php echo $i;?>][id]" value="<?php if(!empty($a)) echo $a['id'];?>">
            <div class="upload-thumb"><img src="<?php if(!empty($a['pic'])) echo cthumb($a['pic']);?>" nctype="file_<?php echo  $i;?>">
              <input type="hidden" name="img[<?php echo $i;?>][path]" value="<?php if(!empty($a['pic'])) echo $a['pic'];?>" nctype="file_<?php echo  $i;?>">
            </div>
            <div class="show-default<?php if ($is_default_i==$i) {echo ' selected';}?>" nctype="file_<?php echo $i;?>">
              <p><i class="icon-ok-circle"></i>默认主图
                <input type="hidden" name="img[<?php echo $i;?>][default]" value="<?php if ( $is_default_i==$i) {echo '1';}else{echo '0';}?>">
              </p><a href="javascript:void(0)" nctype="del" class="del" title="移除">X</a>
            </div>
            <div class="show-sort">排序：<input name="img[<?php echo $i;?>][sort]" type="text" class="text" value="<?php if(!empty($a)) echo intval($a['sort']); else echo $i+1;?>" size="1" maxlength="1">
            </div>
            <div class="ncsc-upload-btn"><a href="javascript:void(0);"><span><input type="file" hidefocus="true" size="1" class="input-file" name="file_<?php echo $i;?>" id="file_<?php echo $i;?>"></span><p><i class="icon-upload-alt"></i>上传</p>
              </a></div>
            
          </li>
          <?php }?>
        </ul>
        <div class="ncsc-select-album">
          <a class="ncsc-btn" href="<?php echo urlShop('admin/goods_tpl_album', 'pic_list', array('item'=>'goods_image'));?>" nctype="select"><i class="icon-picture"></i>从图片空间选择</a>
          <a href="javascript:void(0);" nctype="close_album" class="ncsc-btn ml5" style="display: none;"><i class=" icon-circle-arrow-up"></i>关闭相册</a>
        </div>
        <div nctype="album"></div>
      </div>
     <div class="bottom tc hr32">
        <label class="submit-border"><input type="button" class="submit" value="<<" onclick="window.location.href='<?php echo urlShop('admin/goods_tpl_add','add_step2',array('tpl_id' => $output['goods_id']));?>'" /></label>&nbsp;&nbsp;
        <label class="submit-border"><input type="submit" class="submit" value="提交" /></label>&nbsp;&nbsp;
        <label class="submit-border"><input type="button" class="submit" value=">>" onclick="window.location.href='<?php echo urlShop('admin/goods_tpl_add','add_step4',array('tpl_id' => $output['goods_id']));?>'" /></label>
     </div>
    </div>
    <div class="sidebar"><div class="alert alert-info alert-block" id="uploadHelp">
    <div class="faq-img"></div>
    <h4>上传要求：</h4><ul>
    <li>1. 请使用jpg\jpeg\png等格式、单张大小不超过<?php echo intval(C('image_max_filesize'))/1024;?>M的正方形图片。</li>
    <li>2. 上传图片最大尺寸将被保留为1280像素。</li>
    <li>3. 每种颜色最多可上传5张图片或从图片空间中选择已有的图片，上传后的图片也将被保存在店铺图片空间中以便其它使用。</li>
    <li>4. 通过更改排序数字修改商品图片的排列显示顺序。</li>
    <li>5. 图片质量要清晰，不能虚化，要保证亮度充足。</li>
    <li>6. 操作完成后请点下一步，否则无法在网站生效。</li>
    </ul><h4>建议:</h4><ul><li>1. 主图为白色背景正面图。</li><li>2. 排序依次为正面图->背面图->侧面图->细节图。</li></ul></div></div>
  </div>
  
</form>
<?php echo _get_html_cssjs('lib','ajaxfileupload/ajaxfileupload.js','js');?>
<?php echo _get_html_cssjs('seller_js','jquery.ajaxContent.pack.js','js');?>
<?php echo _get_html_cssjs('admin_js','shop_goods_add.step3.js','js');?>
<script>
var ADMIN_RESOURCE_SITE_URL = "<?php echo _get_cfg_path('admin');?>";
var DEFAULT_GOODS_IMAGE = "";
$(function(){
    $('input[type="submit"]').click(function(){
        ajaxpost('goods_image', '', '', 'onerror');
    });
    /* ajax打开图片空间 */
    $('a[nctype="select"]').ajaxContent({
        event:'click', //mouseover
        loaderType:"img",
        loadingMsg:"<?php echo RES_SITE_URL;?>seller/images/loading.gif",
        target:'div[nctype="album"]'
    }).click(function(){
        $(this).hide();
        $(this).next().show();
    });
});
</script> 
