<?php

/**
 * This is the model class for table "{{ver_template}}".
 *
 * The followings are the available columns in table '{{ver_template}}':
 * @property string $id
 * @property string $pic
 * @property string $name
 * @property string $cols
 * @property string $rows
 * @property string $colw
 * @property string $roww
 * @property string $cellspacing
 */
class VerTemplate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ver_template}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pic, name, cols, rows, colw, roww, cellspacing', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pic, name, cols, rows, colw, roww, cellspacing', 'safe', 'on'=>'search'),
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
			'pic' => 'Pic',
			'name' => 'Name',
			'cols' => 'Cols',
			'rows' => 'Rows',
			'colw' => 'Colw',
			'roww' => 'Roww',
			'cellspacing' => 'Cellspacing',
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
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('cols',$this->cols,true);
		$criteria->compare('rows',$this->rows,true);
		$criteria->compare('colw',$this->colw,true);
		$criteria->compare('roww',$this->roww,true);
		$criteria->compare('cellspacing',$this->cellspacing,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VerTemplate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
