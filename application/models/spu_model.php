<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spu_model extends XT_Model {

	protected $mTable = 'prd_spu';

	public function getListByCategoryId($category_id) {

        $key = 'prd_spu:'.$category_id;
        $data = rkcache($key);
        if (!$data) {
            $data = $this->get_list(array('category_id'=>$category_id,'status'=>1),'*','sort asc,id asc');

            wkcache($key, $data);
        }

        return $data;
    }

	/**
	 * 读取默认spu
	 *
	 * @param string $category_id 类别id
	 * @return array 数组格式的返回结果
	 */
	public function getDefaultSpu($category_id)
	{
		$arrReturn = array();
		$data = $this->getListByCategoryId($category_id);
		foreach ($data as $k => $arr) {
			if($arr['is_default']==1)
			{
				$arrReturn = $arr;
				break;
			}
		}

		return $arrReturn;
	}

	/*
	通过spu_code 找到 spu_id，找不到返回默认spu
	*/
	public function getSpuIdByCode($spu_code){
		$intReturn = 0;
		$arrTmp = explode('-', $spu_code);
		if(!empty($arrTmp))
		{
			$category_id = $arrTmp[0];

			$data = $this->getListByCategoryId($category_id);
			foreach ($data as $k => $arr) {
				if($arr['spu_code']==$spu_code)
				{
					$intReturn = $arr['id'];
					break;
				}
			}

			if(empty($intReturn))
			{
				$arrTmp = $this->getDefaultSpu($category_id);
				if(!empty($arrTmp))
					$intReturn = $arrTmp['id'];
			}
		}

		return intval($intReturn);
	}


	/*通过spu_code得到属性+值等所有信息
	spu_code key[prd_spu_attrval:category_id-name_id1:val_id1,name_id2:val_id2]
	*/
	public function getAttrValBySpuCode($spu_code) {
//        $key = 'prd_spu_attrval:'.$spu_code;
//        $data = rkcache($key);
//
//        if (!$data) {
        	$word_model = M('Word');
        	$spu_attr_model = M('Spu_attr');
        	$spu_attr_val_model = M('Spu_attr_val');

        	//通过spu_code找到spu_id
        	$spu_id = intval( $this->getSpuIdByCode($spu_code) );
            $data = $spu_attr_model->get_list(array('spu_id'=>$spu_id,'status'=>1),'name_id,input_type,is_read,is_required,unit','sort asc,id asc');
            foreach ($data as $k => $arr) {

            	$data[$k]['name'] = $word_model->getName($arr['name_id']);
            	//valList:val组值
            	$valList = $spu_attr_val_model->get_list(array('spu_id'=>$spu_id,'name_id'=>intval($arr['name_id']),'status'=>1),"val_id",'sort asc,id asc');
            	$arrVal = array();
            	if(!empty($valList))
            	{
	            	foreach ($valList as $kk => $vv) {
	            		$val_name = $word_model->getName($vv['val_id']);
	            		if(!empty($val_name))
	            			$arrVal[$vv['val_id']] = $val_name;
	            	}
	            	$data[$k]['valList'] = $arrVal;
            	}
            	else
            		$data[$k]['valList'] = '';
            	//-valList:val组值
            }
//
//            wkcache($key, $data);
//        }

        return $data;
    }


    /**
	 * spu数据保存
	 *
	 * @param $arrSpuData: array('name_id'=>array('input_type'=>1,'name'=>'小小','val'=>'小1,小2,小3'))
	 *			name_id<0:新增
	 * @return boolean true/false
	 */
	public function save($cid,$arrSpuData){
		//spu info -> get spu_id
		$spu_id = 0;
		$aSpu = M('Spu')->getDefaultSpu($cid);
		$spu_code = $cid.'-';
		if(empty($aSpu)){
			$spu_id = M('Spu')->insert_string(array('spu_code'=>$spu_code,'category_id'=>$cid,'is_default'=>1,'extra_type'=>0,'sort'=>0,'status'=>1));
		}
		else
			$spu_id = $aSpu['id'];
		//-spu info -> get spu_id

		//name_id
		$i = 0;
		$strVal_id = '';
		foreach ($arrSpuData as $name_id => $a) {
			$i++;
			//wordbook
			$words = $a['name'];
			if(!empty($a['val']))
				$words = $words.','.$a['val'];
			$arrWord = explode(',', $words);
			M('Word')->saveData($arrWord);
			$aWordList = M('Word')->getList();
			//-wordbook

			//spu_attr
			if($name_id<=0){
				$name_id = array_search($a['name'],$aWordList);
			}

			if(empty($name_id))
				continue;
			
			$aSpuAttr = M('Spu_attr')->get_by_where(array('spu_id'=>$spu_id,'category_id'=>$cid,'name_id'=>$name_id) );
			if(!empty($aSpuAttr)){
				$data = array();
				if($aSpuAttr['input_type'] != $a['input_type'])
					$data['input_type'] = $a['input_type'];
				if(!empty($a['is_key']) && $aSpuAttr['is_key'] != $a['is_key'])
					$data['is_key'] = $a['is_key'];
				if(!empty($a['is_read']) && $aSpuAttr['is_read'] != $a['is_read'])
					$data['is_read'] = $a['is_read'];
				if(!empty($a['is_required']) && $aSpuAttr['is_required'] != $a['is_required'])
					$data['is_required'] = $a['is_required'];
				if(!empty($a['unit']) && $aSpuAttr['unit'] != $a['unit'])
					$data['unit'] = $a['unit'];
				if(!empty($a['memo']) && $aSpuAttr['memo'] != $a['memo'])
					$data['memo'] = $a['memo'];
				if($aSpuAttr['sort'] != $i)
					$data['sort'] = $i;
				if(empty($aSpuAttr['status']))
					$data['status'] = 1;

				if(!empty($data))
					M('Spu_attr')->update_by_id($aSpuAttr['id'],$data);
			}
			else{
				$data_attr = array('spu_id'=>$spu_id,'category_id'=>$cid,'name_id'=>$name_id,'input_type'=>$a['input_type'], 'sort'=>$i,'status'=>1);
				if(!empty($a['is_key']) && $aSpuAttr['is_key'] != $a['is_key'])
					$data_attr['is_key'] = $a['is_key'];
				if(!empty($a['is_read']) && $aSpuAttr['is_read'] != $a['is_read'])
					$data_attr['is_read'] = $a['is_read'];
				if(!empty($a['is_required']) && $aSpuAttr['is_required'] != $a['is_required'])
					$data_attr['is_required'] = $a['is_required'];
				if(!empty($a['unit']) && $aSpuAttr['unit'] != $a['unit'])
					$data_attr['unit'] = $a['unit'];
				if(!empty($a['memo']) && $aSpuAttr['memo'] != $a['memo'])
					$data_attr['memo'] = $a['memo'];

				M('Spu_attr')->insert_string($data_attr);
			}
			//-spu_attr

			//spu_attr_val
			if(!empty($a['val'])){
				$arrVal = explode(',', $a['val']);
				$ii = 0;
				foreach ($arrVal as $i_sort => $v) {
					$ii++;
					$val_id = array_search($v,$aWordList);
					if(empty($val_id))
						continue;
					$strVal_id .= $val_id.',';
					$aAttrVal = M('Spu_attr_val')->get_by_where(array('spu_id'=>$spu_id,'val_id'=>$val_id, 'name_id'=>$name_id));
					if(!empty($aAttrVal)){
						$data_attrval = array();
						if($aAttrVal['sort'] != $ii)
							$data_attrval['sort'] = $ii;
						if($aAttrVal['status'] != 1)
							$data_attrval['status'] = 1;

						if(!empty($data_attrval))
							M('Spu_attr_val')->update_by_id($aAttrVal['id'],$data_attrval);
					}
					else
						M('Spu_attr_val')->insert(array('spu_id'=>$spu_id,'val_id'=>$val_id, 'name_id'=>$name_id,'sort'=>$ii,'status'=>1));
				}
			}
			//-spu_attr_val
		}

		//spu_attr_val不开启
		$strVal_id = trim($strVal_id,',');
		if(!empty($strVal_id)){
            $strWhere = "spu_id=$spu_id and val_id not in($strVal_id)";
            M('Spu_attr_val')->update_by_where($strWhere,array('status'=>2));
        }

		$key = 'prd_spu_attrval:'.$spu_code;
		dkcache($key);
	}


	public function delData($spu_id, $spu_code, $name_id){
		$arrWhere = array('spu_id'=>$spu_id,'name_id'=>$name_id);
		M('Spu_attr')->update_by_where($arrWhere,array('status'=>0));
		M('Spu_attr_val')->update_by_where($arrWhere,array('status'=>0));

		$key = 'prd_spu_attrval:'.$spu_code;
		dkcache($key);
	}
	
}