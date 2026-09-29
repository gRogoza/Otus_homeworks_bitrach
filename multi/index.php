<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
/** @global $APPLICATION */
$APPLICATION->SetTitle('Множественное свойство');
$APPLICATION->SetAdditionalCSS('/doctors/style.css');

// получение одной записи из инфоблока Страна в виде объекта
$countryId = 77; // Element{Country}Table
$country = \Bitrix\Iblock\Elements\ElementCountryTable::getByPrimary(
    $countryId,  
    array(
        'select' => [
            '*',
            // 'NAME',
            'CODE',
            'CURRENCY',
            'CITIES.ELEMENT.NAME', 
            'CITIES.ELEMENT.ENGLISH',
            'CAPITAL.ELEMENT.NAME',
            'CAPITAL.ELEMENT.ENGLISH',
        ] 
    )
)->fetchObject(); 


pr($country->getId()); // ID элемента // get('ID')
pr($country->getName()); // имя элемента // get('NAME')
pr($country->getCode()); // символьный код элемента // get('CODE')

pr($country->getCurrency()->getValue()); // свойство элемента Валюта  

// свойство элемента Столица  
// pr($country->getCapital()->getElement()->getId().' '.$country->getCapital()->getElement()->getName().' '.$country->getCapital()->getElement()->getEnglish()->getValue()); 

// множественное свойство элемента Города  
foreach($country->getCities()->getAll() as $prItem) {
    // pr($prItem->getElement()->getEnglish()->getValue().' '.$prItem->getElement()->getName());
    pr($prItem->getElement()->get('ID').' '.$prItem->getElement()->get('ENGLISH')->getValue().' '.$prItem->getElement()->getName());
}


// получение одной записи из инфоблока Страна в виде массива
/*$countryId = 77; 
$res = \Bitrix\Iblock\Elements\ElementCountryTable::getByPrimary($countryId, 
    array('select' => [
            // '*', 
            'CURRENCY',
            'CITIES.ELEMENT.NAME', 
            'CITIES.ELEMENT.ENGLISH',
            'CAPITAL.ELEMENT.NAME',
            'CAPITAL.ELEMENT.ENGLISH',
        ]
    )
)->fetch();

// pr($res['NAME']); // имя элемента
// pr($res['IBLOCK_ELEMENTS_ELEMENT_COUNTRY_CAPITAL_ELEMENT_NAME']); // CAPITAL - единственное свойство Столица, тип привязка к элементам в виде списка
//pr($res['IBLOCK_ELEMENTS_ELEMENT_COUNTRY_CAPITAL_ELEMENT_ENGLISH_VALUE']);
pr($res);*/


// получение списка записей из инфоблока Cтрана в виде коллекции
/*$countryId = 77;
$countries = \Bitrix\Iblock\Elements\ElementCountryTable::getList([
        'select' => [
            'ID', 
            'NAME', 
            'CURRENCY', // CURRENCY - единственное свойство Валюта, тип строка
            'CAPITAL.ELEMENT', // CAPITAL - единственное свойство Столица, тип привязка к элементам в виде списка
            'CITIES.ELEMENT', // CITIES - множественное свойство Города, тип привязка к элементам в виде списка 
            'CITIES.ELEMENT.ENGLISH' // ENGLISH - единственное свойство En, инфоблок Города
        ], 
        'filter' => [
            'ID' => $countryId,
            'ACTIVE' => 'Y'
        ],
   ])->fetchCollection();


foreach ($countries as $element) {
    pr($element->getName());
    pr($element->getCurrency()->getValue());
    pr($element->getCapital()->getElement()->getName());

    foreach($element->getCities()->getAll() as $prItem) {
        pr($prItem->getElement()->get('ID').' '.$prItem->getElement()->getName().' '.$prItem->getElement()->get('ENGLISH')->getValue());
    }
}*/


/*$countryId = 77;
// $countryId = 79;
// получение списка записей из инфоблока Cтрана в виде массива
$countries = \Bitrix\Iblock\Elements\ElementCountryTable::getList([
        'select' => [
            'ID', 
            'NAME', 
            'CURRENCY', // CURRENCY - единственное свойство Валюта, тип строка, инфоблок Страна
            'CAPITAL.ELEMENT', // CAPITAL - единственное свойство Столица, тип привязка к элементам в виде списка, инфоблок Страна
            'CITIES.ELEMENT', // CITIES - множественное свойство Города, тип привязка к элементам в виде списка, инфоблок Страна
            'CITIES.ELEMENT.ENGLISH' // ENGLISH - единственное свойство En, инфоблок Города
        ], 
        'filter' => [
            // 'ID' => $countryId,
            'ACTIVE' => 'Y'
        ],

   ])->fetchAll();

foreach ($countries as $key => $item) {

    pr($item['NAME'].' '.$item['IBLOCK_ELEMENTS_ELEMENT_COUNTRY_CITIES_ELEMENT_NAME']);
    // pr($item['NAME']);
    // pr($item);

}*/




/*
use Bitrix\Iblock\Iblock;
$iblockId = 24; // ID инфоблока Страна
// метод Iblock::wakeUp($iblockId) используется для быстрой инициализации объекта инфоблока без выполнения лишнего, SQL-запроса к базе данных, служит точкой входа для получения динамического API-класса конкретного инфоблока
$entity = Iblock::wakeUp($iblockId)->getEntityDataClass();

if ($entity) {
    $res = $entity::getList(array(
        'order' => array('SORT' => 'ASC'),
        'select' => array(
            'ID', 
            'NAME',
            'CURRENCY', // CURRENCY - единственное свойство Валюта, тип строка, инфоблок Страна
            'CAPITAL.ELEMENT.NAME', // CAPITAL - единственное свойство Столица, тип привязка к элементам в виде списка, инфоблок Страна
            
            // CITIES - множественное свойство Города, тип привязка к элементам в виде списка, инфоблок Страна
            'CITIES.ELEMENT.NAME', 
            
            // ENGLISH - единственное свойство En, инфоблок Города
            'CITIES.ELEMENT.ENGLISH' 
        ),
        'limit' => 1000,
        'offset' => 0,
        // Разрешаем дублирование, так как у нас есть множественное свойство CITIES.
        // Без этого флага Битрикс склеит коллекцию некорректно.
        'data_doubling' => true, 
        'cache' => array(
            'ttl' => 3600,
            'cache_joins' => true
        ),
    ));


    $countries = $res->fetchCollection();

    foreach ($countries as $country) {
        pr('страна '.$country->getName());
        
        // единственное свойство типа "Строка/Список" (CURRENCY)
        if ($country->getCurrency()) {
            // Для свойств v2 значение обычно получается через getValue()
            pr('валюта '.$country->getCurrency()->getValue());
        }

        // единственное свойство привязка к элементу инфоблока (CAPITAL)
        if ($country->getCapital() && $country->getCapital()->getElement()) {
            $capitalElement = $country->getCapital()->getElement();
            pr('столица '.$capitalElement->getName());
        }

        // множественное свойство привязка к элементу инфоблока (CITIES)
       
        if ($country->getCities()) {
            pr('города ');

            // так как свойство множественное, getCities() возвращает коллекцию значений свойства
            foreach ($country->getCities() as $cityValue) {
                
                $cityElement = $cityValue->getElement(); 
                
                if ($cityElement) {
                    pr($cityElement->getName());
                    
                    if ($cityElement->getEnglish()) {
                        pr($cityElement->getEnglish()->getValue());
                    }
                }
            }
        }

    }
}*/


// число записей
/*

$res = \Bitrix\Iblock\ElementTable::getList(array(
    'select' => array('ID', 'NAME'),
    'filter' => array('IBLOCK_ID' => 24),
    'count_total' => true,
));

$count = $res->getCount();// количество записей  в БД
pr($count);

$count = $res->getSelectedRowsCount(); // метод getSelectedRowsCount возвращает количество полученных записей с учетом limit, доступно если при запросе было указано count_total = 1
pr($count);*/



// детальная картинка
/*$countryId = 77; // Element{Country}Table
$country = \Bitrix\Iblock\Elements\ElementCountryTable::getByPrimary(
    $countryId, 
    array(
        'select' => [
            '*',
            // 'NAME',
            'CURRENCY',
            'CITIES.ELEMENT.NAME', 
            'CITIES.ELEMENT.ENGLISH',
            'CAPITAL.ELEMENT.NAME',
            'CAPITAL.ELEMENT.ENGLISH',
        ] 
    )
)->fetchObject();

pr($country->getDetailPicture());

$arFile = CFile::MakeFileArray($country->getDetailPicture());
pr($arFile);*/



// добавление данных записей в инфоблок Автомобили (через старое ядро)
/*
\Bitrix\Main\Loader::IncludeModule("iblock");
$result = \Bitrix\Iblock\Elements\ElementCarTable::add(array(
   'NAME' => 'TEST',
   'ACTIVE' => 'Y',
)); 

if ($result->isSuccess()) {
    $id = $result->getId();
    CIBlockElement::SetPropertyValuesEx($id, false, array(
        'MODEL' => 'X5',
        'MANUFACTURER_ID'=>30,
        'CITY_ID'=>[36, 37],
        'ENGINE_VOLUME'=>'4',
        'PRODUCTION_DATE'=>date('d.m.Y'),
    ));
}*/

?>

