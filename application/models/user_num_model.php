<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_num_model extends XT_Model {

	protected $mTable = 'user_num';
	protected $mPkId = 'user_id';
	
	// public function getList()
	// {
	//     $res = $this->get_list();
	//     $list = array(array());
	//     foreach ($res as $key => $value)
	//     {
	//         $list[$value['user_id']] = $value;
	//     }
	//     return $list;
	// }
	
}