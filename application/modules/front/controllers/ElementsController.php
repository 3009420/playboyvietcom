<?php
    class ElementsController extends Zend_Controller_Action{
        public function init() {
        	
        }
        
        public function sliderAction(){
        	$objslider = new HT_Model_administrator_models_slider();
        	$this->view->slider = $objslider->getHomeslider();
        }
        
        public function headerAction(){
        
        }
        
        public function topmenuAction(){
        
        }
        public function footerAction(){
        
        }
        public function footeradvAction(){
        
        }
        public function analyticstrackingAction(){
        
        }
        
        public function rightadv1Action(){
        	
        }
        
        public function rightadv2Action(){
        	 
        }
        public function rightadv3Action(){
        
        }
        public function rightadv4Action(){
        
        }
        public function rightadv5Action(){
        
        }
        public function rightadv6Action(){
        
        }

    }
?>