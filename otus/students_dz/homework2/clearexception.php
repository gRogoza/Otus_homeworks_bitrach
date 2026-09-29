<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$logger = new \Debug\Log($_SERVER["DOCUMENT_ROOT"] . "/local/logs/exception)custom.log");
$logger -> clear();
LocalRedirect('/otus/students_dz/homework2/');
