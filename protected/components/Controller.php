<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = '//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array();

	public $breadcrumbs = array();

	public $pageMenu = array();

	public $menuButtons = array();

	public $userMenu = array();

	public $siteNavigation = array();

	public $pageDescription;
	public $homeLink = true;

	public $headerTitle;
	public $headerImage;
	public $counters;

	public function beforeAction($action) {
		if (parent::beforeAction($action)) {
			$user_agent = Yii::app()->request->userAgent;
			if (empty($user_agent) && !isset($GLOBALS['argc']))
				throw new CHttpException(400);

			return true;
		}
		return false;
	}


	public function setFlash($message, $isPositive = true, $key = null) {
		if ($key === null) {
			if (version_compare(PHP_VERSION, '5.4.0', '>='))
				$backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
			elseif (version_compare(PHP_VERSION, '5.3.6', '>='))
				$backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
			else
				$backtrace = debug_backtrace(false);

			$key = $backtrace[0]['file'].' : '.$backtrace[0]['line'].' : '.md5($message.$isPositive);

		}

		return Yii::app()->user->setSimpleFlash($message, $isPositive, $key);
	}
}
