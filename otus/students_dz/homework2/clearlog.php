<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

require_once (__DIR__ . '/Log.php');

$logFile = __DIR__ . '/log.txt';
$logger = new \Debug\Log($logFile);
$logger -> clear();
LocalRedirect('/otus/students_dz/homework2/');
