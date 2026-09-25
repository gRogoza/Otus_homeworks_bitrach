<?
use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("ДЗ #1: Создание и настройка проекта в VScode");

Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');


?>
<h1 class="mb-3"><? $APPLICATION->ShowTitle() ?></h1>

<h4 class="mb-3">Пояснительная записка</h4>
    <div style="color: black;font-style: normal;white-space: pre-line">
        Был создан репозиторий на github gRogoza/Otus_homeworks_bitrach, пройдена авторизация на хостинге, ввод номера, загрузка на хостинг скрипта bitrixsetup.php, проведена первичная установка системы битрикс24.
        Скачан oracle virtualbox, к нему vmbitrix на базе centos stream 9.
        Далее авторизация в phpstorm, подключаюсь к хостингу, ввожу логин и пароль, генерирую ssh ключ -> ввожу его на гитхабе в настройках, также в phpstorm настраиваю 2 remote host: локальный связь с вмкой, и с хостингом.
        Финальный этап - пишу гитигнор по примеру с вебинара, пишу коммит, происходит небольшая проблемка с ветками из-за созданного ранее ридми в репозитории, пушу в репозиторий с хостинга файлы.
        итого:
        Github_url: https://github.com/gRogoza/Otus_homeworks_bitrach
        доступ к админке битрикс24:
        login: admin
        parol:qwerty10202
        открывать сайт: ch901554.tw1.ru
    </div>
<br>
<br>
<hr>




<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>