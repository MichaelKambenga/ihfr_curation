<?php

class CurationController extends Controller
{

	/**
	 *
	 * 
	 */
    
	public function actionViewFacility()
	{
		
		$this->render('facility');
	}
        
        public function actionFacilities(){
                
                $this->render('exploreFacilities');
        }

	
}
