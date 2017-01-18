<?php
/**
 * This is the model class for table "logofon_ranges".
 *
 * The followings are the available columns in table 'logofon_ranges':
 * @property string $id
 * @property string $operator_id
 * @property string $start
 * @property string $end
 */
class LogofonRanges extends CActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'logofon_ranges';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
			array('operator_id, start, end', 'required'),
			array('operator_id', 'length', 'max' => 10),
			array('start, end', 'length', 'max' => 20),
			// The following rule is used by search().
			array('id, operator_id, start, end', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'operator' => array(self::BELONGS_TO, 'LogofonOperators', 'operator_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'operator_id' => 'Operator',
			'start' => 'Start',
			'end' => 'End',
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
	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('operator_id', $this->operator_id, true);
		$criteria->compare('start', $this->start, true);
		$criteria->compare('end', $this->end, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LogofonRanges the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}
