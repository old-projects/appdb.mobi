<?php
class FrontEndController extends Controller {
	public function beforeAction($action) {
		if (parent::beforeAction($action)) {
			// не считаем онлайн на предпросмотре
			if ($action->id != 'thumbnail') {
				Yii::app()->onlineVisitorsCounter->processRequest();
				Yii::app()->externalVisitorsCounter->processRequest();
			}

			// если сайт закрыт
			if (Yii::app()->settings->get('site', 'siteClosed') && !Yii::app()->user->checkAccess('admin')) {
				if ($action->controller->uniqueId != 'site' || !in_array($action->id, array('login', 'logout', 'closed')))
					$this->redirect($this->createUrl('site/closed'));
			}
			return true;
		}
		return false;
	}
}