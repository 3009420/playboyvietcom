<?php
	class Minscrire_IndexController extends Zend_Controller_Action{
		public function init(){
			$objSeo= new HT_Model_administrator_models_seo();
			$seo = $objSeo->getKeyword();
			if(is_array($seo) && sizeof($seo)>0){
				$this->view->headTitle($seo['tag_title']);
				$this->view->headMeta()->setName('og:title',$seo['tag_title']);
				$this->view->headMeta()->setName('description',$seo['tag_description']);
			}
		}
		
		public function testAction(){
			$objUtil 	= new HT_Model_administrator_models_utility();
			$return = $objUtil->sendMail("phuca4@gmail.com",'phuc', 'gstearit@gmail.com', 'gui thu', 'dsdsdsdsdsdsdsdsd');
			print_r($return);die();
		}
		public function indexAction(){
			$objNote = new HT_Model_administrator_models_note();
			$objUtil 	= new HT_Model_administrator_models_utility();
			$this->view->notes = $objNote->getHomeNotes();
			
			//var_dump($_POST);
			if ( isset($_POST["email_post"]) and   isset($_POST["First_Name"]) ){
				$autoTitle		= $_POST['autoTitle'];
				$First_Name 	= $_POST['First_Name'];
				$Last_Name      = $_POST['Last_Name'];
				
				$email_post		= $_POST['email_post'];
				$Cellphone	    = $_POST['Cellphone'];
				$Store_Name	    = $_POST['Store_Name'];
				$Password 	    = $_POST['Password'];
				$autoIndustry   = $_POST['autoIndustry'];
				$autoPlan 	    = $_POST['autoPlan'];
				$Address_location   = $_POST['Address_location'];
				$Postal_Code 	    = $_POST['Postal_Code'];
				$autoJob	    = $_POST['autoJob'];
				$autoDemand     = $_POST['autoDemand'];
				
				$subject = 'Register Ezpos.com.au';
				$body  = 'Name : '.$autoTitle.' '.$First_Name .' '.$Last_Name."\r\n <br>";
				$body .= 'Cellphone : '.$Cellphone."\r\n <br>";
				$body .= 'Store Name : '.$Store_Name."\r\n <br>";
				$body .= 'Password : '.$Password."\r\n <br>";
				$body .= 'AutoIndustry: '.$autoIndustry."\r\n <br>";
				$body .= 'AutoPlan : '.$autoPlan."\r\n <br>";
				$body .= 'Address_location : '.$Address_location."\r\n <br>";
				$body .= 'Postal_Code : '.$Postal_Code."\r\n <br>";
				$body .= 'AutoJob: '.$autoJob."\r\n <br>";
				$body .= 'autoDemand :  '.$autoDemand."\r\n <br>";
				
				$return 	= $objUtil->sendMail($email_post,'ezpos.com.au', ADMIN_EMAIL, $subject, $body);
				$errorCode 	= $return['errorCode'];
				$this->_redirect(WEB_PATH.'/minscrire/?status='.$errorCode);
			
			}//end post
		}
		
		public function minscrire2Action(){
			$objPKI 		= new HT_Model_administrator_models_packageitem();
			$basicPackage 	= $objPKI->getListPackageitem(0,100,array('package_id'=>1));
			$proPackage 	= $objPKI->getListPackageitem(0,100,array('package_id'=>2));
			
			$this->view->basicPackage 	= $basicPackage;
			$this->view->proPackage 	= $proPackage;
		}
		public function mail(){
			$objPKI 		= new HT_Model_administrator_models_packageitem();
			$basicPackage 	= $objPKI->getListPackageitem(0,100,array('package_id'=>1));
			$proPackage 	= $objPKI->getListPackageitem(0,100,array('package_id'=>2));
				
			$this->view->basicPackage 	= $basicPackage;
			$this->view->proPackage 	= $proPackage;
		}
		
	}
?>