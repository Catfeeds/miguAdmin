<?php

/**
 * This is the model class for table "{{video}}".
 *
 * The followings are the available columns in table '{{video}}':
 * @property string $id
 * @property string $vid
 * @property string $cp
 * @property string $title
 * @property string $info
 * @property string $short
 * @property string $keyword
 * @property string $actor
 * @property string $director
 * @property string $language
 * @property string $year
 * @property string $type
 * @property string $cate
 * @property string $status
 * @property string $cTime
 * @property string $endDateTime
 * @property string $startDateTime
 * @property integer $IsAdvertise
 * @property string $ShowType
 * @property integer $flag
 * @property string $initial
 * @property integer $CountryOfOrigin
 * @property string $bitrate
 * @property string $duration
 * @property string $targetgroupassetid
 * @property string $order
 * @property string $delFlag
 * @property integer $upTime
 * @property string $score
 * @property integer $simple_set
 * @property string $templateType
 * @property integer $workid
 * @property string $region
 * @property integer $prdpack_id
 * @property integer $product_id
 * @property integer $spid
 * @property integer $mms_id
 * @property string $screenwriter
 * @property string $producer
 * @property string $dubbing
 * @property string $toastmaster
 * @property string $anchor
 * @property string $model
 * @property string $athletes
 * @property string $singer
 * @property string $first_play_time
 * @property integer $isline
 */
class Video extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{video}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vid, cp, title, type, cTime, IsAdvertise, ShowType, upTime', 'required'),
			array('IsAdvertise, flag, CountryOfOrigin, upTime, simple_set, workid, prdpack_id, product_id, spid, mms_id, isline', 'numerical', 'integerOnly'=>true),
			array('vid, language, type, cate, ShowType', 'length', 'max'=>20),
			array('cp', 'length', 'max'=>15),
			array('title', 'length', 'max'=>300),
			array('keyword, actor, screenwriter, producer, dubbing, toastmaster, anchor, model, athletes, singer, first_play_time', 'length', 'max'=>150),
			array('director, bitrate, duration', 'length', 'max'=>90),
			array('year', 'length', 'max'=>4),
			array('status', 'length', 'max'=>1),
			array('cTime', 'length', 'max'=>11),
			array('endDateTime, startDateTime, score, region', 'length', 'max'=>30),
			array('initial', 'length', 'max'=>100),
			array('targetgroupassetid', 'length', 'max'=>45),
			array('order', 'length', 'max'=>60),
			array('delFlag', 'length', 'max'=>6),
			array('templateType', 'length', 'max'=>2),
			array('info, short', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, vid, cp, title, info, short, keyword, actor, director, language, year, type, cate, status, cTime, endDateTime, startDateTime, IsAdvertise, ShowType, flag, initial, CountryOfOrigin, bitrate, duration, targetgroupassetid, order, delFlag, upTime, score, simple_set, templateType, workid, region, prdpack_id, product_id, spid, mms_id, screenwriter, producer, dubbing, toastmaster, anchor, model, athletes, singer, first_play_time, isline', 'safe', 'on'=>'search'),
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
			'cp' => 'Cp',
			'title' => 'Title',
			'info' => 'Info',
			'short' => 'Short',
			'keyword' => 'Keyword',
			'actor' => 'Actor',
			'director' => 'Director',
			'language' => 'Language',
			'year' => 'Year',
			'type' => 'Type',
			'cate' => 'Cate',
			'status' => 'Status',
			'cTime' => 'C Time',
			'endDateTime' => 'End Date Time',
			'startDateTime' => 'Start Date Time',
			'IsAdvertise' => 'Is Advertise',
			'ShowType' => 'Show Type',
			'flag' => 'Flag',
			'initial' => 'Initial',
			'CountryOfOrigin' => 'Country Of Origin',
			'bitrate' => 'Bitrate',
			'duration' => 'Duration',
			'targetgroupassetid' => 'Targetgroupassetid',
			'order' => 'Order',
			'delFlag' => 'Del Flag',
			'upTime' => 'Up Time',
			'score' => 'Score',
			'simple_set' => 'Simple Set',
			'templateType' => 'Template Type',
			'workid' => 'Workid',
			'region' => 'Region',
			'prdpack_id' => 'Prdpack',
			'product_id' => 'Product',
			'spid' => 'Spid',
			'mms_id' => 'Mms',
			'screenwriter' => 'Screenwriter',
			'producer' => 'Producer',
			'dubbing' => 'Dubbing',
			'toastmaster' => 'Toastmaster',
			'anchor' => 'Anchor',
			'model' => 'Model',
			'athletes' => 'Athletes',
			'singer' => 'Singer',
			'first_play_time' => 'First Play Time',
			'isline' => '1:上线;2:下线',
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
		$criteria->compare('cp',$this->cp,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('info',$this->info,true);
		$criteria->compare('short',$this->short,true);
		$criteria->compare('keyword',$this->keyword,true);
		$criteria->compare('actor',$this->actor,true);
		$criteria->compare('director',$this->director,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('cate',$this->cate,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('cTime',$this->cTime,true);
		$criteria->compare('endDateTime',$this->endDateTime,true);
		$criteria->compare('startDateTime',$this->startDateTime,true);
		$criteria->compare('IsAdvertise',$this->IsAdvertise);
		$criteria->compare('ShowType',$this->ShowType,true);
		$criteria->compare('flag',$this->flag);
		$criteria->compare('initial',$this->initial,true);
		$criteria->compare('CountryOfOrigin',$this->CountryOfOrigin);
		$criteria->compare('bitrate',$this->bitrate,true);
		$criteria->compare('duration',$this->duration,true);
		$criteria->compare('targetgroupassetid',$this->targetgroupassetid,true);
		$criteria->compare('order',$this->order,true);
		$criteria->compare('delFlag',$this->delFlag,true);
		$criteria->compare('upTime',$this->upTime);
		$criteria->compare('score',$this->score,true);
		$criteria->compare('simple_set',$this->simple_set);
		$criteria->compare('templateType',$this->templateType,true);
		$criteria->compare('workid',$this->workid);
		$criteria->compare('region',$this->region,true);
		$criteria->compare('prdpack_id',$this->prdpack_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('spid',$this->spid);
		$criteria->compare('mms_id',$this->mms_id);
		$criteria->compare('screenwriter',$this->screenwriter,true);
		$criteria->compare('producer',$this->producer,true);
		$criteria->compare('dubbing',$this->dubbing,true);
		$criteria->compare('toastmaster',$this->toastmaster,true);
		$criteria->compare('anchor',$this->anchor,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('athletes',$this->athletes,true);
		$criteria->compare('singer',$this->singer,true);
		$criteria->compare('first_play_time',$this->first_play_time,true);
		$criteria->compare('isline',$this->isline);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Video the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

