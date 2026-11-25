<?php

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<?php
$APPLICATION -> SetTitle("ДЗ #4: Создание своих таблиц БД и написание модели данных к ним");

Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

?>
    <h1 class="mb-3"><? $APPLICATION->ShowTitle() ?></h1>

    <h4 class="mb-3">Пояснительная записка</h4>
    <div>
        Создана таблица <code>hw_table_orm</code> с полями: ID, NAME и EMAIL
        (строковые и числовое), LIST_ONE_ID и LIST_TWO_ID (связываемые числовые).
        Модель <code>HwTable</code> наследует DataManager. Таблица создаётся
        отдельным скриптом через <code>createDbTable()</code>.
        <br><br>
        Созданы два списка (инфоблоки 18 и 19) со свойствами UTF_NAME и UTF_ID.
        Для них описаны модели <code>HwListOneTable</code> и
        <code>HwListTwoTable</code> на базе абстрактного класса значений свойств.
        <br><br>
        Связь реализована через <code>Reference</code> по ключу
        IBLOCK_ELEMENT_ID: поля LIST_ONE_ID и LIST_TWO_ID хранят ID элементов
        списков. На тестовой странице одним запросом выбираются поля таблицы
        и свойства связанных элементов обоих списков. Для выборки включено
        кэширование.

        запрос для просмотра таблицы: select*from hw_table_orm
    </div>
    <br>
    <br>
    <hr>
            local\App\Models\Lists\HwListOneTable.php
            local\App\Models\Lists\HwListTwoTable.php
            local\App\Models\Tables\HwTable.php
            homework_work_orm.php
            testing.php
            https://ch901554.tw1.ru/bitrix/admin/fileman_file_view.php?path=%2Ftesting.php&site=s1&lang=ru
            https://ch901554.tw1.ru/testing.php
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-success text-white">
            Файлы проекта
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item list-group-item-action">
                <a href="https://ch901554.tw1.ru/bitrix/admin/sql.php?lang=ru"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Ссылка на таблицу
                </span>
                    <span class="badge bg-success">
                   Ссылка на просмотр в админке
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="https://ch901554.tw1.ru/bitrix/admin/iblock_edit.php?type=lists&lang=ru&ID=18&admin=Y"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Список на ИБ 1
                </span>
                    <span class="badge bg-primary">
                   Ссылка на просмотр в админке
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="https://ch901554.tw1.ru/bitrix/admin/iblock_edit.php?type=lists&lang=ru&ID=19&admin=Y"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Список на ИБ 2
                </span>
                    <span class="badge bg-primary">
                   Ссылка на просмотр в админке
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="https://ch901554.tw1.ru/testing.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Ссылка на тестовую страницу
                </span>
                    <span class="badge bg-secondary">
                   Ссылка на просмотр
                </span>
                </a>
            </li>

            <li class="list-group-item list-group-item-action">
                <a href="https://ch901554.tw1.ru/bitrix/admin/fileman_file_view.php?path=%2Ftesting.php&site=s1&lang=ru"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Ссылка на тестовую страницу
                </span>
                    <span class="badge bg-warning">
                    файл в админке
                </span>
                </a>
            </li>

            <li class="list-group-item list-group-item-action">
                <a  href=""
                   class="d-flex justify-content-between align-items-center">
                <span>
                https://ch901554.tw1.ru/bitrix/admin/fileman_file_view.php?path=%2Fhomework_work_orm.php&site=s1&lang=ru<br>
                https://ch901554.tw1.ru/bitrix/admin/fileman_file_view.php?path=%2Ftesting.php&site=s1&lang=ru<br>
                https://ch901554.tw1.ru/bitrix/admin/fileman_file_view.php?path=%2Flocal%2FApp%2FModels%2FLists%2FHwListOneTable.php&site=s1&lang=ru<br>
                https://ch901554.tw1.ru/bitrix/admin/fileman_file_view.php?path=%2Flocal%2FApp%2FModels%2FLists%2FHwListTwoTable.php&site=s1&lang=ru<br>
                https://ch901554.tw1.ru/bitrix/admin/fileman_file_view.php?path=%2Flocal%2FApp%2FModels%2FTables%2FHwTable.php&site=s1&lang=ru
                </span>
                    <span class="badge bg-warning">
                    файл в админке
                </span>
                </a>
            </li>
        </ul>
    </div>





<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>