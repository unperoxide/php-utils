<?php

require_once __DIR__ . '/URLSafeBase64.php';

$string = '10e3d9fa-85dd-4f9d-9730-9de48b30ff44';

$encoded = URLSafeBase64::encode($string);
$decoded = URLSafeBase64::decode($encoded);

echo json_encode(compact([
    'string',
    'encoded',
    'decoded',
]), JSON_PRETTY_PRINT);