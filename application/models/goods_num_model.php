<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods_num_model extends XT_Model {

	protected $mTable = 'goods_num';
	protected $mPkId = 'goods_id';
	
	public function get_list_by_buy_num($limit,$shop_id)
	{
	    $sql = "SELECT b.id goods_id,b.tpl_id,b.sku_id,b.shop_id,b.title name,b.pic_path pic_url,b.price,b.market_price
                    FROM `".$this->prefix()."goods_num` a LEFT JOIN `".$this->prefix()."goods` b
                    ON a.goods_id = b.id
                    WHERE b.shop_id=$shop_id
                    ORDER BY (be_buy_num+be_buy_num_fake) DESC,a.goods_id DESC
                    LIMIT $limit";
	    $result = $this->db->query($sql)->result_array();
	    return $result;
	}
}