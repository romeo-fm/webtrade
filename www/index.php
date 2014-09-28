<?php
include_once(__DIR__.'/lab.mail.fix.php');
// this for debug
define(OWNER, '62.205.148.104');
define(ISOWNER, ((OWNER == $_SERVER['REMOTE_ADDR'] ? TRUE : FALSE)));
// end debug
define(WS, 'prod');

$yii=dirname(__FILE__).'/framework/yii.php';

if (WS == 'lab') {
	$config = __DIR__ . '/protected/config/lab.php';
	define('YII_DEBUG',true);
	defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
} else {
	$config = __DIR__ . '/protected/config/prod.php';
}

if (OWNER == $_SERVER['REMOTE_ADDR']) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    define('YII_DEBUG', true);
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
}


require_once($yii);
Yii::createWebApplication($config)->run();