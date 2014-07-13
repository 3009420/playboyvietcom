<?php
class News_IndexController extends Zend_Controller_Action {
	public function init() {

	}

	public function indexAction() {
		 // Search function
	}
	
	public function categoryAction(){
		$objNews 	= new HT_Model_administrator_models_news();
		$categoryId	= $this->_request->getParam('id');
		if($categoryId > 0){
			$categoryNews 				= $objNews->getCategoryNews($categoryId);
			$category					= $categoryNews['category'];
			$title						= stripslashes($category['category_name']);
			$description				= stripslashes($category['description']);
			 
			// for SEO
			$this->view->headTitle($title);
			$this->view->headMeta()->setName('og:title',$title);
			$this->view->headMeta()->setName('description',$description);
			// End for SEO
			
			$this->view->categoryNews 	= $categoryNews;
		}else{
			$this->_redirect(WEB_PATH);
		}
	}
	
	public function groupAction(){
		$objNews 	= new HT_Model_administrator_models_news();
		$groupId	= $this->_request->getParam('id');
		if($groupId > 0){
        	$groupNews 	= $objNews->getGroupNews($groupId);
        	
        	$group			= $groupNews['group'];
        	$title			= stripslashes($group['group_name']);
        	$description	= stripslashes($group['description']);
        	
        	// for SEO
        	$this->view->headTitle($title);
        	$this->view->headMeta()->setName('og:title',$title);
        	$this->view->headMeta()->setName('description',$description);
        	// End for SEO
        	
        	
        	$this->view->groupNews = $groupNews;
		}else{
			$this->_redirect(WEB_PATH);
		}
	}

	public function detailAction(){
		$objNews 	= new HT_Model_administrator_models_news();
		$newsId		= $this->_request->getParam('id');
		$info 		= $objNews->getDetailNews($newsId);
		
		$news			= $info['news'];
		$title			= stripslashes($news['title']);
		$description	= stripslashes($news['description']);
		
		// for SEO
		$this->view->headTitle($title);
		$this->view->headMeta()->setName('og:title',$title);
		$this->view->headMeta()->setName('description',$description);
		// End for SEO
		
		$this->view->info = $info;
	}
	
	public function seoAction(){
		$objSeopage 		= new HT_Model_administrator_models_seopage();
		 
		$seopageId  		= (int)$this->_request->getParam('seopage_id');
		$seo				= $objSeopage->getSeopage($seopageId,array('getRelatedNews'=>true,'getOtherNews'=>false));
		$newsId				= (int)$seo['reference_news_id'];
		$tagTitle			= ucfirst(trim($seo['tag_title']));
		 
		$comments			= $this->getAutoComments($tagTitle);
		if($newsId >0){
			$this->getOriginalNews($newsId,$tagTitle);
			$objSeopage->updateVisisted($seopageId);
		}
		$this->view->seo    		= $seo;
		$this->view->comments    	= $comments;
	}
	
	public function getAutoComments($keyword){
		$objSeocomment 		= new HT_Model_administrator_models_seocomment();
		$objComments 		= new HT_Model_administrator_models_comments();
		$objUser 			= new HT_Model_administrator_models_user();
		 
		$limit				= rand(5,12);
		 
		$users				= $objUser->getRandomUsers($limit);
		$comments			= $objSeocomment->getSeoComments($limit);
		$sysUserName = null;
	
		$data		= '<div class="cmm_title">Bình luận của thành viên</div>';
		$currentTimt	= time();
		for($i=0; $i <sizeof($comments);$i++){
			$cm 			= $comments[$i];
			$user 			= $users[$i];
			$fullName		= trim(ucfirst($user['firstname'].' '.$user['lastname']));
			$comment 		= $cm['comment'];
			$comment		= str_replace('__keyword__', '<i>'.$keyword.'</i>', $comment);
			if($fullName) $data .= '<div class="cmm_box"><span>'.$fullName.': </span>'.$comment.'</div>';			
			
		}
		return $data;
	}
	
	private function getOriginalNews($newsId,$tagTitle){
		$this->view->headMeta()->setName('robots', 'INDEX,FOLLOW');
		$this->view->headMeta()->setName('og:title',$tagTitle);
		
		$objNews 			= new HT_Model_administrator_models_news();
		$info 				= $objNews->getDetailNews($newsId);
		$this->view->info 	= $info;
	}

}
?>