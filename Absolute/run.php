<?php

require_once __DIR__ . '/Absolute.php';

echo '<pre>';

echo $_SERVER['REQUEST_URI'], PHP_EOL;
echo $_SERVER['PATH_INFO'] ?? '/', PHP_EOL;

echo Absolute::url(), PHP_EOL;
echo Absolute::url(__DIR__ . '/../foo'), PHP_EOL;
echo Absolute::url(__DIR__ . '/../foo/bar/../baz/index.php?foo=bar'), PHP_EOL;

// echo json_encode(compact('inputText', 'inputKey', 'encrypted', 'decrypted'), JSON_PRETTY_PRINT);