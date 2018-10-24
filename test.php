<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("тест");
?>

<?
    // TODO: В рамках учебной задачи необходимо реализовать простую сущность из нескольких полей (ID, Название, Файл (множественное), Пользователь). Вывести ее для редактирования и списка (все поля нужно добавить в фильтрацию)

    use Bitrix\Main\Entity;
    use Bitrix\Main\ORM\Fields\Relations\Reference;
    use Bitrix\Main\ORM\Query\Join;

use Bitrix\Main,
	Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

/**
 * Class FileTable
 * 
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> TIMESTAMP_X datetime optional
 * <li> MODULE_ID string(50) optional
 * <li> HEIGHT int optional
 * <li> WIDTH int optional
 * <li> FILE_SIZE int optional
 * <li> CONTENT_TYPE string(255) optional default 'IMAGE'
 * <li> SUBDIR string(255) optional
 * <li> FILE_NAME string(255) mandatory
 * <li> ORIGINAL_NAME string(255) optional
 * <li> DESCRIPTION string(255) optional
 * <li> HANDLER_ID string(50) optional
 * <li> EXTERNAL_ID string(50) optional
 * </ul>
 *
 * @package Bitrix\File
 **/

class FileTable extends Main\Entity\DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'b_file';
	}

	/**
	 * Returns entity map definition.
	 *
	 * @return array
	 */
	public static function getMap()
	{
		return array(
			'ID' => array(
				'data_type' => 'integer',
				'primary' => true,
				'autocomplete' => true,
				'title' => Loc::getMessage('FILE_ENTITY_ID_FIELD'),
			),
			'TIMESTAMP_X' => array(
				'data_type' => 'datetime',
				'title' => Loc::getMessage('FILE_ENTITY_TIMESTAMP_X_FIELD'),
			),
			'MODULE_ID' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateModuleId'),
				'title' => Loc::getMessage('FILE_ENTITY_MODULE_ID_FIELD'),
			),
			'HEIGHT' => array(
				'data_type' => 'integer',
				'title' => Loc::getMessage('FILE_ENTITY_HEIGHT_FIELD'),
			),
			'WIDTH' => array(
				'data_type' => 'integer',
				'title' => Loc::getMessage('FILE_ENTITY_WIDTH_FIELD'),
			),
			'FILE_SIZE' => array(
				'data_type' => 'integer',
				'title' => Loc::getMessage('FILE_ENTITY_FILE_SIZE_FIELD'),
			),
			'CONTENT_TYPE' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateContentType'),
				'title' => Loc::getMessage('FILE_ENTITY_CONTENT_TYPE_FIELD'),
			),
			'SUBDIR' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateSubdir'),
				'title' => Loc::getMessage('FILE_ENTITY_SUBDIR_FIELD'),
			),
			'FILE_NAME' => array(
				'data_type' => 'string',
				'required' => true,
				'validation' => array(__CLASS__, 'validateFileName'),
				'title' => Loc::getMessage('FILE_ENTITY_FILE_NAME_FIELD'),
			),
			'ORIGINAL_NAME' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateOriginalName'),
				'title' => Loc::getMessage('FILE_ENTITY_ORIGINAL_NAME_FIELD'),
			),
			'DESCRIPTION' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateDescription'),
				'title' => Loc::getMessage('FILE_ENTITY_DESCRIPTION_FIELD'),
			),
			'HANDLER_ID' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateHandlerId'),
				'title' => Loc::getMessage('FILE_ENTITY_HANDLER_ID_FIELD'),
			),
			'EXTERNAL_ID' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateExternalId'),
				'title' => Loc::getMessage('FILE_ENTITY_EXTERNAL_ID_FIELD'),
			),
		);
	}
	/**
	 * Returns validators for MODULE_ID field.
	 *
	 * @return array
	 */
	public static function validateModuleId()
	{
		return array(
			new Main\Entity\Validator\Length(null, 50),
		);
	}
	/**
	 * Returns validators for CONTENT_TYPE field.
	 *
	 * @return array
	 */
	public static function validateContentType()
	{
		return array(
			new Main\Entity\Validator\Length(null, 255),
		);
	}
	/**
	 * Returns validators for SUBDIR field.
	 *
	 * @return array
	 */
	public static function validateSubdir()
	{
		return array(
			new Main\Entity\Validator\Length(null, 255),
		);
	}
	/**
	 * Returns validators for FILE_NAME field.
	 *
	 * @return array
	 */
	public static function validateFileName()
	{
		return array(
			new Main\Entity\Validator\Length(null, 255),
		);
	}
	/**
	 * Returns validators for ORIGINAL_NAME field.
	 *
	 * @return array
	 */
	public static function validateOriginalName()
	{
		return array(
			new Main\Entity\Validator\Length(null, 255),
		);
	}
	/**
	 * Returns validators for DESCRIPTION field.
	 *
	 * @return array
	 */
    public static function validateDescription()
	{
		return array(
			new Main\Entity\Validator\Length(null, 255),
		);
	}
	/**
	 * Returns validators for HANDLER_ID field.
	 *
	 * @return array
	 */
	public static function validateHandlerId()
	{
		return array(
			new Main\Entity\Validator\Length(null, 50),
		);
	}
	/**
	 * Returns validators for EXTERNAL_ID field.
	 *
	 * @return array
	 */
	public static function validateExternalId()
	{
		return array(
			new Main\Entity\Validator\Length(null, 50),
		);
	}
}
    // Описываем необходимую сущность
/**
 * Класс для описания сущности
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
                FileTable::class,
                Join::on('this.FILE_ID', 'ID')
            ))
            ->configureJoinType('inner')
        ];
    }
}


// Создаем таблицу в БД
//ArchiveItemTable::getEntity()->createDBTable();

// Добавляем в таблицу объекты сущности.
//$item = ArchiveItemTable::add(['NAME' => "User Test", 'FILE_ID' => '14', 'USER' => 'TEST']);
//var_dump($item);
// $result = ArchiveItemTable::getByPrimary(1) -> fetchObject();

$params = ['limit' => 3];

$result = ArchiveItemTable::getList() -> fetchCollection();


// $resultList = [];
// while($result = ArchiveItemTable::getList() -> fetchObject())
//     $resultList[] = $result;



//echo "<pre>", print_r($result), "</pre>";

use \Bitrix\Iblock\PropertyEnumerationTable;
use Bitrix\Main\Grid\Options as GridOptions;
use Bitrix\Main\UI\PageNavigation;

$list_id = 'example_list';

$grid_options = new GridOptions($list_id);
$sort = $grid_options->GetSorting(['sort' => ['ID' => 'DESC'], 'vars' => ['by' => 'by', 'order' => 'order']]);
$nav_params = $grid_options->GetNavParams();


$nav = new PageNavigation('request_list');
$nav->allowAllRecords(true)
	->setPageSize($nav_params['nPageSize'])
	->initFromUri();

$filterOption = new Bitrix\Main\UI\Filter\Options($list_id);
$filterData = $filterOption->getFilter([]);
$filter = [];

foreach ($filterData as $k => $v) {
	// Тут разбор массива $filterData из формата, в котором его формирует main.ui.filter в формат, который подойдет для вашей выборки.
	// Обратите внимание на поле "FIND", скорее всего его вы и захотите засунуть в фильтр по NAME и еще паре полей
	$filter['NAME'] = "%".$filterData['FIND']."%";
}

$res = ArchiveItemTable::getList([
	'filter' => $filter,
	'select' => [
		"*",
	],
	'offset'      => $nav->getOffset(),
	'limit'       => $nav->getLimit(),
	'order'       => $sort['sort']
]);

$ui_filter = [
	['id' => 'ID', 'name' => 'ID', 'type'=>'integer', 'default' => true],
	['id' => 'NAME', 'name' => 'Название', 'type'=>'text', 'default' => true],
	['id' => 'FILE_ID', 'name' => 'Идентификатор файла', 'type'=>'string', 'default' => true],
	['id' => 'USER', 'name' => 'Пользователь', 'type'=>'string', 'default' => true],
];
?>
    <h2>Фильтр</h2>
    <div>
		<?$APPLICATION->IncludeComponent('bitrix:main.ui.filter', '', [
			'FILTER_ID' => $list_id,
			'GRID_ID' => $list_id,
			'FILTER' => $ui_filter,
			'ENABLE_LIVE_SEARCH' => true,
			'ENABLE_LABEL' => true
		]);?>
    </div>
    <div style="clear: both;"></div>

    <hr>

    <h2>Таблица</h2>
<?php
$columns = [];
$columns[] = ['id' => 'ID', 'name' => 'ID', 'sort' => 'ID', 'default' => true];
$columns[] = ['id' => 'NAME', 'name' => 'Название', 'sort' => 'NAME', 'default' => true];
$columns[] = ['id' => 'FILE_ID', 'name' => 'Идентификатор файла', 'type'=>'string', 'default' => true];
$columns[] = ['id' => 'USER', 'name' => 'Пользователь', 'type'=>'string', 'default' => true];

foreach ($res->fetchAll() as $row) {
	$list[] = [
		'data' => [
			"ID" => $row['ID'],
			"NAME" => $row['NAME'],
			"FILE_ID" => $row['FILE_ID'],
			"USER" => $row['USER'],
		],
		'actions' => [
			[
				'text'    => 'Просмотр',
				'default' => true,
				'onclick' => 'document.location.href="?op=view&id='.$row['ID'].'"'
            ], [
                'text' => 'Редактировать',
                'default' => 'true',
                'onclick' => ''
            ], [
				'text'    => 'Удалить',
				'default' => true,
				'onclick' => 'if(confirm("Вы уверены?")){document.location.href="?op=delete&id='.$row['ID'].'"}'
			]
		]
	];
}

$APPLICATION->IncludeComponent('bitrix:main.ui.grid', '', [
	'GRID_ID' => $list_id,
	'COLUMNS' => $columns,
	'ROWS' => $list,
	'SHOW_ROW_CHECKBOXES' => false,
	'NAV_OBJECT' => $nav,
	'AJAX_MODE' => 'Y',
	'AJAX_ID' => \CAjax::getComponentID('bitrix:main.ui.grid', '.default', ''),
	'PAGE_SIZES' =>  [
		['NAME' => '20', 'VALUE' => '20'],
		['NAME' => '50', 'VALUE' => '50'],
		['NAME' => '100', 'VALUE' => '100']
	],
	'AJAX_OPTION_JUMP'          => 'N',
	'SHOW_CHECK_ALL_CHECKBOXES' => false,
	'SHOW_ROW_ACTIONS_MENU'     => true,
	'SHOW_GRID_SETTINGS_MENU'   => true,
	'SHOW_NAVIGATION_PANEL'     => true,
	'SHOW_PAGINATION'           => true,
	'SHOW_SELECTED_COUNTER'     => true,
	'SHOW_TOTAL_COUNTER'        => true,
	'SHOW_PAGESIZE'             => true,
	'SHOW_ACTION_PANEL'         => true,
	'ALLOW_COLUMNS_SORT'        => true,
	'ALLOW_COLUMNS_RESIZE'      => true,
	'ALLOW_HORIZONTAL_SCROLL'   => true,
	'ALLOW_SORT'                => true,
	'ALLOW_PIN_HEADER'          => true,
	'AJAX_OPTION_HISTORY'       => 'N'
]);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
