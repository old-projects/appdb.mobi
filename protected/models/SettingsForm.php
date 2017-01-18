<?php
class SettingsForm extends CFormModel {
	public $siteClosed;
	public $siteClosedMessage;
	public $siteClosedButAuthorizationAdmin;

	public function rules() {
		return array(
			array('siteClosed, siteClosedMessage', 'required', 'on' => 'siteClosed'),
			array('siteClosed', 'boolean', 'on' => 'siteClosed'),
		);
	}

	public function attributeLabels() {
		return array(
			'siteClosed' => 'Состояние',
			'siteClosedMessage' => 'Сообщение о закрытии сайта',
		);
	}

	public function getSettingsCategory() {
		return 'site';
	}

	/**
	 * Saves all the changed settings to the permanent storage
	 */
	public function save() {
		$settings = $this->settingsData;

		foreach ($this->attributes as $attribute => $value) {
			if (!isset($settings[$attribute]) || $settings[$attribute] != $value)
				Yii::app()->settings->set($this->settingsCategory, $attribute, $value);
		}
	}

	protected function afterConstruct() {
		parent::afterConstruct();
		$settings = $this->settingsData;

		foreach ($this->attributes as $attribute => $value) {
			if (isset($settings[$attribute]))
				$this->{$attribute} = $settings[$attribute];
		}
	}

	protected function getSettingsData() {
		$settings = Yii::app()->settings->get($this->settingsCategory);
		if ($settings === null)
			$settings = array();
		return $settings;
	}
}
