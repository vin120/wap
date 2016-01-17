<?php

/**
 * This is the model class for table "vcos_tel_sn_code".
 *
 * The followings are the available columns in table 'vcos_tel_sn_code':
 * @property string $id
 * @property string $sn_code
 * @property string $sn_password
 * @property string $start_time
 * @property string $end_time
 * @property integer $status
 * @property integer $tel_id
 */
class VcosTelSnCode extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VcosTelSnCode the static model class
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
		return 'vcos_tel_sn_code';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, tel_id', 'numerical', 'integerOnly'=>true),
			array('sn_code, sn_password', 'length', 'max'=>32),
			array('start_time, end_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sn_code, sn_password, start_time, end_time, status, tel_id', 'safe', 'on'=>'search'),
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
			'sn_code' => 'Sn Code',
			'sn_password' => 'Sn Password',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'status' => 'Status',
			'tel_id' => 'Tel',
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
		$criteria->compare('sn_code',$this->sn_code,true);
		$criteria->compare('sn_password',$this->sn_password,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('tel_id',$this->tel_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}