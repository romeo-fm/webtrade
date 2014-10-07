<?php
include_once(__DIR__.'/lab.mail.fix.php');
// this for debug
$adminArr = array('62.205.148.104', '91.199.92.66');
define('ISOWNER', (in_array($_SERVER['REMOTE_ADDR'], $adminArr) ? TRUE : FALSE));
// end debug

if (ISOWNER) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    define('YII_DEBUG', true);
    define('YII_TRACE_LEVEL',3);
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && ($_SERVER['REQUEST_URI'] == '/')) {
        //echo "debug_mode.\n ";
    }

    if (@$_REQUEST['info']) {
        phpinfo();
    }

}  else {
    error_reporting(0);
    ini_set('display_errors', 'off');
    define('YII_DEBUG', false);
}

$yii = dirname(__FILE__).'/framework/yii.php';
$config = __DIR__ . '/protected/config/prod.php';

require_once($yii);
Yii::createWebApplication($config)->run();