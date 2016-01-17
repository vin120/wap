<?php

/**
 * This is the model class for table "vcos_shop_category".
 *
 * The followings are the available columns in table 'vcos_shop_category':
 * @property string $sc_id
 * @property string $shop_id
 * @property integer $shop_category_id
 * @property string $shop_category_name
 * @property integer $parent_cid
 * @property integer $sort_order
 * @property integer $is_show_main
 */
class VcosShopCategory extends PrCActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VcosShopCategory the static model class
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
		return 'vcos_shop_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shop_id, shop_category_id, parent_cid', 'required'),
			array('shop_category_id, parent_cid, sort_order, is_show_main', 'numerical', 'integerOnly'=>true),
			array('shop_id', 'length', 'max'=>10),
			array('shop_category_name', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sc_id, shop_id, shop_category_id, shop_category_name, parent_cid, sort_order, is_show_main', 'safe', 'on'=>'search'),
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
			'sc_id' => 'Sc',
			'shop_id' => 'Shop',
			'shop_category_id' => 'Shop Category',
			'shop_category_name' => 'Shop Category Name',
			'parent_cid' => 'Parent Cid',
			'sort_order' => 'Sort Order',
			'is_show_main' => 'Is Show Main',
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

		$criteria->compare('sc_id',$this->sc_id,true);
		$criteria->compare('shop_id',$this->shop_id,true);
		$criteria->compare('shop_category_id',$this->shop_category_id);
		$criteria->compare('shop_category_name',$this->shop_category_name,true);
		$criteria->compare('parent_cid',$this->parent_cid);
		$criteria->compare('sort_order',$this->sort_order);
		$criteria->compare('is_show_main',$this->is_show_main);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}