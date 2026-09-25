<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/local/App/Debug/Log.php");

$logger = new \Debug\log($_SERVER["DOCUMENT_ROOT"] . "/local/logs/exception_custom.log");
$logger->clear();

LocalRedirect('/otus/students_dz/homework2/');
