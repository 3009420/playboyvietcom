<?php
// Admin_IndexController de tranh trung hop voi IndexController cua module default
class User_IndexController extends Zend_Controller_Action{
    public function init(){
    	$objSeo= new HT_Model_administrator_models_seo();
    	$seo = $objSeo->getKeyword();
    	if(is_array($seo) && sizeof($seo)>0){
    		$this->view->headTitle($seo['tag_title']);
    		$this->view->headMeta()->setName('og:title',$seo['tag_title']);
    		$this->view->headMeta()->setName('description',$seo['tag_description']);
    	}
    }
    public function indexAction(){
     	$objUser 		= new HT_Model_administrator_models_user();
     	$do 			= $this->_request->getParam('do');
     	$username 		= $this->_request->getParam('username');
     	$password 		= $this->_request->getParam('password');
     	if($do ==='login'){
     		$user = $objUser->login($username, $password);
     		if(is_array($user) && sizeof($user)>0){
	     		$auth = Zend_Auth::getInstance();
	     		$auth->getStorage()->write((object)$user);
	            $this->_redirect(WEB_PATH."/administrator/");
     		}
     	}
    }    
    
    public function logoutAction(){
    	$auth    = Zend_Auth::getInstance();
    	$user    = $auth->getStorage()->read();
    	$auth->clearIdentity();
    	$this->_redirect(WEB_PATH);
    }
}
?>