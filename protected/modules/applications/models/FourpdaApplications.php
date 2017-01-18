<?php
/**
 * This is the model class for table "4pda_applications".
 *
 * The followings are the available columns in table '4pda_applications':
 * @property string $topic_id
 * @property string $name
 * @property string $categories
 * @property string $version
 * @property string $description
 */
class FourpdaApplications extends CActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '4pda_applications';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
			array('topic_id, name, categories', 'required'),
			array('topic_id', 'length', 'max' => 10),
			array('name, categories, version', 'length', 'max' => 255),
			array('description', 'length', 'max' => 900),
			// The following rule is used by search().
			array('topic_id, name, categories, version, description', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'topic_id' => 'Topic',
			'name' => 'Name',
			'categories' => 'Categories',
			'version' => 'Version',
			'description' => 'Description',
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

		$criteria->compare('topic_id', $this->topic_id, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('categories', $this->categories, true);
		$criteria->compare('version', $this->version, true);
		$criteria->compare('description', $this->description, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FourpdaApplications the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}
