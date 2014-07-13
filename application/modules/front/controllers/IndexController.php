<?php
	class IndexController extends Zend_Controller_Action{
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
			$objNote = new HT_Model_administrator_models_note();
			$this->view->notes = $objNote->getHomeNotes();
		}
		
		public function home2Action(){
			$objNote = new HT_Model_administrator_models_note();
			$this->view->notes = $objNote->getHomeNotes();
		}
		public function home3Action(){
			//$objNote = new HT_Model_administrator_models_note();
			//$this->view->notes = $objNote->getHomeNotes();
		}
		public function home4Action(){
			$objPKI 		= new HT_Model_administrator_models_packageitem();
			$basicPackage 	= $objPKI->getListPackageitem(0,100,array('package_id'=>1));
			$proPackage 	= $objPKI->getListPackageitem(0,100,array('package_id'=>2));
			
			$this->view->basicPackage 	= $basicPackage;
			$this->view->proPackage 	= $proPackage;
		}
		public function home5Action(){
			//$objNote = new HT_Model_administrator_models_note();
			//$this->view->notes = $objNote->getHomeNotes();
		}
	}
		
?>