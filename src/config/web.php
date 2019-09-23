<?php

return [
    'request' => function () {
        return \Illuminate\Http\Request::capture();
    },
    'db' => function () {
        $db = \Krugozor\Database\Mysql\Mysql::create(
            'db',
            'root',
            '123123'
        )
            ->setCharset('utf8')
            ->setDatabaseName('database');

        return $db;
    },
    'user' => function () {
        return new \App\core\User();
    }
];
