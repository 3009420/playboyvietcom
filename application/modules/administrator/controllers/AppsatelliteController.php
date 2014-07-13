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
		$size 			= PAGING_SIZE;
		if (!is_numeric($page) || $page <= 0) {
			$page = 1;
		}
		$start = $page * $size - $size;
		$totalRecord = $objAppsatellite->getListAppsatellite_nb(array('keyword'=>$keyword));
		$listAppsatellite = $objAppsatellite->getListAppsatellite($start,$size,array('keyword'=>$keyword));
		$paging = trim($objUtil->paging($page, $size, $totalRecord));
		$ajaxData .= ' <div class="box-header blue-background">
                      <div class="title">Group new hot girls</div>
                      <div class="actions">
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class="icon-remove"></i>
                        </a>
		
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class="box-content box-no-padding">
                      <div class="responsive-table">';
		$ajaxData .= '<table class="table" style="margin-bottom:0;">';
		$ajaxData .= '<thead>';
			$ajaxData .= '<tr>';
				$ajaxData .= '<th width="15">STT</th>';
				$ajaxData .= '<th width="200">TÃªn nhÃ³m</th>';
				$ajaxData .= '<th width="250">MÃ´ táº£</th>';
				$ajaxData .= '<th width="250">Æ¯u tiÃªn</th>';
				$ajaxData .= '<th width="50" >#</th>';
			$ajaxData .= '</tr>';
		$ajaxData .= '</thead>';
		
		$i=0;
		$arrGroup = array();
		foreach($listAppsatellite as $ngr){
			$i++;
			$trClass = null;
			if($i%2 == 1) $trClass = ' class="altrow"';
			$ajaxData .= '<tr id="'.$ngr['id'].'" '.$trClass.'>';
			$ajaxData .= '<td align="center">'.$i.'</td>';
			$ajaxData .= '<td>'.$ngr['nameapp'].'</td>';
			$ajaxData .= '<td>'.$objUtil->tooltipString($ngr['title'],50).'</td>';
			$ajaxData .= '<td>'.$ngr['image_thumbnail'].'</td>';
			$ajaxData .= '<td style="white-space: nowrap" align="center">';
			$ajaxData .= '<a class="btn btn-xs" href="'.WEB_PATH.'/administrator/appsatellite/update/?id='.$ngr['id'].'"><i class="icon-edit"></i></a> <a class="btn btn-danger btn-xs" href="#" onclick="deleteAppsatellite('.$ngr['id'].')"><i class="icon-remove"></i></a> ';
			$ajaxData .= '</td>';
			$ajaxData .= '</tr>';
		}
		$ajaxData .= '</tbody>';
		$ajaxData .= '</table>';
		$ajaxData .= '</div>
                      ';
		echo $objUtil->renderData($ajaxData,$paging);die();
	}
}
