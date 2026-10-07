<?php

namespace GAtom\UniversalExchangeIBlockViaExcel\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Fields;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\Type\DateTime;

Loc::loadMessages(__FILE__);

class  ImportFileTable extends DataManager
{
    public static function getTableName()
    {
        return 'gatom_import_file';
    }

    public static function getUfId()
    {
        return 'GATOM_IMPORT_FILE';
    }

    public static function getTitle()
    {
        return Loc::getMessage('GATOM_IMPORT_FILE_TITLE');
    }

    public static function getConnectionName()
    {
        return 'default';
    }

    public static function getMap()
    {
        return [
            new Fields\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('IMPORT_FILE_TABLE_ID'),
            ]),
            new Fields\IntegerField('CREATED_BY', [
                'required' => true,
                'default_value' => function() {
                    global $USER;
                    return $USER->GetID();
                },
                'title' => Loc::getMessage('IMPORT_FILE_TABLE_CREATED_BY'),
            ]),
            new Fields\DatetimeField('CREATED_DATE', [
                'required' => true,
                'default_value' => function() {
                    return new DateTime();
                },
                'title' => Loc::getMessage('IMPORT_FILE_TABLE_CREATED_DATE'),
            ]),
            new Fields\IntegerField('TOTAL_STEPS', [
                'required' => true,
            ]),
            new Fields\IntegerField('CURRENT_STEP', [
                'required' => true,
            ]),
            new Fields\StringField('MAX_COL', [
                'required' => true,
            ]),
            new Fields\IntegerField('MAX_ROW', [
                'required' => true,
            ]),
            new Fields\StringField('FILE_PATH', [
                'required' => true,
            ]),
            new Fields\StringField('IMPORT_TYPE', [
                'required' => false,
            ]),
            new Fields\IntegerField('FORM_ID', [
                'required' => true,
            ]),
            new Fields\IntegerField('YEAR', [
                'required' => true,
                'title' => Loc::getMessage('IMPORT_FILE_TABLE_YEAR'),
            ]),
            new Fields\IntegerField('ORGANISATION', [
                'required' => true,
                'title' => Loc::getMessage('IMPORT_FILE_TABLE_ORGANISATION'),
            ]),
            new Fields\TextField('DATA', [
                'save_data_modification' => function () {
                    return [
                        function (array|null $value = []):string {
                            return serialize($value);
                        }
                    ];
                },
                'fetch_data_modification' => function () {
                    return [
                        function (string $value):array {
                            $result = unserialize($value);
                            if (is_array($result)) {
                                return unserialize($value);
                            } else {
                                return [];
                            }
                        }
                    ];
                }
            ]),
            new Fields\IntegerField('SORT', [
            ]),
            new Fields\BooleanField('IMPORT_IS_FINISHED', [
                'required' => true,
                'default_value' => function() {
                    return false;
                },
            ]),
            new Fields\BooleanField('IS_LOCKED', [
                'required' => true,
                'default_value' => function() {
                    return false;
                },
            ]),
            new Fields\DatetimeField('LAST_IMPORT_EXEC_DATE', [
                'nullable' => true,
            ]),
        ];
    }
}