<?php

/**
 * This is the model class for table "vcos_shop_operation_category".
 *
 * The followings are the available columns in table 'vcos_shop_operation_category':
 * @property integer $so_id
 * @property integer $shop_id
 * @property string $category_code
 * @property integer $tree_type
 * @property integer $is_sub_all
 * @property integer $status
 * @property string $parent_catogory_code
 */
class VcosShopOperationCategory extends PrCActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VcosShopOperationCategory the static model class
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
		return 'vcos_shop_operation_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shop_id, tree_type, is_sub_all, status', 'numerical', 'integerOnly'=>true),
			array('category_code, parent_catogory_code', 'length', 'max'=>12),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('so_id, shop_id, category_code, tree_type, is_sub_all, status, parent_catogory_code', 'safe', 'on'=>'search'),
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
			'so_id' => 'So',
			'shop_id' => 'Shop',
			'category_code' => 'Category Code',
			'tree_type' => 'Tree Type',
			'is_sub_all' => 'Is Sub All',
			'status' => 'Status',
			'parent_catogory_code' => 'Parent Catogory Code',
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

		$criteria->compare('so_id',$this->so_id);
		$criteria->compare('shop_id',$this->shop_id);
		$criteria->compare('category_code',$this->category_code,true);
		$criteria->compare('tree_type',$this->tree_type);
		$criteria->compare('is_sub_all',$this->is_sub_all);
		$criteria->compare('status',$this->status);
		$criteria->compare('parent_catogory_code',$this->parent_catogory_code,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}