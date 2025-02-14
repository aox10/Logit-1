<?php

class MapController extends Zend_Controller_Action
{

    public function init()
    {
       
    }

   
	public function indexAction()
	{
		
	}
	
	public function getJsonAction(){
		$this->_helper->layout()->disableLayout();
		$user = Application_Model_AuthUser::getAuthUser();
		$this->view->arrLogs = $user->getLogs();
		/*
		$arrLogs = $user->getLogs();
		$arrJsonObjs = array();
		foreach ($arrLogs as $objLog){
			array_push($arrJsonObjs, 
				array( 	'latitude' => $objLog->getLat(),
						'longitude' => $objLog->getLong(),
						'image' => 'daten/pics/orig/' . $objLog->getPicIdent() . '.jpg'
				)
			);
		}
		$jsonData = Zend_Json::encode($arrJsonObjs);
		echo $jsonData;
		*/
	}
	
	public function getImagesForTimelineAction(){
		$this->_helper->layout()->disableLayout();		
		
		$authUser = Application_Model_AuthUser::getAuthUser();
		
		$startDate = $this->getFormedDateTimeString(
			$this->getRequest()->getParam('first-year'),
			$this->getRequest()->getParam('first-month'),
			$this->getRequest()->getParam('first-day'), "12", "00", "00");
		
		$endDate = $this->getFormedDateTimeString(
			$this->getRequest()->getParam('second-year'),
			$this->getRequest()->getParam('second-month'),
			$this->getRequest()->getParam('second-day'), "12", "00", "00");
		
		$limit = $this->getRequest()->getParam('number-of-images');
		
		$pictures = new Application_Model_PictureMapper();
		$this->view->arrLogs = $pictures->getLogsForUser($authUser->getId(), $startDate, $endDate, $limit);
		
	}
	
	private function getFormedDateTimeString($year, $month, $day, $hour, $minute, $second){
		return $year . "-" . $month . "-" . $day . " " . $hour . ":" . $minute . ":" . $second;
	}

}