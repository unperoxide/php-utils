<?php

require_once __DIR__ . '/FileVariableManipulator.php';

$replacement = [
    'updated_at' => time(),
];

FileVariableManipulator::replaceFileVariables(__DIR__ . '/example.php', $replacement);

$variables = FileVariableManipulator::extractFileVariables(__DIR__ . '/example.php');

echo json_encode(compact('variables'), JSON_PRETTY_PRINT);