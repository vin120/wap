<?php

/**
 * This is the model class for table "vcos_member_order".
 *
 * The followings are the available columns in table 'vcos_member_order':
 * @property string $order_id
 * @property string $order_serial_num
 * @property string $membership_code
 * @property integer $totale_price
 * @property integer $pay_type
 * @property string $order_check_num
 * @property string $pay_time
 * @property string $order_create_time
 * @property integer $order_status
 * @property string $order_remark
 * @property integer $is_read
 * @property integer $order_type
 * @property integer $store_id
 * @property string $store_name
 * @property integer $receiving_way
 * @property string $consignee_address
 * @property string $delivery_time
 * @property integer $is_comment
 * @property string $remark
 */
class VcosMemberOrder extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VcosMemberOrder the static model class
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
		return 'vcos_member_order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_serial_num, membership_code, order_create_time', 'required'),
			array('totale_price, pay_type, order_status, is_read, order_type, store_id, receiving_way, is_comment', 'numerical', 'integerOnly'=>true),
			array('order_serial_num, membership_code, order_check_num', 'length', 'max'=>32),
			array('order_remark, store_name', 'length', 'max'=>100),
			array('consignee_address, remark', 'length', 'max'=>255),
			array('delivery_time', 'length', 'max'=>50),
			array('pay_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('order_id, order_serial_num, membership_code, totale_price, pay_type, order_check_num, pay_time, order_create_time, order_status, order_remark, is_read, order_type, store_id, store_name, receiving_way, consignee_address, delivery_time, is_comment, remark', 'safe', 'on'=>'search'),
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
			'order_id' => 'Order',
			'order_serial_num' => 'Order Serial Num',
			'membership_code' => 'Membership Code',
			'totale_price' => 'Totale Price',
			'pay_type' => 'Pay Type',
			'order_check_num' => 'Order Check Num',
			'pay_time' => 'Pay Time',
			'order_create_time' => 'Order Create Time',
			'order_status' => 'Order Status',
			'order_remark' => 'Order Remark',
			'is_read' => 'Is Read',
			'order_type' => 'Order Type',
			'store_id' => 'Store',
			'store_name' => 'Store Name',
			'receiving_way' => 'Receiving Way',
			'consignee_address' => 'Consignee Address',
			'delivery_time' => 'Delivery Time',
			'is_comment' => 'Is Comment',
			'remark' => 'Remark',
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

		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('order_serial_num',$this->order_serial_num,true);
		$criteria->compare('membership_code',$this->membership_code,true);
		$criteria->compare('totale_price',$this->totale_price);
		$criteria->compare('pay_type',$this->pay_type);
		$criteria->compare('order_check_num',$this->order_check_num,true);
		$criteria->compare('pay_time',$this->pay_time,true);
		$criteria->compare('order_create_time',$this->order_create_time,true);
		$criteria->compare('order_status',$this->order_status);
		$criteria->compare('order_remark',$this->order_remark,true);
		$criteria->compare('is_read',$this->is_read);
		$criteria->compare('order_type',$this->order_type);
		$criteria->compare('store_id',$this->store_id);
		$criteria->compare('store_name',$this->store_name,true);
		$criteria->compare('receiving_way',$this->receiving_way);
		$criteria->compare('consignee_address',$this->consignee_address,true);
		$criteria->compare('delivery_time',$this->delivery_time,true);
		$criteria->compare('is_comment',$this->is_comment);
		$criteria->compare('remark',$this->remark,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}