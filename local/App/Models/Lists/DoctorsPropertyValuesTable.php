<?php

namespace Models\Lists;

use CIBlockElement;
use Models\AbstractIblockPropertyValuesTable;
use Bitrix\Main\Entity\ReferenceField;
class DoctorsPropertyValuesTable extends AbstractIblockPropertyValuesTable
{
    const IBLOCK_ID = 16;

    public static function getProcedureIds(int $doctorId): array
    {
        $row = static::getList([
            'select' => ['PROCEDURES'],
            'filter' => ['IBLOCK_ELEMENT_ID' => $doctorId],
        ])->fetch();

        return array_map('intval',$row['PROCEDURES'] ?? []);
    }
    public static function linkProcedure(int $doctorId, string $procedureId): void
    {
        if ($doctorId <= 0 || $procedureId <= 0) {
            return;
        }
        $ids = static::getProcedureIds($doctorId);
        if (in_array($procedureId, $ids, true)) {
            return;
        }

        $ids[] = $procedureId;
        CIBlockElement::SetPropertyValuesEx($doctorId, static::IBLOCK_ID,['PROCEDURES'=>$ids]);
    }
    public static function getMap(): array
    {
        return
        [
                'PROCEDURE' => new ReferenceField(
                'PROCEDURE',
                ProceduresPropertyValuesTable::class,
                ['=this.PROCEDURES|SINGLE.VALUE' => 'ref.IBLOCK_ELEMENT_ID']
            ),
        ] + parent::getMap();
    }
}