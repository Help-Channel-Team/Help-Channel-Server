<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'language' => 'es',
	'modules' => [
			'gridview' =>  [
					'class' => '\kartik\grid\Module',
					// enter optional module parameters below - only if you need to
					// use your own export download action or custom translation
					// message source
					// 'downloadAction' => 'gridview/export/download',
					// 'i18n' => []
			],
			'dynagrid'=> [
                        'class'=>'\kartik\dynagrid\Module',
                        'minPageSize' => 1,
                        'maxPageSize' => 100                        
                        // other module settings
                ]
	],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '9U77vdG2H33Q0y1LLaeydFk0-XixNpYE',
        	'parsers' => [
        		'application/json' => 'yii\web\JsonParser',
        	]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'session' => array('timeout' => 300),
    	'authManager' => [
    		'class' => 'yii\rbac\PhpManager',
    		'defaultRoles' => ['ADMIN', 'TECH', 'USER'],
    	],
    	'urlManager' => [
			'class' => 'yii\web\UrlManager',
			// Disable index.php
			'showScriptName' => false,
			// Disable r= routes
			'enablePrettyUrl' => true,
			'rules' => array(
			        '<controller:\w+>/<id:\d+>' => '<controller>/view',
			        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
			        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
					['class' => 'yii\rest\UrlRule', 'controller' => 'rest\<controller>'],
			),
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config ['modules'] ['gii'] = [
    		'class' => 'yii\gii\Module',
//     		'allowedIPs' => ['1.1.1.1'],
    		'generators' => [ //here
    				'crud' => [ // generator name
    						'class' => 'yii\gii\generators\crud\Generator', // generator class
    						'templates' => [ //setting for out templates
    								'dynagrid template' => '@app/templates/crud/dynagrid', // template name => path to template
    						]
    				]
    		],
    ];
}

return $config;
