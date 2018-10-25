<?
/**
 * Класс сущности 
 */
class ArchiveFileTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'my_archive_files';
    }
    public static function getMap()
    {
        return [
            new Entity\IntegerField('ID', ['primary' => true, 'autocomplete' => true]),
            new Entity\StringField('NAME'),
            new Entity\stringField('PATH')
        ];
    }
}
?>