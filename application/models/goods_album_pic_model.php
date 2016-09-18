<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods_Album_Pic_model extends XT_Model {

	protected $mTable = 'goods_album_pic';
	
	public function delete_album($id)
	{
	    $where['album_id'] = $id;
	    $list = $this->Goods_Album_Pic_model->get_list($where,'album_id');
	    $album_id = array();
	    foreach ($list as $key => $value)
	    {
	        $album_id[] = $value['album_id'];
	        $album_id = array_unique($album_id);
	    }
	    $awhere['id'] = $album_id;
	    $album = $this->Goods_Album_model->get_list($awhere);
	    $album_list = array();
	    foreach ($album as $key=>$value)
	    {
	        $album_list[$value['id']] = $value;
	    }
	    foreach ($id as $key => $value)
	    {
	        if (in_array($value,$album_id))
	        {
	            echo '相册<strong>'.$album_list[$value]['name'].'</strong>中还有图片，无法删除<br />';
	        }
	        else
	        {
	            if ($this->Goods_Album_model->delete_by_id($value))
	            {
	                echo '相册<strong>'.$album_list[$value]['name'].'</strong>删除成功<br />';
	            }
	            else
	            {
	                echo '删除失败';
	            }
	        }
	    }
	}
	
}
