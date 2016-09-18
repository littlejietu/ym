<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon extends MY_Admin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Coupon_model');
    }
    
	public function index()
	{
		$where =array(
			"status <"=>2
		);

		$page     = _get_page();
		$pagesize = 10;
		$pagecfg = array();
		$couponList = $this->Coupon_model->fetch_page($page, $pagesize, $where,'*');
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/coupon');
		$pagecfg['total_rows']   = $couponList['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;

		$this->pagination->initialize($pagecfg);
		$couponList['pages'] = $this->pagination->create_links();
//		$result = array(
//			'coupon_list' => ,
//		);


//
		$this->load->view('admin/coupon/coupon_list',$couponList);
	}

	public function add()
	{
		$this->load->view('admin/coupon/coupon_add',null);
	}

	public function addCou(){
		if ($this->input->post())
		{
			$config = array(
				array(
					'field'   => 'couponyName',
					'label'   => '优惠券名字',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'couponValue',
					'label'   => '优惠额度',
					'rules'   => 'greater_than[0]|numeric'
				),
				array(
					'field'   => 'effectTime',
					'label'   => '有效时间',
					'rules'   => 'greater_than[0]|numeric'
				),
				array(
					'field'   => 'totalNum',
					'label'   => '优惠券数量',
					'rules'   => 'greater_than[0]|numeric'
				),
				array(
					'field'   => 'desc',
					'label'   => '优惠券描述',
					'rules'   => 'trim|required'
				),
			);

			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE )
			{

				$id = $this->input->post('id');


				$effect = intval($this->input->post('effectTime'));
				if($effect>0){

				}else{
					$effect = 30;
				}
				$data = array(
					'coupon_name' => $this->input->post('couponyName'),
					'price' => $this->input->post('couponValue'),
					'effective_time' => $effect,
					'add_time' => time(),
					'coupon_count' =>  $this->input->post('totalNum'),
					'condition' => $this->input->post('conditionNum'),
					'desc' => $this->input->post('desc'),
					'status' => 0,
					'coupon_type'=>1,
					'use_type' =>1,
					'img_url' =>""

				);
				if(!empty($id)){
					$result = $this->Coupon_model->update_by_id($id,$data);
				}else{
				$result = $this->Coupon_model->insert_string($data);
				}
				if ($result) {
					output_data($result);
				} else {
					output_error(3, '添加失败');
				}
			}else{
				output_error(2,'验证失败');
			}

		}
	}

	public function detail(){
		$id = $this->input->post_get('id');
		$info = $this->Coupon_model->get_by_id($id);
		$result = array(
			'info' => $info,
		);
		$this->load->view('admin/coupon/coupon_add',$result);
	}

	public function delete(){

		$id = $this->input->post_get('id');
		$where['id'] = $id;
		$edit_data = array(
			'status' => 2,
		);
		$result = $this->Coupon_model->update_by_where($where,$edit_data);
		if($result){
			output_data($result);
		}else{
			output_error(-1,"删除失败！");
		}

	}

	



}
