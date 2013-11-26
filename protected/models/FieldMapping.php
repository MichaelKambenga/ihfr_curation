<?php

/**
 * This is the model class for table "field_mapping".
 *
 * The followings are the available columns in table 'field_mapping':
 * @property integer $id
 * @property string $cc_field_id
 * @property string $pc_field_id
 * @property string $field_name
 * @property string $semantics
 * @property string $cc_field_structure cache
 * @property string $pc_field_structure cache
 */
class FieldMapping extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FieldMapping the static model class
	 */
        const PC_HIERARCHY_FIELD_ID = 1629;
        const CC_HIERARCHY_FIELD_ID = 1810;
        
        const PC_PRIMARY_SITE_CODE = 1714;
        const CC_PRIMARY_SITE_CODE = 1814;
        
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
			array('field_name', 'length', 'max'=>255),
			array('cc_field_structure,pc_field_structure', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cc_field_id, pc_field_id, semantics, cc_field_structure, pc_field_structure', 'safe', 'on'=>'search'),
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
			'cc_field_id' => 'Cc Field',
			'pc_field_id' => 'Pc Field',
                        'field_name'=>'Field Name',
			'semantics' => 'Semantics',
			'cc_field_structure' => 'Cc Field Structure',
                        'pc_field_structure' => 'Pc Fieald Structure',
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
                $criteria->compare('field_name',$this->field_name,true);
		$criteria->compare('cc_field_structure',$this->cc_field_structure,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function generateFields(){
            $models = self::model()->findAll();
            foreach($models as $model){
                echo "public ".'$'."_{$model->cc_field_id};<br />";
            }
            
            
                
              $attr ="public function attributeLabels() {
                  return array(";
              foreach($models as $model){
                  $attr.= " '_".$model->cc_field_id."'=>'"."$model->field_name"."',<br />";
              }      
              $attr .= " );<br />}";
              
              echo $attr;
              
              
            $numericals='';$others='';
            $rules = "public function rules(){
                
                      return array(";
            foreach($models as $model){
                $schema = CJSON::decode($model->cc_field_structure);
                if($schema['kind']=='numeric')
                    $numericals.="_".$model->cc_field_id.",";
                else{
                    $others.="_".$model->cc_field_id.",";
                }
                
            }
            
            $rules.= "array('note','required'),";
            $rules.= "array('".$numericals."','numerical','integerOnly'=>true),";
            $rules.= "array('".$others."','safe'),";
           
            $rules .= " );<br />}";
            
            echo $rules;
        }
}