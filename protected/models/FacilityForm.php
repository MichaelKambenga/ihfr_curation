<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FacilityForm
 *
 * @author robert
 */
class FacilityForm extends CFormModel {
    //put your code here
    public $_13274;
    public $_13275;
    public $_13285;
    public $_13303;
    public $_13291;
    public $_13280;
    public $_13306;
    public $_13309;
    public $_13335;
    public $_13273;
    public $_13292;
    public $_13300;
    public $_13302;
    public $_13305;
    public $_13281;
    public $_13307;
    public $_13336;
    public $_13276;
    public $_13277;
    public $_13293;
    public $_13282;
    public $_13308;
    public $_13337;
//public $_1841;
    public $_13301;
//public $_1889;
    public $_13278;
    public $_13304;
    public $_13294;
    public $_13283;
    public $_13338;
    public $_13295;
    public $_13284;
    public $_13310;
    public $_13339;
    public $_13311;
    public $_13296;
    public $_13340;
    public $_13297;
    public $_13286;
    public $_13312;
    public $_13341;
    public $_13298;
    public $_13287;
    public $_13313;
    public $_13342;
    public $_13290;
    public $_13314;
    public $_13343;
    public $_13315;
    public $_13344;
    public $_13288;
    public $_13289;
    public $_13316;
    public $_13345;
    public $_13317;
    public $_13346;
    public $_13318;
    public $_13347;
    public $_13319;
    public $_13348;
    public $_13320;
    public $_13349;
    public $_13321;
    public $_13350;
    public $_13322;
    public $_13351;
    public $_13323;
    public $_13324;
    public $_13325;
    public $_13326;
    public $_13327;
    public $_13328;
    public $_13329;
    public $_13330;
    public $_13331;
    public $_13332;
    public $_13333;
    public $_13334;
//public $_2362;
    public $_13352;
    public $_13353;
    public $_13354;
    public $_13299;
    public $_13279;
    
//main site fields
    public $name;
    public $location; //<$lat,$lng> pair
    public $note;

    public function rules() {
        return array(
            array('note,name,_13274', 'required'),
            array('note', 'length', 'min' => 20),
            array('location', 'isLocationWithinRange'),
            array('_13274', 'validateLevel'),
            array('_13277', 'validateCTCID'),
//        array('_13273','readOnly'=>true),
            array('_13306,_13281,_13307,_13308,_13295,_13310,_13311,_13297,_13313,_13314,_13315,_13316,_13317,_13318,_13320', 'numerical', 'integerOnly' => true),
            array('location,_13274,_13275,_13303,_13291,_13280,_13335,_13273,_13292,_13300,_13302,_13305,_13336,_13276,_13277,_13282,_13337,_13301,_13278,_13304,_13294,_13283,_13338,_13284,_13339,_13296,_13340,_13286,_13312,_13341,_13298,_13287,_13342,_13290,_13343,_13344,_13288,_13289,_13345,_13346,_13347,_13319,_13348,_13349,_13321,_13350,_13322,_13351,_13323,_13324,_13325,_13326,_13327,_13328,_13329,_13330,_13331,_13332,_13333,_13334,_13352,_13353,_13354,_13279,_13293,_13299,_13309', 'safe'),
        );
    }

    public function isLocationWithinRange() {

        if (!empty($this->location)) {
            $geoCodeArray = explode(',', $this->location);
            $latitude = $geoCodeArray[0];
            $longitude = $geoCodeArray[1];

            if (Yii::app()->params['resourceMapConfig']['lower_bound_latitude'] <= $latitude && $latitude <= Yii::app()->params['resourceMapConfig']['upper_bound_latitude']) {
                if (Yii::app()->params['resourceMapConfig']['lower_bound_longitude'] <= $longitude && $longitude <= Yii::app()->params['resourceMapConfig']['upper_bound_longitude']) {
                    return true;
                }
            }
            $this->addError('location', 'Location out of range');
            return false;
        } else {
            return true;
        }
    }

    public function validateCTCID() {
        if (!empty($this->_13277)) {

            if (preg_match('/\d\d-\d\d-\d\d\d\d$/', $this->_13277)) {
                return true;
            }
            $this->addError('_13277', 'Invalid CTC ID');
            return false;
        }

        return true;
    }
    
    public function validateLevel() {
        if (!empty($this->_13274)) {

            if (strlen($this->_13274) > 12) {
                return true;
            }
            $this->addError('_13274', 'Select atleast the council level');
            return false;
        }

        return true;
    }

    public function attributeLabels() {
        return array(
            'name' => 'Registered/Official Facility Name',
            'note' => 'Remarks',
            '_13274' => 'Administrative Divisions',
            '_13275' => 'Common Facility Name',
            '_13303' => 'Ownership Detail / Name',
            '_13291' => 'Location Description (e.g. Landmarks)',
            '_13280' => 'Postal Address',
            '_13306' => 'Reception Room',
            '_13335' => 'General Clinical Services',
            '_13273' => 'Facility Identifier Number',
            '_13292' => 'Waypoint No.',
            '_13300' => 'Facility Type',
            '_13302' => 'Ownership',
            '_13305' => 'Registration Status',
            '_13281' => 'Postal Code',
            '_13307' => 'Consultation Room',
            '_13336' => 'Malaria Diagnosis and Treatment',
            '_13276' => 'Registration ID',
            '_13277' => 'CTC ID',
            '_1833' => 'Altitude (Meters)',
            '_13282' => 'Official Phone Number',
            '_1825' => 'Website',
            '_13308' => 'Dressing Room',
            '_1846' => 'Injection Room',
            '_13337' => 'TB Diagnosis, Care and Treatment',
//            '_1841'=>'Licensing Status',
            '_13301' => 'Other Clinic (Please Specify)',
//            '_1889'=>'Old HFR ID',
            '_13278' => 'MTUHA Code',
            '_13304' => 'Operating Status',
            '_13294' => 'Service Areas (Villages) ',
            '_13283' => 'Official Fax',
            '_13338' => 'Cardiovascular Care and Treatment',
            '_13295' => 'Service Area Population',
            '_13284' => 'Official Email',
            '_13310' => 'Ward Room',
            '_13339' => 'HIV/AIDS Prevention',
            '_13311' => 'Observation Room',
            '_13296' => 'Catchment Area (Villages)',
            '_13340' => 'HIV/AIDS Care and Treatment',
            '_13297' => 'Catchment Population',
            '_13286' => 'Facility In-Charge: Name',
            '_13312' => 'Remarks',
            '_13341' => 'Therapeutics',
            '_13298' => 'Date Opened/Inaugurated/Upgraded (dd/mm/yyyy)',
            '_2381' => 'Year',
            '_13287' => 'Facility In-Charge: Cadre',
            '_13313' => 'Patient Beds',
            '_13342' => 'Prosthetics and Medical Devices',
            '_13290' => 'Facility In-Charge: Email',
            '_13314' => 'Delivery Beds',
            '_13343' => 'Health Promotion and Disease Prevention',
            '_13315' => 'Baby Cots',
            '_13344' => 'Diagnostic Services',
            '_13288' => 'Facility In-Charge: NID #',
            '_13289' => 'Facility In-Charge: Mobile Phone #',
            '_13316' => 'Ambulances',
            '_13345' => 'Reproductive and Child Health Care Services',
            '_13317' => 'Cars',
            '_13346' => 'Growth Monitoring / Nutrition Surveillance',
            '_13318' => 'Motorcycles',
            '_13347' => 'Oral Health Service (Dental Services)',
            '_13319' => 'Specify, Other Transport',
            '_13348' => 'ENT Services',
            '_13320' => '# of Other Transport',
            '_13349' => 'Support Services',
            '_13321' => 'Sterilization and Infection Control',
            '_13350' => 'Emergency Preparedness',
            '_13322' => 'Means of Transport to Referral Point',
            '_13351' => 'Other Services (Please Specify)',
            '_13323' => 'Distance to Referral Point',
            '_13324' => 'Challenges/Remarks to Reach Referral Point',
            '_13325' => 'Source of Energy',
            '_13326' => 'Specify Other Energy Source',
            '_13327' => 'Mobile Networks',
            '_13328' => 'Specify Other Mobile Network',
            '_13329' => 'Source of Water',
            '_13330' => 'Specify Other Water Source',
            '_13331' => 'Toilet Facility',
            '_13332' => 'Toilet Remarks',
            '_13333' => 'Waste Management',
            '_13334' => 'Specify Other Waste Management',
            '_13352' => 'Officer Filling Form',
            '_13353' => 'Form Fill Date',
            '_13354' => 'Officer Mobile Number',
            '_13279' => 'MSD ID',
            '_13293' => 'Altitude (Meters)',
            '_13299' => 'Year',
            '_13285' => 'Website',
            '_13309' => 'Injection Room',
        );
    }

}

?>