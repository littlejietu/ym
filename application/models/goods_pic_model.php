<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods_pic_model extends XT_Model {

	protected $mTable = 'goods_pic';

	/*
	 $data = array('shop_id'=>$shop_id,
            'goods_id'=>$goods_id,
            'pic'=>'xx',
            'sort'=>$value['sort'],
        );
	*/	
	/*public function insert_update($data){
		$where = array('goods_id'=>$data['goods_id'],'pic'=>"'".$data['pic']."'");
		$a = $this->get_by_where($where);
		if(!empty($a))
		{
			$this->update_by_where($where,array('shop_id'=>$data['shop_id'],'sort'=>$data['sort']));
		}
		else
			$this->insert_string($data);
	}*/
	
}