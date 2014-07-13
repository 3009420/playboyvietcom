<?php
include "application/modules/news/models/class.convert.utf8.php";
    class News_ElementsController extends Zend_Controller_Action {
        protected $_user;
        public function init() {
            $this->_user        = new HT_Model_user_models_user();
        }

        public function shareWishAjaxAction() {
            $auth                       = Zend_Auth::getInstance();
            $user                       = $auth->getStorage()->read();
            $user_info                  = $this->_user->getUserInfo($user->user_name);
            $user_name                  = $user->user_name;
            
            $id                 = $this->_request->getParam('id', 0);
            $comment            = $this->_request->getParam('comment', false);
            $pageS            = $this->_request->getParam('pageS', false);
            $modelNews = new HT_Model_news_models_news();
            $modelPost = new HT_Model_home_models_Post();
            $modelComment = new HT_Model_home_models_Comment();
            
            $InfoNews = $modelNews->find($id)->toArray();
            $shareCurrent = $InfoNews[0]['share_wish'];
            if($InfoNews != NULL){
                $title = $InfoNews[0]['title_vn'];
                $link = $this->_request->getParam('link', "");
                $desc = $InfoNews[0]['desc_vn'];
                $image = $InfoNews[0]['pictrue'];
                $content = '<p><b>'.$title.'</b></p>';
                $content .= ''.$link.'';
                $modelPost->addPost($user_name,"none",$content,"",'public',0);
                $post_id                        = $modelPost->getAdapter()->lastInsertId();
                if($comment != NULL){
                    $modelComment->addComment($user_name,$post_id,$comment,1,'public');
                }
                
            }
            if($pageS == "news"){
                $shareAdd = $shareCurrent + 1;
                $modelNews = new HT_Model_administrator_models_news();
                $modelNews->update(array("share_wish"=>$shareAdd), "id_news = $id");
            }
            echo 1; die;
        }

    }

?>