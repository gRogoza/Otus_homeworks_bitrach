<?php

use Bitrix\Main\Application;
use Bitrix\Main\ORM;
use GAtom\UniversalExchangeIBlockViaExcel\ORM as GAtomORM;

require $_SERVER['DOCUMENT_ROOT'] . '/local/orm/importfiletable.php';

$obQuery = GAtomORM\ImportFileTable::add([
    'TOTAL_STEPS' => 3,
]);
$obQuery->getErrors();

if (
    Application::getConnection(GAtomORM\ImportFileTable::getConnectionName())
        ->isTableExists(ORM\Entity::getInstance(GAtomORM\ImportFileTable::class)->getDBTableName())
) {
    Application::getConnection(GAtomORM\ImportFileTable::getConnectionName())
        ->queryExecute('drop table if exists ' . ORM\Entity::getInstance(GAtomORM\ImportFileTable::class)
                ->getDBTableName());
}

if (
    !Application::getConnection(GAtomORM\ImportFileTable::getConnectionName())
        ->isTableExists(
            ORM\Entity::getInstance(GAtomORM\ImportFileTable::class)->getDBTableName()
        )
) {
    ORM\Entity::getInstance(GAtomORM\ImportFileTable::class)->createDbTable();
}