<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transport_tpl_model extends XT_Model
{

    protected $mTable = 'shop_transport_tpl';

    public function getFareAmt($transport_id, $area_id)
    {
        $fare = 0;
        $arrList = $this->get_list(array('transport_id' => $transport_id));
        if (!empty($arrList)) {
            foreach ($arrList as $key => $v) {
                if (strpos($v['top_area_id'], "," . $area_id . ",") !== false) {
                    $fare = $v['sprice'];
                }
                if ($v['is_default'] == 1) {
                    $fare_default = $v['sprice'];
                }
            }

            //如果运费模板中没有指定该地区，取默认运费
            if (empty($fare) && !empty($fare_default)) {
                $fare = $fare_default;
            }
        }

        return $fare;
    }

    /**
     * 计算某地区某运费模板ID下的商品总运费，如果运费模板不存在或，按免运费处理
     *
     * @param int $transport_id
     * @param int $buy_num
     * @param int $area_id
     * @return number/boolean
     */
    public function calc_transport($transport_id, $buy_num, $area_id)
    {
        if (empty($transport_id) || empty($buy_num) || empty($area_id)) {
            return 0;
        }

        $extend_list = $this->get_list(array('transport_id' => $transport_id,'status'=>1));
        if (empty($extend_list)) {
            return 0;
        } else {
            return $this->calc_unit($area_id, $buy_num, $extend_list);
        }
    }

    /**
     * 计算某个具单元的运费
     *
     * @param 配送地区 $area_id
     * @param 购买数量 $num
     * @param 运费模板内容 $extend
     * @return number 总运费
     */
    private function calc_unit($area_id, $num, $extend)
    {
        //$calc_total=0;
        if (!empty($extend) && is_array($extend)) {
            foreach ($extend as $v) {
                if (strpos($v['area_id'], "," . $area_id . ",") !== false) {
                    if ($num <= $v['snum']) {
                        //在首件数量范围内
                        $calc_total = $v['sprice'];
                    } else {
                        //超出首件数量范围，需要计算续件
                        $calc_total = sprintf('%.2f', ($v['sprice'] + ceil(($num - $v['snum']) / $v['xnum']) * $v['xprice']));
                    }
                }
                if ($v['is_default'] == 1) {
                    if ($num <= $v['snum']) {
                        //在首件数量范围内
                        $calc_default_total = $v['sprice'];
                    } else {
                        //超出首件数量范围，需要计算续件
                        $calc_default_total = sprintf('%.2f', ($v['sprice'] + ceil(($num - $v['snum']) / $v['xnum']) * $v['xprice']));
                    }
                }
            }
            //如果运费模板中没有指定该地区，取默认运费
            if (!isset($calc_total) && isset($calc_default_total)) {
                $calc_total = $calc_default_total;
            }
        }
        return $calc_total;
    }

}