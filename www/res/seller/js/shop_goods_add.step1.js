// 选择商品分类
function selClass($this){

    $('.wp_category_list').css('background', '');

    $("#commodityspan").hide();
    $("#commoditydt").show();
    $("#commoditydd").show();
    $this.siblings('li').children('a').attr('class', '');
    $this.children('a').attr('class', 'classDivClick');
    var data_str = '';
    eval('data_str = ' + $this.attr('data-param'));
    $('#class_id').val(data_str.cid);
    $('#dataLoading').show();
    var deep = parseInt(data_str.deep) + 1;
    
    $.getJSON(SITEURL+'/seller/goods_add/ajax_category_list', {cid : data_str.cid, deep: deep}, function(data) {
        if (data != null) {
            $('input[nctype="buttonNextStep"]').attr('disabled', true);
            $('#class_div_' + deep).children('ul').html('').end()
                .parents('.wp_category_list:first').removeClass('blank')
                .parents('.sort_list:first').nextAll('div').children('div').addClass('blank').children('ul').html('');
            $.each(data, function(i, n){
                $('#class_div_' + deep).children('ul').append('<li data-param="{cid:'
                        + n.id +',deep:'+ deep +'}"><a class="" href="javascript:void(0)"><i class="icon-double-angle-right"></i>'
                        + n.name + '</a></li>')
                        .find('li:last').click(function(){
                            selClass($(this));
                        });
            });
        } else {
            $('#class_div_' + data_str.deep).parents('.sort_list:first').nextAll('div').children('div').addClass('blank').children('ul').html('');
            //disabledButton();
        }
        // 显示选中的分类
        showCheckClass();
        $('#dataLoading').hide();
    });
}
function disabledButton() {
    if ($('#tpl_id').val() != '') {
        $('input[nctype="buttonNextStep"]').attr('disabled', false).css('cursor', 'pointer');
    } else {
        $('input[nctype="buttonNextStep"]').attr('disabled', true).css('cursor', 'auto');
    }
}

$(function(){

    $('#btnTplSearch').click(function(){
        var keyword = $('#tpl_title').val();
        var cid = $('#class_id').val();
        $.getJSON(SITEURL+'/seller/goods_add/ajax_goods_tpl', {keyword : keyword, cid: cid}, function(data) {
            if (data != null) {
                $('#tpl_id option').remove();

                if(data.length==0){
                    $('#tpl_id_msg').html('暂无标准商品模板');
                    $('#tpl_id').hide();
                }
                else{
                    $('#div_tpl_id').show();
                    $('#tpl_id_msg').html('');
                    $('#tpl_id').show();
                    $('#tpl_id').append("<option value=''>请选择模板</option>");
                    disabledButton();
                }
                
                $.each(data, function(i, n){
                   $('#tpl_id').append("<option value="+n.tpl_id+">"+n.title+"</option>");
                });
            } else 
               $('#tpl_id_msg').html('暂无标准商品模板');
            // 显示选中的分类
            showCheckClass();
            $('#dataLoading').hide();
        });
    });
    $('#tpl_id').change(function(){
        disabledButton();
    });

    //自定义滚定条
    $('#class_div_1').perfectScrollbar();
    $('#class_div_2').perfectScrollbar();
    $('#class_div_3').perfectScrollbar();

    // ajax选择分类
    $('li[nctype="selClass"]').click(function(){
        selClass($(this));
    });

    // 返回分类选择
    $('a[nc_type="return_choose_sort"]').unbind().click(function(){
        $('#class_id').val('');
        $('#t_id').val('');
        $("#commodityspan").show();
        $("#commoditydt").hide();
        $('#commoditydd').html('');
        $('.wp_search_result').hide();
        $('.wp_sort').show();
    });
    
    // 常用分类选择 展开与隐藏
    $('#commSelect').hover(
        function(){
            $('#commListArea').show();
        },function(){
            $('#commListArea').hide();
        }
    );
    
    // 常用分类选择
    $('#commListArea').find('span[nctype="staple_name"]').die().live('click',function() {
        $('#dataLoading').show();
        $('.wp_category_list').addClass('blank');
        $this = $(this);
        eval('var data_str = ' + $this.parents('li').attr('data-param'));
        $.getJSON('index.php?act=store_goods_add&op=ajax_show_comm&stapleid=' + data_str.stapleid, function(data) {
            if (data.done) {
                $('.category_list').children('ul').empty();
                if (data.one.length > 0) {
                    $('#class_div_1').children('ul').append(data.one).parents('.wp_category_list').removeClass('blank');
                }
                if (data.two.length > 0) {
                    $('#class_div_2').children('ul').append(data.two).parents('.wp_category_list').removeClass('blank');
                }
                if (data.three.length > 0) {
                    $('#class_div_3').children('ul').append(data.three).parents('.wp_category_list').removeClass('blank');
                }
                // 绑定ajax选择分类事件
                $('#class_div').find('li[nctype="selClass"]').click(function(){
                    selClass($(this));
                });
                $('#class_id').val(data.gc_id);
                $('#t_id').val(data.type_id);
                $("#commodityspan").hide();
                $("#commoditydt").show();
                // 显示选中的分类
                showCheckClass();
                $('#commSelect').children('div:first').html($this.text());
                //disabledButton();
                $('#commListArea').hide();
            } else {
                $('.wp_category_list').css('background', '#E7E7E7 none');
                $('#commListArea').find('li').css({'background' : '', 'color' : ''});
                $this.parent().css({'background' : '#3399FD', 'color' : '#FFF'});
            }
        });
        $('#dataLoading').hide();
    });
    
    // ajax删除常用分类
    $('#commListArea').find('a[nctype="del-comm-cate"]').die().live('click',function() {
        $this = $(this);
        eval('var data_str = ' + $this.parents('li').attr('data-param'));
        $.getJSON('index.php?act=store_goods_add&op=ajax_stapledel&staple_id='+ data_str.stapleid, function(data) {
            if (data.done) {
                $this.parents('li:first').remove();
                if ($('#commListArea').find('li').length == 1) {
                    $('#select_list_no').show();
                }
            } else {
                alert(data.msg);
            }
        });
    });

    
});
// 显示选中的分类
function showCheckClass(){
    var str = "";
    $.each($('a[class=classDivClick]'), function(i) {
        str += $(this).text() + '<i class="icon-double-angle-right"></i>';
    });
    str = str.substring(0, str.length - 39);
    $('#commoditydd').html(str);
}