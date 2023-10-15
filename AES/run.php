<?php

require_once __DIR__ . '/AES.php';

$inputText = 'PHP AES Encryption!';
$inputKey = 'SECRET_KEY';

$blockSize = 256;

$aes = new AES($inputText, $inputKey, $blockSize);

$encrypted = $aes->encrypt();
$decrypted = $aes->setData($encrypted)->decrypt();

echo json_encode(compact('inputText', 'inputKey', 'encrypted', 'decrypted'), JSON_PRETTY_PRINT);