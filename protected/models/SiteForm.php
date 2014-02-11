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
    //public $id;
    
    public $administrativeDivision;
    public $ownership;
    public $operatingStatus;
    public $facilityType;
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
    public $altitude;
    public $serviceAreas;
    public $serviceAreaPopulation;
    public $catchmentArea;
    public $catchmentPopulation;
    public $dateOpened;
    
    //classification
    public $ownershipDetailOrName;
    public $registrationStatus;
//    public $licensingStatus;
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
   //public $oldHFRId;
    public $grades;
    
    public $note;
    
    public function rules() {
        return array(
            array('officialEmail,note','length','max'=>255),
            array('registrationStatus','numerical','integerOnly'=>true),
            array('
                 administrativeDivision,
                 ownership，
                 operatingStatus,
                 facilityType, 
                 commonFacilityName,
                 registrationId, ctcId，
                 mtuhaCode，
                 postalAddress，
                 postalCode，
                 officialPhoneNumber，
                 officialFax，
                 website，
                 inChargeName，
                 inChargeCadre，
                 inChargeEmail，
                 inChargeNID，
                 inChargeMobilePhone，
                 locationDescription，
                 wayPointNumber，
                 altitude，
                 serviceAreas，
                 serviceAreaPopulation，
                 catchmentArea，
                 catchmentPopulation，
                 dateOpened，
                 ownershipDetailOrName，
                 registrationStatus，
                 licensingStatus，
                 otherClinic，
                 receptionRoom，
                 consultationRoom，
                 dressingRoom，
                 injectionRoom，
                 wardRoom，
                 observationRoom，
                 remarks，
                 patientBeds,
                 deliveryBeds,
                 babyCots,
                 ambulances,
                 cars,
                 motorcycles,
                 otherTransport,
                 noOfOtherTransport,
                 sterilizationAndInfectionControl,
                 meansOfTransportToReferralPoint,
                 distanceToReferralPoint,
                 challengesToReachReferralPoint,
                 sourceOfEnergy,
                 otherEnergySource,
                 mobileNetworks,
                 otherMobileNetwork,
                 sourceOfWater,
                 otherSourceOfWater,
                 toiletFacility,
                 toiletRemarks,
                 wasteManagement,
                 otherWasteManagement,
                 generalClinicalServices,
                 malariaDiagnosisAndTreatment,
                 TBDiagnosisCareAndTreatment,
                 cardiovasculasCareAndTreatment,
                 HIVAIDSPrevention,
                 HIVAIDSCareAndTreatment,
                 therapeutics,
                 prostheticsAndMedicalDevices,
                 healthPromotionAndDiseasePrevention,
                 diagnosticServices,
                 reproductiveAndChildHealthCareServices,
                 growthMonitoringOrNutritionalSurveillance,
                 oralHealthService,
                 ENTServices,
                 supportServices,
                 emergencyPreparedness,
                 otherServices,
                 grades,','safe'),
        );
    }
    
    public function attributeLabels() {
        return array(
            'id'=>'ID',
            'note'=>"Curator's Note",
            'commonFaciltyName'=>'Common Facility Name',
            'registrationId'=>'Registration ID',
            'ctcId'=>'CTC ID',
            'mtuhaCode'=>'MTUHA Code',
        );
    }
}

?>
