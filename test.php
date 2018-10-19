<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("тест");
?><?$APPLICATION->IncludeComponent("bitrix:photogallery.detail", "test", Array(
	"BEHAVIOUR" => "SIMPLE",	// Режим работы галереи
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"DATE_TIME_FORMAT" => "d.m.Y",	// Формат вывода даты
		"DETAIL_EDIT_URL" => "detail_edit.php?SECTION_ID=#SECTION_ID#&ELEMENT_ID=#ELEMENT_ID#",	// Фото (редактирование)
		"DETAIL_SLIDE_SHOW_URL" => "slide_show.php?SECTION_ID=#SECTION_ID#&ELEMENT_ID=#ELEMENT_ID#",	// Страница слайд-шоу
		"DETAIL_URL" => "detail.php?SECTION_ID=#SECTION_ID#&ELEMENT_ID=#ELEMENT_ID#",	// Фото
		"ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],	// ID элемента
		"ELEMENT_SORT_FIELD" => "SORT",	// Первое поле сортировки фото
		"ELEMENT_SORT_FIELD1" => "",	// Второе поле сортировки фото
		"ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки фото
		"ELEMENT_SORT_ORDER1" => "asc",	// Порядок сортировки фото
		"GROUP_PERMISSIONS" => "",	// Группы пользователей, имеющие доступ к детальной информации
		"IBLOCK_ID" => "15",	// Инфоблок
		"IBLOCK_TYPE" => "news",	// Тип инфоблока
		"PROPERTY_CODE" => array(	// Свойства
			0 => "POSITION",
			1 => "COMPANY",
			2 => "",
		),
		"SEARCH_URL" => "search.php",	// Страница поиска
		"SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID раздела
		"SECTION_URL" => "section.php?SECTION_ID=#SECTION_ID#",	// Альбом
		"SET_NAV_CHAIN" => "N",	// Добавлять раздел и название фото в цепочку навигации
		"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_TAGS" => "N",	// Показывать теги
		"THUMBNAIL_SIZE" => "300",	// Размер детальной фотографии (px)
		"UPLOAD_URL" => "upload.php?SECTION_ID=#SECTION_ID#&ACTION=upload",	// Загрузка фото
		"USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>