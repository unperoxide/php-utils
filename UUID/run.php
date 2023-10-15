<?php

require_once __DIR__ . '/UUID.php';

$uuids = [];

for ($i = 0; $i < 10; $i++) {
    $uuids[] = UUID::v4();
}

echo json_encode($uuids, JSON_PRETTY_PRINT);