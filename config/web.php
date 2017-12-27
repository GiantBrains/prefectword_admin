<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name'=>'Doctorate Essays',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'controllerMap' => [
                'registration' => [
                    'class' => \dektrium\user\controllers\RegistrationController::className(),
                    'on ' . \dektrium\user\controllers\RegistrationController::EVENT_AFTER_REGISTER => function ($e) {
                        $user = \dektrium\user\models\User::findOne(['username'=>$e->form->username, 'email'=>$e->form->email]);
                        if ($user) {
                            Yii::$app->user->switchIdentity($user);
                        }
                        \Yii::$app->response->redirect(\Yii::$app->user->returnUrl);
                    },
                ],
            ],
            'mailer' => [
                'sender'                => ['no-reply@doctorateessays.com'=>'Doctorate Essays'], // or ['no-reply@myhost.com' => 'Sender name']
                'welcomeSubject'        => 'Welcome to Doctorate Essays',
                'confirmationSubject'   => 'Please confirm your email by clicking on the link below',
                'reconfirmationSubject' => 'Please re-confirm your email by clicking on the link below',
                'recoverySubject'       => 'The following are instructions on how to recover your password',
            ],
            //'enableUnconfirmedLogin' => true,
            // 'enableGeneratingPassword'=>true,
            'emailChangeStrategy'=>\dektrium\user\Module::STRATEGY_SECURE,
            'enableConfirmation'=>false,
            'confirmWithin' => 86400,
            'rememberFor'=>1209600,
            'recoverWithin'=>21600,
            'cost' => 12,
            'admins' => ['gits']
            // you will configure your module inside this file
            // or if need different configuration for frontend and backend you may
            // configure in needed configs
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'adminportalfordoctorateessays.com',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // uncomment if you want to cache RBAC items hierarchy
            // 'cache' => 'cache',
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'about'=>'site/about',
                'contact'=>'site/contact',
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
