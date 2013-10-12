<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Layer
 *
 * @author robert
 */
class Layer {
    
    // layer indeces
    const PRIORITY_FIELDS = 0;
    const FACILITY_IDENTIFIER_NUMBER = 1;
    const IDENTIFICATION = 2;
    const CONTACT_INFORMATION = 3;
    const PHYSICAL_LOCATION = 4;
    const CLASSIFICATION = 5;
    const INFRASTRUCTURE = 6;
    const SERVICES_OFFERED = 7;
    const TEMP_FIELDS = 8;
    
    const PRIORITY_FIELDS_FACILITY_TYPE = 1;
    const PRIORITY_FIELDS_OWNERSHIP = 2;
    const PRIORITY_FIELDS_OPERATING_STATUS = 3;
    
    const CLASSIFICATION_REGISTRATION_STATUS = 1;
    const CLASSIFICATION_LICENSING_STATUS = 2;
    
    const INFRASTRUCTURE_STERILIZATION_AND_INFECTION_CONTROL = 15;
    const INFRASTRUCTURE_SOURCE_OF_ENERGY = 19;
    const INFRASTRUCTURE_MOBILE_NETWORKS = 21;
    const INFRASTRUCTURE_SOURCE_OF_WATER = 23;
    const INFRASTRUCTURE_TOILET_FACILITY = 25;
    const INFRASTRUCTURE_WASTE_MANAGEMENT = 27;
    
    const SERVICES_OFFERED_GENERAL_CLINICAL_SERVICES = 0;
    const SERVICES_OFFERED_MALARIA = 1;
    const SERVICES_OFFERED_TB = 2;
    const SERVICES_OFFERED_CARDIOVASCULAR = 3;
    const SERVICES_OFFERED_HIVAIDS_PREVENTION = 4;
    const SERVICES_OFFERED_HIVAIDS_CARE_AND_TREATMENT = 5;
    const SERVICES_OFFERED_THERAPEUTICS = 6;
    const SERVICES_OFFERED_PROSTHETICS_AND_MEDICAL_DEVICES = 7;
    const SERVICES_OFFERED_HEALTH_PROMOTION_AND_DISEASE_PREVENTION = 8;
    const SERVICES_OFFERED_DIAGNOSTIC = 9;
    const SERVICES_OFFERED_REPRODUCTIVE_AND_CHILD_HEALTH_CARE = 10;
    const SERVICES_OFFERED_GROWTH_MONITORING_NUTRITIONAL_SURVEILLANCE = 11;
    const SERVICES_OFFERED_ORAL_HEALTH_DENTAL = 12;
    const SERVICES_OFFERED_ENT = 13;
    const SERVICES_OFFERED_SUPPORT = 14;
    const SERVICES_OFFERED_EMERGENCY_PREPAREDNESS = 15;
    
    public static function loadLayers(){
        $url = "http://resourcemap.instedd.org/collections/".
                Yii::app()->params['resourceMapConfig']['curation_collection_id']
                ."/layers.json";
        $response = RestUtility::execCurl($url);
        $layers = CJSON::decode($response, true);
        
        return $layers;
    }
    
    //services offered helpers
    public static function getGeneralClinicalServicesOptions(){
        $layers = Yii::app()->user->getState('layers');
        $services = $layers[self::SERVICES_OFFERED]['fields'][self::SERVICES_OFFERED_GENERAL_CLINICAL_SERVICES];
        $options = array();
        foreach($services['config']['options'] as $option){
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getMalariaServicesOptions(){
        $layers = Yii::app()->user->getState('layers');
        $services = $layers[self::SERVICES_OFFERED]['fields'][self::SERVICES_OFFERED_MALARIA];
        $options = array();
        foreach($services['config']['options'] as $option){
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getTBServicesOptions(){
        $layers = Yii::app()->user->getState('layers');
        $services = $layers[self::SERVICES_OFFERED]['fields'][self::SERVICES_OFFERED_TB];
        $options = array();
        foreach($services['config']['options'] as $option){
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getCardiovascularServicesOptions(){
        $layers = Yii::app()->user->getState('layers');
        $services = $layers[self::SERVICES_OFFERED]['fields'][self::SERVICES_OFFERED_CARDIOVASCULAR];
        $options = array();
        foreach($services['config']['options'] as $option){
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getHIVAIDSPreventionServicesOptions(){
        $layers = Yii::app()->user->getState('layers');
        $services = $layers[self::SERVICES_OFFERED]['fields'][self::SERVICES_OFFERED_HIVAIDS_PREVENTION];
        $options = array();
        foreach($services['config']['options'] as $option){
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getHIVAIDSCareAndTreatmentServicesOptions(){
        $layers = Yii::app()->user->getState('layers');
        $services = $layers[self::SERVICES_OFFERED]['fields'][self::SERVICES_OFFERED_HIVAIDS_CARE_AND_TREATMENT];
        $options = array();
        foreach($services['config']['options'] as $option){
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getTherapeuticsServicesOptions(){
        $layers = Yii::app()->user->getState('layers');
        $services = $layers[self::SERVICES_OFFERED]['fields'][self::SERVICES_OFFERED_THERAPEUTICS];
        $options = array();
        foreach($services['config']['options'] as $option){
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getProstheticsAndMedicalDevicesServicesOptions(){
        $layers = Yii::app()->user->getState('layers');
        $services = $layers[self::SERVICES_OFFERED]['fields'][self::SERVICES_OFFERED_PROSTHETICS_AND_MEDICAL_DEVICES];
        $options = array();
        foreach($services['config']['options'] as $option){
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getHealthPromotionAndDiseasePrventionServicesOptions(){
        $layers = Yii::app()->user->getState('layers');
        $services = $layers[self::SERVICES_OFFERED]['fields'][self::SERVICES_OFFERED_HEALTH_PROMOTION_AND_DISEASE_PREVENTION];
        $options = array();
        foreach($services['config']['options'] as $option){
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getDiagnosticServicesOptions(){
        $layers = Yii::app()->user->getState('layers');
        $services = $layers[self::SERVICES_OFFERED]['fields'][self::SERVICES_OFFERED_DIAGNOSTIC];
        $options = array();
        foreach($services['config']['options'] as $option){
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getReproductiveAndChildHealthCareServicesOptions(){
        $layers = Yii::app()->user->getState('layers');
        $services = $layers[self::SERVICES_OFFERED]['fields'][self::SERVICES_OFFERED_REPRODUCTIVE_AND_CHILD_HEALTH_CARE];
        $options = array();
        foreach($services['config']['options'] as $option){
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getGrowthMonitoringAndNutritionSurveillanceServicesOptions(){
        $layers = Yii::app()->user->getState('layers');
        $services = $layers[self::SERVICES_OFFERED]['fields'][self::SERVICES_OFFERED_GROWTH_MONITORING_NUTRITIONAL_SURVEILLANCE];
        $options = array();
        foreach($services['config']['options'] as $option){
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getDentalServicesOptions(){
        $layers = Yii::app()->user->getState('layers');
        $services = $layers[self::SERVICES_OFFERED]['fields'][self::SERVICES_OFFERED_ORAL_HEALTH_DENTAL];
        $options = array();
        foreach($services['config']['options'] as $option){
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getENTServicesOptions(){
        $layers = Yii::app()->user->getState('layers');
        $services = $layers[self::SERVICES_OFFERED]['fields'][self::SERVICES_OFFERED_ENT];
        $options = array();
        foreach($services['config']['options'] as $option){
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getSupportServicesOptions(){
        $layers = Yii::app()->user->getState('layers');
        $services = $layers[self::SERVICES_OFFERED]['fields'][self::SERVICES_OFFERED_SUPPORT];
        $options = array();
        foreach($services['config']['options'] as $option){
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getEmergencyPreparednessServicesOptions(){
        $layers = Yii::app()->user->getState('layers');
        $services = $layers[self::SERVICES_OFFERED]['fields'][self::SERVICES_OFFERED_EMERGENCY_PREPAREDNESS];
        $options = array();
        foreach($services['config']['options'] as $option){
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    
    //priority fields helpers
    public static function getOperatingStatusOptions(){
        
        $layers = Yii::app()->user->getState('layers');
        
        $status = $layers[self::PRIORITY_FIELDS]['fields'][self::PRIORITY_FIELDS_OPERATING_STATUS];
        
        $options = array();
        foreach($status['config']['options'] as $option){ 
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getAdministrativeDivisionOptions(){
        
        $result = Yii::app()->user->getState('hierarchy');
        $rootNode = Yii::app()->user->getState('node_id');
        $filteredData = self::search($result['config']['hierarchy'],'id',$rootNode);
        return self::parseHierarchy($filteredData);
    }
    
    public static function getOwnershipOptions(){
        $layers = Yii::app()->user->getState('layers');
        
        $ownership = $layers[self::PRIORITY_FIELDS]['fields'][self::PRIORITY_FIELDS_OWNERSHIP];
        
        return self::parseHierarchy($ownership['config']['hierarchy']);
       
    }
    
   
    public static function getFacilityTypeOptions(){
        $layers = Yii::app()->user->getState('layers');
        $facilityType = $layers[self::PRIORITY_FIELDS]['fields'][self::PRIORITY_FIELDS_FACILITY_TYPE];
        return self::parseHierarchy($facilityType['config']['hierarchy']);
    }
    
    //classification helpers
    public static function getLicensingStatusOptions(){
        $layers = Yii::app()->user->getState('layers');
        
        $status = $layers[self::CLASSIFICATION]['fields'][self::CLASSIFICATION_LICENSING_STATUS];
        
        $options = array();
        foreach($status['config']['options'] as $option){ 
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getRegistrationStatusOptions(){
        $layers = Yii::app()->user->getState('layers');
        
        $status = $layers[self::CLASSIFICATION]['fields'][self::CLASSIFICATION_REGISTRATION_STATUS];
        
        $options = array();
        foreach($status['config']['options'] as $option){ 
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    //infrastructure helpers
    public static function getSterilizationAndInfectionControlOptions(){
        $layers = Yii::app()->user->getState('layers');
        
        $status = $layers[self::INFRASTRUCTURE]['fields'][self::INFRASTRUCTURE_STERILIZATION_AND_INFECTION_CONTROL];
        
        $options = array();
        foreach($status['config']['options'] as $option){ 
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getSourceOfEnergyOptions(){
        $layers = Yii::app()->user->getState('layers');
        
        $status = $layers[self::INFRASTRUCTURE]['fields'][self::INFRASTRUCTURE_SOURCE_OF_ENERGY];
        
        $options = array();
        foreach($status['config']['options'] as $option){ 
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getMobileNetworkOptions(){
        $layers = Yii::app()->user->getState('layers');
        
        $status = $layers[self::INFRASTRUCTURE]['fields'][self::INFRASTRUCTURE_MOBILE_NETWORKS];
        
        $options = array();
        foreach($status['config']['options'] as $option){ 
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getSourceOfWaterOptions(){
        $layers = Yii::app()->user->getState('layers');
        
        $status = $layers[self::INFRASTRUCTURE]['fields'][self::INFRASTRUCTURE_SOURCE_OF_WATER];
        
        $options = array();
        foreach($status['config']['options'] as $option){ 
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getToiletFacilityOptions(){
        $layers = Yii::app()->user->getState('layers');
        
        $status = $layers[self::INFRASTRUCTURE]['fields'][self::INFRASTRUCTURE_TOILET_FACILITY];
        
        $options = array();
        foreach($status['config']['options'] as $option){ 
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function getWasteManagementOptions(){
        $layers = Yii::app()->user->getState('layers');
        
        $status = $layers[self::INFRASTRUCTURE]['fields'][self::INFRASTRUCTURE_WASTE_MANAGEMENT];
        
        $options = array();
        foreach($status['config']['options'] as $option){ 
            array_push($options, $option['label']);
        }
        
        return $options;
    }
    
    public static function parseHierarchy($hierarchy){
             $treeArray = array();
                if(is_array($hierarchy)){
                    foreach ($hierarchy as $node){
                       if(is_array($node)){
                        if(array_key_exists('name', $node)){
                            if(array_key_exists('sub', $node)){
                                $subNodes = self::parseHierarchy($node['sub']);
                                $treeNodeArray = array('text'=>CHtml::link(TbHtml::icon(TbHtml:: ICON_FOLDER_CLOSE).$node['name'],'#'),'children'=>$subNodes);
                            } else {
                                $treeNodeArray = array('text'=>CHtml::link(TbHtml::icon(TbHtml:: ICON_FOLDER_CLOSE).$node['name'],'#'));
                            }
                            array_push($treeArray, $treeNodeArray);                       

                        }
                       }
                                       
                    }
                    
                    return $treeArray;
                }
                       
        }
     
     public static function search($array, $key, $value)
     {
            $results = array();

            if (is_array($array))
            {
                if (isset($array[$key]) && $array[$key] == $value)
                    $results[] = $array;

                foreach ($array as $subarray){
                       $results = array_merge($results, self::search($subarray, $key, $value));
                 }
            }

            return $results;
      }
   
}

?>
