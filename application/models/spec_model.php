<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spec_model extends XT_Model {

	protected $mTable = 'prd_spec';

	public function getSpecVal($category_id){
		$key = 'prd_spec_val:'.$category_id;

		$data = rkcache($key);

		if (!$data) {
			$word_model = M('Word');
			$spec_val_model = M('Spec_val');

            $data = $this->get_list(array('category_id'=>$category_id,'status'=>1),'*','sort asc,id asc');
            foreach ($data as $k => $arr) {
            	$data[$k]['name'] = $word_model->getName($arr['name_id']);
            	//valList:val组值
            	$valList = $spec_val_model->get_list(array('name_id'=>intval($arr['name_id']),'status'=>1),"val_id,val,alias,numerical",'sort asc,id asc');
            	$arrVal = array();
            	if(!empty($valList))
            	{
	            	$data[$k]['valList'] = $valList;
            	}
            	else{
            		//$data[$k]['valList'] = array();
                    unset($data[$k]);
                }
            	//-valList:val组值
            }

            wkcache($key, $data);
        }

        return $data;
	}

    /**
     * spec数据保存
     *
     * @param $arrSpecData: array('name_id'=>array('type'=>1,'name'=>'小小','val'=>'小1,小2,小3'))
     *          name_id<0:新增
     * @return boolean true/false
     */
    public function save($category_id,$arrSpecData){

        //name_id
        $i = 0;
        $strName_id = '';
        foreach ($arrSpecData as $k => $name_id) {
            $i++;

            //spec_attr
            if(empty($name_id))
                continue;

            $strName_id .= $name_id.',';

            $aSpecName = M('Spec_name')->get_by_id($name_id);
            if(empty($aSpecName))
                continue;
            
            $aSpecAttr = $this->get_by_where( array('category_id'=>$category_id,'name_id'=>$name_id) );//status若为0，则修改为1
            if(!empty($aSpecAttr)){
                $data = array();
                if($aSpecAttr['type'] != $aSpecName['type'])
                    $data['type'] = $aSpecName['type'];
                if($aSpecAttr['sort'] != $i)
                    $data['sort'] = $i;
                if(empty($aSpecAttr['status']) || $aSpecAttr['status']!=1)
                    $data['status'] = 1;

                if(!empty($data))
                    $this->update_by_id($aSpecAttr['id'],$data);
            }
            else{
                $data_attr = array('category_id'=>$category_id,'name_id'=>$name_id,'type'=>$aSpecName['type'], 'sort'=>$i,'status'=>1);
                $this->insert_string($data_attr);
            }
            //-spec_attr

            /*//spec_attr_val 所有分类共用同一规格
            if(!empty($a['val'])){
                $arrVal = explode(',', $a['val']);
                $ii = 0;
                foreach ($arrVal as $i_sort => $v) {
                    $ii++;
                    $val_id = array_search($v,$aWordList);
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
            }
            //-spu_attr_val*/
        }

        //不开启
        $strName_id = trim($strName_id,',');
        if(!empty($strName_id)){
            $strWhere = "category_id=$category_id and name_id not in($strName_id)";
            M('Spec')->update_by_where($strWhere,array('status'=>2));
        }

        $key = 'prd_spec_val:'.$category_id;
        dkcache($key);
    }

    public function delData($category_id, $name_id){
        $arrWhere = array('category_id'=>$category_id,'name_id'=>$name_id);
        $this->update_by_where($arrWhere,array('status'=>-1));

        $key = 'prd_spec_val:'.$category_id;
        dkcache($key);
    }

}