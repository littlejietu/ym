<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods_sku_model extends XT_Model {

	protected $mTable = 'goods_sku';
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

	/**
    * 配送方式
    * @param: $sku_id: sku id, $goods_id:商品id, $num:数量
    * @return: $arrReturn( 'way'=>1, 'detail'=>array($delivery_way=>$num,2=>1) )
    *			配送方式 1:2件 2:5件
    *			1:由九号街区配送 2.由快递配送 3:由九号街区+快递配送
    */
	public function deliver($sku_id, $goods_id, $num){
		$arrReturn = array();
		$delivery_self = 1;
		$delivery_third = 2;
		$delivery_both = 3;

		$stock_num = 0;

		$aSku = array();
		if(!empty($sku_id)){
			$aSku = $this->get_by_where( array('id'=>$sku_id) );
		}

		if(!empty($aSku)){
			$stock_num = $aSku['num'];
		}else{
			$aGoodNum = M('Goods_num')->get_by_id($goods_id);
			if(!empty($aGoodNum))
				$stock_num = $aGoodNum['stock_num'];
		}

		if($stock_num>=$num)
			$arrReturn = array('way'=>$delivery_self, 'detail'=>array($delivery_self=>$num) );
		else if($stock_num==0)
			$arrReturn = array('way'=>$delivery_third, 'detail'=>array($delivery_third=>$num) );
		else{
			$arrReturn = array('way'=>$delivery_both, 'detail'=>array($delivery_self=>$stock_num, $delivery_third=>($num-$stock_num) ) );
		}


		return $arrReturn;
	}

	/**
    * 多件商品显示配送方式
    * @param: $arrNum('sku_id'=>$sku_id, 'goods_id'=>$goods_id, 'num'=>$num) 
    *			说明:$sku_id: sku id, $goods_id:商品id, $num:数量
    *		1:由九号街区配送 2.由快递配送 3:由九号街区+快递配送
    * @return:配送方式
    */
	public function delivers_display($arrNum){
		$delivery_way = 0;
		foreach ($arrNum as $k => $a) {
			$arrItem = $this->deliver($a['sku_id'], $a['goods_id'], $a['num']);

            if($delivery_way == 0){
                if($arrItem['way']==1)
                    $delivery_way = 1;
                elseif($arrItem['way']==2)
                    $delivery_way = 2;
                else
                    $delivery_way = 3;
            }
			else if($delivery_way == 1){
				if($arrItem['way']==2)
					$delivery_way = 3;
			}else if($delivery_way==2){
				if($arrItem['way']==1)
					$delivery_way = 3;
			}

			if($delivery_way==3)
				break;
			
		}
		return $delivery_way;
	}

	/**
    * 多件商品显示配送方式
    * @param: $arrNum('sku_id'=>$sku_id, 'goods_id'=>$goods_id, 'num'=>$num) 
    *			说明:$sku_id: sku id, $goods_id:商品id, $num:数量
    *		1:由九号街区配送 2.由快递配送 3:由九号街区+快递配送
    * @return:$arrReturn[]=array( 'way'=>1, 'detail'=>array($delivery_way=>$num,2=>1) )
    */
	public function delivers($arrNum){
		$arrReturn = array();
		foreach ($arrNum as $k => $a) {
			$key = $a['goods_id'].'_'.$a['sku_id'];
			$arrReturn[$key] = $this->deliver($a['sku_id'], $a['goods_id'], $a['num']);
		}
		return $arrReturn;
	}
}