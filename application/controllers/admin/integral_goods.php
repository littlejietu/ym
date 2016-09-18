<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Integral_Goods extends MY_Admin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Integral_goods_model');
		$this->load->model('Exchange_record_model');
		$this->load->service('address_service');
		$this->load->service('user_service');
		$this->load->helper('goods_helper');
//		$this->load->model('User_account_model');
    }
    /*
     * 礼品列表
     * */
	public function index()
	{
        $this->lang->load('admin_layout');
        $this->lang->load('admin_first');
		$whereArr = array(
//			'shop_id'=>0
			'status' =>1,
		);
		$goods_name = $this->input->post_get('goods_name');
		$page     = _get_page();
		$pagesize = 10;
		$param = array(
			'goods_name' =>$goods_name
		);
		if($goods_name){
			$whereArr['goods_name like'] = "'%$goods_name%'";
		}

		$list = $this->Integral_goods_model->fetch_page($page, $pagesize,$whereArr);
		foreach($list['rows'] as $k =>$v){
			$list['rows'][$k]['goods_url'] = BASE_SITE_URL.'/'.($list['rows'][$k]['goods_url']);
		}
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/integral_goods',$param);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();
		$list['goods_name'] = $goods_name;
		$this->load->view('admin/integral/exchange_goods_list',$list);

//		echo json_encode($result);

	}




	/*
	 * 添加编辑礼品
	 * */
	public function add(){
		$id = $this->input->post_get('id');
		$result = array();
		if($id){
			$result['goodsInfo'] = $this->Integral_goods_model->get_by_id($id);
			$result['goodsInfo']['goods_path'] = ($result['goodsInfo']['goods_url']);
			$result['goodsInfo']['goods_url'] = BASE_SITE_URL.'/'.($result['goodsInfo']['goods_url']);

		}
		$this->load->view('admin/integral/exchange_goods_add',$result);
	}

	public function addGoods(){
		$id = $this->input->post_get('id');
		$config = array(
			array(
				'field'   => 'goodsname',
				'label'   => '兑换物品名',
				'rules'   => 'trim|required'
			),
			array(
				'field'   => 'goodsprice',
				'label'   => '原价',
				'rules'   => 'greater_than[0]|numeric'
			),
			array(
				'field'   => 'goodspoints',
				'label'   => '需要积分',
				'rules'   => 'greater_than[0]|integer'
			),
			array(
				'field'   => 'goodsstorage',
				'label'   => '库存数量',
				'rules'   => 'greater_than[0]|integer'
			),
			array(
				'field'   => 'goodsUrl',
				'label'   => '库存数量',
				'rules'   => 'trim|required'
			),

		);

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() === TRUE )
		{
			$data = array(
				'goods_name' => $this->input->post('goodsname'),
				'goods_url' => $this->input->post('goodsUrl'),
				'price' =>  $this->input->post('goodsprice'),
				'integral_cost' => $this->input->post('goodspoints'),
				'total' => $this->input->post('goodsstorage'),
			);
			if(!empty($id)){
				$result = $this->Integral_goods_model->update_by_id($id,$data);
			}else{
				$data['add_date'] = time();
				$data['type'] = 1;
				$data['limit'] = -1;
				$data['additional_pay'] = 0;
				$data['exchange_num'] = 0;
				$data['status'] = 1;

//				$data['shop_id'] = 0;todo

				$result = $this->Integral_goods_model->insert_string($data);
			}
			if ($result) {
				output_data($result);
			} else {
				output_error(3, '添加失败');
			}

		}else{
			output_error(-1,"数据格式错误");
		}
	}

	/**
	 * 批量删除
	 */
	public function del()
	{
	    $id = $this->input->post('pg_id');
	    $where['id'] = $id;
	    $edit_data = array(
	        'status' => 2,
	    );
	    $result = $this->Integral_goods_model->update_by_where($where,$edit_data);
	    if($result){
	        showMessage('删除成功!',ADMIN_SITE_URL.'/integral_goods');
	    }
	}
	
	/*
	 * 删除
	 * */
	public function delete_goods(){
		$id = $this->input->post('id');
		if(!$id){
			$id = [];
		}else{
			$id = explode(',',$id);
		}
		$where = array(
			'id' => $id
		);
		$edit_data = array(
			'status' => 2,
		);
		$result = $this->Integral_goods_model->update_by_where($where,$edit_data);
		if($result){
			output_data($result);
		}else{
			output_error(-1,'没有这个物品');
		}
//		if ($result) {
//			$this->ajax_response(0, '删除成功');
//			return false;
//		} else {
//			$this->ajax_response(10002, '删除失败');
//			return false;
//		}
//		$where =array(
//			"status <"=>2
//		);
//		$coupon_list = $this->Coupon_model->get_list($where);
//		$result = array(
//			'coupon_list' => $coupon_list,
//		);
////
//		$this->load->view('admin/coupon_list',$result);
	}

	/*
	 * 订单列表
	 * */
	public function order_list(){
		$order_num_input = $this->input->post_get('order_num_input' );
		$user_name_input = $this->input->post_get('user_name_input' );
		$order_state = $this->input->post_get('order_state' );

		$arrWhere = array();
		if (!empty($order_num_input))
		{
			$arrWhere['order_num like'] = "'%$order_num_input%'";
		}
		if (!empty($user_name_input))
		{
			$arrWhere['user_name like'] = "'%$user_name_input%'";
		}
		if (!empty($order_state))
		{
			$arrWhere['status'] = $order_state;
		}

		$param = array(
			'order_num_input' =>$order_num_input,
			'user_name_input' =>$user_name_input,
			'order_state' =>$order_state,


		);

		$page     = _get_page();
		$pagesize = 10;
		$list = $this->Exchange_record_model->fetch_page($page, $pagesize,$arrWhere);
		$list['order_num_input'] = $order_num_input;
		$list['user_name_input'] = $user_name_input;
		$list['order_state'] = $order_state;

		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/integral_goods/order_list',$param);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();
		$this->load->view('admin/integral/exchange_order_list',$list);
	}
	/*
	 * 订单详情
	 * */
	public function order_detail(){
		$id = $_GET["order_id"];
		$order_info = $this->Exchange_record_model->get_by_id($id);
		//收货地址
		$address_info = $this->address_service->get_address_info($order_info['address_id']);
		$goods_info = $this->Integral_goods_model->get_by_id($order_info['goods_id']);
		$goods_info['goods_url'] = BASE_SITE_URL.'/'.$goods_info['goods_url'];
		$result = array(
			'order_info' => $order_info,
			'address_info' => $address_info,
			'user_info' => $address_info,
			'goods_info' => $goods_info,
		);
		$this->load->view('admin/integral/exchange_order_info',$result);
	}
/*
 * 发货
 * */
	public function order_ship(){
		$id = $_GET["order_id"];
		$order_info = $this->Exchange_record_model->get_by_id($id,"id,user_id,user_name,order_num,logistical_status,logistical_num");
//		if($order_info['logistical_status']>1){
//			//物品已发货
//			return;
//		}
		$result = array(
			'order_info' => $order_info,
		);

		$this->load->view('admin/integral/exchange_order_ship',$result);
	}

	public function ship(){
		$id = $this->input->post('id');
		$order = $this->Exchange_record_model->get_by_id($id);
		if(empty($order)){
			output_error(-2,'订单不存在');
		}

		$config = array(
			array(
				'field'=>'shippingcode',
				'label'=>'shippingcode',
				'rules'=>'trim|required',
			),
			array(
				'field'=>'shippingcomp',
				'label'=>'shippingdesc',
				'rules'=>'trim|required',
			),

		);

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() === TRUE){
			$oid = $this->Exchange_record_model->update_by_id($id,array(
				'express_comp'=>$this->input->post('shippingcomp'),
				'logistical_num'=>$this->input->post('shippingcode'),
				'logistical_status' => 2,
 				));
			if($oid){
				output_data($oid);
			}else{
				output_error(-2,'未知错误');
			}
		}else{
			output_error(-1,'数据格式出错');
		}
	}


}
