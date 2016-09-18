<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods_Album extends MY_Admin_Controller {
	
    public function __construct()
	{
	    parent::__construct();
	    $this->load->model('Goods_Album_model');
	    $this->load->model('Goods_Album_Pic_model');
	}
	
	public function index()
	{
		$this->lang->load('admin_layout');
		$this->lang->load('admin_goods_album');
		
		$this->load->model('Shop_model');
		$shop = $this->Shop_model->get_list();
		$shop_list = array();
		foreach ($shop as $key=>$value)
		{
		    $shop_list[$value['id']] = $value['name'];
		}
		$page     = _get_page();
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array();
		
		$keyword = $this->input->post('keyword');
		if ($keyword)
		{
		    if (is_numeric($keyword))
		    {
		        $arrWhere['shop_id'] = $keyword;
		    }
		    else 
		    {
		        if (in_array($keyword,$shop_list))
		        {
		            $a = array_flip($shop_list);
		            $arrWhere['shop_id'] = $a[$keyword];
		        }
		        else 
		        {
		            $arrWhere['shop_id'] = -1;
		        }
		        
		    }
		}
		$list = $this->Goods_Album_model->fetch_page($page, $pagesize, $arrWhere,'*');
		
		
		$where = array();
		$pic_count = array();
		$pic_list = $this->Goods_Album_Pic_model->get_list($where,'album_id');
		foreach ($pic_list as $key=>$value)
		{
		    if (!empty($value['album_id']))
		    {
		        $pic_count[] = $value['album_id'];
		    }
		}
		
		$pic_count = array_count_values($pic_count);

		
		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/goods_album', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();
		
		$result = array(
		    'list' => $list['rows'],
		    'pages' => $list['pages'],
		    'pic_count' =>$pic_count,
		    'shop_list' => $shop_list,
		);
		if ($keyword)
		{
		    $result['keyword'] = $keyword;
		}
		$this->load->view('admin/goods_album',$result);
	}
	
	public function pic_list()
	{
	    $this->lang->load('admin_layout');
	    $this->lang->load('admin_goods_album');
	    
	    $this->load->model('Shop_model');
	    $shop = $this->Shop_model->get_list();
	    $shop_list = array();
	    foreach ($shop as $key=>$value)
	    {
	        $shop_list[$value['id']] = $value['name'];
	    }
	    $page     = _get_page();
	    $pagesize = 40;
	    $arrParam = array();
	    $arrWhere = array('shop_id'=>-1);
	    $keyword = $this->input->post('keyword');
	    if ($keyword)
	    {
	        if (is_numeric($keyword))
		    {
		        $arrWhere['shop_id'] = $keyword;
		    }
		    else 
		    {
		        if (in_array($keyword,$shop_list))
		        {
		            $a = array_flip($shop_list);
		            $arrWhere['shop_id'] = $a[$keyword];
		        }
		        
		    }
		}
	    
		if ($this->input->get('album_id'))
		{
		    $arrWhere['album_id'] = $this->input->get('album_id');
		}
	    $list = $this->Goods_Album_Pic_model->fetch_page($page, $pagesize, $arrWhere,'*');
	    
	    $pagecfg = array();
	    $pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/goods_album/pic_list', $arrWhere);
	    $pagecfg['total_rows']   = $list['count'];
	    $pagecfg['cur_page'] = $page;
	    $pagecfg['per_page'] = $pagesize;
	    
	    $this->pagination->initialize($pagecfg);
	    $list['pages'] = $this->pagination->create_links();
	    
	    $result = array(
	        'list' => $list['rows'],
	        'pages' => $list['pages'],
	    );
	    if ($keyword)
	    {
	        $result['keyword'] = $keyword;
	    }
	    $this->load->view('admin/goods_album_pic_list',$result);
	}
	
	public function album_del()
	{
	    
	    if ($this->input->get('album_id'))
	    {
	        $id = $this->input->get('album_id');
	    }
	    if ($this->input->post('del_id'))
	    {
	        $id = $this->input->post('del_id');
	    }
	    if (isset($id))
	    {
	        $this->Goods_Album_Pic_model->delete_album($id);
	    }
	    else 
	    {
	        echo '请选择要删除的相册';
	    }
	    
	    
	}
	
	public function pic_del()
	{
	    $ids = $this->input->post('delbox');
	    if ($ids)
	    {
	        if ($this->Goods_Album_Pic_model->delete_by_id($ids))
	        {
	            redirect(ADMIN_SITE_URL.'/goods_album');
	        }
	        else 
	        {
	            echo '删除失败';
	        }
	    }
	    else 
	    {
	        echo '请选择要删除的图片';
	    }
	}
	
	public function ajax_pic_del()
	{
	    
	    $str = $this->input->get('key');
	    
	    $str1 = explode('|',$str);
	    $id = $str1[0];
	    $pic = $this->Goods_Album_Pic_model->get_by_id($id);
	    if($pic['pic'] == $str1[1])
	    {
	        if ($this->Goods_Album_Pic_model->delete_by_id($id))
	        {
	            exit('1');
	        }
	        else 
	        {
	            exit('0');
	        }
	    }
	    else 
	    {
	        exit('0');
	    }
	}

}
