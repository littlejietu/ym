<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Waybill_model extends XT_Model {

	protected $mTable = 'logist_waybill';
	
	public function get_design_info()
	{
	    
	}
	
	public function save_design_info($id,$list)
	{
	    $place = array();
	    foreach ($list as $key => $value)
	    {
	        if (isset($value['check']))
	        {
	            $string =$key.'|';
	            $str = implode(',',$value);
	            $place[] = $string.$str;
	        }
	    }
	    $string = implode('-',$place);
	    $data['wb_data'] = $string;
	    $this->update_by_id($id,$data);
	}
	
	
	public function getWaybillItemList() {
	    $item = array(
	        'buyer_name' => array('item_text' => '收货人'),
	        'buyer_area' => array('item_text' => '收货人地区'),
	        'buyer_address' => array('item_text' => '收货人地址'),
	        'buyer_mobile' => array('item_text' => '收货人手机'),
	        'buyer_phone' => array('item_text' => '收货人电话'),
	        'seller_name' => array('item_text' => '发货人'),
	        'seller_area' => array('item_text' => '发货人地区'),
	        'seller_address' => array('item_text' => '发货人地址'),
	        'seller_phone' => array('item_text' => '发货人电话'),
	        'seller_company' => array('item_text' => '发货人公司'),
	    );
	    return $item;
	}
    //将运单模板的设计数据修改成数组模式
	public function get_design_data($string)
	{
	    if (!empty($string))
	    {
	        $design = array();
	        $arr = explode('-',$string);
	        foreach ($arr as $key => $value)
	        {
	            $item = explode('|',$value);
	            $list = explode(',',$item[1]);
	            list($arr1['check'],$arr1['left'],$arr1['top'],$arr1['width'],$arr1['height']) = $list;
	            $design[$item[0]] = $arr1;
	        }
	        return $design;
	    }
	    else 
	    {
	        return ;
	    }
	    
	    
	}
	
}