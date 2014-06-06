<?php

/**
 * This is the model class for table "change_request".
 *
 * The followings are the available columns in table 'change_request':
 * @property integer $id
 * @property string $primary_site_code
 * @property integer $cc_site_id
 * @property string $version_id
 * @property integer $requested_by
 * @property string $request_type
 * @property string $status
 * @property string $requested_date
 * @property string $reviewed_date
 * @property integer $reviewed_by
 *
 * The followings are the available model relations:
 * @property User $requestedBy
 * @property ChangeRequestFields[] $changeRequestFields
 * @property ChangeRequestNote[] $changeRequestNotes
 */
class ChangeRequest extends CActiveRecord {

    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;
    const STATUS_REJECTED = 3;
    const TYPE_CREATE = 1;
    const TYPE_UPDATE = 2;
    const TYPE_DELETE = 3;

    public $note;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ChangeRequest the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'change_request';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('requested_by, request_type, requested_date', 'required'),
            array('cc_site_id, requested_by, reviewed_by', 'numerical', 'integerOnly' => true),
            array('primary_site_code, version_id, request_type, status', 'length', 'max' => 45),
            array('reviewed_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, primary_site_code, cc_site_id, version_id, requested_by, request_type, status, requested_date, reviewed_date, reviewed_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'requestedBy' => array(self::BELONGS_TO, 'User', 'requested_by'),
            'changeRequestFields' => array(self::HAS_MANY, 'ChangeRequestFields', 'change_request_id'),
            'changeRequestNotes' => array(self::HAS_MANY, 'ChangeRequestNote', 'change_request_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'primary_site_code' => 'Primary Site Code',
            'cc_site_id' => 'Cc Site',
            'version_id' => 'Version',
            'requested_by' => 'Requested By',
            'request_type' => 'Request Type',
            'status' => 'Status',
            'requested_date' => 'Requested Date',
            'reviewed_date' => 'Reviewed Date',
            'reviewed_by' => 'Reviewed By',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('primary_site_code', $this->primary_site_code, true);
        $criteria->compare('cc_site_id', $this->cc_site_id);
        $criteria->compare('version_id', $this->version_id, true);
        $criteria->compare('requested_by', $this->requested_by);
        $criteria->compare('request_type', $this->request_type, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('requested_date', $this->requested_date, true);
        $criteria->compare('reviewed_date', $this->reviewed_date, true);
        $criteria->compare('reviewed_by', $this->reviewed_by);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function myRequests() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $criteria = new CDbCriteria;
        $criteria->compare('requested_by', Yii::app()->user->getState('user_id'));
        $criteria->compare('status', ChangeRequest::STATUS_PENDING);
        //$criteria->limit = 10;
        $criteria->order = 'requested_date DESC';
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            //'pagination' => false
            'pagination'=>array(
                'pageSize'=>10
            )
            
        ));
    }
    
    public function myApprovals(){
        
        $criteria = new CDbCriteria();
        $criteria->compare('reviewed_by', Yii::app()->user->getState('user_id'));
        $criteria->order = 'reviewed_date DESC';
        return new CActiveDataProvider($this,array(
            'criteria' => $criteria,
            //'pagination' => false,
            'pagination'=>array(
                'pageSize'=>10
            )
        ));
    }

    public static function getFieldValues($properties, $collection_id) {

        $siteProperties = array();

        if ($properties) {
            foreach ($properties as $key => $property) {

                if ($collection_id == Yii::app()->params['resourceMapConfig']['curation_collection_id']) {
                    $fieldModel = FieldMapping::model()->find('cc_field_id=:key', array(':key' => $key));
                    $response = $fieldModel->cc_field_structure;
                } elseif ($collection_id == Yii::app()->params['resourceMapConfig']['public_collection_id']) {
                    $fieldModel = FieldMapping::model()->find('pc_field_id=:key', array(':key' => $key));
                    $response = $fieldModel->pc_field_structure;
                }


                $fieldDetails = CJSON::decode($response, true);

                if ($fieldDetails['config']) {
                    if (array_key_exists('options', $fieldDetails['config'])) {

                        if (is_array($property)) {
                            foreach ($property as $k => $value) {
                                foreach ($fieldDetails['config']['options'] as $option) {
                                    if ($option['id'] == $value) {
                                        $siteProperties[$fieldDetails['name']][] = $option['label'];
                                    }
                                }
                            }
                        } else {
                            foreach ($fieldDetails['config']['options'] as $option) {
                                if ($option['id'] == $property) {
                                    $siteProperties[$fieldDetails['name']] = $option['label'];
                                }
                            }
                        }
                    } else {
                        $siteProperties[$fieldDetails['name']] = $property;
                    }
                } else {
                    $siteProperties[$fieldDetails['name']] = $property;
                }
            }
        }



        return $siteProperties;
    }

    public function retrieveNewSiteFields() {
        $fieldsArray = array();
        $curationController = new CurationController('curation');
        $site = $curationController->loadFacility($this->cc_site_id, Yii::app()->params['resourceMapConfig']['curation_collection_id']
        );
        if ($site) {
            $fields = self::getFieldValues($site['properties'], Yii::app()->params['resourceMapConfig']['curation_collection_id']);

            foreach ($fields as $key => $field) {
                if (!is_array($field)) {
                    $fieldsArray[$key] = $field;
                } else {
                    $concatValues = '';
                    foreach ($field as $k => $value) {
                        $concatValues.=$value . '<br />';
                    }
                    $fieldsArray[$key] = $concatValues;
                }
            }
        }
        return $fieldsArray;
    }

    public function retrieveSiteFields($id, $collection_id) {
        $curationController = new CurationController('curation');
        $site = $curationController->loadFacility($id, $collection_id
        );
        $fields = self::getFieldValues($site['properties'], $collection_id);
        $fieldsArray = array();
        foreach ($fields as $key => $field) {
            if (!is_array($field)) {
                $fieldsArray[$key] = $field;
            } else {
                $concatValues = '';
                foreach ($field as $k => $value) {
                    $concatValues.=$value . '<br />';
                }
                $fieldsArray[$key] = $concatValues;
            }
        }

        return $fieldsArray;
    }

    /*
     * 
     * @return array('fieldName'=>array('from'=>'','to'=>''))
     */

    public function retrieveFieldsChanges() {
        $fromToFieldsArray = array();
        //look for modified fields in the change_request_fields table
        $modifiedFields = ChangeRequestFields::model()->findAllByAttributes(array('change_request_id' => $this->id));

        $responseArray = self::getSiteHistoryByVersion(
                        Yii::app()->params['resourceMapConfig']['curation_collection_id'], $this->cc_site_id, $this->version_id
        );
        $proposedProperties = isset($responseArray[0]['properties'])?$responseArray[0]['properties']:array();
        //retrieve new values
        $newFields = array();
        foreach ($proposedProperties as $key => $property) {
            foreach ($modifiedFields as $modifiedField) {
                if ($modifiedField->field_id == $key) {
                    $newFields[$key] = $property;
                }
            }
        }

        //retrieve public values
        $curationController = new CurationController('curation');
        $results = $curationController->loadFacilityByPSC($this->primary_site_code, Yii::app()->params['resourceMapConfig']['public_collection_id']);
        $pc_site_id = $results['sites'][0]['id'];
        $site = $curationController->loadFacility($pc_site_id, Yii::app()->params['resourceMapConfig']['public_collection_id']
        );
        $siteProperties = isset($site['properties'])?$site['properties']:array();
        $pubFields = array();
        foreach ($siteProperties as $key => $property) {
            foreach ($modifiedFields as $modifiedField) {
                $fieldMapping = FieldMapping::model()->findByAttributes(array('cc_field_id' => $modifiedField->field_id));
                if ($fieldMapping->pc_field_id == $key) {
                    $pubFields[$key] = $property;
                }
            }
        }

        $curationFields = self::getFieldValues($newFields, Yii::app()->params['resourceMapConfig']['curation_collection_id']);

        $publicFields = self::getFieldValues($pubFields, Yii::app()->params['resourceMapConfig']['public_collection_id']);

        foreach ($curationFields as $key => $field) {
            if (!is_array($field)) {
                $publicValue = 'Not set';
                if (array_key_exists($key, $publicFields)) {
                    $publicValue = $publicFields[$key];
                }
                $fromToFieldsArray[$key] = array(
                    'cur' => $field,
                    'pub' => $publicValue,
                );
            } else {
                $curConcatValues = '';
                foreach ($field as $k => $value) {
                    $curConcatValues.= $value . '<br />';
                }
                $pubConcatValues = 'Not set';
                if (array_key_exists($key, $publicFields)) {
                    $pubConcatValues = '';
                    foreach ($publicFields[$key] as $k => $value) {
                        $pubConcatValues.= $value . '<br />';
                    }
                }
                $fromToFieldsArray[$key] = array(
                    'cur' => $curConcatValues,
                    'pub' => $pubConcatValues,
                );
            }
        }

        return $fromToFieldsArray;
    }

    public static function getSiteHistoryByVersion($collection_id, $id, $version) {
        $url = Yii::app()->params['api-domain'] . "/api/collections/" .
                $collection_id .
                "/sites/{$id}/histories.json?version=$version";
        $response = RestUtility::execCurl($url);
        return CJSON::decode($response, true);
    }
    
    
    public function  getRequestStatus($val,$style=false){
        if(self::STATUS_PENDING == $val){
            if($style == true) return TbHtml::badge('Pending Approval', array('color'=>  TbHtml::BADGE_COLOR_WARNING));
            return "Pending Approval";
        }
        elseif(self::STATUS_APPROVED == $val){
            if($style == true) return TbHtml::badge('Approved', array('color'=>  TbHtml::BADGE_COLOR_SUCCESS));
            return "Approved";
        }
        elseif(self::STATUS_REJECTED == $val){
            if($style == true) return TbHtml::badge('Rejected', array('color'=>  TbHtml::BADGE_COLOR_IMPORTANT));
            return "Rejected";
        }
        if($style == true) return TbHtml::badge('UNKNOWN', array('color'=>  TbHtml::BADGE_COLOR_DEFAULT));
        return 'UNKNOWN';
    }
    
    public function  getRequestType($val,$style=false){
        if(self::TYPE_CREATE == $val){
            if($style == true) return TbHtml::badge('CREATE', array('color'=>  TbHtml::BADGE_COLOR_SUCCESS));
            return "CREATE";
        }
        elseif(self::TYPE_UPDATE == $val){
            if($style == true) return TbHtml::badge('UPDATE', array('color'=>  TbHtml::BADGE_COLOR_WARNING));
            return "UPDATE";
        }
        elseif(self::TYPE_DELETE == $val){
            if($style == true) return TbHtml::badge('DELETE', array('color'=>  TbHtml::BADGE_COLOR_IMPORTANT));
            return "DELETE";
        }
        if($style == true) return TbHtml::badge('UNKNOWN', array('color'=>  TbHtml::BADGE_COLOR_DEFAULT));
        return 'UNKNOWN';
    }
    
    public static function getChangeRequestNotes($changeRequest){
        $notes = '';
        foreach($changeRequest->changeRequestNotes as $changeRequestNote){
            $notes .= "<b>".$changeRequestNote->note."</b>"."-"
                   .User::getUserSignature($changeRequestNote->user_id).
                   "<br />"."<br />"
                    ;
        }
        return $notes;
    }
    
    public static function getRequestNotes($changeRequest){
        $notes = '';
        foreach($changeRequest->changeRequestNotes as $changeRequestNote){
            $notes .= "<b>".$changeRequestNote->note."</b>"."-"
                   .User::getSignature($changeRequestNote->user_id).
                   "<br />"."<br />"
                    ;
        }
        return $notes;
    }


}