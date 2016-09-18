<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refund extends MY_Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

     function refund_manage() {

         $this->load->helper('Goods');
         $this->load->model('Order_refunds_model'); //退款列表
         $this->load->model('Order_goods_model'); //退款列表
         $this->load->model('Shot_goods_model'); //订单产品信息表
         $this->load->model('Shop_model'); //店铺信息
         $this->load->model('User_model'); //买家信息

         $type = $this->input->post_get('type');
         $page = $this->input->post_get('page');
         $pagesize = $this->input->post_get('pagesize');
         $add_time_from = $this->input->post_get('add_time_from');
         $add_time_to = $this->input->post_get('add_time_to');
         $key = $this->input->post_get('key');

         $page     = !empty($page)?$page:1;//接收前台的页码
         $pagesize = !empty($pagesize)?$pagesize:10;
         $arrParam = array();
         $arrWhere = array();
         $strOrder = 'lasttime desc';

         if(!empty($key)){
             $arrWhere['order_id']  = $key;
             $arrParam['key'] = $key;
         }


         if(!empty($add_time_from)){
             $arrWhere['addtime >= "']  = strtotime($add_time_from) .'"';
             $arrParam['query_start_date'] = $add_time_from;
         }

         if(!empty($add_time_to)){
             $arrWhere['addtime <= "']  = strtotime($add_time_to)+122400 .'"';
             $arrParam['query_end_date'] = $add_time_to;
         }

         switch($type){
             case 'all':
                 $arrParam['type'] = 'all';
                 break;
             case 'wait':
                 $arrWhere['status']  = 2;
                 $arrParam['type'] = 'wait';
                 break;
             default:

         }

         $list = $this->Order_refunds_model->fetch_page($page,$pagesize,$arrWhere,'id as order_goods_id,order_id,goods_id,shop_id,user_id,status,addtime,refunds_money',$strOrder);

         foreach($list['rows'] as $k => $v){

             $aList = $list['rows'][$k];
             //获取订单信息
             $orderInfo = $this->Order_goods_model->get_by_id($v['order_goods_id'],'price,num');
             //快照信息
             $goodsInfo = $this->Shot_goods_model->get_by_id($v['goods_id'],'title,pic_path');
             //获取店铺信息
             $shopInfo = $this->Shop_model->get_by_where('id ='.$v['shop_id'],'seller_username');
             //买家家信息
             $userInfo = $this->User_model->get_by_id($v['user_id'],'user_name');

             $aList['goods_name'] = $goodsInfo['title'];
             $aList['pic_path'] = cthumb($goodsInfo['pic_path']);
             $aList['num'] = $orderInfo['num'];
             $aList['seller_username'] = $shopInfo['seller_username'];
             $aList['buyer_name'] = $userInfo['user_name'];
             unset($aList['goods_id']);
             $list['rows'][$k] = $aList;
         }
         

         //分页
         $pagecfg = array();
         $pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/refund/refund_manage', $arrParam);
         $pagecfg['total_rows']   = $list['count'];
         $pagecfg['cur_page'] = $page;
         $pagecfg['per_page'] = $pagesize;
         
         $this->pagination->initialize($pagecfg);
         $list['pages'] = $this->pagination->create_links();

         $dataList = array();
         $data = array(
             'list'             => $list,
             'type'             => $type,
             'dataList'         => $dataList,
             'add_time_from'    => $add_time_from,
             'add_time_to'      => $add_time_to,
             'key'              => $key,
         );

         $this->load->view('admin/refund_manage_list',$data);
     }
}
