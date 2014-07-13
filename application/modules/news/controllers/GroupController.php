<?php
    include "application/modules/news/models/class.convert.utf8.php";
    class News_GroupController extends Zend_Controller_Action {
        protected $_user;
        protected $_conver; 
        public function init() {
            $this->_user        = new HT_Model_user_models_user();
            $this->_conver 		= new Convert();
           // echo "<pre>"; print_r($this->_getAllParams()); //die();
        }

        public function indexAction() {
        	$objSeogroup 		= new HT_Model_administrator_models_seogroup();
        	$groupId 			= $this->_request->getParam('group_id',0);
        	if(!$groupId){
        		$groupId 		= $objSeogroup->getRandomGroupId();
        	}
        	
        	$group 				= $objSeogroup->getSeogroup($groupId,array('getRelatedNews'=>true));
        	$tag_title			= ucfirst($group['tag_title']);
        	$tag_description	= ucfirst($group['tag_description']);
        	
        	// for SEO
        	$this->view->headTitle($tag_title);
        	$this->view->headMeta()->setName('og:title',$tag_title);
        	$this->view->headMeta()->setName('description',$tag_description);
        	// End for SEO
        	
        	$this->view->group 	= $group;
        	
        }
        
        public function suggestAction(){
        	$objSeogroup = new HT_Model_administrator_models_seogroup();
        	$objSeogroup->suggestGroup(500,3);
        	die();
        }
  }
?>