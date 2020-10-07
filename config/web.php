<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name'=>'Verified Professors',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','timezone'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'notifications' => [
            'class' => 'machour\yii2\notifications\NotificationsModule',
            // Point this to your own Notification class
            // See the "Declaring your notifications" section below
            'notificationClass' => 'app\components\Notification',
            // Allow to have notification with same (user_id, key, key_id)
            // Default to FALSE
            'allowDuplicate' => false,
            // Allow custom date formatting in database
            'dbDateFormat' => 'Y-m-d H:i:s',
            // This callable should return your logged in user Id
            'userId' => function() {
                return \Yii::$app->user->id;
            }
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'controllerMap' => [
                'settings' => [
                    'class' => 'dektrium\user\controllers\SettingsController',
                    'layout' => '@app/views/layouts/order',
                ],
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
            'enableUnconfirmedLogin' => true,
            // 'enableGeneratingPassword'=>true,
            'emailChangeStrategy'=>\dektrium\user\Module::STRATEGY_SECURE,
            'enableConfirmation'=>true,
            'confirmWithin' => 86400,
            'rememberFor'=>1209600,
            'recoverWithin'=>21600,
            'cost' => 12,
            'admins' => ['gits','Jay']
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
         'timezone' => [
            'class' => 'yii2mod\timezone\Timezone',
            'actionRoute' => '/site/timezone' //optional param - full path to page must be specified
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
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.zoho.com',
                'username' => 'no-reply@doctorateessays.com',
                'password' => 'Essays@2018',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],

        'payments_mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.zoho.com',
                'username' => 'payments.no-reply@doctorateessays.com',
                'password' => 'Essays@2018',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],

        'supportMailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.zoho.com',
                'username' => 'support@doctorateessays.com',
                'password' => 'Essays@2018',
                'port' => '465',
                'encryption' => 'ssl',
            ],
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
