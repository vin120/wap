<?php

/**
 * This is the model class for table "vcos_cruise_deck_location".
 *
 * The followings are the available columns in table 'vcos_cruise_deck_location':
 * @property string $id
 * @property string $deck_point_id
 * @property integer $location_x
 * @property integer $location_y
 * @property integer $status
 * @property string $deck_id
 */
class VcosCruiseDeckLocation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VcosCruiseDeckLocation the static model class
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
		return 'vcos_cruise_deck_location';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('location_x, location_y, status', 'numerical', 'integerOnly'=>true),
			array('deck_point_id, deck_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, deck_point_id, location_x, location_y, status, deck_id', 'safe', 'on'=>'search'),
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
			'deck_point_id' => 'Deck Point',
			'location_x' => 'Location X',
			'location_y' => 'Location Y',
			'status' => 'Status',
			'deck_id' => 'Deck',
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
		$criteria->compare('deck_point_id',$this->deck_point_id,true);
		$criteria->compare('location_x',$this->location_x);
		$criteria->compare('location_y',$this->location_y);
		$criteria->compare('status',$this->status);
		$criteria->compare('deck_id',$this->deck_id,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}