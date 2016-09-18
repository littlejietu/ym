<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends MY_Admin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Document_model');
    }
    
    public function index()
    {
        $this->lang->load('admin_document');
        $this->lang->load('admin_layout');
        
        $list = $this->Document_model->get_list();
        //$pagesize = 10;
        $result = array(
            'list'=>$list,
        );
        $this->load->view('/admin/document',$result);
    }
    
    public function add()
    {
        $this->lang->load('admin_document');
        $this->lang->load('admin_layout');
        
        $id = $this->input->get('id');
        $result =array(1=>'sadqw');
        $info = array();
        if ($id)
        {
            $info = $this->Document_model->get_by_id($id);
            $result['info'] = $info;
        }
        $this->load->view('/admin/document_add',$result);
    }
    
    public function save()
    {
        if ($this->input->is_post())
        {
            $config = array(
                array(
                    'field'   => 'title',
                    'label'   => '协议名称',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'code',
                    'label'   => '模板名称',
                    'rules'   => 'trim'
                ),
                // array(
                //     'field'   => 'message_content',
                //     'label'   => '协议内容',
                //     'rules'   => 'trim|required'
                // ),
            );
            
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() === TRUE)
            {
                $data = array();
                $id = $this->input->post('id');
                if (empty($id))
                {
                    $data['addtime'] = time();
                }
                $data['title'] = $this->input->post('title');
                $data['code'] = $this->input->post('code');
                $data['content'] = $this->input->post('message_content');
                
                if (empty($id)){
                    $this->Document_model->insert($data);
                    redirect(ADMIN_SITE_URL.'/document');
                }
                else
                {
                    $this->Document_model->update_by_id($id,$data);
                    redirect(ADMIN_SITE_URL.'/document');
                }
            }
            else
            {
                //如果验证没通过
                //echo '内容必填';
                redirect(ADMIN_SITE_URL.'/document');
            }
        }
    }
}
