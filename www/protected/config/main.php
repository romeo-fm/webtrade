<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'webtrade',
    'controllerMap' => array(
        'gallery' => 'ext.galleryManager.GalleryController',
    ),
	'theme' => 'default',
	'homeUrl' => array('/site/index'),
	// preloading 'log' component
	'preload' => array('log'),
	'sourceLanguage'=>'00',
	'language' => 'ru',
	'aliases' => array(
		'bootstrap' => 'ext.bootstrap3',
	),
	// autoloading model and component classes
	'import' => array(
		'application.vendor.Helper',
		'application.models.*',
		'application.components.*',
		'application.widgets.*',
		'application.libs.*',
		'ext.YiiMailer.YiiMailer',
		'ext.ckeditor',
        'ext.galleryManager.models.*',
		'ext.giix-components.*',
		'ext.SoftDelete.SoftDeleteBehavior',
		'bootstrap.behaviors.*',
		'bootstrap.helpers.*',
		'bootstrap.widgets.*',
	),
	'modules' => array(
        'redemption',
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'generatorPaths' => array(
				'ext.giix-core', // giix generators
				'bootstrap.gii', // bootstrap generator
			),
			'password' => "ghtdtl",
			'ipFilters' => array(OWNER),
		),
	),
	// application components
	'components' => array(
		'user' => array(
			// enable cookie-based authentication
            'class' => 'CWebUser',
			'allowAutoLogin' => true,
			'loginUrl' => array('/redemption/login'),
		),
        'image' => array(
            'class' => 'ext.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
        ),
		// uncomment the following to enable URLs in path-format

		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => array(
                // API REST patterns
                array('api/commentsView', 'pattern' => 'api/comments', 'verb' => 'get'),
                array('api/commentsCreate', 'pattern' => 'api/comments', 'verb' => 'post'),
                array('api/newsView', 'pattern' => 'api/news', 'verb' => 'get'),
                array('api/ratingCreate', 'pattern' => 'api/rating', 'verb' => 'post'),
                array('api/ratingView', 'pattern' => 'api/rating', 'verb' => 'get'),
                array('api/categoryView', 'pattern' => 'api/category', 'verb' => 'get'),
                array('api/pushmeCreate', 'pattern' => 'api/pushme', 'verb' => 'post'),
                array('api/newsbodyView', 'pattern' => 'api/news/body', 'verb' => 'get'),

                // Other patterns
                'gii'=>'gii',
				'redemption' => '/redemption/index/login',
				'redemption/login' => '/redemption/index/login',
				'redemption/logout' => '/redemption/index/logout',
				'<controller:\w+>' => '<controller>/index',
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
			),
		),
        'cache' => array(
            'class' => 'CDummyCache'//YII_DEBUG ? 'CDummyCache' : 'CMemCache'
        ),
		'errorHandler' => array(
			'errorAction' => 'index/error',
		),
		'bootstrap' => array(
			'class' => 'bootstrap.components.BsApi'
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
			),
		),
	),

	'params' => require_once(__DIR__ . DIRECTORY_SEPARATOR . 'params.php'),
);
