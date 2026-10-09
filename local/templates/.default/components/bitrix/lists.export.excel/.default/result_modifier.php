<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arResult['EXCEL_COLUMN_NAME'][] = 'Статус обработки';

if (!empty($arResult['EXCEL_CELL_VALUE']) && is_array($arResult['EXCEL_CELL_VALUE'])) {
    $currentDate = date('d.m.Y');

    foreach ($arResult['EXCEL_CELL_VALUE'] as &$row) {
        $row[0] = mb_strtoupper($row[0]);
        $row[] = 'ГОЛ (' . $currentDate . ')';
    }
    unset($row);
}


