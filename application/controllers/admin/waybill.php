<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Waybill extends MY_Admin_Controller {
	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('Waybill_model');
	}
	public function index()
	{
		$this->lang->load('admin_layout');
		
		$page     = _get_page();
		$pagesize = 4;
		$arrParam = array();
		$where['status <>'] = -1;
		$list = $this->Waybill_model->fetch_page($page, $pagesize, $where,'*');
		 
		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/waybill', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		 
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();
		
		$result = array(
		    'list' => $list['rows'],
		    'pages' => $list['pages'],
		);
		$this->load->view('admin/waybill',$result);
	}
	
	public function add()
	{
	    $this->lang->load('admin_layout');
	    
	    $this->load->model('Express_model');
	    $express_list = $this->Express_model->get_list();
	    $id = $this->input->get('id');
	    $info = array();
	    if ($id)
	    {
	        $info = $this->Waybill_model->get_by_id($id);
	    }
	    
	    $result = array(
	        'express_list' =>$express_list,
	        'info' => $info,
	    );
	    $this->load->view('admin/waybill_add',$result);
	}
	
	public function save()
	{
	    if ($this->input->post())
	    {
	        $config = array(
	            array(
	                'field'   => 'waybill_name',
	                'label'   => '运单名称',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'waybill_express',
	                'label'   => '快递公司名称',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'waybill_width',
	                'label'   => '宽度',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'waybill_height',
	                'label'   => '高度',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'waybill_top',
	                'label'   => '上偏移量',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'waybill_left',
	                'label'   => '左偏移量',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'waybill_usable',
	                'label'   => '是否启用',
	                'rules'   => 'trim|required'
	            ),
	        );
	        
	        $this->form_validation->set_rules($config);
	        if ($this->form_validation->run() === TRUE)
	        {
	            $id = $this->input->post('waybill_id');
	            $this->load->model('Express_model');
	            $data = array(
	                'name' => $this->input->post('waybill_name'),
	                'express_id' => $this->input->post('waybill_express'),
	                'width' => $this->input->post('waybill_width'),
	                'height' => $this->input->post('waybill_height'),
	                'wb_top' => $this->input->post('waybill_top'),
	                'wb_left' => $this->input->post('waybill_left'),
	                'status' => $this->input->post('waybill_usable'),
	                'shop_id' => 0,
	            );
	            $express = $this->Express_model->get_by_id($data['express_id']);
	            $data['express_name'] = $express['name'];
	            $pic = $this->input->post('img');
	            if (!empty($pic))
	            {
	                $data['pic'] = $pic;
	            }
	            else 
	            {
	                $data['pic'] = $this->input->post('orig_img');
	            }
	            if ($id)
	            {
	                $this->Waybill_model->update_by_id($id,$data);
	            }
	            else 
	            {
	                $this->Waybill_model->insert($data);
	            }
	            redirect(ADMIN_SITE_URL.'/waybill');
	        }
	    }
	    
	}

	public function del()
	{
	    $id = $this->input->post('waybill_id');
	    $data['status'] = -1;
	    $this->Waybill_model->update_by_id($id,$data);
	    
	    redirect(ADMIN_SITE_URL.'/waybill');
	}
	
	public function test()
	{
	    $this->lang->load('admin_layout');
	    $id = $this->input->get('id');
	    if ($id)
	    {
	        $info = $this->Waybill_model->get_by_id($id);
	        $list = $this->Waybill_model->get_design_data($info['wb_data']);
	    }
	    $result = array(
	        'info' => $info,
	        'list' =>$list,
	    );
	    $this->load->view('admin/waybill_test',$result);
	}
	
	public function design()
	{
	    $this->lang->load('admin_layout');
	    $item = $this->Waybill_model->getWaybillItemList();
	    
	    $id = $this->input->get('id');
	    if ($id)
	    {
	        $info = $this->Waybill_model->get_by_id($id);
	        $list = $this->Waybill_model->get_design_data($info['wb_data']);
	    }
	    else 
	    {
	        redirect(ADMIN_SITE_URL.'/waybill');
	    }
	    $result = array(
	        'info' => $info,
	        'item' => $item,
	        'selected_list' =>$list,
	    );
	    $this->load->view('admin/waybill_design',$result);
	}
	
	public function save_design()
	{
	    $id = $this->input->post('waybill_id');
	    if ($id)
	    {
	        $waybill_data = $this->input->post('waybill_data');
	        $this->Waybill_model->save_design_info($id,$waybill_data);
	        
	        redirect(ADMIN_SITE_URL.'/waybill');
	    }
	    else 
	    {
	        echo '模板不存在';
	    }
	}

}
