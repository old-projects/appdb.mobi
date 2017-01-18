<?php
/**
 * This is the model class for table "{{online_visitors}}".
 *
 * The followings are the available columns in table '{{online_visitors}}':
 * @property string $address
 * @property string $user_agent
 * @property string $refresh_last_time
 * @property string $refreshes_count
 * @property string $query
 * @property string $referer
 */
class OnlineVisitors extends CActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{online_visitors}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('address, user_agent, refreshes_count, query', 'required'),
			array('address', 'length', 'max' => 20),
			array('refreshes_count', 'length', 'max' => 10),
			array('refresh_last_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('address, user_agent, refresh_last_time, refreshes_count, query, referrer', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'address' => 'IP',
			'user_agent' => 'Браузер',
			'refresh_last_time' => 'Время',
			'refreshes_count' => 'Кол-во переходов',
			'start_time' => 'Начал ходить',
			'query' => 'Запрос',
			'referrer' => 'Источник',
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
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('address', $this->address,true);
		$criteria->compare('user_agent', $this->user_agent,true);
		$criteria->compare('refresh_last_time', $this->refresh_last_time,true);
		$criteria->compare('refreshes_count', $this->refreshes_count,true);
		$criteria->compare('query', $this->query,true);
		$criteria->compare('referer', $this->referer,true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function getOperator() {
		Yii::import('ext.LogofonIpList.LogofonOperators');
		return LogofonOperators::model()->findByIp($this->address);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Online the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function getReferrerPath() {
		if (empty($this->referrer))
			return null;

		$url = parse_url($this->referrer);
		return $url['path'].(!empty($url['query']) ? '?'.$url['query'] : null).(!empty($url['fragment']) ? '#'.$url['fragment'] : null);
	}

	public function defaultScope() {
		return array(
			'order' => 'refresh_last_time DESC',
		);
	}

	public function scopes() {
		return array(
			'active' => array(
				'condition' => 'refresh_last_time >= SUBDATE(NOW(), INTERVAL :minutes MINUTE)',
				'params' => array(':minutes' => Yii::app()->onlineVisitorsCounter->activeLimitMinutes),
			),
			'bots' => array(
				'condition' => 'is_bot = "1"',
			),
			'users' => array(
				'condition' => 'is_bot = "0"',
			),
		);
	}
}
