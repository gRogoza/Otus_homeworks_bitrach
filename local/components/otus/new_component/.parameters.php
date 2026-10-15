//скопировано с hmarketing из раздела страничной навигации, удалить если не пригодится
<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
if (!CModule::IncludeModule('iblock')) {
ShowError('Модуль «Информационные блоки» не установлен');
return;
}

CPageOption::SetOptionString('main', 'nav_page_in_session', 'N');

if (!isset($arParams['CACHE_TIME'])) {
$arParams['CACHE_TIME'] = 3600;
}
// тип инфоблока
$arParams['IBLOCK_TYPE'] = trim($arParams['IBLOCK_TYPE']);
// идентификатор инфоблока
$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
// количество элементов на страницу
$arParams['ELEMENT_COUNT'] = intval($arParams['ELEMENT_COUNT']);
if ($arParams['ELEMENT_COUNT'] <= 0) {
$arParams['ELEMENT_COUNT'] = 3;
}
// учитывать права доступа при кешировании
$arParams['CACHE_GROUPS'] = $arParams['CACHE_GROUPS']=='Y';
// показывать постраничную навигацию вверху списка элементов
$arParams['DISPLAY_TOP_PAGER'] = $arParams['DISPLAY_TOP_PAGER']=='Y';
// показывать постраничную навигацию внизу списка элементов
$arParams['DISPLAY_BOTTOM_PAGER'] = $arParams['DISPLAY_BOTTOM_PAGER']=='Y';
// поясняющий текст для постраничной навигации
$arParams['PAGER_TITLE'] = trim($arParams['PAGER_TITLE']);
// всегда показывать постраничную навигацию, даже если в этом нет необходимости
$arParams['PAGER_SHOW_ALWAYS'] = $arParams['PAGER_SHOW_ALWAYS']=='Y';
// имя шаблона постраничной навигации
$arParams['PAGER_TEMPLATE'] = trim($arParams['PAGER_TEMPLATE']);
$arParams['PAGER_SHOW_ALL'] = $arParams['PAGER_SHOW_ALL']=='Y';
// получаем все параметры постраничной навигации, от которых будет зависеть кеш
$arNavParams = null;
$arNavigation = false;
if ($arParams['DISPLAY_TOP_PAGER'] || $arParams['DISPLAY_BOTTOM_PAGER']) {
$arNavParams = array(
// количество элементов на странице
'nPageSize' => $arParams['ELEMENT_COUNT'], 
// показывать ссылку «Все элементы»?
'bShowAll' => $arParams['PAGER_SHOW_ALL'], 
);
$arNavigation = CDBResult::GetNavParams($arNavParams);
}
$cacheDependence = array($arParams['CACHE_GROUPS'] ? $USER->GetGroups() : false, $arNavigation);

if ($this->StartResultCache(false, $cacheDependence)) {
// какие поля раздела инфоблока выбираем
$arSelect = array(/*...*/);
// условия выборки раздела инфоблока
$arFilter = array(/*...*/);
// выполняем запрос к базе данных
$rsSection = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);
$arResult = $rsSection->GetNext();
/*
* Получаем элементы этого раздела инфоблока
*/
if ($arResult) {
// какие поля элементов выбираем
$arSelect = array(/*...*/);
$arFilter = array(/*...*/);

$arSort = array(/*...*/);

$rsElements = CIBlockElement::GetList($arSort, $arFilter, false, $arNavParams, $arSelect);
$arResult['ITEMS'] = array();
while ($arItem = $rsElements->GetNext()) {
$arResult['ITEMS'][] = $arItem;
}

$arResult['NAV_STRING'] = $rsElements->GetPageNavString(
$arParams['PAGER_TITLE'],
$arParams['PAGER_TEMPLATE'],
$arParams['PAGER_SHOW_ALWAYS'],
$this
);

$this->SetResultCacheKeys(

);
// подключаем шаблон и сохраняем кеш
$this->IncludeComponentTemplate();
} else { // если раздел инфоблока не найден
$this->AbortResultCache();
\Bitrix\Iblock\Component\Tools::process404(/*...*/);
}
}
if (isset($arResult['ID'])) {
}

