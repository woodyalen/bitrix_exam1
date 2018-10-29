<?
use \Bitrix\Main;
use Bitrix\Main\Entity;
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
    private function initializeTables($connection, $entity)
    {
        if (!$connection -> isTableExists($entity -> getDBTableName()))
        {
            $entity -> createDBTable();
            return true;
        }
        return false;
    }

    function getArchiveFiles()
    {

    }
    /**
     *  Функция инициализации компонента
     */
    public function executeComponent()
    {
        
        $dbConnection =  \Bitrix\Main\Application::getConnection();
        $archiveItemEntity = ArchiveItemTable::getEntity();

        try{

            if (initializeTables($dbConnection, $archiveItemEntity))
                $this->includeComponentTemplate();
        }
        catch(SystemException $e){
            ShowError($e->getMessage());
        }
    }
}
?>
