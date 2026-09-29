<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$logger = new \Debug\Log($_SERVER["DOCUMENT_ROOT"] . "/local/logs/log_custom.log");
$logger ->write("Jnrhsnf страничка writelog.php");
LocalRedirect('/otus/students_dz/homework2/');
