<?php

class HT_Model_administrator_models_ads extends Zend_Db_Table {

    protected $_db;

    public function __construct() {
        $this->_name = "tblads";
        $this->_db = Zend_Registry::get('dbMain');
        parent::init();
    }

    public function loadAds($page, $vitri) {
        $sql = "SELECT * FROM `tblads` WHERE `adsPage`='" . $page . "' AND `adsViTri`='" . $vitri . "'";
        $result = $this->_db->query($sql);
        return $result->fetchAll();
    }

    public function delAds($adsID) {
        $sql = "DELETE FROM `tblads` WHERE `adsId`='" . $adsID . "'";
        $this->_db->query($sql);
    }

    public function lockAds($adsId, $status) {
        $sql = "UPDATE `tblads` SET `adsStatus`='" . $status . "' WHERE `adsId`='" . $adsId . "'";
        $this->_db->query($sql);
    }

    public function addnew($data) {
        /* $sql = "INSERT INTO `tblads`(`adsDescription`,`adsFrame`,`adsDateStart`,`adsDateEnd`,`adsPage`,`adsViTri`)" .
          "VALUES('" . $adsDes . "','" . $adsFrame . "','" . $startDate . "','" . $dateEnd . "','" . $page . "','" . $vitri . "')";
          $this->_db->query($sql); */
        $this->insert($data);
    }

    public function loadDataEdit($adsId) {
        $sql = "SELECT * FROM `tblads` WHERE `adsId`='" . $adsId . "'";
        $result = $this->_db->query($sql);
        return $result->fetch();
    }

    public function updateAds($adsId, $data) {
        /*$sql = "UPDATE `tblads` SET `adsDescription`='" . $adsDes . "',`adsFrame`='" . $adsFrame . "',`adsDateEnd`='" . $dateEnd . "' WHERE `adsId`='" . $adsId . "'";
        $this->_db->query($sql);*/
        $this->update($data, "adsId=".(int)$adsId);
    }

}
