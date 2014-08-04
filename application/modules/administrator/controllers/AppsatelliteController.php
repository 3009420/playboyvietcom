<?php
class Administrator_AppsatelliteController extends Zend_Controller_Action
{
	public function init() {
		
		
	}
	
	public function indexAction(){
		$objUtil = new HT_Model_administrator_models_utility();
		$do = @$this->_request->getParam('do');
		$id = (int)$this->_request->getParam('id');
		
		if($do == 'delete' && $id >0){
			$this->deleteAppsatellite($id);
		}elseif($do == 'list'){
			$this->getListAppsatellite();
		}else{
			$keyword 				= $this->_request->getParam('keyword');
			$this->view->keyword 	= $keyword;
		}
		$this->view->appsatelliteGroup = $objUtil->GetCombobox('nameapp','appsatellite_nameapp','nameapp','catalogue_group',array('cssClass'=>'form-control','isBlankVal'=>'no'));
		
		$this->view->inlineScript()->appendFile(WEB_PATH.'/application/modules/administrator/views/scripts/appsatellite/index.js');
	}
	
	public function updateAction(){
		$objAppsatellite = new HT_Model_administrator_models_appsatellite();
		$objUtil 	= new HT_Model_administrator_models_utility();
		$do 		 = @$this->_request->getParam('do');
		$id 		= (int)$this->_request->getParam('id');
		$status 	= (int)$this->_request->getParam('status');
		if($do == 'submit'){
			//var_dump($_FILES['srcimgaes']);die;
			$data = array();
			$data['nameapp'] 		= $this->_request->getParam('nameapp');
			$data['content_detail'] 		= $this->_request->getParam('description');
			//$datacontentdetail['comment_content'] 	= $this->_request->getParam('comment_content');
			$image = $objUtil->uploadFile('srcimgaes',NEWS_IMAGE_PATH,MAX_IMAGE_FILE_SIZE,IMAGE_TYPE_ALLOW);
			if(!in_array($image,array(1,2,3,4))){
				$data['image_thumbnail'] = $image;
			}
			if($delete_image) $data['image_thumbnail'] = null;
			
			
			
// 			echo "</br>namne view </br>";
// 			var_dump($image);
			
// 			var_dump($data);
// 			die;
			
			
			if($id >0){
				
				$idupdate = $objAppsatellite->updateData($data,(int)$id);
				if($idupdate === $id) {$status = 1;}else $status = -1;
			}else{
				//echo $data['content_detail'];die;
				$idadd = $objAppsatellite->addData($data);
				if($idadd) {$status = 1;}else $status = -1;
			}

			if($status > 0){
				//$this->_redirect(WEB_PATH.'/administrator/appsatellite');
				$this->_redirect(WEB_PATH.'/administrator/appsatellite/update?status='.$status.'&id='.$idadd);
			}else{
				$redirectLink = WEB_PATH."/administrator/appsatellite/update?status=$status";
				if($id >0) $redirectLink .= "&id=$id";
				$this->_redirect($redirectLink);
			}
		}elseif($id >0){
			$appsatellite				= $objAppsatellite->getAppsatellite($id);
		
			$this->view->appsatellite = $appsatellite;
		}
		$this->view->id 		= $id;
		$this->view->status 	= $status;
		$this->view->image = $image;
		$disabled ="";//$disabled ="disabled";
		$this->view->contentdetailfullGroup = $objUtil->GetComboboxvalue('nameapp','id','nameapp','appsatellite',array('cssClass'=>'form-control','isBlankVal'=>'no','defaultValue'=>'','disabled'=>$disabled));
		
		$this->view->inlineScript()->appendFile(WEB_PATH.'/application/modules/administrator/views/scripts/appsatellite/update.js');
	}

	public function readviewdetailAction()
	{
		$ReadJson = new Zend_Session_Namespace('ReadJson');
		$ReadJson->setExpirationSeconds(604800);
		$ReadJson->namefile = "readJson";//rand(10, 999999);

       //var_dump($ReadJson->namefile);die;

		
		$objAppsatellite = new HT_Model_administrator_models_appsatellite();
		$id 		= (int)$this->_request->getParam('id');
		if($id == 0) $this->_redirect(WEB_PATH.'/administrator/appsatellite');
		$appsatellitedetailread				= $objAppsatellite->getAppsatellitejoihcontendetail($id);
		$this->view->appsatellitedetailread = $appsatellitedetailread;
		/*
		// Lưu tin đã lấy vào file cache
		$path = ROOT_PATH . '/public/cache/'.$ReadJson->namefile.'cache.php';
		$content = '<?php $appsatellitedetailread = ' . var_export ( $appsatellitedetailread, true ) . ';?>';
		$handler = fopen ( $path, 'w+' );
		fwrite ( $handler, $content );
		fclose ( $handler );
		*/
		
		$path = ROOT_PATH . '/public/cache/'.$ReadJson->namefile.'.json';
		$content = '{"Messages":'.json_encode($appsatellitedetailread,true).'}';
		$handler = fopen ( $path, 'w+' );
		fwrite ( $handler, $content );
		fclose ( $handler );
		
// 		echo Zend_Json::encode($appsatellitedetailread);
		
// 		exit();

        $this->view->namefile = $ReadJson->namefile;
		
// 		$this->view->appsatellitedetailread = $appsatellitedetailread;
// 		$this->view->inlineScript()->appendFile(WEB_PATH.'/application/modules/administrator/views/scripts/appsatellite/readviewdetail.js');

       //$this->view->inlineScript()->appendFile(WEB_PATH.'/application/modules/administrator/views/scripts/appsatellite/readviewdetail.js');
	}
	
	
	function deleteAppsatellite($id){
		$objAppsatellite = new HT_Model_administrator_models_appsatellite();
		echo $objAppsatellite->delete("id=".(int)$id);die();
	}

	function getListAppsatellite(){
		$ajaxData = null;
        $objUtil 		= new HT_Model_administrator_models_utility();
		$objAppsatellite 		= new HT_Model_administrator_models_appsatellite();
		$keyword 		= trim($this->_request->getParam('keyword'));
		$page 			= (int)$this->_request->getParam('page');
		$nameapp 		= (string)$this->_request->getParam('nameapp');
		$size 			= PAGING_SIZE;
		if (!is_numeric($page) || $page <= 0) {
			$page = 1;
		}
		$start = $page * $size - $size;
		$filter = array();
		if($keyword) $filter['keyword'] = $keyword;
		if($nameapp) $filter['nameapp'] = $nameapp;
		
		$totalRecord = $objAppsatellite->getListAppsatellite_nb($filter);
		$listAppsatellite = $objAppsatellite->getListAppsatellite($start,$size,$filter);
		$paging = trim($objUtil->paging($page, $size, $totalRecord));
		
		$ajaxData = '<table cellspacing="0" class="table">';
		$ajaxData .= '<thead>';
			$ajaxData .= '<tr>';
				$ajaxData .= '<th width="10">No</th>';
				$ajaxData .= '<th width="50">Title</th>';
				$ajaxData .= '<th width="100">Image</th>';
				$ajaxData .= '<th width="30">Content Detail</th>';
				$ajaxData .= '<th width="20">Nameapp</th>';
				$ajaxData .= '<th width="50">#</th>';
			$ajaxData .= '</tr>';
		$ajaxData .= '</thead>';
		$http   = 'http';
		$i=0;
		$arrGroup = array();$addN = -1;
		foreach($listAppsatellite as $cfg){
			$i++;
			$trClass = null;
			if($cfg['title'] =="igirlxinhcom") {$nameview ="Hot girl";}
			if($cfg['title'] =="phototamtayvn") {$nameview ="New hot girl";}
			if ( (strpos($cfg['image_thumbnail'],$http )=== false) and ($cfg['image_thumbnail'] != "")) { $src= WEB_PATH.'/public/uploads/news/'.$cfg['image_thumbnail'];}
			if ((strpos($cfg['image_thumbnail'],$http )=== 0 ) and ($cfg['image_thumbnail']!= "")) { $src= $cfg['image_thumbnail'];}
			
			if($i%2 == 1) $trClass = ' class="altrow"';
			$ajaxData .= '<tr id="'.$cfg['id'].'" '.$trClass.'>';
			$ajaxData .= '<td align="center">'.$i.'</td>';
			$ajaxData .= '<td>'.$nameview.'</td>';
			$ajaxData .= '<td><img src="'.$src.'" style="wieght:100px;height:100px;"</td>';
			$ajaxData .= '<td>'.$cfg['content_detail'].'</td>';
			$ajaxData .= '<td>'.$cfg['nameapp'].'</td>';
			$ajaxData .= '<td style="white-space: nowrap" align="center">';
			$ajaxData .= '<a class="btn btn-primary" style="padding: 0px 3px;"  href="'.WEB_PATH.'/administrator/appsatellite/readviewdetail/?id='.$cfg['id'].'" title="Read/view detail"><i class="icon-book"></i></a>|
					     <a class="btn btn-xs"  href="'.WEB_PATH.'/administrator/appsatellite/update/?id='.$cfg['id'].'" title="Edit"><i class="icon-edit"></i></a>|<a class="btn btn-danger btn-xs"  href="#" onclick="deleteAppsatellite('.$cfg['id'].')" title="Delete"><i class="icon-trash"></i></a>|<a class="btn btn-primary" style="padding: 0px 3px;"  href="'.WEB_PATH.'/administrator/contentdetailfull/update/?id='.$addN.'&foreign='.$cfg['id'].'" title="Add new detail"><i class="icon-plus "></i></a>|';
	
			$ajaxData .= '</td>';
			$ajaxData .= '</tr>';
		}
		$ajaxData .= '</tbody>';
		$ajaxData .= '</table>';
		$title="HotGirls All";
		echo $objUtil->renderData($title,$ajaxData,$paging);die();
	}
}
