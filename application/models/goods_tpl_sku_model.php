<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods_tpl_sku_model extends XT_Model {

	protected $mTable = 'goods_tpl_sku';
	protected $mPkId = 'sku_code';
	
	public function getList($goods_id){
		$sku_value = array();
		$aSku = $this->get_list(array('goods_id'=>$goods_id),'*');
	    if(!empty($aSku))
	    {
	        foreach ($aSku as $v) {
	            //$code = str_replace('_', '', substr($v['sku_code'], strpos($v['sku_code'],':')+1));
	            $code = substr($v['sku_code'], strpos($v['sku_code'],':')+1);
	            $sku_value[$code] = array('marketprice'=>$v['market_price'], 'price'=>$v['price'],'num'=>$v['num'],'id'=>$v['id'],'pic'=>$v['pic']);
	        }
	    }
	    return $sku_value;
	}

	
	
}