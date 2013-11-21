<?php

/**
 * This is the model class for table "ha_logins".
 *
 * The followings are the available columns in table 'ha_logins':
 * @property integer $userId
 * @property string $loginProvider
 * @property string $loginProviderIdentifier
 *
 * The followings are the available model relations:
 * @property User $user
 */
class HaLogin extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return HaLogin the static model class
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
        return 'ha_logins';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('userId, loginProvider, loginProviderIdentifier', 'required'),
            array('userId', 'numerical', 'integerOnly'=>true),
            array('loginProvider', 'length', 'max'=>50),
            array('loginProviderIdentifier', 'length', 'max'=>100),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('userId, loginProvider, loginProviderIdentifier', 'safe', 'on'=>'search'),
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
            'user' => array(self::BELONGS_TO, 'User', 'userId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'userId' => 'User',
            'loginProvider' => 'Login Provider',
            'loginProviderIdentifier' => 'Login Provider Identifier',
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

        $criteria->compare('userId',$this->userId);
        $criteria->compare('loginProvider',$this->loginProvider,true);
        $criteria->compare('loginProviderIdentifier',$this->loginProviderIdentifier,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

	
	public static function getUser($loginProvider,$loginProviderIdentity) {
		$criteria=new CDbCriteria;
		$criteria->compare('loginProvider',$loginProvider,true);
		$criteria->compare('loginProviderIdentifier',$loginProviderIdentity,true);

		$login = new CActiveDataProvider('HaLogin', array(
			'criteria'=>$criteria,
		));
		
		if ($login->itemCount == 0) {
			return null;
		} else {
			// TODO - Can't seem to get this to work with relations properly....
			$tmp = $login->getData();
			$user = new User();
			return $user->findByPk($tmp[0]->userId);
		}
		
	}
	
	public static function getLogins($userId) {
		$criteria=new CDbCriteria;
		$criteria->compare('userId',$userId,true);
		$data= new CActiveDataProvider('HaLogin', array(
			'criteria'=>$criteria,
		));
		return $data->getData();
	}
	
	public static function getLogin($userId,$provider) {
		$criteria=new CDbCriteria;
		$criteria->compare('userId',$userId,true);
		$criteria->compare('loginProvider',$provider,true);
		$data= new CActiveDataProvider('HaLogin', array(
			'criteria'=>$criteria,
		));
		$tmp = $data->getData();
		return $tmp[0];
	}
}