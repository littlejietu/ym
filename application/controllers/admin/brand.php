<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends MY_Admin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Brand_model');
    }
    
	public function index()
	{
		$this->lang->load('admin_layout');
		$this->lang->load('admin_brand');
		$this->load->model('Category_model');
		$cKey = $this->input->post_get('txtKey');//搜索
		$search_brand_class = $this->input->post_get('search_brand_class');

		$page     = _get_page();//接收前台的页码
		
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array();
		
		if($cKey)
		{
		   	$arrParam['txtKey'] = $cKey; //翻页搜索
		   	$arrWhere['name like '] = "'%$cKey%'"; //搜索
		}
				
		if($search_brand_class)
		{
		   	$arrParam['search_brand_class'] = $search_brand_class; //翻页搜索
		   	$arrWhere['category_id like '] = "'%$search_brand_class%'"; //搜索
		}
        //只是删除视图里的显示，相当于隐藏数据，不是物理删除
		else 
		{
		    $arrParam['orderby'] = '';
		}
		$arrWhere['status <>'] = -1;
		
		$list = $this->Brand_model->fetch_page($page, $pagesize, $arrWhere,'*');

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/Brand', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		foreach($list['rows'] as $k => $v){

			$categoryInfo = $this->Category_model->get_by_id($v['category_id']);
			$list['rows'][$k]['category_name'] = $categoryInfo['name'];
		}

		$result = array(
			'pages' => $list['pages'],
		    'list' => $list['rows'],
		    'arrParam' => $arrParam,
		    //'ad_placeList'=>$ad_placeList,
			);
		$this->load->view('admin/brand',$result);
	}

	public function add() {
		$this->lang->load('admin_layout');
		$this->lang->load('admin_brand');
		$this->load->model('Category_model');

	    //需要修改
	    $id	= $this->input->get('id');
	    $result = array();
	    $info = array();

	    if(!empty($id))
	    {
	        $info = $this->Brand_model->get_by_id($id);

			if(!empty($info['category_id'])) {
				$cacheInfo = $this->Category_model->get_by_id($info['category_id']);
				$info['classone'] = $cacheInfo['id'];
				if(!empty($cacheInfo['parent_id'])){
					$cacheInfos = $this->Category_model->get_by_id($cacheInfo['parent_id']);
					$info['classone'] = $cacheInfos['id'];
					$info['classtwo'] = $cacheInfo['id'];
					if(!empty($cacheInfos['parent_id'])){
						$cacheInfoss = $this->Category_model->get_by_id($cacheInfos['parent_id']);
						$info['classone'] = $cacheInfoss['id'];
						$info['classtwo'] = $cacheInfos['id'];
						$info['classthree'] = $cacheInfo['id'];
					}
				}
			}

	    }

		$cacheList = $this->Category_model->getListByParentId(0);


	    $result = array(
	        'info'			=> $info,
			'cacheList'		=> $cacheList,
	    );

	    $this->load->view('admin/brand_add', $result);
	}
	
	public function save()
	{		

		//输出所有post提交的表单内元素
	    if ($this->input->is_post())
	    {
	        //验证规则
	        $config = array(
	            array(
	                'field'   => 'brand_name',//后台验证，表中的字段名
	                'label'   => '品牌名',
	                'rules'   => 'trim|required'//验证规划
	            ),
	            array(
	                'field'   => 'brand_initial',
	                'label'   => '品牌首字母',
	                'rules'   => 'trim|required'
	            )
	        );

	        $this->form_validation->set_rules($config);
	    	//var_dump($this->form_validation->run());exit;
	        if ($this->form_validation->run() === TRUE)
	        {
				$id = $this->input->post('id');
				$cateone = $this->input->post('cateone');
				$catetwo = $this->input->post('catetwo');
				$catethree = $this->input->post('catethree');
	            $this->load->model('Brand_model');

	            //将需要保存的数据赋值给数组$data
	            $data = array(
	                'name'=>$this->input->post('brand_name'),
	                'initial'=>$this->input->post('brand_initial'),
	                'category_id'=>$this->input->post('brand_category_id'),
	                'parent_id'=>$this->input->post('brand_parent_id'),
	                'logo'=>$this->input->post('img'),
	                'sort'=>$this->input->post('brand_sort'),
	                'status'=>$this->input->post('status'),
	            );

				if(!empty($cateone)) {

				$data['category_id'] = $cateone;
	    		}

				if(!empty($catetwo)) {

					$data['category_id'] = $catetwo;
				}

				if(!empty($catethree)) {

					$data['category_id'] = $catethree;
				}

	            if($id) {
	                $data['id'] = $id;
	                $this->Brand_model->update_by_id($id,$data);
	            } else {
	            	//保存至数据库
	            	$this->Brand_model->insert($data);
	            }

	            redirect(ADMIN_SITE_URL.'/brand');
	            exit;
	        }
	        else {
	            redirect(ADMIN_SITE_URL.'/brand/add');
	        }
	    }
	}
	
	
	function del(){
	    if ($this->input->is_post())
	    {	
	        $id = $this->input->post('del_id');
			//var_dump($id);die;
			foreach($id as $k=>$v){
				
				$page = _get_page();
				$data['status'] = -1;
				// 调用修改状态方法
	    		$this->Brand_model->update_by_id($v,$data);
			}
			
	    }
	    else
	    {
	        $id	= $this->input->get('id');
			$page = _get_page();
			$data['status'] = -1;
		// 调用修改状态方法
	    	$this->Brand_model->update_by_id($id,$data);
			;
	    }
	    
	    redirect( ADMIN_SITE_URL.'/Brand' );
		
	
	}

	/**
	 * ajax操作
	 */
	public function ajax(){
		$name = $this->input->get('brand_name');
		$id = $this->input->get('id');
		
		switch ($_GET['branch']){
			/**
			 * 品牌名称
			 */
			case 'brand_name':
				/**
				 * 判断是否有重复
				 */
				// $condition['brand_name'] = trim($_GET['value']);
				// $condition['brand_id'] = array('neq', intval($_GET['id']));
				// $result = $model_brand->getBrandList($condition);
				// if (empty($result)){
				// 	$model_brand->editBrand(array('brand_id' => intval($_GET['id'])), array('brand_name' => trim($_GET['value'])));
				// 	$this->log(L('nc_edit,brand_index_name').'['.$_GET['value'].']',1);
				// 	echo 'true';exit;
				// }else {
				// 	echo 'false';exit;
				// }
				break;
			/**
			 * 品牌类别，品牌排序，推荐
			 */
			case 'brand_class':
			case 'brand_sort':
			case 'brand_recommend':
				// $model_brand->editBrand(array('brand_id' => intval($_GET['id'])), array($_GET['column'] => trim($_GET['value'])));
				// $detail_log = str_replace(array('brand_class','brand_sort','brand_recommend'),array(L('brand_index_class'),L('nc_sort'),L('nc_recommend')),$_GET['branch']);
				// $this->log(L('nc_edit,brand_index_brand').$detail_log.'[ID:'.intval($_GET['id']).']',1);
				// echo 'true';exit;
				break;
			/**
			 * 验证品牌名称是否有重复
			 */
			case 'check_brand_name':
				$arrWhere = array('name'=>trim($name),'id <>'=>$id);
				$result = $this->Brand_model->get_list($arrWhere);
				if (empty($result)){
					echo 'true';exit;
				}else {
					echo 'false';exit;
				}
				break;
		}
	}

	/**根据父级ID获取信息*/
	public function get_category(){
		$this->load->model('Category_model');
		$parent_id = $this->input->post('parent_id');
		$cacheList = $this->Category_model->getListByParentId($parent_id);
		echo json_encode($cacheList);
		exit;
	}
}
?>