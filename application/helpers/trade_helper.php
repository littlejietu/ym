<?php

function getMillisecond() {
	list($t1, $t2) = explode(' ', microtime());
	return (float) sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
}

function getOrderSn() {
	$now = date("ymdHis") . getMillisecond();
	$rnd = rand(100, 999);

	$id = $now . $rnd;

	return $id;

}

function isRechargeOrder($arrFundOrder) {
	return $arrFundOrder['buyer_userid'] == $arrFundOrder['seller_userid'] && ($arrFundOrder['type_id'] == C('OrderType.Recharge') || $arrFundOrder['type_id'] == C('OrderType.Promote'));
}

function isTakeCashOrder($arrFundOrder) {
	return $arrFundOrder['buyer_userid'] == $arrFundOrder['seller_userid'] && $arrFundOrder['type_id'] == C('OrderType.Cash');
}

/**
 * 得到所购买的id和数量
 *
 */
function parseBuyItems($cart_id) {
	//存放所购商品ID-SKU_ID和数量组成的键值对
	$buy_items = array();
	if (is_array($cart_id)) {
		foreach ($cart_id as $value) {
			if (preg_match_all('/^(\d{1,10})\,(\d{1,10})\,(\d{1,6})$/', $value, $match)) {
				if (intval($match[3][0]) > 0) {
					$buy_items[$match[1][0] . '-' . $match[2][0]] = $match[3][0];
				}
			}
		}
	}
	return $buy_items;
}

?>