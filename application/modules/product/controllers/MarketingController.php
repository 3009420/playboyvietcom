<?php
	class Product_MarketingController extends Zend_Controller_Action{
		public function init(){
			$objSeo= new HT_Model_administrator_models_seo();
			$objNote = new HT_Model_administrator_models_note();
			
			$seo = $objSeo->getKeyword();
			if(is_array($seo) && sizeof($seo)>0){
				$this->view->headTitle($seo['tag_title']);
				$this->view->headMeta()->setName('og:title',$seo['tag_title']);
				$this->view->headMeta()->setName('description',$seo['tag_description']);
			}
			
			$this->view->notes = $objNote->getmarketingNotes(6);
		}
		public function indexAction(){

		}
		
		public function marketing2Action(){
			
		}
		public function marketing3Action(){

		}
		
		public function marketing4Action(){

				
		}
		public function marketing5Action(){
			
		}
		
		public function marketing6Action(){
			die();	
		}
}
		

?>