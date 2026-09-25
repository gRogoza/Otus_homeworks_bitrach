<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Ошибка для exception");
?>
<ul class="list-group">
    <li class="list-group-item">
        <a href="/local/logs/exception_custom.log">Файл лога</a>
    </li>
</ul>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/local/App/Debug/Log.php");

$logger = new \Debug\Log($_SERVER["DOCUMENT_ROOT"] . "/local/logs/exception_custom.log");
try {
    throw new \Debug\MyException("Тестовое исключение для логоф");
} catch (\Debug\MyException $e) {
    $logger->write($e->getMessage());
}
?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
