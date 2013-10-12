<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This model contains the data structure for site attributes in ResourceMap
 *
 * @author robert
 */
class SiteForm extends CFormModel {
    public $id;
    public $name;
    public $note;
    public $commonFacilityName;
    public $registrationId;
    public $ctcId;
    public $mtuhaCode;
    
    //contact info
    public $postalAddress;
    public $postalCode;
    public $officialPhoneNumber;
    public $officialFax;
    public $officialEmail;
    public $website;
    public $inChargeName;
    public $inChargeCadre;
    public $inChargeEmail;
    public $inChargeNID;
    public $inChargeMobilePhone;
    
    //physical location
    public $locationDescription;
    public $wayPointNumber;
    public $altitute;
    public $serviceAreas;
    public $serviceAreaPopulation;
    public $catchmentArea;
    public $catchmentPopulation;
    public $dateOpened;
    
    //classification
    public $ownershipDetailOrName;
    public $registrationStatus;
    public $licensingStatus;
    public $otherClinic;
    
    //infrastucture
    public $receptionRoom;
    public $consultationRoom;
    public $dressingRoom;
    public $injectionRoom;
    public $wardRoom;
    public $observationRoom;
    public $remarks;
    public $patientBeds;
    public $deliveryBeds;
    public $babyCots;
    public $ambulances;
    public $cars;
    public $motorcycles;
    public $otherTransport;
    public $noOfOtherTransport;
    public $sterilizationAndInfectionControl;
    public $meansOfTransportToReferralPoint;
    public $distanceToReferralPoint;
    public $challengesToReachReferralPoint;
    public $sourceOfEnergy;
    public $otherEnergySource;
    public $mobileNetworks;
    public $otherMobileNetwork;
    public $sourceOfWater;
    public $otherSourceOfWater;
    public $toiletFacility;
    public $toiletRemarks;
    public $wasteManagement;
    public $otherWasteManagement;
    
    //services offered
    public $generalClinicalServices;
    public $malariaDiagnosisAndTreatment;
    public $TBDiagnosisCareAndTreatment;
    public $cardiovasculasCareAndTreatment;
    public $HIVAIDSPrevention;
    public $HIVAIDSCareAndTreatment;
    public $therapeutics;
    public $prostheticsAndMedicalDevices;
    public $healthPromotionAndDiseasePrevention;
    public $diagnosticServices;
    public $reproductiveAndChildHealthCareServices;
    public $growthMonitoringOrNutritionalSurveillance;
    public $oralHealthService;
    public $ENTServices;
    public $supportServices;
    public $emergencyPreparedness;
    public $otherServices;
    
    
    //temp fields
    public $oldHFRId;
    
    public $properties = array(
        'Registrar_ID'=>'',
        'Admin_div'=>'',
        'Ownership'=>'',
        'Fac_Type'=>'',
        'OperatingStatus'=>'',
        'Fac_ID'=>''
    );
    
    
    public function rules() {
        return array(
            
        );
    }
    
    public function attributeLabels() {
        return array(
            'id'=>'ID',
            'name'=>'Name',
            'note'=>"Curator's Note",
            'commonFaciltyName'=>'Common Facility Name',
            'registrationId'=>'Registration ID',
            'ctcId'=>'CTC ID',
            'mtuhaCode'=>'MTUHA Code',
            'properties'=>'Properties',
            'properties[Registrar_ID]'=>'Registrar ID',
            'properties[Admin_div]'=>'Administrative Division',
            'properties[Ownership]'=>'Ownership',
            'properties[Fac_Type]'=>'Facility Type',
            'properties[OperatingStatus]'=>'Operating Status',
            'properties[Fac_ID]'=>'Facility ID',
        );
    }
}

?>
