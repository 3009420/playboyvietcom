<?php
class Administrator_ContentdetailfullController extends Zend_Controller_Action
{
	public function init() {
		
	}
	
	public function indexAction(){
		$objUtil = new HT_Model_administrator_models_utility();
		$do = @$this->_request->getParam('do');
		$id = (int)$this->_request->getParam('id');
		if($do == 'delete' && $id >0){
			$this->deleteContentdetailfull($id);
		}elseif($do == 'list'){
			$this->getListcontentdetailfull();
		}else{
			$keyword 				= $this->_request->getParam('keyword');
			$this->view->keyword 	= $keyword;
		}
		
		
		$this->view->contentdetailfullGroup = $this->view->contentdetailfullGroup = $objUtil->GetCombobox('nameapp','appsatellite_nameapp','nameapp','catalogue_group',array('cssClass'=>'form-control','isBlankVal'=>'no'));
		
		$this->view->inlineScript()->appendFile(WEB_PATH.'/application/modules/administrator/views/scripts/contentdetailfull/index.js');
	}
	
	public function updateAction(){
		$objcontentdetailfull 	= new HT_Model_administrator_models_contentdetailfull();
		$objappsatellite 	= new HT_Model_administrator_models_appsatellite();
		$objUtil 	= new HT_Model_administrator_models_utility();
		$do 		= @$this->_request->getParam('do');
		$id 		= (int)$this->_request->getParam('id');
		$idforeign 		= (int)$this->_request->getParam('foreign');
		
		$delete_image = @$this->_request->getParam('delete_image');
		
		$status 	= (int)$this->_request->getParam('status');
		$groupId	= null;
		if($do == 'submit'){
			$datacontentdetail = array();
			$datacontentdetail['idforeign'] 		    = $_POST['idforeign'];
			//$datacontentdetail['comment_content'] 	= $this->_request->getParam('comment_content');
			$image = $objUtil->uploadFile('srcimgaes',NEWS_IMAGE_PATH,MAX_IMAGE_FILE_SIZE,IMAGE_TYPE_ALLOW);
			$data = array();
			if(!in_array($image,array(1,2,3,4))){
				$datacontentdetail['src'] = $image;
			}
			if($delete_image) $datacontentdetail['src'] = null;
			
			$data_appsatellite = array();
			$data_appsatellite['title'] 	        = $this->_request->getParam('title');
			$data_appsatellite['content_detail'] 	= $this->_request->getParam('content_detail');
			$data_appsatellite['nameapp'] 		= $this->_request->getParam('nameapp');
			$data_appsatellite['id'] 		= $_POST['idforeign'];
			
			if($id >0){
				$status = $objcontentdetailfull->updateData($datacontentdetail,(int)$id);
				//$status2 = $objappsatellite->updateData($data_appsatellite,(int)$idforeign);
			}else{
				$status = $objcontentdetailfull->addData($datacontentdetail);
			}

			if($status > 0){
				$this->_redirect(WEB_PATH.'/administrator/contentdetailfull/update/?id='.$status.'&foreign='.$_POST['idforeign']);
			}else{
				$redirectLink = WEB_PATH."/administrator/contentdetailfull/update?status=$status";
				if($id >0) $redirectLink .= "&id=$id";
				$this->_redirect($redirectLink);
			}
		}elseif($id >0){
			$contentdetailfull				= $objcontentdetailfull->getcontentdetailfull($id);
			$groupId			= (int)$contentdetailfull['group_id'];
			$this->view->contentdetailfull 	= $contentdetailfull;
		}
		
		$disabled ="disabled";
		$this->view->contentdetailfullGroup = $objUtil->GetCombobox('nameapp','id','nameapp','appsatellite',array('cssClass'=>'form-control','isBlankVal'=>'no','defaultValue'=>$idforeign,'disabled'=>$disabled));
		//$this->view->contentdetailfullGroup = $objUtil->QueryNameapp('appsatellite','id','nameapp',array('id'=>$idforeign));
		
		$this->view->id 		= $id;
		$this->view->status 	= $status;
		$this->view->idforeign	= $idforeign;
		$this->view->inlineScript()->appendFile(WEB_PATH.'/application/modules/administrator/views/scripts/contentdetailfull/update.js');
	}

	function deletecontentdetailfull($id){
		$objcontentdetailfull = new HT_Model_administrator_models_contentdetailfull();
		echo $objcontentdetailfull->delete("id=".(int)$id);die();
	}

	function getListcontentdetailfull(){
	    
        $objUtil 		= new HT_Model_administrator_models_utility();
		$objcontentdetailfull 		= new HT_Model_administrator_models_contentdetailfull();
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
		
		$totalRecord = $objcontentdetailfull->getListcontentdetailfull_nb($filter);
		$listcontentdetailfull = $objcontentdetailfull->getListcontentdetailfull($start,$size,$filter);
		$paging = trim($objUtil->paging($page, $size, $totalRecord));

// 		appsatellite.nameapp,appsatellite.title,
// 		appsatellite.link,appsatellite.image_thumbnail,
// 		appsatellite.content_detail
		
		
		
		$ajaxData = '<table cellspacing="0" class="table">';
		$ajaxData .= '<thead>';
			$ajaxData .= '<tr>';
				$ajaxData .= '<th width="10">No</th>';
				$ajaxData .= '<th width="50">Title</th>';
				$ajaxData .= '<th width="100">Image</th>';
				$ajaxData .= '<th width="50">Content Detail</th>';
				$ajaxData .= '<th width="50">Nameapp</th>';
				$ajaxData .= '<th width="50">#</th>';
			$ajaxData .= '</tr>';
		$ajaxData .= '</thead>';
		
		$i=0;
		$arrGroup = array();$addN = -1;
		foreach($listcontentdetailfull as $cfg){
			$i++;
			$trClass = null;
			if($cfg['title'] =="igirlxinhcom") {$nameview ="Hot girl";}
			if($cfg['title'] =="phototamtayvn") {$nameview ="New hot girl";}
			
			if($i%2 == 1) $trClass = ' class="altrow"';
			$ajaxData .= '<tr id="'.$cfg['id'].'" '.$trClass.'>';
			$ajaxData .= '<td align="center">'.$i.'</td>';
			$ajaxData .= '<td>'.$nameview.'</td>';
			$ajaxData .= '<td><img src="'.$cfg['src'].'" style="wieght:100px;height:100px;"</td>';
			$ajaxData .= '<td>'.$cfg['content_detail'].'</td>';
			$ajaxData .= '<td>'.$cfg['nameapp'].'</td>';
			$ajaxData .= '<td style="white-space: nowrap" align="center">';
			$ajaxData .= '<a class="btn btn-primary" style="padding: 0px 3px;"  href="'.WEB_PATH.'/administrator/contentdetailfull/update/?id='.$addN.'&foreign='.$cfg['idforeign'].'" title="Add New"><i class="icon-plus "></i></a>|
					      <a class="btn btn-danger btn-xs"  href="#" onclick="deletecontentdetailfull('.$cfg['id'].')" title="Delete"><i class="icon-trash"></i></a>  |
					       <a class="btn btn-xs"  href="'.WEB_PATH.'/administrator/contentdetailfull/update/?id='.$cfg['id'].'&foreign='.$cfg['idforeign'].'" title="Edit"><i class="icon-edit"></i></a>';
			//$ajaxData .= '<a class="btn btn-primary" style="padding: 0px 3px;" idforeign="'.$cfg['idforeign'].'" href="'.WEB_PATH.'/administrator/contentdetailfull/update/?id='.$cfg['id'].'&foreign='.$cfg['idforeign'].'" title="Add New"><i class="icon-plus "></i></a>|<a class="btn btn-danger btn-xs" idforeign="'.$cfg['idforeign'].'" href="#" onclick="deletecontentdetailfull('.$cfg['id'].')" title="Delete"><i class="icon-trash"></i></a>  | <a class="btn btn-xs" idforeign="'.$cfg['idforeign'].'" href="'.WEB_PATH.'/administrator/contentdetailfull/update/?id='.$cfg['id'].'&foreign='.$cfg['idforeign'].'" title="Edit"><i class="icon-edit"></i></a>';
			//$ajaxData .= '<a class="btn btn-xs" href="'.WEB_PATH.'/administrator/contentdetailfull/update/?id='.$cfg['id'].'" title="Edit"><i class="icon-edit"></i></a>';
			$ajaxData .= '</td>';
			$ajaxData .= '</tr>';
		}
		$ajaxData .= '</tbody>';
		$ajaxData .= '</table>';
		$title="Hot Girls All";
		echo $objUtil->renderData($title,$ajaxData,$paging);die();
	}
}
