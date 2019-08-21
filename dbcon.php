#!/usr/bin/env php
<?php
$config = [
    'host' => '192.168.1.150',
    'user' => 'test',
    'password' => '1111',
    'dbname' => 'INFORMATION_SCHEMA',
];

///dont touch
$mysqli = mysqli_init();
if (!$mysqli) {
    die('mysqli_init завершилась провалом');
}

if (!$mysqli->options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 0')) {
    die('Установка MYSQLI_INIT_COMMAND завершилась провалом');
}

if (!$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5)) {
    die('Установка MYSQLI_OPT_CONNECT_TIMEOUT завершилась провалом');
}

if (!$mysqli->real_connect(...array_values($config))) {
    echo "false" . PHP_EOL;
}


function e($txt)
{
    echo date('H:i:s') . ":$txt" . PHP_EOL;
}

while (true) {
    try {
        $result = $mysqli->query('SHOW PROCESSLIST;');
        if (!empty($mysqli->errno)) {
            e('false');
            $mysqli->real_connect(...array_values($config));
        } else {
            e('true');
        }
    } catch (\Exception $exception) {
        e('false');
    }

    sleep(1);
}
$mysqli->close();