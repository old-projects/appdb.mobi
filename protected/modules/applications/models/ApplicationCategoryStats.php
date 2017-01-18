<?php
/**
 * This is the model class for table "{{categories_stats}}".
 *
 * The followings are the available columns in table '{{categories_stats}}':
 * @property string $category_id
 * @property string $platform
 * @property integer $applications_count
 * @property integer $downloads_count
 */
class ApplicationCategoryStats extends CActiveRecord {

	public $applications_count = 0;
	public $downloads_count = 0;

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{application_categories_stats}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
			array('category_id, platform, applications_count, downloads_count', 'required'),
			array('applications_count, downloads_count', 'numerical', 'integerOnly'=>true),
			array('category_id', 'length', 'max'=>10),
			array('platform', 'length', 'max'=>12),
			// The following rule is used by search().
			array('category_id, platform, applications_count, downloads_count', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'category' => array(self::BELONGS_TO, 'ApplicationCategory', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'category_id' => 'Category',
			'platform' => 'Platform',
			'applications_count' => 'Applications Count',
			'downloads_count' => 'Downloads Count',
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

		$criteria->compare('category_id', $this->category_id, true);
		$criteria->compare('platform', $this->platform, true);
		$criteria->compare('applications_count', $this->applications_count);
		$criteria->compare('downloads_count', $this->downloads_count);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CategoriesStats the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function platform($id) {
		$this->getDbCriteria()->mergeWith(array(
			'condition' => 'platform = :platform_id',
			'params' => array(':platform_id' => $id),
		));
		return $this;
	}

	// public function defaultScope() {
	// 	return array(
 //      'condition' => 'platform = '.Yii::app()->language.'"',
 //    );
	// }
}
