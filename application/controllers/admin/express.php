<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Express extends MY_Admin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Express_model');
    }
    
	public function index()
	{
		$this->lang->load('admin_layout');
		$this->lang->load('admin_express');//无法加载语言包就去掉着一句
		
		$page     = _get_page();
		$pagesize = 2;
		$arrParam = array();
		$arrWhere = array();		
		if ($this->input->get('letter'))
		{
			$arrWhere['initial'] = "'".$this->input->get('letter')."'";
		}
		$list = $this->Express_model->fetch_page($page, $pagesize, $arrWhere,'*');
		//echo $this->db->last_query();die;
		
		
		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/express?letter='.$this->input->get('letter'), $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;

		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();


		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();
		$result = array(
			'list' => $list['rows'],
			'pages' => $list['pages'],

			);



		$this->load->view('admin/express',$result);
	}
	

	
	
	public function add()
	{
		$this->lang->load('admin_express');

		//输出添加时间然后结束
		//echo time();die;//
		//var_dump($id);
	    //$this->lang->load('admin_Express');//语言包
	    
	    //需要修改
	    $id	= $this->input->get('id');
	    $result = array();
	    $info = array();
		
		
		
	    $this->load->model('Express_Model');
	    $arrPlace = $this->Express_Model->get_list();
	
	    if(!empty($id))
	    {
	        $info = $this->Express_model->get_by_id($id);
	        $place = $this->Express_Model->get_by_id($info['id'],'title');
	        $info['title'] = $place['title'];
	    }
	
	    $result = array(
	        'info'=>$info,
	        'arrPlace'=>$arrPlace,
	    );
	//var_dump($info);die;
	    $this->load->view('admin/express_add', $result);
	}
	
	public function save()
	{		
	
		//var_dump();die;
			//echo time();die;//
	    //$this->lang->load('admin_Express');
		
		
		//输出所有post提交的表单内元素
	var_dump($_POST);
	    if ($this->input->is_post())
	    {
	        //验证规则
	        $config = array(
	            array(
	                'field'   => 'name',//后台验证，表中的字段名
	                'label'   => '名称',
	                'rules'   => 'trim|required'//验证规划
	            ),
	            array(
	                'field'   => 'code',//后台验证，表中的字段名
	                'label'   => '调用代码',
	                'rules'   => 'trim|required'//验证规划
	            ),
	            array(
	                'field'   => 'initial',//后台验证，表中的字段名
	                'label'   => '首字母',
	                'rules'   => 'trim|required'//验证规划
	            ),
	            array(
	                'field'   => 'url',
	                'label'   => '网址',
	                'rules'   => 'trim|required'
	            )
	            
	        );
	   // echo time();
	  // print_r();
	        $this->form_validation->set_rules($config);
	        if ($this->form_validation->run() === TRUE)
	        {
	            $id = (int)$this->input->post('id');
				echo $id;
	            $adcode = '';
	            $this->load->model('Express_model');
	            //$oPlace = $this->Link_Place_model->get_by_id($id);
	            
	            //将需要保存的数据赋值给数组$data
	            $data = array(
	                'name'=>$this->input->post('name'),
            		'code'=>$this->input->post('code'),
            		'initial'=>$this->input->post('initial'),
	                'url'=>$this->input->post('url'),
	                'use_status'=>$this->input->post('use_status'),
	                'delivery_status'=>$this->input->post('delivery_status'),
	                'status'=>$this->input->post('status'),
	            );
	    
	            $id	= $this->input->post('id');
	            if($id)
	                $data['id'] = $id;
					
					
					
	            //保存至数据库
	            $this->Express_model->insert($data);
				
			
	            //echo '成功,<a href="/admin/aa">返回列表页</a>';
				
				//echo base_url('/admin/express');die;
	            redirect(ADMIN_SITE_URL.'/express');
	            exit;
	        }
	        else
	        {//echo base_url('/admin/link1');die;
	            redirect(ADMIN_SITE_URL.'/express/add');
	        }
	        	
	    }
	}


	public function ajax()
	{
		$branch = $this->input->get('branch');
		$column = $this->input->get('column');
		$value = $this->input->get('value');
		$id = $this->input->get('id');

		$arr = array('status','use_status','delivery_status');
		if(in_array($branch, $arr))
		{
			if($branch == 'use_status')
				$value = $value == 0? 2:1;

			$this->Express_model->update_by_id($id, array($column=>trim($value)));

			//todo
			//dkcache('express');
			//$this->log(L('nc_edit,express_name,express_state').'[ID:'.intval($id).']',1);
			echo 'true';exit;
		}

	}
	
	

}
?>