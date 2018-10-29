<?
use Bitrix\Main\Entity;
use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main;
/**
 * Класс сущности единицы архива.
 */
class ArchiveItemTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'my_archive_items';
    }
    public static function getMap()
    {
        return [
            // ID
            new Entity\IntegerField('ID', ['primary' => true, 'autocomplete' => true]),
            // Название
            new Entity\StringField('NAME'),
            // Пользователь 
            new Entity\StringField('USER'),
        ];
    }
}
?>
