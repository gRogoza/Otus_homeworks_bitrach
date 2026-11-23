<?php

namespace Models\Tables;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields;
use Bitrix\Main\ORM\Query\Join;

class HwTable extends DataManager
{
    public static function getTableName()
    {
        return 'hw_table_orm';
    }
    public static function getMap()
    {
        return 
        [
            new IntegerField('ID', ['primary'=> true, 'autocomplete' => true]),
            new IntegerField('LIST_ONE_ID'),
            new IntegerField('LIST_TWO_ID'),
            new StringField('NAME'),
            new StringField('EMAIL'),
            new ReferenceField('LIST_ONE', HwListOne::class, Join::on('this.LIST_ONE_ID', 'ref.IBLOCK_ELEMENT_ID'))
            new ReferenceField('LIST_TWO', HwListTwo::class, Join::on('this.LIST_TWO_ID', 'ref.IBLOCK_ELEMENT_ID'))
        ];
    }
}