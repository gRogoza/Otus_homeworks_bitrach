<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$cacheTime = 60*60; // время кеширования, указывается в секундах
$cacheId = 'unique_tag'; // формируем идентификатор кеша в зависимости от параметров
$cacheDir = '/'; // директория кеша
// создаем объект
$obCache = new CPHPCache(); // если кеш есть и он ещё не истек, то
$init = $obCache->InitCache($cacheTime, $cacheId);
print_r($init);
echo PHP_EOL;

if($init)
{
    echo 'Путь 1';
    echo PHP_EOL;
    // получаем закешированные переменные
    $arResult = $obCache->GetVars();
}
else // иначе обращаемся к базе
{
    echo 'Путь 2';
    echo PHP_EOL;
    $arResult = [
        'REAL_MADRID' => ['Toni Kroos', 'Lika Modric', 'Federico Valverde2'],
        'FC_BAYERN' => ['Thomas Müller', 'Leon Goretzka', 'Joshua Kimmich']
    ];
}
// начинаем буферизирование вывода
if($obCache->StartDataCache())
{
    // записываем данные в файл кеша
    $obCache->EndDataCache(['RESULT' => $arResult]);
}
$obCache->CleanDir(); //сброс

print_r($arResult);