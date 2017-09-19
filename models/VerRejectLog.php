<?php

/**
 * This is the model class for table "{{ver_reject_log}}".
 *
 * The followings are the available columns in table '{{ver_reject_log}}':
 * @property integer $id
 * @property string $flag
 * @property string $delFlag
 * @property string $user
 * @property string $message1
 * @property string $message2
 * @property string $message3
 * @property string $message4
 * @property string $message5
 * @property string $addTime1
 * @property string $vid
 * @property string $addTime2
 * @property string $addTime3
 * @property string $addTime4
 * @property string $addTime5
 * @property string $user1
 * @property string $user2
 * @property string $user3
 * @property string $user4
 * @property string $user5
 * @property string $addTime
 */
class VerRejectLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ver_reject_log}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vid', 'required'),
			array('flag, delFlag', 'length', 'max'=>2),
			array('user, message1, message2, message3, message4, message5, user1, user2, user3, user4, user5', 'length', 'max'=>255),
			array('addTime1, addTime2, addTime3, addTime4, addTime5, addTime', 'length', 'max'=>11),
			array('vid', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, flag, delFlag, user, message1, message2, message3, message4, message5, addTime1, vid, addTime2, addTime3, addTime4, addTime5, user1, user2, user3, user4, user5, addTime', 'safe', 'on'=>'search'),
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
			'flag' => 'Flag',
			'delFlag' => 'Del Flag',
			'user' => 'User',
			'message1' => 'Message1',
			'message2' => 'Message2',
			'message3' => 'Message3',
			'message4' => 'Message4',
			'message5' => 'Message5',
			'addTime1' => 'Add Time1',
			'vid' => 'Vid',
			'addTime2' => 'Add Time2',
			'addTime3' => 'Add Time3',
			'addTime4' => 'Add Time4',
			'addTime5' => 'Add Time5',
			'user1' => 'User1',
			'user2' => 'User2',
			'user3' => 'User3',
			'user4' => 'User4',
			'user5' => 'User5',
			'addTime' => 'Add Time',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('flag',$this->flag,true);
		$criteria->compare('delFlag',$this->delFlag,true);
		$criteria->compare('user',$this->user,true);
		$criteria->compare('message1',$this->message1,true);
		$criteria->compare('message2',$this->message2,true);
		$criteria->compare('message3',$this->message3,true);
		$criteria->compare('message4',$this->message4,true);
		$criteria->compare('message5',$this->message5,true);
		$criteria->compare('addTime1',$this->addTime1,true);
		$criteria->compare('vid',$this->vid,true);
		$criteria->compare('addTime2',$this->addTime2,true);
		$criteria->compare('addTime3',$this->addTime3,true);
		$criteria->compare('addTime4',$this->addTime4,true);
		$criteria->compare('addTime5',$this->addTime5,true);
		$criteria->compare('user1',$this->user1,true);
		$criteria->compare('user2',$this->user2,true);
		$criteria->compare('user3',$this->user3,true);
		$criteria->compare('user4',$this->user4,true);
		$criteria->compare('user5',$this->user5,true);
		$criteria->compare('addTime',$this->addTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VerRejectLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

