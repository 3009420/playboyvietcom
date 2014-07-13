<?php
	class Product_BackofficeController extends Zend_Controller_Action{
		public function init(){
			$objSeo= new HT_Model_administrator_models_seo();
			$seo = $objSeo->getKeyword();
			if(is_array($seo) && sizeof($seo)>0){
				$this->view->headTitle($seo['tag_title']);
				$this->view->headMeta()->setName('og:title',$seo['tag_title']);
				$this->view->headMeta()->setName('description',$seo['tag_description']);
			}
			
			$objNote = new HT_Model_administrator_models_note();
			$this->view->notes = $objNote->getbackofficeNotes(4);
		}
		public function indexAction(){
			
		}
		
		public function backoffice2Action(){
			
		}
		public function backoffice3Action(){
		}
		
		public function backoffice4Action(){
				
		}
		public function backoffice5Action(){
			
		}
		
		public function backoffice6Action(){
				
		}
		
		public function backoffice7Action(){
			die();
		}
}
?>