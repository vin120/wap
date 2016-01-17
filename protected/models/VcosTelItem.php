<?php

/**
 * This is the model class for table "vcos_tel_item".
 *
 * The followings are the available columns in table 'vcos_tel_item':
 * @property string $tel_id
 * @property integer $sale_price
 * @property integer $tel_time
 * @property integer $status
 */
class VcosTelItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VcosTelItem the static model class
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
		return 'vcos_tel_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sale_price, tel_time, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tel_id, sale_price, tel_time, status', 'safe', 'on'=>'search'),
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
			'tel_id' => 'Tel',
			'sale_price' => 'Sale Price',
			'tel_time' => 'Tel Time',
			'status' => 'Status',
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

		$criteria->compare('tel_id',$this->tel_id,true);
		$criteria->compare('sale_price',$this->sale_price);
		$criteria->compare('tel_time',$this->tel_time);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}