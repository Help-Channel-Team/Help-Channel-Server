<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

return [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'gii' => 'yii\gii\Module',
    	'gridview' =>  [
    		'class' => '\kartik\grid\Module',
    		// enter optional module parameters below - only if you need to
    		// use your own export download action or custom translation
    		// message source
    		// 'downloadAction' => 'gridview/export/download',
    		// 'i18n' => []
    	],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    	'authManager' => [
    		'class' => 'yii\rbac\PhpManager',
    		'defaultRoles' => ['admin', 'TECH','USER'],
    	],
    ],
    'params' => $params,
];
