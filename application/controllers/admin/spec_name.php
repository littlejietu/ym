<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spec_name extends MY_Admin_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Spec_name_model');
        $this->lang->load('admin_layout');
    }
    
	public function index() {

		$page     = _get_page();//翻页  接收前台的页码
		$pagesize = 100;
		$arrParam = array();
		$arrWhere = array();

		$this->load->model('Spec_val_model');
		
		$arrWhere['status <>'] = -1;
		$dbprefix = $this->Spec_name_model->prefix();
		$tb = $dbprefix.'prd_spec_name a inner join '.$dbprefix.'prd_wordbook b on(a.name_id=b.id)';
		$list = $this->Spec_name_model->fetch_page($page, $pagesize, $arrWhere,'*','name_id',$tb);
		foreach ($list['rows'] as $k => $a) {
			$valList = $this->Spec_val_model->get_list(array('name_id'=>$a['name_id'],'status'=>1),'val','sort');
			$vals = '';
			foreach ($valList as $kk => $aa) {
				$vals = $vals.','.$aa['val'];
			}
			$a['vals'] = trim($vals,',');
			$list['rows'][$k] = $a;
		}
		//echo $this->Shop_model->db->last_query();
		//die;
		
		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/Shop', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();
		
		$result = array(
		    'list' => $list,
		    'arrParam' => $arrParam,
			);

	$this->load->view('admin/spec_name',$result);

	}

	public function add()
	{
		//$this->lang->load('admin_layout');
		$this->load->model('Spec_val_model');
		$this->load->model('Word_model');

	    //需要修改
	    $id	= $this->input->get('id');
	    $result = array();
	    $info = array();
	   
	    if(!empty($id)) {
	        $info = $this->Spec_name_model->get_by_id($id);
	        $valList = $this->Spec_val_model->get_list(array('name_id'=>$id,'status'=>1),'val','sort');
	        $info['name'] = $this->Word_model->getName($id);
			$vals = '';
			foreach ($valList as $kk => $aa) {
				$vals = $vals.','.$aa['val'];
			}
			$info['vals'] = trim($vals,',');
	    }
	    $result = array(
	        'info'=>$info,
	    );

	    $this->load->view('admin/spec_name_add', $result);
	}
	
	public function save() {
		$this->load->model('Spec_val_model');
		$this->load->model('Word_model');
		$this->load->model('Goods_spec_attr_val_model');
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$vals = $this->input->post('vals');
		$type = $this->input->post('type');
		$status = $this->input->post('status');

	    if ($this->input->is_post()) {
	        //验证规则
	        $config = array(
	            array(
	                'field'   => 'name',//后台验证，表中的字段名
	                'label'   => '规格名',
	                'rules'   => 'trim|required'//验证规划
	            ),
	            array(
	                'field'   => 'vals',
	                'label'   => '规格值',
	                'rules'   => 'trim|required'
	            )
	        );
	        $this->form_validation->set_rules($config);
	        if ($this->form_validation->run() === TRUE) {
	        	/*if($status==2){
	        		$bResult = $this->Goods_tpl_spec_attr_val_model->inNotUseByNameId($id);
	        		if(!$bResult){
	        			showDialog('关闭失败,该规格正在使用中，不能关闭', ADMIN_SITE_URL.'/spec_name' );
	        		}
	        	}*/

				$this->Spec_name_model->save($id, $name, $type, $vals, $status);
	            redirect(ADMIN_SITE_URL.'/spec_name');
	            exit;
	        } else {
				//echo base_url('/admin/shop1');die;
	            redirect(ADMIN_SITE_URL.'/spec_name/add');
	        }
	    }
	}

}
?>