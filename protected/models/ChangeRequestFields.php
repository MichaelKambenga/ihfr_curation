<?php

/**
 * This is the model class for table "change_request_fields".
 *
 * The followings are the available columns in table 'change_request_fields':
 * @property string $id
 * @property integer $change_request_id
 * @property integer $field_id
 *
 * The followings are the available model relations:
 * @property ChangeRequest $changeRequest
 * @property FieldMapping $field
 */
class ChangeRequestFields extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ChangeRequestFields the static model class
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
		return 'change_request_fields';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, change_request_id, field_id', 'required'),
			array('change_request_id, field_id', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, change_request_id, field_id', 'safe', 'on'=>'search'),
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
			'changeRequest' => array(self::BELONGS_TO, 'ChangeRequest', 'change_request_id'),
			'field' => array(self::BELONGS_TO, 'FieldMapping', 'field_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'change_request_id' => 'Change Request',
			'field_id' => 'Field',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('change_request_id',$this->change_request_id);
		$criteria->compare('field_id',$this->field_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}