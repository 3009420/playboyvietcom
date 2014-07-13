<?php
	class Hardware_IndexController extends Zend_Controller_Action{
		public function init(){
			$objSeo= new HT_Model_administrator_models_seo();
			$seo = $objSeo->getKeyword();
			if(is_array($seo) && sizeof($seo)>0){
				$this->view->headTitle($seo['tag_title']);
				$this->view->headMeta()->setName('og:title',$seo['tag_title']);
				$this->view->headMeta()->setName('description',$seo['tag_description']);
			}
			
			$objNote = new HT_Model_administrator_models_note();
			$this->view->notes = $objNote->getbackofficeNotes(9);
		}
		public function indexAction(){

		}
		
		public function hardware2Action(){
						
		}
		public function hardware3Action(){
			
		}
		public function hardware4Action(){
						
		}
}
		

?>