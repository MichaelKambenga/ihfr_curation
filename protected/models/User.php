<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property integer $position_id
 * @property integer $organization_id
 * @property string $email
 * @property string $firstname
 * @property string $lastname
 * @property string $openid_identity
 * @property string $node_id max hierarchy node
   
 * The followings are the available model relations:
 * @property ChangeRequest[] $changeRequests
 * @property ChangeRequestNote[] $changeRequestNotes
 * @property Organization $organization
 * @property Position $position
 */
class User extends CActiveRecord {

    const INACTIVE = 0;
    const ACTIVE = 1;
    const CENTRAL = 1;
    const ZONE = 2;
    const REGION = 3;
    const DISTRICT = 4;
    const COUNCIL = 5;
    

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    public $number;
    public $admin_hierarchy;
    public $zone;
    public $region;
    public $district;
    public $council;
    public $is_user_active;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email,position_id,organization_id,phone_number,firstname,lastname,admin_hierarchy', 'required', 'on' => 'update'),
            array('id, active,position_id, organization_id', 'numerical', 'integerOnly' => true),
            array('admin_hierarchy','validateAdminHierarchy'),
            array('email,firstname,lastname,phone_number,node_id,zone,region,district,council', 'length', 'max' => 45),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id,firstname,lastname,node_id, position_id, organization_id, email,openid_identity,phone_number,active', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'changeRequests' => array(self::HAS_MANY, 'ChangeRequest', 'created_by'),
            'changeRequestNotes' => array(self::HAS_MANY, 'ChangeRequestNote', 'user_id'),
            'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
            'position' => array(self::BELONGS_TO, 'Position', 'position_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'node_id' => 'District',
            'position_id' => 'Position',
            'organization_id' => 'Organization',
            'email' => 'Email',
            'openid_identity' => 'OpenID',
            'active' => 'Active',
            'number' => 'Number',
            'phone_number' => 'Phone Number',
            'zone' => 'Zone',
            'region' => 'Region',
            'district' => 'District',
            'council' => 'Council'
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
        $criteria->compare('firstname', $this->firstname, true);
        $criteria->compare('lastname', $this->lastname, true);
        $criteria->compare('node_id', $this->node_id);
        $criteria->compare('position_id', $this->position_id, true);
        $criteria->compare('organization_id', $this->organization_id, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('phone_number', $this->phone_number, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function hasAccess() {
        $user_id = Yii::app()->user->id;
        return count(AuthAssignment::model()->findAll('userid=:id', array(':id' => $user_id)));
    }

    public static function getUserSignature($id){
        if(is_null($id)){
            return 'NONE';
        }
        $model = self::model()->find(
                'id=:id',array(':id'=>$id)
                );
        return "<br />".
               $model->firstname." ".$model->lastname."<br />".
               $model->phone_number."<br />".
               $model->email."<br />".
               $model->position->position_name."<br />".
               $model->organization->organization_name."<br />".
               self::getFullLocationName($model->node_id);
    }
    
    public static function getSignature($id){
        if(is_null($id)){
            return 'NONE';
        }
        $model = self::model()->find(
                'id=:id',array(':id'=>$id)
                );
        return "<br />".
               $model->firstname." ".$model->lastname."<br />".
               $model->phone_number."<br />".
               $model->email."<br />".
               $model->position->position_name."<br />".
               $model->organization->organization_name."<br />";
       
    }
    
    
    public static function getFullLocationName($node_id){
        $userLocation = "";
        $nodeArray = explode('.', $node_id);
        $levels = count($nodeArray);// e.g TZ.ET.DS.KN.2
        for($i=0;$i < $levels ;$i++){
           if($i==0){
               $userLocation.= Layer::getHierarchyNodeName(implode('.', array_slice($nodeArray, 0, $i+1, true)));
           }
           else{
               $userLocation.= " - ".Layer::getHierarchyNodeName(implode('.', array_slice($nodeArray, 0, $i+1, true)));
           }
        }
        
        return $userLocation;
    }
    
    public function setAdditionalAttributes(){
        $node_id = $this->node_id;
        $nodeArray = explode('.', $node_id);
        $level = count($nodeArray);
        if($level == self::CENTRAL){
            $this->admin_hierarchy = self::CENTRAL;
        }
        elseif($level == self::ZONE){
            $this->admin_hierarchy = self::ZONE;
            $this->zone = $nodeArray[0].".".$nodeArray[1]; // e.g TZ.ET
        }
        elseif($level == self::REGION){
            $this->admin_hierarchy = self::REGION;
            $this->zone = $nodeArray[0].".".$nodeArray[1];
            $this->region = $nodeArray[0].".".$nodeArray[1].".".$nodeArray[2];
        }
        elseif($level == self::DISTRICT){
            $this->admin_hierarchy = self::DISTRICT;
            $this->zone = $nodeArray[0].".".$nodeArray[1];
            $this->region = $nodeArray[0].".".$nodeArray[1].".".$nodeArray[2];
            $this->district = $nodeArray[0].".".$nodeArray[1].".".$nodeArray[2].".".$nodeArray[3];
        }
        elseif($level == self::COUNCIL){
            $this->admin_hierarchy = self::COUNCIL;
            $this->zone = $nodeArray[0].".".$nodeArray[1];
            $this->region = $nodeArray[0].".".$nodeArray[1].".".$nodeArray[2];
            $this->district = $nodeArray[0].".".$nodeArray[1].".".$nodeArray[2].".".$nodeArray[3];
            $this->council = $nodeArray[0].".".$nodeArray[1].".".$nodeArray[2].".".$nodeArray[3].".".$nodeArray[4];
        }
        
        
    }

    public function validateAdminHierarchy() {
           if($this->admin_hierarchy == self::COUNCIL){
                if(empty($this->zone)){
                   $this->addError('zone', 'Zone cannot be blank'); 
                }
                if(empty($this->region)){
                   $this->addError('region', 'Region cannot be blank'); 
                }
                if(empty($this->district)){
                   $this->addError('district', 'District cannot be blank'); 
                }
                if(empty($this->council)){
                   $this->addError('council', 'Council cannot be blank'); 
                }
            }
            elseif($this->admin_hierarchy == self::DISTRICT){
                if(empty($this->zone)){
                   $this->addError('zone', 'Zone cannot be blank'); 
                }
                if(empty($this->region)){
                   $this->addError('region', 'Region cannot be blank'); 
                }
                if(empty($this->district)){
                   $this->addError('district', 'District cannot be blank'); 
                }
            }
            elseif($this->admin_hierarchy == self::REGION){
                if(empty($this->zone)){
                   $this->addError('zone', 'Zone cannot be blank'); 
                }
                if(empty($this->region)){
                   $this->addError('region', 'Region cannot be blank'); 
                }       
            }
            elseif($this->admin_hierarchy == self::ZONE){
                if(empty($this->zone)){
                   $this->addError('zone', 'Zone cannot be blank'); 
                } 
                
            }
            
            return true;
    }

}