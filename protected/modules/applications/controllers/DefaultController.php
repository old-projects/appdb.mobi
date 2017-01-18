<?php

class DefaultController extends FrontEndController {

	/**
	 * Просмотр папки
	 */
	public function actionCategories($platform, $category = null, $category_id = null) {
		$platform = Platform::getById($platform);
		if (is_null($platform))
			throw new CHttpException(404, 'Invalid platform.');


		// выбираем корни
		if (empty($category_id)) {
			$criteria = new CDbCriteria;
			$criteria->scopes = 'roots';
			$criteria->with = array(
				'stats' => array(
					'scopes' => array('platform' => $platform->id),
				));
			$subcategories_provider = new CActiveDataProvider('ApplicationCategory', array(
				'criteria' => $criteria,
				'pagination' => false,
			));
		} else {
			$category = ApplicationCategory::model()->findByPk($category_id);
			if (is_null($category))
				throw new CHttpException(404, 'Invalid category.');
			$category->platform = $platform;
			$subcategories_provider = new CArrayDataProvider($category->children()->alphabetically()->unempty()->with(array(
				'stats' => array(
					'scopes' => array('platform' => $platform->id),
				))) ->fromCache()->findAll(), array('pagination' => false));

			$criteria = new CDbCriteria;
			// $criteria->join = 'JOIN `{{applications_in_categories}}` `{{applications_in_categories}}` ON `{{applications_in_categories}}`.`category_id` = :category_id AND `{{applications_in_categories}}`.`application_id` = `t`.`id`';
			$criteria->scopes = array(
				'category' => $category->id,
				'platform' => $platform->id,
				);
			$apps_provider = new CActiveDataProvider('Application', array(
				'criteria' => $criteria,
				'pagination' => array(
					'pageSize' => $this->module->appsPerPage,
				),
			));
		}


		$this->render('categories', array(
			'platform' => $platform,
			'category' => $category,
			'subcategories_provider' => $subcategories_provider,
			'apps_provider' => isset($apps_provider) ? $apps_provider : null,
		));
	}

	/**
	 * Просмотр приложения
	 */
	public function actionApplication($platform, $application, $application_id, $category, $category_id) {
		$platform = Platform::getById($platform);
		if (is_null($platform))
			throw new CHttpException(404, 'Invalid platform.');

		$application = Application::model()->with('category')->findByPk($application_id);
		if (is_null($application))
			throw new CHttpException(404, 'Invalid application.');

		// $category = ApplicationCategory::model()->findByPk($category_id);
		// if (is_null($category))
		// 	throw new CHttpException(404, 'Invalid category.');

		$this->render('application', array(
			'platform' => $platform,
			'application' => $application,
			// 'category' => $category,
		));
	}

}
