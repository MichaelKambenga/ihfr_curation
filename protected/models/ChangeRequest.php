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
class ChangeRequest extends CActiveRecord
{
    
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
     
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'change_request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('primary_site_code, requested_by, request_type, requested_date', 'required'),
			array('cc_site_id, requested_by, reviewed_by', 'numerical', 'integerOnly'=>true),
			array('primary_site_code, version_id, request_type, status', 'length', 'max'=>45),
			array('reviewed_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, primary_site_code, cc_site_id, version_id, requested_by, request_type, status, requested_date, reviewed_date, reviewed_by', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
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
	public function attributeLabels()
	{
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
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('primary_site_code',$this->primary_site_code,true);
		$criteria->compare('cc_site_id',$this->cc_site_id);
		$criteria->compare('version_id',$this->version_id,true);
		$criteria->compare('requested_by',$this->requested_by);
		$criteria->compare('request_type',$this->request_type,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('requested_date',$this->requested_date,true);
		$criteria->compare('reviewed_date',$this->reviewed_date,true);
		$criteria->compare('reviewed_by',$this->reviewed_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function getFieldValues($site_id){
            $url = Yii::app()->params['api-domain']."/collections/".
                   Yii::app()->params['resourceMapConfig']['curation_collection_id'].
                   "/sites/$site_id.json"; 
            $response = RestUtility::execCurl($url);
            $site = CJSON::decode($response,true);
            $siteProperties = array();
          
            foreach($site['properties'] as $key=>$property){
                   $url = Yii::app()->params['api-domain']."/collections/".
                   Yii::app()->params['resourceMapConfig']['curation_collection_id'].
                   "/fields/{$key}.json";
                   $response = RestUtility::execCurl($url);
                   $fieldDetails = CJSON::decode($response,true);
                   
                   if($fieldDetails['config']){
                       if(array_key_exists('options',$fieldDetails['config'])){

                           if(is_array($property)){
                               foreach($property as $k=>$value){
                                   foreach($fieldDetails['config']['options'] as $option){
                                       if($option['id'] == $value){
                                           $siteProperties[$fieldDetails['name']][] = $option['label'];
                                       }
                                   }
                               }
                           }
                           else{
                               foreach($fieldDetails['config']['options'] as $option){
                                   if($option['id'] == $property){
                                       $siteProperties[$fieldDetails['name']] = $option['label'];
                                   }
                               }
                           }
                       }
                       else{
                           $siteProperties[$fieldDetails['name']] = $property;
                       }
                 }else{ 
                     $siteProperties[$fieldDetails['name']] = $property;
                 }
                   
            }
            

            
            
            return $siteProperties;
        }
}