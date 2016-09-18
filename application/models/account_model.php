<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends XT_Model {

	protected $mTable = 'acct_user_account';
	protected $mPkId = 'user_id';

	public function init($user_id)
	{
		$pwd = "@xt";
		$platform_id = C('basic_info.PLATFORM_ID');
		$sql = "INSERT IGNORE INTO ".$this->prefix()."acct_user_account (`acct_balance`, `acct_blob`, `createtime`,`platform_id`) VALUES (0, AES_ENCRYPT(convert(0, DECIMAL(12,2) ), '".$pwd."'), ".time().", ".$platform_id.") ON duplicate KEY UPDATE user_id=$user_id";
		$this->execute($sql);
	}

	public function check($user_id){
		$pwd = "@xt";
		$aAccount =	$this->get_by_where(array('user_id'=>$user_id, 'acct_balance'=>"convert(AES_DECRYPT(acct_blob,'$pwd'),DECIMAL(12,2))"));
		if(!empty($aAccount))
			return true;
		else
			return false;
		
	}

	public function init_get($user_id){
		$aAccount = $this->get_by_id($user_id, 'acct_balance');
		if(empty($aAccount)){
			$this->init($user_id);
			$aAccount = $this->get_by_id($user_id, 'acct_balance');
		}
		return $aAccount;
	}
	
}