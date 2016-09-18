<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods_spu_attr_val_model extends XT_Model {

	protected $mTable = 'goods_spu_attr_val';

	/*
	'goods_id'=>$id,
	'name_id'=>$a['name_id'],
	'val'=>$val   / 'val_id'=>$val_id
	*/
	public function insert_update($data){
		$where = array('goods_id'=>$data['goods_id'],'name_id'=>$data['name_id']);
		$a = $this->get_by_where($where);
		if(!empty($a))
		{
			$data_update = array();
			if(!empty($a['val']))
				$data_update = array('val'=>$data['val']);
			else if(!empty($a['val_id']))
				$data_update = array('val_id'=>$data['val_id']);
			if(!empty($data_update))
				$this->update_by_where($where, $data_update);
		}
		else
			$this->insert_string($data);
	}


	public function getCheckList($goods_id, $cid){

		//通过cid，得到该类目下的默认的spu属性
	    $spu_code = $cid.'-';
	    $attrValList = M('Spu')->getAttrValBySpuCode($spu_code);
	    $aAttr = $this->get_list(array('goods_id'=>$goods_id),'val_id,name_id,val');
	    if(!empty($aAttr))
	    {
	        $attr_id = array();
	        $attr_txt = array();
	        foreach ( $aAttr as $val ) {
	            if(!empty($val['val']))
	                $attr_txt[$val['name_id']] = $val['val'];
	            else
	                $attr_id[] = $val ['val_id'];
	        }
	        $attr_checked = array('attr_id'=>$attr_id,'attr_txt'=>$attr_txt);
	    }

	    foreach ($attrValList as $k => $a) {
	     
	      if(!empty($a['valList']))
	      {
	        $aValList = array();

	          foreach ($a['valList'] as $kk => $vv) {
	          	if(!empty($attr_checked) && !empty($attr_checked['attr_txt'][$a['name_id']])){
		            if($a['input_type']==1){
		              $a['valList'][$kk] = $attr_checked['attr_txt'][$a['name_id']];
		            }
		            else {
		              if(in_array($kk, $attr_checked['attr_id']) )
		              {
		                $aValList[$kk] = $vv;
		              }
		            }
		        }
	            
	          }
	          $a['valList'] = empty($aValList)?null:$aValList;
	      }
	      else{
	        if($a['input_type']==1 && !empty($attr_checked) && !empty($attr_checked['attr_txt'][$a['name_id']]))
	          $a['valList'][$a['name_id']] = $attr_checked['attr_txt'][$a['name_id']];
	      }

	      $attrValList[$k] = $a;
	    }

	    return empty($attrValList)?null:$attrValList;
	}
	
}