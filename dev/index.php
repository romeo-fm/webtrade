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
else { // TODO: change:
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
	define('YII_DEBUG', true); // TODO: change
	$config = __DIR__ . '/protected/config/prod.php';
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3); // TODO: change
}

require_once($yii);
Yii::createWebApplication($config)->run();