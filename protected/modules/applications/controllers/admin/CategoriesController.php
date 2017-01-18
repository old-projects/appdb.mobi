<?php
class CategoriesController extends BackEndController
{

	public $CQtreeGreedView  = array(
		'modelClassName' => 'ApplicationCategory', //название класса
		'adminAction' => 'admin' //action, где выводится QTreeGridView. Сюда будет идти редирект с других действий.
	);

	public function actions() {
		return array (
			'create' => 'ext.QTreeGridView.actions.Create',
			'update' => 'ext.QTreeGridView.actions.Update',
			'delete' => 'ext.QTreeGridView.actions.Delete',
			'movenode' => 'ext.QTreeGridView.actions.MoveNode',
			'makeroot' => 'ext.QTreeGridView.actions.MakeRoot',
		);
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
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

	// /**
	//  * Creates a new model.
	//  * If creation is successful, the browser will be redirected to the 'view' page.
	//  */
	// public function actionCreate()
	// {
	// 	$model=new ApplicationCategory;

	// 	// Uncomment the following line if AJAX validation is needed
	// 	// $this->performAjaxValidation($model);

	// 	if(isset($_POST['ApplicationCategory']))
	// 	{
	// 		$model->attributes=$_POST['ApplicationCategory'];
	// 		if($model->saveNode())
	// 			$this->redirect(array('view','id'=>$model->id));
	// 	}

	// 	$this->render('create',array(
	// 		'model'=>$model,
	// 	));
	// }

	// /**
	//  * Updates a particular model.
	//  * If update is successful, the browser will be redirected to the 'view' page.
	//  * @param integer $id the ID of the model to be updated
	//  */
	// public function actionUpdate($id)
	// {
	// 	$model=$this->loadModel($id);

	// 	// Uncomment the following line if AJAX validation is needed
	// 	// $this->performAjaxValidation($model);

	// 	if(isset($_POST['ApplicationCategory']))
	// 	{
	// 		$model->attributes=$_POST['ApplicationCategory'];
	// 		if($model->saveNode())
	// 			$this->redirect(array('view','id'=>$model->id));
	// 	}

	// 	$this->render('update',array(
	// 		'model'=>$model,
	// 	));
	// }

	// /**
	//  * Deletes a particular model.
	//  * If deletion is successful, the browser will be redirected to the 'admin' page.
	//  * @param integer $id the ID of the model to be deleted
	//  */
	// public function actionDelete($id)
	// {
	// 	$this->loadModel($id)->delete();

	// 	// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
	// 	if(!isset($_GET['ajax']))
	// 		$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	// }

	/**
	 * Lists all models.
	 */
	public function actionIndex() {
		$this->redirect($this->createUrl('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model = new ApplicationCategory('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['ApplicationCategory']))
			$model->attributes = $_GET['ApplicationCategory'];

		$this->render('admin',array(
			'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ApplicationCategory the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id) {
		$model=ApplicationCategory::model()->findByPk($id);
		if ($model===null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ApplicationCategory $model the model to be validated
	 */
	public function performAjaxValidation($model) {
		if (isset($_POST['ajax']) && $_POST['ajax']==='applications-categories-android-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
