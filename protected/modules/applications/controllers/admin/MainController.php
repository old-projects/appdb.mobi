<?php
class MainController extends BackEndController {
	public function actionIndex() {

		$platforms = Yii::app()->db->createCommand()
			->select('platform, COUNT(*) as total_applications')
			->from(Application::model()->tableName())
			->group('platform')
			->order('platform ASC')
			->queryAll();


		$types = Yii::app()->db->createCommand()
			->select('type, COUNT(*) as total_applications')
			->from(Application::model()->tableName())
			->group('type')
			->order('type ASC')
			->queryAll();

		$platforms_provider = new CArrayDataProvider($platforms, array('keyField' => 'platform'));
		$types_provider = new CArrayDataProvider($types, array('keyField' => 'type'));

		$this->render('index', array(
			'total_categories' => ApplicationCategory::model()->count(),
			'total_applications' => Application::model()->count(),
			'platforms_provider' => $platforms_provider,
			'types_provider' => $types_provider,
			'platforms' => $this->module->platforms,
			));
	}
}
