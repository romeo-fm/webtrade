<?php

// change the following paths if necessary
$yiic=dirname(__FILE__).'/../framework/yiic.php';
//$config=dirname(__FILE__).'/config/console.php';
$ws = getenv('HTTP_WS');
$config = $ws == 'lab' ? __DIR__ . '/config/lab.php' : __DIR__ . '/config/prod.php';

require_once($yiic);
