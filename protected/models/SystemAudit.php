<?php

/**
 * This is the model class for table "system_audit".
 *
 * The followings are the available columns in table 'system_audit':
 * @property integer $auditId
 * @property integer $userId
 * @property string $action
 * @property string $date
 */
class SystemAudit extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SystemAudit the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'system_audit';
    }

    public $number;
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('userId, action', 'required'),
            array('userId', 'numerical', 'integerOnly' => true),
            array('action', 'length', 'max' => 100),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('auditId, userId, action, date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'actor' => array(self::BELONGS_TO, 'User', 'userId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'auditId' => 'Audit',
            'userId' => 'User',
            'action' => 'Action',
            'date' => 'Date',
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
        $criteria->with = array('actor');
        $criteria->compare('actor.userId', $this->userId, true);
        $criteria->compare('action', $this->action, true);
        $criteria->compare('date', $this->date, true);
        $criteria->order = 'date DESC';
        //$criteria->addBetweenCondition('date', $this->date, $this->endDate);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            )
        ));
    }

}