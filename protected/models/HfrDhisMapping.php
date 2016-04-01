<?php

/**
 * This is the model class for table "hfr_dhis_mapping".
 *
 * The followings are the available columns in table 'hfr_dhis_mapping':
 * @property integer $id
 * @property string $hfr_id
 * @property string $dhis_id
 * @property parent_dhis_id
 * @property string $description
 * @property string $type
 */
class HfrDhisMapping extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return HfrDhisMapping the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'hfr_dhis_mapping';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('hfr_id, dhis_id, description, type', 'required'),
            array('hfr_id, dhis_id, description, type,parent_dhis_id', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, hfr_id, dhis_id, description, type', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'hfr_id' => 'Hfr',
            'dhis_id' => 'Dhis',
            'parent_dhis_id' => 'Parent Dhis',
            'description' => 'Description',
            'type' => 'Type',
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
        $criteria->compare('hfr_id', $this->hfr_id, true);
        $criteria->compare('dhis_id', $this->dhis_id, true);
        $criteria->compare('parent_dhis_id', $this->parent_dhis_id, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('type', $this->type, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
