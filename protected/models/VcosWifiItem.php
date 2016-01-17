<?php

/**
 * This is the model class for table "vcos_wifi_item".
 *
 * The followings are the available columns in table 'vcos_wifi_item':
 * @property string $wifi_id
 * @property integer $sale_price
 * @property integer $wifi_time
 * @property integer $status
 */
class VcosWifiItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VcosWifiItem the static model class
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
		return 'vcos_wifi_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sale_price, wifi_time, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('wifi_id, sale_price, wifi_time, status', 'safe', 'on'=>'search'),
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
			'wifi_id' => 'Wifi',
			'sale_price' => 'Sale Price',
			'wifi_time' => 'Wifi Time',
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

		$criteria->compare('wifi_id',$this->wifi_id,true);
		$criteria->compare('sale_price',$this->sale_price);
		$criteria->compare('wifi_time',$this->wifi_time);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}