<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


use \Bitrix\Iblock\PropertyEnumerationTable;
use Bitrix\Main\Grid\Options as GridOptions;
use Bitrix\Main\UI\PageNavigation;

$list_id = 'example_list';

$grid_options = new GridOptions($list_id);
$sort = $grid_options->GetSorting(['sort' => ['ID' => 'DESC'], 'vars' => ['by' => 'by', 'order' => 'order']]);
$nav_params = $grid_options->GetNavParams();


$nav = new PageNavigation('example_list');
$nav->allowAllRecords(true)
	->setPageSize($nav_params['nPageSize'])
	->initFromUri();

$filterOption = new Bitrix\Main\UI\Filter\Options($list_id);
$filterData = $filterOption->getFilter([]);
$filter = [];
var_dump($filterData);
$ui_filter = [
	['id' => 'ID', 'name' => 'ID', 'type'=>'integer', 'default' => true],
	['id' => 'NAME', 'name' => 'Название', 'type'=>'text', 'default' => true],
	['id' => 'FILE_ID', 'name' => 'Идентификатор файла', 'type'=>'string', 'default' => true],
	['id' => 'USER', 'name' => 'Пользователь', 'type'=>'string', 'default' => true],
];
foreach ($filterData as $k => $v) {
    // Тут разбор массива $filterData из формата, в котором его формирует main.ui.filter в формат, который подойдет для вашей выборки.
	// Обратите внимание на поле "FIND", скорее всего его вы и захотите засунуть в фильтр по NAME и еще паре полей
    //$filter['NAME'] = "%".$filterData['FIND']."%";
    foreach($ui_filter as $ui_item){
        if($ui_item['id'] == $k)
            $filter[$k] = "%" . $v . "%";
    }
}
if($filter['NAME'] == '') $filter['NAME'] = "%" . $filterData['FIND'] . "%";

var_dump($filter);

$res = ArchiveItemTable::getList([
	'filter' => $filter,
	'select' => [
		"*",
	],
	'offset'      => $nav->getOffset(),
	'limit'       => $nav->getLimit(),
	'order'       => $sort['sort']
]);





?>
    <h2>Фильтр</h2>
    <div>
	<!-- Вызов компонента FILTER -->
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
$columns[] = ['id' => 'FILE_ID', 'name' => 'Идентификатор файла', 'type' => 'string', 'default' => true];
$columns[] = ['id' => 'USER', 'name' => 'Пользователь', 'type' => 'string', 'default' => true];

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
                'text' => 'Просмотр',
                'default' => true,
                'onclick' => 'document.location.href="?op=view&id=' . $row['ID'] . '"',
            ], [
                'text' => 'Редактировать',
                'default' => 'true',
                'onclick' => 'BX.adminPanel.Redirect([], \"/bitrix/admin/perfmon_row_edit.php?table_name=my_archive_items&pk%5BID%5D=' . $row["ID"] . '")',
//                 return [{'DEFAULT':true,'GLOBAL_ICON':'adm-menu-edit','DEFAULT':true,'TEXT':'Изменить','ONCLICK':'BX.adminPanel.Redirect([], \'perfmon_row_edit.php?lang=ru&table_name=my_archive_items&pk%5BID%5D=3\', event);'},
                // {'GLOBAL_ICON':'adm-menu-delete','TEXT':'Удалить','ONCLICK':'tbl_perfmon_table8d66d1619cdc87b2d4e16783daf23959.GetAdminList(\'/bitrix/admin/perfmon_table.php?ID=3&action_button=delete&lang=ru&sessid=0e86bba9cd9d0083a562926b5b207773&table_name=my_archive_items&pk%5BID%5D=3\');'}];
            ], [
                'text' => 'Удалить',
                'default' => true,
                'onclick' => 'if(confirm("Вы уверены?")){document.location.href="?op=delete&id=' . $row['ID'] . '"}',
            ],
        ],
    ];
}

$APPLICATION->IncludeComponent(
    "bitrix:main.ui.grid",
    ".default",
    array(
        "GRID_ID" => $list_id,
        "COLUMNS" => $columns,
        "ROWS" => $list,
        "SHOW_ROW_CHECKBOXES" => true,
        "NAV_OBJECT" => $nav,
        "AJAX_MODE" => "Y",
        "AJAX_ID" => \CAjax::getComponentID("bitrix:main.ui.grid", ".default", ""),
        "PAGE_SIZES" => array(
            ["NAME" => "100", "VALUE" => "100"],
        ),
        "AJAX_OPTION_JUMP" => "N",
        "SHOW_CHECK_ALL_CHECKBOXES" => false,
        "SHOW_ROW_ACTIONS_MENU" => true,
        "SHOW_GRID_SETTINGS_MENU" => true,
        "SHOW_NAVIGATION_PANEL" => true,
        "SHOW_PAGINATION" => true,
        "SHOW_SELECTED_COUNTER" => true,
        "SHOW_TOTAL_COUNTER" => true,
        "SHOW_PAGESIZE" => true,
        "SHOW_ACTION_PANEL" => true,
        'SHOW_ACTION_PANEL' => true,
        'ACTION_PANEL' => [
            'GROUPS' => [
                'TYPE' => [
                    'ITEMS' => [
                        [
                            'ID' => 'set-type',
                            'TYPE' => 'DROPDOWN',
                            'ITEMS' => [
                                ['VALUE' => '', 'NAME' => '- Выбрать -'],
                                ['VALUE' => 'plus', 'NAME' => 'Поступление'],
                                ['VALUE' => 'minus', 'NAME' => 'Списание'],
                            ],
                        ],
                        [
                            'ID' => 'edit',
                            'TYPE' => 'BUTTON',
                            'TEXT' => 'Редактировать',
                            'CLASS' => 'icon edit',
                            'ONCHANGE' => '',
                        ],
                        [
                            'ID' => 'delete',
                            'TYPE' => 'BUTTON',
                            'TEXT' => 'Удалить',
                            'CLASS' => 'icon remove',
                            'ONCHANGE' => '',
                        ],
                    ],
                ],
            ],
        ],
        "ALLOW_COLUMNS_SORT" => true,
        "ALLOW_COLUMNS_RESIZE" => true,
        "ALLOW_HORIZONTAL_SCROLL" => true,
        "ALLOW_SORT" => true,
        "ALLOW_PIN_HEADER" => true,
        "AJAX_OPTION_HISTORY" => "N",
        "COMPONENT_TEMPLATE" => ".default",
    ),
    false
);


echo "<pre>", var_dump($arResult), "</pre>";
?>