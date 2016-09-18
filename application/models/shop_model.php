<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop_model extends XT_Model {

	protected $mTable = 'shop';

	public function getNearShop($lng, $lat){
		$aShopList = $this->get_list(array('status'=>1));
        $range_short = 0;
        foreach ($aShopList as $k => $a) {
            $range = sqrt(pow($a['lng']-$lng,2) + pow($a['lat']-$lat,2));

            if(empty($range_short) || $range_short>$range){
                $range_short = $range;
                $aShop = array('shop_id'=>$a['id'],'shop_name'=>$a['name']);
            }
        }

        return $aShop;
	}
	
}