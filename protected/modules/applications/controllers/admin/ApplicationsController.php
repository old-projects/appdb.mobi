<?php
class ApplicationsController extends BackEndController {

	public function filters() {
		return CMap::mergeArray(parent::filters(),
			array(
			'accessControl',
			'postOnly + delete',
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$model = new Application;

		$this->performAjaxValidation($model);

		if (isset($_POST['Application'])) {
			$model->attributes = $_POST['Application'];
			if ($model->save())
				$this->redirect(array('view', 'id' => $model->id));
		}

		$this->render('create', array(
			'model' => $model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model = $this->loadModel($id);

		$this->performAjaxValidation($model);

		if (isset($_POST['Application'])) {
			$model->attributes = $_POST['Application'];
			if($model->save())
				$this->redirect(array('view','id' => $model->id));
		}

		$this->render('update',array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) {
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex() {
		$this->redirect($this->createUrl('admin'));
		// $dataProvider = new CActiveDataProvider('Application');
		// $this->render('index',array(
		// 	'dataProvider' => $dataProvider,
		// ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model = new Application('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Application']))
			$model->attributes = $_GET['Application'];

		$this->render('admin',array(
			'model' => $model,
		));
	}

	/**
	 * Imports applications.
	 */
	public function actionImport() {
		$model = new ImportForm;

		$this->performAjaxValidation($model);
		if (isset($_POST['ImportForm'])) {
			$model->attributes = $_POST['ImportForm'];
			if ($model->validate()) {
				$model->parse();
				if (!empty($model->actions) && isset($_POST['import'])) {
					$model->import();
					$text = array();
					if ($model->added > 0)
						$text[] = 'Добавлено приложений: '.$model->added;
					if ($model->moved > 0)
						$text[] = 'Перемещено: '.$model->moved;
					if ($model->updated > 0)
						$text[] = 'Обновлено: '.$model->updated;
					if (!empty($text))
						Yii::app()->user->setFlash('success', implode('<br />', $text));
				}
			}

		}

		$this->render('import', array(
			'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Application the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id) {
		$model = Application::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Application $model the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'applications-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
