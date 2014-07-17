<?php
	class IndexController extends Zend_Controller_Action{
		public function init(){
			$objSeo= new HT_Model_administrator_models_seo();
			$seo = $objSeo->getKeyword();
			if(is_array($seo) && sizeof($seo)>0){
				$this->view->headTitle($seo['tag_title']);
				$this->view->headMeta()->setName('og:title',$seo['tag_title']);
				$this->view->headMeta()->setName('description',$seo['tag_description']);
			}
		}
		public function indexAction(){
			$objNote = new HT_Model_administrator_models_note();
			$this->view->notes = $objNote->getHomeNotes();
			//+++++
			$promotedjson = new Zend_Session_Namespace('Promoted');
			$promotedjson->setExpirationSeconds(604800);
			$promotedjson->namefile = "Promoted";//rand(10, 999999);
				
				
// 			$jsonString ='[{"aid":"574519","album_name":"Chu\u1ea9n nh\u01b0 th\u01b0\u1edbc th\u1ee3 m\u1ed9c","thumbnail":"\/files\/photo2\/2014\/2\/17\/9\/866392\/53017b06_18bc5541_07e22c4b30e76654fcf71375527a38e6_thumb.jpg","created":"1392415162","username":"caococo","uid":"866392","view_privacy":"0","img_server":"3"},{"aid":"574724","album_name":"[D\u01b0\u01a1ng Minh] - C\u00f2n m\u00e3i M\u00f9a Xu\u00e2n","thumbnail":"\/files\/photo2\/2014\/6\/20\/9\/376191\/53a39763_69c7b017_1fc95836e35bda23b58a48db55c999c3_thumb.jpg","created":"1392721125","username":"aspvn","uid":"376191","view_privacy":"0","img_server":"3"},{"aid":"574495","album_name":"SWEET","thumbnail":"\/files\/photo2\/2014\/2\/17\/10\/12934257\/53017b35_57cfbe74_f450a7c3ae160b9283516a7731a9e0c8_thumb.jpg","created":"1392377507","username":"manhmum137","uid":"12934257","view_privacy":"0","img_server":"3"},{"aid":"574866","album_name":"R\u1ea1ng r\u1ee1 c\u00f9ng em","thumbnail":"\/files\/photo2\/2014\/2\/21\/11\/2909408\/5306dac7_00dbec18_605060893ca357315b5d3c01604be651_thumb.jpg","created":"1392947721","username":"MissYumi","uid":"2909408","view_privacy":"0","img_server":"3"},{"aid":"574430","album_name":"Ba V\u00ec ng\u00e0y ng\u01b0\u1ee3c gi\u00f3 - H\u01b0\u01a1ng Obi","thumbnail":"\/files\/photo2\/2014\/2\/13\/14\/12752618\/52fc782d_07e8df84_a0b9eee6966b047070b4229144ea2a39_thumb.jpg","created":"1392275658","username":"chinhphucnguoidep","uid":"12752618","view_privacy":"0","img_server":"3"},{"aid":"574624","album_name":"DJ hot","thumbnail":"\/files\/photo2\/2014\/2\/17\/10\/869502\/530186f7_641b60e9_c1652c2f544bab845255c996750e2988_thumb.jpg","created":"1392607612","username":"namphi","uid":"869502","view_privacy":"0","img_server":"3"},{"aid":"574641","album_name":"C\u00f4 d\u00e2u ma m\u1ecb","thumbnail":"\/files\/photo2\/2014\/2\/17\/15\/12429899\/5301c9b2_58dbd165_e00cdbbb029141f8e29ddaf0c31d9a50_thumb.jpg","created":"1392626082","username":"heobanhbeo","uid":"12429899","view_privacy":"0","img_server":"3"},{"aid":"574758","album_name":"\u0110\u01b0\u1eddng cong Yu Tai","thumbnail":"\/files\/photo2\/2014\/2\/19\/10\/869502\/5304222d_0e076626_85dc4ea93f2ce0f7e8f8bf76dd1ce286_thumb.jpg","created":"1392777069","username":"namphi","uid":"869502","view_privacy":"0","img_server":"3"},{"aid":"574687","album_name":"D\u1ecbu d\u00e0ng 16 tr\u0103ng tr\u00f2n","thumbnail":"\/files\/photo2\/2014\/2\/24\/9\/9832597\/530aaccb_1f55280e_99c7dabb146959190ee93d07a906f208_thumb.jpg","created":"1392705721","username":"dvlinhshimadzu","uid":"9832597","view_privacy":"0","img_server":"3"},{"aid":"574479","album_name":"A little too sexy","thumbnail":"\/files\/photo2\/2014\/2\/14\/11\/12455136\/52fd9d7f_00836690_021a099a6673f47d580a49724286c957_thumb.jpg","created":"1392349427","username":"xoaycungconsotteen","uid":"12455136","view_privacy":"0","img_server":"3"},{"aid":"574639","album_name":"Ai \u0111ua c\u00f9ng em...","thumbnail":"\/files\/photo2\/2014\/2\/17\/15\/12429874\/5301c65c_6f803a08_0ea0c7031c63aed6df81c3de41eed6c3_thumb.jpg","created":"1392625214","username":"onhawemoilen69","uid":"12429874","view_privacy":"0","img_server":"3"},{"aid":"574389","album_name":"S\u1ee9c n\u00f3ng cho ng\u00e0y l\u1ea1nh gi\u00e1","thumbnail":"\/files\/photo2\/2014\/2\/13\/10\/12429856\/52fc3551_4ac09284_a7896aefa6c52cbda5409d87498557a0_thumb.jpg","created":"1392260409","username":"exinhekieu982","uid":"12429856","view_privacy":"0","img_server":"3"}]';
// 			$promoted = json_decode($jsonString);
// 			$path = ROOT_PATH . '/public/cache/'.$promotedjson->namefile.'.json';
// 			$content = '{"Messages":'.json_encode($promoted,true).'}';
// 			$handler = fopen ( $path, 'w+' );
// 			fwrite ( $handler, $content );
// 			fclose ( $handler );
			
// 			$this->view->namefile = $promotedjson->namefile;
			
			//-------------------------------------------------
			
			// get servicer hot girl and New hots girl
			
			$appHotgirl = new HT_Model_administrator_models_appsatellite();
			$arrr = $appHotgirl->getHotgirl();
			
	        $promoted = json_decode($arrr,true);
			$path = ROOT_PATH . '/public/cache/'.$promotedjson->namefile.'.json';
			$content = '{"Messages":'.json_encode($arrr,true).'}';
			$handler = fopen ( $path, 'w+' );
			fwrite ( $handler, $content );
			fclose ( $handler );
			
			$this->view->namefile = $promotedjson->namefile;
			
			//get phototamtay
			$arTamtay = $appHotgirl->getHotnewgirl();
			$this->view->hotgirlsnew = $arTamtay;
			
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
		
		public function detailAction(){
			$appHotgirl = new HT_Model_administrator_models_appsatellite();
			$objUtil 	= new HT_Model_administrator_models_utility();
			//$id 		= (int)$this->_request->getParam('id');
			$id		= $this->_request->getParam('id');
			$detail = $appHotgirl->getHotgirlId($id);
			$this->view->detail = $detail;
		}
		
		// ajax promoted json
		public function promotedAction(){
			
			
				//	echo Zend_Json::encode($promoted);
			
					//exit();
		}
		
	}
		
?>