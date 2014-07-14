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
		$do 		 = @$this->_request->getParam('do');
		$id 		= (int)$this->_request->getParam('id');
		$status 	= (int)$this->_request->getParam('status');
		if($do == 'submit'){
			$data = array();
			$data['group_name'] 		= trim($this->_request->getParam('group_name'));
			$data['group_order'] 		= $this->_request->getParam('group_order');
			$data['description'] 		= $this->_request->getParam('description');
			if($id >0){
				$status = $objAppsatellite->updateData($data,(int)$id);
			}else{
				$status = $objAppsatellite->addData($data);
			}

			if($status > 0){
				$this->_redirect(WEB_PATH.'/administrator/appsatellite');
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
		$this->view->inlineScript()->appendFile(WEB_PATH.'/application/modules/administrator/views/scripts/appsatellite/update.js');
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
				$ajaxData .= '<th width="50">Content Detail</th>';
				$ajaxData .= '<th width="50">Nameapp</th>';
				$ajaxData .= '<th width="50">#</th>';
			$ajaxData .= '</tr>';
		$ajaxData .= '</thead>';
		
		$i=0;
		$arrGroup = array();$addN = -1;
		foreach($listAppsatellite as $cfg){
			$i++;
			$trClass = null;
			if($cfg['title'] =="igirlxinhcom") {$nameview ="Hot girl";}
			if($cfg['title'] =="phototamtayvn") {$nameview ="New hot girl";}
			
			if($i%2 == 1) $trClass = ' class="altrow"';
			$ajaxData .= '<tr id="'.$cfg['id'].'" '.$trClass.'>';
			$ajaxData .= '<td align="center">'.$i.'</td>';
			$ajaxData .= '<td>'.$nameview.'</td>';
			$ajaxData .= '<td><img src="'.$cfg['image_thumbnail'].'" style="wieght:100px;height:100px;"</td>';
			$ajaxData .= '<td>'.$cfg['content_detail'].'</td>';
			$ajaxData .= '<td>'.$cfg['nameapp'].'</td>';
			$ajaxData .= '<td style="white-space: nowrap" align="center">';
			$ajaxData .= '<a class="btn btn-primary" style="padding: 0px 3px;"  href="'.WEB_PATH.'/administrator/appsatellite/update/?id='.$addN.'&foreign='.$cfg['idforeign'].'" title="Add New"><i class="icon-plus "></i></a>|
					      <a class="btn btn-danger btn-xs"  href="#" onclick="deleteappsatellite('.$cfg['id'].')" title="Delete"><i class="icon-trash"></i></a>  |
					       <a class="btn btn-xs"  href="'.WEB_PATH.'/administrator/appsatellite/update/?id='.$cfg['id'].'&foreign='.$cfg['idforeign'].'" title="Edit"><i class="icon-edit"></i></a>';
			//$ajaxData .= '<a class="btn btn-primary" style="padding: 0px 3px;" idforeign="'.$cfg['idforeign'].'" href="'.WEB_PATH.'/administrator/appsatellite/update/?id='.$cfg['id'].'&foreign='.$cfg['idforeign'].'" title="Add New"><i class="icon-plus "></i></a>|<a class="btn btn-danger btn-xs" idforeign="'.$cfg['idforeign'].'" href="#" onclick="deleteappsatellite('.$cfg['id'].')" title="Delete"><i class="icon-trash"></i></a>  | <a class="btn btn-xs" idforeign="'.$cfg['idforeign'].'" href="'.WEB_PATH.'/administrator/appsatellite/update/?id='.$cfg['id'].'&foreign='.$cfg['idforeign'].'" title="Edit"><i class="icon-edit"></i></a>';
			//$ajaxData .= '<a class="btn btn-xs" href="'.WEB_PATH.'/administrator/appsatellite/update/?id='.$cfg['id'].'" title="Edit"><i class="icon-edit"></i></a>';
			$ajaxData .= '</td>';
			$ajaxData .= '</tr>';
		}
		$ajaxData .= '</tbody>';
		$ajaxData .= '</table>';
		$title="HotGirls All";
		echo $objUtil->renderData($title,$ajaxData,$paging);die();
	}
}
