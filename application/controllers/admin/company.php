<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 权限管理
 */

class Company extends MY_Admin_Controller {

    public function __construct()
    {
        
        parent::__construct();
        $this->load->model('Admin_model');
    }
    
    //权限管理首页
    public function index() {
        
        $this->lang->load('admin_layout');
        $this->lang->load('admin_admin');
        $this->load->model('Admin_role_model');
        $page     = _get_page();
        $pagesize = 5;
        $arrParam = array();
        $arrWhere = array();
        $arrWhere['status <>'] = -1;
        $list = $this->Admin_model->fetch_page($page, $pagesize, $arrWhere,'*');

        foreach($list['rows'] as $k => $v){

           $orleName = $this->Admin_role_model->get_by_id($v['role_id'],'role_name');

            $list['rows'][$k]['role_name'] = $orleName['role_name'];
        }

        //分页
        $pagecfg = array();
        $pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/admin', $arrParam);
        $pagecfg['total_rows']   = $list['count'];
        $pagecfg['cur_page'] = $page;
        $pagecfg['per_page'] = $pagesize;
        
        $this->pagination->initialize($pagecfg);
        $list['pages'] = $this->pagination->create_links();
        
        $result = array(
            'list' =>$list,
        );

        $this->load->view('admin/admin',$result);
    }
    
    //新增管理员
    public function admin_add()
    {
        $this->lang->load('admin_layout');
        $this->lang->load('admin_admin');
        
        $this->load->model('Admin_role_model');
        $role_list = $this->Admin_role_model->get_list();
        
        $result = array(
            'role' => $role_list,
        );
        
        $this->load->view('admin/admin_add',$result);
    }
    
    //编辑已存在的管理员
    public function admin_edit()
    {
        $this->lang->load('admin_layout');
        $this->lang->load('admin_admin');
        //如果有post数据则判断之后修改表
        if ($this->input->post())
        {
            
            $config = array(
                array(
                    'field'   => 'user_id',
                    'label'   => '管理员id',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'role_id',
                    'label'   => '所属分组的id',
                    'rules'   => 'trim|required'
                ),
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() === TRUE)
            {
                $new_pwd = $this->input->post('new_pw');
                if (!empty($new_pwd))
                {
                    $new_pwd2 = $this->input->post('new_pw2');

                    if ($new_pwd == $new_pwd2)
                    {

                        $data['password'] = md5(trim($new_pwd));
                    }
                }
                $id = $this->input->post('user_id');
                $data['role_id'] = $this->input->post('role_id');
                
                if($this->Admin_model->update_by_id($id,$data))
                {
                    redirect(ADMIN_SITE_URL.'/admin');
                }
            }
            
        }
        
        //如果只有get数据则进入管理员编辑页面
        if ($this->input->get('id'))
        {
            $id = $this->input->get('id');
            $info = $this->Admin_model->get_by_id($id);
        }
        $this->load->model('Admin_role_model');
        $role_list = $this->Admin_role_model->get_list();
        
        $result = array(
            'info' => $info,
            'role' => $role_list,
        );
        $this->load->view('admin/admin_edit',$result);
    }
    
  
    
    //管理员删除操作
    public function del()
    {
        if ($this->input->is_post())
        {
            $id = $this->input->post('del_id');
        }
        else
        {
            $id	= $this->input->get('id');
        }
        
        $data['status'] = -1;
        $where['id'] = $id;
        $this->Admin_model->delete_by_id($id);
        redirect( ADMIN_SITE_URL.'/admin' );
    }
    
   

   
    
    
    
}
