<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Goods_model extends XT_Model
{

    protected $mTable = 'goods';

    protected $tb_goods = 'goods';

    protected $tb_detail = 'goods_detail';
    
    protected $tb_num = 'goods_num';

    public function get_info_by_id($id, $fields = '*', $extend =array())
    {
//         $aInfo = $this->get_by_id($id, $fields);
        $aInfo = $this->get_by_where(array('id'=>$id,'status'=>1), $fields);
        $this->set_table($this->tb_detail);
        $aDetail = $this->get_by_where("goods_id=$id", '*');
        if ($aInfo && $aDetail) {
            $aInfo = array_merge($aDetail, $aInfo);
        }
        
        //追加商品数量表信息
        if(in_array('goods_num',$extend)){
            $this->set_table($this->tb_num);
            $aNum = $this->get_by_where("goods_id=$id", '*');
            if ($aInfo && $aNum) {
                $aInfo = array_merge($aNum, $aInfo);
            }
        }
        
        $this->set_table($this->tb_goods);
        return $aInfo;
    }
    
  
}