<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spec_name_model extends XT_Model {

	protected $mTable = 'prd_spec_name';
	protected $mPkId = 'name_id';


	public function save($name_id, $name, $type, $vals, $status){
		//wordbook
        $words = $name;
        if(!empty($vals))
            $words = $words.','.$vals;
        $arrWord = explode(',', $words);
        M('Word')->saveData($arrWord);
        $aWordList = M('Word')->getList();
        //-wordbook

        //spec_attr/spec_name
        if($name_id<=0){
            $name_id = array_search($name,$aWordList);
        }

        if(empty($name_id))
            continue;
        
        $aSpecAttr = $this->get_by_id( $name_id );
        if(!empty($aSpecAttr)){
            $data = array();
            if($aSpecAttr['type'] != $type)
                $data['type'] = $type;
            if($aSpecAttr['status'] != $status)
                $data['status'] = $status;

            if(!empty($data))
                $this->update_by_id($name_id,$data);
        }
        else{
            $data_attr = array('name_id'=>$name_id,'type'=>$type, 'status'=>$status);
            $this->insert_string($data_attr);
        }
        //-spec_attr/spec_name

		//spec_attr_val 所有分类共用同一规格
        if(!empty($vals)){
            $arrVal = explode(',', $vals);
            $ii = 0;
            $arrVal_id = array();
            foreach ($arrVal as $v) {
                $ii++;
                $val_id = array_search($v,$aWordList);
                $arrVal_id[] = $val_id;
                if(empty($val_id))
                    continue;
                $aAttrVal = M('Spec_val')->get_by_where(array('val_id'=>$val_id, 'name_id'=>$name_id));
                if(!empty($aAttrVal)){
                    $data_attrval = array();
                    if($aAttrVal['val'] != $v)
                        $data_attrval['val'] = $v;
                    if($aAttrVal['sort'] != $ii)
                        $data_attrval['sort'] = $ii;
                    if($aAttrVal['status'] != 1)
                        $data_attrval['status'] = 1;

                    if(!empty($data_attrval))
                        M('Spec_val')->update_by_id($aAttrVal['id'],$data_attrval);
                }
                else
                    M('Spec_val')->insert(array('val'=>$v,'val_id'=>$val_id, 'name_id'=>$name_id,'sort'=>$ii,'status'=>1));
            }

            $strVal_id = implode(',', $arrVal_id);
            $strVal_id = trim($strVal_id,',');
            $strWhere = "name_id=$name_id and val_id not in($strVal_id)";
            M('Spec_val')->update_by_where($strWhere,array('status'=>2));
        }
        //-spu_attr_val

        $arrCategoryList = M('Spec')->get_list(array('name_id'=>$name_id));
        foreach ($arrCategoryList as $k => $a) {
        	$key = 'prd_spec_val:'.$a['category_id'];
        	dkcache($key);
        }

	}
}