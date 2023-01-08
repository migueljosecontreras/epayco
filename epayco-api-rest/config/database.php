<?php

return [

    'default' => env('DB_CONNECTION', 'users'),

    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                                                                          PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
                                                                      ]) : [],
        ],
        'mongodb' => [
            'driver' => 'mongodb',
            //'dsn' => env('DB_URI', 'mongodb+srv://'.env('DB_MONGO_USERNAME', 'homestead').':'.env('DB_MONGO_PASSWORD', 'secret').'@'.env('DB_MONGO_HOST', '127.0.0.1').':'.env('DB_MONGO_PORT', 27017).'/'.env('DB_MONGO_DATABASE', 'homestead').'?retryWrites=true&w=majority'),
            'host' => env('DB_MONGO_HOST', '127.0.0.1'),
            'port' => env('DB_MONGO_PORT', 27017),
            'database' => env('DB_MONGO_DATABASE', 'homestead'),
            'username' => env('DB_MONGO_USERNAME', 'homestead'),
            'password' => env('DB_MONGO_PASSWORD', 'secret'),
            'options' => array_merge(
                [
                    // here you can pass more settings to the Mongo Driver Manager
                    // see https://www.php.net/manual/en/mongodb-driver-manager.construct.php under "Uri Options" for a list of complete parameters that you can use
                    'ssl'      => env('DB_MONGO_SSL', false),
                    'database' => env('DB_MONGO_AUTH_DATABASE', env('DB_MONGO_DATABASE', 'admin')),
                    // required with Mongo 3+
                ],
                env('DB_MONGO_REPLICA_SET', null) ? [ 'replicaSet' => env('DB_MONGO_REPLICA_SET', null) ] : []),
        ],
    ],
    'migrations' => 'migrations',
];
