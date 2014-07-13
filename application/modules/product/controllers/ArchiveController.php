<?php
	class Product_ArchiveController extends Zend_Controller_Action{
		public function init(){
			$objSeo= new HT_Model_administrator_models_seo();
			$seo = $objSeo->getKeyword();
			if(is_array($seo) && sizeof($seo)>0){
				$this->view->headTitle($seo['tag_title']);
				$this->view->headMeta()->setName('og:title',$seo['tag_title']);
				$this->view->headMeta()->setName('description',$seo['tag_description']);
			}
			
			$objNote = new HT_Model_administrator_models_note();
			$this->view->notes = $objNote->getarchiveNotes(7);
		}
		public function indexAction(){
			
		}
		
		public function archive2Action(){
			
		}
		public function archive3Action(){
			
		}
		
		public function archive4Action(){
		}
}
?>