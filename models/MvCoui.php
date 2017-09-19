<?php

/**
 * This is the model class for table "{{mv_coui}}".
 *
 * The followings are the available columns in table '{{mv_coui}}':
 * @property integer $id
 * @property string $title
 * @property string $type
 * @property string $tType
 * @property string $param
 * @property string $action
 * @property string $pic
 * @property string $cp
 * @property string $epg
 * @property string $flag
 * @property string $delFlag
 * @property integer $addTime
 * @property integer $upTime
 * @property string $position
 * @property string $user
 * @property string $gid
 * @property string $message
 */
class MvCoui extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{mv_coui}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('addTime, upTime', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('type, cp, flag, delFlag', 'length', 'max'=>2),
			array('tType, epg', 'length', 'max'=>10),
			array('param, pic', 'length', 'max'=>600),
			array('action, user, message', 'length', 'max'=>255),
			array('position', 'length', 'max'=>15),
			array('gid', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, type, tType, param, action, pic, cp, epg, flag, delFlag, addTime, upTime, position, user, gid, message', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'type' => 'Type',
			'tType' => 'T Type',
			'param' => 'Param',
			'action' => 'Action',
			'pic' => 'Pic',
			'cp' => 'Cp',
			'epg' => 'Epg',
			'flag' => 'Flag',
			'delFlag' => 'Del Flag',
			'addTime' => 'Add Time',
			'upTime' => 'Up Time',
			'position' => 'Position',
			'user' => 'User',
			'gid' => 'Gid',
			'message' => 'Message',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('tType',$this->tType,true);
		$criteria->compare('param',$this->param,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('cp',$this->cp,true);
		$criteria->compare('epg',$this->epg,true);
		$criteria->compare('flag',$this->flag,true);
		$criteria->compare('delFlag',$this->delFlag,true);
		$criteria->compare('addTime',$this->addTime);
		$criteria->compare('upTime',$this->upTime);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('user',$this->user,true);
		$criteria->compare('gid',$this->gid,true);
		$criteria->compare('message',$this->message,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MvCoui the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

