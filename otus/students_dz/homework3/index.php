<?
use Bitrix\Main\Page\Asset;
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<?php
$APPLICATION->SetTitle("ДЗ #3: Связывание моделей");
Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
?>
    <h1 class="mb-3"><? $APPLICATION->ShowTitle() ?></h1>

    <h4 class="mb-3">Пояснительная записка</h4>
    <div style="blue: red;font-style: italic;white-space: pre;">
        был взят с учебных материалов AbstractIblockPropertyValuesTable.php(в local/app/models).
        в админке были созданы в инфоблоке списки - врачи и процедуры, но почему-то они не появлялись на сайте, пришлось вручную пересоздавать через сервисы - списки - все списки - создать новый
        создание свойств  у списка врачей - специализация и процедуры(процедуры смотрелись одиноко поэтому добавил еще специализацию), задан тип "привяка к элементам списка". создан список процедур - без свойств.
        оба списка получили настройку хранения значений свойств в отдельной таблице для данного инфоблока
        созданы 2 класса наследующих абстрактный класс(директория local/App/Models/Lists), и задают IBLOCK_ID. (DoctorsPropertyValuesTable и ProceduresPropertyValuesTable)
        создан DoctorsPropertyValuesMultipleTable - нужен абстрактному классу для множественного св-ва у процедур.
        в DoctorsPropertyValuesTable::getMap() описан ReferenceField на процедуры через PROCEDURES |SNGLE, результат объединяется в parent::getMap()
        методы модели врачей getProcedureIds() возвращает ID процедур врача, linkProcedure добавляет связь  через CIBlockElement::SetPropertyValuesEx
        создана страница (doctors/index.php)
        данные получаются через getList()
        клик по врачу отправляет get запрос и показываются процедуры врача(либо сообщение что таковых нет)
        также созданы 3 post формы - добавление врача(имя и специализация) добавление процедуры и привязка первого ко второму. Добавка записей идет через add() абстрактного класса
        все тексты и страницы вынесены в /doctors/lang/ru/index.php - выводятся через Loc::getMessage()
    </div>
    <br>
    <br>
    <hr>
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-success text-white">
            Файлы проекта
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item list-group-item-action">
                <a href="http://ch901554.tw1.ru/services/lists/16/view/0/?list_section_id="
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Список врачей
                </span>
                    <span class="badge bg-primary">
                   ccылка на просмотр
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="http://ch901554.tw1.ru/services/lists/17/view/0/?list_section_id="
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Список процедур
                </span>
                    <span class="badge bg-success">
                   ссылка на просмотр
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="http://ch901554.tw1.ru/doctors/index.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Врачи и процедуры
                </span>
                    <span class="badge bg-secondary">
                   ссылка на просмотр созданной страницы(в т.ч. с функцией создания и связывания)
                </span>
                </a>
            </li>

                <span style="white-space: pre;">
                    http://ch901554.tw1.ru//bitrix/admin/fileman_file_view.php?path=/local/App/Models/Lists/DoctorsPropertyValuesMultipleTable.php
                    http://ch901554.tw1.ru//bitrix/admin/fileman_file_view.php?path=/local/App/Models/Lists/ProceduresPropertyValuesTable.php
                    http://ch901554.tw1.ru//bitrix/admin/fileman_file_view.php?path=/local/App/Models/Lists/DoctorsPropertyValuesTable.php
                </sp
                </span>
                </a>
            </li>
        </ul>
    </div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>