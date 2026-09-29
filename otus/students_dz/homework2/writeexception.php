<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Ошибка для exeption");
?>
<ul class="list-group">
    <li class="list-group-item">
        <a href="../../../local/logs/exceptions_custom.log">Файл лога</a>
    </li>
</ul>
<?php
throw new \Exception ("Тестовое исключение 2 дза");

?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
