<?php

/**
 * This is the model class for table "vcos_survey_recode".
 *
 * The followings are the available columns in table 'vcos_survey_recode':
 * @property integer $id
 * @property integer $survey_id
 * @property string $membership_code
 * @property string $create_time
 * @property integer $star_value
 */
class VcosSurveyRecode extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VcosSurveyRecode the static model class
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
		return 'vcos_survey_recode';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('survey_id, star_value', 'numerical', 'integerOnly'=>true),
			array('membership_code', 'length', 'max'=>32),
			array('create_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, survey_id, membership_code, create_time, star_value', 'safe', 'on'=>'search'),
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
			'survey_id' => 'Survey',
			'membership_code' => 'Membership Code',
			'create_time' => 'Create Time',
			'star_value' => 'Star Value',
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
		$criteria->compare('survey_id',$this->survey_id);
		$criteria->compare('membership_code',$this->membership_code,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('star_value',$this->star_value);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}