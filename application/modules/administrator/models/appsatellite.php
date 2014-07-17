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
		$nameapp = $data['nameapp'];
		$image_thumbnail = $data['image_thumbnail'];
		if($nameapp!=''){
			$this->insert($data);
			return $this->getMaxId();
		}else{
			return "-1";
		}
	}
	
	public function updateData($data,$id){
		$nameapp = $data['nameapp'];
		$image_thumbnail = $data['image_thumbnail'];
		if($nameapp!=''){
			$this->update($data,'id = '.(int)$id);
			return $id;
		}else{
			return "-1";
		}
	}

	private function _checkExistsName($key,$appsatelliteId = null){
		$objUtil 	= new HT_Model_administrator_models_utility();
		if($appsatelliteId >0){
			$sql 		= "SELECT COUNT(id) FROM appsatellite WHERE nameapp = ? AND id <> ?";
			return $this->_db->fetchOne($sql,array($key,$appsatelliteId));
		}else{
			$sql 		= "SELECT COUNT(id) FROM appsatellite WHERE nameapp = ?";
			return $this->_db->fetchOne($sql,array($key));
		}
	}
	
	public function getMaxId(){
		$sql = "SELECT MAX(id) FROM appsatellite";
		return  (int)$this->_db->fetchOne($sql);
	}
	public function getAppsatellite($appsatelliteId,$filter = array()) {
		$sql = " SELECT * FROM appsatellite WHERE id= ".(int)$appsatelliteId;
		return $this->_db->fetchRow($sql);
	}
	public function getListAppsatellite_nb($filter = array()) {
		$sqlPlus = $this->getListAppsatellite_sqlPlus($filter);
		$sql = "SELECT COUNT(id)
				FROM appsatellite
				WHERE 1=1 $sqlPlus";
		return $this->_db->fetchOne($sql);
	}
	
	public function getAppsatellitejoihcontendetail($appsatelliteId,$filter = array()) {
		$sql = " SELECT contentdetailfull.id,contentdetailfull.src,appsatellite.*
				 FROM appsatellite 
				 INNER JOIN contentdetailfull  ON appsatellite.id = contentdetailfull.idforeign
				 WHERE appsatellite.id= ".(int)$appsatelliteId;
		return $this->_db->fetchAll($sql);
	}
	
	public function getListAppsatellite($start=0,$size = 10,$filter = array()) {
		$sqlPlus = $this->getListAppsatellite_sqlPlus($filter);
		$sql = "SELECT appsatellite.nameapp,appsatellite.title,appsatellite.id,
		               appsatellite.link,appsatellite.image_thumbnail,
		               appsatellite.content_detail
				FROM appsatellite 
				WHERE 1=1 $sqlPlus ORDER BY appsatellite.id ASC LIMIT $start,$size";
		return $this->_db->fetchAll($sql);
	}
	
	private function getListAppsatellite_sqlPlus($filter){
		$sqlPlus = null;
// 		$keyword = trim(@$filter['keyword']);
// 		$keyword = addslashes($keyword);
// 		if($keyword){
// 			$sqlPlus .= " AND (appsa.title LIKE '%$keyword%' OR appsa.nameapp LIKE '%$keyword%'  OR appsa.content_detail LIKE '%$keyword%') ";
// 		}
// 		return $sqlPlus;

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
	public function getValueKeyAppsatellite($querry) {
		return $this->_db->fetchOne($querry);
	}
	
	
	public function getHotgirl() 
	{
		$sql = " SELECT appsatellite.id,appsatellite.nameapp,appsatellite.image_thumbnail,appsatellite.content_detail
				 FROM appsatellite
				 WHERE  appsatellite.nameapp = 'igirlxinhcom' and appsatellite.id ORDER BY RAND()";
		return $this->_db->fetchAll($sql);
	}
	
	public function getHotnewgirl()
	{
		$sql = " SELECT appsatellite.id,appsatellite.nameapp,appsatellite.image_thumbnail,appsatellite.content_detail
				 FROM appsatellite
				 WHERE  appsatellite.nameapp = 'phototamtayvn' and appsatellite.id ORDER BY RAND()";
		return $this->_db->fetchAll($sql);
	}
	
	public function getHotgirlId($Id)
	{
		$sql = " SELECT contentdetailfull.id,contentdetailfull.src,appsatellite.nameapp,appsatellite.image_thumbnail,appsatellite.content_detail
				 FROM appsatellite
				 INNER JOIN contentdetailfull  ON appsatellite.id = contentdetailfull.idforeign
				 WHERE appsatellite.id= ".(int)$Id;//. " AND appsatellite.nameapp = 'igirlxinhcom'";
		return $this->_db->fetchAll($sql);
	}
	
}

?>
