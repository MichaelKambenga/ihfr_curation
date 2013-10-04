<?php

/**
 * This is the model class for table "field_mapping".
 *
 * The followings are the available columns in table 'field_mapping':
 * @property integer $id
 * @property string $cc_field_id
 * @property string $pc_field_id
 * @property string $semantics
 *
 * The followings are the available model relations:
 * @property ChangeRequestFields[] $changeRequestFields
 */
class FieldMapping extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FieldMapping the static model class
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
		return 'field_mapping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cc_field_id, pc_field_id', 'length', 'max'=>45),
			array('semantics', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cc_field_id, pc_field_id, semantics', 'safe', 'on'=>'search'),
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
			'changeRequestFields' => array(self::HAS_MANY, 'ChangeRequestFields', 'field_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cc_field_id' => 'Cc Field',
			'pc_field_id' => 'Pc Field',
			'semantics' => 'Semantics',
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
		$criteria->compare('cc_field_id',$this->cc_field_id,true);
		$criteria->compare('pc_field_id',$this->pc_field_id,true);
		$criteria->compare('semantics',$this->semantics,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}