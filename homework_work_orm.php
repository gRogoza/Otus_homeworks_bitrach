<?php
use Bitrix\Main\Application;
use Bitrix\Main\ORM\Entity;
use Models\Tables\HwTable;
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

$entity = Entity::getInstance(HwTable::class);
$connection = Application::getConnection(HwTable::getConnectionName());

if (!$connection->isTableExists($entity->getDBTableName())) 
{
    $entity->createDbTable();
}
