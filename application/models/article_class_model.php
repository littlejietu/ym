<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_Class_model extends XT_Model {

	protected $mTable = 'other_article_class';
	
	public function get_class_list($where,$fields='*')
	{
	    $class_list = $this->get_list($where);
	    $result = array();
	    foreach ($class_list as $key => $value)
	    {
	        $result[$value['id']] = $value;
	    }
	    return $result;
	}
	
	public function get_child_list($where,$fields='*')
	{
	    $class_list = $this->get_list($where);
	    $result = array();
	    foreach ($class_list as $key => $value)
	    {
	        if ($value['parent_id'] == 0)
	        {
	            foreach ($class_list as $k=>$v)
	            {
	                if ($value['id'] == $v['parent_id'])
	                {
	                    $result[$value['id']][] = $v['id'];
	                }
	            }
	        }
	    }
	    return $result;
	}
}