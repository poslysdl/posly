<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

$_SERVER['SERVER_ADDR']; //127.0.0.1
if($_SERVER['SERVER_ADDR']=='127.0.0.1'){
	$FB_APPId = '277829039091254';
	$FB_SECRETKey = "7291db28e16d2ecddb40a9e8e00e17e4";
	$DB_USERNAME = 'root';
	$DB_PASSWORD = '';
	$Base_URL = 'http://localhost/projects/posly_v2/posly/index.php/user/hybridauth/endpoint';
} else{
	$FB_APPId = '508534549216916';
	$FB_SECRETKey = "b3400b3da3b05ad469ee5ba2cc2d289e";
	$DB_USERNAME = 'root';
	$DB_PASSWORD = 'sdl123';
	$Base_URL = 'http://localhost/projects/posly_v2/posly/user/hybridauth/endpoint';
}
//** Above code added, to change credentials according to live & developement server

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
                 "base_url" => $Base_URL, 
                 "providers" => array(
                       "Google" => array(
                            "enabled" => false,
                            "keys" => array("id" => "", "secret" => ""),
                        ),
                       "Facebook" => array(
                            "enabled" => true,
                            "keys" => array("id" => $FB_APPId, "secret" => $FB_SECRETKey),
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
				'viral'=>'site/viral',
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
			'username' => $DB_USERNAME,
			// uncomment enableParamLogging to Debug query
			//'enableParamLogging' => true,
			'password' => $DB_PASSWORD,
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