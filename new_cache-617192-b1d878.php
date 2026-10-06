<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$cacheTime = 5; // время кеширования, указывается в секундах
$cacheId = 'unique_tag'; // формируем идентификатор кеша в зависимости от параметров
$cacheDir = '/'; // директория кеша
$cache = \Bitrix\Main\Data\Cache::createInstance();
$taggedCache = \Bitrix\Main\Application::getInstance()->getTaggedCache();

$myTag = 'my_awesome_tag';

if ($cache->initCache($cacheTime, $cacheId, $cacheDir)) {
    echo '1' . PHP_EOL;
    $result = $cache->getVars();
} elseif ($cache->startDataCache()) {
    echo '2' . PHP_EOL;
    $result = [
        'Kurt Cobain',
        'Krist Novoselic',
    ];
    $taggedCache->registerTag($myTag);

    $cacheInvalid = false;
    if ($cacheInvalid) {
        $taggedCache->abortTagCache();
        $cache->abortDataCache();
    }

    $taggedCache->endTagCache();
    $cache->endDataCache($result);
}
print_r($result);
$cache->clean($cacheId);

$taggedCache->clearByTag($myTag);