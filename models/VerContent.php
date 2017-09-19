<?php

/**
 * This is the model class for table "{{ver_content}}".
 *
 * The followings are the available columns in table '{{ver_content}}':
 * @property string $id
 * @property string $vid
 * @property string $flag
 * @property string $status
 * @property string $cTime
 * @property string $delFlag
 */
class VerContent extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ver_content}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vid, cTime', 'required'),
			array('vid', 'length', 'max'=>20),
			array('flag', 'length', 'max'=>10),
			array('status', 'length', 'max'=>1),
			array('cTime', 'length', 'max'=>11),
			array('delFlag', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, vid, flag, status, cTime, delFlag', 'safe', 'on'=>'search'),
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
			'vid' => 'Vid',
			'flag' => 'Flag',
			'status' => 'Status',
			'cTime' => 'C Time',
			'delFlag' => 'Del Flag',
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
		$criteria->compare('vid',$this->vid,true);
		$criteria->compare('flag',$this->flag,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('cTime',$this->cTime,true);
		$criteria->compare('delFlag',$this->delFlag,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VerContent the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

