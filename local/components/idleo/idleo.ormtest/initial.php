<?

    //Пример получения необходимых параметров
    $connectionObject = ArchiveItemTable::getConnectionName();
    $dbTableName = Base::getInstance('ArchiveItemTable') -> geDBTableName();
    // Создает таблицу в базе данных, если она еще не существует.
    function installDB($connectionObject, $dbTableName)
    {
        if (!Application::getConnection($connectionObject) -> isTableExists($dbTableName))
        {
            Base::getInstance('ArchiveItem') ->createDBTable();
        }
    }
?>