<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class First_category extends MY_Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('First_category_model');
        $this->load->model('Spu_model');
    }

    /**分类首页*/
    public function index() {

        $this->lang->load('admin_layout');
        $this->lang->load('admin_prd_category');
        $this->load->model('Category_model');

        $category_id = $this->input->get_post('parent_id');
        $category_status = $this->input->get_post('status');

        $where = array('status<>'=>'-1');

        if(!empty($category_id)){
            $where['id'] = $category_id;
        }
        if(!empty($category_status)){
            $where['status']=$category_status;
        }
        $orderby = 'sort desc';
        $list = $this->First_category_model->get_list($where,'*',$orderby);
        $categorylist = $this->First_category_model->get_list($where,'*',$orderby);
    
        $data = array(
            'list'          => $list,
            'categorylist'  => $categorylist,
            'category_id'   => $category_id,
            'category_status'   => $category_status,
            'output' => array(
                'html_title' => '分类推首管理',
            ),
        );

        $this->load->view('admin/first_category',$data);
    }

    /**修改*/
    public function  add() {

        $this->lang->load('admin_layout');
        $this->lang->load('admin_prd_category');
        $this->lang->load('admin_first');

        $this->load->model('Category_model');

        $id = $this->input->get('id');

        //获取分类列表
        $catalist = $this->Category_model->getListByParentId(0);
        $info = array();
        if ($id)
        {
            $info = $this->First_category_model->get_by_id($id);
        }

        $data = array(
            'catalist' => $catalist,
            'info' => $info,
            'id'   => $id,
            'list_url' => $_SERVER['HTTP_REFERER'],
        );
        $this->load->view('admin/first_category_add',$data);
    }

    public function save() {

        $adv_name       = $this->input->post('adv_name');
        $category_id    = $this->input->post('category_id');
        $icon_touch     = $this->input->post('icon_touch');
        $icon_untouch   = $this->input->post('icon_untouch');
        $sort           = $this->input->post('sort');
        $status         = $this->input->post('status');
        $id             = $this->input->post('id');

        if ($this->input->is_post()) {

                $data = array(
                    'name'           => $adv_name,
                    'icon_touch'     => $icon_touch,
                    'icon_untouch'   => $icon_untouch,
                    'category_id'    => $category_id,
                    'sort'           => $sort,
                    'status'         => $status,
                );

                if (!empty($id)){

                    $data['id'] = $id;
                    $this->First_category_model->insert($data);
                    //redirect(ADMIN_SITE_URL.'/first_category');
                    header("Location:{$_POST['list_url']}");
                } else {

                    $this->First_category_model->insert($data);
                    //redirect(ADMIN_SITE_URL.'/first_category');
                    header("Location:{$_POST['list_url']}");
                }
            }

    }

}