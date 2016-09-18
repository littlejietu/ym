<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_third_model extends XT_Model{
	
	protected $mTable = 'user_third';
	protected $mPkId = 'user_id';

	public function get_info_by_id($user_id)
	{
		$arrReturn = array();
		$aUser = M('user')->get_by_id($user_id,'user_id,user_name,name,logo');
		if(!empty($aUser)){
			$aThird = $this->get_by_id($user_id);
			if(empty($aThird))
				$aThird = array('rong_token'=>'');

			$arrReturn = array_merge($aThird, $aUser);
		}

		return $arrReturn;
	}

	// public function edit_do($id,$data){
	// 	$where = array('user_id'=> (int)$id);
	// 	$sql = $this->db->update_string($this->mTable, $data, $where);
	// 	return $this->db->query($sql);
	// }
	

}