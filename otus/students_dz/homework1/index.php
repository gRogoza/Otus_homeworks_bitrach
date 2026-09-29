<?php
use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("ДЗ #1: Создание и настройка проекта в VScode");

Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');


?>
<h1 class="mb-3"><?php $APPLICATION->ShowTitle() ?></h1>

<h4 class="mb-3">Пояснительная записка</h4>
    <div style="color: red;font-style: italic;">
        вход на хостинг, загрузка учебной версии через скрипт bitrixsetup.php, аналогичные действия для vm bitrix на локалке, связывание гитхаба с хостингом через ssh, также с phpstorm.  написание коммита -> загрузка.
    </div>
<br>
<br>
<hr>




<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>