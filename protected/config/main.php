<?php
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => 'Mobile Application Database',
	'theme' => 'mobile',
	'sourceLanguage' => 'ru',

	// preloading 'log' component
	'preload' => array('log'),

	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
		'ext.selectorwidget.*',
		'bootstrap',
	),

	'modules' => array(
		'applications',
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => '123',
			'ipFilters' => array('127.0.0.1', '::1'),
			'generatorPaths' => array(
				'application.gii',
				'bootstrap.gii',
			),
		),
	),

	// application components
	'components' => array(
		'cache' => array(
			'class' => 'system.caching.CMemCache',
			'useMemcached' => true,
			'servers' => array(
				array('host' => '127.0.0.1', 'port' => 11211),
			),
		),
		'settings' => array(
			'class' => 'ext.CmsSettings.CmsSettings',
			'cacheTime' => 84000,
		),
		'format' => array(
			'timeFormat' => 'G:i:s',
		),
		'onlineVisitorsCounter' => array(
			'class' => 'application.components.OnlineVisitorsCounter',
			'keepDataHours' => 48,
			'activeLimitMinutes' => 5,
		),
		'externalVisitorsCounter' => array(
			'class' => 'application.components.ExternalVisitorsCounter',
		),
		'user' => array(
			'class' => 'application.components.WebUser',
			'allowAutoLogin' => true,
		),
		 'bootstrap'=>array(
			'class'=>'bootstrap.components.Bootstrap',
		),
		'authManager'=>array(
			'class' => 'CDbAuthManager',
			'connectionID' => 'db',
		),
		// uncomment the following to enable URLs in path-format
		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'caseSensitive' => false,
			'rules' => array(
				'apps/<platform:\w+>-<category:\w+>/<category_id:\d+>' => 'applications/default/categories',
				'apps/<platform:\w+>' => 'applications/default/categories',
				'app/<platform:\w+>-<application:\w+>/<application_id:\d+>' => 'applications/default/application',
			),
		),
		'db' => require dirname(__FILE__).'/database.php',
		'errorHandler' => array(
			'errorAction' => 'site/error',
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
				array(
					'class' => 'CProfileLogRoute',
					'filter' => 'CLogFilter',
				),
				array(
					'class' => 'CWebLogRoute',
					'levels' => 'error, warning, info, trace',
					'enabled' => YII_DEVELOPMENT,
				),
			),
		),
		'clientScript' => array(
			'scriptMap' => array(
				// '*.js' => false,
				// '*.css' => false,
			),
		),
		'widgetFactory' => array(
			'widgets' => array(
				'CListView' => array(
					'template' => "{items}\n{summary}\n{pager}",
					'emptyTagName' => 'div',
					'pagerCssClass' => 'row pager',
					'summaryCssClass' => 'row summary',
					'ajaxUpdate' => false,
				),
			),
		),
		'request' => array(
			'enableCookieValidation' => true,
		),
	),

	'params' => array(
		'adminEmail' => 'appdbmobi@gmail.com',
	),
);
