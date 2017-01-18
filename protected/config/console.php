<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => 'Mobile Application Database',

	'preload' => array('log'),

	'import' => array(
		'application.components.*',
	),

	'commandMap' => array(
		'rbac' => 'ext.ConsoleRbac.RbacCommand',
		'logofon' => 'ext.LogofonIpList.LogofonCommand',
		'treeManager' => 'ext.CliTreeManager.TreeManagerCommand',
		'4pda' => 'application.modules.applications.commands.FourpdaCommand',
		'stats' => 'application.modules.applications.commands.StatsCommand',
	),

	'modules' => array(
		'applications',
	),

	// application components
	'components' => array(
		'db' => require dirname(__FILE__).'/database.php',
		'authManager'=>array(
			'class' => 'CDbAuthManager',
			'connectionID' => 'db',
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
			),
		),
	),
);
