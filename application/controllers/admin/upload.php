<?php
/**
 * 设置下的上传设置
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends MY_Admin_Controller {
	
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Wordbook_model');
    }
    /**
     * 上传参数
     */
	public function index()
	{
		$this->lang->load('admin_layout');
		$this->lang->load('admin_setting');
		
		$list = $this->Wordbook_model->getList();
		$result = array(
		    'list'=>$list,
		);
		$this->load->view('admin/upload',$result);
	}
	
	/**
	 * 默认图片
	 */
	public function default_thumb()
	{
	    $this->lang->load('admin_layout');
	    $this->lang->load('admin_setting');
	    
	    $list = $this->Wordbook_model->getList();
	    $result = array(
	        'list'=>$list,
	    );
	    
	    $this->load->view('admin/upload_default_thumb',$result);
	}
	
	/**
	 * 保存上传设置
	 */
	public function save_index()
	{
	    if ($this->input->is_post())
	    {
	        $config = array(
	            array(
	                'field'   => 'image_max_filesize',
	                'label'   => '上传文件大小限制',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'image_dir_type',
	                'label'   => '图片存储方式',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'image_allow_ext',
	                'label'   => '允许上传的图片类型',
	                'rules'   => 'trim|required'
	            ),
	        );
	    }
	    
	    $this->form_validation->set_rules($config);
	    if ($this->form_validation->run() === TRUE)
	    {
	        $data = array(
	            'image_max_filesize'=>$this->input->post('image_max_filesize'),
	            'image_dir_type'=>$this->input->post('image_dir_type'),
	            'image_allow_ext'=>$this->input->post('image_allow_ext'),
	        );
	        
	        $this->Wordbook_model->updateSetting($data);
	        
	        redirect(ADMIN_SITE_URL.'/upload');
	    }
	}
	
	/**
	 * 保存图片上传设置
	 */
	public function save_thumb()
	{
	    if ($this->input->is_post())
	    {
	        $config = array(
	            array(
	                'field'   => 'goods_image',
	                'label'   => '默认商品图片',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'store_logo',
	                'label'   => '默认店铺标志',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'store_avatar',
	                'label'   => '默认店铺头像',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'user_portrait',
	                'label'   => '默认会员头像',
	                'rules'   => 'trim|required'
	            ),
	        );
	    }
	     
	    $this->form_validation->set_rules($config);
	    var_dump($this->form_validation->run());
	    if ($this->form_validation->run() === TRUE)
	    {
	        $data = array(
	            'goods_image'=>$this->input->post('goods_image'),
	            'store_logo'=>$this->input->post('store_logo'),
	            'store_avatar'=>$this->input->post('store_avatar'),
	            'user_portrait'=>$this->input->post('user_portrait'),
	        );
	         
	        $this->Wordbook_model->updateSetting($data);
	         
	        redirect(ADMIN_SITE_URL.'/upload');
	    }
	}
}
