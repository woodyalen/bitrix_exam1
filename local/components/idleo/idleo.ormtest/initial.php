<?

    //Пример получения необходимых параметров
    $connectionObject = ArchiveItemTable::getConnectionName();
    $dbTableName = Base::getInstance('ArchiveItemTable') -> geDBTableName();
    function installDB($connectionObject, $dbTableName)
    {
        if (!Application::getConnection($connectionObject) -> isTableExists($dbTableName))
        {
            Base::getInstance('ArchiveItem') ->createDBTable();
        }
    }
?>