<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audit_model extends XT_Model {

	protected $mTable = 'sys_audit';

	public function sysAuditRequest($aAudit) {

		$returnCode = -1;
		if (!empty($aAudit['id'])){
			$data = $aAudit;
			unset($data['id']);
			$this->update_by_id($aAudit['id'],$data);
		}
		else if(!empty($aAudit['item_type']) && !empty($aAudit['item_id'])){
			$aExist = $this->get_by_where(array('item_type'=>$aAudit['item_type'], 'item_id'=>$aAudit['item_id']));
			if(!empty($aExist))
				$this->update_by_id($aExist['id'],$aAudit);
			else{
				$this->insert_string($aAudit);
			}
		}


		/*
		if (!empty($aAudit['id']))
			$aExist = $this->get_by_id($aAudit['id']);
		if (!empty($aExist)) {
			$data['item_type'] = $aExist['item_type'];
			$data['item_id'] = $aExist['item_id'];
			$data['item_type'] = $aExist['item_type'];
			
			sys_AuditModel.setAuditType(entity.getAuditType());
			sys_AuditModel.setAuditItemId(entity.getAuditItemId());
			sys_AuditModel.setUserId(entity.getUserId());
			sys_AuditModel.setPlatformId(entity.getPlatformId());
		} else
			entity = sys_AuditRepo.selectAuditRequest(sys_AuditModel.getAuditType(), sys_AuditModel.getAuditItemId(), sys_AuditModel.getUserId(),
					sys_AuditModel.getPlatformId());
		if (entity != null && entity.getAuditId() != null) {
			returnCode = sys_AuditRepo.updateAuditRequest(beanMapper.map(sys_AuditModel, Sys_Audit.class));
		} else {
			sys_AuditModel = this.createSelective(sys_AuditModel);
			if (sys_AuditModel.getAuditId() != null) {
				returnCode = 1;
			}
		}*/

		return $returnCode;
	}
	
}