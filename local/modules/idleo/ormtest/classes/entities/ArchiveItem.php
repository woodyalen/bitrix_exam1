<?
namespace Idleo\OrmTest\Entities;
use Bitrix\Main\Entity;
class ArchiveItemTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'idleo_ormtest_archiveitems';
    }
    public static function getMap
    {
        return [
            new Entity\IntegerField('ID', ['primary' => true, 'autocomplete' => true]),
            new Entity\StringField('NAME'),
            new Entity\StringField('FILES')
        ];
    }
} 
?>