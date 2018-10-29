<?
use \Bitrix\Main;
use Bitrix\Main\Entity;
use Bitrix\Main\Entity\Base;
include('classes/archiveItem.php');
include('classes/archiveFiles.php');
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
    // ?

    private function createUserField(){

        // Массив параметров для поля
        $arFields = [
            [
                'FIELD_NAME'    => 'UF_ARCHIVE_FILES',
                'USER_TYPE_ID'  => 'string',
                'XML_ID'        => 'AD_REGION_CODE',
                'MULTIPLE'      => 'Y',
                'MANDATORY'     => 'N',
                'SHOW_FILTER'   => 'I',
                'SHOW_IN_LIST'  => '',
                'EDIT_IN_LIST'  => 'Y',
                'IS_SEARCHABLE' => 'Y',
                'SETTINGS'      => [],
                'LABELS'        => [
                    'ru' => 'Архивные файлы',
                    'en' => 'Archive Files'
                ],
            ],
        ];

        $arLabels = [
            'EDIT_FORM_LABEL',
            'LIST_COLUMN_LABEL',
            'LIST_FILTER_LABEL',
            'ERROR_MESSAGE',
            'HELP_MESSAGE'
        ];

        $model = new \CUserTypeEntity();

        foreach ($arFields as $arField){
            $arField['ENTITY_ID'] = 'USER';

            $arFields = \Bitrix\Main\UserFieldTable::getRow([
                'select' => ['ID'],
                'filter' => [
                    '=ENTITY_ID' => $arField['ENTITY_ID'],
                    '=FIELD_NAME' => $arField['FIELD_NAME'],
                ],
            ]);

            foreach ($arLabels as $labelField)
            {
                $arField[$labelField] = $arField['LABELS'];
            }
        }

        $fieldId = $model->Add($arField);

        if(!$fieldId){
            echo 'FIELD exist';
        }

        

        echo "<pre>", var_dump($fieldId), "</pre>";



    }

    /**
     * Функция выполняет запрос на получение элементов таблицы БД.
     *
     * @param [type] Сущность для которой выполняется запрос.
     * @return void
     */
    private function getArchiveFiles($entity)
    {
        $queryBuilder = new Entity\Query($entity);
            $res = $queryBuilder
                    ->setSelect(['ITEM_ID', 'NAME'])
                    ->exec()
                    ->fetchAll();

            //echo "<pre>", var_dump($res), "</pre>";

            $arr = [];
            foreach($res as $item){
                $arr[$item['ITEM_ID']][] = $item['NAME'];
            }

            //echo "<pre>", var_dump($arr), "</pre>";

            $imp = [];
            foreach ($arr as $k => $v){
                $imp[$k] = implode($v, ", ");
            }

        return $imp;
    }
    /**
     *  Функция инициализации компонента
     */
    public function executeComponent()
    {

        $dbConnection =  \Bitrix\Main\Application::getConnection();
        $archiveItemEntity = ArchiveItemTable::getEntity();
        $archiveFilesEntity = ArchiveFileTable::getEntity();

        try{
            // Создаем таблицы в базе, если их нет.
            if (!$dbConnection -> isTableExists($archiveItemEntity -> getDBTableName()))
            {
                $archiveItemEntity -> createDBTable();
            }

            if (!$dbConnection -> isTableExists($archiveFilesEntity -> getDBTableName()))
            {
                $archiveFilesEntity -> createDBTable();
            }



            //echo "<pre>", var_dump($imp), "</pre>";
            //$this->arResult = $this->getArchiveFiles($archiveFilesEntity);

            $this->createUserField();


            $this->includeComponentTemplate();
        }
        catch(SystemException $e){
            ShowError($e->getMessage());
        }

    }
}
?>
