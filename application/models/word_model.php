<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Word_model extends XT_Model {

	protected $mTable = 'prd_wordbook';

	protected $cachedData;

	public function getList() {
        if ($this->cachedData) {
            return $this->cachedData;
        }
        $data = rkcache('prd_wordbook');
        if (!$data) {
            $arrList = $this->get_list();
            $data = array();
            foreach ($arrList as $k => $v) {
            	$data[$v['id']] = $v['name'];
            }

            wkcache('prd_wordbook', $data);
        }

        return $this->cachedData = $data;
    }

	/**
	 * 读取系统设置信息
	 *
	 * @param int $id 值
	 * @return array 数组格式的返回结果
	 */
	public function getName($id)
	{
		$strReturn = '';
		$data = $this->getList();
		if(!empty($data[$id]))
			$strReturn = $data[$id];
		return $strReturn;
	}
	

	public function updateList($arr)
	{
		if (empty($arr)){
			return false;
		}

		if (is_array($arr)){
			foreach ($arr as $k => $v){
	            $this->update_by_id($k,$v);
			}
			dkcache('prd_wordbook');
			$this->cachedData = null;
			return true;
		}else {
			return false;
		}
	}

	public function saveData($arr){
		$data = $this->getList();
		$bClean = false;

		foreach ($arr as $v) {
			if(!in_array($v, $data) && !empty($v))
			{
				$bClean = true;
				$this->insert(array('name'=>$v));
			}
		}

		if($bClean)
		{
			dkcache('prd_wordbook');
			$this->cachedData = null;
		}
		return true;
	}
}