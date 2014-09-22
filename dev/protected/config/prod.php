<?php
$mainConfig = PHP_SAPI === 'cli' ? __DIR__ . '/console.php' : __DIR__ . '/main.php';
return CMap::mergeArray(
    require_once($mainConfig),
    array(
        'components' => array(
            'db' => array(
                'connectionString' => 'mysql:host=romeofm.mysql.ukraine.com.ua;dbname=romeofm_webfin',
                'emulatePrepare' => true,
                'username' => 'romeofm_webfin',
                'password' => 'vk7v8mks',
                'charset' => 'utf8',
                'enableProfiling' => YII_DEBUG,
                'enableParamLogging' => YII_DEBUG,
                'schemaCachingDuration' => YII_DEBUG ? 0 : 3600
            ),


            'log'=>array(
                'class'=>'CLogRouter',
                'enabled'=>YII_DEBUG,
                'routes'=>array(
                    array(
                        'class' => 'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                        'enabled' => YII_DEBUG,
                        'ipFilters' => array('127.0.0.1', '192.168.*', $_SERVER['REMOTE_ADDR']),
                    ),
                    array(
                        'class'=>'CFileLogRoute',
                        'levels'=>'trace, info, error, info',
                    ),
                    /*
                    array(
                        'class'=>'CFileLogRoute',
                        'levels'=>'trace, info, error, info',
                    ),

                    array(
                        'class'=>'CEmailLogRoute',
                        'levels'=>'error, warning, trace',
                        'emails'=>'admin@example.com',
                    ),

                    array(
                        'class' => 'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                        'enabled' => YII_DEBUG,
                        'ipFilters' => array('127.0.0.1', '192.168.*'),
                    ),
                    */
                ),
            ),
        )
    )
);