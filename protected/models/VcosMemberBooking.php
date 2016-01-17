<?php

/**
 * This is the model class for table "vcos_member_booking".
 *
 * The followings are the available columns in table 'vcos_member_booking':
 * @property integer $id
 * @property string $booking_no
 * @property string $member_code
 * @property string $booking_name
 * @property string $booking_time
 * @property integer $booking_num
 * @property integer $status
 * @property string $store_id
 * @property integer $booking_type
 * @property string $create_time
 * @property integer $is_read
 * @property string $remark
 * @property string $booking_sign
 */
class VcosMemberBooking extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VcosMemberBooking the static model class
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
		return 'vcos_member_booking';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('booking_num, status, booking_type, is_read', 'numerical', 'integerOnly'=>true),
			array('booking_no, member_code, booking_sign', 'length', 'max'=>32),
			array('booking_name, store_id, remark', 'length', 'max'=>255),
			array('booking_time, create_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, booking_no, member_code, booking_name, booking_time, booking_num, status, store_id, booking_type, create_time, is_read, remark, booking_sign', 'safe', 'on'=>'search'),
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
			'booking_no' => 'Booking No',
			'member_code' => 'Member Code',
			'booking_name' => 'Booking Name',
			'booking_time' => 'Booking Time',
			'booking_num' => 'Booking Num',
			'status' => 'Status',
			'store_id' => 'Store',
			'booking_type' => 'Booking Type',
			'create_time' => 'Create Time',
			'is_read' => 'Is Read',
			'remark' => 'Remark',
			'booking_sign' => 'Booking Sign',
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
		$criteria->compare('booking_no',$this->booking_no,true);
		$criteria->compare('member_code',$this->member_code,true);
		$criteria->compare('booking_name',$this->booking_name,true);
		$criteria->compare('booking_time',$this->booking_time,true);
		$criteria->compare('booking_num',$this->booking_num);
		$criteria->compare('status',$this->status);
		$criteria->compare('store_id',$this->store_id,true);
		$criteria->compare('booking_type',$this->booking_type);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('is_read',$this->is_read);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('booking_sign',$this->booking_sign,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}