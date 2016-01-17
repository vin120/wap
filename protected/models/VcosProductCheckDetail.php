<?php

/**
 * This is the model class for table "vcos_product_check_detail".
 *
 * The followings are the available columns in table 'vcos_product_check_detail':
 * @property string $id
 * @property string $check_code
 * @property string $product_name
 * @property string $inventory_num
 * @property integer $check_num
 * @property string $product_code
 */
class VcosProductCheckDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VcosProductCheckDetail the static model class
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
		return 'vcos_product_check_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('check_num', 'numerical', 'integerOnly'=>true),
			array('check_code, product_name, product_code', 'length', 'max'=>255),
			array('inventory_num', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, check_code, product_name, inventory_num, check_num, product_code', 'safe', 'on'=>'search'),
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
			'product_name' => 'Product Name',
			'inventory_num' => 'Inventory Num',
			'check_num' => 'Check Num',
			'product_code' => 'Product Code',
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
		$criteria->compare('product_name',$this->product_name,true);
		$criteria->compare('inventory_num',$this->inventory_num,true);
		$criteria->compare('check_num',$this->check_num);
		$criteria->compare('product_code',$this->product_code,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}