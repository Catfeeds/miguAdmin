<?php

/**
 * This is the model class for table "{{ver_epg}}".
 *
 * The followings are the available columns in table '{{ver_epg}}':
 * @property string $id
 * @property string $epgName
 * @property integer $epg
 * @property string $delFlag
 * @property string $cTime
 */
class VerEpg extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ver_epg}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('epgName, epg, cTime', 'required'),
			array('epg', 'numerical', 'integerOnly'=>true),
			array('epgName', 'length', 'max'=>255),
			array('delFlag', 'length', 'max'=>1),
			array('cTime', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, epgName, epg, delFlag, cTime', 'safe', 'on'=>'search'),
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
			'epgName' => 'Epg Name',
			'epg' => 'Epg',
			'delFlag' => 'Del Flag',
			'cTime' => 'C Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('epgName',$this->epgName,true);
		$criteria->compare('epg',$this->epg);
		$criteria->compare('delFlag',$this->delFlag,true);
		$criteria->compare('cTime',$this->cTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VerEpg the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

