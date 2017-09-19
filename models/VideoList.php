<?php

/**
 * This is the model class for table "{{video_list}}".
 *
 * The followings are the available columns in table '{{video_list}}':
 * @property string $id
 * @property string $vid
 * @property string $cp
 * @property string $title
 * @property string $size
 * @property string $url
 * @property string $md5
 * @property string $cTime
 * @property string $assetId
 * @property string $HDFlag
 * @property string $filesize
 * @property string $videocodec
 * @property string $flag
 * @property string $mediafileid
 * @property string $visitpath
 * @property string $mediafilepath
 * @property string $mediacoderate
 * @property string $contid
 * @property string $duration
 * @property string $serialcontentid
 */
class VideoList extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{video_list}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vid, cp, title, md5, cTime, assetId', 'required'),
			array('vid, contid', 'length', 'max'=>20),
			array('cp', 'length', 'max'=>15),
			array('title', 'length', 'max'=>300),
			array('size', 'length', 'max'=>100),
			array('url, visitpath, mediafilepath', 'length', 'max'=>600),
			array('md5, flag, mediafileid', 'length', 'max'=>40),
			array('cTime', 'length', 'max'=>11),
			array('assetId, serialcontentid', 'length', 'max'=>30),
			array('HDFlag', 'length', 'max'=>25),
			array('filesize', 'length', 'max'=>80),
			array('videocodec, duration', 'length', 'max'=>255),
			array('mediacoderate', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, vid, cp, title, size, url, md5, cTime, assetId, HDFlag, filesize, videocodec, flag, mediafileid, visitpath, mediafilepath, mediacoderate, contid, duration, serialcontentid', 'safe', 'on'=>'search'),
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
			'size' => 'Size',
			'url' => 'Url',
			'md5' => 'Md5',
			'cTime' => 'C Time',
			'assetId' => 'Asset',
			'HDFlag' => 'Hdflag',
			'filesize' => 'Filesize',
			'videocodec' => 'Videocodec',
			'flag' => 'Flag',
			'mediafileid' => 'Mediafileid',
			'visitpath' => 'Visitpath',
			'mediafilepath' => 'Mediafilepath',
			'mediacoderate' => 'Mediacoderate',
			'contid' => 'Contid',
			'duration' => 'Duration',
			'serialcontentid' => 'Serialcontentid',
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
		$criteria->compare('size',$this->size,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('md5',$this->md5,true);
		$criteria->compare('cTime',$this->cTime,true);
		$criteria->compare('assetId',$this->assetId,true);
		$criteria->compare('HDFlag',$this->HDFlag,true);
		$criteria->compare('filesize',$this->filesize,true);
		$criteria->compare('videocodec',$this->videocodec,true);
		$criteria->compare('flag',$this->flag,true);
		$criteria->compare('mediafileid',$this->mediafileid,true);
		$criteria->compare('visitpath',$this->visitpath,true);
		$criteria->compare('mediafilepath',$this->mediafilepath,true);
		$criteria->compare('mediacoderate',$this->mediacoderate,true);
		$criteria->compare('contid',$this->contid,true);
		$criteria->compare('duration',$this->duration,true);
		$criteria->compare('serialcontentid',$this->serialcontentid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VideoList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

