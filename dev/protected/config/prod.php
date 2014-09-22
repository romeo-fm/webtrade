<?php
$mainConfig = PHP_SAPI === 'cli' ? __DIR__ . '/console.php' : __DIR__ . '/main.php';
return CMap::mergeArray(
    require_once($mainConfig),
    array(
        'components' => array(
            'db' => array(
                'connectionString' => 'mysql:host=romeofm.mysql.ukraine.com.ua;dbname=romeofm_webfinyi',
                'emulatePrepare' => true,
                'username' => 'romeofm_webfinyi',
                'password' => 'cukb97jy',
                'charset' => 'utf8',
                'enableProfiling' => YII_DEBUG,
                'enableParamLogging' => YII_DEBUG,
                'schemaCachingDuration' => YII_DEBUG ? 0 : 3600
            ),
        )
    )
);