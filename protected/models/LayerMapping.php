<?php

/**
 * This is the model class for table "layer_mapping".
 *
 * The followings are the available columns in table 'layer_mapping':
 * @property integer $id
 * @property integer $cc_layer_id
 * @property integer $pc_layer_id
 * @property string $layer_name
 */
class LayerMapping extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LayerMapping the static model class
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
		return 'layer_mapping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cc_layer_id, layer_name', 'required'),
			array('cc_layer_id, pc_layer_id', 'numerical', 'integerOnly'=>true),
			array('layer_name', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cc_layer_id, pc_layer_id, layer_name', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cc_layer_id' => 'Cc Layer',
			'pc_layer_id' => 'Pc Layer',
			'layer_name' => 'Layer Name',
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
		$criteria->compare('cc_layer_id',$this->cc_layer_id);
		$criteria->compare('pc_layer_id',$this->pc_layer_id);
		$criteria->compare('layer_name',$this->layer_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}