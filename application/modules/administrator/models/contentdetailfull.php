<?php

/*
 * To change this template, choose Tools | Templates
* and open the template in the editor.
*/

class HT_Model_administrator_models_contentdetailfull extends Zend_Db_Table {//ten class fai viet hoa

	protected $_db;

	public function __construct() {
		$this->_name = "contentdetailfull";
		$this->_db = Zend_Registry::get('dbMain');
		parent::init();
	}
	
	public function getContentdetailfullByKey($key){
		$key 		= addslashes(strtolower(trim($key)));
		$sql 		= "SELECT src FROM contentdetailfull WHERE id = ? ORDER BY id LIMIT 1";
		return $this->_db->fetchOne($sql,array($key));
	}
	
	public function addData($data){
		//return $data;
		$srcimgaes = $data['src'];
		$idforeign = $data['idforeign'];
		
		if($srcimgaes!=""){
			$this->insert($data);
			return $this->getMaxId();
		}else{
			return "-1";
		}
	}
	
	public function updateData($data,$Id){
		$srcimgaes = $data['src'];
		if($srcimgaes !=''){
			$this->update($data,'id = '.(int)$Id);
			return $Id;
		}else{
			return "-1";
		}
	}

	private function _checkExistsKey($key,$noteId = null){
		$objUtil 	= new HT_Model_administrator_models_utility();
		$key 		= addslashes(strtolower($key));
		if($noteId >0){
			$sql 		= "SELECT id FROM contentdetailfull WHERE src =? AND id <> ? LIMIT 1";
			return $this->_db->fetchOne($sql,array($key,$noteId));
		}else{
			$sql 		= "SELECT id FROM contentdetailfull WHERE src = ? LIMIT 1";
			return $this->_db->fetchOne($sql,array($key));
		}
		
	}
	
	public function getMaxId(){
		$sql = "SELECT MAX(id) FROM contentdetailfull";
		return  (int)$this->_db->fetchOne($sql);
	}
	public function getContentdetailfull($noteId,$filter = array()) {
		$sql = " SELECT * FROM contentdetailfull WHERE id= ".(int)$noteId;
		return $this->_db->fetchRow($sql);
	}
	public function getContentdetailfulljoih($noteId,$filter = array()) {
		$sql = " SELECT * FROM contentdetailfull WHERE idforeign = ".(int)$noteId." ORDER BY id DESC";
		return $this->_db->fetchAll($sql);
	}
	public function getListContentdetailfull_nb($filter = array()) {
		$sqlPlus = $this->getListContentdetailfull_sqlPlus($filter);
		$sql = "SELECT COUNT(contentdetailfull.id)
				FROM contentdetailfull 
				INNER JOIN appsatellite  ON appsatellite.id = contentdetailfull.idforeign
				WHERE 1=1 $sqlPlus";
		return $this->_db->fetchOne($sql);
	}
	
	public function getHomeContentdetailfulls(){
		$sql = "SELECT src,idforeign
				FROM contentdetailfull ";
		return $this->_db->fetchAssoc($sql);
	}
	
	public function getProductContentdetailfulls($idforeign){
		$sql = "SELECT src,idforeign
				FROM contentdetailfull
				Where idforeign =".$idforeign;
		return $this->_db->fetchAssoc($sql);
	}
	
	public function getPrixContentdetailfulls($idforeign){
		$sql = "SELECT src,idforeign
				FROM contentdetailfull
				Where idforeign =".$idforeign;
		return $this->_db->fetchAssoc($sql);
	}
	
	public function getsmartphoneContentdetailfulls($idforeign){
		$sql = "SELECT src,idforeign
				FROM contentdetailfull
				Where idforeign =".$idforeign;
		return $this->_db->fetchAssoc($sql);
	}
	
	public function getbackofficeContentdetailfulls($idforeign){
		$sql = "SELECT src,idforeign
				FROM contentdetailfull
				Where idforeign =".$idforeign;
		return $this->_db->fetchAssoc($sql);
	}
	
	public function gettabletteContentdetailfulls($idforeign){
		$sql = "SELECT src,idforeign
				FROM contentdetailfull
				Where idforeign =".$idforeign;
		return $this->_db->fetchAssoc($sql);
	}
	
	public function getmarketingContentdetailfulls($idforeign){
		$sql = "SELECT src,idforeign
				FROM contentdetailfull
				Where idforeign =".$idforeign;
		return $this->_db->fetchAssoc($sql);
	}
	
	public function getarchiveContentdetailfulls($idforeign){
		$sql = "SELECT src,idforeign
				FROM contentdetailfull
				Where idforeign =".$idforeign;
		return $this->_db->fetchAssoc($sql);
	}
	
	public function gettelechargerContentdetailfulls($idforeign){
		$sql = "SELECT src,idforeign
				FROM contentdetailfull
				Where idforeign =".$idforeign;
		return $this->_db->fetchAssoc($sql);
	}
	
	public function getListContentdetailfull($start=0,$size = 10,$filter = array()) {
		$sqlPlus = $this->getListContentdetailfull_sqlPlus($filter);
		$sql = "SELECT contentdetailfull.*,
		               appsatellite.nameapp,appsatellite.title,
		               appsatellite.link,appsatellite.image_thumbnail,
		               appsatellite.content_detail
				FROM contentdetailfull 
				INNER JOIN appsatellite  ON appsatellite.id = contentdetailfull.idforeign
				WHERE 1=1 $sqlPlus ORDER BY contentdetailfull.id ASC LIMIT $start,$size";
		return $this->_db->fetchAll($sql);
	}
	
	private function getListContentdetailfull_sqlPlus($filter){
		$sqlPlus = null;
		foreach((array)$filter as $key => $val){
			$key = trim($key);
			$val = addslashes(trim($val));
			switch($key){
				case 'keyword':
					if($val){
						// Noi bang nhieu truong o day 
						$sqlPlus .= " AND appsatellite.content_detail LIKE '%$val%' OR appsatellite.nameapp LIKE '%$val%' OR appsatellite.title LIKE '%$val%'";
					}
					break;
				case 'nameapp':
					if($val){
						$sqlPlus .= " AND (appsatellite.nameapp LIKE '%$val%' ) "; //OR contentdetailfull.idforeign LIKE '%$val%'
					}
					break;
			}
		}
		return $sqlPlus;
	}
	public function getValueKeyContentdetailfull($querry) {
		return $this->_db->fetchOne($querry);
	}
}

?>
