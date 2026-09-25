<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle('Работа с API инфоблоков');

use Bitrix\Main\Loader;
use Bitrix\Iblock\Iblock;
Loader::includeModule('iblock');

$iblockId = 19;
$iblockElementId = 41;

// Old API 
$arFilter = ['IBLOCK_ID' => $iblockId, 'ACTIVE' => 'Y'];
$arSelect = ['ID', 'NAME', 'CODE', 'PROPERTY_MODEL', 'PROPERTY_MANUFACTURER_ID'];
$res = CIBlockElement::GetList([], $arFilter, false, [], $arSelect);
$items = [];
while($arFields = $res->fetch()){
    // pr($arFields);
    $items[] = $arFields;
}
pr($items);


/*// создание новой записи в инфоблоке через CIBlockElement
$arElementProps = [
    'MODEL' => 'X5',
    'COUNTRY'=> 77,
];
$arIblockFields = [
    'IBLOCK_ID' => $iblockId,
    'NAME' => 'New element',
    'PROPERTY_VALUES' => $arElementProps
];
$objIblockElement = new \CIBlockElement();
$objIblockElement->Add($arIblockFields);*/


// ORM

// ORM с использованием wakeUp
// wakeUp - метод позволяет без повторного обращения в БД создать объект на основе хранящийся в кэш, сессии или переменной информации об элементе инфоблока и работать с ним через ORM  

/*$iblock = Iblock::wakeUp($iblockId);
$element = $iblock->getEntityDataClass()::getByPrimary(  // get props
	$iblockElementId, 
	['select' => ['NAME', 'MODEL']])
->fetchObject();

$name = $element->get('NAME');
echo 'NAME: ';
pr($name);

$model = $element->get('MODEL')->getValue();
echo 'MODEL: ';
pr($model);*/



// ORM с использованием Element{код инфоблока}Table
// getList - метод позволяет сохранить в переменную коллекцию объектов (элементов инфоблока)
/*$elements = \Bitrix\Iblock\Elements\ElementCarTable::getList([ // car - cимвольный код API инфоблока
    'select' => ['*'], // имя свойства 
])->fetchCollection();

foreach ($elements as $element) {
    pr('NAME - '.$element->getName().' MODEL - '.$element->get('MODEL')->getValue()); 
    // pr('NAME - '.$element->getName()); 
    // pr('MODEL - '.$element->getModel()->getValue()); // получение значения свойства MODEL
}*/


/*$elements = \Bitrix\Iblock\Elements\ElementCarTable::getList([ // car - cимвольный код API инфоблока
    'select' => ['*'], // имя свойства 
])->fetchAll();

foreach ($elements as $element) {
    // pr('NAME - '.$element->getName().' MODEL - '.$element->get('MODEL')->getValue()); 
    // pr('NAME - '.$element->getName()); 
    // pr('MODEL - '.$element->getModel()->getValue()); // получение значения свойства MODEL

    pr($element);
}*/



// query - метод позволяет строить более гибкие и сложные запросы для выборки данных данных через ORM
/*// получение через метод query списка элементов
$elements = \Bitrix\Iblock\Elements\ElementCarTable::query() // car - cимвольный код API инфоблока
    ->addSelect('NAME')
    ->addSelect('MODEL') // имя свойства 
    ->addSelect('ID')
    ->fetchCollection();

$items = [];

foreach ($elements as $key => $item) {
    // pr($item->getName().' '.$item->getModel()->getValue()); // получение значения свойства MODEL
    $value = $item->getModel()->getValue();    
    if($value == 'Q7'){
            $item->setModel('Q7 TEST'); // изменение значения свойства MODEL
            $item->save(); // сохранение данных
    }

    $items[]['NAME'] = $item->getName();
    $items[]['MODEL'] = $item->getModel()->getValue();
}
pr($items);*/

// Получить свойства инфоблока
/*$dbIblockProps = \Bitrix\Iblock\PropertyTable::getList(array(
    'select' => array('*'),
    'filter' => array('IBLOCK_ID' =>$iblockId)
));

while ($arIblockProps = $dbIblockProps->fetch()){ 
    pr($arIblockProps);
}
*/

/*// Получить список элементов инфоблока
$dbItems = \Bitrix\Iblock\ElementTable::getList(array(
    'select' => array('ID', 'NAME', 'IBLOCK_ID'),
    'filter' => array('IBLOCK_ID' => $iblockId)
));
$items = [];
while ($arItem = $dbItems->fetch()){  
    $dbProperty = \CIBlockElement::getProperty(
        $arItem['IBLOCK_ID'],
        $arItem['ID']
    );
    while($arProperty = $dbProperty->Fetch()){  
        $arItem['PROPERTIES'][] = $arProperty;
    }
    $items [] = $arItem;
}
pr($items);
*/

// добавление нового элемента в инфоблок Автомобили
/*\Bitrix\Main\Loader::IncludeModule("iblock");
$result = \Bitrix\Iblock\Elements\ElementCarTable::add(array(
   'NAME' => 'TEST',
   'ACTIVE' => 'Y',
)); 

if ($result->isSuccess()) {
    $id = $result->getId();
    CIBlockElement::SetPropertyValuesEx($id, false, array(
        'MODEL' => 'X5',
        'MANUFACTURER_ID'=>30,
        'CITY_ID'=>36,
        'ENGINE_VOLUME'=>'4',
        'PRODUCTION_DATE'=>date('d.m.Y'),
    ));
}*/


// редактирование элемента в инфоблоке Автомобили
/*\Bitrix\Main\Loader::IncludeModule("iblock");
// делаем запрос на изменение поля NAME в записи (BMW X5) с ID 29
$res = \Bitrix\Iblock\Elements\ElementCarTable::update(99, array(
    'NAME' => 'TEST 777', // Ford Fiesta MK5
)); 
*/

// удаление записи из инфоблока Автомобили
/*\Bitrix\Main\Loader::IncludeModule("iblock");
$res = \Bitrix\Iblock\Elements\ElementCarTable::delete(103);
pr($res);*/
