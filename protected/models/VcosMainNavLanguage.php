<?php

/**
 * This is the model class for table "vcos_main_nav_language".
 *
 * The followings are the available columns in table 'vcos_main_nav_language':
 * @property integer $id
 * @property integer $nav_id
 * @property string $img_url
 * @property string $name
 * @property string $bg_color
 * @property string $iso
 */
class VcosMainNavLanguage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VcosMainNavLanguage the static model class
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
		return 'vcos_main_nav_language';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nav_id', 'numerical', 'integerOnly'=>true),
			array('img_url, iso', 'length', 'max'=>255),
			array('name', 'length', 'max'=>20),
			array('bg_color', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nav_id, img_url, name, bg_color, iso', 'safe', 'on'=>'search'),
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
			'nav_id' => 'Nav',
			'img_url' => 'Img Url',
			'name' => 'Name',
			'bg_color' => 'Bg Color',
			'iso' => 'Iso',
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
		$criteria->compare('nav_id',$this->nav_id);
		$criteria->compare('img_url',$this->img_url,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('bg_color',$this->bg_color,true);
		$criteria->compare('iso',$this->iso,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}