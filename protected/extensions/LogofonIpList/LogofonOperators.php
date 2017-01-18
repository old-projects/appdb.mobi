<?php
/**
 * This is the model class for table "logofon_operators".
 *
 * The followings are the available columns in table 'logofon_operators':
 * @property string $id
 * @property string $name
 * @property string $label
 * @property string $tld
 * @property string $country
 */
class LogofonOperators extends CActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'logofon_operators';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
			array('name, label, tld, country', 'required'),
			array('name', 'length', 'max' => 40),
			array('label', 'length', 'max' => 20),
			array('tld', 'length', 'max' => 2),
			array('country', 'length', 'max' => 50),
			// The following rule is used by search().
			array('id, name, label, tld, country', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'ranges' => array(self::HAS_MANY, 'LogofonRanges', 'operator_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'label' => 'Label',
			'tld' => 'Tld',
			'country' => 'Country',
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
		$criteria->compare('name', $this->name, true);
		$criteria->compare('label', $this->label, true);
		$criteria->compare('tld', $this->tld, true);
		$criteria->compare('country', $this->country, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LogofonOperators the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * Finds an operator by ip address
	 * @param string or integer Original ip address or result of ip2long()
	 * @return null or LogofonOperators object
	 */
	public function findByIp($address) {
		Yii::import('ext.LogofonIpList.LogofonRanges');
		if (!is_numeric($address))
			$address = ip2long($address);
		if (($range = LogofonRanges::model()->with('operator')->find(':ip BETWEEN `start` and `end`', array(':ip' => $address))) === null)
			return null;
		return $range->operator;
	}

	/**
	 * Some shortcuts for popular russian operators
	 */
	public function isBeeline() {
		return strncasecmp($this->label, 'beeline', 7) === 0;
	}

	public function isMts() {
		return strncasecmp($this->label, 'mts', 3) === 0 || strncasecmp($this->name, 'MTC', 3) === 0;
	}

	public function isMegafon() {
		return $this->label == 'megafon';
	}

	public function isOperaMini() {
		return $this->name == 'Opera Mini';
	}
}
