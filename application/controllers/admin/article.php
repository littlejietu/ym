<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends MY_Admin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Article_model');
        $this->load->model('Article_Class_model');
    }
    
	public function index()
	{
	    $this->lang->load('admin_layout');
	    $this->lang->load('admin_article');
	    
	    $page     = _get_page();
	    $pagesize = 10;
	    $arrParam = array();
	    $where['status <>'] = -1;
	    $arrParam['orderby'] = 'updatetime DESC';
	    $list = $this->Article_model->fetch_page($page, $pagesize, $where,'*',$arrParam['orderby']);
	    
	    //分页
	    $pagecfg = array();
	    $pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/article', $arrParam);
	    $pagecfg['total_rows']   = $list['count'];
	    $pagecfg['cur_page'] = $page;
	    $pagecfg['per_page'] = $pagesize;
	    
	    $this->pagination->initialize($pagecfg);
	    $list['pages'] = $this->pagination->create_links();
	    
	    $class_list = $this->Article_Class_model->get_class_list($where);
	    
	    $result = array(
	        'list' =>$list['rows'],
	        'class_list' => $class_list,
	        'pages' => $list['pages'],
	    );
	    $this->load->view('admin/article',$result);
	}
		
	
	public function add()
	{
	    $this->lang->load('admin_layout');
	    $this->lang->load('admin_article');
	    
	    $where['status <>'] = -1;
	    
	    $class_list = $this->Article_Class_model->get_class_list($where);
	    $child_list = $this->Article_Class_model->get_child_list($where);
	    
	    $info = array();
	    if ($this->input->get('id'))
	    {
	        $info = $this->Article_model->get_by_id($this->input->get('id'));
	    }
	    $result = array(
	        'class_list' => $class_list,
	        'child_list' => $child_list,
	        'info' => $info,
	    );
	    $this->load->view('admin/article_add',$result);
	}
	
	public function save()
	{		
	    if ($this->input->is_post())
	    {
	        $config = array(
	            array(
	                'field'   => 'article_title',
	                'label'   => '文章名称',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'ac_id',
	                'label'   => '文章所属分类id',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'article_show',
	                'label'   => '文章状态',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'article_sort',
	                'label'   => '文章排序',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'article_content',
	                'label'   => '文章内容',
	                'rules'   => 'trim'
	            ),
	        );
	        
	        $this->form_validation->set_rules($config);
	        if ($this->form_validation->run() === TRUE)
	        {
	            //生成数据
	            $data = array(
	                'title' => $this->input->post('article_title'),
	                'status' => $this->input->post('article_show'),
	                'content' => $this->input->post('article_content'),
	                'sort' => $this->input->post('article_sort'),
	                'updatetime' => time(),
	                
	            );
	            $where['status <>'] = -1;
	            $class_list = $this->Article_Class_model->get_class_list($where);
	            $id = $this->input->post('ac_id');
	            if ($class_list[$id]['parent_id'] == 0)
	            {
	                $data['class_id'] = $id;
	                $data['class_id_1'] = null;
	            }
	            else 
	            {
	                $data['class_id_1'] = $id;
	                $data['class_id'] = $class_list[$id]['parent_id'];
	            }
	            if ($this->input->post('pic'))
	            {
	                $data['pic'] = $this->input->post('pic');
	            }
	            else 
	            {
	                $data['pic'] = $this->input->post('orig_pic');
	            }
	            
	            //判断修改还是新增
	            if ($this->input->post('id'))
	            {
	                $this->Article_model->update_by_id($this->input->post('id'),$data);
	            }
	            else 
	            {
	                $data['addtime'] = time();
	                $this->Article_model->insert($data);
	            }
	            
	            redirect(ADMIN_SITE_URL.'/article');
	        }
	    }
	}
	
	
	function del()
	{
	    if ($this->input->post('del_id'))
	    {
	        $ids = $this->input->post('del_id');
	        $data['status'] = -1;
	        foreach ($ids as $key => $value)
	        {
	            $this->Article_model->update_by_id($value,$data);
	        }
	        redirect(ADMIN_SITE_URL.'/article');
	    }
	    else
	    {
	        echo '<a href="'.ADMIN_SITE_URL.'/article">删除失败，点击返回';
	    }
	    
	}
}
?>