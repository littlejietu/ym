<?php echo _get_html_cssjs('seller_js','jquery.ajaxContent.pack.js,jquery-ui/i18n/zh-CN.js,common_select.js','js');?>
<?php echo _get_html_cssjs('lib','fileupload/jquery.iframe-transport.js,fileupload/jquery.ui.widget.js,fileupload/jquery.fileupload.js','js');?>
<?php echo _get_html_cssjs('seller_js','jquery.poshytip.min.js,jquery.mousewheel.js,jquery.charCount.js','js');?>
<?php echo _get_html_cssjs('admin_js','shop_goods_add.step2.js','js');?>
<link rel="stylesheet" type="text/css" href="<?php echo _get_cfg_path('seller_js');?>jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<style type="text/css">
#fixedNavBar { filter:progid:DXImageTransform.Microsoft.gradient(enabled='true',startColorstr='#CCFFFFFF', endColorstr='#CCFFFFFF');background:rgba(255,255,255,0.8); width: 90px; margin-left: 510px; border-radius: 4px; position: fixed; z-index: 999; top: 172px; left: 50%;}
#fixedNavBar h3 { font-size: 12px; line-height: 24px; text-align: center; margin-top: 4px;}
#fixedNavBar ul { width: 80px; margin: 0 auto 5px auto;}
#fixedNavBar li { margin-top: 5px;}
#fixedNavBar li a { font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; background-color: #F5F5F5; color: #999; text-align: center; display: block;  height: 20px; border-radius: 10px;}
#fixedNavBar li a:hover { color: #FFF; text-decoration: none; background-color: #27a9e3;}
</style>
</head>
<body>
<?php echo _get_html_cssjs('seller_js','ToolTip.js','js');?>
      
      <?php if(empty($output['goods'])):?>
      <ul class="add-goods-step">
        <li><i class="icon icon-list-alt"></i>
          <h6>STEP.1</h6>
          <h2>选择商品分类</h2>
          <i class="arrow icon-angle-right"></i> </li>
        <li class="current"><i class="icon icon-edit"></i>
          <h6>STEP.2</h6>
          <h2>填写商品详情</h2>
          <i class="arrow icon-angle-right"></i> </li>
        <li><i class="icon icon-camera-retro "></i>
          <h6>STEP.3</h6>
          <h2>上传商品图片</h2>
          <i class="arrow icon-angle-right"></i>
        </li>
        <li><i class="icon icon-ok-circle"></i>
          <h6>STEP.4</h6>
          <h2>商品发布成功</h2>
        </li>
      </ul>
    <?php else:?>
      <div class="tabmenu">
        <ul class="tab pngFix">
          <li class="active"><a href="<?php echo urlShop('admin/goods_tpl_add','add_step2',array('tpl_id'=>$output['goods']['tpl_id']));?>">编辑模板</a></li>
          <li class="normal"><a href="<?php echo urlShop('admin/goods_tpl_add','add_step3',array('tpl_id'=>$output['goods']['tpl_id']));?>">编辑图片</a></li>
          <!--<li class="normal"><a href="<?php //echo urlShop('seller/goods_add','add_step2',array('id'=>$output['goods']['id']));?>">赠送赠品</a></li>
          <li class="normal"><a href="<?php //echo urlShop('seller/goods_add','add_step2',array('id'=>$output['goods']['id']));?>">推荐组合</a></li>
        -->
        </ul>
      </div>
    <?php endif?>
<?php //echo validation_errors('<div class="valid_error">', '</div>');?>
      <div class="item-publish">
        <form method="post" id="goods_form" action="<?php echo ADMIN_SITE_URL.'/goods_tpl_add/save'?>">
          <input type="hidden" name="cid" value="<?php echo $output['cid']?>">
          <input type="hidden" name="tpl_id" value="<?php echo $output['tpl_id']?>">
          <input type="hidden" name="scode" value="<?php echo $output['spucode']?>">
          <div class="ncsc-form-goods">
            <h3 id="demo1">商品模板基本信息</h3>
            <dl>
              <dt><?php echo lang('store_goods_index_goods_class').lang('nc_colon');?></dt>
              <dd id="gcategory"> <?php echo $output['goods_class']['line_cate_name'];?> <a class="ncsc-btn" href="<?php echo ADMIN_SITE_URL?>/goods_tpl_add/add_step1?tpl_id=<?php echo $output['tpl_id']?>"><?php echo lang('nc_edit');?></a>
              </dd>
            </dl>
            <dl>
              <dt><i class="required">*</i><?php echo lang('store_goods_index_goods_name').lang('nc_colon');?></dt>
              <dd>
                <input name="title" type="text" class="text w400" value="<?php echo empty($output['goods']['title'])?'':$output['goods']['title']; ?>" />
                <span></span>
                <p class="hint"><?php echo lang('store_goods_index_goods_name_help');?></p>
              </dd>
            </dl>
            <dl>
              <dt>商品卖点<?php echo lang('nc_colon');?></dt>
              <dd>
                <textarea name="point" class="textarea h60 w400"><?php echo empty($output['goods']['point'])?'':$output['goods']['point']; ?></textarea>
                <span></span>
                <p class="hint">商品卖点最长不能超过140个汉字</p>
              </dd>
            </dl>
            
            <dl>
              <dt nc_type="no_spec"><i class="required">*</i><?php echo lang('store_goods_index_store_price').lang('nc_colon');?></dt>
              <dd nc_type="no_spec">
                <input name="price" value="<?php echo empty($output['goods']['price'])?'':$output['goods']['price']; ?>" type="text"  class="text w60" /><em class="add-on"><i class="icon-renminbi"></i></em> <span></span>
                <p class="hint"><?php echo lang('store_goods_index_store_price_help');?>。<br>
                  </p>
              </dd>
            </dl>
            <dl>
              <dt><i class="required">*</i>市场价<?php echo lang('nc_colon');?></dt>
              <dd>
                <input name="market_price" value="<?php echo empty($output['goods']['market_price'])?'':$output['goods']['market_price']; ?>" type="text" class="text w60" /><em class="add-on"><i class="icon-renminbi"></i></em> <span></span>
                <p class="hint"><?php echo lang('store_goods_index_store_price_help');?>，此价格仅为市场参考售价，请根据该实际情况认真填写。</p>
              </dd>
            </dl>
            <dl>
              <dt><i class="required">*</i>成本价<?php echo lang('nc_colon');?></dt>
              <dd>
                <input name="cost_price" value="<?php echo empty($output['goods']['cost_price'])?'0':$output['goods']['cost_price']; ?>" type="text" class="text w60" /><em class="add-on"><i class="icon-renminbi"></i></em> <span></span>
              </dd>
            </dl>
            <dl>
              <dt><i class="required">*</i>利润比率<?php echo lang('nc_colon');?></dt>
              <dd>
                <input name="comm_precent" value="<?php echo empty($output['goods']['comm_precent'])?'0':$output['goods']['comm_precent']; ?>" type="text" class="text w60" /><em class="add-on">%</em> <span></span>
              </dd>
            </dl>
            <dl style="display: none">
              <dt>利润价<?php echo lang('nc_colon');?></dt>
              <dd>
                <input name="comm_price" value="<?php echo empty($output['goods']['comm_price'])?'0':$output['goods']['comm_price']; ?>" type="text" class="text w60" readonly="readonly" style="background:#E7E7E7 none;" /><em class="add-on"><i class="icon-renminbi"></i></em> <span></span>
              </dd>
            </dl>
            <!--<dl>
              <dt>成本价<?php echo lang('nc_colon');?></dt>
              <dd>
                <input name="cost_price" value="<?php //echo empty($output['goods']['cost_price'])?'':$output['goods']['cost_price']; ?>" type="text" class="text w60" /><em class="add-on"><i class="icon-renminbi"></i></em> <span></span>
                <p class="hint">价格必须是0.00~9999999之间的数字，此价格为商户对所销售的商品实际成本价格进行备注记录，非必填选项，不会在前台销售页面中显示。</p>
              </dd>
            </dl>-->
            <dl>
              <dt>折扣<?php echo lang('nc_colon');?></dt>
              <dd>
                <input name="discount" value="<?php echo empty($output['goods']['discount'])?'':$output['goods']['discount']; ?>" type="text" class="text w60" readonly="readonly" style="background:#E7E7E7 none;" /><em class="add-on">%</em>
                <p class="hint">根据销售价与市场价比例自动生成，不需要编辑。</p>
              </dd>
            </dl>
            <?php if(!empty($output['spec_list']) && is_array($output['spec_list']) ){?>
            <?php $i = '0';?>
            <?php foreach ($output['spec_list'] as $k=>$val){?>
            <dl nc_type="spec_group_dl_<?php echo $i;?>" nctype="spec_group_dl" class="spec-bg" <?php if($val['type'] == '1'){?>spec_img="t"<?php }?>>
              <dt>
                <label type="text" class="text w60 tr" value="" maxlength="4" nctype="spec_name" data-param="{id:<?php echo $val['name_id'];?>,name:'<?php echo $val['name'];?>'}"/><?php if (isset($output['goods']['spec_name'][$k])) { echo $output['goods']['spec_name'][$val['name_id']];} else {echo $val['name'];}?>
                <!--<input type="hidden" name="sp_name[<?php //echo $val['name_id'];?>]" value="<?php //echo $val['name'];?>">-->
                <?php echo lang('nc_colon')?></dt>
              <dd <?php if($k == '1'){?>nctype="sp_group_val"<?php }?>>
                <ul class="spec">
                  <?php if(is_array($val['valList'])){?>
                  <?php foreach ($val['valList'] as $v) {?>
                  <li>
                    <span nctype="input_checkbox">
                      <?php if($val['type'] == '1'):?>
                        <input type="hidden" nctype="file_<?php echo $v['val_id'];?>" pv_type="pv_img" value="" name="sp_val_img[<?php echo $val['name_id'];?>][<?php echo $v['val_id']?>]">
                      <?php endif?>
                      <input type="checkbox" value="<?php echo $v['val'];?>" <?php if(isset($output['spec_checked'][$v['val_id']])) echo "checked";?> nc_type="<?php echo $v['val_id'];?>" <?php if($val['type'] == '1'){?>class="sp_val"<?php }?> name="sp_val[<?php echo $val['name_id'];?>][<?php echo $v['val_id']?>]">
                    </span><span pv_type="pv_name"><?php echo $v['val'];?></span></li>
                  <?php }?>
                  <?php }?>
                  
                </ul>
                <?php if($val['type'] == '1'){?>
                  <!-- <div>
                    <table border="0" cellpadding="0" cellspacing="0" class="spec_table">
                      <tbody id="spec_img">

                      </tbody>

                      <footer>
                        <tr><td colspan="3"><a class="ncsc-btn mt5" nctype="show_spec_image" href="<?php //echo urlShop('seller/goods_album', 'pic_list', array('item'=>'goods_color'));?>"><i class="icon-picture"></i>从图片空间选择</a> <a href="javascript:void(0);" nctype="spec_goods_demo" class="ncsc-btn mt5" style="display: none;"><i class="icon-circle-arrow-up"></i>关闭相册</a><div id="spec_goods_demo"></div></td></tr>
                      </footer>
                    </table>
                  </div> -->
                <?php }?>
              </dd>
            </dl>
            <?php $i++;?>
            <?php }?>
            <?php }?>
            <dl nc_type="spec_dl" class="spec-bg" style="display:none;overflow: visible;">
              <dt><?php echo lang('srore_goods_index_goods_stock_set').lang('nc_colon');?></dt>
              <dd class="spec-dd">
                <table border="0" cellpadding="0" cellspacing="0" class="spec_table">
                  <thead>
                    <?php if(!empty($output['spec_list']) && is_array($output['spec_list'])){?>
                    <?php foreach ($output['spec_list'] as $k=>$val){?>
                  <th nctype="spec_name_<?php echo $k;?>"><?php if (isset($output['goods']['spec_name'][$k])) { echo $output['goods']['spec_name'][$k];} else {echo $val['name'];}?></th>
                    <?php }?>
                    <?php }?>
                    <th class="w90"><span class="red">*</span>市场价
                      <div class="batch"><i class="icon-edit" title="批量操作"></i>
                        <div class="batch-input" style="display:none;">
                          <h6>批量设置价格：</h6>
                          <a href="javascript:void(0)" class="close">X</a>
                          <input name="" type="text" class="text price" />
                          <a href="javascript:void(0)" class="ncsc-btn-mini" data-type="marketprice">设置</a><span class="arrow"></span></div>
                      </div></th>
                    <th class="w90"><span class="red">*</span><?php echo lang('store_goods_index_store_price');?>
                      <div class="batch"><i class="icon-edit" title="批量操作"></i>
                        <div class="batch-input" style="display:none;">
                          <h6>批量设置价格：</h6>
                          <a href="javascript:void(0)" class="close">X</a>
                          <input name="" type="text" class="text price" />
                          <a href="javascript:void(0)" class="ncsc-btn-mini" data-type="price">设置</a><span class="arrow"></span></div>
                      </div></th>
                    <th class="w90"><span class="red">*</span>成本价
                      <div class="batch"><i class="icon-edit" title="批量操作"></i>
                        <div class="batch-input" style="display:none;">
                          <h6>批量设置价格：</h6>
                          <a href="javascript:void(0)" class="close">X</a>
                          <input name="" type="text" class="text price" />
                          <a href="javascript:void(0)" class="ncsc-btn-mini" data-type="costprice">设置</a><span class="arrow"></span></div>
                      </div>
                    </th>
                    <th class="w90"><span class="red">*</span>利润比率
                      <div class="batch"><i class="icon-edit" title="批量操作"></i>
                        <div class="batch-input" style="display:none;">
                          <h6>批量设置比率：</h6>
                          <a href="javascript:void(0)" class="close">X</a>
                          <input name="" type="text" class="text price" />
                          <a href="javascript:void(0)" class="ncsc-btn-mini" data-type="commprecent">设置</a><span class="arrow"></span></div>
                      </div>
                    </th>
                    <th class="w60"><span class="red">*</span><?php echo lang('store_goods_index_stock');?>
                      <div class="batch"><i class="icon-edit" title="批量操作"></i>
                        <div class="batch-input" style="display:none;">
                          <h6>批量设置库存：</h6>
                          <a href="javascript:void(0)" class="close">X</a>
                          <input name="" type="text" class="text stock" />
                          <a href="javascript:void(0)" class="ncsc-btn-mini" data-type="stock">设置</a><span class="arrow"></span></div>
                      </div></th>
                      </thead>
                  <tbody nc_type="spec_table">
                  </tbody>
                </table>
                <p class="hint">点击<i class="icon-edit"></i>可批量修改所在列的值。</p>
              </dd>
            </dl>

            <dl>
              <dt nc_type="no_spec"><i class="required">*</i><?php echo lang('store_goods_index_goods_stock').lang('nc_colon');?></dt>
              <dd nc_type="no_spec">
                <input name="stock_num" value="<?php echo empty($output['goods']['stock_num'])?'':$output['goods']['stock_num']; ?>" type="text" class="text w60" />
                <span></span>
                <p class="hint"><?php echo lang('store_goods_index_goods_stock_help');?></p>
              </dd>
            </dl>
             <!--<dl>
              <dt>库存预警值<?php //echo lang('nc_colon');?></dt>
              <dd>
                <input name="g_alarm" value="<?php //echo empty($output['goods']['goods_storage_alarm'])?'':$output['goods']['goods_storage_alarm'];?>" type="text" class="text w60" />
                <span></span>
                <p class="hint">设置最低库存预警值。当库存低于预警值时商家中心商品列表页库存列红字提醒。<br>
                  请填写0~255的数字，0为不预警。</p>
              </dd>
            </dl> 
            <dl>
              <dt nc_type="no_spec"><?php //echo lang('store_goods_index_goods_no').lang('nc_colon');?></dt>
              <dd nc_type="no_spec">
                <p>
                  <input name="trade_coding" value="<?php //echo empty($output['goods']['trade_coding'])?'':$output['goods']['trade_coding']; ?>" type="text"  class="text"  />
                </p>
                <p class="hint"><?php //echo lang('store_goods_index_goods_no_help');?></p>
              </dd>
            </dl>
            <dl>
              <dt nc_type="no_spec">商品条形码<?php //echo lang('nc_colon');?></dt>
              <dd nc_type="no_spec">
                  <input name="barcode" value="<?php //echo empty($output['goods']['barcode'])?'':$output['goods']['barcode']; ?>" type="text"  class="text"  />
              </dd>
            </dl>-->
            <dl>
              <dt><i class="required">*</i><?php echo lang('store_goods_album_goods_pic').lang('nc_colon');?></dt>
              <dd>
                <div class="ncsc-goods-default-pic">
                  <div class="goodspic-uplaod">
                    <div class="upload-thumb"><img nctype="goods_image" src="<?php if(!empty($output['goods'])) echo thumb($output['goods'], 240);?>"/> </div>
                    <input type="hidden" name="image_path" id="image_path" nctype="goods_image" value="<?php echo empty($output['goods']['pic_path'])?'':$output['goods']['pic_path'];?>" />
                    <span></span>
                    <p class="hint"><?php echo lang('store_goods_step2_description_one');?><?php printf(lang('store_goods_step2_description_two'),intval(C('image_max_filesize'))/1024);?></p>
                    <div class="handle">
                      <div class="ncsc-upload-btn"> <a href="javascript:void(0);"><span>
                        <input type="file" hidefocus="true" size="1" class="input-file" name="goods_image" id="goods_image">
                        </span>
                        <p><i class="icon-upload-alt"></i>图片上传</p>
                        </a> </div>
                      <a class="ncsc-btn mt5" nctype="show_image" href="<?php echo urlShop('admin/goods_tpl_album', 'pic_list', array('item'=>'goods'));?>"><i class="icon-picture"></i>从图片空间选择</a> <a href="javascript:void(0);" nctype="del_goods_demo" class="ncsc-btn mt5" style="display: none;"><i class="icon-circle-arrow-up"></i>关闭相册</a></div>
                  </div>
                </div>
                <div id="demo"></div>
              </dd>
            </dl>
            <h3 id="demo2"><?php echo lang('store_goods_index_goods_detail_info')?></h3>
            <!-- <dl style="overflow: visible;">
              <dt><?php //echo lang('store_goods_index_goods_brand').lang('nc_colon');?></dt>
              <dd>
                <div class="ncsc-brand-select">
                  <div class="selection">
                    <input name="b_name" id="b_name" value="<?php //echo empty($output['goods']['brand_name'])?'':$output['goods']['brand_name'];?>" type="text" class="text w180" readonly="readonly" />
                    <input type="hidden" name="b_id" id="b_id" value="<?php //echo empty($output['goods']['brand_id'])?'':$output['goods']['brand_id'];?>" />
                    <em class="add-on" nctype="add-on"><i class="icon-collapse"></i></em></div>
                  <div class="ncsc-brand-select-container">
                    <div class="brand-index" data-tid="<?php //echo !isset($output['goods_class']['id'])?'':$output['goods_class']['id'];?>" data-url="ajax_get_brand">
                      <div class="letter" nctype="letter">
                        <ul>
                          <li><a href="javascript:void(0);" data-letter="all">全部</a></li>
                          <li><a href="javascript:void(0);" data-letter="A">A</a></li>
                          <li><a href="javascript:void(0);" data-letter="B">B</a></li>
                          <li><a href="javascript:void(0);" data-letter="C">C</a></li>
                          <li><a href="javascript:void(0);" data-letter="D">D</a></li>
                          <li><a href="javascript:void(0);" data-letter="E">E</a></li>
                          <li><a href="javascript:void(0);" data-letter="F">F</a></li>
                          <li><a href="javascript:void(0);" data-letter="G">G</a></li>
                          <li><a href="javascript:void(0);" data-letter="H">H</a></li>
                          <li><a href="javascript:void(0);" data-letter="I">I</a></li>
                          <li><a href="javascript:void(0);" data-letter="J">J</a></li>
                          <li><a href="javascript:void(0);" data-letter="K">K</a></li>
                          <li><a href="javascript:void(0);" data-letter="L">L</a></li>
                          <li><a href="javascript:void(0);" data-letter="M">M</a></li>
                          <li><a href="javascript:void(0);" data-letter="N">N</a></li>
                          <li><a href="javascript:void(0);" data-letter="O">O</a></li>
                          <li><a href="javascript:void(0);" data-letter="P">P</a></li>
                          <li><a href="javascript:void(0);" data-letter="Q">Q</a></li>
                          <li><a href="javascript:void(0);" data-letter="R">R</a></li>
                          <li><a href="javascript:void(0);" data-letter="S">S</a></li>
                          <li><a href="javascript:void(0);" data-letter="T">T</a></li>
                          <li><a href="javascript:void(0);" data-letter="U">U</a></li>
                          <li><a href="javascript:void(0);" data-letter="V">V</a></li>
                          <li><a href="javascript:void(0);" data-letter="W">W</a></li>
                          <li><a href="javascript:void(0);" data-letter="X">X</a></li>
                          <li><a href="javascript:void(0);" data-letter="Y">Y</a></li>
                          <li><a href="javascript:void(0);" data-letter="Z">Z</a></li>
                          <li><a href="javascript:void(0);" data-letter="0-9">其他</a></li>
                          <li><a href="javascript:void(0);" data-empty="0">清空</a></li>
                        </ul>
                      </div>
                      <div class="search" nctype="search">
                        <input name="search_brand_keyword" id="search_brand_keyword" type="text" class="text" placeholder="品牌名称关键字查找"/><a href="javascript:void(0);" class="ncsc-btn-mini" style="vertical-align: top;">Go</a></div>
                    </div>
                    <div class="brand-list" nctype="brandList">
                      <ul nctype="brand_list">
                        <?php //if(!empty($output['brand_list']) && is_array($output['brand_list'])){?>
                        <?php //foreach($output['brand_list'] as $val) { ?>
                        <li data-id='<?php //echo $val['id'];?>'data-name='<?php //echo $val['name'];?>'><em><?php //echo $val['initial'];?></em><?php //echo $val['name'];?></li>
                        <?php //} ?>
                        <?php //}?>
                      </ul>
                    </div>
                    <div class="no-result" nctype="noBrandList" style="display: none;">没有符合"<strong>搜索关键字</strong>"条件的品牌</div>
                  </div>
                </div>
              </dd>
            </dl> -->
            <dl>
              <dt>宝贝属性<?php echo lang('nc_colon');?></dt>
              <dd>
                <ul>
                  <?php if(!empty($output['attr_list']) && is_array($output['attr_list'])):  ?>
                    <?php foreach($output['attr_list'] as $val) { ?>
                    <li class="J_spu-property" id="name_<?php echo $val['name_id'];?>">
                      <label class="label-title"> <?php echo $val['name'];?><?php echo lang('nc_colon');?></label>
                      <span>
                        <?php echo doInput($val['input_type'],$val['name_id'], $val['is_required'], $val['valList'], !empty($output['attr_checked'])?$output['attr_checked']:'')?>
                      </span>
                    </li>
                    <?php } ?>
                  <?php else:?>
                    暂未设置该类目下宝贝属性,去<a href="/admin/category/add?id=<?php echo $output['cid']?>">设置</a>
                  <?php endif?>
                </ul>
              </dd>
            </dl>
            <dl>
              <dt><?php echo lang('store_goods_index_goods_desc').lang('nc_colon');?></dt>
              <dd id="ncProductDetails">
                <div class="tabs">
                  <ul class="ui-tabs-nav" jquery1239647486215="2">
                    <li class="ui-tabs-selected"><a href="#panel-1" jquery1239647486215="8"><i class="icon-desktop"></i> 电脑端</a></li>
                    <li class="selected"><a href="#panel-2" jquery1239647486215="9"><i class="icon-mobile-phone"></i>手机端</a></li>
                  </ul>
                  <div id="panel-1" class="ui-tabs-panel" jquery1239647486215="4">
                    <?php showEditor('content',empty($output['goods']['content'])?'':$output['goods']['content'],'100%','480px','visibility:hidden;',"false",empty($output['editor_multimedia'])?'':$output['editor_multimedia']);?>
                    <div class="hr8">
                      <div class="ncsc-upload-btn"> <a href="javascript:void(0);"><span>
                        <input type="file" hidefocus="true" size="1" class="input-file" name="add_album" id="add_album" multiple="multiple">
                        </span>
                        <p><i class="icon-upload-alt" data_type="0" nctype="add_album_i"></i>图片上传</p>
                        </a> </div>
                      <a class="ncsc-btn mt5" nctype="show_desc" href="<?php echo urlShop('admin/goods_tpl_album', 'pic_list', array('item'=>'des'));?>"><i class="icon-picture"></i><?php echo lang('store_goods_album_insert_users_photo');?></a> <a href="javascript:void(0);" nctype="del_desc" class="ncsc-btn mt5" style="display: none;"><i class=" icon-circle-arrow-up"></i>关闭相册</a> </div>
                    <p id="des_demo"></p>
                  </div>
                  <div id="panel-2" class="ui-tabs-panel ui-tabs-hide" jquery1239647486215="5">
                    <div class="ncsc-mobile-editor">
                      <div class="pannel">
                        <div class="size-tip"><span nctype="img_count_tip">图片总数得超过<em>20</em>张</span><i>|</i><span nctype="txt_count_tip">文字不得超过<em>5000</em>字</span></div>
                        <div class="control-panel" nctype="mobile_pannel">
                          <?php if (!empty($output['goods']['m_content'])) {?>
                          <?php $m_content = json_decode($output['goods']['m_content'],true);
                           foreach ($m_content as $val) {?>
                          <?php if ($val['type'] == 'text') {?>
                          <div class="module m-text">
                            <div class="tools"><a nctype="mp_up" href="javascript:void(0);">上移</a><a nctype="mp_down" href="javascript:void(0);">下移</a><a nctype="mp_edit" href="javascript:void(0);">编辑</a><a nctype="mp_del" href="javascript:void(0);">删除</a></div>
                            <div class="content">
                              <div class="text-div"><?php echo $val['value'];?></div>
                            </div>
                            <div class="cover"></div>
                          </div>
                          <?php }?>
                          <?php if ($val['type'] == 'image') {?>
                          <div class="module m-image">
                            <div class="tools"><a nctype="mp_up" href="javascript:void(0);">上移</a><a nctype="mp_down" href="javascript:void(0);">下移</a><a nctype="mp_rpl" href="javascript:void(0);">替换</a><a nctype="mp_del" href="javascript:void(0);">删除</a></div>
                            <div class="content">
                              <div class="image-div"><img src="<?php echo $val['value'];?>"></div>
                            </div>
                            <div class="cover"></div>
                          </div>
                          <?php }?>
                          <?php }?>
                          <?php }?>
                        </div>
                        <div class="add-btn">
                          <ul class="btn-wrap">
                            <li><a href="javascript:void(0);" nctype="mb_add_img"><i class="icon-picture"></i>
                              <p>图片</p>
                              </a></li>
                            <li><a href="javascript:void(0);" nctype="mb_add_txt"><i class="icon-font"></i>
                              <p>文字</p>
                              </a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="explain">
                        <dl>
                          <dt>1、基本要求：</dt>
                          <dd>（1）手机详情总体大小：图片+文字，图片不超过20张，文字不超过5000字；</dd>
                          <dd>建议：所有图片都是本宝贝相关的图片。</dd>
                        </dl><dl>
                          <dt>2、图片大小要求：</dt>
                          <dd>（1）建议使用宽度480 ~ 620像素、高度小于等于960像素的图片；</dd>
                          <dd>（2）格式为：JPG\JEPG\GIF\PNG；</dd>
                          <dd>举例：可以上传一张宽度为480，高度为960像素，格式为JPG的图片。</dd>
                        </dl><dl>
                          <dt>3、文字要求：</dt>
                          <dd>（1）每次插入文字不能超过500个字，标点、特殊字符按照一个字计算；</dd>
                          <dd>建议：不要添加太多的文字，这样看起来更清晰。</dd>
                        </dl>
                      </div>
                    </div>
                    <div class="ncsc-mobile-edit-area" nctype="mobile_editor_area">
                      <div nctype="mea_img" class="ncsc-mea-img" style="display: none;"></div>
                      <div class="ncsc-mea-text" nctype="mea_txt" style="display: none;">
                        <p id="meat_content_count" class="text-tip"></p>
                        <textarea class="textarea valid" nctype="meat_content"></textarea>
                        <div class="button"><a class="ncsc-btn ncsc-btn-blue" nctype="meat_submit" href="javascript:void(0);">确认</a><a class="ncsc-btn ml10" nctype="meat_cancel" href="javascript:void(0);">取消</a></div>
                        <a class="text-close" nctype="meat_cancel" href="javascript:void(0);">X</a>
                      </div>
                    </div>
                    <input name="m_body" autocomplete="off" type="hidden" value='<?php echo empty($output['goods']['m_content'])?'':$output['goods']['m_content'];?>'>
                  </div>
                </div>
              </dd>
            </dl>
            <h3 id="demo4"><?php echo lang('store_goods_index_goods_transport')?></h3>
            <dl nctype="virtual_null">
              <dt><?php echo lang('store_goods_index_goods_transfee_charge').lang('nc_colon'); ?></dt>
              <dd>
                <ul class="ncsc-form-radio-list">
                  <li>
                    <input id="freight_0" nctype="freight" name="freight" class="radio" type="radio" <?php if (empty($output['goods']['transport_id']) || intval($output['goods']['transport_id']) == 0) {?>checked="checked"<?php }?> value="0">
                    <label for="freight_0">免运费</label>
                    
                  </li>
                  <li>
                    <input id="freight_1" nctype="freight" name="freight" class="radio" type="radio" <?php if (!empty($output['goods']['transport_id']) && intval($output['goods']['transport_id']) != 0) {?>checked="checked"<?php }?> value="1">
                    <label for="freight_1"><?php echo lang('store_goods_index_use_tpl');?></label>
                    <div nctype="div_freight" <?php if (empty($output['goods']['transport_id']) || intval($output['goods']['transport_id']) == 0) {?>style="display: none;"<?php }?>>
                      <input id="transport_id" type="hidden" value="<?php if (!empty($output['goods']['transport_id']))  echo $output['goods']['transport_id'];?>" name="transport_id">
                      <input id="transport_title" type="hidden" value="<?php if (!empty($output['goods']['transport_title'])) echo $output['goods']['transport_title'];?>" name="transport_title">
                      <span id="postageName" class="transport-name" <?php if (!empty($output['goods']['transport_title']) && $output['goods']['transport_title'] != '') {?>style="display: inline-block;"<?php }?>><?php echo empty($output['goods']['transport_title'])?'':$output['goods']['transport_title'];?></span><a href="JavaScript:void(0);" onclick="window.open('<?php echo urlShop('admin/shop_transport', 'index');?>')" class="ncsc-btn" id="postageButton"><i class="icon-truck"></i><?php echo lang('store_goods_index_select_tpl');?></a> </div>
                  </li>
                </ul>
                
              </dd>
            </dl>
            <dl>
              <dt><?php echo '模板'.lang('nc_colon');?></dt>
              <dd>
                <ul class="ncsc-form-radio-list">
                  <li>
                    <label>
                      <input name="g_state" value="1" type="radio" <?php if (empty($output['goods']) || $output['goods']['status'] == 1) {?>checked="checked"<?php }?> />
                      上架
                      <input name="g_state" value="2" type="radio" <?php if (!empty($output['goods']['status']) && $output['goods']['status'] == 2) {?>checked="checked"<?php }?> />
                      下架
                    </label>
                  </li>
                </ul>
              </dd>
            </dl>
            <dl>
              <dt><?php echo '7天无理由退货'.lang('nc_colon');?></dt>
              <dd>
                <ul class="ncsc-form-radio-list">
                  <li>
                    <label>
                      <input name="service_sort" value="1" type="radio" <?php if (!empty($output['goods']) && $output['goods']['service_sort'] == 1) {?>checked="checked"<?php }?> />
                      支持
                      <input name="service_sort" value="0" type="radio" <?php if (empty($output['goods']['service_sort']) || $output['goods']['service_sort'] == 0) {?>checked="checked"<?php }?> />
                      不支持
                    </label>
                  </li>
                </ul>
              </dd>
            </dl>
            
          </div>
          <div class="bottom tc hr32">
            <label class="submit-border">
              <input type="submit" class="submit" value="<?php if(empty($output['goods'])) echo lang('store_goods_add_next').'，上传商品图片'; else echo '提交';?>" />
            </label>
          </div>
        </form>
      </div>

<script type="text/javascript">
      var SITEURL = "<?php echo BASE_SITE_URL; ?>";
      var DEFAULT_GOODS_IMAGE = "";
      var SHOP_RESOURCE_SITE_URL = "<?php echo _get_cfg_path('seller');?>";

      $(function(){
        //电脑端手机端tab切换
        $(".tabs").tabs();
        
        $.validator.addMethod('checkPrice', function(value,element){
          _g_price = parseFloat($('input[name="price"]').val());
            _g_marketprice = parseFloat($('input[name="market_price"]').val());
            if (_g_price > _g_marketprice) {
                return false;
            }else {
                return true;
            }
        }, '<i class="icon-exclamation-sign"></i>销售价不能高于市场价');

        jQuery.validator.addMethod("checkFCodePrefix", function(value, element) {       
          return this.optional(element) || /^[a-zA-Z]+$/.test(value);       
        },'<i class="icon-exclamation-sign"></i>请填写不多于5位的英文字母');  
          $('#goods_form').validate({
              errorPlacement: function(error, element){
                  $(element).nextAll('span').append(error);
              },
              
              submitHandler:function(form){
                  ajaxpost('goods_form', '', '', 'onerror');
              },
              
              rules : {
                  title : {
                      required    : true,
                      minlength   : 3,
                      maxlength   : 50
                  },
                  point : {
                      maxlength   : 140
                  },
                  price : {
                      required    : true,
                      number      : true,
                      min         : 0.01,
                      max         : 9999999,
                      checkPrice  : true
                  },
                  market_price : {
                      required    : true,
                      number      : true,
                      min         : 0.01,
                      max         : 9999999
                  },
                  comm_precent : {
                      required    : true,
                      number      : true,
                      min         : 0.00,
                      max         : 100
                  },
                  cost_price : {
                      number      : true,
                      min         : 0.00,
                      max         : 9999999
                  },
                  stock_num  : {
                      required    : true,
                      digits      : true,
                      min         : 0,
                      max         : 999999999
                  },
                  image_path : {
                      required    : true
                  },
                  g_vindate : {
                      required    : function() {if ($("#is_gv_1").prop("checked")) {return true;} else {return false;}}
                  },
            g_vlimit : {
              required  : function() {if ($("#is_gv_1").prop("checked")) {return true;} else {return false;}},
              range   : [1,10]
            },
            g_fccount : {
              required  : function() {if ($("#is_fc_1").prop("checked")) {return true;} else {return false;}},
              range   : [1,100]
            },
            g_fcprefix : {
              required  : function() {if ($("#is_fc_1").prop("checked")) {return true;} else {return false;}},
              checkFCodePrefix : true,
              rangelength : [3,5]
            },
            g_saledate : {
              required  : function () {if ($('#is_appoint_1').prop("checked")) {return true;} else {return false;}}
            },
            g_deliverdate : {
              required  : function () {if ($('#is_presell_1').prop("checked")) {return true;} else {return false;}}
            }
              },
              messages : {
                  title  : {
                      required    : '<i class="icon-exclamation-sign"></i><?php echo lang('store_goods_index_goods_name_null');?>',
                      minlength   : '<i class="icon-exclamation-sign"></i><?php echo lang('store_goods_index_goods_name_help');?>',
                      maxlength   : '<i class="icon-exclamation-sign"></i><?php echo lang('store_goods_index_goods_name_help');?>'
                  },
                  point : {
                      maxlength   : '<i class="icon-exclamation-sign"></i>商品卖点不能超过140个字符'
                  },
                  price : {
                      required    : '<i class="icon-exclamation-sign"></i><?php echo lang('store_goods_index_store_price_null');?>',
                      number      : '<i class="icon-exclamation-sign"></i><?php echo lang('store_goods_index_store_price_error');?>',
                      min         : '<i class="icon-exclamation-sign"></i><?php echo lang('store_goods_index_store_price_interval');?>',
                      max         : '<i class="icon-exclamation-sign"></i><?php echo lang('store_goods_index_store_price_interval');?>'
                  },
                  market_price : {
                      required    : '<i class="icon-exclamation-sign"></i>请填写市场价',
                      number      : '<i class="icon-exclamation-sign"></i>请填写正确的价格',
                      min         : '<i class="icon-exclamation-sign"></i>请填写0.01~9999999之间的数字',
                      max         : '<i class="icon-exclamation-sign"></i>请填写0.01~9999999之间的数字'
                  },
                  cost_price : {
                      number      : '<i class="icon-exclamation-sign"></i>请填写正确的价格',
                      min         : '<i class="icon-exclamation-sign"></i>请填写0.00~9999999之间的数字',
                      max         : '<i class="icon-exclamation-sign"></i>请填写0.00~9999999之间的数字'
                  },
                  comm_precent : {
                      number      : '<i class="icon-exclamation-sign"></i>请填写正确的比率',
                      min         : '<i class="icon-exclamation-sign"></i>请填写0.00~100之间的数字',
                      max         : '<i class="icon-exclamation-sign"></i>请填写0.00~100之间的数字'
                  },
                  stock_num : {
                      required    : '<i class="icon-exclamation-sign"></i><?php echo lang('store_goods_index_goods_stock_null');?>',
                      digits      : '<i class="icon-exclamation-sign"></i><?php echo lang('store_goods_index_goods_stock_error');?>',
                      min         : '<i class="icon-exclamation-sign"></i><?php echo lang('store_goods_index_goods_stock_checking');?>',
                      max         : '<i class="icon-exclamation-sign"></i><?php echo lang('store_goods_index_goods_stock_checking');?>'
                  },
                  image_path : {
                      required    : '<i class="icon-exclamation-sign"></i>请设置商品主图'
                  },
                  g_vindate : {
                      required    : '<i class="icon-exclamation-sign"></i>请选择有效期'
                  },
            g_vlimit : {
              required  : '<i class="icon-exclamation-sign"></i>请填写1~10之间的数字',
              range   : '<i class="icon-exclamation-sign"></i>请填写1~10之间的数字'
            },
            g_fccount : {
              required  : '<i class="icon-exclamation-sign"></i>请填写1~100之间的数字',
              range   : '<i class="icon-exclamation-sign"></i>请填写1~100之间的数字'
            },
            g_fcprefix : {
              required  : '<i class="icon-exclamation-sign"></i>请填写3~5位的英文字母',
              rangelength : '<i class="icon-exclamation-sign"></i>请填写3~5位的英文字母'
            },
            g_saledate : {
              required  : '<i class="icon-exclamation-sign"></i>请选择有效期'
            },
            g_deliverdate : {
              required  : '<i class="icon-exclamation-sign"></i>请选择有效期'
            }
              }
          });
          <?php //if (isset($output['goods'])) {?>
        //setTimeout("setArea(<?php //echo $output['goods']['areaid_1'];?>, <?php //echo $output['goods']['areaid_2'];?>)", 1000);
        <?php //}?>
      });
      // 按规格存储规格值数据
      var spec_group_checked = [<?php for ($i=0; $i<$output['sign_i']; $i++){if($i+1 == $output['sign_i']){echo "''";}else{echo "'',";}}?>];
      var str = '';
      var V = new Array();

      <?php for ($i=0; $i<$output['sign_i']; $i++){?>
      var spec_group_checked_<?php echo $i;?> = new Array();
      <?php }?>

      $(function(){
        $('dl[nctype="spec_group_dl"]').on('click', 'span[nctype="input_checkbox"] > input[type="checkbox"]',function(){
          into_array();
          //goods_color_set();
          goods_stock_set();
        });

        // 提交后不没有填写的价格或库存的库存配置设为默认价格和0
        // 库存配置隐藏式 里面的input加上disable属性
        $('input[type="submit"]').click(function(){
          $('input[data_type="price"]').each(function(){
            if($(this).val() == ''){
              $(this).val($('input[name="price"]').val());
            }
          });
          $('input[data_type="stock"]').each(function(){
            if($(this).val() == ''){
              $(this).val('0');
            }
          });
          // $('input[data_type="alarm"]').each(function(){
          //   if($(this).val() == ''){
          //     $(this).val('0');
          //   }
          // });
          // if($('dl[nc_type="spec_dl"]').css('display') == 'none'){
          //   $('dl[nc_type="spec_dl"]').find('input').attr('disabled','disabled');
          // }
        });
        
      });

      // 将选中的规格放入数组
      function into_array(){
      <?php for ($i=0; $i<$output['sign_i']; $i++){?>
          
          spec_group_checked_<?php echo $i;?> = new Array();
          $('dl[nc_type="spec_group_dl_<?php echo $i;?>"]').find('input[type="checkbox"]:checked').each(function(){
            i = $(this).attr('nc_type');
            v = $(this).val();
            c = null;
            if ($(this).parents('dl:first').attr('spec_img') == 't') {
              c = 1;
            }
            spec_group_checked_<?php echo $i;?>[spec_group_checked_<?php echo $i;?>.length] = [v,i,c];
          });

          spec_group_checked[<?php echo $i;?>] = spec_group_checked_<?php echo $i;?>;

      <?php }?>
      }

      //color
      
      function goods_color_set(){
          var item = '';
          $('dl[spec_img=t]').find('ul[class=spec] li').each(function(){
              var nc_type = $(this).find('input[type=checkbox]').attr('nc_type');
              var sp_val = $(this).find('input[type=checkbox]').val();
              item += '<tr><td>'+sp_val+'</td>'
                                  +'<td><div class="ncsc-upload-btn spec_file"> <a href="javascript:void(0);"><span>'
                                  +'<input type="file" hidefocus="true" size="1" class="input-file" name="file_'+nc_type+'" id="file_'+nc_type+'">'
                                  +'</span><p><i class="icon-upload-alt"></i>图片上传</p></a></div></td>'
                                  +'<td nc_type="spec_img_td">'
                                  +'<img nctype="file_'+nc_type+'" src=""><a href="javascript:void(0)" nctype="spec_file_del">删除</a></td>'
                                  +'</tr>';
          });
//var img = $('#spec_img').find('img[nctype=file_'+s+']');
//console.log(img);
          $('#spec_img').html(item);
      }

      // 生成库存配置
      function goods_stock_set(){
          //  店铺价格 商品库存改为只读
          //$('input[name="price"]').attr('readonly','readonly').css('background','#E7E7E7 none');
          $('input[name="stock_num"]').attr('readonly','readonly').css('background','#E7E7E7 none');

          $('dl[nc_type="spec_dl"]').show();
          str = '<tr>';
          <?php recursionSpec(0,$output['sign_i']);?>
          if(str == '<tr>'){
              //  店铺价格 商品库存取消只读
              $('input[name="price"]').removeAttr('readonly').css('background','');
              $('input[name="stock_num"]').removeAttr('readonly').css('background','');
              $('dl[nc_type="spec_dl"]').hide();
          }else{
              $('tbody[nc_type="spec_table"]').empty().html(str)
                  .find('input[nc_type]').each(function(){
                      s = $(this).attr('nc_type');
                      try{$(this).val(V[s]);}catch(ex){$(this).val('');};
                      if ($(this).attr('data_type') == 'marketprice' && $(this).val() == '') {
                          $(this).val($('input[name="market_price"]').val());
                      }
                      if ($(this).attr('data_type') == 'price' && $(this).val() == ''){
                          $(this).val($('input[name="price"]').val());
                      }
                      if ($(this).attr('data_type') == 'stock' && $(this).val() == ''){
                          $(this).val('0');
                      }
                      if ($(this).attr('data_type') == 'alarm' && $(this).val() == ''){
                          $(this).val('0');
                      }
                  }).end()
                  .find('input[data_type="stock"]').change(function(){
                      computeStock();    // 库存计算
                  }).end()
                  .find('input[data_type="price"]').change(function(){
                      computePrice();     // 价格计算
                  }).end()
                  .find('input[nc_type]').change(function(){
                      s = $(this).attr('nc_type');
                      V[s] = $(this).val();
                  });
          }
      }

      <?php 
      /**
       * 
       * 
       *  生成需要的js循环。递归调用  PHP
       * 
       *  形式参考 （ 2个规格）
       *  $('input[type="checkbox"]').click(function(){
       *      str = '';
       *      for (var i=0; i<spec_group_checked[0].length; i++ ){
       *      td_1 = spec_group_checked[0][i];
       *          for (var j=0; j<spec_group_checked[1].length; j++){
       *              td_2 = spec_group_checked[1][j];
       *              str += '<tr><td>'+td_1[0]+'</td><td>'+td_2[0]+'</td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td>';
       *          }
       *      }
       *      $('table[class="spec_table"] > tbody').empty().html(str);
       *  });
       */
      function recursionSpec($len,$sign) {
          if($len < $sign){
              echo "for (var i_".$len."=0; i_".$len."<spec_group_checked[".$len."].length; i_".$len."++){td_".(intval($len)+1)." = spec_group_checked[".$len."][i_".$len."];\n";
              $len++;
              recursionSpec($len,$sign);
          }else{
              echo "var tmp_spec_td = new Array();\n";
              for($i=0; $i< $len; $i++){
                  echo "tmp_spec_td[".($i)."] = td_".($i+1)."[1];\n";
              }
              //echo "tmp_spec_td.sort(function(a,b){return a-b});\n";
              echo "var spec_bunch = 'i_';\n";
              for($i=0; $i< $len; $i++){
                  echo "spec_bunch += tmp_spec_td[".($i)."];\n";
                  if($i!=$len-1)
                    echo "spec_bunch += '_';\n";
              }
              echo "str += '<input type=\"hidden\" name=\"spec['+spec_bunch+'][goods_id]\" nc_type=\"'+spec_bunch+'|id\" value=\"\" />';";
              for($i=0; $i< $len; $i++){
                  echo "if (td_".($i+1)."[2] != null) { str += '<input type=\"hidden\" name=\"spec['+spec_bunch+'][color]\" value=\"'+td_".($i+1)."[1]+'\" />';}";
                  echo "str +='<td><input type=\"hidden\" name=\"spec['+spec_bunch+'][sp_value]['+td_".($i+1)."[1]+']\" value=\"'+td_".($i+1)."[0]+'\" />'+td_".($i+1)."[0]+'</td>';\n";
              }
              echo "str +='<td><input class=\"text price\" type=\"text\" name=\"spec['+spec_bunch+'][marketprice]\" data_type=\"marketprice\" nc_type=\"'+spec_bunch+'|marketprice\" value=\"\" /><em class=\"add-on\"><i class=\"icon-renminbi\"></i></em></td><td><input class=\"text price\" type=\"text\" name=\"spec['+spec_bunch+'][price]\" data_type=\"price\" nc_type=\"'+spec_bunch+'|price\" value=\"\" /><em class=\"add-on\"><i class=\"icon-renminbi\"></i></em></td><td><input class=\"text price\" type=\"text\" name=\"spec['+spec_bunch+'][costprice]\" data_type=\"costprice\" nc_type=\"'+spec_bunch+'|costprice\" value=\"\" /><em class=\"add-on\"><i class=\"icon-renminbi\"></i></em></td><td><input class=\"text price\" type=\"text\" name=\"spec['+spec_bunch+'][commprecent]\" data_type=\"commprecent\" nc_type=\"'+spec_bunch+'|commprecent\" value=\"\" /><em class=\"add-on\">%</em></td><td><input class=\"text stock\" type=\"text\" name=\"spec['+spec_bunch+'][stock]\" data_type=\"stock\" nc_type=\"'+spec_bunch+'|stock\" value=\"\" /></td></tr>';\n";
              for($i=0; $i< $len; $i++){
                  echo "}\n";
              }
          }
      }

      ?>


      <?php if (!empty($output['goods']) && empty($_GET['cid']) && !empty($output['spec_checked']) && !empty($output['spec_list'])){?>
      //  编辑商品时处理JS
      $(function(){
        var E_SP = new Array();
        var E_SP_Img = new Array();
        var E_SPV = new Array();
        <?php
        $string = '';
        $string_img = '';
        foreach ($output['spec_checked'] as $v) {
          $string .= "E_SP[".$v['id']."] = '".$v['name']."';";
          $string_img.="E_SP_Img[".$v['id']."] = '".$v['pic']."';";
        }
        echo $string;
        echo "\n";
        echo $string_img;
        echo "\n";
        $string = '';
        foreach ($output['sp_value'] as $k=>$v) {
          $string .= "E_SPV['{$k}'] = '{$v}';";
        }
        echo $string;
        ?>
        V = E_SPV;
        $('dl[nc_type="spec_dl"]').show();
        $('dl[nctype="spec_group_dl"]').find('input[type="checkbox"]').each(function(){
          //  店铺价格 商品库存改为只读
          //$('input[name="price"]').attr('readonly','readonly').css('background','#E7E7E7 none');
          $('input[name="stock_num"]').attr('readonly','readonly').css('background','#E7E7E7 none');
          s = $(this).attr('nc_type');
          if (!(typeof(E_SP[s]) == 'undefined')){
            $(this).attr('checked',true);
            v = $(this).parents('li').find('span[pv_type="pv_name"]');
            // if(E_SP[s] != ''){
            //   $(this).val(E_SP[s]);
            //   v.html('<input type="text" maxlength="20" value="'+E_SP[s]+'" />');
            // }else{
            //   v.html('<input type="text" maxlength="20" value="'+v.html()+'" />');
            // }
            change_img_name($(this));     // 修改相关的颜色名称

            if(E_SP[s] != ''){
              var input_img = $(this).parents('li').find('input[pv_type="pv_img"]');
              if(input_img)
                input_img.val(E_SP_Img[s]);
              var img = $('#spec_img').find('img[nctype=file_'+s+']');
              //console.log(img);
              if(img)
                img.attr('src',E_SP_Img[s]);

            }
          }
        });

          into_array(); // 将选中的规格放入数组
          str = '<tr>';
          goods_color_set();
          <?php recursionSpec(0,$output['sign_i']);?>
          if(str == '<tr>'){
              $('dl[nc_type="spec_dl"]').hide();
              $('input[name="price"]').removeAttr('readonly').css('background','');
              $('input[name="stock_num"]').removeAttr('readonly').css('background','');
          }else{
              $('tbody[nc_type="spec_table"]').empty().html(str)
                  .find('input[nc_type]').each(function(){
                      s = $(this).attr('nc_type');
                      try{$(this).val(E_SPV[s]);}catch(ex){$(this).val('');};
                  }).end()
                  .find('input[data_type="stock"]').change(function(){
                      computeStock();    // 库存计算
                  }).end()
                  .find('input[data_type="price"]').change(function(){
                      computePrice();     // 价格计算
                  }).end()
                  .find('input[type="text"]').change(function(){
                      s = $(this).attr('nc_type');
                      V[s] = $(this).val();
                  });
          }
      });
      <?php }?>
      </script> 
      <script src="<?php echo _get_cfg_path('seller_js');?>scrolld.js"></script>
      <script type="text/javascript">$("[id*='Btn']").stop(true).on('click', function (e) {e.preventDefault();$(this).scrolld();})</script>

