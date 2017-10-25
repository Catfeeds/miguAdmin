<?php

/**
 * This is the model class for table "{{ver_topic_review}}".
 *
 * The followings are the available columns in table '{{ver_topic_review}}':
 * @property string $id
 * @property string $type
 * @property integer $topic_id
 * @property string $title
 * @property string $uptype
 * @property string $tType
 * @property string $action
 * @property string $param
 * @property string $pic
 * @property string $uptime
 * @property string $reviewtime
 * @property string $message
 * @property string $uType
 * @property string $vid
 * @property string $flag
 * @property string $videUrl
 * @property integer $gid
 * @property string $stationid
 */
class VerTopicReview extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ver_topic_review}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('topic_id, gid', 'numerical', 'integerOnly'=>true),
			array('type, title, uptype, tType, action, param, pic, uptime, reviewtime, message, uType, vid, flag, videUrl, stationid', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, topic_id, title, uptype, tType, action, param, pic, uptime, reviewtime, message, uType, vid, flag, videUrl, gid, stationid', 'safe', 'on'=>'search'),
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
			'type' => 'Type',
			'topic_id' => 'Topic',
			'title' => 'Title',
			'uptype' => 'Uptype',
			'tType' => 'T Type',
			'action' => 'Action',
			'param' => 'Param',
			'pic' => 'Pic',
			'uptime' => 'Uptime',
			'reviewtime' => 'Reviewtime',
			'message' => 'Message',
			'uType' => 'U Type',
			'vid' => 'Vid',
			'flag' => 'Flag',
			'videUrl' => 'Vide Url',
			'gid' => 'Gid',
			'stationid' => 'Stationid',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('topic_id',$this->topic_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('uptype',$this->uptype,true);
		$criteria->compare('tType',$this->tType,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('param',$this->param,true);
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('uptime',$this->uptime,true);
		$criteria->compare('reviewtime',$this->reviewtime,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('uType',$this->uType,true);
		$criteria->compare('vid',$this->vid,true);
		$criteria->compare('flag',$this->flag,true);
		$criteria->compare('videUrl',$this->videUrl,true);
		$criteria->compare('gid',$this->gid);
		$criteria->compare('stationid',$this->stationid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VerTopicReview the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
