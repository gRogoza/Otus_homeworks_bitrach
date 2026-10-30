<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('HW: список позиций');

use Bitrix\Main\Loader;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Iblock\ElementTable;
use Bitrix\Iblock\ElementPropertyTable;
use Local\Hw\ItemTable;

Loader::includeModule('iblock');
$getIblockId = function (string $code): int {
    $row = IblockTable::getRow([
        'select' => ['ID'],
        'filter' => ['=CODE' => $code],
        'cache'  => ['ttl' => 3600],
    ]);
    return (int)($row['ID'] ?? 0);
};

$getPropId = function (int $iblockId, string $code): int {
    $row = PropertyTable::getRow([
        'select' => ['ID'],
        'filter' => ['=IBLOCK_ID' => $iblockId, '=CODE' => $code],
        'cache'  => ['ttl' => 3600],
    ]);
    return (int)($row['ID'] ?? 0);
};

$brandsIb  = $getIblockId('hw_brands');      
$catsIb    = $getIblockId('hw_categories'); 
$countryId = $getPropId($brandsIb, 'COUNTRY');
$colorId   = $getPropId($catsIb, 'COLOR');

$query = ItemTable::query()
    ->setSelect([
        'ID',
        'NAME',          
        'QTY',           
        'BRAND_NAME'     => 'BRAND_EL.NAME',
        'BRAND_COUNTRY'  => 'BRAND_PROP.VALUE',
        'CATEGORY_NAME'  => 'CAT_EL.NAME',
        'CATEGORY_COLOR' => 'CAT_PROP.VALUE',
    ])
    ->setOrder(['ID' => 'ASC'])
    ->setLimit(50);

$query->registerRuntimeField('BRAND_EL', new Reference(
    'BRAND_EL',
    ElementTable::class,
    Join::on('this.BRAND_ID', 'ref.ID')->where('ref.IBLOCK_ID', $brandsIb),
    ['join_type' => 'LEFT']
));

$query->registerRuntimeField('BRAND_PROP', new Reference(
    'BRAND_PROP',
    ElementPropertyTable::class,
    Join::on('this.BRAND_ID', 'ref.IBLOCK_ELEMENT_ID')->where('ref.IBLOCK_PROPERTY_ID', $countryId),
    ['join_type' => 'LEFT']
));
$query->registerRuntimeField('CAT_EL', new Reference(
    'CAT_EL',
    ElementTable::class,
    Join::on('this.CATEGORY_ID', 'ref.ID')->where('ref.IBLOCK_ID', $catsIb),
    ['join_type' => 'LEFT']
));
$query->registerRuntimeField('CAT_PROP', new Reference(
    'CAT_PROP',
    ElementPropertyTable::class,
    Join::on('this.CATEGORY_ID', 'ref.IBLOCK_ELEMENT_ID')->where('ref.IBLOCK_PROPERTY_ID', $colorId),
    ['join_type' => 'LEFT']
));

$query->setCacheTtl(3600);
$query->cacheJoins(true);
$rows = $query->fetchAll();
?>
<ul>
<?php foreach ($rows as $r): ?>
    <li>
        #<?= (int)$r['ID'] ?> <b><?= htmlspecialcharsbx($r['NAME']) ?></b>,
        кол-во: <?= (int)$r['QTY'] ?><br>
        Бренд: <?= htmlspecialcharsbx($r['BRAND_NAME']) ?>
        (страна: <?= htmlspecialcharsbx($r['BRAND_COUNTRY']) ?>)<br>
        Категория: <?= htmlspecialcharsbx($r['CATEGORY_NAME']) ?>
        (цвет: <?= htmlspecialcharsbx($r['CATEGORY_COLOR']) ?>)
    </li>
<?php endforeach; ?>
<?php if (!$rows): ?>
    <li>Данных нет</li>
<?php endif; ?>
</ul>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');





