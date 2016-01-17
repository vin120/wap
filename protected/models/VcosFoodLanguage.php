<?php

/**
 * This is the model class for table "vcos_food_language".
 *
 * The followings are the available columns in table 'vcos_food_language':
 * @property string $id
 * @property string $food_id
 * @property string $iso
 * @property string $main_title
 * @property string $food_title
 */
class VcosFoodLanguage extends MyCActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VcosFoodLanguage the static model class
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
		return 'vcos_food_language';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('food_id, iso, main_title, food_title', 'required'),
			array('food_id', 'length', 'max'=>10),
			array('iso', 'length', 'max'=>60),
			array('main_title, food_title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, food_id, iso, main_title, food_title', 'safe', 'on'=>'search'),
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
			'food_id' => 'Food',
			'iso' => 'Iso',
			'main_title' => 'Main Title',
			'food_title' => 'Food Title',
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
		$criteria->compare('food_id',$this->food_id,true);
		$criteria->compare('iso',$this->iso,true);
		$criteria->compare('main_title',$this->main_title,true);
		$criteria->compare('food_title',$this->food_title,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}