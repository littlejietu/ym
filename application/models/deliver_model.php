<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deliver_model extends XT_Model {

	protected $mTable = 'shop_deliver';
	
	
	public function get_city_checked_child_array($where,$fields = '*')
	{
	    $permission =  parent::get_by_where($where);
	    if (!empty($permission['area_id']))
	    {
	        $permission['area_id'] = explode('|',$permission['area_id']);
	        $result['province'] = explode(',',$permission['area_id'][1]);
	        array_pop($result['province']);
	        
	        $result['city'] = explode(',',$permission['area_id'][3]);
	        array_pop($result['city']);
	        $result['county'] = explode(',',$permission['area_id'][5]);
	        array_pop($result['county']);
	    }
	    else 
	    {
	        $result = null;
	    }
	    return $result;
	}
	
}