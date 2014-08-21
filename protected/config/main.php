<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'posly.com',
	'theme'=>'classic',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

'timeZone' => 'Asia/Calcutta',

	'modules'=>array(
		'user'=>array(),
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'hybridAuth'=>array(
            'class'=>'ext.widgets.hybridAuth.CHybridAuth',
            'enabled'=>true, // enable or disable this component
            'config'=>array(
                 "base_url" => "http://localhost/projects/posly_v2/posly/index.php/user/hybridauth/endpoint", 
                 "providers" => array(
                       "Google" => array(
                            "enabled" => false,
                            "keys" => array("id" => "", "secret" => ""),
                        ),
                       "Facebook" => array(
                            "enabled" => true,
                            "keys" => array("id" => "508534549216916", "secret" => "b3400b3da3b05ad469ee5ba2cc2d289e"),
                        ),
                       "Twitter" => array(
                            "enabled" => false,
                            "keys" => array("key" => "", "secret" => "")
                       ),
                 ),
                 "debug_mode" => false,
                 "debug_file" => "",
             ),
         ),//end hybridAuth
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				''=>'site/index',
				'country/<c:\w+>'=>'site/country',
				'males'=>'site/males',
				'females'=>'site/females',
				'topmembers'=>'site/topmembers',
				'newmembers'=>'site/newmembers',
				'following'=>'site/following',
				'tags/<hid:\d+>'=>'site/hashtags',
				'<url>'=>'profile/index',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=newposly',
			'emulatePrepare' => true,
			'username' => 'root',
			// uncomment enableParamLogging to Debug query
			//'enableParamLogging' => true,
			'password' => '',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, info',
					'categories'=>'system.*',
				),
				// uncomment CWebLogRoute to show log messages on web pages				
				/*array(
					'class'=>'CWebLogRoute',
				),*/				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'pearzraj@gprtechservices.com',
		'fbid'=>'508534549216916',
	),
);