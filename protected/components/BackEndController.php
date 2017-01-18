<?php
class BackEndController extends Controller {

	public $layout = '//layouts/column2';

	public function filters() {
		return array(
			'accessControl',
		);
	}

	/**
	 * Запрещаем всем кроме админа
	 */
	public function accessRules() {
		return array(
			array('allow',
				'roles' => array('admin'),
			),
			array('deny'),
		);
	}

	public function beforeAction($action) {
		if (parent::beforeAction($action)) {
			Yii::app()->onlineVisitorsCounter->processRequest();
			Yii::app()->externalVisitorsCounter->processRequest();
			Yii::app()->theme = 'bootstrap';
			return true;
		}
		return false;
	}

	/**
	 * Переадресация на основную админку
	 */
	public function actionIndex() {
		if ($this->uniqueId == 'admin')
			throw new CHttpException(500, 'The main admin controller should implement "index" action!');
		$this->redirect($this->createUrl('/admin'));
	}
}
