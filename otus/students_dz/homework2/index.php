<?php

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("ДЗ #2: Отладка и логирование");

Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

?>
    <h1 class="mb-3"><? $APPLICATION->ShowTitle() ?></h1>

    <h4 class="mb-3">Пояснительная записка</h4>
    <div style="color: darkmagenta;font-style: normal;white-space: pre-line">
        Были реализованы:
        классы Log.php и MyException.php(класс логгер и класс исключений /local/App/Debug/Log.php | MyException.php)
        внутри реаилзованы: метод writ() - формирует строку из даты/времени и метки OTUS, после чего дописывает ее в конец файла, метод clear() - очищает содержимое  файла :
        автозагрузка  классов реализована через spl_autoload_register() внутри autoload.php.
        2 файла для заполнения логами - exception_custom.log и log_custom.log
        внутри otus/students_dz/homework2 изменены 5 файлов
        index php - страница со ссылками
        writelog.php - при обращении к файлу по http записывает дату время через класс Log
        clearlog.php - очищает содержимое
        writeexception.php - генерирует тестовое исключение MyException, перехватывает его через трай кеч, записывает.
        clearexception.php - очищает содержимое
    </div>
    <hr>
    <div style="color: steelblue;font-style: normal;"></div>
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-success text-white">
            Файлы проекта: Часть 1 - Logger
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=/local/logs/log_custom.log"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    это файл логоф
                </span>
                    <span class="badge bg-success">
                    log_custom.log
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=otus/students_dz/homework2/writelog.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                   это файл записи в логи
                </span>
                    <span class="badge bg-secondary">
                    writelog.php
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=otus/students_dz/homework2/clearlog.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    это файл зачистки логоф
                </span>
                    <span class="badge bg-warning">
                    clearlog.php
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=/local/App/Debug/Log.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Класс кастомного Логера
                </span>
                    <span class="badge bg-primary">
                        Log.php
                </span>
                </a>
            </li>

        </ul>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header bg-success text-white">
            Файлы проекта: Часть 2 - Exception
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=local/logs/exception_custom.log"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Файл исключений
                </span>
                    <span class="badge bg-primary">
                    exception_custom.log
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=otus/students_dz/homework2/writeexception.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Запись исключений
                </span>
                    <span class="badge bg-success">
                    writeexception.php
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=otus/students_dz/homework2/clearexception.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Очистка файла исключений
                </span>
                    <span class="badge bg-secondary">
                    clearexception.php
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=local/App/Debug/MyException.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    класс исключений
                </span>
                    <span class="badge bg-warning">
                    MyException.php
                </span>
                </a>
            </li>
        </ul>
    </div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>