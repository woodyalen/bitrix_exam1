<?
use Bitrix\Main\Entity\Base;
include('classes/archiveItem.php');
include('initial.php');

class idleo_ormtest extends CBitrixComponent
{
    /**
     * Создает таблицу в базе данных, если она еще не существует.
     *
     * @param [type] $connectionObject
     * @param [type] $dbTableName
     * @return void
     */
    function installDB($connectionObject, $dbTableName)
    {
        if (!Application::getConnection($connectionObject) -> isTableExists($dbTableName))
        {
            Base::getInstance('ArchiveItem') ->createDBTable();
            return true;
        }
        return false;
    }
    /**
     *  Функция инициализации компонента
     */
    public function executeComponent()
    {
        try{
            //Пример получения необходимых параметров
            $connectionObject = ArchiveItemTable::getConnectionName();
            $dbTableName = Base::getInstance('ArchiveItemTable') -> geDBTableName();
            
            if(installDB($connectionObject, $dbTableName))
                $this->includeComponentTemplate();
        }
        catch(SystemException $e){
            ShowError($e->getMessage());
        }
    }
}
?>
