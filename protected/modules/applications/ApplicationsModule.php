<?php
class ApplicationsModule extends CWebModule implements AdminableModule {

	public $appsPerPage = 10;

	public function init() {
		$this->setImport(array(
			'applications.models.*',
			'applications.components.*',
		));
	}

	public function beforeControllerAction($controller, $action) {
		if(parent::beforeControllerAction($controller, $action)) {
			return true;
		} else
			return false;
	}

	public function getAdminLink() {
		return 'admin/main';
	}
	public function getAdminLinkTitle() {
		return 'Приложения';
	}

	/**
	 * Статическая база по платформам. Используется на главной для генерации списка и в модуле приложений.
	 */
	public function getPlatforms() {
		return array(
			'android' => array(
				'label' => 'Android',
				'icon' => 'android.32.png',
				'description' => 'Все игры и приложения для Android смартфонов и планшетов.',
			),
			'ios' => array(
				'label' => 'iOS',
				'icon' => 'apple.32.png',
				'description' => 'Все игры и приложения для платформы iOS: iPhone, IPad.',
			),
			'windowsphone' => array(
				'label' => 'Windows Phone',
				'icon' => 'windowsphone.32.png',
				'description' => 'Все игры и приложения для платформы Windows Phone.',
			),
			'symbian' => array(
				'label' => 'Symbian',
				'icon' => 'symbian.32.png',
				'description' => 'Все игры и приложения для платформы Symbian.',
			),
			'j2me' => array(
				'label' => 'J2ME',
				'icon' => 'java.32.png',
				'description' => 'Все игры и приложения для телефонов, поддерживающих J2ME (java-приложения)',
			),
		);
	}

	public function getTypes() {
		return array(
			'games' => array(
				'label' => 'Игры',
				'icon' => 'games.32.png',
				'unit' => 'game',
				'root_id' => '1',
			),
			'programs' => array(
				'label' => 'Программы',
				'icon' => 'programs.32.png',
				'unit' => 'program',
				'root_id' => '13',
			),
		);
	}

}
