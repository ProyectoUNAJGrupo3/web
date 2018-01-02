<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'mvc',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'CzczzQS_nLh8o_-rvH4v5vUbJFMudpXl',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
			'class' => 'Swift_SmtpTransport',
			'host' => 'smtp.gmail.com',
			'username' => 'empresaremisya@gmail.com',
			'password' => 'proyectoyii',
			'port' => '587',
			'encryption' => 'tls',
			],
        ],
     'pusher' => [
            'class'     => 'br0sk\pusher\Pusher',
            //Mandatory parameters
            'appId'     => '275025',
            'appKey'    => 'e8fe2051103b337d6497',
            'appSecret' => 'b817f1a5ba24579406fb',
            //Optional parameter
            'options'   => ['encrypted' => false]
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
          */
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
