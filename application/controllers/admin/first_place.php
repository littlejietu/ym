<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class First_Place extends MY_Admin_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('First_Place_Model');
    }
	
	public function index()
	{
		$this->lang->load('admin_first');
		$field = $this->input->post_get('field');
		$cKey = $this->input->post_get('txtKey');
		$search_name = $this->input->get('search_name');
		
		
		
		
		if(isset($_GET['page']))
		{
		    $page     = $_GET['page'];
		}
		else 
		{
		    $page = 1;
		}
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array();		
		
		if (!empty($search_name))
		{
		    $arrParam['search_name'] = $search_name;
		    $arrWhere['name like'] = "'%$search_name%'";		
		}
		
		if($cKey)
		{
		    $arrParam['key'] = $cKey;
		    if($field=='userid')
		        $arrWhere[$field] = $cKey;
		    else
		        $arrWhere[$field.' like '] = "'%$cKey%'";
		}
		$arrParam['field'] = $field;
		
		
		
		
		
		$list = $this->First_Place_Model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->db->last_query();die;
		
		
		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/first_place', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();
		    
		$result = array(
			'output'=>array(
			    'ap_list' =>$list,
			    'name'=>'',
				'html_title'=>lang('login_index_title_02'),
				'map_nav' => array(),
				'admin_info' => array('name'=>''),
				'top_nav' => '',
				'left_nav'=>'',
			    'page'=>$pagecfg,
			    'search_title'=> '',
			    'search_ac_id' =>'',
				),
		    'list' => $list,
		    'arrParam' => $arrParam,
			);
		$this->load->view('admin/first_place',$result);
	}
	
	public function add()
	{
	    $this->lang->load('admin_first');
	    
	    $id	= $this->input->get('id');
	    $result = array();
	    
	    
	    
	    $result = array(
	        'output'=>array(
	            'ap_name'=>'',
	            'html_title'=>lang('login_index_title_02'),
	            'map_nav' => array(),
	            'admin_info' => array('name'=>''),
	            'top_nav' => '',
	            'left_nav'=>'',
	            'page'=>'',
	        ),
	        'list_url' => $_SERVER['HTTP_REFERER'],
	    );
	    if(!empty($id))
	    {
	        $info = $this->First_Place_Model->get_by_id($id);
	        $result['info'] = $info;
	    }

	    
	    $this->load->view('admin/first_place_add',$result);
	}
	
	public function save()
	{
	    if ($this->input->is_post())
	    {
	        $config = array(
	            array(
	                'field'   => 'name',
	                'label'   => '名称',
	                'rules'   => 'trim|required'
	            ),
	         );
	        $this->form_validation->set_rules($config);
	        if ($this->form_validation->run() === TRUE)
	        {
	            $data = array(
	                'name'=>$this->input->post('name'),
	                'memo'=>$this->input->post('memo'),
	            );
	            $id	= $this->input->post('id');
	            if($id)
	                $data['id'] = $id;
	            $this->First_Place_Model->insert($data);
	            
	            showMessage('新增成功',$_POST['list_url']);
// 	            redirect(ADMIN_SITE_URL.'/first_place');
// 	            exit;
	        }
	        else
	        {
	            showDialog('新增失败');
	            //redirect(ADMIN_SITE_URL.'/first_place');
	        }
	    }
	}
	
	function del(){
	    if ($this->input->is_post())
	    {
	        $id = $this->input->post('del_id');
	    }
	    else
	    {
	        $id	= $this->input->get('id');
	    }
	    $page = _get_page();
	    $result = $this->First_Place_Model->delete_by_id($id);
	    if ($result)
	    {
	        showMessage('删除成功',$_SERVER['HTTP_REFERER']);
	    }
	    else 
	    {
	        showDialog('删除失败',$_SERVER['HTTP_REFERER']);
	    }
	    //redirect( ADMIN_SITE_URL.'/first_place' );
	
	}
}
