<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
\Bitrix\Main\Loader::includeModule('iblock');
require_once $_SERVER['DOCUMENT_ROOT'] . '/local/App/autoload.php';

use Models\Tables\HwTable;

$result = HwTable::getList([
    'select' => 
    [
        'ID',
        'NAME',
        'EMAIL',
        'LIST_ONE_NAME' => 'LIST_ONE.UTF_NAME',
        'LIST_ONE_CODE' => 'LIST_ONE.UTF_ID',
        'LIST_TWO_NAME' => 'LIST_TWO.UTF_NAME',
        'LIST_TWO_CODE' => 'LIST_TWO.UTF_ID',
    ],
    'cache' => 
    [
        'ttl' => 3600,
        'cache_joins' => true,
    ],
]);
    echo '<ul>';
while ($row = $result->fetch()) 
{
    echo '<li>' . htmlspecialcharsbx($row['NAME']) . ' ' . htmlspecialcharsbx($row['EMAIL'])
    . ' ' . htmlspecialcharsbx($row['LIST_ONE_NAME']) . ' ' . $row['LIST_ONE_CODE']
    . ' ' . htmlspecialcharsbx($row['LIST_TWO_NAME']) . ' ' . $row['LIST_TWO_CODE'] . '</li>';
}
    echo '</ul>';