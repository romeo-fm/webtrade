<?php
$mainConfig = PHP_SAPI === 'cli' ? __DIR__ . '/console.php' : __DIR__ . '/main.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');
return CMap::mergeArray(
	require_once($mainConfig),
	array(
		'components' => array(
			'db' => array(
				'connectionString' => 'mysql:host=localhost;dbname=s2_news4sale',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => 'miriteclab',
				'charset' => 'utf8',
				'enableProfiling' => YII_DEBUG,
				'enableParamLogging' => YII_DEBUG,
				'schemaCachingDuration' => YII_DEBUG ? 0 : 3600
			),

            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute',
                        'levels'=>'trace, info, error, info',
                    ),
                    /*
                    array(
                        'class'=>'CEmailLogRoute',
                        'levels'=>'error, warning, trace',
                        'emails'=>'admin@example.com',
                    ),*/
                ),
            ),
             // TODO: if need log panel in project
			/*'log' => array(
				'routes' => array(
					array(
						'class' => 'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
						'enabled' => YII_DEBUG,
						'ipFilters' => array('127.0.0.1', '192.168.*'),
					),
				)
			)*/

		)
	)
);