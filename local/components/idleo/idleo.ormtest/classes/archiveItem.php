<?
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
            // Файл При типе данных enum нужжно задавать список в параметрах.
            (new Entity\StringField('FILE_ID')),
            // Пользователь FIXME: Неуверен в типе поля.
            new Entity\StringField('USER'),
            // Создаем зависимость.
            (new Reference(
                'FILE',
                ArchiveFileTable::class,
                Join::on('this.FILE_ID', 'ID')
            ))
            ->configureJoinType('inner')
        ];
    }
}
?>
