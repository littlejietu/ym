<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_Class extends MY_Admin_Controller {
	
    public function __construct()
	{
	    parent::__construct();
	    $this->load->model('Article_Class_model');
	}
	
	public function index()
	{
		$this->lang->load('admin_layout');
		$this->lang->load('admin_article_class');
        $where['status <>'] = -1;
        $p = $this->Article_Class_model->get_list($where,'parent_id');
        $where['parent_id'] = 0;
        $list = $this->Article_Class_model->get_list($where);
        
        $parent_id = array();
        foreach ($p as $key=>$value)
        {
            array_push($parent_id,$value['parent_id']);
        }
        foreach ($list as $key => $value)
        {
            if (in_array($value['id'],$parent_id))
            {
                $list[$key]['have_child'] = 1;
            }
            else
            {
                $list[$key]['have_child'] = 0;
            }
        }
        $result = array(
            'list' => $list,
        );
		$this->load->view('admin/article_class',$result);
	}
	
	public function add()
	{
	    $this->lang->load('admin_layout');
	    $this->lang->load('admin_article_class');
	    $parent_id = $this->input->get('parent_id');
	    $where['parent_id'] = 0 ;
	    $where['status <>'] = -1;
	    
	    $parent_list = $this->Article_Class_model->get_list($where);
	    $result = array(
	        'parent_id' => $parent_id,
	        'parent_list' => $parent_list,
	    );
	    $this->load->view('admin/article_class_add',$result);
	}
	
	public function edit()
	{
	    $this->lang->load('admin_layout');
	    $this->lang->load('admin_article_class');
	    if ($this->input->post())
	    {
	        $config = array(
	            array(
	                'field'   => 'ac_id',
	                'label'   => '分类id',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'ac_name',
	                'label'   => '分类名称',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'ac_sort',
	                'label'   => '分类排序',
	                'rules'   => 'trim|required'
	            ),
	        );
	        
	        $this->form_validation->set_rules($config);
	        if ($this->form_validation->run() === TRUE)
	        {
	            $id = $this->input->post('ac_id');
	            $data['name'] = $this->input->post('ac_name');
	            $data['sort'] = $this->input->post('ac_sort');
	        }
	        if ($this->Article_Class_model->update_by_id($id,$data))
	        {
	            redirect(ADMIN_SITE_URL.'/article_class');
	        }
	        var_dump($data);exit;
	    }
	    
	    if ($this->input->get('id'))
	    {
	        $id = $this->input->get('id');
	        $info = $this->Article_Class_model->get_by_id($id);
	        $result =array(
	            'info' => $info
	        );
	    }
	    
	    $this->load->view('admin/article_class_edit',$result);
	}

	public  function del()
	{
	    if ($this->input->get('id'))
	    {
	        $id = $this->input->get('id');
	        $data['status'] = -1;
	        $this->Article_Class_model->update_by_id($id,$data);
	    }
	    if ($this->input->post())
	    {
	        $ids = $this->input->post('check_ac_id');
	        $data['status'] = -1;
	        foreach ($ids as $key => $value)
	        {
	            $this->Article_Class_model->update_by_id($value,$data);
	        }
	    }
	    redirect(ADMIN_SITE_URL.'/article_class');
	}
	
	public function save()
	{
	    if ($this->input->post())
	    {
	        $config = array(
	            array(
	                'field'   => 'ac_name',
	                'label'   => '分类名称',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'ac_sort',
	                'label'   => '分类排序',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'ac_parent_id',
	                'label'   => '父类类id',
	                'rules'   => 'trim|required'
	            ),
	        );
	        
	        $this->form_validation->set_rules($config);
	        if ($this->form_validation->run() === TRUE)
	        {
	            $data = array(
	                'name' => $this->input->post('ac_name'),
	                'parent_id' => $this->input->post('ac_parent_id'),
	                'sort' => $this->input->post('ac_sort'),
	                'status' => 1,
	            );
	            if ($this->Article_Class_model->insert($data))
	            {
	                redirect(ADMIN_SITE_URL.'/article_class');
	            }
	        }
	    }
	    var_dump($_POST);exit;
	}
	
	public function ajax()
	{
	    //编辑时判断是否重复
	    if ($this->input->get('branch'))
	    {
	        $branch = $this->input->get('branch');
	        if ($branch == 'check_class_name')
	        {
	            $where['name'] = $this->input->get('ac_name');
	            $where['parent_id'] = $this->input->get('ac_parent_id');
	            $where['status <>'] = -1;
	            
	            $id = $this->input->get('ac_id');
	            $orig_name = $this->Article_Class_model->get_by_id($id);
	            
	            if ($orig_name['name'] == $where['name'])
	            {
	                exit('true');
	            }
	            if ($this->Article_Class_model->get_list($where))
	            {
	                exit('false');
	            }
	            else
	            {
	                exit('true');
	            }
	        }
	    }
	    
	    //获得所选分类的子分类列表
	    $id = $this->input->get('id');
	    $where['parent_id'] = $id;
	    $where['status <>'] = -1;
	    $list = $this->Article_Class_model->get_list($where);
	    $string = '[';
	    foreach ($list as $key => $value)
	    {
	        $string .= '{"ac_id":"'.$value['id'].'","ac_code":null,"ac_name":"'.$value['name'].'","ac_parent_id":"'.$value['parent_id'].'","ac_sort":"'.$value['sort'].'","deep":2}';
	        if (isset($list[$key+1]))
	        {
	            $string .= ',';
	        }
	    }
	    $string .= ']';
	    echo $string;exit;
	}
}
