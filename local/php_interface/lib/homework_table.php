<?php
namespace local\Hw;


use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;



class ItemTable extends DataManager
{
    public static function getTableName()
    {
        return 'b_local_hw_item';
    }



    public static function getMap()
    {
        return [
            (new IntegerField('ID'))
                ->configurePrimary()
                ->configureAutocomplete(),

            (new StringField('NAME'))
                ->configureRequired()
                ->configureSize(255),

            (new IntegerField('QTY'))
                ->configureDefaultValue(0),

            (new IntegerField('BRAND_ID')),

            (new IntegerField('CATEGORY_ID')),
        ];
    }
}