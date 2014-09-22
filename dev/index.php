<?php

include_once(__DIR__.'/lab.mail.fix.php');

// change the following paths if necessary
$ws = getenv('HTTP_WS');

$yii=dirname(__FILE__).'/framework/yii.php';

if ($ws == 'lab') {
	$config = __DIR__ . '/protected/config/lab.php';
	// remove the following lines when in production mode
	define('YII_DEBUG',true);
	// specify how many levels of call stack should be shown in each log message
	defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
}
else
{
	define('YII_DEBUG',false);
	$config = __DIR__ . '/protected/config/prod.php';
}

require_once($yii);
Yii::createWebApplication($config)->run();