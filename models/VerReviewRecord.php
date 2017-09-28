<?php

/**
 * This is the model class for table "{{ver_review_record}}".
 *
 * The followings are the available columns in table '{{ver_review_record}}':
 * @property string $id
 * @property integer $type
 * @property integer $bind_id
 * @property integer $user_id
 * @property integer $review_times
 * @property integer $review_flag
 * @property string $message
 * @property integer $add_time
 */
class VerReviewRecord extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ver_review_record}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('review_flag', 'required'),
			array('type, bind_id, user_id, review_times, review_flag, add_time', 'numerical', 'integerOnly'=>true),
			array('message', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, bind_id, user_id, review_times, review_flag, message, add_time', 'safe', 'on'=>'search'),
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
			'type' => '记录的种类 1：消息；2：壁纸 自定义',
			'bind_id' => '关联壁纸、消息等表的主键id',
			'user_id' => '审核或驳回人信息',
			'review_times' => '表示是几审的操作',
			'review_flag' => '1：通过；2：驳回；3：提审',
			'message' => '通过或驳回是的消息 通过即默认为通过，驳回则为输入的驳回理由',
			'add_time' => '添加这条数据的时间',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('bind_id',$this->bind_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('review_times',$this->review_times);
		$criteria->compare('review_flag',$this->review_flag);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('add_time',$this->add_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VerReviewRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
