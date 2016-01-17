<?php

/**
 * This is the model class for table "vcos_product_check".
 *
 * The followings are the available columns in table 'vcos_product_check':
 * @property string $id
 * @property string $check_code
 * @property string $check_time
 * @property integer $check_type
 * @property string $check_shop
 * @property string $check_people
 */
class VcosProductCheck extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VcosProductCheck the static model class
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
		return 'vcos_product_check';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('check_type', 'numerical', 'integerOnly'=>true),
			array('check_code, check_shop, check_people', 'length', 'max'=>255),
			array('check_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, check_code, check_time, check_type, check_shop, check_people', 'safe', 'on'=>'search'),
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
			'check_code' => 'Check Code',
			'check_time' => 'Check Time',
			'check_type' => 'Check Type',
			'check_shop' => 'Check Shop',
			'check_people' => 'Check People',
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
		$criteria->compare('check_code',$this->check_code,true);
		$criteria->compare('check_time',$this->check_time,true);
		$criteria->compare('check_type',$this->check_type);
		$criteria->compare('check_shop',$this->check_shop,true);
		$criteria->compare('check_people',$this->check_people,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}