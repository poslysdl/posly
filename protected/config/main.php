<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here. 

$poslyIP = $_SERVER['SERVER_ADDR'];
if($poslyIP=='127.0.0.1'){
	$FB_APPId = '647620848638998'; //2pretty.in FBApp
	$FB_SECRETKey = "4855626d478b8c2280db3ef8a5ead448";
	$DB_USERNAME = 'root';
	$DB_PASSWORD = '';
	$Base_URL = 'http://localhost/projects/posly_v2/posly/index.php/user/hybridauth/endpoint';
	$INSTAGRAM_CLIENTID = "d1b24c4e53364af880b33c5561ce12f4";
	$INSTAGRAM_KEY = "6eae2cbe86a24929beec86437bc58c7f";
	$INSTARAM_REDIRECTURL = "http://localhost/projects/posly_v2/posly/index.php/site/instagramauth";
}else if($poslyIP=='172.31.7.97'){
	//AWS server
	$FB_APPId = '1482379155345539'; //LocalPosly FBApp
	$FB_SECRETKey = "44eb95e1a9a3eac850c1383d4eab1b8a";
	$DB_USERNAME = 'root';
	$DB_PASSWORD = 'root';
	$Base_URL = 'http://54.255.144.92/posly/index.php/user/hybridauth/endpoint';
	$INSTAGRAM_CLIENTID = "d1b24c4e53364af880b33c5561ce12f4";
	$INSTAGRAM_KEY = "6eae2cbe86a24929beec86437bc58c7f";
	$INSTARAM_REDIRECTURL = "http://54.255.144.92/posly/index.php/site/instagramauth";
} else{
	//nothing
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
         ),
		 //end hybridAuth	 
		'mail' => array(
			'class' => 'ext.yii-mail.YiiMail',
			'transportType'=>'smtp',
			'transportOptions'=>array(
			'host'=>'smtp.gmail.com',
			'username'=>'poslymail@gmail.com',
			'password'=>'posly123!',
			'port'=>'465',
			'encryption'=>'ssl',
			),
			'viewPath' => 'application.views.mail',
			'logging' => true,
			'dryRun' => false
		),
		 //Modile Detect	 
		'mobileDetect' => array(
			'class' => 'ext.MobileDetect.MobileDetect',			
		),	
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>true,
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
				'search'=>'site/search',
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
				// uncomment CWebLogRoute to show DB query log messages on web pages				
				/*array(
					'class'=>'CWebLogRoute',
					'enabled' => YII_DEBUG,
					'levels' => 'error, warning, trace, notice',
				),*/				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'pearzraj@gprtechservices.com',
		'fbid'=>$FB_APPId,
		'instaClientId'=>$INSTAGRAM_CLIENTID,
		'instaKey'=>$INSTAGRAM_KEY,
		'instaredirecturl'=>$INSTARAM_REDIRECTURL,
	),
);