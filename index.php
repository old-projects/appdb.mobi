<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/.yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', in_array($_SERVER['HTTP_HOST'], array('localhost')) || isset($_GET['debug']));
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
defined('YII_DEVELOPMENT') or define('YII_DEVELOPMENT', YII_DEBUG);

require_once($yii);
Yii::createWebApplication($config)->run();
