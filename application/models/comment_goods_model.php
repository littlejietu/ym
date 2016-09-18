<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_goods_model extends XT_Model {

	protected $mTable = 'trd_comment_goods';
	
	
	public function add_comment($order_id,$buyer_id,$comment)
	{
	    foreach ($comment as $value)
	    {
	        if (empty($value['score_level']))
	        {
	            $value['score_level'] = 5;
	        }
	        $pic_path = '';
	        if(!empty($value['pic_path']))
	        	$pic_path = $value['pic_path'];
	        $data = array(
	            'order_id' => $order_id,
	            'buyer_id' => $buyer_id,
	            'goods_id' => $value['goods_id'],
	            'sku_id' => $value['sku_id'],
	            'pic_path' => $pic_path,
	            'score_level' => $value['score_level'],
	            'addtime' => time(),
	            'status' => 1,
	        );
	        if (isset($value['comment']))
	        {
	            $data['comment'] = $value['comment'];
	        }
	        if (isset($value['pic_path']))
	        {
	            $value['pic_path'] = $value['pic_path'];
	        }
	        $this->insert($data);
	    }
	    return true;
	}
}