<?php
defined(WS) || define(WS, 'prod');

$env = require_once(WS .'.php');
$mainConfig =  dirname(__FILE__) . DIRECTORY_SEPARATOR  . 'console.php';

return
    array(
        'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
        'name'     => 'cron webtrade from ' . __FILE__,

        'preload'=>array('log'),
        'import'=>array(
            'application.components.*',
            'application.models.*',
            'ext.giix-components.*',
            'ext.galleryManager.models.*',
            'ext.SoftDelete.SoftDeleteBehavior',
        ),

        'components'=>array(
            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute',
                        'logFile'=>'cron.log',
                        'levels'=>'error, warning',
                    ),
                    array(
                        'class'=>'CFileLogRoute',
                        'logFile'=>'cron_trace.log',
                        'levels'=>'trace',
                    ),
                ),
            ),

            // Соединение с СУБД
           'db' => $env['components']['db']
        ),
);
