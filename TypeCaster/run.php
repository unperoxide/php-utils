<?php

require_once __DIR__ . '/TypeCaster.php';

$data = [
    'string' => 'hello',
    'integer' => '123',
    'float' => '3.14',
    'boolean_true' => 'true',
    'boolean_false' => 'false',
    'null' => 'null',
    'array' => ['1', '2', '3'],
    'object' => (object)['key' => 'value'],
];

$typeCastedData = TypeCaster::cast($data);

echo json_encode($typeCastedData, JSON_PRETTY_PRINT);