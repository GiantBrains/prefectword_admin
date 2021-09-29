<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=perfectword.cwt10kna2qzo.eu-central-1.rds.amazonaws.com;dbname='.env('DB_NAME'),
    'username' => env('DB_USER'),
    'password' => env('DB_PASSWORD'),
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];

