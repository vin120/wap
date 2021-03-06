<?php

/**
 * This is the model class for table "vcos_member_order_detail".
 *
 * The followings are the available columns in table 'vcos_member_order_detail':
 * @property string $order_detail_id
 * @property string $order_serial_num
 * @property integer $goods_id
 * @property string $goods_name
 * @property string $goods_img_url
 * @property integer $goods_price
 * @property integer $buy_num
 * @property integer $sub_goods_state
 * @property string $sub_goods_remark
 * @property string $last_change_time
 * @property integer $standard_price
 */
class VcosMemberOrderDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VcosMemberOrderDetail the static model class
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
		return 'vcos_member_order_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_serial_num, goods_id, goods_name', 'required'),
			array('goods_id, goods_price, buy_num, sub_goods_state, standard_price', 'numerical', 'integerOnly'=>true),
			array('order_serial_num', 'length', 'max'=>32),
			array('goods_name, goods_img_url', 'length', 'max'=>255),
			array('sub_goods_remark', 'length', 'max'=>100),
			array('last_change_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('order_detail_id, order_serial_num, goods_id, goods_name, goods_img_url, goods_price, buy_num, sub_goods_state, sub_goods_remark, last_change_time, standard_price', 'safe', 'on'=>'search'),
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
			'order_detail_id' => 'Order Detail',
			'order_serial_num' => 'Order Serial Num',
			'goods_id' => 'Goods',
			'goods_name' => 'Goods Name',
			'goods_img_url' => 'Goods Img Url',
			'goods_price' => 'Goods Price',
			'buy_num' => 'Buy Num',
			'sub_goods_state' => 'Sub Goods State',
			'sub_goods_remark' => 'Sub Goods Remark',
			'last_change_time' => 'Last Change Time',
			'standard_price' => 'Standard Price',
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

		$criteria->compare('order_detail_id',$this->order_detail_id,true);
		$criteria->compare('order_serial_num',$this->order_serial_num,true);
		$criteria->compare('goods_id',$this->goods_id);
		$criteria->compare('goods_name',$this->goods_name,true);
		$criteria->compare('goods_img_url',$this->goods_img_url,true);
		$criteria->compare('goods_price',$this->goods_price);
		$criteria->compare('buy_num',$this->buy_num);
		$criteria->compare('sub_goods_state',$this->sub_goods_state);
		$criteria->compare('sub_goods_remark',$this->sub_goods_remark,true);
		$criteria->compare('last_change_time',$this->last_change_time,true);
		$criteria->compare('standard_price',$this->standard_price);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}