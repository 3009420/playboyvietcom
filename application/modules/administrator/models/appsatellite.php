<?php

/*
 * To change this template, choose Tools | Templates
* and open the template in the editor.
*/

class HT_Model_administrator_models_appsatellite extends Zend_Db_Table {//ten class fai viet hoa

	protected $_db;

	public function __construct() {
		$this->_name = "appsatellite";
		$this->_db = Zend_Registry::get('dbMain');
		parent::init();
	}
	
	public function addData($data){
		$groupName = $data['group_name'];
		if(!$this->_checkExistsName($groupName)){
			$this->insert($data);
			return $this->getMaxId();
		}else{
			return "-1";
		}
	}
	
	public function updateData($data,$notegroupId){
		$groupName = $data['group_name'];
		if(!$this->_checkExistsName($groupName,$notegroupId)){
			$this->update($data,'group_id = '.(int)$notegroupId);
			return $appsatelliteId;
		}else{
			return "-1";
		}
	}

	private function _checkExistsName($key,$appsatelliteId = null){
		$objUtil 	= new HT_Model_administrator_models_utility();
		if($appsatelliteId >0){
			$sql 		= "SELECT COUNT(group_id) FROM note_group WHERE group_name = ? AND group_id <> ?";
			return $this->_db->fetchOne($sql,array($key,$appsatelliteId));
		}else{
			$sql 		= "SELECT COUNT(group_id) FROM note_group WHERE group_name = ?";
			return $this->_db->fetchOne($sql,array($key));
		}
	}
	
	public function getMaxId(){
		$sql = "SELECT MAX(group_id) FROM note_group";
		return  (int)$this->_db->fetchOne($sql);
	}
	public function getAppsatellite($appsatelliteId,$filter = array()) {
		$sql = " SELECT * FROM note_group WHERE group_id= ".(int)$appsatelliteId;
		return $this->_db->fetchRow($sql);
	}
	public function getListAppsatellite_nb($filter = array()) {
		$sqlPlus = $this->getListAppsatellite_sqlPlus($filter);
		$sql = "SELECT COUNT(ngr.group_id)
				FROM note_group ngr
				WHERE 1=1 $sqlPlus";
		return $this->_db->fetchOne($sql);
	}
	public function getListAppsatellite($start=0,$size = 10,$filter = array()) {
		$sqlPlus = $this->getListAppsatellite_sqlPlus($filter);
		$sql = "SELECT ngr.*
				FROM note_group ngr
				WHERE 1=1 $sqlPlus ORDER BY ngr.group_order DESC,ngr.group_name ASC LIMIT $start,$size";
		return $this->_db->fetchAll($sql);
	}
	
	private function getListAppsatellite_sqlPlus($filter){
		$sqlPlus = null;
		$keyword = trim(@$filter['keyword']);
		$keyword = addslashes($keyword);
		if($keyword){
			$sqlPlus .= " AND (ngr.group_name LIKE '%$keyword%' OR ngr.description LIKE '%$keyword%') ";
		}
		return $sqlPlus;
	}
	public function getValueKeyAppsatellite($querry) {
		return $this->_db->fetchOne($querry);
	}
	
}

?>
