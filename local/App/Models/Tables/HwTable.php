<?php

namespace Models\Tables;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Models\Lists\HwListOneTable;
use Models\Lists\HwListTwoTable;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\ORM\Fields\Relations\Reference;

class HwTable extends DataManager
{
    /**
     * getTableName
     *
     * @return void
     */
    public static function getTableName()
    {
        return 'hw_table_orm';
    }
    /**
     * getMap
     *
     * @return void
     */
    public static function getMap()
    {
        return 
        [
            new IntegerField('ID', ['primary'=> true, 'autocomplete' => true]),
            new IntegerField('LIST_ONE_ID'),
            new IntegerField('LIST_TWO_ID'),
            new StringField('NAME'),
            new StringField('EMAIL'),
            (new Reference('LIST_ONE', HwListOneTable::class, Join::on('this.LIST_ONE_ID', 'ref.IBLOCK_ELEMENT_ID'))), 
            (new Reference('LIST_TWO', HwListTwoTable::class, Join::on('this.LIST_TWO_ID', 'ref.IBLOCK_ELEMENT_ID'))),
        ];
    }
}