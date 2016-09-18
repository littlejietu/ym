<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods_spec_attr_val_model extends XT_Model {

	protected $mTable = 'goods_spec_attr_val';
	

	/*
	'goods_id'=>$id,
    'name_id'=>$name_id,
    'val_id'=>$key,
    'spec_val'=>$value,
    'sort'=>$i,
	*/
	public function insert_update($data){
		$where = array('goods_id'=>$data['goods_id'],'name_id'=>$data['name_id'],'val_id'=>$data['val_id']);
		$a = $this->get_by_where($where);
		if(!empty($a))
		{
			if($a['spec_val']!=$data['spec_val'])
				$this->update_by_where($where,array('spec_val'=>$data['spec_val'],'sort'=>$data['sort']));
		}
		else
			$this->insert_string($data);
	}




	public function getCheckList($goods_id, $cid){
		$arrSpecList = array();		

		//选中的规格
	    $aSpec = $this->get_list(array('goods_id'=>$goods_id),'val_id,spec_val,pic','sort asc,id desc');

	    if(!empty($aSpec))
	    {
	    	//通过cid，得到该类目下sku规格
    		$arrSpecList = M('Spec')->getSpecVal($cid);

	        $spec_checked = array();
	        foreach ( $aSpec as $k => $v ) {
	          $spec_checked[$v['val_id']]['id'] = $v['val_id'];
	          $spec_checked[$v['val_id']]['name'] = $v['spec_val'];
	          $spec_checked[$v['val_id']]['pic'] = $v['pic'];
	        }

	        foreach ($arrSpecList as $k => $a) {
	          
	          foreach ($a['valList'] as $kk => $aa) {
	            if(!empty($spec_checked[$aa['val_id']])){
	            	$arrSpecList[$k]['valList'][$kk]['val'] = $spec_checked[$aa['val_id']]['name'];
	            }
	            else
	            	unset($arrSpecList[$k]['valList'][$kk]);  	
	          }

	          $arrSpecList[$k]['valList'] = array_values($arrSpecList[$k]['valList']);

	        }

	        

	    }
	    
	    return empty($arrSpecList)?null:$arrSpecList;
	}

}