<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends XT_Model {

	protected $mTable = 'trd_payment';
	
	public function get_config_by_id($id)
	{
	    $res = $this->get_by_id($id,'config');
	    $string = explode('|',$res['config']);
	    array_pop($string);
	    $config = array();
	    foreach ($string as $key=>$value)
	    {
	        $str = explode(',',$value);
	        $config[$str[0]] = $str[1];
	    }
	    return $config;
	    

	}
	
}
