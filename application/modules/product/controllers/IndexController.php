<?php
	class Product_IndexController extends Zend_Controller_Action{
		public function init(){
			$objSeo= new HT_Model_administrator_models_seo();
			$seo = $objSeo->getKeyword();
			if(is_array($seo) && sizeof($seo)>0){
				$this->view->headTitle($seo['tag_title']);
				$this->view->headMeta()->setName('og:title',$seo['tag_title']);
				$this->view->headMeta()->setName('description',$seo['tag_description']);
			}
			
			$objNote = new HT_Model_administrator_models_note();
			$this->view->notes = $objNote->getbackofficeNotes(2);
		}
		public function indexAction(){

		}
		
		public function product2Action(){
						
		}
		public function product3Action(){
			
		}
		public function product4Action(){
						
		}
		public function product5Action(){
			
		}
		public function product6Action(){
			
		}
		public function product7Action(){
			
		}
}
		

?>