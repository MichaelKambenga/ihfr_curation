<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property integer $position_id
 * @property integer $organization_id
 * @property string $email
 *
 * The followings are the available model relations:
 * @property ChangeRequest[] $changeRequests
 * @property ChangeRequestNote[] $changeRequestNotes
 * @property Organization $organization
 * @property Position $position
 */
class User extends CActiveRecord {

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

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('position_id, organization_id, email', 'required'),
            array('id, position_id, organization_id', 'numerical', 'integerOnly' => true),
            array('email', 'length', 'max' => 45),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, position_id, organization_id, email', 'safe', 'on' => 'search'),
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
            'position_id' => 'Position',
            'organization_id' => 'Organization',
            'email' => 'Email',
            'number' => 'Number',
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
        $criteria->compare('position_id', $this->position_id);
        $criteria->compare('organization_id', $this->organization_id);
        $criteria->compare('email', $this->email, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}