<?php

class Administrator_AdsController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        $page = addslashes(trim($this->_request->getParam("page")));
        $vitri = addslashes(trim($this->_request->getParam("vitri")));
        $objAds = new HT_Model_administrator_models_ads();
        $listAds = $objAds->loadAds($page, $vitri);
        $this->view->page = $page;
        $this->view->viTri = $vitri;
        $this->view->listAds = $listAds;
    }

    public function deladsAction() {
        $adsId = addslashes(trim($this->_request->getParam("adsId")));
        $page = addslashes(trim($this->_request->getParam("page")));
        $vitri = addslashes(trim($this->_request->getParam("vitri")));
        $objAds = new HT_Model_administrator_models_ads();
        $objAds->delAds($adsId);
        $this->_redirect(WEB_PATH . 'administrator/ads?page=' . $page . '&vitri=' . $vitri);
    }

    public function lockadsAction() {
        $adsId = addslashes(trim($this->_request->getParam("adsId")));
        $page = addslashes(trim($this->_request->getParam("page")));
        $vitri = addslashes(trim($this->_request->getParam("vitri")));
        $status = addslashes(trim($this->_request->getParam("status")));
        $obj = new HT_Model_administrator_models_ads();
        $obj->lockAds($adsId, $status);
        $this->_redirect(WEB_PATH . 'administrator/ads?page=' . $page . '&vitri=' . $vitri);
    }

    public function addnewAction() {
        $page = addslashes(trim($this->_request->getParam("page")));
        $vitri = addslashes(trim($this->_request->getParam("vitri")));
        if ($this->_request->getParam("btn") != null) {
            $adsDes = addslashes(trim($this->_request->getParam("adsDes")));
            $adsFrame = stripslashes($this->_request->getParam("adsFrame"));
            $dateEndte = addslashes(trim($this->_request->getParam("dateEnd")));
            $dateEnd = date('Y:m:d', strtotime($dateEndte));
            $startDate = Date("Y:m:d");
            $data=array();
            $data["adsDescription"]=$adsDes;
            $data["adsFrame"]=$adsFrame;
            $data["adsDateEnd"]=$dateEnd;
            $data["adsDateStart"]=$startDate;
            $data["adsPage"]=$page;
            $data["adsViTri"]=$vitri;
        
            $obj = new HT_Model_administrator_models_ads();
            $obj->addnew($data);
            $this->_redirect(WEB_PATH . 'administrator/ads?page=' . $page . '&vitri=' . $vitri);
        }
    }

    public function editAction() {
        $adsId = addslashes(trim($this->_request->getParam("adsId")));
        $page = addslashes(trim($this->_request->getParam("page")));
        $vitri = addslashes(trim($this->_request->getParam("vitri")));
        $obj = new HT_Model_administrator_models_ads();
        $this->view->data = $obj->loadDataEdit($adsId);
        if ($this->_request->getParam("btn") != null) {
            $adsDes = addslashes(trim($this->_request->getParam("adsDes")));
            $adsFrame = stripslashes($this->_request->getParam("adsFrame"));
            $dateEndte = addslashes(trim($this->_request->getParam("dateEnd")));
            $dateEnd = date('Y:m:d', strtotime($dateEndte));
            $data=array();
            $data["adsDescription"]=$adsDes;
            $data["adsFrame"]=$adsFrame;
            $data["adsDateEnd"]=$dateEnd;
            $obj->updateAds($adsId,$data);
            $this->_redirect(WEB_PATH . 'administrator/ads?page=' . $page . '&vitri=' . $vitri);
        }
    }

}
