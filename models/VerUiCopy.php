<?php

/**
 * This is the model class for table "{{ver_ui}}".
 *
 * The followings are the available columns in table '{{ver_ui}}':
 * @property integer $id
 * @property string $title
 * @property string $tType
 * @property string $param
 * @property string $action
 * @property string $pic
 * @property string $cp
 * @property integer $addTime
 * @property integer $upTime
 * @property string $position
 * @property string $delFlag
 * @property string $vid
 * @property string $gid
 * @property string $type
 * @property string $uType
 * @property string $scort
 */
class VerUiCopy extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ver_ui_copy}}';
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
			array('tType', 'length', 'max'=>10),
			array('param, pic', 'length', 'max'=>600),
			array('action', 'length', 'max'=>255),
			array('cp', 'length', 'max'=>2),
			array('position', 'length', 'max'=>15),
			array('delFlag, vid', 'length', 'max'=>30),
			array('gid', 'length', 'max'=>11),
			array('type, uType', 'length', 'max'=>20),
			array('scort', 'length', 'max'=>6),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, tType, param, action, pic, cp, addTime, upTime, position, delFlag, vid, gid, type, uType, scort,flag', 'safe', 'on'=>'search'),
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
			'title' => '标题',
			'tType' => 'T Type',
			'param' => 'Param',
			'action' => '跳转的action名',
			'pic' => '图片地址',
			'cp' => '牌照方',
			'addTime' => '添加时间',
			'upTime' => '更新时间',
			'position' => 'Position',
			'delFlag' => 'Del Flag',
			'vid' => 'Vid',
			'gid' => '导航id',
			'type' => 'Type',
			'uType' => 'U Type',
			'scort' => 'Scort',
			'flag' => 'Flag',
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
		$criteria->compare('tType',$this->tType,true);
		$criteria->compare('param',$this->param,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('cp',$this->cp,true);
		$criteria->compare('addTime',$this->addTime);
		$criteria->compare('upTime',$this->upTime);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('delFlag',$this->delFlag,true);
		$criteria->compare('vid',$this->vid,true);
		$criteria->compare('gid',$this->gid,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('uType',$this->uType,true);
		$criteria->compare('scort',$this->scort,true);
		$criteria->compare('flag',$this->flag,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VerUi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}


